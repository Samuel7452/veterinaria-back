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
        Schema::create('help_topic', function (Blueprint $table) {
            $table->unsignedInteger('help_topic_id')->primary();
            $table->char('name', 64)->unique('name');
            $table->unsignedSmallInteger('help_category_id');
            $table->text('description');
            $table->text('example');
            $table->text('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_topic');
    }
};
