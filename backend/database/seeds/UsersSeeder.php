<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            User::firstOrCreate([
                'name' => 'Admin',
                'email' => 'admin@teste.com',
                'password' => bcrypt('123456'),
            ]);
        }
    }
}
