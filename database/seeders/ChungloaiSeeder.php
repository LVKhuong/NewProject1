<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChungloaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chungloais')->insert([
            ['ten' => 'Quần'],
            ['ten' => 'Áo'],
            ['ten' => 'Giầy'],
            ['ten' => 'Mũ']
        ]);
    }
}
