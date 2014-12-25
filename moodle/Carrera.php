<?php
include_once 'simple_html_dom.php';
class Carrera {

    public $semestres = array();

    function __construct($pagina) {
        $html = str_get_html($pagina);
        $semestresHtml = $html->find(".grupo_semestre");
        for ($i =0 ; $i < count($semestresHtml) ; $i++) {
            $semestre = new Semestre($semestresHtml[$i], $i);
            array_push($this->semestres, $semestre);
        }
    }

    public function getSemestresNombres() {
        return $this->semestres;
    }

}
