<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;
use App\Cart;
use App\User;
use App\Order;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    public function redirectToPay()
    {
        $carts = Cart::where('user_id', Auth()->user()->id)->get();

        $total_price = 0;
        $ids = [];
        foreach ($carts as $cart) {
            $total_price += $cart->price;
            array_push($ids, $cart->id);
        }
        // $total_price = $total_price * 100;

        $curl = curl_init();

        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://free.currconv.com/api/v7/convert?q=USD_NGN&compact=ultra&apiKey='.env('CONVERTER'),
            CURLOPT_RETURNTRANSFER => true
        ));

        $output = curl_exec($curl);
        $rate = json_decode($output)->USD_NGN;
        // return $rate;

        curl_close($curl);

        $total_price = $total_price * $rate * 100;

        $r = [
            'email' => Auth()->User()->email,
            'amount' => $total_price,
            'quantity' => 1,
            'currency' => 'NGN',
            'reference' => Paystack::genTranxRef(),
            'orderID' => 345,
            'metadata' => json_encode($ids)
        ];

        return redirect()->action(
            'PaymentController@redirectToGateway',
            $r
        );
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        // dd($paymentDetails['data']['metadata']);
        if ($paymentDetails['status']) {
            $ids = $paymentDetails['data']['metadata'];

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
        return redirect('/cart?error=cancelled');
    }
}
