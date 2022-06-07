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
$results = [];

foreach ($games->JOGOS as $game) {
    if (($game->MANDANTE == $league || $game->VISITANTE == $league) && $game->STATUS_JOGO=='finalizado' ) {
        $results[] = $game;
    }
}
for ($a = count($results) - 1; $a >= count($results)-5; $a--) {
    print_r($results[$a]);
}