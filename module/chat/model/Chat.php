<?php

/**
 * Description of Chat
 *
 * @author jj
 */
class Chat extends Bd {

    public function __construct($dejaco) {
        if ($dejaco == false)
            $this->connexion();
        else
            $this->connexion2('../../../config/parameters.ini');

        $this->create("CREATE TABLE IF NOT EXISTS chat( ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,pseudo VARCHAR(20),message TEXT);", null);
    }

    /**
     * poste un message sur le chat
     * @param type $pseudo pseudo de l'utilisateur qui poste le message
     * @param type $message message à poseter
     */
    public function post($pseudo, $message) {
        // si le message et le pseudo ne sont pas vide
        if (!empty($pseudo) AND !empty($message)) {
            //enregistrement dans la bd
            $this->stockage($pseudo, $message);
        }
    }

    /**
     * recupere les n dernier message du chat
     * @global Bd $bdd base de donnée
     * @param int $n nombre de messages à récupérer
     * @return type les n dernier messages
     */
    public function recMessages($n) {
        $n = (int) $n;
        // recupération des n dernier message du chat
        return $this->queryPX('SELECT pseudo, message FROM chat ORDER BY  ID  DESC LIMIT 0, ' . $n, NULL);
    }

    /**
     * recupere tous les messages
     * @return type tableau de messages et pseudo
     */
    public function allMessages() {
        // recupération des messages du chat
        return $this->queryPX('SELECT pseudo, message FROM chat ORDER BY ID DESC', NULL);
    }

    public function cookie($pseudo) {
        //ecriture du pseudo dans le cookie
        setcookie('pseudo', htmlspecialchars($pseudo), time() + 365 * 24 * 3600, null, null, false, true);
    }

    /**
     * enregistrement dans la base de donnée 
     * @param type $pseudo pseudo de l'utilisateur message à enregistrer
     * @param type $message message à enregistrer
     */
    private function stockage($pseudo, $message) {
        // insertion dans la base de donnée
        $this->inserInto("chat", array(null, $pseudo, $message));
    }

    public function __toString() {
        //recuperation des 10 derniers messages      
        $messages = array_reverse($this->recMessages(15));
        $s = "";
        if (count($messages) > 0) {
            foreach ($messages as $cle => $donnees) {

                $s .= addslashes(' @' . $donnees['pseudo'] . ' dit: ' . $donnees['message']) . '\n';
            }
        }return $s;
    }

}

?>
