<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisoRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permiso_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permiso_id')->constrained('permisos');//parte de la PK
            $table->foreignId('role_id')->constrained('roles');//parte de la PK
            $table->timestamps();
            $table->unique(['permiso_id', 'role_id']);//PRIMARY KEY
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permiso_role');
    }
}
