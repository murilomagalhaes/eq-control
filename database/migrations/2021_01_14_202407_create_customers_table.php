<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 60);
            $table->string('razao', 60);
            $table->string('cpf_cnpj', 14)->unique();
            $table->string('email')->unique();
            $table->string('telefone', 11);
            $table->string('uf', 2);
            $table->string('cidade', 60);
            $table->string('endereco');            
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
        Schema::dropIfExists('customers');
    }
}
