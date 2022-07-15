<?php

require_once "../config.php";

class DeletePermissionModel{
    private $permissionIdDelete;
    
    public function __construct( $permissionIdDelete){
        $this->permissionIdDelete = $permissionIdDelete;
    }

    public function deletePermissionRecord(){
        $this->deletePermissionSubmit();
    }

    public function deletePermissionSubmit(){

        $sql = "DELETE FROM permission WHERE permission_id = :permission_id";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":permission_id", $paramPermissionIdDelete, PDO::PARAM_STR);

            $paramPermissionIdDelete = $this->permissionIdDelete;

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