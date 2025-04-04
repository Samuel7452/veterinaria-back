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
        Schema::create('transaction_registry', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_id')->primary();
            $table->unsignedBigInteger('commit_id')->unique('commit_id');
            $table->timestamp('begin_timestamp', 6)->default('0000-00-00 00:00:00.000000')->index('begin_timestamp');
            $table->timestamp('commit_timestamp', 6)->default('0000-00-00 00:00:00.000000');
            $table->enum('isolation_level', ['READ-UNCOMMITTED', 'READ-COMMITTED', 'REPEATABLE-READ', 'SERIALIZABLE']);

            $table->index(['commit_timestamp', 'transaction_id'], 'commit_timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_registry');
    }
};
