<?php

class APIClient
{
    function call($method, $url, $data = '', $auth = '') {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        switch ($method) {
            case "GET":
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
                break;
            case "POST":
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                break;
        }

        //Optional Authentication
        if ($auth) {
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_USERPWD, $auth);
        }

        $response = curl_exec($curl);

        /*Check for 404 (file not found). */
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        //Check the HTTP status code
        switch ($httpCode) {
            case 200:
                $error_status = 200;
                break;
            case 404:
                $error_status = 404;
                break;
            case 500:
                $error_status = 500;
                break;
            case 502:
                $error_status = 502;
                break;
            case 503:
                $error_status = 503;
                break;
            default:
                $error_status = 400;
        }
        curl_close($curl);
        return array(
            'response' => $response,
            'status' => $error_status
        );
    }
}