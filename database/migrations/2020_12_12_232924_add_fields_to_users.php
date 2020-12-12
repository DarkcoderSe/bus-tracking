<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('next_payment')->nullable();
            $table->boolean('status')->default(true);
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('fee')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('next_payment');
            $table->dropColumn('status');
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('fee');
        });
    }
}
