<?php
namespace App;

class Domande
{
    public function Lista($f3)
    {
        $lista_domande = [];

        $db = (\App\Db::getInstance())->connect();

        $sql = "SELECT * FROM domande";
        $lista_domande = ($db->exec($sql));
        
        $f3->set('domande', $lista_domande);
        $f3->set('titolo', 'Lista domande');
        $f3->set('contenuto', 'domande/lista.htm');
        echo \Template::instance()->render('templates/base.htm');
    }
}
