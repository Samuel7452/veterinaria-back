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
        Schema::create('proxies_priv', function (Blueprint $table) {
            $table->char('Host', 60)->default('');
            $table->char('User', 80)->default('');
            $table->char('Proxied_host', 60)->default('');
            $table->char('Proxied_user', 80)->default('');
            $table->boolean('With_grant')->default(false);
            $table->char('Grantor', 141)->default('')->index('Grantor');
            $table->timestamp('Timestamp')->useCurrentOnUpdate()->useCurrent();

            $table->primary(['Host', 'User', 'Proxied_host', 'Proxied_user']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proxies_priv');
    }
};
