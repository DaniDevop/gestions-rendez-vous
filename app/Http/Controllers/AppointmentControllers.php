<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentControllers extends Controller
{

    public function index()
    {
        $appointments = Appointment::all();
        $events = [];

        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => $appointment->title,
                'start' => $appointment->date,
                'id' => $appointment->id,

            ];
        }

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $appointment = new Appointment();
        $appointment->title = $request->title;
        $appointment->date = $request->date;
        $appointment->save();



        return response()->json(['status' => 'success']);
    }


    public function update(Request $request)
{
    $appointment = Appointment::find($request->id);
    if ($appointment) {
        $appointment->title = $request->title;
        $appointment->date = $request->date;
        $appointment->save();

        return response()->json(['status' => 'success']);
    }
    return response()->json(['status' => 'error', 'message' => 'Appointment not found']);
}

public function destroy(Request $request)
{
    $appointment = Appointment::find($request->id);
    if ($appointment) {
        $appointment->delete();
        return response()->json(['status' => 'success']);
    }
    return response()->json(['status' => 'error', 'message' => 'Appointment not found']);
}

}
