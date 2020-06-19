<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Cart;
use App\Order;
use App\Workerstat;
use App\User;
use App\Withdrawal;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;
use Validator;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Promise\queue;

Stripe::setApiKey(env('STRIPE_SECRET'));

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    public function order(Request $request)
    {
        $section = Section::where('url', $request->desc)->first();
        // return $section;
        if ($section) {
            // if($section->currency == 'cent') {
            //     return view('pages.order', ['section' => $section]);
            // }
            return view('pages.addcart', ['section' => $section]);
        }
        return abort(404);
    }

    public function addToCart(Request $request)
    {
        $existingTitle = Cart::where(['user_id' => Auth()->User()->id, 'section_id' => $request->section_id, 'title' => $request->title])->first();
        if ($existingTitle) {
            return redirect()->back()->with('message', 'Title already exist. Go to cart to complete your order')->withInput();
        }
        $section = Section::where('id', $request->section_id)->first();
        $timeframe = 24;
        $price = $section->price;
        if ($request->words) {
            $price = ($request->words * $section->price) / 100;
            $timeframe = 24;
            if ($request->words > 500) {
                $timeframe = 48;
            }
        }
        // return $section;
        $request['price'] = $price;
        $request['timeframe'] = $timeframe;
        $request['user_id'] = Auth()->User()->id;
        $cart = Cart::create($request->all());
        if ($cart) {
            return redirect('/cart');
        }
        return redirect()->back();
    }

    public function cart(Request $request)
    {
        $carts = Cart::where('user_id', Auth()->user()->id)->get();
        if (count($carts) == 0) {
            return view('pages.cart', ['carts' => $carts, 'id' => 1]);
        }
        $total_price = 0;
        $ids = [];
        foreach ($carts as $cart) {
            $total_price += $cart->price;
            array_push($ids, $cart->id);
        }
        $total_price = $total_price * 100;

        $product = \Stripe\Product::create([
            'name' => $carts[0]->title,
        ]);

        $price = \Stripe\Price::create([
            'product' => $product->id,
            'unit_amount' => $total_price,
            'currency' => 'usd',
        ]);

        $session = \Stripe\Checkout\Session::create([
            'customer_email' => Auth()->user()->email,
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => $price->id,
                'quantity' => 1,
            ]],
            'metadata' => $ids,
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/cart/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://localhost:8000/cart?error=cancelled',
        ]);

        if ($request->query('error')) {
            return view('pages.cart', ['carts' => $carts, 'id' => $session->id, 'error' => 'Payment request cancelled']);
        }
        return view('pages.cart', ['carts' => $carts, 'id' => $session->id]);
    }

    public function success(Request $request)
    {
        $session = \Stripe\Checkout\Session::retrieve($request->query('session_id'));
        // return $request->query('session_id');
        $ids = $session->metadata;

        $first = Order::where('user_id', Auth::User()->id)->first();
        $price = 0;

        for ($i = 0; $i < count($ids); $i++) {
            $cart = Cart::where('id', $ids[$i])->first();
            // unset($cart->created_at);
            // unset($cart->updated_at);
            $cart['endtime'] = date("Y-m-d H:i:s", strtotime('+' . $cart->timeframe . ' hours'));

            $order = Order::create([
                'user_id' => $cart->user_id,
                'section_id' => $cart->section_id,
                'title' => $cart->title,
                'description' => $cart->description,
                'words' => $cart->words,
                'price' => $cart->price,
                'timeframe' => $cart->timeframe,
                'endtime' => $cart->endtime
            ]);

            $price += $cart->price;

            if ($order) {
                $cart->delete();
            }
        }
        if (!$first) {
            if (Auth::User()->referral) {
                User::where('referralcode', Auth::User()->referral)->update([
                    'wallet' => 0.25 * $price
                ]);
            }
        }
        return redirect('/orders')->with('success', 'Payment was successfully');
    }

    public function removeFromCart(Request $request)
    {
        Cart::where('id', $request->id)->delete();
        return redirect('/cart');
    }

    public function orderList(Request $request)
    {
        $orders = Order::where(['user_id' => Auth()->user()->id, 'writer_completed' => false])->get();
        $completed = Order::where(['user_id' => Auth()->user()->id, 'completed' => true])->get();
        $submitted = Order::where(['user_id' => Auth()->user()->id, 'writer_completed' => true, 'completed' => false])->get();
        $assigned = Order::where(['user_id' => Auth()->user()->id, 'writer_completed' => false])->whereNotNull('writer_id')->get();


        $per_page = 3;

        if (count($orders) > 0) {
            $total_active = count($orders);
            $current_active_page = $request->query("active") ?? 1;
            $starting_active = ($current_active_page * $per_page) - $per_page;
            $orders = $orders->toArray();
            $orders = array_slice($orders, $starting_active, $per_page, true);
            $orders = new Paginator($orders, $total_active, $per_page, $current_active_page, [
                'path' => $request->url(),
            ]);
            $orders->setPageName('active');
        }

        $active_unassigned = '';
        $active_assigned = '';
        $active_submitted = '';
        $active_completed = '';

        if ($request->query('active')) {
            $active_unassigned = 'active';
        }
        if ($request->query('assigned')) {
            $active_assigned = 'active';
        }
        if ($request->query('submitted')) {
            $active_submitted = 'active';
        }
        if ($request->query('completed')) {
            $active_completed = 'active';
        }
        if ($request->query() == []) {
            $active_unassigned = 'active';
        }

        if (count($completed) > 0) {
            $total_completed = count($completed);
            $current_completed_page = $request->query("completed") ?? 1;
            $starting_completed = ($current_completed_page * $per_page) - $per_page;
            $completed = $completed->toArray();
            $completed = array_slice($completed, $starting_completed, $per_page, true);
            $completed = new Paginator($completed, $total_completed, $per_page, $current_completed_page, [
                'path' => $request->url(),
            ]);
            $completed->setPageName('completed');
        }

        if (count($submitted) > 0) {
            $total_submitted = count($submitted);
            $current_submitted_page = $request->query("submitted") ?? 1;
            $starting_submitted = ($current_submitted_page * $per_page) - $per_page;
            $submitted = $submitted->toArray();
            $submitted = array_slice($submitted, $starting_submitted, $per_page, true);
            $submitted = new Paginator($submitted, $total_submitted, $per_page, $current_submitted_page, [
                'path' => $request->url(),
            ]);
            $submitted->setPageName('submitted');
        }

        if (count($assigned) > 0) {
            $total_assigned = count($assigned);
            $current_assigned_page = $request->query("assigned") ?? 1;
            $starting_assigned = ($current_assigned_page * $per_page) - $per_page;
            $assigned = $assigned->toArray();
            $assigned = array_slice($assigned, $starting_assigned, $per_page, true);
            $assigned = new Paginator($assigned, $total_assigned, $per_page, $current_assigned_page, [
                'path' => $request->url(),
            ]);
            $assigned->setPageName('assigned');
        }
        // return count($orders);

        // return $orders;
        // return $completed;
        // return $request->url();
        $active = 'active';
        return view('pages.orders', compact('orders', 'completed', 'assigned', 'submitted', 'active_unassigned', 'active_submitted', 'active_completed', 'active_assigned'));
    }

    public function orderDetails(Request $request, $id)
    {
        $order = Order::where(['user_id' =>  Auth()->user()->id, 'id' => $id])->first();
        $request->session()->put('endtime', $order->endtime);
        return view('pages.details', ['order' => $order]);
    }

    public function getTime(Request $request)
    {
        if (!$request->session()->has('endtime')) {
            $id = $request->query('id');
            $endtime = Order::where(['user_id' =>  Auth()->user()->id, 'id' => $id])->first()->endtime;
            $end =  strtotime($endtime);
        } else {
            $end = strtotime($request->session()->get('endtime'));
        }

        $start = strtotime('now');
        $diff = $end - $start;

        if ($diff <= 0) {
            $id = $request->query('id');
            Order::where(['user_id' =>  Auth()->user()->id, 'id' => $id])->update([
                'timeup' => true
            ]);
            return 'Time Up';
        }
        $h = floor($diff / 3600);
        $m = floor($diff / 60) % 60;
        $s = $diff % 60;

        return sprintf("%02d:%02d:%02d", $h, $m, $s);
        // return gmdate("z H:i:s", $diff);
    }

    public function approve($id)
    {
        Order::where('id', $id)->update([
            'completed' => true
        ]);
        $project = Order::where('id', $id)->first();
        Workerstat::where('user_id', $project->writer_id)->update([
            'current' => false,
            'submitted' => false,
            'order_id' => null
        ]);

        $subject = "Completed";
        $view = 'emails.writercompleted';
        $mail = new MyMail($subject, $project, $view);
        Mail::to($project->writer->email)->send($mail);

        $view = 'emails.usercompleted';
        $mail = new MyMail($subject, $project, $view);
        Mail::to($project->user->email)->send($mail);

        return redirect()->back()->with('success', 'Project successfully completed');
    }

    public function profile()
    {
        $orders = Order::where('user_id', Auth::User()->id)->get();
        $carts = Cart::where('user_id', Auth::User()->id)->get();
        return view('pages.profile', compact('orders', 'carts'));
    }

    public function editProfileGet()
    {
        return view('pages.editprofile');
    }

    public function editProfilePost(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::User()->id,
            'username' => 'required|string|unique:users,username,' . Auth::User()->id
        ];

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            // return $validate->errors()->first();
            return redirect()->back()->with('error', $validate->errors()->first());
        }

        $user = User::where('id', Auth::User()->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username
        ]);
        if ($user) {
            return redirect()->back()->with('success', 'Profile successfully update');
        }
        return redirect()->back();
    }

    public function changePasswordGet()
    {
        return view('pages.changepassword');
    }

    public function changePasswordPost(Request $request)
    {
        if (!(Hash::check($request->current_password, Auth::User()->password))) {
            return redirect()->back()->with('error', 'Your current password is incorrect');
        }
        if (strcmp($request->current_password, $request->new_password) == 0) {
            return redirect()->back()->with('error', 'New password cant be the same as current passowrd');
        }
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed'
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            // return $validate->errors()->first();
            return redirect()->back()->with('error', $validate->errors()->first());
        }
        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();
        return redirect()->back()->with('success', 'Password changed successfully');
    }

    public function withdrawal(Request $request)
    {
        return view('pages.withdrawal');
    }

    public function withdrawalPost(Request $request)
    {
        if (Auth::User()->account_number == null) {
            return redirect()->back()->with('error', 'Bank details not set');
        } else {
            if ($request->amount > Auth::User()->wallet) {
                return redirect()->back()->with('error', 'Insufficient balance');
            } else {
                $withdraw = Withdrawal::create([
                    'user_id' => Auth::User()->id,
                    'amount' => $request->amount
                ]);
                if ($withdraw) {
                    User::where('id', Auth::User()->id)->update([
                        'wallet' => Auth::User()->wallet - $request->amount
                    ]);
                    return redirect()->back()->with('success', 'Withdrawal request submitted');
                }
            }
            return redirect()->back()->with('error', 'Error, Try again.');
        }
    }

    public function bankDeatils() {
        return view('pages.bankdetails');
    }

    public function bankDeatilsPost(Request $request) {
        if (!(Hash::check($request->current_password, Auth::User()->password))) {
            return redirect()->back()->with('error', 'Your password is incorrect');
        }
        User::where('id', Auth::User()->id)->update([
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name
        ]);
        return redirect()->back()->with('success', 'Success!!!');
    }
}
