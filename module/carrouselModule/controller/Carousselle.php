<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Carousselle
 *
 * @author shinkimi
 */
class Carousselle {
        //attributs
	private $carousselle;
	private $images;
    private $lien;
	private $tps;
	private $largeur;
	private $hauteur;

	//constructeur permettant la création de l'emplacement du carousselle
	public function __construct($tabImage,$tablien,$tpsseconde,$haut,$large)
	{
		$this->carousselle.='<div id="emplacementCarousselle"></div>';
		$this->images=$tabImage;
                $this->lien=$tablien;
		$this->tps=$tpsseconde*1000;
		$this->largeur=$large;
		$this->hauteur=$haut;
                if(count($this->images)== count($this->lien))
                    $this->AddCarousselle();
                else 
                {
                    $this->AddCarousselleSanslien();
                }
	}
	
	//création du carousselle avec liens sur les images
	private function AddCarousselle()
	{
		//début du script et construction du tableau d'image en javascript
		$this->carousselle.='<script type="text/javascript">
		var tabimage=new Array();var tabliens=new Array();';
		
		//remplissage du tableau d'image en javascript
                $cpt=0;
		foreach($this->images as $element)
                {
		$this->carousselle.='tabimage['.$cpt.']="'.$element.'";';
                $cpt=$cpt+1;   
                }
                $cpt=0;
		foreach($this->lien as $element)
                {
		$this->carousselle.='tabliens['.$cpt.']="'.$element.'";';
                $cpt=$cpt+1;   
                }
		
		//initialisation des variable (compteur +taille du tabeau)
		$this->carousselle.='var cpt=0; var taille=tabimage.length;';
		
		//création de la fonction qui change l'image
		$this->carousselle.='function changement(){ document.getElementById("emplacementCarousselle").innerHTML = \'<a href=\'+tabliens[cpt%taille]+\'><img src="web/images/\'+tabimage[cpt%taille]+\'" alt="image"  height="'.$this->hauteur.' px" width="'.$this->largeur.'px"/></a>\';
		    cpt=cpt+1;
                    setTimeout("changement()", 10000);}';
		
		//appel de la fonction de changement tous les tps de temps et fermeture du script
		$this->carousselle.='changement(); </script>';
	}
        
        //création du carousselle sans lien sur les images
        private function AddCarousselleSanslien()
	{
		//début du script et construction du tableau d'image en javascript
		$this->carousselle.='<script type="text/javascript">
		var tabimage=new Array();';
		
		//remplissage du tableau d'image en javascript
                $cpt=0;
		foreach($this->images as $element)
                {
		$this->carousselle.='tabimage['.$cpt.']="'.$element.'";';
                $cpt=$cpt+1;   
                }
		
		//initialisation des variable (compteur +taille du tabeau)
		$this->carousselle.='var cpt=0; var taille=tabimage.length;';
		
		//création de la fonction qui change l'image
		$this->carousselle.='function changement(){ document.getElementById("emplacementCarousselle").innerHTML = \'<img src="web/images/\'+tabimage[cpt%taille]+\'" alt="image"  height="'.$this->hauteur.'px" width="'.$this->largeur.'px"/>\';
		    cpt=cpt+1;
                    setTimeout("changement()", 10000);}';
		
		//appel de la fonction de changement tous les tps de temps et fermeture du script
		$this->carousselle.='changement(); </script>';
	}

	//fonction permettant l'affichage du carousselle
	public function __toString()
	{
		return $this->carousselle;
	}
}

?>
