<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Bitacora;

class BitacoraController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getBitacora(){
        $bitacoras = Bitacora::with(['user'])->orderBy('id', 'Desc')->get();

        $data = [
            'bitacoras' => $bitacoras
        ];

        return view('admin.bitacoras.home',$data);
    }
}
