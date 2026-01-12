<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manager Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('https://images.pexels.com/photos/34963352/pexels-photo-34963352.jpeg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
      height: 100vh;
      margin: 0;
    }
    body::before {
      content: "";
      position: absolute;
      top:0; left:0; right:0; bottom:0;
      background: rgba(2, 2, 2, 0.6); /* طبقة معتمة فوق الخلفية */
    }
    .content {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: calc(100vh - 80px);
      text-align: center;
    }
    .avatar {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      cursor: pointer;
    }
    .btn-custom {
      width: 220px;
      margin: 15px 0;
      font-weight: bold;
      border-radius: 50px; /* أزرار دائرية */
      font-size: 1.2rem;   /* حجم أكبر */
      padding: 12px 20px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark px-3">
  <a class="navbar-brand" href="#">Bus System - Manager</a>
  <div class="dropdown">
    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Manager Avatar" class="avatar dropdown-toggle" id="managerMenu" data-bs-toggle="dropdown" aria-expanded="false">
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="managerMenu">
      <li><h6 class="dropdown-header">Profile</h6></li>
      <li><span class="dropdown-item-text"><strong>Name:</strong> {{ Auth::user()->name }}</span></li>
      <li><span class="dropdown-item-text"><strong>Email:</strong> {{ Auth::user()->email }}</span></li>
      <li><span class="dropdown-item-text"><strong>Phone:</strong> {{ Auth::user()->phone_number }}</span></li>
      <li><hr class="dropdown-divider"></li>
      <!-- Logout -->
      <li>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="dropdown-item text-danger">🚪 Logout</button>
        </form>
      </li>
    </ul>
  </div>
</nav>

<!-- Content -->
<div class="content">
  <a href="{{ route('manager.routes') }}" class="btn btn-primary btn-custom">🛣️ Manage Routes</a>
  <a href="{{ route('manager.buses') }}" class="btn btn-success btn-custom">🚌 Manage Buses</a>
  <a href="{{ route('manager.trips') }}" class="btn btn-warning btn-custom">📅 Manage Trips</a>
  <a href="{{ route('manager.drivers') }}" class="btn btn-info btn-custom">👨‍✈️ Manage Drivers</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
