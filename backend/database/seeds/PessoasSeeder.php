<?php

use Illuminate\Database\Seeder;
use App\Models\Pessoa;

class PessoasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pessoas = [
            [
                'nome' => 'Jorge da Silva',
                'email' => 'jorge@terra.com.br',
                'categoria_id' => 1,
            ],
            [
                'nome' => 'Flavia Monteiro',
                'email' => 'flavia@globo.com',
                'categoria_id' => 2,
            ],
            [
                'nome' => 'Marcos Frota Ribeiro',
                'email' => 'ribeiro@gmail.com',
                'categoria_id' => 2,
            ],
        ];

        foreach ($pessoas as $pessoa) {
            Pessoa::firstOrCreate([
                'nome' => $pessoa['nome'],
                'email' => $pessoa['email'],
                'categoria_id' => $pessoa['categoria_id'],
            ]);
        }
    }
}
