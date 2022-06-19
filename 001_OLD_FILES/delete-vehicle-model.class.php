<?php

require_once "../config.php";

class DeleteVehicleModel{
    private $vehiclePlateNumberDelete;
    private $companyName;

    public function __construct( $vehiclePlateNumberDelete, $companyName){
        $this->vehiclePlateNumberDelete = $vehiclePlateNumberDelete;
        $this->companyName = $companyName;
    }

    public function deleteVehicleRecord(){
        $this->deleteVehicleSubmit();
    }

    public function deleteVehicleSubmit(){

        $sql = "DELETE FROM vehicle 
        WHERE vehiclePlateNumber = :vehiclePlateNumber AND companyName = :companyName";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":vehiclePlateNumber", $paramVehiclePlateNumberDelete, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramVehiclePlateNumberDelete = $this->vehiclePlateNumberDelete;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
               session_start();
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}