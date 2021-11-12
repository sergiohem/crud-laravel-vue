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
            [
                'nome' => 'Raphael Souza Santos',
                'email' => 'rsantos@gmail.com',
                'categoria_id' => 1,
            ],
            [
                'nome' => 'Pedro Paulo Mota',
                'email' => 'ppmota@gmail.com',
                'categoria_id' => 1,
            ],
            [
                'nome' => 'Winder Carvalho da Silva',
                'email' => 'winder@hotmail.com',
                'categoria_id' => 3,
            ],
            [
                'nome' => 'Maria da Penha Albuquerque',
                'email' => 'mpa@hotmail.com',
                'categoria_id' => 3,
            ],
            [
                'nome' => 'Rafael Garcia Souza',
                'email' => 'rgsouza@hotmail.com',
                'categoria_id' => 3,
            ],
            [
                'nome' => 'Tabata Costa',
                'email' => 'tabata_costa@gmail.com',
                'categoria_id' => 2,
            ],
            [
                'nome' => 'Ronil Camarote',
                'email' => 'camarote@terra.com.br',
                'categoria_id' => 1,
            ],
            [
                'nome' => 'Joaquim Barbosa',
                'email' => 'barbosa@globo.com',
                'categoria_id' => 1,
            ],
            [
                'nome' => 'Eveline Maria Alcantra',
                'email' => 'ev_alcantra@gmail.com',
                'categoria_id' => 2,
            ],
            [
                'nome' => 'João Paulo Vieira',
                'email' => 'jpvieria@gmail.com',
                'categoria_id' => 1,
            ],
            [
                'nome' => 'Carla Zamborlini',
                'email' => 'zamborlini@terra.com.br',
                'categoria_id' => 3,
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
