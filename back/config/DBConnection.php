<?php
    class DBConexion {
        public static function connection() {
            $connection = new mysqli("db", "root", "asd123", "gila_notification_test");
            if ( $connection->errno ) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            } else {
                $connection->query("SET NAMES 'utf8'");
                return $connection;
            }
        }
    }
?>