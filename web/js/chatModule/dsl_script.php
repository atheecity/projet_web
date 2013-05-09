<?php header("Content-type: text/javascript"); ?>
var string = '<?php
include_once("../../../noyau/core/Bd.php");
include_once("../../../module/chat/model/Chat.php");
//creation de la gestion du chat
$chat = new Chat(true);
echo $chat;
?>';
messages(string);
