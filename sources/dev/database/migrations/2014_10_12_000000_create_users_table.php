<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',191);
            $table->string('email',191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',255);
            $table->unsignedTinyInteger('type')
                ->default(1)
                ->comment('Type: 1-nomal, 2-vip1, 3-vip2');
            $table->boolean('rendering')
                ->default(false)
                ->comment('Rendering Status, false: not render, true: rendering');
            $table->boolean('status')
                ->default(true)
                ->comment('Status, false: Inactive, true: Active');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
