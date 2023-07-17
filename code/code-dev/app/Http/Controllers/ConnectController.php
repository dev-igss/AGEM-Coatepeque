<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash,Auth,Mail,Str;
use App\User;
use App\Mail\UserSendRecover,App\Mail\UserSendNewPassword;

class ConnectController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except(['getLogout']);
    }

    public function getLogin(){
        return view('connect.login');
    }

    public function postLogin(Request $request){
        $rules = [
            'ibm' => 'required',
            'password' => 'required|min:8'
        ];

        $messages = [
            'ibm.required' => 'Su numero de IBM es requerido.',
            'password.required' => 'Por favor escriba una contraseña.',
            'password.min' => 'La contraseña debe de tener al menos 8 caracteres.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')
            ->with('typealert', 'danger');
        else:

            if(Auth::attempt(['ibm' => $request->input('ibm'), 'password'=>$request->input('password')], true )):
                if(Auth::user()->status == "0"):
                    return redirect('/logout');
                else:
                    return redirect('/admin');
                endif;
                
            else:
                return back()->with('message', 'IBM o contraseña errónea')
                ->with('typealert', 'danger');
            endif;
        
        endif;
    }

    public function getLogout(){
        $status = Auth::user()->status;
        Auth::logout();

        if($status == "0"):
            return redirect('/inicio_sesion')->with('message', 'Su usuario fue suspéndido.')
            ->with('typealert', 'danger');
        else:
            return redirect('/inicio_sesion');
        endif;
        
    }

}
