<x-layouts.admin>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 fw-bold">User Management</h2>
        <a href="#" class="btn btn-primary">+ Add New User</a>
    </div>

    <div class="card mb-4">
        <form action="{{ route('admin.users.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <label for="role" class="form-label">Filter by Role</label>
                    <select name="role" id="role" class="form-select">
                        <option value="all" @selected(request('role', 'all') == 'all')>All Roles</option>
                        <option value="patient" @selected(request('role') == 'patient')>Patient</option>
                        <option value="doctor" @selected(request('role') == 'doctor')>Doctor</option>
                        <option value="admin" @selected(request('role') == 'admin')>Admin</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge rounded-pill text-capitalize
                                    @switch($user->role)
                                        @case('patient') bg-primary-subtle text-primary-emphasis @break
                                        @case('doctor') bg-info-subtle text-info-emphasis @break
                                        @case('admin') bg-secondary-subtle text-secondary-emphasis @break
                                    @endswitch
                                ">{{ $user->role }}</span>
                            </td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#userDetailModal"
                                    data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}" data-user-phone="{{ $user->phone_number }}"
                                    data-user-address="{{ $user->address }}" data-user-role="{{ ucfirst($user->role) }}" data-user-joined="{{ $user->created_at->format('F j, Y') }}">
                                    View
                                </button>
                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $users->appends(request()->query())->links() }}
    </div>

    <div class="modal fade" id="userDetailModal" tabindex="-1" aria-hidden="true">
        </div>
</x-layouts.admin>