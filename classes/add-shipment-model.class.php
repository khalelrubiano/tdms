<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";

class AddShipmentModel{
    private $shipmentNumberAdd;
    private $shipmentStatusAdd;
    private $startingPointAdd;
    private $destinationAdd;
    private $areaRateAdd;
    private $callTimeAdd;
    private $dateOfDeliveryAdd;
    private $companyName;
    private $vehiclePlateNumberAdd;

    public function __construct(
        $shipmentNumberAdd, 
        $shipmentStatusAdd, 
        $startingPointAdd, 
        $destinationAdd,
        $areaRateAdd,
        $callTimeAdd,
        $dateOfDeliveryAdd,
        $companyName,
        $vehiclePlateNumberAdd
        ){

        $this->shipmentNumberAdd = $shipmentNumberAdd;
        $this->shipmentStatusAdd = $shipmentStatusAdd;
        $this->startingPointAdd = $startingPointAdd;
        $this->destinationAdd = $destinationAdd;
        $this->areaRateAdd = $areaRateAdd;
        $this->callTimeAdd = $callTimeAdd;
        $this->dateOfDeliveryAdd = $dateOfDeliveryAdd;
        $this->companyName = $companyName;
        $this->vehiclePlateNumberAdd = $vehiclePlateNumberAdd;

    }

    public function addShipmentRecord(){

        if($this->emptyValidator() == false || $this->lengthValidator() == false || $this->patternValidator() == false ){
            session_start();
            $_SESSION['prompt'] = "The information you entered are not valid!";
            header('location: ../modal-prompt.php');
            exit();
        }

        if($this->shipmentNumberValidator() == false){
            
            $_SESSION['prompt'] = "A record with the same shipment number exists in the system! A different company might be using the same shipment number.";
            header('location: ../modal-prompt.php');
            exit();
        }

        if($this->vehiclePlateNumberValidator() == false){
            
            $_SESSION['prompt'] = "The vehicle plate number you entered is not registered in the system!";
            header('location: ../modal-prompt.php');
            exit();
        }

        $this->addShipmentSubmit();
        
    }

    public function addShipmentSubmit(){

        $sql = "INSERT INTO 
                shipment(
                shipmentNumber, 
                shipmentStatus, 
                startingPoint,
                destination,
                areaRate,
                callTime,
                dateOfDelivery,
                companyName,
                vehiclePlateNumber
                ) 
                VALUES( 
                :shipmentNumber, 
                :shipmentStatus, 
                :startingPoint,
                :destination,
                :areaRate,
                :callTime,
                :dateOfDelivery,
                :companyName,
                :vehiclePlateNumber
                )";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":shipmentNumber", $paramShipmentNumberAdd, PDO::PARAM_STR);
            $stmt->bindParam(":shipmentStatus", $paramShipmentStatusAdd, PDO::PARAM_STR);
            $stmt->bindParam(":startingPoint", $paramDestinationAdd, PDO::PARAM_STR);
            $stmt->bindParam(":destination", $paramStartingPointAdd, PDO::PARAM_STR);
            $stmt->bindParam(":areaRate", $paramAreaRateAdd, PDO::PARAM_STR);
            $stmt->bindParam(":callTime", $paramCallTimeAdd, PDO::PARAM_STR);
            $stmt->bindParam(":dateOfDelivery", $paramDateOfDeliveryAdd, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            $stmt->bindParam(":vehiclePlateNumber", $paramVehiclePlateNumberAdd, PDO::PARAM_STR);
            
            $paramShipmentNumberAdd = $this->shipmentNumberAdd;
            $paramShipmentStatusAdd = $this->shipmentStatusAdd;
            $paramStartingPointAdd = $this->startingPointAdd;
            $paramDestinationAdd = $this->destinationAdd;
            $paramAreaRateAdd = $this->areaRateAdd;
            $paramCallTimeAdd = $this->callTimeAdd;
            $paramDateOfDeliveryAdd = $this->dateOfDeliveryAdd;
            $paramCompanyName = $this->companyName;
            $paramVehiclePlateNumberAdd = $this->vehiclePlateNumberAdd;

            if($stmt->execute()){
                echo "Successfully added a record!";
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
            empty(trim($this->shipmentNumberAdd)) || 
            empty(trim($this->shipmentStatusAdd)) || 
            empty(trim($this->startingPointAdd)) || 
            empty(trim($this->destinationAdd)) || 
            empty(trim($this->callTimeAdd)) || 
            empty(trim($this->dateOfDeliveryAdd)) || 
            empty(trim($this->vehiclePlateNumberAdd))
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
            strlen(trim($this->shipmentNumberAdd)) < 1 && strlen(trim($this->shipmentNumberAdd)) > 255 && 
            strlen(trim($this->startingPointAdd)) < 1 && strlen(trim($this->startingPointAdd)) > 255 && 
            strlen(trim($this->destinationAdd)) < 1 && strlen(trim($this->destinationAdd)) > 255 && 
            strlen(trim($this->vehiclePlateNumberAdd)) < 1 && strlen(trim($this->vehiclePlateNumberAdd)) > 255
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
            !preg_match('/^[0-9]+$/', trim($this->shipmentNumberAdd)) || 
            !preg_match('/^[a-zA-Z0-9\s]+$/', trim($this->startingPointAdd)) || 
            !preg_match('/^[a-zA-Z0-9\s]+$/', trim($this->destinationAdd)) || 
            !preg_match('/^[a-zA-Z0-9]+$/', trim($this->vehiclePlateNumberAdd)) 
            ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    public function shipmentNumberValidator(){
        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();
    
        $sql = "SELECT * FROM shipment WHERE shipmentNumber = :shipmentNumber AND companyName = :companyName";
            
        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":shipmentNumber", $paramShipmentNumber, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramShipmentNumber = $this->shipmentNumberAdd;
            $paramCompanyName = $this->companyName;
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $result = false;
                }
                else{
                    $result = true;
                }
    
            } else{
                session_start();
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }
    
            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }

    public function vehiclePlateNumberValidator(){
        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();
    
        $sql = "SELECT * FROM vehicle WHERE vehiclePlateNumber = :vehiclePlateNumber AND companyName = :companyName";
            
        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":vehiclePlateNumber", $paramVehiclePlateNumber, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);

            
            $paramVehiclePlateNumber = $this->vehiclePlateNumberAdd;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $result = true;
                }
                else{
                    $result = false;
                }
    
            } else{
                session_start();
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