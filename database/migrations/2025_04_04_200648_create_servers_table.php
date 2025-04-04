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
        Schema::create('servers', function (Blueprint $table) {
            $table->char('Server_name', 64)->default('')->primary();
            $table->char('Host', 64)->default('');
            $table->char('Db', 64)->default('');
            $table->char('Username', 80)->default('');
            $table->char('Password', 64)->default('');
            $table->integer('Port')->default(0);
            $table->char('Socket', 64)->default('');
            $table->char('Wrapper', 64)->default('');
            $table->char('Owner', 64)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
};
