<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('area', 15)->unique();
            $table->string('icono', 50);
            $table->string('url', 75)->unique();
            $table->integer('orden');
            $table->boolean('menu');
            $table->boolean('activo')->default(true);
            $table->text('descripcion')->nullable();
            
            $table->foreignId('modulo_id')->constrained();

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
        Schema::dropIfExists('areas');
    }
}
