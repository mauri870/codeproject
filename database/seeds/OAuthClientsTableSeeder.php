<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OAuthClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert(['id'=>1,'secret'=>'secret','name'=>'Codeproject','created_at'=>Carbon\Carbon::now(),'updated_at'=>Carbon\Carbon::now()]);
    }
}
