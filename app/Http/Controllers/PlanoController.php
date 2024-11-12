<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use Illuminate\Http\Request;

class PlanoController extends Controller
{
    public function meusPlanos(){
        $planos = Plano::where('docente_id', session('user.login'))->get();
        return view('meusPlanos', compact('planos'));
    }

    public function preencher($id){
        return view('preencherPlano');
    }
}
