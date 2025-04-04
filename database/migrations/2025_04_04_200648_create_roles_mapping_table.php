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
        Schema::create('roles_mapping', function (Blueprint $table) {
            $table->char('Host', 60)->default('');
            $table->char('User', 80)->default('');
            $table->char('Role', 80)->default('');
            $table->enum('Admin_option', ['N', 'Y'])->default('N');

            $table->unique(['Host', 'User', 'Role'], 'Host');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_mapping');
    }
};
