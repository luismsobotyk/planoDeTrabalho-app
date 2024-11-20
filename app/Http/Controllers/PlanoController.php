<?php

namespace App\Http\Controllers;

use App\Models\AtivAdministrativa;
use App\Models\AtivEnsino;
use App\Models\AtivExtensao;
use App\Models\AtivPesquisa;
use App\Models\Aula;
use App\Models\InfoPessoais;
use App\Models\Periodo;
use App\Models\Plano;
use Illuminate\Http\Request;

class PlanoController extends Controller
{
    public function meusPlanos(){
        $planos = Plano::where('docente_id', session('user.login'))->get();
        return view('meusPlanos', compact('planos'));
    }

    public function preencher($id){
        $plano = Plano::with(['periodo', 'informacoesPessoais', 'aulas', 'atividadesAdministrativas', 'atividadesEnsino', 'atividadesPesquisa', 'atividadesExtensao'])->find($id);
        return view('preencherPlano', compact('plano'));
    }

    public function create(Request $request){
        $request->validate([
            'categoria' => '',
            'regime' => ''
        ]);

        // RECUPERA INFO DAS AULAS
        $aulasDisciplinas = $request->input('aulasDisciplinas');
        $aulasCursos = $request->input('aulasCursos');
        $aulasCargasHorarias = $request->input('aulasCargasHorarias');

        // RECUPERA INFO DAS ATIV ADMINISTRATIVAS
        $admDescricao = $request->input('admDescricao');
        $admPortaria = $request->input('admPortaria');
        $admCargaHoraria = $request->input('admCargaHoraria');

        // RECUPERA INFO DAS ATIV DE EXTENSAO
        $extDescricao = $request->input('extDescricao');
        $extCargaHoraria = $request->input('extCargaHoraria');

        // RECUPERA INFO DAS ATIV DE PESQUISA
        $pesqDescricao = $request->input('pesquisaDescricao');
        $pesqCargaHoraria = $request->input('pesquisaCargaHoraria');

        // RECUPERA INFO DAS ATIV DE ENSINO
        $ensDescricao = $request->input('ensinoDescricao');
        $ensCargaHoraria = $request->input('ensinoCargaHoraria');

        //deletar todas essas multiplas e resalvar sempre que atualiza pra nao precisar ficar procurando atualizacao

        $infoPessoais = InfoPessoais::create([
            'categoria' => $request->input('categoria'),
            'regime' => $request->input('regime'),
            'plano_id' => $request->input('plano_id')
        ]);

        $aulas = [];
        if(isset($aulasDisciplinas) && count($aulasDisciplinas)>0){
            for($i = 0; $i < count($aulasDisciplinas); $i++){
                $aulas[] = Aula::create([
                    'disciplina' => $aulasDisciplinas[$i],
                    'curso' => $aulasCursos[$i],
                    'carga_horaria' => $aulasCargasHorarias[$i],
                    'plano_id' => $request->input('plano_id')
                ]);
            }
        }else{
            echo 'NENHUMA AULA INFORMADA';
        }

        $atividadesAdministrativas = [];
        if(isset($admDescricao) && count($admDescricao)>0){
            for($i = 0; $i < count($admDescricao); $i++){
                $atividadesAdministrativas[]= AtivAdministrativa::create([
                    'descricao' => $admDescricao[$i],
                    'portaria' => $admPortaria[$i],
                    'carga_horaria' => $admCargaHoraria[$i],
                    'plano_id' => $request->input('plano_id')
                ]);
            }
        }else{
            echo 'NENHUMA ATIVIDADE ADMINISTRATIVA INFORMADA';
        }

        $atividadesExtensao = [];
        if(isset($extDescricao) && count($extDescricao)>0){
            for($i = 0; $i < count($extDescricao); $i++){
                $atividadesExtensao[]= AtivExtensao::create([
                    'descricao' => $extDescricao[$i],
                    'carga_horaria' => $extCargaHoraria[$i],
                    'plano_id' => $request->input('plano_id')
                ]);
            }
        }else{
            echo 'NENHUMA ATIVIDADE DE EXTENSAO INFORMADA';
        }

        $atividadesPesquisa = [];
        if(isset($pesqDescricao) && count($pesqDescricao)>0){
            for($i = 0; $i < count($pesqDescricao); $i++){
                $atividadesPesquisa[]= AtivPesquisa::create([
                    'descricao' => $pesqDescricao[$i],
                    'carga_horaria' => $pesqCargaHoraria[$i],
                    'plano_id' => $request->input('plano_id')
                ]);
            }
        }else{
            echo 'NENHUMA ATIVIDADE DE PESQUISA INFORMADA';
        }

        $atividadesEnsino = [];
        if(isset($ensDescricao) && count($ensDescricao)>0){
            for($i = 0; $i < count($ensDescricao); $i++){
                $atividadesEnsino[]= AtivEnsino::create([
                    'descricao' => $ensDescricao[$i],
                    'carga_horaria' => $ensCargaHoraria[$i],
                    'plano_id' => $request->input('plano_id')
                ]);
            }
        }else{
            echo 'NENHUMA ATIVIDADE DE ENSINO INFORMADA';
        }

        return redirect()->back()->with('success', 'Plano salvo com Sucesso!'); //->withInput($request->input())
    }
}
