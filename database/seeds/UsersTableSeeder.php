<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(Codeproject\Entities\User::class)->create([
            'name' => 'Mauri de Souza Nunes',
            'email' => 'mauri870@gmail.com',
            'password' => bcrypt(12345678),
            'remember_token' => str_random(10),
        ]);*/
        factory(Codeproject\Entities\User::class, 10)->create();

    }
}
