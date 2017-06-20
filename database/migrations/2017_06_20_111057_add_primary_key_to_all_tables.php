<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrimaryKeyToAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('high_ranked_players', function (Blueprint $table) {
            $table->primary('summoner_id');
        });
/*
        Schema::table('item_builds', function (Blueprint $table) {
            $table->integer('participant_id');
            $table->primary(array('match_id', 'participant_id'));
        });
*/
        // $table->primary('id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
