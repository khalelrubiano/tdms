<?php

if ( !isset($_SESSION) ) {
    session_start();
}

require_once "../config.php";

class AddTrackerModel{
    private $vehiclePlateNumberAdd;
    private $trackerIdAdd;
    private $companyName;

    public function __construct(
        $vehiclePlateNumberAdd, 
        $trackerIdAdd, 
        $companyName
        ){

        $this->vehiclePlateNumberAdd = $vehiclePlateNumberAdd;
        $this->trackerIdAdd = $trackerIdAdd;
        $this->companyName = $companyName;

    }

    public function addTrackerRecord(){

        if($this->emptyValidator() == false || $this->lengthValidator() == false || $this->patternValidator() == false ){
            
            $_SESSION['prompt'] = "The information you entered are not valid!";
            header('location: ../modal-prompt.php');
            exit();
        }

        if($this->trackerIdValidator() == false){
            /*
            $_SESSION['prompt'] = "The tracker ID you entered is already registered!";
            header('location: ../modal-prompt.php');
            exit();
            */
            $res = "The tracker ID you entered is already registered!";
            echo $res;
            exit;
        }

        $this->addTrackerSubmit();
    }

    private function addTrackerSubmit(){

        $sql = "INSERT INTO tracker (trackerId, vehiclePlateNumber, companyName) VALUES (:trackerId, :vehiclePlateNumber, :companyName)";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":trackerId", $paramTrackerIdAdd, PDO::PARAM_STR);
            $stmt->bindParam(":vehiclePlateNumber", $paramVehiclePlateNumberAdd, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramTrackerIdAdd = $this->trackerIdAdd;
            $paramVehiclePlateNumberAdd = $this->vehiclePlateNumberAdd;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                echo "Successfully added!";
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
        if(empty(trim($this->trackerIdAdd))){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function lengthValidator(){
        if(strlen(trim($this->trackerIdAdd)) < 1 && strlen(trim($this->trackerIdAdd)) > 255){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function patternValidator(){
        if(!preg_match('/^[0-9]+$/', trim($this->trackerIdAdd))){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
    public function trackerIdValidator(){
        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();
    
        $sql = "SELECT * FROM tracker WHERE trackerId = :trackerId";
            
        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":trackerId", $paramTrackerIdAdd, PDO::PARAM_STR);
            
            
            $paramTrackerIdAdd = $this->trackerIdAdd;
            

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