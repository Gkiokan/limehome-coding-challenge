<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();

            $table->string('role')->default(null)->nullable();
            $table->boolean('valid')->default(0)->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->boolean('gain_access')->default(0)->nullable();

            $table->string('firstname')->default(null)->nullable();
            $table->string('lastname')->default(null)->nullable();
            $table->string('mobile')->default(null)->nullable();

            $table->string('password')->nullable();
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
