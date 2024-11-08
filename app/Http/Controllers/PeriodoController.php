<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function periodos(){
        $periodos = [
            (object)[
                'data_abertura' => '2024-01-01',
                'data_fechamento' => '2024-06-30',
                'semestre' => '2024/1',
                'usuario' => (object)['nome' => 'Luis Sobotyk']
            ],
            (object)[
                'data_abertura' => '2024-07-01',
                'data_fechamento' => '2024-12-31',
                'semestre' => '2024/2',
                'usuario' => (object)['nome' => 'Maria Souza']
            ]
        ];
        //$periodos = Periodo::all();

        return view('periodos', compact('periodos'));
    }

    public function periodoCreate(){
        echo 'teste';
    }
}
