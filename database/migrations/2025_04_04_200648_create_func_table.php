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
        Schema::create('func', function (Blueprint $table) {
            $table->char('name', 64)->default('')->primary();
            $table->boolean('ret')->default(false);
            $table->char('dl', 128)->default('');
            $table->enum('type', ['function', 'aggregate']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('func');
    }
};
