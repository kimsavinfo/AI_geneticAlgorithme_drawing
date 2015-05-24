<?php

require_once('Individu.php');



$individu = new Individu(125,145,231,0.85);

echo $individu->to_string()."<br/>";


$individu->mutate();

echo $individu->to_string()."<br/>";