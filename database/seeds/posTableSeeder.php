<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class posTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $poses = ['101', '102', '201', '202', '203'];
        $now = Carbon::now();
        foreach( $poses as $pos ){
            DB::table('pos')->insert([
                'number' => $pos, 
                'created_at' => $now, 
                'updated_at' => $now
            ]);
        }
    }
}
