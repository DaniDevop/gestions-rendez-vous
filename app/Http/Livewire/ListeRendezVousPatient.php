<?php

namespace App\Http\Livewire;

use App\Models\patientRendezVous;
use Livewire\Component;
use Livewire\Livewire;

class ListeRendezVousPatient extends Component
{
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

        

    }


    public function annuleRdv($id){
        $patientRdv=patientRendezVous::find($id);
        if(!$patientRdv){
            toastr()->error('Prise de rendevous inexistant ! ');
            return ;
        }
        $patientRdv->delete();
         // Assuming IDs are unique
       ;
        toastr()->success("info rendez-vous annuler! ");
         $patientRdvAll=patientRendezVous::where('patient_id',$this->idPatient)->get();
        return view('livewire.liste-rendez-vous-patient',[
            'patientRdvAll'=> $patientRdvAll
        ]);

    }


    public function mount($idPatient=null){
        $this->idPatient=$idPatient;

        

    }


    public function render()
    {
        $patientRdvAll=patientRendezVous::where('patient_id',$this->idPatient)->get();
        return view('livewire.liste-rendez-vous-patient',[
            'patientRdvAll'=> $patientRdvAll
        ]);
    }
}