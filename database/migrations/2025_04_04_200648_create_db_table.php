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
        Schema::create('db', function (Blueprint $table) {
            $table->char('Host', 60)->default('');
            $table->char('Db', 64)->default('');
            $table->char('User', 80)->default('')->index('User');
            $table->enum('Select_priv', ['N', 'Y'])->default('N');
            $table->enum('Insert_priv', ['N', 'Y'])->default('N');
            $table->enum('Update_priv', ['N', 'Y'])->default('N');
            $table->enum('Delete_priv', ['N', 'Y'])->default('N');
            $table->enum('Create_priv', ['N', 'Y'])->default('N');
            $table->enum('Drop_priv', ['N', 'Y'])->default('N');
            $table->enum('Grant_priv', ['N', 'Y'])->default('N');
            $table->enum('References_priv', ['N', 'Y'])->default('N');
            $table->enum('Index_priv', ['N', 'Y'])->default('N');
            $table->enum('Alter_priv', ['N', 'Y'])->default('N');
            $table->enum('Create_tmp_table_priv', ['N', 'Y'])->default('N');
            $table->enum('Lock_tables_priv', ['N', 'Y'])->default('N');
            $table->enum('Create_view_priv', ['N', 'Y'])->default('N');
            $table->enum('Show_view_priv', ['N', 'Y'])->default('N');
            $table->enum('Create_routine_priv', ['N', 'Y'])->default('N');
            $table->enum('Alter_routine_priv', ['N', 'Y'])->default('N');
            $table->enum('Execute_priv', ['N', 'Y'])->default('N');
            $table->enum('Event_priv', ['N', 'Y'])->default('N');
            $table->enum('Trigger_priv', ['N', 'Y'])->default('N');
            $table->enum('Delete_history_priv', ['N', 'Y'])->default('N');

            $table->primary(['Host', 'Db', 'User']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('db');
    }
};
