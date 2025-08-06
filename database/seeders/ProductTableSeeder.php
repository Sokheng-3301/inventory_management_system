<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            DB::table('products')->insert([
                'pro_name_kh' => Str::random(10),
                'pro_name_en' => Str::random(10),
                'pro_code'    => Str::random(10),
                'cat_id'      => '1',
                'qty'         => '15',
                'pro_description' => Str::random(120),
                'add_by' => 'Admin',
            ]);
        }
    }
}
