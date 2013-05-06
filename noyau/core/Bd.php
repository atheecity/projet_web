<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bd
 *
 * @author shin
 */
class Bd {

    private $host; // nom de l'hote
    private $dbname; // base de donnée
    private $login;
    private $password;
    private $bdd; //connection
    public static $dejaco = 0;

    public function __construct() {
        $this->connexion();
    }

    public function connexion2($path_parameters_init) {
        // pour test  localhost monty monty monty
        if (self::$dejaco === 0) {
            $test = parse_ini_file($path_parameters_init);
            $this->host = $test['database_name'];
            $this->dbname = $test['database_db'];
            $this->login = $test['database_user'];
            $this->password = $test['database_password'];
            // création de la connection

            try {
                $this->bdd = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->login, $this->password);
            } catch (Exception $exc) {
                echo "erreur connexion" . $this->host . " " . $this->dbname . " " . $this->login . " " . $this->password;
            }
        }
    }

    public function connexion() {
        // pour test  localhost monty monty monty
        if (self::$dejaco === 0) {
            $ini = new Ini('../config/parameters.ini');
            $test = $ini->return_array('DATABASE');
            $this->host = $test['database_name'];
            $this->dbname = $test['database_db'];
            $this->login = $test['database_user'];
            $this->password = $test['database_password'];
            // création de la connection

            try {
                $this->bdd = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->login, $this->password);
            } catch (Exception $exc) {
                echo "erreur connexion" . $this->host . " " . $this->dbname . " " . $this->login . " " . $this->password;
            }
        }
    }

    // -------------------------- LECTURE DES DONNEES -------------------------- OK      
    /**
     * renvoie la réponce d'un requette sous forme de tableau non sécurisé
     * @param type $requete
     * @return type 
     */
    public function query($requete) {
        //recupération du résultat de la requête
        //avec gestion des potentielles erreurs 
        $query = $this->bdd->query($requete) or die(print_r($this->bdd->errorInfo()));

        $tab = $query->fetchAll();

        //termine le traitement de la requete
        $query->closeCursor();
        return $tab;
    }

    /**
     * permet de faire une requête utilisant des variables sans possibilité
     * d'injection sql SECURISE
     * @param type $prepar chaine de la requête à préparer
     * @param type $tableau tableau de variable à remplacer
     * @return array tableau contenant les tableaux de chaque ligne de la requete 
     */
    public function queryPX($prepar, $array) {
        //préparation de la requette
        $query = $this->bdd->prepare($prepar);
        //exécution de la requête avec le tableau contenant les valeurs
        //avec gestion des potentielles erreurs 
        $query->execute($array) or die(print_r($query->errorInfo()));

        $tab = $query->fetchAll();

        //termine le traitement de la requete
        $query->closeCursor();

        return $tab;
    }

    //-----------------------------------------------------------------------------     
    //
    // -------------------------- ECRITURE DES DONNEES --------------------------

    /**
     * Insert les valeurs du tableau dans la table ecrit dans l'indice 0 du tableau
     * SECURISE
     * @param type $array tableau contenant toutes les valeurs et le nom de la table en premier
     */
    public function inserInto($table, $array) {

        //préparation de l'insertion 
        $prepar = "INSERT INTO " . $table . " VALUES ( ?";
        // ajout d'autant de ? que d'élément du tableau -1
        for ($i = 0; $i < count($array) - 1; $i++) {
            $prepar = $prepar . " , ?";
        }
        //fermeture de la préparation à l'insertion
        $prepar = $prepar . " )";


        // application de la préparation
        $query = $this->bdd->prepare($prepar);

        //exécution de la l'insertion avec le tableau contenant les valeurs
        //avec gestion des potentielles erreurs 
        $query->execute($array) or die(print_r($query->errorInfo()));
    }

    //-----------------------------------------------------------------------------    
    // -------------------------- SUPPRIMER/MODIFICATION DES DONNEES --------------------------

    /**
     * execution de la modification de données
     * SECURISE
     */
    public function mod($prepar, $array) {

        //préparation de la requette
        $query = $this->bdd->prepare($prepar);
        //exécution de la requête avec le tableau contenant les valeurs
        //avec gestion des potentielles erreurs 
        $query->execute($array) or die(print_r($query->errorInfo()));
    }

    //-----------------------------------------------------------------------------    
    // -------------------------- GESTION DE TABLE --------------------------

    /**
     * Creation d'une table
     * SECURISE
     */
    public function create($prepar, $array) {

        //préparation de la requette
        $query = $this->bdd->prepare($prepar);
        //exécution de la requête avec le tableau contenant les valeurs
        //avec gestion des potentielles erreurs 
        $query->execute($array) or die(print_r($query->errorInfo()));
    }

    /**
     * Recupere la liste  de toutes les tables sous forme de tableau
     * @return arry liste de toutes les tables
     */
    public function getListTables() {

        //execution de la requete permetant l'affichages des tables
        return $this->query("SHOW TABLES");
    }

    /**
     * renvoie la description de la table passé en paramettre
     * @param string $table 
     * @return array description de la table
     */
    public function description($table) {
        $sql = 'DESCRIBE ' . $table;
        return $this->queryPX($sql, array());
    }

    /**
     * supression de la table
     * @param type $table table a suprimer
     */
    public function drop($table) {
        $sql = 'DROP TABLE ' . $table;
        $this->queryPX($sql, array());
    }

    /**
     * vide entierrement la table
     * @param type $table table à vider
     */
    public function reset($table) {
        $sql = 'DELETE FROM ' . $table;
        $this->queryPX($sql, array());
    }

    //-----------------------------------------------------------------------------    
//------------------------------GETTER & SETTER ------------------------------   
    public function getHost() {
        return $this->host;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function getDbname() {
        return $this->dbname;
    }

    public function setDbname($dbname) {
        $this->dbname = $dbname;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getBdd() {
        return $this->bdd;
    }

    public function setBdd($bdd) {
        $this->bdd = $bdd;
    }

}

?>