<?php

namespace App\Http\Controllers;

use App\Interfaces\iTrasportation;

class AirTravelController extends Controller implements iTrasportation
{
    public function start()
    {
        return 'You are travelling by Air';
    }
}
