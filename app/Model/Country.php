<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Country extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'country';
}
