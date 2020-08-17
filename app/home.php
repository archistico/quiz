<?php
namespace App;

class Home
{
    public function Show($f3)
    {
        $lista_esami = [];

        $db = (\App\Db::getInstance())->connect();
        $sql = "SELECT * FROM esame";
        $esami = $db->exec($sql);

        foreach($esami as $e) {
            $lista_esami[] = $e;
        }

        $f3->set('lista_esami', $lista_esami);
        $f3->set('titolo', 'Quiz');
        $f3->set('contenuto', 'home/show.htm');
        echo \Template::instance()->render('templates/base.htm');
    }
}
