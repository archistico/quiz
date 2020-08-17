<?php
namespace App;

class Risposta
{
    public $id;
    public $testo;

    public function __construct($id, $testo)
    {
        $this->id = $id;
        $this->testo = $testo;
    }
    
    public function toArray()
    {
        $risposta = [];
        $risposta['id'] = $this->id;
        $risposta['testo'] = $this->testo;
        return $risposta;
    }
}