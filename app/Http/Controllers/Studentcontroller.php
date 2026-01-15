<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use App\Models\Trip;
use App\Models\Bus;
use App\Models\BusSeat;
use App\Models\Booking;
use Illuminate\Http\Request;

class Studentcontroller extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $student = auth()->user();
        $reservations = Booking::where('user_id', $student->id)
            ->with(['trip.route', 'trip.bus', 'seat'])
            ->orderBy('created_at', 'desc') //بجيب معلومات الحجز بالترتيب تنازلي 
            ->get();

        $trips = Trip::whereHas('route', function($q) use ($student) {
            $q->where('region_id', $student->region_id);
        })->with('route')->get();

        return view('student.dashboard', compact('student', 'reservations', 'trips'));
    }

    // عرض الرحلات حسب المنطقة
    public function trips()
    {
        $student = auth()->user();
        $trips = Trip::whereHas('route', function($q) use ($student) {
            $q->where('region_id', $student->region_id);
        })->with(['route', 'bus'])->get();

        return view('student.trips', compact('trips'));
    }

    // عرض الباصات لرحلة معينة (مع إخفاء الباصات الممتلئة)
    public function buses($tripId)
    {
        $trip = Trip::with('bus')->findOrFail($tripId);

        // جلب الباصات المرتبطة بالرحلة
        $buses = Bus::where('id', $trip->bus_id)
            ->withCount(['seats as reserved_seats' => function($q) use ($tripId) {
                $q->whereHas('bookings', function($q2) use ($tripId) {
                    $q2->where('trip_id', $tripId);
                });
            }])
            ->get()
            ->filter(function($bus) {
                return $bus->reserved_seats < $bus->capacity; // إخفاء الباصات الممتلئة
            });

        return view('student.buses', compact('trip', 'buses'));
    }

    // عرض المقاعد لباص معين
    public function seats($tripId, $busId)
    {
        $trip = Trip::findOrFail($tripId);
        $bus = Bus::findOrFail($busId);

        $seats = BusSeat::where('bus_id', $busId)->get();

        return view('student.seats', compact('trip', 'bus', 'seats'));
    }

    // حجز مقعد
    public function reserveSeat(Request $request, $tripId, $seatId)
    {
        $student = auth()->user();

        // تحقق إذا عنده حجز مسبق بنفس الرحلة
        $existing = Booking::where('user_id', $student->id)
            ->where('trip_id', $tripId)
            ->exists();

        if ($existing) {
            return back()->with('error', 'You already have a reservation for this trip.');
        }

        // تحقق إذا المقعد محجوز
        $reserved = Booking::where('trip_id', $tripId)
            ->where('bus_seat_id', $seatId)
            ->exists();

        if ($reserved) {
            return back()->with('error', 'This seat is already reserved.');
        }

        Booking::create([
            'user_id' => $student->id,
            'trip_id' => $tripId,
            'bus_seat_id' => $seatId,
        ]);

        return back()->with('success', 'Seat reserved successfully!');
    }

    // تعديل الحجز
    public function editReservation(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $student = auth()->user();

        if ($booking->user_id != $student->id) {
            abort(403, 'Unauthorized');
        }

        $booking->update([
            'bus_seat_id' => $request->seat_id,
        ]);

        return redirect()->route('student.reservations')->with('success', 'Reservation updated successfully.');
    }

    // إلغاء الحجز
    public function cancelReservation($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $student = auth()->user();

        if ($booking->user_id != $student->id) {
            abort(403, 'Unauthorized');
        }

        $booking->delete();

        return redirect()->route('student.reservations')->with('success', 'Reservation cancelled.');
    }

    // تعديل المنطقة/العنوان
    public function updateProfile(Request $request)
    {
        $student = auth()->user();

        $validated = $request->validate([
            'region_id' => 'required|exists:regions,id',
        ]);

        $student->update($validated);

        return redirect()->route('student.profile')->with('success', 'Profile updated successfully.');
    }

    // صفحة البروفايل
    public function profile()
    {
        $student = auth()->user();
        $regions = Region::all();

        return view('student.profile', compact('student', 'regions'));
    }
}

