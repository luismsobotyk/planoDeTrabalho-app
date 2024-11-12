<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('periodo')->insert([
            [
                'abertura' => '2023-01-01',
                'fechamento' => '2023-02-15',
                'semestre' => '2023/1',
                'cadastrado_por' => 'luissobotyk',
                'created_at' => now()
            ],
            [
                'abertura' => '2023-06-10',
                'fechamento' => '2023-07-05',
                'semestre' => '2023/2',
                'cadastrado_por' => 'deniriomarques',
                'created_at' => now()
            ],
            [
                'abertura' => '2024-01-07',
                'fechamento' => '2024-02-20',
                'semestre' => '2024/1',
                'cadastrado_por' => 'deniriomarques',
                'created_at' => now()
            ],
            [
                'abertura' => '2024-07-15',
                'fechamento' => '2024-07-31',
                'semestre' => '2024/2',
                'cadastrado_por' => 'luissobotyk',
                'created_at' => now()
            ]
        ]);
    }
}
