<?php

namespace App\Http\Livewire;

use App\Models\patientRendezVous;
use Livewire\Component;
use Livewire\WithPagination;

class ListesRendezVousMedecinPatient extends Component
{

    use WithPagination;


    public $query = '';
 
    public function search()
    {
        $this->resetPage();
    }

    public function render()
    {

        $patientRdvAll = patientRendezVous::where('motif', 'like', '%'.$this->query.'%')->orWhere('date', 'like', '%'.$this->query.'%')->paginate(5);

        return view('livewire.listes-rendez-vous-medecin-patient', [
            'patientRdvAll' => $patientRdvAll
        ]);
    }
}