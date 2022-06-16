<?php

require_once "../config.php";

class DeleteShipmentModel{
    private $shipmentNumberDelete;
    private $companyName;

    public function __construct( $shipmentNumberDelete, $companyName){
        $this->shipmentNumberDelete = $shipmentNumberDelete;
        $this->companyName = $companyName;
    }

    public function deleteShipmentRecord(){
        $this->deleteShipmentSubmit();
    }

    public function deleteShipmentSubmit(){

        $sql = "DELETE FROM shipment WHERE shipmentNumber = :shipmentNumber AND companyName = :companyName";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":shipmentNumber", $paramShipmentNumberDelete, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramShipmentNumberDelete = $this->shipmentNumberDelete;
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