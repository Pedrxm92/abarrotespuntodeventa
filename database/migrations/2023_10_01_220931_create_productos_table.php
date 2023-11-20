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
 Schema::create('productos', function (Blueprint $table) {
 $table->id();
 $table->string('nombre',100);
 $table->string('descripcion')->nullable(); //El campo puede ser nulo
 $table->integer('precio');
 $table->integer('stock');
 $table->foreignId('categoria_id')->constrained();
 $table->timestamps();
 });
 }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
