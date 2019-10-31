<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class State extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'state';

    public function getcountry()
    {
        return $this->hasOne('App\Model\Country', '_id', 'country');
    }
}
