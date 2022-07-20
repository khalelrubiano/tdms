<?php

require_once "../config.php";

class DeleteClientAreaModel{
    private $clientAreaIdDelete;
    
    public function __construct( $clientAreaIdDelete){
        $this->clientAreaIdDelete = $clientAreaIdDelete;
    }

    public function deleteClientAreaRecord(){
        $this->deleteClientAreaSubmit();
    }

    public function deleteClientAreaSubmit(){

        $sql = "DELETE FROM clientarea WHERE area_id = :area_id";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":area_id", $paramAreaIdDelete, PDO::PARAM_STR);

            $paramAreaIdDelete = $this->clientAreaIdDelete;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
                echo "Something went wrong, unable to delete area!";
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}