<?php

class Config {

    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'tdms';

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