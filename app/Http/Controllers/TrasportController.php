<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Interfaces\iTransport;

class TrasportController extends Controller implements iTransport
{
    protected $airTravel;
    protected $carTravel;
    protected $trainTravel;

    public function __construct(TrainTravelController $trainTravel, AirTravelController $airTravel, CarTravelController $carTravel)
    {
        $this->trainTravel = $trainTravel;
        $this->airTravel = $airTravel;
        $this->carTravel = $carTravel;
    }

    public function start($trasportMode)
    {
        switch ($trasportMode) {
            case 'car':
                return $this->carTravel->start();
                break;
            case 'train':
                return $this->trainTravel->start();
                break;
            case 'air': 
                return $this->airTravel->start();
                break;

            default:
            return 'Select travel mode';
                break;
        }
    }
}
