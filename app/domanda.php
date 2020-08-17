<?php
namespace App;

class Domanda
{
    public $id;
    public $domanda;
    public $rispostaesatta;
    public $rispostaerrata1;
    public $rispostaerrata2;
    public $rispostaerrata3;

    public function __construct($id, $domanda, $rispostaesatta, $rispostaerrata1, $rispostaerrata2, $rispostaerrata3)
    {
        $this->id = $id;
        $this->domanda = $domanda;
        $this->rispostaesatta = $rispostaesatta;
        $this->rispostaerrata1 = $rispostaerrata1;
        $this->rispostaerrata2 = $rispostaerrata2;
        $this->rispostaerrata3 = $rispostaerrata3;
    }
}
