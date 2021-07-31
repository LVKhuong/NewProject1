<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitietdonhangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietdonhangs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sanpham');
            $table->integer('id_donhang');
            $table->integer('soluong');
            $table->integer('gia');
            $table->integer('thanhtien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietdonhangs');
    }
}
