<?php
    $nombre = 'Jesús Isique';
    $apellido = 'Isique Vasquez';
    $dni = '74893553';

    $lastname = strpos($apellido, ' ');

    $userName = substr($dni, 0, 4) . substr($nombre, 0, 1) . substr($apellido, 0, $lastname) . substr($dni, 4, 8);

    echo $userName;