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
        Schema::create('help_category', function (Blueprint $table) {
            $table->unsignedSmallInteger('help_category_id')->primary();
            $table->char('name', 64)->unique('name');
            $table->unsignedSmallInteger('parent_category_id')->nullable();
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
        Schema::dropIfExists('help_category');
    }
};
