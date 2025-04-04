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
        Schema::create('columns_priv', function (Blueprint $table) {
            $table->char('Host', 60)->default('');
            $table->char('Db', 64)->default('');
            $table->char('User', 80)->default('');
            $table->char('Table_name', 64)->default('');
            $table->char('Column_name', 64)->default('');
            $table->timestamp('Timestamp')->useCurrentOnUpdate()->useCurrent();
            $table->set('Column_priv', ['Select', 'Insert', 'Update', 'References'])->default('');

            $table->primary(['Host', 'Db', 'User', 'Table_name', 'Column_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('columns_priv');
    }
};
