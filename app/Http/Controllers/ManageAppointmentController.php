<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class ManageAppointmentController extends Controller
{
    // Show all appointments for the logged-in patient
   // In app/Http/Controllers/ManageAppointmentController.php

public function index(Request $request)
{
    $query = Appointment::where('patient_id', Auth::id())
                ->whereIn('status', ['scheduled', 'confirmed']) // Only show active appointments
                ->orderBy('appointment_date', 'desc');

    // Handle search filter for doctor name or specialty
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('doctor_name', 'like', '%' . $searchTerm . '%')
              ->orWhere('doctor_specialty', 'like', '%' . $searchTerm . '%');
        });
    }

    // Handle status filter
    if ($request->filled('status') && $request->status != 'all') {
        $query->where('status', $request->status);
    }

    // Handle date range filter
    if ($request->filled('date_range')) {
        switch ($request->date_range) {
            case 'today':
                $query->whereDate('appointment_date', \Carbon\Carbon::today());
                break;
            case 'upcoming':
                $query->where('appointment_date', '>', \Carbon\Carbon::now());
                break;
            case 'past':
                // This won't show much since we filter for active, but good to have
                $query->where('appointment_date', '<', \Carbon\Carbon::now());
                break;
        }
    }
    
    $appointments = $query->get();
    
    return view('patient.manage-appointments', compact('appointments'));
}
    // Update an existing appointment
   public function update(Request $request, Appointment $appointment)
{
    // Authorization check
    if ($appointment->patient_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $validated = $request->validate([
        'appointment_date' => 'required|date_format:Y-m-d',
        'appointment_time' => 'required|date_format:H:i',
        'notes' => 'nullable|string',
    ]);

    // Combine date and time into a single datetime string
    $fullDateTime = $validated['appointment_date'] . ' ' . $validated['appointment_time'];

    $appointment->update([
        'appointment_date' => $fullDateTime,
    ]);

    return redirect()->route('appointments.index')->with('status', 'Appointment updated successfully!');
}

    // Cancel (delete) an appointment
    public function destroy(Appointment $appointment)
    {
        // Authorization check
        if ($appointment->patient_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // We'll update the status to 'cancelled' instead of deleting
        $appointment->update(['status' => 'cancelled']);

        return redirect()->route('appointments.index')->with('status', 'Appointment cancelled successfully!');
    }

    // Add this new method to the class
public function history(Request $request)
{
    $query = Appointment::where('patient_id', Auth::id())
                ->whereIn('status', ['completed', 'cancelled'])
                ->orderBy('appointment_date', 'desc');

    $appointments = $query->get();

    return view('patient.appointment-history', compact('appointments'));
}
}
