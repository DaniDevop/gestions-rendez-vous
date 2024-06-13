<?php

namespace App\Http\Controllers;

use App\Models\Emploie;
use App\Models\EmploieTemps;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //

    public function index()
    {
        return view('callendar.callendar');
    }

    public function fetchAppointments()
    {
        $appointments = EmploieTemps::all();
        return response()->json($appointments);
    }

    public function store(Request $request)
    {
        $emploie = new EmploieTemps();
        $emploie->heure= $request->heure;
        $emploie->start = $request->start;
        $emploie->end = $request->end;
        $emploie->medecin_id = $request->medecin_id ;
        $emploie->save();

        return response()->json($emploie);
    }
}
