<?php

require_once "../config.php";

class DeleteModel{
    private $billingId;
    
    public function __construct( $billingId){
        $this->billingId = $billingId;
    }

    public function deleteRecord(){
        $this->deleteSubmit();
    }

    public function deleteSubmit(){

        $sql = "DELETE FROM billing WHERE billing_id = :billing_id";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":billing_id", $param1, PDO::PARAM_STR);

            $param1 = $this->billingId;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
                echo "Something went wrong, unable to delete invoice!";
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}