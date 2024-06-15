<?php

namespace App\Http\Livewire;

use App\Models\EmploieTemps;
use Livewire\Component;

class CallendarMedecin extends Component
{

    public $events=[];
    public function mount(){

        $appointments = EmploieTemps::all();


        foreach ($appointments as $appointment) {
            $this->events[] = [
                'title' => $appointment->medecin->nom,
                'start' => $appointment->date . 'T' . $appointment->heure,
            ];
        }

    }
    public function render()
    {



        return view('livewire.callendar-medecin',[
            'events' => json_encode($this->events) // Ensure events are JSON encoded

        ]);
    }
}