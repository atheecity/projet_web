<?php

class Ini
{
    
    private $filename;
    private $ini;
    
    /**
    * @name Ini($filename) Constructeur
    * @param string $filename Fichier .ini
    */  
    public function __construct($filename)
    {
        $this->filename = $filename;
    }
    
    /**
     * Ajout un tableau dans la variable $ini
     * @param $array Tableau contenant les données à écrire
     * @param $name_section Nom de la section (peut etre null)
     * return void
     */
    private function add_ini($array, $name_section = null)
    {
        if($name_section != null)
            $this->ini .= "[".$name_section."]\n";
        
        foreach($array as $key => $val)
        {
            if(is_array($val))
            {
                $this->ini .= "[".$key."]\n";
                foreach($val as $key2 => $val2)
                {
                    $this->ini .= "\t".$key2." = ".$val2."\n";
                }
            }
            else
            {
                $this->ini .= "\t".$key." = ".$val."\n";
            }
        }
        
        $this->ini .= "\n";
    }
    
    /**
    * @name add_array($array) Permet d'écrire un tableau dans un fichier .ini
    * @param array  $array Tableau 
    */  
    public function add_array($array, $name_section)
    {
        $ini_array = parse_ini_file($this->filename, true);
        
        if(isset($ini_array[$name_section]))
        {
            unset($ini_array[$name_section]);
        }
        
        $this->add_ini($ini_array);
        $this->add_ini($array, $name_section);
        
        $fp = fopen($this->filename, 'w');
        fwrite($fp, $this->ini);
        fclose($fp);
    }
    
    /**
     * @name return_array($name_section = null) Retourne un array de la section passé en paramètre
     * @param string $name_section Nom de la valeur à retourner
     */
    public function return_array($name_section = null)
    {
        $ini_array = parse_ini_file($this->filename, true);
        
        //Test si le nom d'une section est passé en paramètre
        if($name_section != null)
        {
            $ini_array = $ini_array[$name_section];
        }
        
        return $ini_array;
    }
}
