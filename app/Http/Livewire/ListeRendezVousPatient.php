<?php

namespace App\Http\Livewire;

use App\Models\patientRendezVous;
use Livewire\Component;

class ListeRendezVousPatient extends Component
{
    public $patientRdvAll=[];
    public $motifRaw=[];

    public $idPatient;
    public $motif="";
    public $motif_id="";
    public $editLine=false;

    public function editMotif($id){

        $patientRdv=patientRendezVous::find($id);
        $this->motifRaw=[
           'motif'=>$patientRdv->motif,
           'id'=>$patientRdv->id,
        ];




        $this->editLine=true;
    }



    public function rules(){
        return [
             'motif'=>'required',
             'id'=>'required|exists:patient_rendez_vouses,id'
        ];
    }

    public function save(){


        $patientRdv=patientRendezVous::find($this->motifRaw['id']);
        if(! $patientRdv ){
            toastr()->error("Une erreur c est produite !");
            return;
        }
        
        $patientRdv->motif=$this->motifRaw['motif'];
        $patientRdv->save();
        toastr()->success("Motif modifié avec succèss");
        $this->reset([ 'motif_id', 'motif', 'editLine']);

        $this->patientRdvAll=patientRendezVous::where('patient_id',$this->motifRaw['id'])->get();

    }


    public function mount($idPatient=null){
        $this->idPatient=$idPatient;

        $this->patientRdvAll=patientRendezVous::where('patient_id',$this->idPatient)->get();

    }
    public function render()
    {
        return view('livewire.liste-rendez-vous-patient',[
            'patientRdvAll'=>$this->patientRdvAll
        ]);
    }
}
