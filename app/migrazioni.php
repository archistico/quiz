<?php

namespace App;

class Migrazioni
{
    private $messaggi = [];
    private $db;

    public function Muscoli($f3)
    {
        $this->db = (\App\Db::getInstance())->connect();
        $this->db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        //----------- CREAZIONE MUSCOLI -----------------

        $filename = "domande-muscoli-inserzioni-arti-inferiori.csv";
        $file_righe = file($filename, FILE_IGNORE_NEW_LINES);
        array_shift($file_righe);


        foreach ($file_righe as $riga) {
            $parti = explode("|", $riga);

            $gruppo = ucfirst(strtolower(trim(str_replace("\"", "", $parti[0]))));
            $posizione = ucfirst(strtolower(trim(str_replace("\"", "", $parti[1]))));
            $nome = ucfirst(strtolower(trim(str_replace("\"", "", $parti[2]))));
            $prossimale = ucfirst(strtolower(trim(str_replace("\"", "", $parti[3]))));
            $distale = ucfirst(strtolower(trim(str_replace("\"", "", $parti[4]))));
            $nervo = ucfirst(strtolower(trim(str_replace("\"", "", $parti[5]))));
            $funzione = ucfirst(strtolower(trim(str_replace("\"", "", $parti[6]))));
            $strato = ucfirst(strtolower(trim(str_replace("\"", "", $parti[7]))));


            $sql = sprintf('INSERT INTO muscoli VALUES(NULL, "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s");', $gruppo, $posizione, $nome, $prossimale, $distale, $nervo, $funzione, $strato);

            //echo $sql."<br>";
            $this->db->exec($sql);
        }

        echo "ok";
    }

    public function DomandeGruppi($f3)
    {
        $this->db = (\App\Db::getInstance())->connect();
        $this->db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        //----------- CREAZIONE DOMANDE -----------------


        // Domande da gruppo a nomi muscoli
        $sql = "SELECT * FROM muscoli";
        $muscoli = $this->db->exec($sql);

        $gruppo_considerato = $muscoli[0]['gruppo'];
        $gruppi = [];
        $gruppo_muscoli = [];
        $indice_gruppo = 0;

        for ($c = 0; $c < count($muscoli); $c++) {

            if ($gruppo_considerato == $muscoli[$c]['gruppo']) {
                $gruppo_muscoli[] = $muscoli[$c]['nome'];
            } else {
                $gruppi[$indice_gruppo]['gruppo'] = $gruppo_considerato;
                $gruppi[$indice_gruppo]['risposte'] = $gruppo_muscoli;

                $gruppo_considerato = $muscoli[$c]['gruppo'];
                $gruppo_muscoli = [];
                $gruppo_muscoli[] = $muscoli[$c]['nome'];
                $indice_gruppo += 1;
            }
        }

        $gruppi[$indice_gruppo]['gruppo'] = $gruppo_considerato;
        $gruppi[$indice_gruppo]['risposte'] = $gruppo_muscoli;
        $gruppo_considerato = $muscoli[$c]['gruppo'];
        $gruppo_muscoli = [];
        $gruppo_muscoli[] = $muscoli[$c]['nome'];
        $indice_gruppo += 1;

        // Creazione domande

        $d = [];

        for ($c = 0; $c < count($gruppi); $c++) {
            $lista_risposte_possibili = [];

            foreach ($gruppi as $g) {
                $lista_risposte_possibili[] = join(", ", $g['risposte']);
            }

            // Elimino la risposta esatta
            unset($lista_risposte_possibili[$c]);

            // Riordina array a caso
            shuffle($lista_risposte_possibili);

            $d[] = new Domanda(0, "Seleziona la lista dei '" . $gruppi[$c]['gruppo'] . "'", join(", ", $gruppi[$c]['risposte']), $lista_risposte_possibili[0], $lista_risposte_possibili[1], $lista_risposte_possibili[2]);
        }

        foreach ($d as $domanda) {
            $sql = sprintf('INSERT INTO domande VALUES(NULL, "%s", "%s", "%s", "%s", "%s");', $domanda->domanda, $domanda->rispostaesatta, $domanda->rispostaerrata1, $domanda->rispostaerrata2, $domanda->rispostaerrata3);
            //echo $sql."<br>";
            $this->db->exec($sql);
        }

        echo "ok";
    }

