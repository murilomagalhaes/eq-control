<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->string('nome', 40);
            $table->string('telefone', 11);
            $table->dateTime('dt_entrada');
            $table->dateTime('dt_previsao')->nullable();
            $table->foreignId('responsavel_id')->references('id')->on('users');
            $table->string('prioridade', 1);
            $table->foreignId('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('registries');
    }
}
