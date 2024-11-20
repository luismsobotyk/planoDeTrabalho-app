@props(['tipo', 'plano'])

@php
    // Verifica se existem dados antigos ou dados do banco
    $relacoes = [
        'adm' => 'atividadesAdministrativas',
        'ext' => 'atividadesExtensao',
        'pesquisa' => 'atividadesPesquisa',
        'ensino' => 'atividadesEnsino',
    ];
    $constructorName = $relacoes[$tipo] ?? null;

    $descricao = old($tipo . 'Descricao', $plano->{$constructorName}()->pluck('descricao')->toArray());
    if ($tipo == 'adm') {
        $portaria = old($tipo . 'Portaria', $plano->{$constructorName}()->pluck('portaria')->toArray());
    } else {
        // Para outros tipos, não buscamos o campo 'portaria'
        $portaria = [];
    }
    $cargaHoraria = old($tipo . 'CargaHoraria', $plano->{$constructorName}()->pluck('carga_horaria')->toArray());
@endphp

@if($descricao)
    @for($i = 0; $i < count($descricao); $i++)
        <script>
            addAtividade(
                '{{ $tipo }}',
                '{{ $descricao[$i] }}',
                '{{ $portaria[$i] ?? '' }}',
                '{{ $cargaHoraria[$i] }}'
            );
        </script>
    @endfor
@endif
