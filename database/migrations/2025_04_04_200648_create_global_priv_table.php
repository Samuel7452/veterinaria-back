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
        Schema::create('global_priv', function (Blueprint $table) {
            $table->char('Host', 60)->default('');
            $table->char('User', 80)->default('');
            $table->json('Priv')->default('{}');

            $table->primary(['Host', 'User']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_priv');
    }
};
