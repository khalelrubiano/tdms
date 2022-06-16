<?php

if ( !isset($_SESSION) ) {
    session_start();
}

require_once "../config.php";

class AddVehicleModel{
    private $vehiclePlateNumberAdd;
    private $usernameAdd;
    private $companyName;

    public function __construct(
        $vehiclePlateNumberAdd, 
        $usernameAdd, 
        $companyName
        ){

        $this->vehiclePlateNumberAdd = $vehiclePlateNumberAdd;
        $this->usernameAdd = $usernameAdd;
        $this->companyName = $companyName;

    }

    public function addVehicleRecord(){

        if($this->emptyValidator() == false || $this->lengthValidator() == false || $this->patternValidator() == false ){
            
            $_SESSION['prompt'] = "The information you entered are not valid!";
            header('location: ../modal-prompt.php');
            exit();
        }

        if($this->usernameValidator() == true){
            
            $_SESSION['prompt'] = "The username you entered is not registered in the system!";
            header('location: ../modal-prompt.php');
            exit();
        }

        if($this->vehiclePlateNumberValidator() == true){
            
            $_SESSION['prompt'] = "The vehicle plate number you entered is already registered in the system!";
            header('location: ../modal-prompt.php');
            exit();
        }

        $this->addVehicleSubmit();
    }

    private function addVehicleSubmit(){

        $sql = "INSERT INTO vehicle (vehiclePlateNumber, ownerUsername, companyName) VALUES (:vehiclePlateNumber, :ownerUsername, :companyName)";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":vehiclePlateNumber", $paramVehiclePlateNumberAdd, PDO::PARAM_STR);
            $stmt->bindParam(":ownerUsername", $paramUsernameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramVehiclePlateNumberAdd = $this->vehiclePlateNumberAdd;;
            $paramUsernameAdd = $this->usernameAdd;
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
        if(empty(trim($this->vehiclePlateNumberAdd)) || empty(trim($this->usernameAdd)) ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function lengthValidator(){
        if(strlen(trim($this->vehiclePlateNumberAdd)) < 1 && strlen(trim($this->vehiclePlateNumberAdd)) > 255 &&
        strlen(trim($this->usernameAdd)) < 6 && strlen(trim($this->usernameAdd)) > 30){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function patternValidator(){
        if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($this->usernameAdd)) || !preg_match('/^[a-zA-Z0-9]+$/', trim($this->vehiclePlateNumberAdd)) ){
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
    
        $sql = "SELECT * FROM user WHERE username = :username AND companyName = :companyName";
            
        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":username", $paramUsernameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramUsernameAdd = $this->usernameAdd;
            $paramCompanyName = $this->companyName;

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
    public function vehiclePlateNumberValidator(){
        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();
    
        $sql = "SELECT * FROM vehicle WHERE vehiclePlateNumber = :vehiclePlateNumber";
            
        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":vehiclePlateNumber", $paramVehiclePlateNumber, PDO::PARAM_STR);

            
            $paramVehiclePlateNumber = $this->vehiclePlateNumberAdd;


            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $result = true;
                }
                else{
                    $result = false;
                }
    
            } else{
                session_start();
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