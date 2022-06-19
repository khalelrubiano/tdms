<?php

if ( !isset($_SESSION) ) {
    session_start();
}

require_once "../config.php";

class EditTrackerModel{
    private $vehiclePlateNumberEdit;
    private $trackerIdEdit;
    private $companyName;

    public function __construct(
        $vehiclePlateNumberEdit, 
        $trackerIdEdit, 
        $companyName
        ){

        $this->vehiclePlateNumberEdit = $vehiclePlateNumberEdit;
        $this->trackerIdEdit = $trackerIdEdit;
        $this->companyName = $companyName;

    }

    public function editTrackerRecord(){

        $this->editTrackerSubmit();
    }

    private function editTrackerSubmit(){

        $sql = "UPDATE tracker SET trackerId = :trackerId, vehiclePlateNumber = :vehiclePlateNumber, companyName = :companyName WHERE trackerId = :trackerId";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":trackerId", $paramTrackerIdEdit, PDO::PARAM_STR);
            $stmt->bindParam(":vehiclePlateNumber", $paramVehiclePlateNumberEdit, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramTrackerIdEdit = $this->trackerIdEdit;
            $paramVehiclePlateNumberEdit = $this->vehiclePlateNumberEdit;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                echo "Successfully edited!";
            } else{
               
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
                
            }

            unset($stmt);
        }
        unset($pdoVessel);
    }

}