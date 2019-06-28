<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;
use App\Referer;
use App\Transaction;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        $this->validate($request,[
            "email"=>"required"
        ]);
        // dd($request->metadata==null);
        if($request->metadata==null){
            // dd("hey");

            return Paystack::getAuthorizationUrl()->redirectNow();
            
        }elseif(!Referer::whereCode($request->metadata)->first()){
            return redirect()->back()->with("status","invalid referer's code. leave the referer code empty to buy without one");
            
        }else{
dd(Paystack::getAuthorizationUrl()->redirectNow());
        return Paystack::getAuthorizationUrl()->redirectNow();
	}
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        
        
        $paymentDetails = Paystack::getPaymentData();
        $pay=$paymentDetails['data']['customer'];
        // dd($payment);
        $referer_id;
        if($pay['metadata']==null)
        {
            $referer_id=1;
        }else{
            $ref=Referer::whereCode($pay['metadata'])->first();
            $referer_id=$ref->id;
        }
        $addn=new Transaction([
            'referer_id'=>$referer_id,
            'date'=>now(),
            'amount'=>300,
            "reference"=>$paymentDetails['data']['reference']

        ]);
        if($addn->save()){
            return redirect('/')->with("status","Payment successful, your licence key is - {$addn->reference}");
        }
        return redirect('/')->with('status','Something went wrong');

        // dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
    public function pay($id)
    {
        $transact=Transaction::whereId($id)->first();
        $transact->status=1;
        $transact->save();
        return redirect()->back();
    }
}
