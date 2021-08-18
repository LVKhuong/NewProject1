<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSanphamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanphams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten');
            $table->integer('gia');
            $table->text('gioithieu');
            $table->integer('id_chungloai');
            $table->integer('id_thuonghieu');
            $table->integer('isHot')->default(0)->nullable();
            $table->integer('isNew')->default(0)->nullable();
            $table->integer('sale');
            $table->text('tag')->nullable();
            $table->timestamps();

            // add fulltext search
            DB::statement('ALTER TABLE sanphams ADD FULLTEXT (ten,tag)');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sanphams');
    }
}
