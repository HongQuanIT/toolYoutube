<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',191)
                ->comment('video name');
            $table->string('description',191)
                ->comment('Description permission');
            $table->string('path',191)
                ->comment('Path');
            $table->unsignedTinyInteger('type')
                ->comment('Type');
            $table->string('extension',191)
                ->comment('Extension');
            $table->unsignedBigInteger('size')
                ->comment(' Size');
            $table->unsignedBigInteger('user_id')
                ->comment('References to users');

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video');
    }
}
