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
        Schema::create('innodb_table_stats', function (Blueprint $table) {
            $table->string('database_name', 64);
            $table->string('table_name', 199);
            $table->timestamp('last_update')->useCurrentOnUpdate()->useCurrent();
            $table->unsignedBigInteger('n_rows');
            $table->unsignedBigInteger('clustered_index_size');
            $table->unsignedBigInteger('sum_of_other_index_sizes');

            $table->primary(['database_name', 'table_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('innodb_table_stats');
    }
};
