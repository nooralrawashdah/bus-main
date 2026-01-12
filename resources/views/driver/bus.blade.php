@extends('layouts.app')
@section('content')
<style>
    body {
        background: url('https://images.pexels.com/photos/3796308/pexels-photo-3796308.jpeg') no-repeat center center fixed;
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
    .bus-card {
        background: rgba(76, 241, 6, 0.1);
        border-radius: 20px;
        padding: 20px;
        color: #fff;
        max-width: 500px;
        margin: auto;
    }
    .bus-card img {
        width: 100px;
        margin-bottom: 15px;
    }
    .btn-view {
        border-radius: 50px;
        font-size: 1.1rem;
        padding: 10px 20px;
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

    <h2 class="text-white mb-4">Bus Information</h2>

    @if($assignedBus)
        <div class="bus-card">
            <!-- صورة أيقونة للباص -->
            <img src="https://cdn-icons-png.flaticon.com/512/422/422962.png" alt="Bus Icon">

            <!-- معلومات الباص -->
            <p><strong>Number Bus:</strong> {{ $assignedBus->id }}</p>
            <p><strong>Plate:</strong> {{ $assignedBus->plate_number }}</p>
            <p><strong>Capacity:</strong> {{ $assignedBus->capacity }}</p>

            <!-- زر عرض الرحلات -->
            <a href="{{ route('driver.trips') }}" class="btn btn-primary btn-view mt-3">View Trips</a>
        </div>
    @else
        <p class="text-white">No bus assigned.</p>
    @endif
</div>
@endsection
