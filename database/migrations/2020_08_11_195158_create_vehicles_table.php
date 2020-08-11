<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // This is the table for vehicles. we store all info about buses, cars etc...
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id(); // primary key of this table.
            $table->foreignId('driver_id')->constrained('users'); // creating foreign of driver to this vehicle.
            $table->string('registration_no'); // vehicle registration plate no.
            $table->bigInteger('seats'); // how many students can register for this vehicle.
            $table->text('description')->nullable(); // any additional info will be stored here.
            $table->string('latitude')->nullable(); // location of vehicle will be stored here. 
            $table->string('longitude')->nullable();
            $table->boolean('status')->default(0); // status of vehicle is it in running form etc. value can be 0 or 1;
            $table->text('route')->nullable(); // vehicle route will be stored.
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
        Schema::dropIfExists('vehicles');
    }
}
