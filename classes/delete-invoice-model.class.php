<?php

require_once "../config.php";

class DeleteInvoiceModel{
    private $billingInvoiceNumberDelete;
    private $companyName;

    public function __construct( $billingInvoiceNumberDelete, $companyName){
        $this->billingInvoiceNumberDelete = $billingInvoiceNumberDelete;
        $this->companyName = $companyName;
    }

    public function deleteInvoiceRecord(){
        $this->deleteInvoiceSubmit();
    }

    public function deleteInvoiceSubmit(){

        $sql = "DELETE FROM billing WHERE billingInvoiceNumber = :billingInvoiceNumber AND companyName = :companyName";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":billingInvoiceNumber", $paramBillingInvoiceNumberDelete, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramBillingInvoiceNumberDelete = $this->billingInvoiceNumberDelete;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
               session_start();
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}