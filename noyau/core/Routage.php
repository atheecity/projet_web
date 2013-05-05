<?php

/**
 * Parse les url
 * @name Routage
 */
class Routage
{
    /**
     * Permet de parser une url
     * @param $url Url à parser
     * @return void
     */
    static function parse($url, $request)
    {
        $url = trim($url, DS); //Supprime les slashs en début et en fin de ligne
        $param = explode(DS, $url);
        if($param[0] == '')
            $request->setModule(DS);
        else
            $request->setModule($param[0]);
        if(isset($param[1]))
            $request->setController($param[1]);
        else
            $request->setController(DS);
        $request->setParametres(array_slice($param, 2));
    }

}
