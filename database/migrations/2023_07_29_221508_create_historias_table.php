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
        Schema::create('historias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id'); // Clave foránea para la tabla 'clientes'
            $table->unsignedBigInteger('mascota_id'); // Clave foránea para la tabla 'mascotas'
            $table->decimal('temperatura', 5, 2); // Campo para la temperatura (5 dígitos en total, 2 decimales)
            $table->decimal('peso', 6, 2); // Campo para el peso (6 dígitos en total, 2 decimales)
            $table->integer('frecuencia_cardiaca'); // Campo para la frecuencia cardíaca (número entero)
            $table->text('observacion')->nullable(); // Campo para las observaciones (texto, permitir nulo)
            $table->timestamps();

            // Definimos las claves foráneas
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade');

            $table->foreign('mascota_id')
                ->references('id')
                ->on('mascotas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historias');
    }
};
