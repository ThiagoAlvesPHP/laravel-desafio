<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignkeyCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('model_id')
                ->references('id')
                ->on('models');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign('brand_id');
            $table->dropForeign('user_id');
            $table->dropForeign('model_id');
        });
    }
}
