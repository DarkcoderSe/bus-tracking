<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Registered students to specific vehicle.
        Schema::create('user_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // foreign key to users i.e: students, teachers
            $table->foreignId('vehicle_id')->constrained(); // foreign key to vehicle.
         
            $table->timestamps(); // registration date.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_vehicles');
    }
}
