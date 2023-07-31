<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('raza', 100);
            $table->unsignedBigInteger('Codigo_cliente'); // Utiliza unsignedBigInteger
            $table->string('Sexo', 20);
            $table->timestamps();

            $table->foreign('Codigo_cliente') // Define la clave foránea en la columna 'Codigo_cliente'
                ->references('id') // Hace referencia a la columna 'id' en la tabla 'clientes'
                ->on('clientes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
