<?php

namespace App\Traits;

use App\Models\Nmap;
use App\Models\Sqlmap;
use App\Models\Subdomain;
use App\Models\Wpscan;
use Illuminate\Support\Facades\Http;

trait PtTrait
{
    private $token = 'f237d0b2fd7da4f239ef3cac61db570af50417c9';
    public function nmap($url,$id,$type){

        if($type == 'Sv_scan'){
            $apiURL = 'http://206.189.108.218:8000/Sv_scan?Dera_Secret.api='.$this->token;
        }elseif ($type == 'os_scan'){
            $apiURL = 'http://206.189.108.218:8000/os_scan?Dera_Secret.api='.$this->token;
        }elseif ($type == 'top_ports'){
            $apiURL = 'http://206.189.108.218:8000/top_ports?Dera_Secret.api='.$this->token;
        }elseif ($type == 'vulners'){
            $apiURL = 'http://206.189.108.218:8000/vulners?Dera_Secret.api='.$this->token;
        }elseif ($type == 'Sc_scan'){
            $apiURL = 'http://206.189.108.218:8000/Sc_scan?Dera_Secret.api='.$this->token;
        }elseif ($type == 'vuln'){
            $apiURL = 'http://206.189.108.218:8000/vuln?Dera_Secret.api='.$this->token;
        }elseif ($type == 'port_80_433'){
            $apiURL = 'http://206.189.108.218:8000/port_80_443_vulns?Dera_Secret.api='.$this->token;
        }elseif ($type == 'nmap_http'){
            $apiURL = 'http://206.189.108.218:8000/nmap_HTTP_vulns?Dera_Secret.api='.$this->token;
        }elseif ($type == 'ftp_anon'){
            $apiURL = 'http://206.189.108.218:8000/ftp_anon?Dera_Secret.api='.$this->token;
        }elseif ($type == 'ftp_vulns'){
            $apiURL = 'http://206.189.108.218:8000/ftp_vulns?Dera_Secret.api='.$this->token;
        }



        // POST Data
        $postInput = [
            'url' => $url,
        ];

        // Headers
        $headers = [
            'Content-Type' => 'application/json',
            'accept' =>'application/json',
            'Dera_Secret.api' => $this->token,
            'Cookie' =>'Dera_Secret.api='.$this->token,
        ];

        $response = Http::withHeaders($headers)->timeout(9999999999)->post($apiURL, $postInput);

        /*$statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);*/
        $obj = Nmap::findorFail($id);
        $obj->update([
            'result' => $response->getBody(),
            'status' => 1
        ]);
    }

    public function sqlmap($url,$id){
        $apiURL = 'http://206.189.108.218:8000/sqlmap?Dera_Secret.api='.$this->token;

        // POST Data
        $postInput = [
            'url' => $url,
        ];

        // Headers
        $headers = [
            'Content-Type' => 'application/json',
            'accept' =>'application/json',
        ];

        $response = Http::withHeaders($headers)->timeout(9999999999)->post($apiURL, $postInput);

        /*$statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);*/
        $obj = Sqlmap::findorFail($id);
        $obj->update([
            'result' => $response->getBody(),
            'status' => 1
        ]);
    }

    public function subdomains($url,$id,$type){

        if($type == 'amass'){
            $apiURL = 'http://206.189.108.218:8000/amass?Dera_Secret.api='.$this->token;
        }elseif ($type == 'bufferover_run'){
            $apiURL = 'http://206.189.108.218:8000/bufferover_run?Dera_Secret.api='.$this->token;
        }elseif ($type == 'hackertarget'){
            $apiURL = 'http://206.189.108.218:8000/hackertarget?Dera_Secret.api='.$this->token;
        }elseif ($type == 'cert.sh'){
            $apiURL = 'http://206.189.108.218:8000/cert.sh?Dera_Secret.api='.$this->token;
        }elseif ($type == 'fastsubs'){
            $apiURL = 'http://206.189.108.218:8000/fastsubs?Dera_Secret.api='.$this->token;
        }


        // POST Data
        $postInput = [
            'url' => $url,
        ];

        // Headers
        $headers = [
            'Content-Type' => 'application/json',
            'accept' =>'application/json',
            'Dera_Secret.api' => 'f237d0b2fd7da4f239ef3cac61db570af50417c9',
            'Cookie' =>'Dera_Secret.api=f237d0b2fd7da4f239ef3cac61db570af50417c9',
        ];

        $response = Http::withHeaders($headers)->timeout(9999999999)->post($apiURL, $postInput);

       /* return [
            'url' => $apiURL,
            'code' => $response->status(),
            'hh' => $headers
        ];*/
        //file_put_contents(public_path('sub_'.$id.'.txt'),$response->getBody());
        try {
            $obj = Subdomain::findorFail($id);
            $obj->update([
                'result' => $response->getBody(),
                'status' => 1
            ]);

        }catch (\Exception $exception){
            $obj->update([
                'result' => 'sub_'.$id.'.txt',
                'status' => 2
            ]);
           file_put_contents(public_path('sub_'.$id.'.txt'),$response->getBody());
        }

    }


    public function wpscan($url,$id){
        $apiURL = 'http://206.189.108.218:8000/wpscan?Dera_Secret.api='.$this->token;

        // POST Data
        $postInput = [
            'url' => $url,
        ];

        // Headers
        $headers = [
            'Content-Type' => 'application/json',
            'accept' =>'application/json',
        ];

        $response = Http::withHeaders($headers)->timeout(9999999999)->post($apiURL, $postInput);

        /*$statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);*/
        $obj = Wpscan::findorFail($id);
        $obj->update([
            'result' => $response->getBody(),
            'status' => 1
        ]);
    }

}
