<?php

require 'Carousselle.php';

class carrouselController extends Controller 
{
	
	function action($param)
	{
		$tabImage = $param[0];
		$tablien = $param[1];
		$tpsseconde = $param[2];
		$haut = $param[3];
		$large = $param[4];

		$carousselle = new Carousselle($tabImage,$tablien,$tpsseconde,$haut,$large);
		return $carousselle;
	}

}