<?php

class Materia {

    public $vinculo;
    public $nombre;
    public $monitorear;

    function __construct($vinculo, $nombre) {
        $this->vinculo = $vinculo;
        $this->nombre = $nombre;
        $this->monitorear = TRUE;
    }

}
