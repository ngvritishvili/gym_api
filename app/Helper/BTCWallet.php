<?php

namespace App\Helper;


class BTCWallet
{
    public static function createWallet()
    {


//        // API Endpoint URL
//        $apiUrl = "http://127.0.0.1:3000/api/v2/create";
//
//// Data to be sent in the POST request
//        $data = array(
//            'password' => "SomeNewPass123!",
//            'api_code' => env('BLOCKCHAIN_API'),
//            'priv' => '',
//            'label' => 'Testing Purpose',
//            'email' => '',
////            'hd' => true,
//
//        );
//
//// Convert the data array to JSON format
//        $jsonData = json_encode($data);
//
//// cURL initialization
//        $ch = curl_init();
//
//// Set cURL options
//        curl_setopt($ch, CURLOPT_URL, $apiUrl);
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//
//// Execute the cURL session
//        $response = curl_exec($ch);
//
//// Check for cURL errors
//        if (curl_errno($ch)) {
//            echo 'cURL error: ' . curl_error($ch);
//        }
//
//// Close the cURL session
//        curl_close($ch);
//
//// Process the API response
//        if ($response) {
//            $responseData = json_decode($response, true);
//            // Process the $responseData as needed
//            dd($responseData);
//        } else {
//            echo "No response from the API.";
//        }

    }

    public function checkBalance()
    {

    }
}
