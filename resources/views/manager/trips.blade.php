<div class="content">
  <h2>Trips List</h2>
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
  @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

  <table class="table table-dark table-striped">
    <thead><tr><th>#</th><th>Route</th><th>Bus</th><th>Start</th><th>End</th><th>Status</th></tr></thead>
    <tbody>
      @foreach($trips as $trip)
        <tr>
          <td>{{ $trip->id }}</td>
          <td>{{ $trip->route->name }}</td>
          <td>{{ $trip->bus->plate_number }}</td>
          <td>{{ $trip->start_time }}</td>
          <td>{{ $trip->end_time }}</td>
          <td>{{ $trip->status }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Add new trip -->
  <form method="POST" action="{{ route('manager.trips.create') }}" class="mt-4">
    @csrf
    <div class="mb-3">
      <label class="form-label text-white">Route</label>
      <select class="form-select" name="route_id">@foreach($routes as $route)<option value="{{ $route->id }}">{{ $route->name }}</option>@endforeach</select>
    </div>
    <div class="mb-3">
      <label class="form-label text-white">Bus</label>
      <select class="form-select" name="bus_id">@foreach($buses as $bus)<option value="{{ $bus->id }}">{{ $bus->plate_number }}</option>@endforeach</select>
    </div>
    <div class="mb-3">
      <label class="form-label text-white">Start Time</label>
      <input type="datetime-local" class="form-control" name="start_time" required>
    </div>
    <div class="mb-3">
      <label class="form-label text-white">End Time</label>
      <input type="datetime-local" class="form-control" name="end_time" required>
    </div>
    <div class="mb-3">
      <label class="form-label text-white">Status</label>
      <select class="form-select" name="status">
        <option value="SCHEDULED">Scheduled</option>
        <option value="CANCELLED">Cancelled</option>
      </select>
    </div>
    <button type="submit" class="btn btn-success">Add Trip</button>
  </form>
</div>
