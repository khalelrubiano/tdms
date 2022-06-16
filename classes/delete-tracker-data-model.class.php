<?php

require_once "../config.php";

class DeleteTrackerModel{
    private $trackerId;

    public function __construct( $trackerId){
        $this->trackerId = $trackerId;
    }

    public function deleteTrackerRecord(){
        $this->deleteUserSubmit();
    }

    public function deleteUserSubmit(){

        $sql = "DELETE FROM trackerlocation WHERE trackerId = :trackerId";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":trackerId", $paramtrackerId, PDO::PARAM_STR);

            $paramtrackerId = $this->trackerId;

            if($stmt->execute()){
                echo "Successfully deleted!";
            } else{
               session_start();
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }

            unset($stmt);
        }
        unset($pdoVessel);
    }
}