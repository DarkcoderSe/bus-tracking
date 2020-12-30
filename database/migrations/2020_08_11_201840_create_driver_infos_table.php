<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // aditional info of driver will be stored here. 
        Schema::create('driver_infos', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('driver_id')->constrained('users'); // foreign key with driver.
            $table->unsignedBigInteger('driver_id');
            $table->string('license_no'); // driver license no will be stored here.
            $table->integer('experience')->default(0); // how many years of driver's experience will be stored here.
            $table->boolean('status')->default(0); /// status of driver is he active or not.
            $table->bigInteger('pay')->default(0); // driver pay.
            $table->bigInteger('reputation')->default(0); // driver reputation given by students, faculty etc.
            $table->text('description')->nullable(); // aditional info i.e medical test, track record.

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
        Schema::dropIfExists('driver_infos');
    }
}
