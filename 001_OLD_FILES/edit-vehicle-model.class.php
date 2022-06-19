<?php

if ( !isset($_SESSION) ) {
    session_start();
}

require_once "../config.php";

class EditVehicleModel{
    private $vehiclePlateNumberEdit;
    private $usernameEdit;
    private $companyName;

    public function __construct(
        $vehiclePlateNumberEdit, 
        $usernameEdit, 
        $companyName
        ){

        $this->vehiclePlateNumberEdit = $vehiclePlateNumberEdit;
        $this->usernameEdit = $usernameEdit;
        $this->companyName = $companyName;

    }

    public function editVehicleRecord(){

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

        $this->editVehicleSubmit();
    }

    private function editVehicleSubmit(){

        $sql = "UPDATE vehicle 
        SET ownerUsername = :ownerUsername 
        WHERE vehiclePlateNumber = :vehiclePlateNumber AND companyName = :companyName";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":vehiclePlateNumber", $paramVehiclePlateNumberEdit, PDO::PARAM_STR);
            $stmt->bindParam(":ownerUsername", $paramUsernameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramVehiclePlateNumberEdit = $this->vehiclePlateNumberEdit;;
            $paramUsernameEdit = $this->usernameEdit;
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
        if(empty(trim($this->vehiclePlateNumberEdit)) || empty(trim($this->usernameEdit)) ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function lengthValidator(){
        if(strlen(trim($this->vehiclePlateNumberEdit)) < 1 && strlen(trim($this->vehiclePlateNumberEdit)) > 255 &&
        strlen(trim($this->usernameEdit)) < 6 && strlen(trim($this->usernameEdit)) > 30){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function patternValidator(){
        if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($this->usernameEdit)) || !preg_match('/^[a-zA-Z0-9]+$/', trim($this->vehiclePlateNumberEdit)) ){
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

            $stmt->bindParam(":username", $paramUsernameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramUsernameEdit = $this->usernameEdit;
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
}