<?php

namespace App\Http\Controllers\Frontend\Stripe;

use App\Http\Controllers\Controller;
use App\Models\StripeBankInputs;
use App\Models\StripeInputDetails;
use App\Models\StripeSupportedCountry;
use App\Models\User;
use App\Models\UserBankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Toastr;

class StripeController extends Controller
{
    public function finances(){
        $id = Auth::user()->id;
        $data['user'] = User::where('id', $id)->first();
        if (!is_null($data['user'] )) {
            $bankStatus = 0;
            $isAccount = 1;
            $data['bankCountry'] = StripeBankInputs::select('id','country_name')->orderBy('country_name','ASC')->get();
            $data['bankAccount'] = UserBankAccount::where('user_id',$id)->first();

            if(!empty($data['bankAccount'])){
                $sKey = env('STRIPE_SECRET');
                $stripe = new \Stripe\StripeClient($sKey);
                try{
                    $accountDetail = $stripe->accounts->retrieve($data['bankAccount']['stripe_account_id'], []);
                    $bankStatus = $accountDetail->payouts_enabled == false ? 0 : 1;
                }catch(\Exception $e){
                    $bankStatus = 0;
                    $isAccount = 0;
                }
            }else{
                $isAccount = 0;
            }
            $data['bankStatus'] = $bankStatus;
            $data['isAccount'] = $isAccount;
            return view('frontend.stripe.finances', $data);
        }else {
            Toastr::error('User is not exist', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function getBankRequiredDetails(Request $request){
        $details = StripeInputDetails::where('country_id',$request['bankId'])->get();
        $details = count($details) > 0 ? $details : [];
        $inputFields = '';
        if(count($details) > 0){
            foreach ($details as $key => $detail){
                $inputName = $key == 0 ? 'bank_account_number' : 'bank_routing_number' ;
                $length = explode(' ',$detail['input_character']);
                $mainLength = explode('-',$length[0]);

                $min = isset($mainLength[0]) && $mainLength[0] > 0 ? $mainLength[0] : '';
                $max = isset($mainLength[1]) && $mainLength[1] > 0 ? $mainLength[1] : ($mainLength[0] > 0 ? $mainLength[0] : '');

                $inputFields .= '<div class="form-group formspace02">
                                                <p>'.$detail['input_type'].'</p>
                                                <input type="text" name="'.$inputName.'" id="bankDetail_'.$key.'" value="" class="form-control form-control-lg" data-name="'.$detail['input_type'].'" placeholder="'.$detail['input_type'].'">
                                                <span class="text-danger" id="error-'.$inputName.'"></span>
                                            </div>';
            }
        }
        $data['inputFields'] = $inputFields;
        return $data;
    }

    public function storeBankAccount(Request $request){
        $validator = Validator::make($request->all(), [
            'business_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'bank_country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'state' => 'required',
            'bank_holder_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 2, 'errors' => $validator->errors()], 200);
        }

        $user = Auth::user();
        $country = StripeBankInputs::where('id',$request['bank_country'])->first();
        try{
            $sKey = env('STRIPE_SECRET');
            $stripe = new \Stripe\StripeClient($sKey);

            /*Get All Connect Account*/
            $allAccount = $stripe->accounts->all(['limit' => 3]);

            /*Delete Account*/
            //$stripe->accounts->delete('acct_1Ox0GfQQOx61fBu2', []);

            /*-----------Connect Account In Stripe Code-----------*/
            $response = $stripe->accounts->create(
                [
                    'type' => 'custom',
                    'country' => $country['country_code'],
                    'email' => $user['email'],
                    'capabilities' => [
                        'card_payments' => ['requested' => true],
                        'transfers' => ['requested' => true],
                    ],
                ]);
            if(!empty($response)){
                /*-----------Connect Bank Account In Stripe Code-----------*/
                $bankResponse = $stripe->tokens->create([
                    'bank_account' => [
                        'country' => $country['country_code'],
                        'currency' => $country['country_currency'],
                        'account_holder_name' =>  $request['bank_holder_name'],
                        'account_holder_type' => $request['business_type'],
                        'routing_number' => $request['bank_routing_number'],
                        'account_number' => $request['bank_account_number'],
                    ],
                ]);
                if(!empty($bankResponse)){
                    /*-----------Add External Bank Account In Stripe Code-----------*/
                    $exResponse = $stripe->accounts->createExternalAccount(
                        $response['id'],
                        ['external_account' => $bankResponse['id']]
                    );

                    if(!empty($exResponse)){
                        $input = $request->all();
                        $input['user_id'] = $user['id'];
                        $input['country'] = $request['bank_country'];
                        $input['stripe_account_id'] = $response['id'];
                        $input['stripe_bank_account_id'] = $bankResponse['id'];
                        $input['stripe_external_account_id'] = $exResponse['id'];
                        $input['status'] = 'pending';
                        UserBankAccount::create($input);
                    }
                }
            }
            $data['status'] = 1;
            $data['message'] = 'Your bank account is connected successfully. Now please verify your account with the Stripe.';
            return $data;
        }catch(\Exception $e){
            $data['status'] = 0;
            $data['message'] = $e->getMessage();
            return $data;
        }
    }

    public function linkGenerate(){
        $user = Auth::user();
        if(!empty($user)){
            $userBank = UserBankAccount::where('user_id',$user['id'])->first();
            if(!empty($userBank)){
                $sKey = env('STRIPE_SECRET');
                $stripe = new \Stripe\StripeClient($sKey);
                $accountLink = $stripe->accountLinks->create([
                    'account' => $userBank['stripe_account_id'],
                   // 'refresh_url' => route('stripe.finances'),
                    //'return_url' => route('stripe.finances'),
                    'refresh_url' => 'https://google.com',
                    'return_url' => 'https://google.com',
                    'type' => 'account_onboarding',
                ]);
                if(!empty($accountLink)){
                    $data['status'] = 1;
                    $data['url'] = $accountLink->url;
                    $data['message'] = 'Something is wrong. Please try again';
                }else{
                    $data['status'] = 0;
                    $data['message'] = 'Something is wrong. Please try again';
                }
            }else{
                $data['status'] = 0;
                $data['message'] = 'Bank details not found';
            }
        }else{
            $data['status'] = 0;
            $data['message'] = 'Session timeout';
        }
        return $data;
    }
}