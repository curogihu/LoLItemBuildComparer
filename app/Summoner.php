<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summoner extends Model
{
    protected $table = 'high_ranked_players';
    public $timestamps = false;
}
