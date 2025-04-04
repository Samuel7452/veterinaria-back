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
        Schema::create('time_zone_transition_type', function (Blueprint $table) {
            $table->unsignedInteger('Time_zone_id');
            $table->unsignedInteger('Transition_type_id');
            $table->integer('Offset')->default(0);
            $table->unsignedTinyInteger('Is_DST')->default(0);
            $table->char('Abbreviation', 8)->default('');

            $table->primary(['Time_zone_id', 'Transition_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_zone_transition_type');
    }
};
