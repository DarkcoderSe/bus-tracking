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
        // all types of users can be stored here. ie: driver, faculty, student, admins etc...
        // because we are using role based system for that. please see the laratrust table for roles and permissions.
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('contact_no')->default(0); // contact no of user.
            $table->string('picture')->nullable(); // student, driver, faculty profile pic.
            $table->text('address')->nullable(); // address of user will be stored here. 
            $table->string('reg_no')->nullable(); // registration of student.
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
