<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HealthCare Plus</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <style>
        body { background-color: #f8fafc; }
        .dashboard-layout { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background-color: #fff; border-right: 1px solid #e2e8f0; padding: 1.5rem; flex-shrink: 0; }
        .main-content { flex-grow: 1; padding: 2rem; }
        .sidebar-link { display: block; padding: 0.75rem 1.25rem; border-radius: 0.5rem; text-decoration: none; color: #4b5563; font-weight: 500; margin-bottom: 0.5rem; }
        .sidebar-link.active, .sidebar-link:hover { background-color: #eef2ff; color: #4338ca; }
        .card { background-color: white; padding: 1.5rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; margin-bottom: 1.5rem; }
    </style>
</head>
<body>
<div class="dashboard-layout">
    <aside class="sidebar">
        <h1 class="h4 fw-bold mb-4" style="color: #0066CC;">💙 HealthCare Plus</h1>
        <nav>
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('appointments.index') }}" class="sidebar-link {{ request()->routeIs('appointments.index') ? 'active' : '' }}" class="sidebar-link">Manage Appointments</a>
            <a href="{{ route('book.create.step.one') }}" class="sidebar-link {{ request()->is('book-appointment*') ? 'active' : '' }}">+ Book Appointment</a>
            <a href="{{ route('profile.edit') }}" class="sidebar-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">My Profile</a>
            <a href="{{ route('appointments.history') }}" class="sidebar-link {{ request()->routeIs('appointments.history') ? 'active' : '' }}">Appointment History</a>
        </nav>
    </aside>

    <main class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('homepage') }}" class="text-muted text-decoration-none">← Back to Home</a>
            <div>
                <span>Welcome, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline ms-3">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="text-danger fw-bold text-decoration-none">
                        Logout
                    </a>
                </form>
            </div>
        </header>

        {{ $slot }}

    </main>
</div>
@stack('scripts')
</body>
</html>