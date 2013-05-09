<?php
require '../module/chat/model/Chat.php';
class chatController extends Controller{

	function action(){
	//creation de la gestion du chat
	$chat = new Chat(false);

	// si le pseudo et le message existe
	if (isset($_POST['pseudo']) AND isset($_POST['message'])) {

	    //si le cookie n'existe pas ou les pseudo sont différents on le cuisine
	    if (!isset($_COOKIE['pseudo']) OR $_COOKIE['pseudo'] != $_POST['pseudo']) {
		$chat->cookie($_POST['pseudo']);
	    }
	    // postage du message
	    $chat->post($_POST['pseudo'], $_POST['message']);
	}
	$this->renderView('module/chat/vue/vueChat.php');	
}
}

?>
