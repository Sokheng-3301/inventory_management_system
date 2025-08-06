<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
      
            $data = DB::table('users')->get();
            
            $card_id = $data['card_id'];

            DB::table('staff_users')
                ->insert(['card_id' => $card_id]);
        
    }
}
