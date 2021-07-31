<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileImagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('file_images', function (Blueprint $table) {
      $table->id();
      $table->string('ten_file');
      $table->string('duongdan')->nullable();
      $table->integer('imageable_id')->unsigned();
      $table->string('imageable_type');
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
    Schema::dropIfExists('file_images');
  }
}
