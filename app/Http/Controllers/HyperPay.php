<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HyperPay extends Controller
{
    public function request_checkoutId($amount,$user,$rand)
    {
        $url = "https://oppwa.com/v1/checkouts";
        $data = "entityId=" .
            "&amount=$amount" .
            "&currency=SAR" .
            "&testMode=EXTERNAL" .
            "&customer.email=$user->email" .
            "&customer.givenName=$user->name" .
            "&customer.surname=$user->name" .
            "&billing.postcode=13322" .
            "&billing.street1=".
            "&billing.city=Riyadh".
            "&billing.state=".
            "&billing.country=SA".
            "&merchantTransactionId=$rand" .
            "&createRegistration=false" .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $response = json_decode($responseData, TRUE);
        $checkoutId = $response["id"];
        return $checkoutId;
    }

    function get_payment_status($checkoutId)
    {
        $url  = "https://oppwa.com/v1/checkouts/$checkoutId/payment";
        $url .= "?entityId=";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }


    function recurrining_payment_PA($registrationId, $amount)
    {
        $url = "";
        $data = "entityId=" .
            "&amount=$amount" .
            "&currency=SAR" .
            "&testMode=EXTERNAL" .
            "&paymentType=PA" .
            "&recurringType=REPEATED";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }

    function capture_PA($paymentId, $amount)
    {
        $url = "";
        $data = "entityId=" .
            "&amount=$amount" .
            "&testMode=EXTERNAL" .
            "&currency=SAR" .
            "&paymentType=CP";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer '));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        return $responseData;
    }

    function reverse_PA($paymentId)
    {
        $url = "";
        $data = "entityId=" .
            "&paymentType=RV";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Auth'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }


    function reverse_payment($paymentId)
    {
        $url = "";
        $data = "entityId=" .
            "&testMode=EXTERNAL" .
            "&paymentType=RV";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }

    public function payment($user,$amount,$rand)
    {
        $url = "";
        $data = "entityId=" .
            "&amount=$amount" .
            "&currency=SAR" .
            "&testMode=EXTERNAL" .
            "&customer.email=$user->email" .
            "&customer.givenName=$user->name" .
            "&customer.surname=$user->name" .
            "&billing.postcode=13322" .
            "&billing.street1=".
            "&billing.city=Riyadh".
            "&billing.state=".
            "&billing.country=SA".
            "&merchantTransactionId=$rand" .
            "&createRegistration=false" .
            "&paymentType=DB" .
            "&notificationUrl=http://www.example.com/notify";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return  json_decode($responseData, true);
    }


    public static function checkPayment($id){
        $url = "";
      echo  $url .= "?entityId=";die;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }


}
