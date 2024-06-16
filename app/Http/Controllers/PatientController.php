<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Models\Patient;
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



        return view('Patient.dashboard', compact('patient'));
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

}
