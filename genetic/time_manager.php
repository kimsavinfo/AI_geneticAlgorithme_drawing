<?php

function getDateHis($p_microtime)
{
	return date("H:i:s", $p_microtime);
}

function getDurationHis($p_start, $p_end)
{
	return gmdate("H:i:s", ( $p_end - $p_start) );
}