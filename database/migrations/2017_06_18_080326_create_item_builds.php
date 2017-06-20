<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemBuilds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_builds', function (Blueprint $table) {
            $table->bigInteger("match_id");
            $table->integer('main_version');
            $table->integer('sub_version');
            $table->integer('champion_id');
            $table->char('role', 4);
            $table->integer('item_id');
            $table->integer('bought_time');
            $table->timestamp('inserted_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_builds');
    }
}
