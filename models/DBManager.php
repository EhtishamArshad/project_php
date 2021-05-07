<?php

namespace Project\Models;

use Exception;
use mysqli;

define('DBController', 1);
include 'config/config.php';

class DBManager
{

    private $database = DBNAME;
    private $host = DBHOST;
    private $user = DBUSER;
    private $password = DBPASS;

    /**
     * @var mysqli
     */
    private $db;

    public function __construct()
    {
        $this->db = $this->connect();

        if (mysqli_connect_errno()) {
            if(strpos(mysqli_connect_errno(), "Unknown database") !== NULL) {
                $this->install();
            }
            $this->db = $this->connect();
        }

        if(mysqli_connect_errno()) {
            throw new Exception("Couldn't connect to DB");
        }
    }

    private function connect()
    {
        return new mysqli($this->host, $this->user, $this->password, $this->database);
    }

    private function install()
    {
        $db = new mysqli($this->host, $this->user, $this->password);

        if ($db->connect_error) {
            throw new Exception("Unable to connect to DB");
        }
        
        $dbSql = "CREATE DATABASE " . $this->database;

        if ($db->query($dbSql) == true) {
            echo 'Database created successfully';
        } else {
            throw new Exception('Error setting up database:' . $db->error);
        }

        $sql = "CREATE TABLE customer (
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL
        )  ENGINE=INNODB;";

        $sql .= "CREATE TABLE orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            customer_id INT NOT NULL,
            purchase_date TIMESTAMP,
            country VARCHAR(255) NOT NULL,
            device VARCHAR(255) NOT NULL
        )  ENGINE=INNODB;";

        $sql .= "CREATE TABLE orderItems (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT NOT NULL,
            ean VARCHAR(255) NOT NULL,
            quantity VARCHAR(255) NOT NULL,
            price VARCHAR(255) NOT NULL
        )  ENGINE=INNODB;";

        if (mysqli_multi_query($this->connect(), $sql)) {
            echo 'Tables created successfully';
        } else {
            throw new Exception('Error setting up database:' . $db->error);
        }
    }

    public function connectDB()
    {
        return $this->db;
    }
}
