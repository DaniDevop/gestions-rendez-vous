<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpetialiteRequest;
use App\Models\Medecin;
use App\Models\Specialite;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    //


    public function addMedecin(){
        return view("medecin.ajouter");
    }

    public function store(Request $request){

        $medecin=new Medecin();
        $imagePath="";
        $medecin->nom=$request->nom;
        $medecin->prenom=$request->prenom;
        $medecin->email=$request->email;
        $medecin->tel=$request->phone;
        if($request->hasFile('profil')){
         $imagePath=$request->file('profil')->store('images','public');
        }
        $medecin->profil=$imagePath;
        $medecin->save();
        toastr()->success("Medecin crée avec succèss");
        return back();

    }

    public function update(Request $request){


        $medecin=Medecin::find($request->id);

        $medecin->nom=$request->nom;
        $medecin->prenom=$request->prenom;
        $medecin->email=$request->email;
        $medecin->tel=$request->phone;
        if($request->hasFile('profil')){
            $medecin->profil=$request->file('profil')->store('images','public');
        }
        $medecin->touch();

        $medecin->save();
        toastr()->info("Medecin modifié avec succèss");
        return back();

    }

    public function listesMedecin(){

    $medecinAll=Medecin::all();
        return view("medecin.listes",compact('medecinAll'));
    }

    public function detailsMedecin($id){

        $medecin=Medecin::find($id);
        if(!$medecin){
            toastr()->error('Medecin non trouvé');
        }

        return view("medecin.edit",compact('medecin'));

    }


    public function listeSpecialite(){
        $spetialiteAll=Specialite::orderBy('id','DESC')->get();
        return view("Spetialite.listes",compact('spetialiteAll'));

    }


    public function addSpecialite(SpetialiteRequest $spetialiteRequest){

        $spetialiteAll= new Specialite();
        $spetialiteAll->nom=$spetialiteRequest->nom;
        $spetialiteAll->status=$spetialiteRequest->status;
        $spetialiteAll->save();
        flash()->success('Specialite ajoute avec success !.');
        return back();
    }


}
