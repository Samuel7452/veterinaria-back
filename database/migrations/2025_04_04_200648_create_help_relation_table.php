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
        Schema::create('help_relation', function (Blueprint $table) {
            $table->unsignedInteger('help_topic_id');
            $table->unsignedInteger('help_keyword_id');

            $table->primary(['help_keyword_id', 'help_topic_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_relation');
    }
};
