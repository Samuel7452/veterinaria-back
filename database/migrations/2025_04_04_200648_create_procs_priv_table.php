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
        Schema::create('procs_priv', function (Blueprint $table) {
            $table->char('Host', 60)->default('');
            $table->char('Db', 64)->default('');
            $table->char('User', 80)->default('');
            $table->char('Routine_name', 64)->default('');
            $table->enum('Routine_type', ['FUNCTION', 'PROCEDURE', 'PACKAGE', 'PACKAGE BODY']);
            $table->char('Grantor', 141)->default('')->index('Grantor');
            $table->set('Proc_priv', ['Execute', 'Alter Routine', 'Grant'])->default('');
            $table->timestamp('Timestamp')->useCurrentOnUpdate()->useCurrent();

            $table->primary(['Host', 'Db', 'User', 'Routine_name', 'Routine_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procs_priv');
    }
};
