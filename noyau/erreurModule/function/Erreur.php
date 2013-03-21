<?php

class Erreur extends ErrorException
{
    
    function __construct($message = NULL, $code = 0)
    {
        parent::__construct($message, $code);
    }
    
    public function __toString()
    {
        $trace = $this->getTrace();
        $string = '
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="utf-8" />
            </head>
            <body>
                <section id="erreur">';
        $string .= "Erreur a la ligne ".$trace[0]['line']." dans le fichier ".$trace[0]['file']."<br/>";
        $string .= "Erreur dans la class ".$trace[0]['class'].", fonction ".$trace[0]['function']."<br/>";
        $string .= $this->getMessage();
        $string .= '
                </section>
            </body>
        </html>';
        return exit($string);
    }
}

?>