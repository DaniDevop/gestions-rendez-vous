<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Medecin;
use App\Models\patientRendezVous;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //


    public function users(){

        $usersAll=User::orderBy('id','DESC')->paginate();
        return view('Admin.users.users',compact('usersAll'));
    }




    public function edit(){

        return view('Admin.users.update');
    }


    public function search(Request $request){

        $value=$request->validate([
            'value'=>'required'
        ]);

        $search = $request->value;



        $usersAll=User::where('name', 'like', '%'.$search.'%')->orWhere('prenom', 'like', '%'.$search.'%')
        ->orwhere('email', 'like', '%'.$search.'%')
        ->paginate(5);

        return view('Admin.users.users',compact('usersAll'));
    }


    public function home(){

        $usersAll=User::all()->count();
        $medecinAll=Medecin::all()->count();
        $demandeAll=patientRendezVous::all()->count();

        $demandePatient=patientRendezVous::orderBy('id','desc')->get();

        return view('Admin.index',compact('usersAll','medecinAll','demandeAll','demandePatient'))    ;
    }


    public function login_users(){


        return view('Admin.login');

    }

    public function doLogin(LoginRequest $request){



        if(!Auth::attempt(['name'=> $request->email,'password'=>$request->password]) &&  !Auth::attempt(['email'=> $request->email,'password'=>$request->password]) ){

            toastr()->error("Informations introuvable");
            return back();
        }

        return redirect()->route('home');
    }


    public function addUser(UsersRequest $usersRequest){


        if($usersRequest->password != $usersRequest->password_confirm){
            toastr()->warning('Les mots de passes entrées sont différent !');
            return back()->withInput();
        }
        $users=new User();

        $users->name=$usersRequest->name;
        $users->email=$usersRequest->email ?:"";
        $users->role=$usersRequest->role;
        $users->prenom=$usersRequest->prenom;
        $users->tel=$usersRequest->tel;
        $imagePath="";
        if($usersRequest->hasFile('profil')){
            $imagePath=$usersRequest->file('profil')->store('users','public');
        }
        $users->profil=$imagePath;
        $users->password=Hash::make($usersRequest->password);
        $users->save();
        toastr()->success('Utilisateur ajouté avec succèss !');
        return back();

    }



    public function updateUser(Request $usersRequest){


        $usersRequest->validate([
                'name'=>'required',
                'prenom'=>'required',
                'email'=>'nullable|email',
                'id'=>'required|exists:users,id',
        ]);

        $users=User::find($usersRequest->id);


        $users->name=$usersRequest->name;
        $users->email=$usersRequest->email ?:"";
        $users->prenom=$usersRequest->prenom;
        $users->tel=$usersRequest->tel;

        if($usersRequest->hasFile('profil')){
            $users->profil=$usersRequest->file('profil')->store('users','public');
        }

        $users->save();
        toastr()->info('Profile mise à jour avec succèss  !');
        return back();

    }



    public function updatepasswordUser(Request $usersRequest){


        $usersRequest->validate([
                'password'=>'required',
                'password_confirm'=>'required',
                'id'=>'required|exists:users,id',
        ]);

        if( $usersRequest->password !=  $usersRequest->password_confirm){

            toastr()->error('Les mots de passes doivent etre identique 🛑 !');
        return back();
        }

        $users=User::find($usersRequest->id);
        $users->password=Hash::make($usersRequest->password);

        $users->save();
        toastr()->info('Mots de passes mises à jours avec  succèss !!');
        return back();

    }

    public function logoutUsers(){

        Auth::logout();

        return view('Admin.login');
    }
}
