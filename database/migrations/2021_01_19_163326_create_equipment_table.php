<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->references('id')->on('equipment_types')->onDelete('cascade');;
            $table->foreignId('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->string('num_serie')->nullable();
            $table->string('descricao')->nullable();
            $table->text('problemas');
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
        Schema::dropIfExists('equipment');
    }
}
