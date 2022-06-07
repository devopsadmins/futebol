<?php
define('STRICT', true);

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$res = $client->request('GET', 'https://www.futebolinterior.com.br/wp-json/external/api/campeonato/151');
if ($res->getStatusCode() === 200){
    $games = json_decode($res->getBody());
};
$league = "Corinthians";
$lastGames = 5;
$results = [];
$lastResults = []; 

foreach ($games->JOGOS as $game) {
    if (($game->MANDANTE == $league || $game->VISITANTE == $league) && $game->STATUS_JOGO=='finalizado' ) {
        $results[] = $game;
    }
}
for ($a = count($results) - 1; $a >= count($results)-$lastGames; $a--) {
    $lastResults[] = $results[$a];
}
print_r($lastResults);
 