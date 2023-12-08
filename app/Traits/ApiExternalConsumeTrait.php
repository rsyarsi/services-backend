<?php

namespace App\Traits;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseRequisition;
use GuzzleHttp\Client as GuzzleClient;

trait ApiExternalConsumeTrait
{
    public function GuzzleClientPostTokenWapin()
    {
         $wapinx = base64_encode(env('WAPPIN_TOKEN')); 
        //$wapinx = base64_encode("0410:59bae544f683769ea73951ac0d483ea6e60f65e5"); 
       $url = env('WAPPIN_URL_GEN_TOKEN'); 
       // $url = "https://api.wappin.id/v1/token/get"; 
        $curl = curl_init(); 
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic ' . $wapinx
            ),
        ));
        $response = curl_exec($curl);
        $JsonData = json_decode($response, TRUE);
        curl_close($curl);
        return $JsonData['data']['access_token'];
    }
    public function GuzzleClientPostWhatsapp($token,$body = [])
    {
        $url = env('WAPPIN_URL_SEND_WHATSAPP');  
        //$url = "https://api.wappin.id/v1/message/do-send-hsm";  
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.wappin.id/v1/message/do-send-hsm',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));
        $response = curl_exec($curl);
        $JsonData = json_decode($response, TRUE);
        curl_close($curl);
        return $JsonData;
    }
}