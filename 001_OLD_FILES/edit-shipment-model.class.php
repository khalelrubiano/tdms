<?php

if ( !isset($_SESSION) ) {
    session_start();
}

require_once "../config.php";

class EditShipmentModel{
    private $shipmentNumberEdit;
    private $shipmentStatusEdit;
    private $startingPointEdit;
    private $destinationEdit;
    private $areaRateEdit;
    private $callTimeEdit;
    private $dateOfDeliveryEdit;
    private $companyName;
    private $vehiclePlateNumberEdit;

    public function __construct(
        $shipmentNumberEdit, 
        $shipmentStatusEdit, 
        $startingPointEdit, 
        $destinationEdit,
        $areaRateEdit,
        $callTimeEdit,
        $dateOfDeliveryEdit,
        $companyName,
        $vehiclePlateNumberEdit
        ){

        $this->shipmentNumberEdit = $shipmentNumberEdit;
        $this->shipmentStatusEdit = $shipmentStatusEdit;
        $this->startingPointEdit = $startingPointEdit;
        $this->destinationEdit = $destinationEdit;
        $this->areaRateEdit = $areaRateEdit;
        $this->callTimeEdit = $callTimeEdit;
        $this->dateOfDeliveryEdit = $dateOfDeliveryEdit;
        $this->companyName = $companyName;
        $this->vehiclePlateNumberEdit = $vehiclePlateNumberEdit;

    }

    public function editShipmentRecord(){

        if($this->emptyValidator() == false || $this->lengthValidator() == false || $this->patternValidator() == false ){
            
            $_SESSION['prompt'] = "The information you entered are not valid!";
            header('location: ../modal-prompt.php');
            exit();
        }


        if($this->vehiclePlateNumberValidator() == false){
            
            $_SESSION['prompt'] = "The vehicle plate number you entered is not registered in the system!";
            header('location: ../modal-prompt.php');
            exit();
        }

        $this->editShipmentSubmit();
        
    }

    public function editShipmentSubmit(){

        $sql = "UPDATE 
        shipment 
        SET
        shipmentStatus = :shipmentStatus,
        startingPoint = :startingPoint,
        destination = :destination,
        areaRate = :areaRate,
        callTime = :callTime, 
        dateOfDelivery = :dateOfDelivery, 
        vehiclePlateNumber = :vehiclePlateNumber 
        WHERE 
        shipmentNumber = :shipmentNumber and companyName = :companyName";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":shipmentNumber", $paramShipmentNumberEdit, PDO::PARAM_STR);
            $stmt->bindParam(":shipmentStatus", $paramShipmentStatusEdit, PDO::PARAM_STR);
            $stmt->bindParam(":startingPoint", $paramDestinationEdit, PDO::PARAM_STR);
            $stmt->bindParam(":destination", $paramStartingPointEdit, PDO::PARAM_STR);
            $stmt->bindParam(":areaRate", $paramAreaRateEdit, PDO::PARAM_STR);
            $stmt->bindParam(":callTime", $paramCallTimeEdit, PDO::PARAM_STR);
            $stmt->bindParam(":dateOfDelivery", $paramDateOfDeliveryEdit, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            $stmt->bindParam(":vehiclePlateNumber", $paramVehiclePlateNumberEdit, PDO::PARAM_STR);
            
            $paramShipmentNumberEdit = $this->shipmentNumberEdit;
            $paramShipmentStatusEdit = $this->shipmentStatusEdit;
            $paramStartingPointEdit = $this->startingPointEdit;
            $paramDestinationEdit = $this->destinationEdit;
            $paramAreaRateEdit = $this->areaRateEdit;
            $paramCallTimeEdit = $this->callTimeEdit;
            $paramDateOfDeliveryEdit = $this->dateOfDeliveryEdit;
            $paramCompanyName = $this->companyName;
            $paramVehiclePlateNumberEdit = $this->vehiclePlateNumberEdit;

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

    private function emptyValidator(){
        if(
            empty(trim($this->shipmentNumberEdit)) || 
            empty(trim($this->shipmentStatusEdit)) || 
            empty(trim($this->startingPointEdit)) || 
            empty(trim($this->destinationEdit)) || 
            empty(trim($this->callTimeEdit)) || 
            empty(trim($this->dateOfDeliveryEdit)) || 
            empty(trim($this->vehiclePlateNumberEdit))
            ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function lengthValidator(){
        if(
            strlen(trim($this->shipmentNumberEdit)) < 1 && strlen(trim($this->shipmentNumberEdit)) > 255 && 
            strlen(trim($this->startingPointEdit)) < 1 && strlen(trim($this->startingPointEdit)) > 255 && 
            strlen(trim($this->destinationEdit)) < 1 && strlen(trim($this->destinationEdit)) > 255 && 
            strlen(trim($this->vehiclePlateNumberEdit)) < 1 && strlen(trim($this->vehiclePlateNumberEdit)) > 255
            ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function patternValidator(){
        if(
            !preg_match('/^[0-9]+$/', trim($this->shipmentNumberEdit)) || 
            !preg_match('/^[a-zA-Z0-9\s]+$/', trim($this->startingPointEdit)) || 
            !preg_match('/^[a-zA-Z0-9\s]+$/', trim($this->destinationEdit)) || 
            !preg_match('/^[a-zA-Z0-9]+$/', trim($this->vehiclePlateNumberEdit)) 
            ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }


    public function vehiclePlateNumberValidator(){
        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();
    
        $sql = "SELECT * FROM vehicle WHERE vehiclePlateNumber = :vehiclePlateNumber AND companyName = :companyName";
            
        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":vehiclePlateNumber", $paramVehiclePlateNumber, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);

            
            $paramVehiclePlateNumber = $this->vehiclePlateNumberEdit;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $result = true;
                }
                else{
                    $result = false;
                }
    
            } else{
                
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }
    
            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }
}