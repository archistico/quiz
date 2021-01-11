<?php
namespace App;

class Domande
{
    public function Lista($f3, $params)
    {
        $materia_slug = $params['materia'];
        $materie = [ 
            [ 'nome' => 'Muscoli arti inferiori', 'slug'=> 'muscoli-arti-inferiori'], 
            [ 'nome' => 'Fisiologia', 'slug'=> 'fisiologia'] 
        ];
        $materia = "";
        
        foreach($materie as $m) {
            if($m['slug']==$materia_slug) {
                $materia = $m['nome'];
            }
        }

        $lista_domande = [];

        $db = (\App\Db::getInstance())->connect();

        $sql = "SELECT * FROM domande WHERE materia = :materia";
        $lista_domande = ($db->exec($sql, [
            ':materia' => $materia
            ]));

        array_walk_recursive($lista_domande, function(&$item) {
            $item = htmlspecialchars_decode($item, ENT_QUOTES);
        });
        
        $f3->set('domande', $lista_domande);
        $f3->set('titolo', 'Lista domande');
        $f3->set('contenuto', 'domande/lista.htm');
        echo \Template::instance()->render('templates/base.htm');
    }

    public function Nuova($f3)
    {
        $materie = [ 
            [ 'nome' => 'Muscoli arti inferiori', 'slug'=> 'muscoli-arti-inferiori'], 
            [ 'nome' => 'Fisiologia', 'slug'=> 'fisiologia'] 
        ];

        $f3->set('materie', $materie);
        $f3->set('titolo', 'Nuova domanda');
        $f3->set('contenuto', 'domande/nuova.htm');
        echo \Template::instance()->render('templates/base.htm');
    }

    public function Registra($f3)
    {
        //FILTER_SANITIZE_ADD_SLASHES
        $materia = filter_var(trim($f3->get('POST.materia')), FILTER_SANITIZE_STRING);
        $domanda = filter_var(trim($f3->get('POST.domanda')), FILTER_SANITIZE_STRING);
        $rispostaesatta = filter_var(trim($f3->get('POST.rispostaesatta')), FILTER_SANITIZE_STRING);
        $rispostaerrata1 = filter_var(trim($f3->get('POST.rispostaerrata1')), FILTER_SANITIZE_STRING);
        $rispostaerrata2 = filter_var(trim($f3->get('POST.rispostaerrata2')), FILTER_SANITIZE_STRING);
        $rispostaerrata3 = filter_var(trim($f3->get('POST.rispostaerrata3')), FILTER_SANITIZE_STRING);
        
        $db = (\App\Db::getInstance())->connect();

        $sql = "INSERT INTO domande VALUES (NULL, :domanda, :rispostaesatta, :rispostaerrata1, :rispostaerrata2, :rispostaerrata3, :materia);";
        $db->exec($sql, [
            ':domanda'=>$domanda,
            ':rispostaesatta'=>$rispostaesatta,
            ':rispostaerrata1'=>$rispostaerrata1,
            ':rispostaerrata2'=>$rispostaerrata2,
            ':rispostaerrata3'=>$rispostaerrata3,
            ':materia' =>$materia
            ]);
        
        $f3->reroute("@home");
    }
}
