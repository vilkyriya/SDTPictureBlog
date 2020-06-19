<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images_user', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigInteger('images_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('images_id')
                ->references('id')->on('images')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images_user');
    }
}
