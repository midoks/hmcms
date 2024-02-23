<?php

include 'sphinxapi.php';

$sc = new SphinxClient(); // 实例化Api
$sc->setServer('127.0.0.1', 9312);

$res = $sc->query('异形', 'main');
var_dump($res);

?>