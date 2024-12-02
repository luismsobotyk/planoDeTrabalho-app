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
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'marciafranco',
                'nome' => 'Marcia Franco',
                'cargo' => 'docente',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'deniriomarques',
                'nome' => 'Denírio Marques',
                'cargo' => 'admin',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'alexgonsales',
                'nome' => 'Alex Dias Gonsales',
                'cargo' => 'docente',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'alexoliveira',
                'nome' => 'Alex Martins de Oliveira',
                'cargo' => 'docente',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'andreperes',
                'nome' => 'André Peres',
                'cargo' => 'docente',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'cesarloureiro',
                'nome' => 'César Augusto Hass Loureiro',
                'cargo' => 'docente',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'evandromiletto',
                'nome' => 'Evandro Manara Miletto',
                'cargo' => 'docente',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'fabiotokuyama',
                'nome' => 'Fabio Yoshimitsu Okuyama',
                'cargo' => 'docente',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'fabricianoronha',
                'nome' => 'Fabrícia Py Tortelli Noronha',
                'cargo' => 'docente',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'marceloschmitt',
                'nome' => 'Marcelo Augusto Rauh Schmitt',
                'cargo' => 'docente',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'rodrigomachado',
                'nome' => 'Rodrigo Prestes Machado',
                'cargo' => 'docente',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'silviabertagnolli',
                'nome' => 'Silvia de Castro Bertagnolli',
                'cargo' => 'docente',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'tanisicarvalho',
                'nome' => 'Tanisi Pereira de Carvalho',
                'cargo' => 'docente',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
            [
                'login' => 'timoteolange',
                'nome' => 'Timóteo Alberto Peters Lange',
                'cargo' => 'docente',
                'SIAPE' => rand(1000000, 9999999),
                'created_at' => now()
            ],
        ]);
    }
}
