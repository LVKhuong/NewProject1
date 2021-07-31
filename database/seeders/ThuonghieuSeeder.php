<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThuonghieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('thuonghieus')->insert([
            ['ten' => 'Adidas', 'duongdan' => 'duongdanAdidas'],
            ['ten' => 'Nike', 'duongdan' => 'duongdanNike'],
            ['ten' => 'Levis', 'duongdan' => 'duongdanLevis'],
            ['ten' => 'Puma', 'duongdan' => 'duongdanPuma'],
            ['ten' => 'Converse', 'duongdan' => 'duongdanConverse'],
            ['ten' => 'Vans', 'duongdan' => 'duongdanVans'],
            ['ten' => 'Stussy', 'duongdan' => 'duongdanStussy'],
        ]);
    }
}
