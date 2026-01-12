<div class="content">
  <h2>Buses List</h2>
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

  <table class="table table-dark table-striped">
    <thead><tr><th>#</th><th>Plate Number</th><th>Capacity</th><th>Driver</th></tr></thead>
    <tbody>
      @foreach($buses as $bus)
        <tr>
          <td>{{ $bus->id }}</td>
          <td>{{ $bus->plate_number }}</td>
          <td>{{ $bus->capacity }}</td>
          <td>{{ $bus->driver ? $bus->driver->name : 'Unassigned' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Add new bus -->
  <form method="POST" action="{{ route('manager.buses.create') }}" class="mt-4">
    @csrf
    <div class="mb-3">
      <label class="form-label text-white">Plate Number</label>
      <input type="text" class="form-control" name="plate_number" required>
    </div>
    <div class="mb-3">
      <label class="form-label text-white">Capacity</label>
      <input type="number" class="form-control" name="capacity" required>
    </div>
    <button type="submit" class="btn btn-success">Add Bus</button>
  </form>
</div>
