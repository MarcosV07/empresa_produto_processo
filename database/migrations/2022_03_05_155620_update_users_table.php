<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('estabelecimento_id')->nullable()->unsigned();
            $table->bigInteger('cliente_id')->nullable()->unsigned();
            $table->foreign('estabelecimento_id')->references('id')->on('estabelecimentos');
        });

        Schema::table('estabelecimentos', function (Blueprint $table) {
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
            $table->dropForeign('users_estabelecimento_id_foreign');
            $table->dropColumn('estabelecimento_id');
        });

        Schema::table('estabelecimentos', function (Blueprint $table) {
            $table->dropForeign('estabelecimentos_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
