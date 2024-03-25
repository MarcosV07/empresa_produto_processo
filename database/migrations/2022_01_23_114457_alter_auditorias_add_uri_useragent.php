<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAuditoriasAddUriUseragent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auditorias', function (Blueprint $table) {
            $table->string("url", 200)->nullable();
            $table->string("dispositivo", 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auditorias', function (Blueprint $table) {
            $table->dropColumn("url");
            $table->dropColumn("dispositivo");
        });
    }
}
