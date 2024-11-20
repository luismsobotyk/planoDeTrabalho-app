@if(old($tipo . 'Descricao'))
    @php
        $descricao = old($tipo . 'Descricao');
        $portaria = old($tipo . 'Portaria', []); // Algumas atividades podem não ter portaria
        $cargaHoraria = old($tipo . 'CargaHoraria');
    @endphp
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
