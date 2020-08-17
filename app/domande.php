<?php
namespace App;

class Domande
{
    public function Casuale($f3)
    {
        $filename = "domande-muscoli-inserzioni-arti-inferiori.csv";
        $file_righe = file($filename, FILE_IGNORE_NEW_LINES);
        
        $numero_domanda = rand(0, count($file_righe)-1);        

        $riga = $file_righe[$numero_domanda];
        $parti = explode(",", $riga);
        
        $gruppo = ucfirst(strtolower(trim(str_replace("\"", "", $parti[0]))));
        $posizione = ucfirst(strtolower(trim(str_replace("\"", "", $parti[1]))));
        $nome = ucfirst(strtolower(trim(str_replace("\"", "", $parti[2]))));
        $prossimale = ucfirst(strtolower(trim(str_replace("\"", "", $parti[3]))));
        $distale = ucfirst(strtolower(trim(str_replace("\"", "", $parti[4]))));
        $nervo = ucfirst(strtolower(trim(str_replace("\"", "", $parti[5]))));
        $funzione = ucfirst(strtolower(trim(str_replace("\"", "", $parti[6]))));
        $strato = ucfirst(strtolower(trim(str_replace("\"", "", $parti[7]))));

        $domanda = $gruppo;
        $risposte = [];
       
        $risposte[] = (new Risposta(1, "2"))->toArray();
        $risposte[] = (new Risposta(2, "3"))->toArray();
        $risposte[] = (new Risposta(3, "4"))->toArray();

        $f3->set('domanda', $domanda);
        $f3->set('risposte', $risposte);
        $f3->set('titolo', 'Domanda casuale');
        $f3->set('contenuto', 'domande/casuale.htm');
        echo \Template::instance()->render('templates/base.htm');
    }
}
