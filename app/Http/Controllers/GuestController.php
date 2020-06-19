<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Section;
use App\Order;
use App\Workerstat;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;


class GuestController extends Controller
{
    public function __construct()
    {
        // $this->middleware('notadmin');
    }
    public function welcome()
    {
        $sections = Section::all();
        $writers = User::where(['role' => 'writer', 'approved' => 1])->latest()->take(3)->get();
        return view('welcome', ['sects' => $sections, 'writers' => $writers]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function test(Request $request)
    {
        $first = Order::where('user_id', 16)->first();  
        if(!$first) {
            return 'yes';
        }
        return 'no';
    }

    public function success(Request $request)
    {
        $session = \Stripe\Checkout\Session::retrieve($request->query('session_id'));
        // return $request->query('session_id');
        $ids = $session->metadata;

        for ($i = 0; $i < count($ids); $i++) {
            $cart = Cart::where('id', $ids[$i])->first();
            // unset($cart->created_at);
            // unset($cart->updated_at);
            $cart['endtime'] = date("Y-m-d H:i:s", strtotime('+' . $cart->timeframe . ' hours'));

            $writer = Workerstat::where(['current' => false, 'department_id' => $cart->section->category->department->id, 'approved' => 1])->first();
            if ($writer) {
                $order = Order::create([
                    'user_id' => $cart->user_id,
                    'section_id' => $cart->section_id,
                    'title' => $cart->title,
                    'description' => $cart->description,
                    'words' => $cart->words,
                    'price' => $cart->price,
                    'timeframe' => $cart->timeframe,
                    'endtime' => $cart->endtime,
                    'writer_id' => $writer->user_id
                ]);
                $writer->update([
                    'jobs' => $writer->jobs + 1,
                    'current' => true,
                    'order_id' => $order->id
                ]);

                $subject = $order->title . " has been assigned to a writer";
                $view = 'emails.assign';
                $mail = new MyMail($subject, $order, $view);
                Mail::to($order->user->email)->send($mail);

                $subject = "New job alert";
                $view = 'emails.job';
                $mail = new MyMail($subject, $writer->user, $view);
                Mail::to($writer->user->email)->send($mail);
            } else {
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
            }
            $cart->delete();
        }
        return redirect('/orders')->with('success', 'Payment was successfully');
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

        $orders = Order::where('writer_id', null)->get();
        // return $orders;
        if (count($orders) > 0) {
            foreach ($orders as $order) {
                $writers = Workerstat::where(['current' => false, 'approved' => 1])->get();
                // return $writers;
                if (count($writers) > 0) {
                    foreach ($writers as $writer) {
                        if ($writer->department_id == $order->section->category->department->id) {
                            // echo $writer;
                            Order::where('id', $order->id)->update([
                                'writer_id' => $writer->user_id
                            ]);
                            Workerstat::where('id', $writer->id)->update([
                                'jobs' => $writer->jobs + 1,
                                'current' => true,
                                'order_id' => $order->id
                            ]);
                            $subject = $order->title . " has been assigned to a writer";
                            $view = 'emails.assign';
                            $mail = new MyMail($subject, $order, $view);
                            Mail::to($order->user->email)->send($mail);

                            $subject = "New job alert";
                            $view = 'emails.job';
                            $mail = new MyMail($subject, $writer->user, $view);
                            Mail::to($writer->user->email)->send($mail);

                            break;
                        } else {
                        }
                    }
                } else {
                    break;
                }
            }
        }
        return redirect()->back()->with('success', 'Project successfully completed');
    }
}
