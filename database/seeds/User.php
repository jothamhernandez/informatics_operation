<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('users')->insert([
            [
                'name'=>'Jotham Hernandez',
                'email'=>'admin@email.com',
                'role'=>'admin',
                'api_token'=> str_random(61),
                'password'=>bcrypt('admin1234')
            ],
            [
                'name'=>'Charlyne Ebetuer-Santos',
                'email'=>'csantos@informatics.com.ph',
                'role'=>'cluster head',
                'api_token'=> str_random(61),
                'password'=>bcrypt('admin1234')
            ],
            [
                'name'=>'Yolanda Soliveres',
                'email'=>'ysoliveres@informatics.com.ph',
                'role'=>'cluster head',
                'api_token'=> str_random(61),
                'password'=>bcrypt('admin1234')
            ], 
            [
                'name'=>'John Nicole Bueno',
                'email'=>'jbueno@informatics.com.ph',
                'role'=>'center manager',
                'api_token'=> str_random(61),
                'password'=>bcrypt('admin1234')
            ],
            [
                'name'=>'Rolan Macarang',
                'email'=>'rmacarang@informatics.com.ph',
                'role'=>'center manager',
                'api_token'=> str_random(61),
                'password'=>bcrypt('admin1234')
            ],
            [
                'name'=>'Maria Gina Magat',
                'email'=>'mrmagat@informatics.com.ph',
                'role'=>'center manager',
                'api_token'=> str_random(61),
                'password'=>bcrypt('admin1234')
            ],
            [
                'name'=>'Alejandro Bautista',
                'email'=>'abautista@informatics.com.ph',
                'role'=>'center manager',
                'api_token'=> str_random(61),
                'password'=>bcrypt('admin1234')
            ],
            [
                'name'=>'Jhon Tanacio',
                'email'=>'jtanacio@informatics.com.ph',
                'role'=>'center manager',
                'api_token'=> str_random(61),
                'password'=>bcrypt('admin1234')
            ],
            [
                'name'=>'Jenifer Sebastian',
                'email'=>'jsebastian@informatics.com.ph',
                'role'=>'center manager',
                'api_token'=> str_random(61),
                'password'=>bcrypt('admin1234')
            ],
            [
                'name'=>'Janice Aguilar',
                'email'=>'jaguilar@informatics.com.ph',
                'role'=>'center manager',
                'api_token'=> str_random(61),
                'password'=>bcrypt('admin1234')
            ],
            [
                'name'=>'Joanne Enaya',
                'email'=>'jenaya@informatics.com.ph',
                'role'=>'center manager',
                'api_token'=> str_random(61),
                'password'=>bcrypt('admin1234')
            ],
            [
                'name'=>'Mary Grace Sumagaysay',
                'email'=>'msumagaysay@informatics.com.ph',
                'role'=>'center manager',
                'api_token'=> str_random(61),
                'password'=>bcrypt('admin1234')
            ],
        ]);
    }
}
