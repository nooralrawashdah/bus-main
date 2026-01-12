<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Bus;
use App\Models\Trip;
use App\Models\Driver;
use App\Models\Booking;
use App\Models\Student;

class ManagerController extends Controller
{

    public function __construct()
    {
        // Requires a role management
        $this->middleware('role:admin');
    }



    public function index()
    {

        $stats = [
            'total_routes' => Route::count(),
            'total_buses' => Bus::count(),
            'total_drivers' => Driver::count(),
            'total_students' => Student::count(),
            'active_trips' => Trip::where('status', 'STARTED')->count(),
        ];
        return view('manager.mdashboard', compact('stats'));
    }

    // -------------------------------------------------------------------
    // II. Routes Management (CRUD)
    // -------------------------------------------------------------------

    public function viewRoutes()
    {
        $routes = Route::all();
        return view('manager.routes', compact('routes'));
    }

    public function createRoute(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:routes,name',
        ]);

        Route::create($validated);
        return redirect()->route('manager.routes')->with('success', 'Route added successfully.');
    }

    public function updateRoute(Request $request, Route $route)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:routes,name,' . $route->id,
        ]);

        $route->update($validated);
        return redirect()->route('manager.routes')->with('success', 'Route updated successfully.');
    }

    public function deleteRoute(Route $route)
    {
        // Check if there are any trips associated before deletion
        if ($route->trips()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete route. Trips are currently associated with it.');
        }
        $route->delete();
        return redirect()->route('manager.routes')->with('success', 'Route deleted successfully.');
    }

    // -------------------------------------------------------------------
    // III. Buses Management (CRUD)
    // -------------------------------------------------------------------

    public function viewBuses()
    {
        // Fetch buses along with their assigned driver information
        $buses = Bus::with('driver')->get();
        return view('manager.buses', compact('buses'));
    }

    public function createBus(Request $request)
    {
        $validated = $request->validate([
            'plate_number' => 'required|string|max:50|unique:buses,plate_number',
            'capacity' => 'required|integer|min:10',
        ]);

        Bus::create($validated);
        return redirect()->route('manager.buses')->with('success', 'Bus added successfully.');
    }



    // -------------------------------------------------------------------
    // IV. Trips Management (CRUD)
    // -------------------------------------------------------------------

    public function viewTrips()
    {
        // Fetch trips along with route and bus details
        $trips = Trip::with(['route', 'bus'])->get();
        return view('manager.trips', compact('trips'));
    }

    public function createTrip(Request $request)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'bus_id' => 'required|exists:buses,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|in:SCHEDULED,CANCELLED', // Initial state
        ]);

        // Check for time conflicts for the assigned bus
        $conflict = Trip::where('bus_id', $validated['bus_id'])
                        ->where(function ($query) use ($validated) {
                            $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                                  ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']]);
                        })->exists();

        if ($conflict) {
            return redirect()->back()->with('error', 'Time conflict detected. The assigned bus is busy during this period.');
        }

        Trip::create($validated);
        return redirect()->route('manager.trips')->with('success', 'Trip scheduled successfully.');
    }


    // -------------------------------------------------------------------
    // V. Driver Management and Bus Assignment
    // -------------------------------------------------------------------

    public function viewDrivers()
    {
        // Fetch drivers (from the Driver table) along with their assigned bus
        $drivers = Driver::with('bus')->get();
        $availableBuses = Bus::whereNull('driver_id')->get(); // Buses not currently assigned

        return view('manager.drivers', compact('drivers', 'availableBuses'));
    }


    public function assignBusToDriver(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            // bus_id is nullable (to allow for unassignment)
            // It must exist if provided, and must not be assigned to another driver if provided
            'bus_id' => 'nullable|exists:buses,id',
        ]);

        // 1. Unassign any previously assigned bus from THIS driver (by setting driver_id to null)
        Bus::where('driver_id', $driver->id)->update(['driver_id' => null]);

        if ($request->filled('bus_id')) {
            // 2. Assign the NEW bus to the driver
            $bus = Bus::findOrFail($validated['bus_id']);

            // Check if the chosen bus is already assigned to someone else
            if ($bus->driver_id !== null && $bus->driver_id !== $driver->id) {
                 return redirect()->back()->with('error', 'This bus is already assigned to another driver.');
            }

            $bus->driver_id = $driver->id;
            $bus->save();
            $message = 'Bus assigned successfully.';
        } else {
            $message = 'Bus unassigned from the driver successfully.';
        }

        return redirect()->route('manager.drivers')->with('success', $message);
    }




}
