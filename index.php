<?php

require_once('genetic/Individu.php');



$individu = new Individu(125,145,231,0.85);

echo $individu->to_string()."<br/>";


$individu->mutate();

echo $individu->to_string()."<br/>";

// TODO : upload drapeau
// NNS coleurs principales avec nombre éditable, et nb itération max