<?php

if ( !isset($_SESSION) ) {
    session_start();
}

require_once "../config.php";

class AddUserModel{
    private $usernameAdd;
    private $passwordAdd;
    private $accessTypeAdd;
    private $firstNameAdd;
    private $middleNameAdd;
    private $lastNameAdd;
    private $companyName;

    public function __construct(
        $usernameAdd, 
        $passwordAdd, 
        $accessTypeAdd,
        $firstNameAdd,
        $middleNameAdd,
        $lastNameAdd,
        $companyName
        ){

        $this->usernameAdd = $usernameAdd;
        $this->passwordAdd = $passwordAdd;
        $this->accessTypeAdd = $accessTypeAdd;
        $this->firstNameAdd = $firstNameAdd;
        $this->middleNameAdd = $middleNameAdd;
        $this->lastNameAdd = $lastNameAdd;
        $this->companyName = $companyName;

    }

    public function addUserRecord(){

        if($this->emptyValidator() == false || $this->lengthValidator() == false || $this->patternValidator() == false ){
            
            $_SESSION['prompt'] = "The information you entered are not valid test!";
            header('location: ../modal-prompt.php');
            exit();
        }

        if($this->usernameValidator() == false){
            
            $_SESSION['prompt'] = "The username you entered is already taken!";
            header('location: ../modal-prompt.php');
            exit();
        }

        $this->addUserSubmit();
    }

    private function addUserSubmit(){

        $sql = "INSERT INTO user (username, password, accessType, firstName, middleName, lastName, companyName) VALUES (:username, :password, :accessType, :firstName, :middleName, :lastName, :companyName)";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":username", $paramUsernameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":password", $paramPasswordAdd, PDO::PARAM_STR);
            $stmt->bindParam(":accessType", $paramAccessTypeAdd, PDO::PARAM_STR);
            $stmt->bindParam(":firstName", $paramFirstNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":middleName", $paramMiddleNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":lastName", $paramLastNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramUsernameAdd = $this->usernameAdd;
            $paramPasswordAdd = password_hash($this->passwordAdd, PASSWORD_DEFAULT);
            $paramAccessTypeAdd = $this->accessTypeAdd;
            $paramFirstNameAdd = $this->firstNameAdd;
            $paramMiddleNameAdd = $this->middleNameAdd;
            $paramLastNameAdd = $this->lastNameAdd;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){

            } else{
               
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function emptyValidator(){
        if(empty(trim($this->usernameAdd)) || empty(trim($this->passwordAdd)) || empty(trim($this->accessTypeAdd))|| empty(trim($this->firstNameAdd))|| empty(trim($this->middleNameAdd))|| empty(trim($this->lastNameAdd))){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function lengthValidator(){
        if(strlen(trim($this->usernameAdd)) < 6 && strlen(trim($this->usernameAdd)) > 20 && 
        strlen(trim($this->passwordAdd)) < 6 && strlen(trim($this->passwordAdd)) > 20 &&
        strlen(trim($this->firstNameAdd)) < 1 && strlen(trim($this->firstNameAdd)) > 255 &&
        strlen(trim($this->middleNameAdd)) < 1 && strlen(trim($this->middleNameAdd)) > 255 &&
        strlen(trim($this->lastNameAdd)) < 1 && strlen(trim($this->lastNameAdd)) > 255){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function patternValidator(){
        if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($this->usernameAdd)) || !preg_match('/^[a-zA-Z\s]+$/', trim($this->firstNameAdd)) || !preg_match('/^[a-zA-Z\s]+$/', trim($this->middleNameAdd))|| !preg_match('/^[a-zA-Z\s]+$/', trim($this->lastNameAdd)) ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    public function usernameValidator(){
        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();
    
        $sql = "SELECT * FROM user WHERE username = :username";
            
        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":username", $paramUsernameAdd, PDO::PARAM_STR);
            
            
            $paramUsernameAdd = $this->usernameAdd;
            

            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $result = false;
                }
                else{
                    $result = true;
                }
    
            } else{
                
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }
    
            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }
}