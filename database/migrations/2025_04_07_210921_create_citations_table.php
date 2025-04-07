<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id')->index('citations_pet_id_foreign');
            $table->foreign(['pet_id'])->references(['id'])->on('pets')->onDelete('CASCADE');
            $table->unsignedBigInteger('vet_id')->index('citations_vet_id_foreign');
            $table->foreign(['vet_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->date('date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citations');
    }
}
