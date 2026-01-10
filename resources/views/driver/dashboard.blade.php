@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Driver Dashboard - Bus System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .driver-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            margin-top: 30px;
            padding: 30px;
        }
        .header-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .action-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
            margin-bottom: 20px;
            height: 100%;
        }
        .action-card:hover {
            transform: translateY(-5px);
        }
        .driver-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
        }
        .status-badge {
            font-size: 0.8rem;
            padding: 5px 10px;
        }
        .bus-icon {
            font-size: 3rem;
            color: #667eea;
        }
        .driver-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            transition: all 0.3s;
            width: 100%;
        }
        .driver-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .trip-status {
            background: #e8f4fd;
            border-left: 4px solid #3498db;
            padding: 15px;
            border-radius: 5px;
        }
        .seats-display {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Main Card (مثل Manager) -->
                <div class="driver-card">
                    <!-- Header (مثل Manager) -->
                    <div class="header-section text-center">
                        <h1><i class="fas fa-user-tie"></i> Driver Dashboard</h1>
                        <p class="mb-0">Welcome back, Ahmed Driver</p>
                        <small><i class="fas fa-bus"></i> Assigned Bus: BUS-101 | <i class="fas fa-clock"></i> Last Login: Today 08:30 AM</small>
                    </div>

                    <!-- Driver Info & Bus Status -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="driver-info">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5><i class="fas fa-id-card"></i> Driver Information</h5>
                                        <p class="mb-1"><strong>Name:</strong> Ahmed Mohammed</p>
                                        <p class="mb-1"><strong>License:</strong> DRV-2023-001</p>
                                        <p class="mb-1"><strong>Experience:</strong> 5 years</p>
                                        <p class="mb-0"><strong>Rating:</strong> ⭐⭐⭐⭐⭐ (4.8)</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5><i class="fas fa-bus"></i> Bus Information</h5>
                                        <p class="mb-1"><strong>Bus Number:</strong> BUS-101</p>
                                        <p class="mb-1"><strong>Capacity:</strong> 45 seats</p>
                                        <p class="mb-1"><strong>Type:</strong> Mercedes Coach</p>
                                        <p class="mb-0"><strong>Status:</strong> <span class="badge bg-success status-badge">Ready</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="trip-status">
                                <h5><i class="fas fa-road"></i> Current Trip Status</h5>
                                <div class="text-center my-3">
                                    <div class="seats-display">{{ $seats_booked ?? 45 }}/45</div>
                                    <small>Seats Booked</small>
                                </div>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar
                                        {{ ($seats_booked ?? 45) >= 45 ? 'bg-success' : 'bg-warning' }}"
                                        style="width: {{ (($seats_booked ?? 45) / 45) * 100 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Cards (مثل Manager Dashboard) -->
                    <h4 class="mb-3"><i class="fas fa-bolt text-warning"></i> Quick Actions</h4>
                    <div class="row mb-4">
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card action-card">
                                <div class="card-body text-center">
                                    <div class="bus-icon">🚌</div>
                                    <h5>View Bus</h5>
                                    <p>Check bus details</p>
                                    <button class="btn driver-btn">View</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card action-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-route fa-3x text-primary mb-3"></i>
                                    <h5>My Route</h5>
                                    <p>View assigned route</p>
                                    <button class="btn driver-btn">View Route</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card action-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-chair fa-3x text-success mb-3"></i>
                                    <h5>Seats Map</h5>
                                    <p>Check booked seats</p>
                                    <button class="btn driver-btn">View Seats</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card action-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-calendar-alt fa-3x text-info mb-3"></i>
                                    <h5>Schedule</h5>
                                    <p>Trip timetable</p>
                                    <button class="btn driver-btn">View Schedule</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trip Control Section -->
                    <div class="row mt-4">
                        <div class="col-md-8">
                            <!-- Trip Details Table -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-list-alt"></i> Today's Trips</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Trip</th>
                                                <th>Route</th>
                                                <th>Time</th>
                                                <th>Seats</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Trip #101</td>
                                                <td>City Center → University</td>
                                                <td>08:00 AM</td>
                                                <td>45/45</td>
                                                <td>
                                                    @if(($seats_booked ?? 45) >= 45 && !($trip_started ?? false))
                                                        <span class="badge bg-success">Ready</span>
                                                    @elseif($trip_started ?? false)
                                                        <span class="badge bg-info">In Progress</span>
                                                    @else
                                                        <span class="badge bg-warning">Waiting</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Trip #102</td>
                                                <td>University → Mall</td>
                                                <td>02:00 PM</td>
                                                <td>30/45</td>
                                                <td><span class="badge bg-secondary">Upcoming</span></td>
                                            </tr>
                                            <tr>
                                                <td>Trip #103</td>
                                                <td>Mall → Airport</td>
                                                <td>06:00 PM</td>
                                                <td>15/45</td>
                                                <td><span class="badge bg-secondary">Upcoming</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Trip Control Panel -->
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="fas fa-play-circle"></i> Trip Control</h5>
                                </div>
                                <div class="card-body text-center">
                                    <!-- زر Start Trip (يظهر فقط إذا الباص كامل) -->
                                    @if(($seats_booked ?? 45) >= 45 && !($trip_started ?? false))
                                        <button class="btn btn-success btn-lg w-100 mb-3" id="startTripBtn">
                                            <i class="fas fa-play"></i> START TRIP
                                        </button>
                                        <div class="alert alert-success">
                                            <i class="fas fa-check-circle"></i> Bus is fully booked and ready!
                                        </div>
                                    @elseif($trip_started ?? false)
                                        <button class="btn btn-info btn-lg w-100 mb-3" disabled>
                                            <i class="fas fa-spinner fa-spin"></i> TRIP IN PROGRESS
                                        </button>
                                        <button class="btn btn-danger btn-lg w-100" id="endTripBtn">
                                            <i class="fas fa-stop"></i> END TRIP
                                        </button>
                                    @else
                                        <button class="btn btn-secondary btn-lg w-100 mb-3" disabled>
                                            <i class="fas fa-clock"></i> WAITING FOR FULL BUS
                                        </button>
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Need {{ 45 - ($seats_booked ?? 45) }} more seats
                                        </div>
                                    @endif

                                    <!-- Quick Stats -->
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <div class="p-3 bg-light rounded">
                                                <h4 class="mb-0">{{ $seats_booked ?? 45 }}</h4>
                                                <small>Booked</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="p-3 bg-light rounded">
                                                <h4 class="mb-0">{{ 45 - ($seats_booked ?? 45) }}</h4>
                                                <small>Available</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Emergency -->
                            <div class="card mt-3">
                                <div class="card-body text-center">
                                    <button class="btn btn-outline-danger w-100">
                                        <i class="fas fa-exclamation-triangle"></i> Emergency
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer (مثل Manager) -->
                    <div class="text-center text-muted mt-4">
                        <p>Bus Management System © 2023 | Driver Interface</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- نفس Scripts الـManager -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // نفس التفاعلية
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Driver Dashboard loaded!');

            // Start Trip Button
            document.getElementById('startTripBtn')?.addEventListener('click', function() {
                if (confirm('Start trip with 45 passengers?')) {
                    alert('Trip started successfully!');
                    // هنا كود AJAX لبدء الرحلة
                }
            });

            // End Trip Button
            document.getElementById('endTripBtn')?.addEventListener('click', function() {
                if (confirm('End current trip?')) {
                    alert('Trip ended successfully!');
                    // هنا كود AJAX لإنهاء الرحلة
                }
            });

            // Action Buttons
            document.querySelectorAll('.driver-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const action = this.closest('.card').querySelector('h5').textContent;
                    alert(`Opening: ${action}`);
                });
            });
        });
    </script>
</body>
</html>
@endsection
