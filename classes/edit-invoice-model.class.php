<?php

if ( !isset($_SESSION) ) {
    session_start();
}

require_once "../config.php";

class EditInvoiceModel{
    private $billingInvoiceNumberEdit;
    private $billingStatusEdit;
    private $companyName;


    public function __construct( 
        $billingInvoiceNumberEdit,
        $billingStatusEdit, 
        $companyName
        ){

        $this->billingInvoiceNumberEdit = $billingInvoiceNumberEdit;
        $this->billingStatusEdit = $billingStatusEdit;
        $this->companyName = $companyName;

    }

    public function editInvoiceRecord(){

        $this->editInvoiceSubmit();
        
    }

    public function editInvoiceSubmit(){

        $sql = "UPDATE 
        billing 
        SET
        billingStatus = :billingStatus
        WHERE 
        billingInvoiceNumber = :billingInvoiceNumber and companyName = :companyName";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":billingInvoiceNumber", $paramBillingInvoiceNumberEdit, PDO::PARAM_STR);
            $stmt->bindParam(":billingStatus", $paramBillingStatusEdit, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            
            $paramBillingInvoiceNumberEdit = $this->billingInvoiceNumberEdit;
            $paramBillingStatusEdit = $this->billingStatusEdit;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                echo "Successfully edited a record!";
            } else{
               
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}