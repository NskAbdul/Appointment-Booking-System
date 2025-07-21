<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use App\Models\User;

class DoctorProfileController extends Controller
{
    // Show the doctor's profile page
    public function edit(Request $request)
    {
        return view('staff.doctor.profile', [
            'user' => $request->user(),
        ]);
    }

    // Update the doctor's profile information
    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'phone_number' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'date_of_birth' => ['required', 'date'],
            'specialty' => ['required', 'string', 'max:255'],
            'license_number' => ['required', 'string', 'max:255'],
            'experience_years' => ['required', 'integer', 'min:0'],
        ]);

        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('doctor.profile.edit')->with('status', 'profile-updated');
    }
}