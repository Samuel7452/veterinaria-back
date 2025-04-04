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
        Schema::create('table_stats', function (Blueprint $table) {
            $table->string('db_name', 64);
            $table->string('table_name', 64);
            $table->unsignedBigInteger('cardinality')->nullable();

            $table->primary(['db_name', 'table_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_stats');
    }
};
