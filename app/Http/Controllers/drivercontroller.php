<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function dashboard()
    {
        // بيانات تجريبية
        $data = [
            'seats_booked' => 40,
            'trip_started' => false,
            'driver_name' => 'Ahmed Mohammed',
            'bus_number' => 'BUS-101',
            'today_trips' => [
                ['time' => '08:00 AM', 'route' => 'City Center → University', 'seats' => 40],
                ['time' => '02:00 PM', 'route' => 'University → Mall', 'seats' => 30],
                ['time' => '06:00 PM', 'route' => 'Mall → Airport', 'seats' => 15],
            ],
            'total_seats' => 40
        ];

        return view('driver.dashboard', $data);
    }

    public function startTrip()
    {
        // بيانات تجريبية (لاحقاً من DB)
        $seats_booked = 40;
        $total_seats = 40;
        $trip_started = false;

        if ($trip_started) {
            return back()->with('error', 'Trip already started');
        }

        if ($seats_booked == $total_seats) {
            return back()->with('success', 'Trip started successfully');
        } else {
            return back()->with('error', 'Cannot start trip, not all seats booked');
        }
    }

      /*public function viewSchedule()
    {

    }*/
}
