<?php

namespace App\Jobs;

use App\Models\Nmap;
use App\Traits\PtTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class NmapCurl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,PtTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $id;
    public $type;
    public $url;
    public $args;
    public function __construct($url,$id,$type,$args = null)
    {
        $this->url = $url;
        $this->id = $id;
        $this->type = $type;
        $this->args = $args;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        switch ($this->type) {
            case "nmap":
                $this->nmap($this->url,$this->id,$this->args);
                break;
            case "sqlmap":
                $this->sqlmap($this->url,$this->id);
                break;
            case "subdomains":
                $this->subdomains($this->url,$this->id,$this->args);
                break;
            case "wpscan":
                $this->wpscan($this->url,$this->id);
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        }


    }

   /* public function retryUntil()
    {
        return now()->addMinutes(5);
    }*/

    /*
     * $apiURL = 'http://206.189.108.218:8000/Service_detection-scan';

        // POST Data
        $postInput = [
            'url' => 'http://scanme.nmap.org',
            'token' =>'f237d0b2fd7da4f239ef3cac61db570af50417c9'
        ];

        // Headers
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' =>'Bearer yazeed',
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);

        $statusCode = $response->status();
        //$responseBody = json_decode($response->getBody(), true);
        $obj = Nmap::findorFail($this->id);
        $obj->update([
            'result' => $response->getBody(),
            'status' => 1
        ]); */

}
