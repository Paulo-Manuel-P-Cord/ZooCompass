<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStoresTable extends Migration
{
    /**
     * Execute as alterações na tabela.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            // Modifica a coluna 'category' para não permitir valores nulos e define um valor padrão
            $table->integer('category')->unsigned()->default(1)->change();
        });
    }

    /**
     * Reverte as alterações na tabela.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            // Reverte a coluna 'category' para permitir valores nulos
            $table->integer('category')->nullable()->change();
        });
    }
}
