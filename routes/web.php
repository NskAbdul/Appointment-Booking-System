<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\StaffAuthController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentBookingController;
use App\Http\Controllers\ManageAppointmentController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\DoctorAppointmentController;
use App\Http\Controllers\DoctorProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserManagementController;

// Homepage
Route::get('/', function () {
    return view('homepage');
})->name('homepage');

// --- PATIENT ROUTES ---
Route::middleware('guest_patient')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// --- STAFF ROUTES ---
Route::prefix('staff')->name('staff.')->group(function () {
    Route::middleware('guest_staff')->group(function () {
        Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [StaffAuthController::class, 'login']);
        Route::get('/register', [StaffAuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [StaffAuthController::class, 'register']);
    });
});

// --- AUTHENTICATED ROUTES ---
Route::middleware('auth')->group(function () {
    // Logout route for everyone
    // In routes/web.php, inside the main auth group

    Route::get('/api/doctors/{doctor}/available-slots', [AppointmentBookingController::class, 'getAvailableSlots'])->name('api.doctors.slots');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Patient-Only Routes (Protected by is_patient middleware)
    Route::middleware('is_patient')->group(function () {
        Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // ... all other patient routes (booking, manage, etc.)
        Route::get('book-appointment/step-1', [AppointmentBookingController::class, 'createStepOne'])->name('book.create.step.one');
        Route::get('book-appointment/step-2', [AppointmentBookingController::class, 'createStepTwo'])->name('book.create.step.two');
        Route::post('book-appointment/step-2', [AppointmentBookingController::class, 'storeStepTwo'])->name('book.store.step.two');
        Route::get('book-appointment/step-3', [AppointmentBookingController::class, 'createStepThree'])->name('book.create.step.three');
        Route::post('book-appointment/step-3', [AppointmentBookingController::class, 'storeStepThree'])->name('book.store.step.three');
        Route::get('book-appointment/step-4', [AppointmentBookingController::class, 'createStepFour'])->name('book.create.step.four');
        Route::post('book-appointment/store', [AppointmentBookingController::class, 'store'])->name('book.store');
        Route::get('book-appointment/success', [AppointmentBookingController::class, 'success'])->name('book.success');
        Route::get('manage-appointments', [ManageAppointmentController::class, 'index'])->name('appointments.index');
        Route::patch('manage-appointments/{appointment}', [ManageAppointmentController::class, 'update'])->name('appointments.update');
        Route::delete('manage-appointments/{appointment}', [ManageAppointmentController::class, 'destroy'])->name('appointments.destroy');
        Route::get('/appointment-history', [ManageAppointmentController::class, 'history'])->name('appointments.history');
    });

    // Staff-Only Routes (Protected by a future is_staff middleware)
    // --- STAFF-ONLY ROUTES (inside the main 'auth' middleware group) ---
Route::prefix('staff')->middleware('auth')->group(function () {

    // This route acts as a router after login
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');

    // DOCTOR-SPECIFIC ROUTES
   Route::prefix('doctor')->middleware('is_doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('dashboard');

    // Add these new routes for managing appointments
    Route::get('/my-appointments', [DoctorAppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/my-appointments/{appointment}/status', [DoctorAppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::get('/my-profile', [DoctorProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/my-profile', [DoctorProfileController::class, 'update'])->name('profile.update');
    Route::get('/appointment-history', [DoctorAppointmentController::class, 'history'])->name('appointments.history');
    // In routes/web.php -> DOCTOR-SPECIFIC ROUTES block
    Route::get('/api/appointments-by-date', [DoctorDashboardController::class, 'getAppointmentsForDate'])->name('api.appointments.by_date');
});

    // ADMIN-SPECIFIC ROUTES
   // In routes/web.php -> ADMIN-SPECIFIC ROUTES block
Route::prefix('admin')->middleware('is_admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // ... all future admin routes will go here
    Route::resource('/users', UserManagementController::class);
});
});

Route::prefix('doctor')->middleware('is_doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('dashboard');
});

});