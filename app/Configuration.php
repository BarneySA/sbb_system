<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model 
{

    protected $table = 'configurations';
    public $timestamps = true;

    public static function g (){
       
        $client = new \GuzzleHttp\Client();
        
        $configuration = Configuration::all()->first();

        $configuration->balance = [
            'NEO' => 0,
            'GAS' => 0
        ];

        // Para optener balance
        $res = $client->get(config('app.neo_bridge_url').'/wallet/balance/'.$configuration->wallet_address)->getBody();
        $res = json_decode($res);
        $configuration->balance = $res;

        $configuration->qr = url('/qr-code/'.$configuration->wallet_address);
        
		return $configuration;
    }


}