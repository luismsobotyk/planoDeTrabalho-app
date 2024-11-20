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
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function create(Request $request)
    {
        $request->validate([
            'categoria' => '',
            'regime' => ''
        ]);

        DB::beginTransaction();

        try {
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

            InfoPessoais::updateOrCreate(
                ['plano_id' => $request->input('plano_id')],
                [
                    'categoria' => $request->input('categoria'),
                    'regime' => $request->input('regime')
                ]
            );

            Aula::where('plano_id', $request->input('plano_id'))->delete();
            if (isset($aulasDisciplinas) && count($aulasDisciplinas) > 0) {
                foreach ($aulasDisciplinas as $i => $disciplina) {
                    Aula::create([
                        'disciplina' => $disciplina,
                        'curso' => $aulasCursos[$i],
                        'carga_horaria' => $aulasCargasHorarias[$i],
                        'plano_id' => $request->input('plano_id')
                    ]);
                }
            }

            AtivAdministrativa::where('plano_id', $request->input('plano_id'))->delete();
            if (isset($admDescricao) && count($admDescricao) > 0) {
                foreach ($admDescricao as $i => $descricao) {
                    AtivAdministrativa::create([
                        'descricao' => $descricao,
                        'portaria' => $admPortaria[$i],
                        'carga_horaria' => $admCargaHoraria[$i],
                        'plano_id' => $request->input('plano_id')
                    ]);
                }
            }

            AtivExtensao::where('plano_id', $request->input('plano_id'))->delete();
            if (isset($extDescricao) && count($extDescricao) > 0) {
                foreach ($extDescricao as $i => $descricao) {
                    AtivExtensao::create([
                        'descricao' => $descricao,
                        'carga_horaria' => $extCargaHoraria[$i],
                        'plano_id' => $request->input('plano_id')
                    ]);
                }
            }

            AtivPesquisa::where('plano_id', $request->input('plano_id'))->delete();
            if (isset($pesqDescricao) && count($pesqDescricao) > 0) {
                foreach ($pesqDescricao as $i => $descricao) {
                    AtivPesquisa::create([
                        'descricao' => $descricao,
                        'carga_horaria' => $pesqCargaHoraria[$i],
                        'plano_id' => $request->input('plano_id')
                    ]);
                }
            }

            AtivEnsino::where('plano_id', $request->input('plano_id'))->delete();
            if (isset($ensDescricao) && count($ensDescricao) > 0) {
                foreach ($ensDescricao as $i => $descricao) {
                    AtivEnsino::create([
                        'descricao' => $descricao,
                        'carga_horaria' => $ensCargaHoraria[$i],
                        'plano_id' => $request->input('plano_id')
                    ]);
                }
            }

            DB::commit(); // Confirma a transação
            return redirect()->back()->with('success', 'Plano salvo com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao salvar o plano. Contate o admin!');
        }
    }
}
