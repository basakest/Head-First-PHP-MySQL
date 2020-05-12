<?php
    $username = 'syq';
    $password = '201916';

    if ( !isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || ($_SERVER['PHP_AUTH_USER'] != 'syq') || ($_SERVER['PHP_AUTH_PW'] != '201916')) {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate:Basic realm="Guitar Wars"');
        exit('<h2>Guitar Wars</h2>Sorry, you must enter a valid user name and password to acess the page.');
    }
?>