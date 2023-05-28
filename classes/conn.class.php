<?php

class Conn {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbName = "gt-redirect";
    
    protected function connect() {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName; 
            $pdo = new PDO($dsn, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            print "Error!:" . $e->getMessage() ."<br/>";
            die();
        }
        

        
    }
}

?>