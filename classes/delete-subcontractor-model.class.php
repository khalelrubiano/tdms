<?php

require_once "../config.php";

class DeleteSubcontractorModel{
    private $usernameDelete;
    
    public function __construct( $usernameDelete){
        $this->usernameDelete = $usernameDelete;
    }

    public function deleteSubcontractorRecord(){
        $this->deleteSubcontractorSubmit();
    }

    public function deleteSubcontractorSubmit(){

        $sql = "DELETE FROM subcontractor WHERE subcontractor_id = :subcontractor_id";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":subcontractor_id", $paramUsernameDelete, PDO::PARAM_STR);

            $paramUsernameDelete = $this->usernameDelete;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
                echo "Something went wrong, unable to delete subcontractor account!";
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}