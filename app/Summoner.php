<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summoner extends Model
{
    protected $table = 'high_ranked_players';
    protected $primaryKey = 'summoner_id';
    public $timestamps = false;
}
