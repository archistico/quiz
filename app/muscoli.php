<?php
namespace App;

class Muscoli
{
    public function ArtiInferiori($f3)
    {
        $f3->set('titolo', 'Muscoli | Arti inferiori');
        
        $f3->set('contenuto', 'domande/iniziale.htm');
        echo \Template::instance()->render('templates/base.htm');
    }
}