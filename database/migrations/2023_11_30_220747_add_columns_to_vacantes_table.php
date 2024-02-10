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
        Schema::table('vacantes', function (Blueprint $table) {
            $table->string('titulo');
            $table->foreignId('salario_id')->constrained()->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
            $table->string('empresa');
            $table->string('ultimo_dia');
            $table->text('descripcion');
            $table->text('imagen');
            $table->integer('publicado')->default(1);
            // Este método especifica que la columna user_id está "construida" para ser una clave foránea. Laravel intentará automáticamente adivinar el nombre de la clave foránea y la tabla relacionada basándose en las convenciones de nomenclatura. En este caso, asume que la clave foránea es user_id y la tabla relacionada es users.
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vacantes', function (Blueprint $table) {
            //borrar las llaves foraneas
            $table->dropForeign('vacantes_user_id_foreign');
            $table->dropForeign('vacantes_salario_id_foreign');
            $table->dropForeign('vacantes_categoria_id_foreign');
            //borrar columnas
            $table->dropColumn(['titulo', 'salario_id', 'categoria_id', 'empresa', 'ultimo_dia', 'descripcion', 'imagen', 'publicado', 'user_id']);
        });
    }
};
