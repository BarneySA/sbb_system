<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function auth (){
    	$user = Auth::user();
    	$user->balance = [
            'NEO' => 0,
            'GAS' => 0
        ];

        $client = new \GuzzleHttp\Client();
        
        // Para optener balance
        $res = $client->get(config('app.neo_bridge_url').'/wallet/balance/'.$user->wallet_address)->getBody();
        $res = json_decode($res);
        $user->balance = $res;

        $user->qr = url('/qr-code/'.$user->wallet_address);
        
		return $user;
    }

}
