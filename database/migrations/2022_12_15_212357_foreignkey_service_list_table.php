<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignkeyServiceListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_list', function (Blueprint $table) {
            $table->foreign('user_service_id')
                ->references('id')
                ->on('user_services');
            $table->foreign('service_id')
                ->references('id')
                ->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_list', function (Blueprint $table) {
            $table->dropForeign('user_service_id');
            $table->dropForeign('service_id');
        });
    }
}
