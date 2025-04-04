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
        Schema::create('innodb_index_stats', function (Blueprint $table) {
            $table->string('database_name', 64);
            $table->string('table_name', 199);
            $table->string('index_name', 64);
            $table->timestamp('last_update')->useCurrentOnUpdate()->useCurrent();
            $table->string('stat_name', 64);
            $table->unsignedBigInteger('stat_value');
            $table->unsignedBigInteger('sample_size')->nullable();
            $table->string('stat_description', 1024);

            $table->primary(['database_name', 'table_name', 'index_name', 'stat_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('innodb_index_stats');
    }
};
