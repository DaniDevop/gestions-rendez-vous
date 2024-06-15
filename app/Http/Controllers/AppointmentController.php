<?php
namespace App\Http\Controllers;

use App\Models\EmploieTemps;
use App\Models\Medecin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    public function index()
    {
        $medecins = Medecin::all();
        return view('Admin.callendar.callendar', compact('medecins'));
    }

    public function fetchAppointments()
    {
        $appointments = EmploieTemps::all();
        $events = [];

        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => $appointment->medecin->nom,
                'start' => $appointment->date . 'T' . $appointment->heure,
            ];
        }

        return response()->json($events);
    }

    public function store(Request $request)
    {
        log::info('Request Data: ', $request->all());

        $this->validate($request, [
            'medecin_id' => 'required|exists:medecins,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $emploie = new EmploieTemps();
        $emploie->start = $request->date;
        $emploie->heure = $request->time;
        $emploie->medecin_id = $request->medecin_id;
        $emploie->end = '';
        $emploie->save();

        Log::info('Appointment saved successfully.');

        return response()->json(['success' => 'Données insérée avec success']);
    }

}
