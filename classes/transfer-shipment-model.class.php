<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

class TransferShipmentModel
{
    private $shipmentId;
    private $shipmentNumber;
    private $shipmentDescription;
    private $destination;
    private $dateOfDelivery;
    private $areaId;
    private $vehicleId;



    public function __construct(
        $shipmentId,
        $shipmentNumber,
        $shipmentDescription,
        $destination,
        $dateOfDelivery,
        $areaId,
        $vehicleId
    ) {

        $this->shipmentId = $shipmentId;
        $this->shipmentNumber = $shipmentNumber;
        $this->shipmentDescription = $shipmentDescription;
        $this->destination = $destination;
        $this->dateOfDelivery = $dateOfDelivery;
        $this->areaId = $areaId;
        $this->vehicleId = $vehicleId;
    }

    public function transferShipmentRecord()
    {
        /*
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
*/
        $this->transferShipmentSubmit1();
        $this->transferShipmentSubmit2();
        $this->transferShipmentSubmit3();
        $this->addShipmentProgressSubmit();
    }

    public function transferShipmentSubmit1()
    {

        $sql = "UPDATE shipment
        SET 
        shipment_status = :shipment_status
        WHERE shipment_id = :shipment_id";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":shipment_id", $paramShipmentId, PDO::PARAM_STR);
            $stmt->bindParam(":shipment_status", $paramShipmentStatus, PDO::PARAM_STR);

            $paramShipmentId = $this->shipmentId;
            $paramShipmentStatus = "Cancelled";


            if ($stmt->execute()) {
                //echo "Successfully added a record!";
            } else {

                //echo "Something went wrong, shipment was not successfully added!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }


    public function transferShipmentSubmit2()
    {

        $sql = "INSERT INTO 
                shipmentprogress(
                progress_description, 
                shipment_id
                ) 
                VALUES( 
                :progress_description, 
                :shipment_id
                )";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":shipment_id", $paramShipmentId, PDO::PARAM_STR);
            $stmt->bindParam(":progress_description", $paramCancelReason, PDO::PARAM_STR);


            $paramShipmentId = $this->shipmentId;
            $paramCancelReason = "Transferred";


            if ($stmt->execute()) {
                //echo "Successfully added a record!";
            } else {

                //echo "Something went wrong, shipment was not successfully added!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    public function transferShipmentSubmit3()
    {

        $sql = "INSERT INTO 
                shipment(
                shipment_number, 
                shipment_status, 
                shipment_description,
                destination,
                date_of_delivery,
                area_id,
                vehicle_id
                ) 
                VALUES( 
                :shipment_number, 
                :shipment_status, 
                :shipment_description,
                :destination,
                :date_of_delivery,
                :area_id,
                :vehicle_id
                )";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":shipment_number", $paramShipmentNumberAdd, PDO::PARAM_STR);
            $stmt->bindParam(":shipment_status", $paramShipmentStatusAdd, PDO::PARAM_STR);
            $stmt->bindParam(":shipment_description", $paramShipmentDescriptionAdd, PDO::PARAM_STR);
            $stmt->bindParam(":destination", $paramDestinationAdd, PDO::PARAM_STR);
            $stmt->bindParam(":date_of_delivery", $paramDateOfDeliveryAdd, PDO::PARAM_STR);
            $stmt->bindParam(":area_id", $paramAreaIdAdd, PDO::PARAM_STR);
            $stmt->bindParam(":vehicle_id", $paramVehicleIdAdd, PDO::PARAM_STR);

            $paramShipmentNumberAdd = $this->shipmentNumber;
            $paramShipmentStatusAdd = "In-progress";
            $paramShipmentDescriptionAdd = $this->shipmentDescription;
            $paramDestinationAdd = $this->destination;
            $paramDateOfDeliveryAdd = $this->dateOfDelivery;
            $paramAreaIdAdd = $this->areaId;
            $paramVehicleIdAdd = $this->vehicleId;

            if ($stmt->execute()) {
                echo "Successfully transferred a record!";
            } else {

                echo "Something went wrong, shipment was not successfully transferred!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    public function addShipmentProgressSubmit()
    {

        $sql = "INSERT INTO 
                shipmentprogress(
                progress_description,
                shipment_id
                ) 
                VALUES( 
                :progress_description,
                :shipment_id
                )";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":progress_description", $paramProgressDescription, PDO::PARAM_STR);
            $stmt->bindParam(":shipment_id", $paramShipmentId, PDO::PARAM_STR);

            $paramProgressDescription = "Shipment Placed";
            $paramShipmentId = $this->getShipmentId();

            if ($stmt->execute()) {
                echo "Successfully added a record!";
            } else {

                echo "Something went wrong, shipment was not successfully added!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    public function getShipmentId()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT shipment_id FROM shipment WHERE shipment_number = :shipment_number AND vehicle_id = :vehicle_id";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":shipment_number", $paramShipmentNumber, PDO::PARAM_STR);
            $stmt->bindParam(":vehicle_id", $paramVehicleId, PDO::PARAM_STR);

            $paramShipmentNumber = $this->shipmentNumber;
            $paramVehicleId = $this->vehicleId;

            if ($stmt->execute()) {
                $row = $stmt->fetchAll();
                $returnValue = $row[0][0];
            } else {
                session_start();
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }

            unset($stmt);

            return $returnValue;
        }
        unset($pdoVessel);
    }

    private function emptyValidator()
    {
        if (
            empty(trim($this->shipmentNumberAdd)) ||
            empty(trim($this->shipmentStatusAdd)) ||
            empty(trim($this->startingPointAdd)) ||
            empty(trim($this->destinationAdd)) ||
            empty(trim($this->callTimeAdd)) ||
            empty(trim($this->dateOfDeliveryAdd)) ||
            empty(trim($this->vehiclePlateNumberAdd))
        ) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function lengthValidator()
    {
        if (
            strlen(trim($this->shipmentNumberAdd)) < 1 && strlen(trim($this->shipmentNumberAdd)) > 255 &&
            strlen(trim($this->startingPointAdd)) < 1 && strlen(trim($this->startingPointAdd)) > 255 &&
            strlen(trim($this->destinationAdd)) < 1 && strlen(trim($this->destinationAdd)) > 255 &&
            strlen(trim($this->vehiclePlateNumberAdd)) < 1 && strlen(trim($this->vehiclePlateNumberAdd)) > 255
        ) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function patternValidator()
    {
        if (
            !preg_match('/^[0-9]+$/', trim($this->shipmentNumberAdd)) ||
            !preg_match('/^[a-zA-Z0-9\s]+$/', trim($this->startingPointAdd)) ||
            !preg_match('/^[a-zA-Z0-9\s]+$/', trim($this->destinationAdd)) ||
            !preg_match('/^[a-zA-Z0-9]+$/', trim($this->vehiclePlateNumberAdd))
        ) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function shipmentNumberValidator()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT * FROM shipment WHERE shipmentNumber = :shipmentNumber AND companyName = :companyName";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":shipmentNumber", $paramShipmentNumber, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);

            $paramShipmentNumber = $this->shipmentNumberAdd;
            $paramCompanyName = $this->companyName;

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $result = false;
                } else {
                    $result = true;
                }
            } else {
                session_start();
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }

            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }

    public function vehiclePlateNumberValidator()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT * FROM vehicle WHERE vehiclePlateNumber = :vehiclePlateNumber AND companyName = :companyName";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":vehiclePlateNumber", $paramVehiclePlateNumber, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);


            $paramVehiclePlateNumber = $this->vehiclePlateNumberAdd;
            $paramCompanyName = $this->companyName;

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $result = true;
                } else {
                    $result = false;
                }
            } else {
                session_start();
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }

            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }
}
