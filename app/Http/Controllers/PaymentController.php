<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8ac7a4c877afa7980177afff3bd40196" .
            "&amount=92" .
            "&currency=SAR" .
            "&paymentType=DB" .
            "&testMode=INTERNAL";


        //  dd($data);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Authorization:Bearer OGFjN2E0Yzg3N2FmYTc5ODAxNzdhZmZlM2NlMzAxOTJ8S1BteFpIcDI0Ug=='
            )
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $id = json_decode($responseData, true)['id'];
        return view('payment.index', compact('id'));
    }

    public function success(Request $request)
    {
        $id = $request->id;
        $url = "https://test.oppwa.com/v1/checkouts/$id/payment";
        $url .= "?entityId=8ac7a4c877afa7980177afff3bd40196";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGFjN2E0Yzg3N2FmYTc5ODAxNzdhZmZlM2NlMzAxOTJ8S1BteFpIcDI0Ug=='
        ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $chceck  =  json_decode($responseData, true);

        dd($chceck);
    }
}
