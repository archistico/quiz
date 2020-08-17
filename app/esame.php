<?php

namespace App;

use DateTime;

class Esame
{
    public function MuscoliArtiInferiori($f3, $params)
    {
        $domande = $params['domande'];

        $f3->set('domande', $domande);
        $f3->set('materia', "Muscoli arti inferiori");
        $f3->set('titolo', 'Esame');
        $f3->set('contenuto', 'esame/iniziale.htm');
        echo \Template::instance()->render('templates/base.htm');
    }

    public function MuscoliArtiInferiori_Domande($f3)
    {
        $nome = $f3->get('POST.nome');
        $materia = $f3->get('POST.materia');
        $numero_domande = $f3->get('POST.numero_domande');
        $data = new DateTime();

        $db = (\App\Db::getInstance())->connect();
        $sql = "SELECT MAX(id) FROM esame";
        $ris = $db->exec($sql);

        $idesame = ((int)$ris[0]["MAX(id)"]) + 1;

        $sql = sprintf('INSERT INTO esame VALUES (%d, "%s", "%s", "%s", "%s");', $idesame, $nome, $materia, $data->format("Y-m-d H:i"), $numero_domande);
        $db->exec($sql);

        $sql = "SELECT * FROM domande";
        $domande = $db->exec($sql);
        shuffle($domande);

        $ordini = Utilita::Permuta("0123");
        shuffle($ordini);

        for ($c = 0; $c < $numero_domande; $c++) {
            $iddomanda = $domande[$c]['id'];
            $ordine = $ordini[rand(0, count($ordini) - 1)];
            $sql = sprintf('INSERT INTO esamedomande VALUES (NULL, "%s", "%s", "%s", NULL);', $idesame, $iddomanda, $ordine);
            $db->exec($sql);
        }

        $domanda = 0;
        $f3->reroute("@esame(@id=$idesame, @domanda=$domanda)");
    }

    public function Domanda($f3, $params)
    {
        $idesame = (int)$params['id'];
        $numero_domanda = (int)$params['domanda'];

        $db = (\App\Db::getInstance())->connect();
        $sql = "SELECT * FROM esamedomande WHERE idesame=$idesame";
        $esamedomande = $db->exec($sql);

        $iddomanda = $esamedomande[$numero_domanda]['iddomanda'];
        $ordine = $esamedomande[$numero_domanda]['ordine'];
        $sql = "SELECT * FROM domande WHERE id=$iddomanda";
        $domanda = ($db->exec($sql))[0];

        $testo_domanda = $domanda['domanda'];

        $o = (int)$ordine[0];
        switch ($o) {
            case 0:;
                $testo_risposta0 = $domanda['rispostaesatta'];
                break;
            case 1:;
                $testo_risposta0 = $domanda['rispostaerrata1'];
                break;
            case 2:;
                $testo_risposta0 = $domanda['rispostaerrata2'];
                break;
            case 3:;
                $testo_risposta0 = $domanda['rispostaerrata3'];
                break;
        }

        $o = (int)$ordine[1];
        switch ($o) {
            case 0:;
                $testo_risposta1 = $domanda['rispostaesatta'];
                break;
            case 1:;
                $testo_risposta1 = $domanda['rispostaerrata1'];
                break;
            case 2:;
                $testo_risposta1 = $domanda['rispostaerrata2'];
                break;
            case 3:;
                $testo_risposta1 = $domanda['rispostaerrata3'];
                break;
        }

        $o = (int)$ordine[2];
        switch ($o) {
            case 0:;
                $testo_risposta2 = $domanda['rispostaesatta'];
                break;
            case 1:;
                $testo_risposta2 = $domanda['rispostaerrata1'];
                break;
            case 2:;
                $testo_risposta2 = $domanda['rispostaerrata2'];
                break;
            case 3:;
                $testo_risposta2 = $domanda['rispostaerrata3'];
                break;
        }

        $o = (int)$ordine[3];
        switch ($o) {
            case 0:;
                $testo_risposta3 = $domanda['rispostaesatta'];
                break;
            case 1:;
                $testo_risposta3 = $domanda['rispostaerrata1'];
                break;
            case 2:;
                $testo_risposta3 = $domanda['rispostaerrata2'];
                break;
            case 3:;
                $testo_risposta3 = $domanda['rispostaerrata3'];
                break;
        }

        $f3->set('numero_domanda', $numero_domanda + 1);
        $f3->set('domanda', $testo_domanda);
        $f3->set('risposta0', $testo_risposta0);
        $f3->set('risposta1', $testo_risposta1);
        $f3->set('risposta2', $testo_risposta2);
        $f3->set('risposta3', $testo_risposta3);

        $f3->set('materia', "Muscoli arti inferiori");
        $f3->set('titolo', 'Esame');
        $f3->set('contenuto', 'esame/domanda.htm');
        echo \Template::instance()->render('templates/base.htm');
    }

