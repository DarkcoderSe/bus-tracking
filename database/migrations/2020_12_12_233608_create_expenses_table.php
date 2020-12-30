<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('+');
            $table->string('title')->nullable();
            $table->bigInteger('amount')->default(0);
            
            $table->unsignedBigInteger('driver_id');
            // $table->foreign('driver_id')->references('id')->on('users');
            // $table->unsignedBigInteger
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
        Schema::dropIfExists('expenses');
    }
}
