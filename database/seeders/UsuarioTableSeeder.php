<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuario')->insert([
            [
                'login' => 'luissobotyk',
                'nome' => 'Luis Sobotyk',
                'cargo' => 'admin',
                'SIAPE' => 2081435,
                'created_at' => now()
            ],
            [
                'login' => 'marciafranco',
                'nome' => 'Marcia Franco',
                'cargo' => 'docente',
                'SIAPE' => 2012345,
                'created_at' => now()
            ],
            [
                'login' => 'docenteExemplo',
                'nome' => 'Docente Exemplo',
                'cargo' => 'docente',
                'SIAPE' => 12345678,
                'created_at' => now()
            ]
        ]);
    }
}
