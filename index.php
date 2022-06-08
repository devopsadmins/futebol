<?php
define('STRICT', true);

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$id = 151;
$res = $client->request('GET', sprintf('https://www.futebolinterior.com.br/wp-json/external/api/campeonato/%d',$id));
if ($res->getStatusCode() === 200){
    $games = json_decode($res->getBody());
};
$league = "Corinthians";
$lastGames = 5;
$nNextGames = 5;
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
$nextGames = []; 
$nextResults = [];
foreach ($games->JOGOS as $game) {
    if (($game->MANDANTE == $league || $game->VISITANTE == $league) && $game->STATUS_JOGO=='agendado' ) {
        $nextResults[] = $game;
    }
}
for ($a = 0; $a < $nNextGames; $a++) {
    $nextGames[] = $nextResults[$a];
}
print_r($nextGames);
 