<?php

namespace Database\Seeders;

use App\Models\UsuarioTipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           UsuarioTipo::factory()->create([
               'nome' => 'Admin'
           ]);
           UsuarioTipo::factory()->create([
                'nome' => 'Cliente'
           ]);
           UsuarioTipo::factory()->create([
                'nome' => 'freelance'
           ]);
    }
}
