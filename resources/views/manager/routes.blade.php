<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Routes</title>
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
      background: rgba(2, 2, 2, 0.6);
    }
    .content {
      position: relative;
      z-index: 2;
      padding: 30px;
      color: #fff;
    }
    .avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      cursor: pointer;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
  <a href="{{ url()->previous() }}" class="btn btn-outline-light me-3">⬅ Back</a>
  <span class="navbar-brand">Manage Routes</span>
  <div class="dropdown ms-auto">
    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="avatar dropdown-toggle" id="menu" data-bs-toggle="dropdown">
    <ul class="dropdown-menu dropdown-menu-end">
      <li><h6 class="dropdown-header">Profile</h6></li>
      <li><span class="dropdown-item-text"><strong>Name:</strong> {{ Auth::user()->name }}</span></li>
      <li><span class="dropdown-item-text"><strong>Email:</strong> {{ Auth::user()->email }}</span></li>
      <li><hr class="dropdown-divider"></li>
      <li>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="dropdown-item text-danger">🚪 Logout</button>
        </form>
      </li>
    </ul>
  </div>
</nav>

<div class="content">
  <h2>Routes List</h2>
  <!-- Table -->
  <table class="table table-dark table-striped">
    <thead><tr><th>#</th><th>Name</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($routes as $route)
        <tr>
          <td>{{ $route->id }}</td>
          <td>{{ $route->name }}</td>
          <td>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <form action="#" method="POST" class="d-inline">@csrf @method('DELETE')
              <button class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
