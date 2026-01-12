@extends('layouts.app')
@section('content')
<style>
    body {
        background: url('https://images.pexels.com/photos/15595485/pexels-photo-15595485.jpeg') no-repeat center center fixed;
        background-size: cover;
    }
    body::before {
        content: "";
        position: absolute;
        top:0; left:0; right:0; bottom:0;
        background: rgba(0,0,0,0.6);
    }
    .content {
        position: relative;
        z-index: 2;
        padding: 40px;
        text-align: center;
    }
    .trip-card {
        background: rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 20px;
        margin: 15px;
        color: #fff;
        flex: 1;
        min-width: 280px;
        transition: transform 0.3s;
    }
    .trip-card:hover { transform: scale(1.05); }
    .trip-status {
        font-weight: bold;
        padding: 8px 12px;
        border-radius: 50px;
        display: inline-block;
        margin-top: 10px;
    }
    .status-pending { background-color: #0d6efd; }
    .status-started { background-color: #198754; }
    .status-cancelled { background-color: #dc3545; }
    .btn-start {
        border-radius: 50px;
        font-size: 1.1rem;
        padding: 10px 20px;
    }
    .seats-badge {
        background-color: rgba(0,0,0,0.5);
        padding: 6px 12px;
        border-radius: 12px;
        display: inline-block;
        margin-top: 8px;
        font-weight: bold;
    }
    .back-arrow {
        position: absolute;
        top: 20px;
        left: 20px;
        font-size: 2rem;
        color: #fff;
        text-decoration: none;
        transition: transform 0.2s;
    }
    .back-arrow:hover {
        transform: scale(1.2);
        color: #0d6efd;
    }
</style>

<div class="content">
    <!-- سهم الرجوع -->
    <a href="{{ url()->previous() }}" class="back-arrow">&larr;</a>

    <h2 class="text-white mb-4">Today's Trips</h2>

    <div class="d-flex flex-wrap justify-content-center">
        @foreach($todayTrips as $trip)
            <div class="trip-card">
                <h4>Trip #{{ $trip->id }}</h4>
                <p><strong>Route:</strong> {{ $trip->route->name ?? 'N/A' }}</p>
                <p><strong>Start:</strong> {{ $trip->start_time }}</p>
                <p><strong>End:</strong> {{ $trip->end_time }}</p>

                <!-- عداد المقاعد -->
                <span class="seats-badge">
                    Seats: {{ $trip->bookings_count ?? 0 }} / {{ $trip->bus->capacity ?? 'N/A' }}
                </span>

                <!-- زر بدء الرحلة أو الحالة -->
                @if($trip->status == 'PENDING')
                    <form method="POST" action="{{ route('driver.startTrip', $trip->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-success btn-start mt-3">Start Trip</button>
                    </form>
                @else
                    <span class="trip-status
                        @if($trip->status == 'STARTED') status-started
                        @elseif($trip->status == 'CANCELLED') status-cancelled
                        @else status-pending @endif">
                        {{ $trip->status }}
                    </span>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
