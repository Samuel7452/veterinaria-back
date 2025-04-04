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
        Schema::create('general_log', function (Blueprint $table) {
            $table->timestamp('event_time', 6)->default('current_timestamp(6)');
            $table->mediumText('user_host');
            $table->unsignedBigInteger('thread_id');
            $table->unsignedInteger('server_id');
            $table->string('command_type', 64);
            $table->mediumText('argument');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_log');
    }
};
