<?php

namespace App\Telegram\Model;

use Core\Model;

class Telegram extends Model
{

    public function notification($msg)
    {


        $curl = curl_init();

        $tes = 'https://api.telegram.org/bot5073900363:AAHHLdHrCfm4M1HPbNAOx1lwHOvpRmium4k/sendmessage?chat_id=123456&text=' . $msg . '&parse_mode=html';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $tes,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: PHPSESSID=b38669be2cacc0d778faf68b3d5fe35a'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
