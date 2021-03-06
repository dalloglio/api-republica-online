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
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender', \App\Domains\User\User::genders())->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('admin')->default(false);
            $table->boolean('status')->default(false);
            $table->string('facebook_id')->nullable();
            $table->string('facebook_picture')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
