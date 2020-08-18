<?php
require 'vendor/autoload.php';

// ----------------------
//   FAT FREE FRAMEWORK
// ----------------------

$f3 = \Base::instance();
$f3->set('CACHE', true);
$f3->set('DEBUG', 3);

// ----------------------
//         ENV
// ----------------------

define("DATABASEFILE", "db/dbdomande.sqlite");
date_default_timezone_set('Europe/Rome');

// ----------------------
//         ROUTE
// ----------------------

$f3->route('GET @home: /', '\App\Home->Show');
$f3->route('GET @domande: /domande', '\App\Domande->Lista');
$f3->route('GET @muscoli: /muscoli-arti-inferiori/@domande', '\App\Esame->MuscoliArtiInferiori');
$f3->route('POST @muscoli_domande: /muscoli-arti-inferiori/@domande', '\App\Esame->MuscoliArtiInferiori_Domande');
$f3->route('GET @esame: /esame/@id/@domanda', '\App\Esame->Domanda');
$f3->route('POST @esame: /esame/@id/@domanda', '\App\Esame->RegistraRisposta');
$f3->route('GET @verifica: /verifica/@id', '\App\Esame->Verifica');

$f3->route('GET @migrazionimuscoli: /migrazioni/muscoli', '\App\Migrazioni->Muscoli');
$f3->route('GET @migrazionidomandegruppi: /migrazioni/domande/gruppi', '\App\Migrazioni->DomandeGruppi');
$f3->route('GET @migrazionidomandemuscoli: /migrazioni/domande/nomegruppo', '\App\Migrazioni->DomandeNomeGruppo');
$f3->route('GET @migrazionidomandedistali: /migrazioni/domande/nomedistale', '\App\Migrazioni->DomandeNomeDistale');

$f3->run();

/*

Metti il nome e lui registra su db l'id del test, e il numero di domande scelto
Fai una lista di domande randomizzate e scrivi gli id delle domande sul db con le risposte date
Proproni tutte le domande in sequenza /test/id/numero_domanda
Su db so le risposte date per cui anche la sequenza per gli avanti/indietro
Alla fine del test proponi il risultato del test con la verifica delle risposte date/giuste-errate e il voto in trentesimi

Nelle domande
Cerco come fare le risposte alternative (ne metto tre)

Se chiedo il gruppo -> voglio sapere tutti gli appartenenti al gruppo
Se chiedo nome muscolo -> posizione, gruppo, distale, nervo, ecc.
Se chiedo funzione-> nome gruppo+nome, oppure solo nome

per cui DB
tabella prova
id, nome, id_d1, r1 [0,1,2,3], id_d2, r2, ecc. votazione

tabella dati muscoli
id, gruppo, posizione, nome, prossimale, distale, nervo, funzione, stato

tabella domande
id, domanda, risposta esatta, risposta errata, risposta errata, risposta errata

*/