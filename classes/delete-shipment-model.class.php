<?php

require_once "../config.php";

class DeleteShipmentModel{
    private $shipmentId;
    
    public function __construct( $shipmentId){
        $this->shipmentId = $shipmentId;
    }

    public function deleteShipmentRecord(){
        $this->deleteShipmentSubmit();
    }

    public function deleteShipmentSubmit(){

        $sql = "DELETE FROM shipment WHERE shipment_id = :shipment_id";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":shipment_id", $paramShipmentId, PDO::PARAM_STR);

            $paramShipmentId = $this->shipmentId;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
                echo "Something went wrong, unable to delete shipment!";
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}