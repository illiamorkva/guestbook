<?php

/**
 * Class Db
 * Component for working with database
 */
class Db
{

    /**
     * Establishes a connection to the database
     * @return \PDO <p>Object of class PDO for working with DB</p>
     */
    public static function getConnection()
    {
        // Get the connection parameters from a file
        $paramsPath = ROOT . '/config/db_params.php';
        $params =
            include($paramsPath);

        // Set the connection
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        // Specify the encoding
        $db->exec("set names utf8");

        return $db;
    }

}

