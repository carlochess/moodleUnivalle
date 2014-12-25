<?php   

include_once 'simple_html_dom.php';
include('Carrera.php');
include('Semestre.php');
include('Materia.php');
include('clienteCurl.php');
include('notificaciones.php');

function actualizarDatos($info) {
    /*if (file_exists("configuracion.info")) {
        $carrera = new Carrera(json_decode(file_get_contents("configuracion.info")));
    } else {*/
        $carrera = new Carrera($info);
        file_put_contents("configuracion.info", json_encode($carrera));
        //unlink("configuracion.info");
    //}
    return $carrera;
}

function crearCarpetasCache($carrera) {
    // Creamos las carpetas para comparar
    if (!file_exists("./cache/")) {
        if (!mkdir("cache/", 0777, true)) {
            return 1;
        }
    }
    foreach ($carrera->getSemestresNombres() as $semestres) {
        if (!file_exists("cache/" . $semestres->nombre . "/")) {
            mkdir("cache/" . $semestres->nombre . "/", 0777, true);
        }
        foreach ($semestres->getMateriasNombres() as $materia) {
            if ($materia->monitorear) {
                if (!file_exists("cache/" . $semestres->nombre . "/" . $materia->nombre . "/")) {
                    mkdir("cache/" . $semestres->nombre . "/" . $materia->nombre . "/", 0777, true);
                }
            }
        }
    }
}

function imprimirLog($str){
    if(php_sapi_name() == 'cli'){
        echo $str."<br/>"/*"\n"*/;
    }else{
        echo $str."<br/>";
    }
}

function main($login, $password) {
    $ch = curl_init();
    imprimirLog("Entrando");
    $info = login($ch, $login, $password);
    imprimirLog("Adentro");
    // Leemos el archivo de configuración si existen
    imprimirLog('Leyendo archivos de configuración');
    $carrera = actualizarDatos($info);
    imprimirLog('Archivos de configuración leido');
    // Creamos las carpetas para el caché
    imprimirLog('Creando carpetas');
    crearCarpetasCache($carrera);
    imprimirLog('Carpetas creadas');
    imprimirLog('Revisando notificaciones');
    revisarNotificaciones($ch, $carrera);
    imprimirLog('Termina');
}

main("",'');