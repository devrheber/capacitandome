<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller {

    public function index() {
        return view('admin.usuario.list');
    }
   
    public function create() {
        return view('admin.usuario.create');
    }
}
