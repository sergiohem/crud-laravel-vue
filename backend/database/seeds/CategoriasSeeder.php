<?php

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            'Admin', 'Gerente', 'Normal'
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate([
                'nome' => $categoria
            ]);
        }
    }
}
