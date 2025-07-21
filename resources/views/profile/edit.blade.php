<x-layouts.dashboard>
    <div x-data="{ isEditing: false, showStatus: {{ session('status') === 'profile-updated' ? 'true' : 'false' }} }" x-init="if(showStatus){ setTimeout(() => showStatus = false, 2000) }">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold">Profile</h2>
            <button x-show="!isEditing" @click="isEditing = true" class="btn btn-primary">Edit Profile</button>
        </header>

        <div class="card">
            <h3 x-show="isEditing" class="h5 fw-bold mb-4">Edit Profile</h3>
            <h3 x-show="!isEditing" class="h5 fw-bold mb-4">Personal Information</h3>

            <template x-if="showStatus">
                <div class="alert alert-success">Profile updated successfully.</div>
            </template>

            <div x-show="!isEditing" class="row g-4">
                <div class="col-md-6"><strong>Name</strong><p>{{ $user->name }}</p></div>
                <div class="col-md-6"><strong>Email</strong><p>{{ $user->email }}</p></div>
                <div class="col-md-6"><strong>Phone</strong><p>{{ $user->phone_number }}</p></div>
                <div class="col-md-6"><strong>Date of Birth</strong><p>{{ \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') }}</p></div>
                <div class="col-md-6"><strong>Gender</strong><p class="text-capitalize">{{ $user->gender }}</p></div>
                <div class="col-md-6"><strong>Address</strong><p>{{ $user->address }}</p></div>
            </div>

            <form x-show="isEditing" method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Full Name *</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus>
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address *</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                    <div class="col-md-6">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input id="phone_number" name="phone_number" type="tel" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
                         <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                    </div>
                    <div class="col-md-6">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input id="date_of_birth" name="date_of_birth" type="date" class="form-control" value="{{ old('date_of_birth', $user->date_of_birth) }}">
                         <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                    </div>
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" name="gender" class="form-select">
                            <option value="male" @selected(old('gender', $user->gender) == 'male')>Male</option>
                            <option value="female" @selected(old('gender', $user->gender) == 'female')>Female</option>
                            <option value="other" @selected(old('gender', $user->gender) == 'other')>Other</option>
                        </select>
                         <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                    </div>
                    <div class="col-md-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea id="address" name="address" class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
                         <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>
                </div>
                <div class="mt-4">
                    <button type="button" @click="isEditing = false" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>

        </div>
</x-layouts.dashboard>
