<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    //


    public function users(){

        $usersAll=User::orderBy('id','DESC')->get();
        return view('Admin.users.users',compact('usersAll'));
    }


    public function home(){

        return view('Admin.index');
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
}