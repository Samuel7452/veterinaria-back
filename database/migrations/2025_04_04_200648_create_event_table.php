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
        Schema::create('event', function (Blueprint $table) {
            $table->char('db', 64)->default('');
            $table->char('name', 64)->default('');
            $table->binary('body');
            $table->char('definer', 141)->default('');
            $table->dateTime('execute_at')->nullable();
            $table->integer('interval_value')->nullable();
            $table->enum('interval_field', ['YEAR', 'QUARTER', 'MONTH', 'DAY', 'HOUR', 'MINUTE', 'WEEK', 'SECOND', 'MICROSECOND', 'YEAR_MONTH', 'DAY_HOUR', 'DAY_MINUTE', 'DAY_SECOND', 'HOUR_MINUTE', 'HOUR_SECOND', 'MINUTE_SECOND', 'DAY_MICROSECOND', 'HOUR_MICROSECOND', 'MINUTE_MICROSECOND', 'SECOND_MICROSECOND'])->nullable();
            $table->timestamp('created')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('modified')->default('0000-00-00 00:00:00');
            $table->dateTime('last_executed')->nullable();
            $table->dateTime('starts')->nullable();
            $table->dateTime('ends')->nullable();
            $table->enum('status', ['ENABLED', 'DISABLED', 'SLAVESIDE_DISABLED'])->default('ENABLED');
            $table->enum('on_completion', ['DROP', 'PRESERVE'])->default('DROP');
            $table->set('sql_mode', ['REAL_AS_FLOAT', 'PIPES_AS_CONCAT', 'ANSI_QUOTES', 'IGNORE_SPACE', 'IGNORE_BAD_TABLE_OPTIONS', 'ONLY_FULL_GROUP_BY', 'NO_UNSIGNED_SUBTRACTION', 'NO_DIR_IN_CREATE', 'POSTGRESQL', 'ORACLE', 'MSSQL', 'DB2', 'MAXDB', 'NO_KEY_OPTIONS', 'NO_TABLE_OPTIONS', 'NO_FIELD_OPTIONS', 'MYSQL323', 'MYSQL40', 'ANSI', 'NO_AUTO_VALUE_ON_ZERO', 'NO_BACKSLASH_ESCAPES', 'STRICT_TRANS_TABLES', 'STRICT_ALL_TABLES', 'NO_ZERO_IN_DATE', 'NO_ZERO_DATE', 'INVALID_DATES', 'ERROR_FOR_DIVISION_BY_ZERO', 'TRADITIONAL', 'NO_AUTO_CREATE_USER', 'HIGH_NOT_PRECEDENCE', 'NO_ENGINE_SUBSTITUTION', 'PAD_CHAR_TO_FULL_LENGTH', 'EMPTY_STRING_IS_NULL', 'SIMULTANEOUS_ASSIGNMENT', 'TIME_ROUND_FRACTIONAL'])->default('');
            $table->char('comment', 64)->default('');
            $table->unsignedInteger('originator');
            $table->char('time_zone', 64)->default('SYSTEM');
            $table->char('character_set_client', 32)->nullable();
            $table->char('collation_connection', 32)->nullable();
            $table->char('db_collation', 32)->nullable();
            $table->binary('body_utf8')->nullable();

            $table->primary(['db', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event');
    }
};
