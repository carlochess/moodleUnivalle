<?php
include_once 'simple_html_dom.php';
class Semestre {
    public $nombre;
    public $materias = array();

    function __construct($semestre, $nombre) {
        foreach ($semestre->find('a') as $materiaT) {
            $this->nombre = $nombre;
            $materia = new Materia($materiaT->href, $materiaT->innertext);
            array_push($this->materias, $materia);
        }
    }

    public function getMateriasNombres() {
        $nombres = array();
        for ($i = 0; $i < count($this->materias); $i++) {
            $nombres[] = $this->materias[$i];
        }
        return $nombres;
    }

}