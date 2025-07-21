<x-layouts.dashboard>
    <h2 class="h3 fw-bold mb-4">Appointment History</h2>
    @forelse ($appointments as $appointment)
        <div class="card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="badge rounded-pill 
                        @if($appointment->status == 'completed') bg-success-subtle text-success-emphasis 
                        @else bg-danger-subtle text-danger-emphasis @endif
                    text-capitalize">{{ $appointment->status }}</span>
                    <span class="text-muted ms-2">ID: {{ $appointment->id }}</span>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4"><p class="mb-1 text-muted small">Doctor</p><h6 class="fw-bold">{{ $appointment->doctor_name }}</h6></div>
                <div class="col-md-4"><p class="mb-1 text-muted small">Date</p><h6 class="fw-bold">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</h6></div>
                <div class="col-md-4"><p class="mb-1 text-muted small">Time</p><h6 class="fw-bold">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}</h6></div>
            </div>
        </div>
    @empty
        <div class="card text-center"><p class="text-muted mb-0">You have no past appointments.</p></div>
    @endforelse
</x-layouts.dashboard>