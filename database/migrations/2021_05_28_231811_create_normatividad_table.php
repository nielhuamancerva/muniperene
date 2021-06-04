<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormatividadTable extends Migration
{

    public function up()
    {
        Schema::create('normatividad', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->string('año_documento');
            $table->string('siglas_documento');
            $table->string('resumen_documento');
            $table->string('archivo')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('normatividad');
    }
}
