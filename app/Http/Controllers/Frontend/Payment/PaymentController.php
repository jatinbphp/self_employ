<?php

namespace App\Http\Controllers\Frontend\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Session;
use Illuminate\Support\Facades\Session;
use Stripe;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Toastr;

class PaymentController extends Controller
{
    public function index()
    {
        return view('frontend.pages.deposit');
    }

    public function stripePost(Request $request)
    {
        // dd($request->deposit_amount);
        $amount = $request->deposit_amount;
        $sKey = env('STRIPE_SECRET');
        Stripe\Stripe::setApiKey($sKey);
        try {
            Stripe\Charge::create ([
                "amount" => floatval($amount)*100,
                "currency" => "USD",
                "source" => $request->stripeToken,
                "description" => "This payment is testing purpose of self employee",
            ]);

            Session::flash('success', 'Payment Successfull!');
            Transaction::create([
                'user_id' => Auth::user()->id,
                'amount' =>  $request->deposit_amount,
                'type' =>  'stripe',
                'payment_type' =>  'credit',
            ]);
            $user = User::where('id', Auth()->user()->id)->first();
            $balance = floatval($user->balance) +  floatval($amount);

            // dd($balance);

            $user->update(['balance' => $balance ]);
            // dd($user);
            $data['main_balance'] = $balance;
            $data['status'] = 1;
            $data['message'] = 'The amount has been successfully deposited';
            return $data;
        } catch(\Stripe\Exception\CardException $e) {
            //Toastr::error('Card Declined.', 'Error', ["positionClass" => "toast-top-right"]);
            //return back();

            $data['status'] = 0;
            $data['message'] = 'Card Declined';
            return $data;

            // Since it's a decline, \Stripe\Exception\CardException will be caught
            // echo 'Status is:' . $e->getHttpStatus() . '\n';
            // echo 'Type is:' . $e->getError()->type . '\n';
            // echo 'Code is:' . $e->getError()->code . '\n';
            // param is '' in this case
            // echo 'Param is:' . $e->getError()->param . '\n';
            // echo 'Message is:' . $e->getError()->message . '\n';
        } catch (\Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            //Toastr::error('You made payment too frequently.', 'Error', ["positionClass" => "toast-top-right"]);
            //return back();

            $data['status'] = 0;
            $data['message'] = 'You made payment too frequently.';
            return $data;

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
             //Toastr::error('Something Went Wrong.', 'Error', ["positionClass" => "toast-top-right"]);
            //return back();

            $data['status'] = 0;
            $data['message'] = 'Something Went Wrong.';
            return $data;

        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            //Toastr::error('Card Authenticatioin Failed.', 'Error', ["positionClass" => "toast-top-right"]);
            //return back();

            $data['status'] = 0;
            $data['message'] = 'Card Authentication Failed.';
            return $data;

        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            //Toastr::error('Network Error.', 'Error', ["positionClass" => "toast-top-right"]);
            //return back();

            $data['status'] = 0;
            $data['message'] = 'Network Error.';
            return $data;

        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            //Toastr::error('Unknown Error.', 'Error', ["positionClass" => "toast-top-right"]);
            //return back();

            $data['status'] = 0;
            $data['message'] = 'Unknown Error.';
            return $data;

        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            //Toastr::error('Unknown Error.', 'Error', ["positionClass" => "toast-top-right"]);
            //return back();

            $data['status'] = 0;
            $data['message'] = 'Unknown Error.';
            return $data;
        }
    }
}
