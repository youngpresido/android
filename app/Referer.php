<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referer extends Model
{
    protected $guarded =['id'];


    public function transaction()
    {
        return $this->hasMany('App\Transaction');
    }
}
