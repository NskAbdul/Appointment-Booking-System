<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
   public function update(Request $request): RedirectResponse
{
    // We are combining profile info and custom fields into one update
    $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
        'phone_number' => ['required', 'string', 'max:20'],
        'date_of_birth' => ['required', 'date'],
        'gender' => ['required', 'string', 'in:male,female,other'],
        'address' => ['required', 'string', 'max:500'],
    ]);

    // If the user changes their email, we need to clear the verification status
    if ($request->user()->isDirty('email')) {
        $request->user()->email_verified_at = null;
    }

    // Fill the user model with validated data and save
    $request->user()->fill($validatedData);
    $request->user()->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
