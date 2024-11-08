<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanoController extends Controller
{
    public function meusPlanos(){
        $planos = [
            (object) [
                'id' => 1,
                'periodo' => '2024.2',
                'situacao' => 'Pendente',
            ],
            (object) [
                'id' => 2,
                'periodo' => '2024.1',
                'situacao' => 'Entregue',
            ],
            (object) [
                'id' => 3,
                'periodo' => '2023.2',
                'situacao' => 'Entregue',
            ],
        ];
        return view('meusPlanos', compact('planos'));
    }

    public function preencher($id){
        return view('preencherPlano');
    }
}