    public function DomandeNomeGruppo($f3)
    {
        $this->db = (\App\Db::getInstance())->connect();
        $this->db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        //----------- CREAZIONE DOMANDE -----------------


        // Domande da nomi muscoli a gruppo
        $sql = "SELECT * FROM muscoli ORDER BY nome ASC";
        $muscoli = $this->db->exec($sql);

        $sql_gruppi = "SELECT gruppo FROM muscoli GROUP BY gruppo ORDER BY gruppo ASC";
        $gruppi = $this->db->exec($sql_gruppi);

        $d = [];

        for ($c = 0; $c < count($muscoli); $c++) {
            $muscolo = $muscoli[$c]['nome'];
            $rispostaesatta = $muscoli[$c]['gruppo'];

            $gruppi_temp = [];
            foreach ($gruppi as $g) {
                $gruppi_temp[] = $g['gruppo'];
            }

            //Utilita::DumpDie($gruppi_temp);

            // trova l'indice del gruppo del muscolo considerato
            $indice_risposta_esatta = array_search($rispostaesatta, $gruppi_temp, true);
            unset($gruppi_temp[$indice_risposta_esatta]);

            shuffle($gruppi_temp);

            $rispostaerrata1 = $gruppi_temp[0];
            $rispostaerrata2 = $gruppi_temp[1];
            $rispostaerrata3 = $gruppi_temp[2];
            $d[] = new Domanda(0, "A quale gruppo appartiene: '" . $muscolo . "'", $rispostaesatta, $rispostaerrata1, $rispostaerrata2, $rispostaerrata3);
        }

        foreach ($d as $domanda) {
            $sql = sprintf('INSERT INTO domande VALUES (NULL, "%s", "%s", "%s", "%s", "%s");', $domanda->domanda, $domanda->rispostaesatta, $domanda->rispostaerrata1, $domanda->rispostaerrata2, $domanda->rispostaerrata3);
            //echo $sql . "<br>";
            $this->db->exec($sql);
        }

        echo "ok";
    }

    public function DomandeNomeDistale($f3)
    {
        $this->db = (\App\Db::getInstance())->connect();
        $this->db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        //----------- CREAZIONE DOMANDE -----------------

        // Domande da nomi muscoli a gruppo
        $sql = "SELECT * FROM muscoli WHERE distale IS NOT NULL AND distale != '' ORDER BY nome ASC";
        $muscoli = $this->db->exec($sql);

        //Utilita::DumpDie($muscoli);

        $sql_gruppi = "SELECT distale FROM muscoli WHERE distale IS NOT NULL AND distale != '' GROUP BY distale ORDER BY distale ASC";
        $gruppi = $this->db->exec($sql_gruppi);

        $d = [];

        for ($c = 0; $c < count($muscoli); $c++) {
            $muscolo = $muscoli[$c]['nome'];
            $rispostaesatta = $muscoli[$c]['distale'];

            $gruppi_temp = [];
            foreach ($gruppi as $g) {
                if(!empty($g['distale'])) {
                    $gruppi_temp[] = $g['distale'];
                }                
            }

            // trova l'indice del gruppo del muscolo considerato
            $indice_risposta_esatta = array_search($rispostaesatta, $gruppi_temp, true);
            unset($gruppi_temp[$indice_risposta_esatta]);

            shuffle($gruppi_temp);

            $rispostaerrata1 = $gruppi_temp[0];
            $rispostaerrata2 = $gruppi_temp[1];
            $rispostaerrata3 = $gruppi_temp[2];
            $d[] = new Domanda(0, "Qual è il distale del muscolo: '" . $muscolo . "'", $rispostaesatta, $rispostaerrata1, $rispostaerrata2, $rispostaerrata3);
        }

        foreach ($d as $domanda) {
            $sql = sprintf('INSERT INTO domande VALUES (NULL, "%s", "%s", "%s", "%s", "%s");', $domanda->domanda, $domanda->rispostaesatta, $domanda->rispostaerrata1, $domanda->rispostaerrata2, $domanda->rispostaerrata3);
            //echo $sql . "<br>";
            $this->db->exec($sql);
        }

        echo "ok";
    }
}
