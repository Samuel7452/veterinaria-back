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
        Schema::create('column_stats', function (Blueprint $table) {
            $table->string('db_name', 64);
            $table->string('table_name', 64);
            $table->string('column_name', 64);
            $table->binary('min_value')->nullable();
            $table->binary('max_value')->nullable();
            $table->decimal('nulls_ratio', 12, 4)->nullable();
            $table->decimal('avg_length', 12, 4)->nullable();
            $table->decimal('avg_frequency', 12, 4)->nullable();
            $table->unsignedTinyInteger('hist_size')->nullable();
            $table->enum('hist_type', ['SINGLE_PREC_HB', 'DOUBLE_PREC_HB'])->nullable();
            $table->binary('histogram')->nullable();

            $table->primary(['db_name', 'table_name', 'column_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('column_stats');
    }
};
