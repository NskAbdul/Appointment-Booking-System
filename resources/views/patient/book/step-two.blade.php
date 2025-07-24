<x-layouts.dashboard>
    @include('patient.book.partials.header', ['step' => 2])

    <form id="doctor-selection-form" method="POST" action="{{ route('patient.book.store.step.two') }}">
        @csrf
        <div class="card">
            <h3 class="h5 fw-bold mb-2">Select Doctor</h3>
            <p class="text-muted">Choose your preferred healthcare provider.</p>
            <div class="row g-3 mt-3">
                @foreach($doctors as $doctor)
                <div class="col-md-6">
                    <label class="d-block card-radio">
                        <input type="radio" name="doctor_id" value="{{ $doctor->id }}" class="d-none doctor-radio" required>
                        <div class="card card-body">
                            <h5 class="fw-bold">{{ $doctor->name }}</h5>
                            <p class="mb-1 fw-bold" style="color:#0066CC;">{{ $doctor->specialty }}</p>
                            <p class="text-muted small">{{ $doctor->department }}</p>
                            <p class="text-muted small">⭐ {{ $doctor->rating }} ({{ $doctor->experience_years }} years exp.)</p>
                        </div>
                    </label>
                </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('patient.book.create.step.one') }}" class="btn btn-secondary">← Back</a>
            <!-- Button is now disabled by default -->
            <button type="submit" id="next-btn" class="btn btn-primary" disabled>Next →</button>
        </div>
    </form>
    <style>.card-radio input:checked + .card { border-color: #0066CC; box-shadow: 0 0 0 2px #0066CC; }</style>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('doctor-selection-form');
            const nextButton = document.getElementById('next-btn');

            // Listen for changes on the radio buttons within the form
            form.addEventListener('change', function(event) {
                if (event.target.name === 'doctor_id') {
                    // If a doctor radio button is selected, enable the next button
                    nextButton.disabled = false;
                }
            });
        });
    </script>
    @endpush
</x-layouts.dashboard>