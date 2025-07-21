<x-layouts.doctor>
    <div x-data="{ isEditing: false }">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold">My Profile</h2>
            <button x-show="!isEditing" @click="isEditing = true" class="btn btn-primary">Edit Profile</button>
        </header>

        <!-- Profile View/Edit Card -->
        <div class="card">
            <h3 x-show="isEditing" class="h5 fw-bold mb-4">Edit Profile</h3>
            <h3 x-show="!isEditing" class="h5 fw-bold mb-4">Personal & Professional Information</h3>

            <!-- Timed Success Message -->
            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-cloak
                     class="alert alert-success" role="alert">
                    Profile updated successfully.
                </div>
            @endif
            
            <!-- Read-Only View -->
            <div x-show="!isEditing" class="row g-4">
                <div class="col-md-6"><strong>Full Name</strong><p>{{ $user->name }}</p></div>
                <div class="col-md-6"><strong>Email Address</strong><p>{{ $user->email }}</p></div>
                <div class="col-md-6"><strong>Phone Number</strong><p>{{ $user->phone_number }}</p></div>
                <div class="col-md-6"><strong>Date of Birth</strong><p>{{ \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') }}</p></div>
                <div class="col-12"><strong>Address</strong><p>{{ $user->address }}</p></div>
                <hr>
                <div class="col-md-6"><strong>Specialty</strong><p>{{ $user->specialty }}</p></div>
                <div class="col-md-6"><strong>License Number</strong><p>{{ $user->license_number }}</p></div>
                <div class="col-md-6"><strong>Years of Experience</strong><p>{{ $user->experience_years }}</p></div>
            </div>

            <!-- Edit Form -->
            <form x-show="isEditing" x-cloak method="post" action="{{ route('doctor.profile.update') }}">
                @csrf
                @method('PATCH')
                <div class="row g-3">
                    <div class="col-md-6"><label for="name" class="form-label">Full Name</label><input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required></div>
                    <div class="col-md-6"><label for="email" class="form-label">Email Address</label><input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required></div>
                    <div class="col-md-6"><label for="phone_number" class="form-label">Phone Number</label><input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}" required></div>
                    <div class="col-md-6"><label for="date_of_birth" class="form-label">Date of Birth</label><input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth', $user->date_of_birth) }}" required></div>
                    <div class="col-12"><label for="address" class="form-label">Address</label><input type="text" name="address" id="address" class="form-control" value="{{ old('address', $user->address) }}" required></div>
                    <hr>
                    <div class="col-md-6"><label for="specialty" class="form-label">Specialty</label><input type="text" name="specialty" id="specialty" class="form-control" value="{{ old('specialty', $user->specialty) }}" required></div>
                    <div class="col-md-6"><label for="license_number" class="form-label">License Number</label><input type="text" name="license_number" id="license_number" class="form-control" value="{{ old('license_number', $user->license_number) }}" required></div>
                    <div class="col-md-6"><label for="experience_years" class="form-label">Years of Experience</label><input type="number" name="experience_years" id="experience_years" class="form-control" value="{{ old('experience_years', $user->experience_years) }}" required></div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" @click="isEditing = false" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
        <style>[x-cloak] { display: none !important; }</style>
    </div>
</x-layouts.doctor>
