<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Models\Plano;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function periodos(){
        $periodos = Periodo::all();
        foreach($periodos as $periodo){
            $periodo->abertura = Carbon::parse($periodo->abertura)->format('d/m/Y');
            $periodo->fechamento = Carbon::parse($periodo->fechamento)->format('d/m/Y');
        }
        return view('periodos', compact('periodos'));
    }

    public function periodoCreate(Request $request){
        $request->validate([
            'data_abertura' => 'required|date',
            'data_fechamento' => 'required|date|after:data_abertura',
            'semestre' => [
                'required',
                'regex:/^\d{4}\/[1-2]$/'
            ]
        ],
        [
            'data_abertura.required' => 'A Data de abertura é obrigatória.',
            'data_abertura.date' => 'A Data de abertura deve ser uma data válida.',
            'data_fechamento.required' => 'A Data de fechamento é obrigatória.',
            'data_fechamento.date' => 'A Data de fechamento deve ser uma data válida.',
            'data_fechamento.after' => 'A Data de fechamento deve ser posterior à data de abertura.',
            'semestre.required' => 'O semestre é obrigatório.',
            'semestre.regex' => 'O Semestre deve atender o formato ano/semestre (0000/1 ou 0000/2)'
        ]);

        $periodo = Periodo::create([
            'abertura' => $request->input('data_abertura'),
            'fechamento' => $request->input('data_fechamento'),
            'semestre' => $request->input('semestre'),
            'cadastrado_por' => session('user.login')
        ]);

        $docentes= Usuario::where('cargo', 'docente')->get();

        foreach($docentes as $docente){
            Plano::create([
                'situacao' => 'pendente',
                'docente_id' => $docente->login,
                'periodo_id' => $periodo->id
            ]);
        }

        return redirect()->back()->with('success', 'Período cadastrado com sucesso!');
    }
}
