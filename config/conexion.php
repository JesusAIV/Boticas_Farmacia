<?php

    require_once "constantes.php";

    /**
     * Clase de conexión
     */
    class Connection{

        /**
         * Conexion a base de datos
         *
         * @return mixed retorna conexion
         */
        public static function connect(){

            $host = HOST;
            $username = USER;
            $password = PASSWORD;
            $database = NAME_BD;

            try {
                // Crea la conexión
                $conn = mysqli_connect($host, $username, $password, $database);

                // Verifica la conexión
                if (!$conn) {
                    throw new Exception("Connection failed: " . mysqli_connect_error());
                }
            } catch (Exception $e) {
                return $e;
            }

            return $conn;
        }
    }