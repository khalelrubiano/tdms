<?php

require_once "../config.php";

class DeleteVehicleModel{
    private $vehicleIdDelete;
    
    public function __construct( $vehicleIdDelete){
        $this->vehicleIdDelete = $vehicleIdDelete;
    }

    public function deleteVehicleRecord(){
        $this->deleteVehicleSubmit();
    }

    public function deleteVehicleSubmit(){

        $sql = "DELETE FROM vehicle WHERE vehicle_id = :vehicle_id";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":vehicle_id", $paramDelete, PDO::PARAM_STR);

            $paramDelete = $this->vehicleIdDelete;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
                echo "Something went wrong, unable to delete vehicle!";
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}