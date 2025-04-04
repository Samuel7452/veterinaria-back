<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_zone_transition', function (Blueprint $table) {
            $table->unsignedInteger('Time_zone_id');
            $table->bigInteger('Transition_time');
            $table->unsignedInteger('Transition_type_id');

            $table->primary(['Time_zone_id', 'Transition_time']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_zone_transition');
    }
};
