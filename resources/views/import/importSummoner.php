<?php

$apiKey = DB::table('api_key')->select('own_api_key')->first();

$url = "https://na.api.riotgames.com/api/lol/NA/v2.5/league/challenger?type=RANKED_SOLO_5x5&api_key=" . $api_key;
/*

$obj = json_decode(file_get_contents($url), true);

print_r($obj);
*/

echo $apiKey;

/*
foreach ($obj as $key => $info) {
  //var_dump($obj);
  //sleep(3);
  $insertDataArr[] = Array('RegionId' => 'na',
                          'SummonerId' => $info['id'],
                          'SummonerNameKey' => $key,
                          'SummonerName' => $info['name']);
}

try{
  DB::table('Summoner')->insert($insertDataArr);

}catch(Exception $e){
  echo "Error Message: " . $e . "<br>";
  echo "objective data is the following:<br>";
  echo var_dump($insertDataArr);
  die();
}

//echo "finished";
date_default_timezone_set('Asia/Tokyo');
Log::info('Finishing importing Summoner, date: ' . date("F j, Y, g:i a"));

function convertToQueryStr($arr){
  $output = "";

  foreach ($arr as $value) {
    $output .= str_replace(' ', '', mb_strtolower($value)) . ",";

  }

  return substr($output, 0, strlen($output) - 1);
}
*/