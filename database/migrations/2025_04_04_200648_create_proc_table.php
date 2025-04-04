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
        Schema::create('proc', function (Blueprint $table) {
            $table->char('db', 64)->default('');
            $table->char('name', 64)->default('');
            $table->enum('type', ['FUNCTION', 'PROCEDURE', 'PACKAGE', 'PACKAGE BODY']);
            $table->char('specific_name', 64)->default('');
            $table->enum('language', ['SQL'])->default('SQL');
            $table->enum('sql_data_access', ['CONTAINS_SQL', 'NO_SQL', 'READS_SQL_DATA', 'MODIFIES_SQL_DATA'])->default('CONTAINS_SQL');
            $table->enum('is_deterministic', ['YES', 'NO'])->default('NO');
            $table->enum('security_type', ['INVOKER', 'DEFINER'])->default('DEFINER');
            $table->binary('param_list');
            $table->binary('returns');
            $table->binary('body');
            $table->char('definer', 141)->default('');
            $table->timestamp('created')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('modified')->default('0000-00-00 00:00:00');
            $table->set('sql_mode', ['REAL_AS_FLOAT', 'PIPES_AS_CONCAT', 'ANSI_QUOTES', 'IGNORE_SPACE', 'IGNORE_BAD_TABLE_OPTIONS', 'ONLY_FULL_GROUP_BY', 'NO_UNSIGNED_SUBTRACTION', 'NO_DIR_IN_CREATE', 'POSTGRESQL', 'ORACLE', 'MSSQL', 'DB2', 'MAXDB', 'NO_KEY_OPTIONS', 'NO_TABLE_OPTIONS', 'NO_FIELD_OPTIONS', 'MYSQL323', 'MYSQL40', 'ANSI', 'NO_AUTO_VALUE_ON_ZERO', 'NO_BACKSLASH_ESCAPES', 'STRICT_TRANS_TABLES', 'STRICT_ALL_TABLES', 'NO_ZERO_IN_DATE', 'NO_ZERO_DATE', 'INVALID_DATES', 'ERROR_FOR_DIVISION_BY_ZERO', 'TRADITIONAL', 'NO_AUTO_CREATE_USER', 'HIGH_NOT_PRECEDENCE', 'NO_ENGINE_SUBSTITUTION', 'PAD_CHAR_TO_FULL_LENGTH', 'EMPTY_STRING_IS_NULL', 'SIMULTANEOUS_ASSIGNMENT', 'TIME_ROUND_FRACTIONAL'])->default('');
            $table->text('comment');
            $table->char('character_set_client', 32)->nullable();
            $table->char('collation_connection', 32)->nullable();
            $table->char('db_collation', 32)->nullable();
            $table->binary('body_utf8')->nullable();
            $table->enum('aggregate', ['NONE', 'GROUP'])->default('NONE');

            $table->primary(['db', 'name', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proc');
    }
};
