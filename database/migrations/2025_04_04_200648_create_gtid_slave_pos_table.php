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
        Schema::create('gtid_slave_pos', function (Blueprint $table) {
            $table->unsignedInteger('domain_id');
            $table->unsignedBigInteger('sub_id');
            $table->unsignedInteger('server_id');
            $table->unsignedBigInteger('seq_no');

            $table->primary(['domain_id', 'sub_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gtid_slave_pos');
    }
};
