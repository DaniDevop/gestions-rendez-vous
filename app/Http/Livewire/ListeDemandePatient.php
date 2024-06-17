<?php

namespace App\Http\Livewire;

use App\Models\Medecin;
use App\Models\PatientRendezVous;
use Livewire\Component;

class ListeDemandePatient extends Component
{
    public $demandePatient = [];
    public $medecinAll = [];
    public $selectedRendezVous = [];

    public $date = "";
    public $heure = "";
    public $medecin_id = "";
    public $editedRowId = null;

    public $count = 0;

    public function rules()
    {
        return [
            'date' => 'required|date',
            'heure' => 'required',
            'medecin_id' => 'required|exists:medecins,id',
        ];
    }

    public function mount()
    {
        $this->demandePatient = PatientRendezVous::orderBy('id', 'desc')->get();
        $this->medecinAll = Medecin::all();
    }

    public function editRow($id)
    {
        $patient = PatientRendezVous::find($id);

        if ($patient) {
            $this->selectedRendezVous = [
                'nom' => $patient->patient->nom,
                'motif' => $patient->motif,
                'heure' => $patient->heure,
                'id' => $patient->id,
            ];

            $this->date = $patient->date;
            $this->heure = $patient->heure;
            $this->medecin_id = $patient->medecin_id;
            $this->editedRowId = $id;
        }
    }

    public function save()
    {
        $this->validate();

        $patient = PatientRendezVous::find($this->selectedRendezVous['id']);

        if ($patient) {
            $patient->date = $this->date;
            $patient->heure = $this->heure;
            $patient->medecin_id = $this->medecin_id;
            $patient->touch();
            $patient->save();

            toastr()->info('Rendez-vous fixé avec succès !');

            $this->reset(['date', 'heure', 'medecin_id', 'selectedRendezVous', 'editedRowId']);
        }
    }

    public function increment()
    {
        $this->count += 1;
    }

    public function render()
    {   
        return view('livewire.liste-demande-patient', [
            'demandePatient' => $this->demandePatient,
            'medecinAll' => $this->medecinAll
        ]);
    }
}