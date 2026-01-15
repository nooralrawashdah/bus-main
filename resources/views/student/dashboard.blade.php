@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5">Welcome back, {{ Auth::user()->name }}</h1>

    <div class="row g-4">
        <!-- Card 1: Reservations -->
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('student.reservations') }}" class="text-decoration-none">
                <div class="card text-center h-100 shadow-sm">
                    <div class="card-body">
                        <div style="font-size: 2.5rem;">📑</div>
                        <h5 class="card-title mt-3">My Reservations</h5>
                        <p class="card-text text-muted">View & Manage your bookings</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 2: Trips -->
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('student.trips') }}" class="text-decoration-none">
                <div class="card text-center h-100 shadow-sm">
                    <div class="card-body">
                        <div style="font-size: 2.5rem;">🗓️</div>
                        <h5 class="card-title mt-3">Available Trips</h5>
                        <p class="card-text text-muted">Browse upcoming trips</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 3: Buses & Seats -->


        <!-- Card 4: Profile -->
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('student.profile') }}" class="text-decoration-none">
                <div class="card text-center h-100 shadow-sm">
                    <div class="card-body">
                        <div style="font-size: 2.5rem;">👤</div>
                        <h5 class="card-title mt-3">My Profile</h5>
                        <p class="card-text text-muted">Edit info & region</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
