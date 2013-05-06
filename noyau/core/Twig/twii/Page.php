<?php 

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Page
 *
 * @author shinkimi
 */
class Page {
    
   	//attributs
	private $pageweb;
	
	//constructeur permettant d'ouvrir la page html en précisant son titre $titre
	public function entete($titre, $pagecss)
	{
            echo '<!DOCTYPE html>
			<html>
				<head>
				<meta charset="utf-8" />
				<!--[if lt IE 9]>
				<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
				<![endif]-->
				<link rel="stylesheet" href="'.BASE_URL.DS.'web/css/'.$pagecss.'"/>
				<title>'.$titre.'</title>
			</head>
		<body>
		<div id="page">';
    }

	//destructeur permettant de fermer la page html
	public function __destruct()
	{
	$this->pageweb.='</div>
	</body>
	</html>';
	}
	
	/*//fonction permettant d'insérer du code html ($code) dans la page web
	public function AjoutCode($code)
	{
		$this->pageweb.=$code;
	}*/
	
	//fonction permettant d'insérer du code html ($code) dans un div d'identifiant $idDiv
	public function AjoutCodeInPart($code,$id)
	{
		$this->pageweb.='<script type="text/javascript">
		document.getElementById("'.$id.'").innerHTML += "'.$code.'";
		</script>';
	}
	
	//fonction pour ajouter des "onglets" au menu
	public function AjoutDansMenu($libelle,$lien)
	{
		$this->pageweb.='<script type="text/javascript">
		document.getElementById("onglets").innerHTML += "<li> <a href='.$lien.'> '.$libelle.' </a> </li>";
		</script>';
	}
	
	//fonction permettant la construction d'une mise en page prédéfinie
	public function MiseEnPage()
	{
		$this->pageweb.='<header id="entete"></header>
		<section id="sectionprincipale"> 
		<nav id="menu"> <ul id="onglets"> </ul> </nav>
		<section id="sectionsecondaire"></section>
		</section>
		<footer id="piedPage"> </footer>';
	}
	
	//fonction pour récupérer tout le contenu
	public function fin()
	{
		$this->__destruct();
		echo $this->pageweb;
	}
}

?>
