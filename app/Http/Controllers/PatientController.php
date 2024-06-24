<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use App\Models\patientRendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function home(){
        return view('Patient.home');
    }

    public function addAccountPatient(PatientRequest $patientRequest){
        $patient = new Patient();
        $patient->nom = $patientRequest->nom;
        $patient->prenom = $patientRequest->prenom;
        $patient->email = $patientRequest->email;
        $patient->tel = $patientRequest->tel;
        $patient->adresse = $patientRequest->adresse ?: "";
        $patient->password = Hash::make($patientRequest->password);
        $patient->save();

        toastr()->info('Vos informations ont été traitées avec succès !');
        return back();
    }

    public function loginPatient(Request $request){
        $request->validate([
            'emailOrTel' => 'required',
            'password' => 'required'
        ]);

        $patient = Patient::where('email', $request->emailOrTel)->orWhere('tel', $request->emailOrTel)->first();

        if (!$patient) {
            toastr()->error('Informations introuvables !');
            return back();
        }

        if (!Hash::check($request->password, $patient->password)) {
            toastr()->error('Informations introuvables !');
            return back();
        }

        session()->put('patient', $patient);
        session()->put('auth', true);
        toastr()->info('Informations trouvées');
        return redirect()->route('dashboard.client');
    }

    public function dashboard(){
        $patient = session()->get('patient');


        if (!$patient) {
            toastr()->error('Veuillez vous connecter');
            return redirect()->route('home.client');
        }

        $patientRdvAll=patientRendezVous::where('patient_id',$patient->id)->get();


        return view('Patient.dashboard', compact('patient','patientRdvAll'));
    }


    public function updateccountPatient(Request $patientRequest){

        $patientRequest->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>'required|email',
            'tel'=>'required',
            'adresse'=>'nullable',
            'password'=>'nullable',
            'password_confirm'=>'nullable',
        ]);
        $patient = Patient::find($patientRequest->id);
        $patientExist=Patient::where('email',$patientRequest->email)->orWhere('tel',$patientRequest->tel)->where('id','!=',$patientRequest->id);
        if(!$patient){
            toastr()->error('Veuillez vous connecter');
            return redirect()->route('home.client');
        }
        if(!$patientExist){
            toastr()->warning('Attention l email ou le téléphone existe déjà pour un autre user');
            return back();
        }
        $patient->nom = $patientRequest->nom;
        $patient->prenom = $patientRequest->prenom;
        $patient->email = $patientRequest->email;
        $patient->tel = $patientRequest->tel;
        $patient->adresse = $patientRequest->adresse ?: "";
        if($patientRequest->password !=""){

            if($patientRequest->password != $patientRequest->password_confirm){
                toastr()->error('Attention vos mots de passes sont differents');
            }
            $patient->password = Hash::make($patientRequest->password);

        }

        session()->forget('patient');
        session()->put('patient', $patient);
        $patient->save();

        toastr()->info('Vos informations ont été mises à jour avec succès !');
        return back();
    }


    public function logoutPatient(){

        session()->forget('patient');
        session()->forget('auth');
        return redirect()->route('home.client');
    }

    public function addDemande(Request $request){


        $request->validate([
            'motif'=>'required',
            'id'=>'required|exists:patients,id',
        ]);

        $todayCount = patientRendezVous::where('patient_id', $request->id)
        ->whereDate('created_at', date('Y-m-d'))
        ->count();

    if ($todayCount >= 1) {
        toastr()->error('Vous avez déjà fait deux demandes aujourd\'hui.');
        return back();
    }
        $rendez_vous=new patientRendezVous();
        $rendez_vous->motif=$request->motif;
        $rendez_vous->patient_id=$request->id;
        $rendez_vous->heure='';
        $rendez_vous->status='En-cours';
        $rendez_vous->save();
        toastr()->info('Votre demande à été envoyé ');
        return back();

    }

    public function updateMotif(Request $request){
        $request->validate([
              'motif'=>'required',
              'id'=>'required|exists:patients,id'
        ]);

        $patient=patientRendezVous::find($request->id);
        $patient->motif=$request->motif;
        $patient->touch();
        $patient->save();
        toastr()->info('Motif mise à jour avec succèss !');

        return back();
    }

}
