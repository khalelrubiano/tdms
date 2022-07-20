<?php

require_once "../config.php";

class DeleteClientModel{
    private $clientIdDelete;
    
    public function __construct( $clientIdDelete){
        $this->clientIdDelete = $clientIdDelete;
    }

    public function deleteClientRecord(){
        $this->deleteClientSubmit();
    }

    public function deleteClientSubmit(){

        $sql = "DELETE FROM client WHERE client_id = :client_id";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":client_id", $paramClientIdDelete, PDO::PARAM_STR);

            $paramClientIdDelete = $this->clientIdDelete;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
                echo "Something went wrong, unable to delete client!";
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}