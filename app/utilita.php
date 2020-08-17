<?php

namespace App;

class Utilita
{
    public static function Dump($variabile, $nome = "")
    {
        echo "<h4>$nome</h4>";
        echo "<pre>";
        var_dump($variabile);
        echo "</pre>";
    }

    public static function DumpDie($variabile, $nome = "")
    {
        echo "<h4>$nome</h4>";
        echo "<pre>";
        var_dump($variabile);
        echo "</pre>";
        die();
    }

    public static function Echo($testo)
    {
        echo $testo . "<br>";
    }

    public static function ConvertToDMY($testo)
    {
        if (is_null($testo) || empty($testo)) {
            return null;
        } else {
            $data = \DateTime::createFromFormat('Y-m-d', $testo);
            return $data->format('d/m/Y');
        }
    }

    public static function Permuta($arg) {
        $array = is_string($arg) ? str_split($arg) : $arg;
        if(1 === count($array))
            return $array;
        $result = array();
        foreach($array as $key => $item)
            foreach(self::Permuta(array_diff_key($array, array($key => $item))) as $p)
                $result[] = $item . $p;
        return $result;
    }
}
