<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTipoRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_tipo_role', function (Blueprint $table) {
            $table->id();

            $table->foreignId('role_id')->constrained()
                ->onDelete('cascade');
            $table->foreignId('tipo_role_id')->constrained('tipo_role')
                ->onDelete('cascade');

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
        Schema::dropIfExists('role_tipo_role');
    }
}
