<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller {

    

    public function logout() {
        Auth::logout();
        return redirect()->to('/');
    }
    
    public function login(Request $request) {
        $credentials = $request->validate([
            'usuario'   => 'required|max:30|min:2',
            'password'  => 'required',
        ]);
        
        if (Auth::attempt(['usuario' => $credentials['usuario'], 'password' => $credentials['password'], 'estado' => 1])) {
            if (Auth::user()->idrol == 3) {
                return response()->json(['response'=> 'ok','href'=> '/admin/inicio']);
            } else {
                return response()->json(['response'=> 'ok','href'=> '/miscursos']);
            }
        } else {
            return response()->json(['response'=> 'false']);
        }
    }
}
