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
        Schema::create('index_stats', function (Blueprint $table) {
            $table->string('db_name', 64);
            $table->string('table_name', 64);
            $table->string('index_name', 64);
            $table->unsignedInteger('prefix_arity');
            $table->decimal('avg_frequency', 12, 4)->nullable();

            $table->primary(['db_name', 'table_name', 'index_name', 'prefix_arity']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('index_stats');
    }
};
