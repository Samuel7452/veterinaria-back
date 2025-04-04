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
        Schema::create('slow_log', function (Blueprint $table) {
            $table->timestamp('start_time', 6)->default('current_timestamp(6)');
            $table->mediumText('user_host');
            $table->time('query_time', 6);
            $table->time('lock_time', 6);
            $table->integer('rows_sent');
            $table->integer('rows_examined');
            $table->string('db', 512);
            $table->integer('last_insert_id');
            $table->integer('insert_id');
            $table->unsignedInteger('server_id');
            $table->mediumText('sql_text');
            $table->unsignedBigInteger('thread_id');
            $table->integer('rows_affected');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slow_log');
    }
};