    public function RegistraRisposta($f3, $params)
    {
        $idesame = (int)$params['id'];
        $numero_domanda = (int)$params['domanda'];
        $risposta = (int)$f3->get('POST.risposta');

        $db = (\App\Db::getInstance())->connect();
        $sql = "SELECT * FROM esamedomande WHERE idesame=$idesame";
        $esamedomande = $db->exec($sql);

        $idesamedomanda = (int)$esamedomande[$numero_domanda]['id'];
        $sql = "UPDATE esamedomande SET risposta = $risposta WHERE id=$idesamedomanda;";
        $db->exec($sql);

        $idesame = (int)$esamedomande[$numero_domanda]['idesame'];
        $sql = "SELECT * FROM esame WHERE id=$idesame";
        $esame = ($db->exec($sql))[0];
        $max_domande = (int)$esame['domande'];

        if (($numero_domanda + 1) < $max_domande) {
            $numero_domanda++;
            $f3->reroute("@esame(@id=$idesame, @domanda=$numero_domanda)");
        } else {
            $f3->reroute("@verifica(@id=$idesame)");
        }
    }

    public function Verifica($f3, $params)
    {
        $idesame = (int)$params['id'];

        $db = (\App\Db::getInstance())->connect();

        $sql = "SELECT * FROM esame WHERE id=$idesame";
        $esame = ($db->exec($sql))[0];
        $nome = $esame['nome'];
        $fattoil = $esame['fattoil'];
        $numero_domande = $esame['domande'];
        $corrette = 0;

        $sql = "SELECT * FROM esamedomande WHERE idesame=$idesame";
        $esamedomande = $db->exec($sql);

        $lista_domande_risposte = [];
        $num = 1;
        foreach ($esamedomande as $es) {
            $iddomanda = (int)$es['iddomanda'];
            $sql_domanda = "SELECT * FROM domande WHERE id=$iddomanda";
            $domanda = ($db->exec($sql_domanda))[0];

            $t['domanda'] = $domanda['domanda'];
            $t['numero'] = $num;
            $ordine = $es['ordine'];
            $indice_risposta = (int)$es['risposta'];

            $o = (int)$ordine[0];
            switch ($o) {
                case 0:
                    $t['risposta0'] = $domanda['rispostaesatta'];
                    break;
                case 1:
                    $t['risposta0'] = $domanda['rispostaerrata1'];
                    break;
                case 2:
                    $t['risposta0'] = $domanda['rispostaerrata2'];
                    break;
                case 3:
                    $t['risposta0'] = $domanda['rispostaerrata3'];
                    break;
            }

            $o = (int)$ordine[1];
            switch ($o) {
                case 0:
                    $t['risposta1'] = $domanda['rispostaesatta'];
                    break;
                case 1:
                    $t['risposta1'] = $domanda['rispostaerrata1'];
                    break;
                case 2:
                    $t['risposta1'] = $domanda['rispostaerrata2'];
                    break;
                case 3:
                    $t['risposta1'] = $domanda['rispostaerrata3'];
                    break;
            }

            $o = (int)$ordine[2];
            switch ($o) {
                case 0:
                    $t['risposta2'] = $domanda['rispostaesatta'];
                    break;
                case 1:
                    $t['risposta2'] = $domanda['rispostaerrata1'];
                    break;
                case 2:
                    $t['risposta2'] = $domanda['rispostaerrata2'];
                    break;
                case 3:
                    $t['risposta2'] = $domanda['rispostaerrata3'];
                    break;
            }

            $o = (int)$ordine[3];
            switch ($o) {
                case 0:
                    $t['risposta3'] = $domanda['rispostaesatta'];
                    break;
                case 1:
                    $t['risposta3'] = $domanda['rispostaerrata1'];
                    break;
                case 2:
                    $t['risposta3'] = $domanda['rispostaerrata2'];
                    break;
                case 3:
                    $t['risposta3'] = $domanda['rispostaerrata3'];
                    break;
            }

            switch ($indice_risposta) {
                case 0:
                    $t['risposta'] = $t['risposta0'];
                    break;
                case 1:
                    $t['risposta'] = $t['risposta1'];
                    break;
                case 2:
                    $t['risposta'] = $t['risposta2'];
                    break;
                case 3:
                    $t['risposta'] = $t['risposta3'];
                    break;
            }

            $t['risposta_corretta'] = $domanda['rispostaesatta'];
            
            if($t['risposta_corretta'] == $t['risposta']) {
                $verifica = "(CORRETTA)";
                $corrette++;
            } else {
                $verifica = "(SBAGLIATA)";
            }

            $t['verifica'] =  $verifica;

            $lista_domande_risposte[] = $t;
            $num++;
        }

        // In trentesimi
        $votazione = sprintf("%d/30", ($corrette/$numero_domande)*30);

        $f3->set('nome', $nome);
        $f3->set('fattoil', $fattoil);
        $f3->set('domande', $lista_domande_risposte);
        $f3->set('votazione', $votazione);

        $f3->set('titolo', 'Verifica');
        $f3->set('contenuto', 'esame/verifica.htm');
        echo \Template::instance()->render('templates/base.htm');
    }
}
