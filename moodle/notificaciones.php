<?php
include_once 'simple_html_dom.php';
// enviamos peticiones a todas las páginas 
function revisarNotificaciones($ch, $carrera) {
    for ($i = 0; $i < count($carrera->semestres); $i++) {
        $semestre = $carrera->semestres[$i];
        for ($j = 0; $j < count($semestre->materias); $j++) {
            $materia = $semestre->materias[$j];
            if ($i == 0/*$materia->monitorear*/) {
                $pagina = getContenido($ch, $materia);
                imprimir(notificacionesPorAnuncios($pagina),$materia, $semestre);
                //notificacionesPorCache($pagina,$materia, $semestre);
            }/**/
        }
    }
}

function imprimir($arregloNotificaciones, $materia, $semestre){
    if(is_array($arregloNotificaciones) && count($arregloNotificaciones)> 0){
        echo "Tienes una notificación en ".$materia." del semestre ".$semestre;
    }
}

function notificacionesPorAnuncios($pagina) {
    $objHtml = str_get_html($pagina);
    $mensaje = $objHtml->find(".message")[0];
    if (strcmp($mensaje->innertext, "Sin novedades desde el último acceso") == 0) {
        return []; // Sin novedades
    } else {
        return $mensaje->innertext; // Hay algo
    }
}

function notificacionesPorCache($pagina, $materia, $semestre) {
    // Verificar si existe ./cache/$semestre/$materia.html
    // Si no existe entonces retornar []
    // Si existe entonces 
    // Hacer un dif entre $pagina y ./cache/$semestre/$materia.html
    // http://php.net/manual/en/function.xdiff-file-diff.php
    // xdiff_file_diff($old_version, $new_version, 'my_script.diff', 2);
    // Si son iguales entonces no hay notificaciones (omitir el tiempo)
    // Si son distintas hallar las diferencias y mostrarlas
    // Reemplazar el .html mas viejo por el nuevo
}
