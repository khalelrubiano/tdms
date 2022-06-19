<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";

// loop through the shipmentNumberArray and create one billedShipment entry on each pass (Do this on model, just pass the shipmentNumberArray onto model)

class GenerateInvoiceModel{
    private $billingInvoiceNumberGenerate;
    private $clientGenerate;
    private $dropFeeGenerate;
    private $parkingFeeGenerate;
    private $demurrageGenerate;
    private $otherChargesGenerate;
    private $lessPenaltiesGenerate;
    private $shipmentNumberArray;
    private $companyName;

    public function __construct(
        $billingInvoiceNumberGenerate, 
        $clientGenerate, 
        $dropFeeGenerate, 
        $parkingFeeGenerate,
        $demurrageGenerate,
        $otherChargesGenerate,
        $lessPenaltiesGenerate,
        $shipmentNumberArray,
        $companyName
        ){

        $this->billingInvoiceNumberGenerate = $billingInvoiceNumberGenerate;
        $this->clientGenerate = $clientGenerate;
        $this->dropFeeGenerate = $dropFeeGenerate;
        $this->parkingFeeGenerate = $parkingFeeGenerate;
        $this->demurrageGenerate = $demurrageGenerate;
        $this->otherChargesGenerate = $otherChargesGenerate;
        $this->lessPenaltiesGenerate = $lessPenaltiesGenerate;
        $this->shipmentNumberArray = $shipmentNumberArray;
        $this->companyName = $companyName;
    }

    public function generateInvoiceRecord(){

        $this->generateInvoiceSubmit();

        for($i = 0; $i < count($this->shipmentNumberArray); $i++){
            
            $this->billedShipmentSubmit($this->shipmentNumberArray[$i]);
            
        }
    }

    public function generateInvoiceSubmit(){

        $sql = "INSERT INTO 
                billing(
                billingInvoiceNumber, 
                client, 
                dropFee,
                parkingFee,
                demurrage,
                otherCharges,
                lessPenalties,
                billingStatus,
                companyName
                ) 
                VALUES( 
                :billingInvoiceNumber, 
                :client, 
                :dropFee,
                :parkingFee,
                :demurrage,
                :otherCharges,
                :lessPenalties,
                :billingStatus,
                :companyName
                )";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":billingInvoiceNumber", $paramBillingInvoiceNumberGenerate, PDO::PARAM_STR);
            $stmt->bindParam(":client", $paramClientGenerate, PDO::PARAM_STR);
            $stmt->bindParam(":dropFee", $paramDropFeeGenerate, PDO::PARAM_STR);
            $stmt->bindParam(":parkingFee", $paramParkingFeeGenerate, PDO::PARAM_STR);
            $stmt->bindParam(":demurrage", $paramDemurrageGenerate, PDO::PARAM_STR);
            $stmt->bindParam(":otherCharges", $paramOtherChargesGenerate, PDO::PARAM_STR);
            $stmt->bindParam(":lessPenalties", $paramLessPenaltiesGenerate, PDO::PARAM_STR);
            $stmt->bindParam(":billingStatus", $paramBillingStatusGenerate, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramBillingInvoiceNumberGenerate = $this->billingInvoiceNumberGenerate;
            $paramClientGenerate = $this->clientGenerate;
            $paramDropFeeGenerate = $this->dropFeeGenerate;
            $paramParkingFeeGenerate = $this->parkingFeeGenerate;
            $paramDemurrageGenerate = $this->demurrageGenerate;
            $paramOtherChargesGenerate = $this->otherChargesGenerate;
            $paramLessPenaltiesGenerate = $this->lessPenaltiesGenerate;
            $paramBillingStatusGenerate = 'Unpaid';
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