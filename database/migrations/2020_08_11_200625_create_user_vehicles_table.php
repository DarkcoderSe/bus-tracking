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
            $table->foreignId('vehicle')->constrained(); // foreign key to vehicle.
            $table->string('challan')->nullable(); // challan will be stored here which will student pay for registration.
            $table->bigInteger('fee')->default(0); // fee of that membership with vehicle.
            $table->date('membership_end'); // when will membership ends.
            $table->boolean('membership_status')->default(0); // status of membership is it active or not. 
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
