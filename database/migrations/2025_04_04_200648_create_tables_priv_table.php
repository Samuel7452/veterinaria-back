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
        Schema::create('tables_priv', function (Blueprint $table) {
            $table->char('Host', 60)->default('');
            $table->char('Db', 64)->default('');
            $table->char('User', 80)->default('');
            $table->char('Table_name', 64)->default('');
            $table->char('Grantor', 141)->default('')->index('Grantor');
            $table->timestamp('Timestamp')->useCurrentOnUpdate()->useCurrent();
            $table->set('Table_priv', ['Select', 'Insert', 'Update', 'Delete', 'Create', 'Drop', 'Grant', 'References', 'Index', 'Alter', 'Create View', 'Show view', 'Trigger', 'Delete versioning rows'])->default('');
            $table->set('Column_priv', ['Select', 'Insert', 'Update', 'References'])->default('');

            $table->primary(['Host', 'Db', 'User', 'Table_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables_priv');
    }
};
