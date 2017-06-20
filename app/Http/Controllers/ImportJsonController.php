<?php

namespace App\Http\Controllers;

use App\Summoner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportJsonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importChallengers()
    {
        $api_key = env('RIOT_GAME_API_KEY');
        $url = "https://na.api.riotgames.com/api/lol/NA/v2.5/league/challenger?type=RANKED_SOLO_5x5&api_key=" . $api_key;

        // $obj = json_decode(file_get_contents($url), true);
		// print_r($obj);

		// print_r($this->retrieveRiotJson($url));

		$json = $this->retrieveRiotJson($url);

		if($json === false) {
			exit;
		}		

		foreach ($json['entries'] as $summoner_info) {
			// $summoner = new Summoner;
			$summoner_id = $summoner_info['playerOrTeamId'];

			$summoner = App\Summoner::firstOrNew(['summoner_id' => $summoner_id]);
        	// $summoner->summoner_id = $summoner_info['playerOrTeamId'];
        	$summoner->tier = 'challenger';
        	$summoner->save();
		}

		echo "success";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importMasters()
    {
        $api_key = env('RIOT_GAME_API_KEY');
        $url = "https://na.api.riotgames.com/api/lol/NA/v2.5/league/master?type=RANKED_SOLO_5x5&api_key=" . $api_key;

		$json = $this->retrieveRiotJson($url);

		if($json === false) {
			exit;
		}		

		foreach ($json['entries'] as $summoner_info) {
			$summoner = new Summoner;
			$summoner->summoner_id = $summoner_info['playerOrTeamId'];
        	$summoner->tier = 'master';
        	// $summoner->account_id = null;
        	$summoner->save();
		}

		echo "success";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importAccountIds()
    {
        $api_key = env('RIOT_GAME_API_KEY');
        $base_url = "https://na1.api.riotgames.com/lol/summoner/v3/summoners/[summoner_id]?api_key=" . $api_key;

		// $summoners = Summoner::all();
        Summoner::chunk(100, function ($summoners) {

			foreach ($summoners as $summoner) {
				$url = str_replace("[summoner_id]",
									str($summoner->summoner_id),
									$targetText);

			  	Log::info('Try to access url: ' . $url);
			} 
		});

		// $json = $this->retrieveRiotJson($url);
/*
		if($json === false) {
			exit;
		}		

		foreach ($json['entries'] as $summoner_info) {
			$summoner = new Summoner;
			$summoner->summoner_id = $summoner_info['playerOrTeamId'];
        	$summoner->tier = 'master';
        	// $summoner->account_id = null;
        	$summoner->save();
		}
*/
		echo "success";
    }

    private function retrieveRiotJson($url)
    {
    	// $obj = json_decode(file_get_contents($url), true);
    	// $response
    	$context = stream_context_create(array(
		    'http' => array('ignore_errors' => true)
		));
		$response = file_get_contents($url, false, $context);

		// stop 1.5 seconds
		usleep(1500000);

		preg_match('/HTTP\/1\.[0|1|x] ([0-9]{3})/', $http_response_header[0], $matches);
		$status_code = intval($matches[1]);

		switch ($status_code) {
		    case 200:
		        return json_decode($response, true);
		        break;

		    case 400:
		    case 403:
		    case 404:
		    case 415:
		        // 404の場合
		        return false;
		        break;

		    // rate limit exceeded
		    case 429:
		    	// have to some seconds
		    	return false;
		    	break;

		    case (ceil($status_code / 100) === 5):
		    	return false;
				// have to some seconds
				break;

		    default:
		    	// unexpected cases
		        break;
		}
	}
}