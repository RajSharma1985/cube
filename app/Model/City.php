<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class City extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'city';

    public function getcountry()
    {
        return $this->hasOne('App\Model\Country', '_id', 'country');
    }
}
