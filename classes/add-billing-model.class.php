<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";

// loop through the shipmentNumberArray and create one billedShipment entry on each pass (Do this on model, just pass the shipmentNumberArray onto model)

class GenerateInvoiceModel{
    private $invoiceNumberAdd;
    private $invoiceDateAdd;
    private $clientAdd;
    private $dropFeeAdd;
    private $parkingFeeAdd;
    private $demurrageAdd;
    private $otherChargesAdd;
    private $penaltyAdd;
    private $startDateAdd;
    private $endDateAdd;

    public function __construct(
        $invoiceNumberAdd, 
        $invoiceDateAdd, 
        $clientAdd, 
        $dropFeeAdd, 
        $parkingFeeAdd,
        $demurrageAdd,
        $otherChargesAdd,
        $penaltyAdd,
        $startDateAdd,
        $endDateAdd
        ){

        $this->invoiceNumberAdd = $invoiceNumberAdd;
        $this->invoiceDateAdd = $invoiceDateAdd;
        $this->clientAdd = $clientAdd;
        $this->dropFeeAdd = $dropFeeAdd;
        $this->parkingFeeAdd = $parkingFeeAdd;
        $this->demurrageAdd = $demurrageAdd;
        $this->otherChargesAdd = $otherChargesAdd;
        $this->penaltyAdd = $penaltyAdd;
        $this->startDateAdd = $startDateAdd;
        $this->endDateAdd = $endDateAdd;
    }

    public function generateInvoiceRecord(){

        $this->generateInvoiceSubmit();
/*
        for($i = 0; $i < count($this->shipmentNumberArray); $i++){
            
            $this->billedShipmentSubmit($this->shipmentNumberArray[$i]);
            
        }
        */
    }

    public function generateInvoiceSubmit(){

        $sql = "INSERT INTO 
                billing(
                invoice_number, 
                invoice_date, 
                billing_status, 
                client_id,
                drop_fee,
                parking_fee,
                demurrage,
                other_charges,
                less_penalties,
                start_date,
                end_date
                ) 
                VALUES(
                :invoice_number, 
                :invoice_date, 
                :billing_status, 
                :client_id,
                :drop_fee,
                :parking_fee,
                :demurrage,
                :other_charges,
                :less_penalties,
                :start_date,
                :end_date
                )";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":invoice_number", $param1, PDO::PARAM_STR);
            $stmt->bindParam(":invoice_date", $param2, PDO::PARAM_STR);
            $stmt->bindParam(":billing_status", $param3, PDO::PARAM_STR);
            $stmt->bindParam(":client_id", $param4, PDO::PARAM_STR);
            $stmt->bindParam(":drop_fee", $param5, PDO::PARAM_STR);
            $stmt->bindParam(":parking_fee", $param6, PDO::PARAM_STR);
            $stmt->bindParam(":demurrage", $param7, PDO::PARAM_STR);
            $stmt->bindParam(":other_charges", $param8, PDO::PARAM_STR);
            $stmt->bindParam(":less_penalties", $param9, PDO::PARAM_STR);
            $stmt->bindParam(":start_date", $param10, PDO::PARAM_STR);
            $stmt->bindParam(":end_date", $param11, PDO::PARAM_STR);
            
            $param1 = $this->invoiceNumberAdd;
            $param2 = $this->invoiceDateAdd;
            $param3 = "Unsettled";
            $param4 = $this->clientAdd;
            $param5 = $this->dropFeeAdd;
            $param6 = $this->parkingFeeAdd;
            $param7 = $this->demurrageAdd;
            $param8 = $this->otherChargesAdd;
            $param9 = $this->penaltyAdd;
            $param10 = $this->startDateAdd;
            $param11 = $this->endDateAdd;

            if($stmt->execute()){
                //echo "Successfully added a record!";
            } else{
               
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    public function getBillingId(){

        $sql = "SELECT 
        billing_id 
        FROM billing 
        WHERE invoice_number = :invoice_number AND invoice_date";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":billingInvoiceNumber", $paramBillingInvoiceNumberGenerate, PDO::PARAM_STR);
            $stmt->bindParam(":shipmentNumber", $paramShipmentNumber, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramBillingInvoiceNumberGenerate = $this->billingInvoiceNumberGenerate;
            $paramShipmentNumber = $shipmentNumberVar;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                //echo "Successfully added a record!";
            } else{
               
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
                
            }

            unset($stmt);
        }
        unset($pdoVessel);
    }

    public function billedShipmentSubmit($shipmentNumberVar){

        $sql = "INSERT INTO 
                billedshipment(
                shipmentNumber,
                billingInvoiceNumber,
                companyName
                ) 
                VALUES(
                :shipmentNumber,
                :billingInvoiceNumber,
                :companyName
                )";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":billingInvoiceNumber", $paramBillingInvoiceNumberGenerate, PDO::PARAM_STR);
            $stmt->bindParam(":shipmentNumber", $paramShipmentNumber, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramBillingInvoiceNumberGenerate = $this->billingInvoiceNumberGenerate;
            $paramShipmentNumber = $shipmentNumberVar;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                //echo "Successfully added a record!";
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