<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    public static function send_details($tokens,$title,$message,$type='')
    {

        $fields = array
        (
            "registration_ids" => $tokens,
            "priority" => 10,
            'data' => [
                'title' => $title,
                'message' => $message,
                'type' => $type
            ],
            'notification' => [
                'title' => $title,
                'message' => $message,
                'type'    => $type,
            ],
            'vibrate' => 1,
        );
        //dd( $fields);
        $headers = array
        (
            'accept: application/json',
            'Content-Type: application/json',
            'Authorization: key=' .
            'AAAAVBJYCmE:APA91bHh0cFTnL4nKiioOr8_VKSVAS5VNGc2Qo0AqGWfuQAz1t4xlS9J7u9Vb2jDs31wVs5TKhYc2mKlB3XnVa1n5s5eWrpK5ZbPS869ApIQJK0-630SauZYsvmD_yHbz_gqf6hPSG3U'

        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //  var_dump($result);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        // dd( $result);
        return $result;
    }
}
