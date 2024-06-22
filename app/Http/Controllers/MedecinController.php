<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedecinRequest;
use App\Http\Requests\SpetialiteRequest;
use App\Models\Medecin;
use App\Models\Specialite;
use App\Models\SpecialiteMedecin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    //


    public function addMedecin(){
        return view("Admin.medecin.ajouter");
    }

    public function store(MedecinRequest $request){

        $medecin=new Medecin();
        $imagePath="";
        $medecin->nom=$request->nom;
        $medecin->prenom=$request->prenom;
        $medecin->email=$request->email;
        $medecin->tel=$request->tel;
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

    $medecinAll=Medecin::paginate(5);
        return view("Admin.medecin.listes",compact('medecinAll'));
    }

    public function detailsMedecin($id){

        $medecin=Medecin::find($id);
        if(!$medecin){
            toastr()->error('Medecin non trouvé');
        }
        $specialite=SpecialiteMedecin::all();
        $specialiteMedecin=SpecialiteMedecin::where('medecin_id',$id)->get();

        return view("Admin.medecin.edit",compact('medecin','specialiteMedecin','specialite'));

    }


    public function addSpecialiteToMedecin(Request $request):RedirectResponse{
        $request->validate([
               'specialite_id'=>'required|exists:specialites,id',
               'medecin_id'=>'required|exists:medecins,id'
        ]);
        $specialiteExiste=SpecialiteMedecin::where('medecin_id',$request->medecin_id)->where('specialite',$request->specialite_id)->get();
        if($specialiteExiste){
            toastr()->warning('Cette spécialité est déjà attribué à ce medecin');
            return back();
        }
        $specialite=new SpecialiteMedecin();
        $specialite->medecin_id=$request->medecin_id;
        $specialite->specialite_id=$request->specialite_id;
        $specialite->save();
        toastr()->info('Specialité ajouét avec succès !');
        return back();
    }
    public function listeSpecialite(){
        $spetialiteAll=Specialite::orderBy('id','DESC')->paginate(5);
        $medecinAll=Medecin::all();
        return view("Admin.Spetialite.listes",compact('spetialiteAll','medecinAll'));

    }


    public function searchSpecialite(Request $request){

        $request->validate([
           'value'=>'required'
        ]);

        $spetialiteAll=Specialite::where('nom', 'like', '%'.$request->value.'%')
        ->orWhere('status', 'like', '%'.$request->value.'%')
        ->orWhere('created_at', 'like', '%'.$request->value.'%')
        ->orWhere('updated_at', 'like', '%'.$request->value.'%')
        ->paginate(5);
        return view("Admin.Spetialite.listes",compact('spetialiteAll'));

    }


    public function addSpecialite(SpetialiteRequest $spetialiteRequest){

        $spetialiteAll= new Specialite();
        $spetialiteAll->nom=$spetialiteRequest->nom;
        $spetialiteAll->status=$spetialiteRequest->status;
        $spetialiteAll->save();
        toastr()->success('Specialite ajoute avec success !.');
        return back();
    }

    public function search(Request $request){

        $value=$request->validate([
            'value'=>'required'
        ]);

        $search = $request->value;



        $medecinAll=Medecin::where('nom', 'like', '%'.$search.'%')->orWhere('prenom', 'like', '%'.$search.'%')
        ->orwhere('email', 'like', '%'.$search.'%')
        ->orWhere('tel', 'like', '%'.$search.'%')->paginate(5);

        return view("Admin.medecin.listes",compact('medecinAll'));
    }


}
