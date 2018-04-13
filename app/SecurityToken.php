<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecurityToken extends Model 
{

    protected $table = 'security_tokens';
    public $timestamps = true;

}