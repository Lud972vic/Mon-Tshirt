<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldAdresseIdTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('adresse_id')->nullable();
            $table->foreign('adresse_id')
                ->references('id')
                ->references('id')
                ->on('adresses')
                ->onDelete('set null');
            //si on supprime une adresse on met null dans sa cles etrangere dans user,
            // afin de ne pas supprimer l user.

            Schema::enableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
