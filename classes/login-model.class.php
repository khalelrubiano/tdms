<?php

if ( !isset($_SESSION) ) {
    session_start();
}

require_once "../config.php";


class LoginModel{
    private $username;
    private $password;

    public function __construct($username, $password){

        $this->username = $username;
        $this->password = $password;

    }

    public function login(){

        if($this->emptyValidator() == false){

            $_SESSION['prompt'] = "The information you entered are not valid!";
            header('location: ../prompt.php');
            exit();
        }

        $this->loginSubmit();

    }

    private function loginSubmit(){

        $configObj = new Config();
        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT 
        username, 
        password, 
        accessType,
        firstName,
        middleName,
        lastName, 
        companyName 
        FROM user
        WHERE username = :username";
        
        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":username", $paramUsername, PDO::PARAM_STR);
            
            $paramUsername = trim($this->username);
            
            if($stmt->execute()){

                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){

                        $username = $row["username"];
                        $accessType = $row["accessType"];
                        $firstName = $row["firstName"];
                        $middleName = $row["middleName"];
                        $lastName = $row["lastName"];
                        $companyName = $row["companyName"];
                        $hashedPassword = $row["password"];

                        if(password_verify($this->password, $hashedPassword)){


                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;
                            $_SESSION["password"] = $hashedPassword;
                            $_SESSION["accessType"] = $accessType;
                            $_SESSION["firstName"] = $firstName;
                            $_SESSION["middleName"] = $middleName;
                            $_SESSION["lastName"] = $lastName;
                            $_SESSION["companyName"] = $companyName;              
                            
                            header("location: ../index.php");

                        } else{

                            $_SESSION ["prompt"] = "Invalid username or password!";
                            header('location: ../prompt.php');
                            exit();
                        }
                    }
                } else{

                    $_SESSION ["prompt"] = "Invalid username or password!";
                    header('location: ../prompt.php');
                    exit();
                }
            } else{

                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }
            unset($stmt);
        }
        unset($pdoVessel);
    }


    private function emptyValidator(){
        if(empty(trim($this->username)) || empty(trim($this->password)) ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
}