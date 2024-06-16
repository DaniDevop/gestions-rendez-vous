<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    //



    public function home(){
        return view('Patient.home');
    }


    public function addAccountPatient(PatientRequest $patientRequest){

       
        $patient=new Patient();
        $patient->nom= $patientRequest->nom;
        $patient->prenom= $patientRequest->prenom;
        $patient->email= $patientRequest->email;
        $patient->tel= $patientRequest->tel;
        $patient->adresse= $patientRequest->adresse ? :"";
        $patient->password= Hash::make ( $patientRequest->password);
        $patient->save();
        toastr()->info('Vos informations on été traité avec succès !');
        return back();

    }
}