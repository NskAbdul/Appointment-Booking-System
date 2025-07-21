<x-layouts.dashboard>
    <h2 class="h3 fw-bold mb-4">Dashboard</h2>

    <div class="row g-4 mb-4">
        <div class="col-md-3"><div class="card"><h5>Total Appointments</h5><p class="fs-2 fw-bold">{{ $stats['total'] }}</p></div></div>
        <div class="col-md-3"><div class="card"><h5>Upcoming</h5><p class="fs-2 fw-bold text-warning">{{ $stats['upcoming'] }}</p></div></div>
        <div class="col-md-3"><div class="card"><h5>Completed</h5><p class="fs-2 fw-bold text-success">{{ $stats['completed'] }}</p></div></div>
        <div class="col-md-3"><div class="card"><h5>Cancelled</h5><p class="fs-2 fw-bold text-danger">{{ $stats['cancelled'] }}</p></div></div>
    </div>

    <h3 class="h4 fw-bold mb-3">Upcoming Appointments</h3>
    <div class="card p-0">
        <ul class="list-group list-group-flush">
             @forelse($upcomingAppointments as $appointment)
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $appointment->doctor_name }}</h5>
                        <p class="text-muted mb-1">{{ $appointment->doctor_specialty }}</p>
                        <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill text-capitalize">{{ $appointment->status }}</span>
                        <span class="ms-2 text-muted">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d \a\t h:i A') }}</span>
                    </div>
                    <a href="#" class="btn btn-outline-primary"
                            data-bs-toggle="modal" 
                            data-bs-target="#appointmentDetailModal"
                            data-status="{{ ucfirst($appointment->status) }}"
                            data-date="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}"
                            data-time="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}"
                            data-doctor="{{ $appointment->doctor_name }}"
                            data-specialty="{{ $appointment->doctor_specialty }}"
                            data-patient="{{ $user->name }}"
                            data-id="{{ $appointment->id }}">
                        View Details
                    </a>
                </li>
            @empty
                <li class="list-group-item p-3 text-center">
                     <p class="text-muted mb-0">You have no upcoming appointments.</p>
                </li>
            @endforelse
        </ul>
    </div>

    <div class="modal fade" id="appointmentDetailModal" tabindex="-1" aria-labelledby="appointmentDetailModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="appointmentDetailModalLabel">Appointment Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-4">
                <span id="modal-status" class="badge bg-warning-subtle text-warning-emphasis rounded-pill"></span>
                <p class="mt-2 text-muted">Your appointment has been scheduled and is awaiting doctor confirmation.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6"><strong>Date:</strong> <span id="modal-date"></span></div>
                <div class="col-md-6"><strong>Patient:</strong> <span id="modal-patient"></span></div>
                <div class="col-md-6"><strong>Time:</strong> <span id="modal-time"></span></div>
                <div class="col-md-6"><strong>Department:</strong> <span id="modal-department"></span></div>
                <div class="col-md-6"><strong>Doctor:</strong> <span id="modal-doctor"></span></div>
                <div class="col-md-6"><strong>Appointment ID:</strong> <span id="modal-id"></span></div>
                <div class="col-md-6"><strong>Specialty:</strong> <span id="modal-specialty"></span></div>
            </div>
            <div class="mt-4 p-3 rounded" style="background-color: #f8f9fa;">
                <h6 class="fw-bold">Contact Information</h6>
                <p class="small text-muted mb-0">For any questions or changes to your appointment:</p>
                <ul class="list-unstyled small mt-2">
                    <li><strong>Phone:</strong> (555) 123-4567</li>
                    <li><strong>Email:</strong> appointments@healthcareplus.com</li>
                </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    @push('scripts')
    <script>
        // This script populates the modal with data right before it's shown
        const appointmentDetailModal = document.getElementById('appointmentDetailModal');
        if(appointmentDetailModal) {
            appointmentDetailModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                const status = button.getAttribute('data-status');
                const date = button.getAttribute('data-date');
                const time = button.getAttribute('data-time');
                const doctor = button.getAttribute('data-doctor');
                const specialty = button.getAttribute('data-specialty');
                const patient = button.getAttribute('data-patient');
                const id = button.getAttribute('data-id');

                let department = 'Not specified';
                if (specialty === 'Cardiology') department = 'Internal Medicine';
                if (specialty === 'Orthopedics') department = 'Surgery';

                const modal = event.target;
                modal.querySelector('#modal-status').textContent = status;
                modal.querySelector('#modal-date').textContent = date;
                modal.querySelector('#modal-time').textContent = time;
                modal.querySelector('#modal-doctor').textContent = doctor;
                modal.querySelector('#modal-specialty').textContent = specialty;
                modal.querySelector('#modal-patient').textContent = patient;
                modal.querySelector('#modal-department').textContent = department;
                modal.querySelector('#modal-id').textContent = id;
            });
        }
    </script>
    @endpush
</x-layouts.dashboard>