<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class StaffAuthController extends Controller
{
    // Show Staff Login Form
    public function showLoginForm()
    {
        return view('staff.auth.login');
    }

    // Handle Staff Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Redirect to specific dashboard based on role
            if ($user->role === 'doctor' || $user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/staff/dashboard');
            }
            // If a patient tries to log in, log them out and redirect back with error
            Auth::logout();
            return back()->withErrors([
                'email' => 'You do not have permission to access the staff portal.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Show Staff Registration Form
    public function showRegistrationForm()
    {
        return view('staff.auth.register');
    }

    // Handle Staff Registration
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:doctor,admin',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'date_of_birth' => 'required|date',
            'specialty' => 'nullable|required_if:role,doctor|string|max:255',
            'license_number' => 'nullable|required_if:role,doctor|string|max:255',
            'experience_years' => 'nullable|required_if:role,doctor|integer|min:0',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'specialty' => $validatedData['specialty'] ?? null,
            'license_number' => $validatedData['license_number'] ?? null,
            'experience_years' => $validatedData['experience_years'] ?? null,
        ]);

        Auth::login($user);

        return redirect('/staff/dashboard');
    }
}