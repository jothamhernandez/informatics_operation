<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Cluster extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('clusters')->insert([
            [
                'cluster_head_id'=>2,
                'cluster_name'=>'Cluster A'
            ],
            [
                'cluster_head_id'=>3,
                'cluster_name'=>'Cluster B'
            ]
        ]);
    }
}
