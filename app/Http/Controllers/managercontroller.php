<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class managercontroller extends Controller
{
    public function dashboard()
{
    $data = [
        'bus_count' => \App\Models\Bus::count(),
        'driver_count' => \App\Models\Driver::count(),
        'station_count' => \App\Models\Station::count(),
    ];

    return view('manger.mdashboard', $data);

}
}

