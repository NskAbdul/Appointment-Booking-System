<x-layouts.dashboard>
    @include('patient.book.partials.header', ['step' => 1])
    <div class="card">
        <h3 class="h5 fw-bold mb-4">Patient Information</h3>
        <p class="text-muted">Please verify your information below.</p>
        <div class="row g-4 mt-3">
            <div class="col-md-6"><strong>Full Name</strong><p>{{ $patient->name }}</p></div>
            <div class="col-md-6"><strong>Email</strong><p>{{ $patient->email }}</p></div>
            <div class="col-md-6"><strong>Phone</strong><p>{{ $patient->phone_number }}</p></div>
            <div class="col-md-6"><strong>Date of Birth</strong><p>{{ \Carbon\Carbon::parse($patient->date_of_birth)->format('Y-m-d') }}</p></div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('patient.book.create.step.two') }}" class="btn btn-primary">Next →</a>
    </div>
</x-layouts.dashboard>