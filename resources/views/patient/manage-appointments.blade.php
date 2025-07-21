<x-layouts.dashboard>
    <header class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 fw-bold">Manage Appointments</h2>
        <a href="{{ route('book.create.step.one') }}" class="btn btn-primary">+ Book Appointment</a>
    </header>

    <!-- NEW ADVANCED FILTER BAR -->
    <div class="card mb-4">
        <form action="{{ route('appointments.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search by doctor or specialty..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="all" @selected(request('status') == 'all')>All Statuses</option>
                        <option value="scheduled" @selected(request('status') == 'scheduled')>Scheduled</option>
                        <option value="confirmed" @selected(request('status') == 'confirmed')>Confirmed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="date_range" class="form-label">Date Range</label>
                    <select name="date_range" id="date_range" class="form-select">
                        <option value="all" @selected(request('date_range') == 'all')>All Dates</option>
                        <option value="today" @selected(request('date_range') == 'today')>Today</option>
                        <option value="upcoming" @selected(request('date_range') == 'upcoming')>Upcoming</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                    <a href="{{ route('appointments.index') }}" class="btn btn-light w-100 mt-2">Clear</a>
                </div>
            </div>
        </form>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <!-- Appointments List -->
    @forelse ($appointments as $appointment)
        <div class="card" x-data="{ isEditing: false }">
            <!-- Edit View -->
            <div x-show="isEditing" x-cloak>
                <h5 class="fw-bold mb-3">Edit Appointment</h5>
                <form action="{{ route('appointments.update', $appointment) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="appointment_date_{{ $appointment->id }}" class="form-label">Appointment Date & Time</label>
                            <input type="datetime-local" class="form-control" name="appointment_date" id="appointment_date_{{ $appointment->id }}" value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d\TH:i') }}">
                        </div>
                        <div class="col-12">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                        <button type="button" @click="isEditing = false" class="btn btn-secondary btn-sm">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Default View -->
            <div x-show="!isEditing">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="badge rounded-pill 
                            @if($appointment->status == 'scheduled') bg-warning-subtle text-warning-emphasis 
                            @else bg-info-subtle text-info-emphasis @endif
                        text-capitalize">{{ $appointment->status }}</span>
                        <span class="text-muted ms-2">ID: {{ $appointment->id }}</span>
                    </div>
                     @if ($appointment->status === 'scheduled' || $appointment->status === 'confirmed')
                    <div>
                        <button @click="isEditing = true" class="btn btn-outline-primary btn-sm">Edit</button>
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">Cancel</button>
                        </form>
                    </div>
                    @endif
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4"><p class="mb-1 text-muted small">Doctor</p><h6 class="fw-bold">{{ $appointment->doctor_name }}</h6><p class="text-muted">{{ $appointment->doctor_specialty }}</p></div>
                    <div class="col-md-4"><p class="mb-1 text-muted small">Date</p><h6 class="fw-bold">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</h6></div>
                    <div class="col-md-4"><p class="mb-1 text-muted small">Time</p><h6 class="fw-bold">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}</h6></div>
                </div>
            </div>
        </div>
    @empty
        <div class="card text-center">
            <p class="text-muted mb-0">No active appointments match your filters.</p>
        </div>
    @endforelse
    <style> [x-cloak] { display: none !important; } </style>
</x-layouts.dashboard>