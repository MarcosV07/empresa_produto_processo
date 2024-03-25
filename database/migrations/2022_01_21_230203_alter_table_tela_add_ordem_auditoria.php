<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableTelaAddOrdemAuditoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('telas', function (Blueprint $table) {
            $table->integer("ordem")->nullable();
            $table->boolean("auditoria")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('telas', function (Blueprint $table) {
            $table->dropColumn("ordem");
            $table->dropColumn("auditoria");
        });
    }
}
