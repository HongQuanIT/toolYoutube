<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrameTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frame', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',191)
                ->comment('file name');
            $table->string('description',191)
                ->comment('description frame');
            $table->string('url_demo',191)
                ->comment('Link video demo');
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
        Schema::dropIfExists('frame');
    }
}
