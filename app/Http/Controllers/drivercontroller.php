<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Trip;
use App\Models\Bus;
use Carbon\Carbon;

class DriverController extends Controller
{
    public function index()
    {
        $driver = Auth::user();

        $personalInfo = [
            'name' => $driver->name,
            'email' => $driver->email,
            'phone_number' => $driver->phone_number,
            'licenseId' => $driver->license_id,
        ];

        $assignedBus = Bus::where('driver_id', $driver->id)->first();
        $todayTrips = $this->getScheduledTrips(Carbon::today());

        return view('driver.dashboard', compact('personalInfo', 'assignedBus', 'todayTrips'));
    }

    public function getScheduledTrips(Carbon $date)
    {
        $driver = Auth::user();
        $assignedBus = $driver->bus;

        if (!$assignedBus) {
            return collect([]);
        }

        // جلب الرحلات مع عدد المقاعد المحجوزة
        return Trip::with(['route', 'bus'])
            ->withCount('bookings')
            ->where('bus_id', $assignedBus->id)
            ->whereDate('start_time', $date)
            ->get();
    }

    public function trips()
    {
        $todayTrips = $this->getScheduledTrips(Carbon::today());
        return view('driver.trips', compact('todayTrips'));
    }

    public function bus()
    {
        $driver = Auth::user();
        $assignedBus = Bus::where('driver_id', $driver->id)->first();
        return view('driver.bus', compact('assignedBus'));
    }

    public function checkSeatStatus(Trip $trip)
    {
        $bookedSeats = $trip->bookings()->count();
        $busCapacity = $trip->bus->capacity;
        $isFull = $bookedSeats >= $busCapacity;

        return [
            'booked' => $bookedSeats,
            'capacity' => $busCapacity,
            'status' => $isFull ? 'Seats Full' : 'Waiting For Seats',
            'readyToStart' => $isFull
        ];
    }

    public function startTrip(Trip $trip)
    {
        $seatStatus = $this->checkSeatStatus($trip);

        if ($seatStatus['readyToStart']) {
            $trip->status = 'STARTED';
            $trip->save();

            return redirect()->back()->with('success', 'تم بدء الرحلة بنجاح.');
        }

        return redirect()->back()->with('error', 'لا يمكن بدء الرحلة. المقاعد غير ممتلئة بعد.');
    }
}
