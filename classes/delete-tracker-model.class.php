<?php

require_once "../config.php";

class DeleteClientModel{
    private $trackerIdDelete;
    
    public function __construct( $trackerIdDelete){
        $this->trackerIdDelete = $trackerIdDelete;
    }

    public function deleteClientRecord(){
        $this->deleteClientSubmit();
    }

    public function deleteClientSubmit(){

        $sql = "DELETE FROM tracking WHERE tracking_id = :tracking_id";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":tracking_id", $param1, PDO::PARAM_STR);

            $param1 = $this->trackerIdDelete;

            if($stmt->execute()){
                echo "Successfully removed!";
            } else{
                echo "Something went wrong, unable to remove!";
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}