<?php

require_once "../config.php";

class DeletePermissionModel{
    private $typeId;
    
    public function __construct( $typeId){
        $this->typeId = $typeId;
    }

    public function deletePermissionRecord(){
        $this->deletePermissionSubmit();
    }

    public function deletePermissionSubmit(){

        $sql = "DELETE FROM vehicletype WHERE type_id = :type_id";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":type_id", $param1, PDO::PARAM_STR);

            $param1 = $this->typeId;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
                echo "Something went wrong, unable to delete role!";
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}