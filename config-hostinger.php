<?php

class Config {

    private $host = 'localhost';
    private $user = 'u829557651_tdms';
    private $password = '5?#&+OTN+yYz';
    private $dbname = 'u829557651_tdms';

    public function pdoConnect(){
        try{
            $pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch(PDOException $e){
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    }
}

?>