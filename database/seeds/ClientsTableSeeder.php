<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Codeproject\Entities\Client::class, 10)->create();

        DB::table('clients')
            ->insert([
                'name'=>'Mauri',
                'responsible'=>'Mauri de Souza Nunes',
                'email'=>'mauri870@gmail.com',
                'phone'=>'5481189792',
                'adress'=>'Rua Cristiano Ziegler Filho, 341',
                'obs'=>'Isto e uma observacao',
            ]);


    }
}
