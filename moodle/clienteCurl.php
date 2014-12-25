<?php

function login($ch, $login, $password) {
    $url = "https://campusvirtual.univalle.edu.co/moodle/login/index.php";
    $postfields = array('username' => $login, 'password' => $password);
    $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    $cookie_file = "cookie1.txt";
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    return curl_exec($ch);
}

function getContenido($ch, $materia) {
    curl_setopt($ch, CURLOPT_URL, $materia->vinculo);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "");
    return curl_exec($ch);
}
