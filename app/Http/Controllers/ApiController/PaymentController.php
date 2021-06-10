<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;

class PaymentController extends ApiController
{
    public function request(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'type' => 'string | max:255',
            'amount'   => 'required | numeric'
        ]);

        if ($validator->fails()) {
            return response()->error(400, $validator->errors()->first());
        }
        
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8ac7a4c877afa7980177afffe507019b" .
                "&amount=$request->amount" .
                "&currency=SAR" .
                "&paymentType=DB" . 
                "&testMode=EXTERNAL"
            ;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGFjN2E0Yzg3N2FmYTc5ODAxNzdhZmZlM2NlMzAxOTJ8S1BteFpIcDI0Ug==')
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return response()->data(json_decode($responseData, true));
    }

    public function status(string $id)
    {
        $url = "https://test.oppwa.com/v1/checkouts/$id/payment";
        $url .= "?entityId=8ac7a4c877afa7980177afffe507019b";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGFjN2E0Yzg3N2FmYTc5ODAxNzdhZmZlM2NlMzAxOTJ8S1BteFpIcDI0Ug=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return response()->data(json_decode($responseData, true));
    }
}