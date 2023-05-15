<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Helpers extends Controller {

    public function limpiarVariable($variable) {
        if (empty($variable)) {
            $variable = "";
        } else {
            $variable = $variable;
        }
        return $variable;
    }
}
