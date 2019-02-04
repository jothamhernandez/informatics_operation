<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Center extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('centers')->insert([
            [
                'cluster_id'=>1,
                'center_manager'=>4,
                'center_name'=>"Eastwood"
            ],
            [
                'cluster_id'=>2,
                'center_manager'=>5,
                'center_name'=>"Manila"
            ],
            [
                'cluster_id'=>1,
                'center_manager'=>6,
                'center_name'=>"Megamall"
            ],
            [
                'cluster_id'=>2,
                'center_manager'=>7,
                'center_name'=>"Caloocan"
            ],
            [
                'cluster_id'=>1,
                'center_manager'=>8,
                'center_name'=>"Baguio"
            ],
            [
                'cluster_id'=>1,
                'center_manager'=>9,
                'center_name'=>"Cebu"
            ],
            [
                'cluster_id'=>1,
                'center_manager'=>10,
                'center_name'=>"Consolacion"
            ],
            [
                'cluster_id'=>1,
                'center_manager'=>11,
                'center_name'=>"Cagayan De Oro"
            ],
            [
                'cluster_id'=>1,
                'center_manager'=>12,
                'center_name'=>"Northgate"
            ]
        ]);
    }
}
