<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;

class FlightController extends Controller
{

    public function search()
    {
        return view('Flights.results');
    }

    public function details(Flight $flight)
    {
        return view('Flights.details', compact('flight'));
    }
}
