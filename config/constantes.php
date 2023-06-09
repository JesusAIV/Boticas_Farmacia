<?php

    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) === 'https://' ? 'https://' : 'http://';
    $baseUrl = $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/';

    /**
     * URL base del sistema
     */
    define('SERVERURL', $baseUrl);

    /**
     * Nombre del sistema
     */
    const NAME = "Farma Salud";

    /**
     * Host para la base de datos
     */
    const HOST = "srv847.hstgr.io";

    /**
     * Usuario de la base de datos
     */
    const USER = "u690797633_botica_Jhard02";

    /**
     * Contraseña de la base de datos
     */
    const PASSWORD = "botica_Jhard02";

    /**
     * Nombre de base de datos
     */
    const NAME_BD = "u690797633_botica_Jhard02";