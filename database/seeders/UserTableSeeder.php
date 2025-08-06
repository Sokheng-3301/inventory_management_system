<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $runTime = DB::table('users')->insert([
                // '' => Str::random(10),
                'name' => Str::random(10),
                'email'    => Str::random(3),
                'password'      => '$2y$12$pthoF9FvEcAGnco5FGNRhetP4AN/zFaDoqVckEnfsTYZYx5evT9M6',
                'role_id'         => '1',
                'created_at' => now(),
                'card_id'    => $i+2
                // 'add_by' => 'Admin',
            ]);  
        }


        if($runTime == true){
            // $data = DB::table('users')->get();
            
            // $card_id = $data->card_id;

           for($i=1; $i<=10; $i++){
            DB::table('staff_users')
            ->insert(['card_id' => $i+2]);
           }
        }
    }
    
}
