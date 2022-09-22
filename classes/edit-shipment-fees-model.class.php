<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

class AddShipmentProgressModel
{
    private $shipmentId;
    private $dropFeeAdd;
    private $parkingFeeAdd;
    private $demurrageAdd;
    private $otherChargesAdd;
    private $penaltyAdd;

    public function __construct(
        $shipmentId,
        $dropFeeAdd,
        $parkingFeeAdd,
        $demurrageAdd,
        $otherChargesAdd,
        $penaltyAdd
    ) {

        $this->shipmentId = $shipmentId;
        $this->dropFeeAdd = $dropFeeAdd;
        $this->parkingFeeAdd = $parkingFeeAdd;
        $this->demurrageAdd = $demurrageAdd;
        $this->otherChargesAdd = $otherChargesAdd;
        $this->penaltyAdd = $penaltyAdd;
    }

    public function addShipmentProgressRecord()
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

        $this->updateShipmentFeeSubmit();
    }
    /*
    public function getVehicleInfo()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT 
        plate_number, 
        commission_rate, 
        driver_id,
        helper_id
        FROM vehicle WHERE vehicle_id = :vehicle_id";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":vehicle_id", $paramVehicleId, PDO::PARAM_STR);

            $paramVehicleId = $this->vehicleAdd;

            if ($stmt->execute()) {
                $row = $stmt->fetchAll();
                $returnValue = $row;
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

    public function getClientInfo()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT 
        clientarea.area_name, 
        clientarea.destination, 
        clientarea.area_rate, 
        clientarea.vehicle_type
        FROM client 
        INNER JOIN clientarea 
        ON client.client_id = clientarea.client_id
        WHERE area_id = :area_id";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":area_id", $param1, PDO::PARAM_STR);

            $param1 = $this->destinationAdd;

            if ($stmt->execute()) {
                $row = $stmt->fetchAll();
                $returnValue = $row;
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
*/
    public function updateShipmentFeeSubmit()
    {

        $sql = "UPDATE shipmentfees
        SET 
        drop_fee = :drop_fee,
        parking_fee = :parking_fee,
        demurrage = :demurrage,
        other_charges = :other_charges,
        penalty = :penalty
        WHERE shipment_id = :shipment_id";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":shipment_id", $paramShipmentId, PDO::PARAM_STR);
            $stmt->bindParam(":drop_fee", $param2, PDO::PARAM_STR);
            $stmt->bindParam(":parking_fee", $param3, PDO::PARAM_STR);
            $stmt->bindParam(":demurrage", $param4, PDO::PARAM_STR);
            $stmt->bindParam(":other_charges", $param5, PDO::PARAM_STR);
            $stmt->bindParam(":penalty", $param6, PDO::PARAM_STR);

            $paramShipmentId = $this->shipmentId;
            $param2 = $this->dropFeeAdd;
            $param3 = $this->parkingFeeAdd;
            $param4 = $this->demurrageAdd;
            $param5 = $this->otherChargesAdd;
            $param6 = $this->penaltyAdd;


            if ($stmt->execute()) {
                //echo "Successfully added a record!";
            } else {

                //echo "Something went wrong, shipment was not successfully added!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    public function addShipmentFeesSubmit()
    {

        $sql = "INSERT INTO 
                shipmentfees(
                drop_fee,
                parking_fee,
                demurrage,
                other_charges,
                penalty,
                shipment_id
                ) 
                VALUES( 
                0,
                0,
                0,
                0,
                0,
                :shipment_id
                )";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":shipment_id", $paramShipmentId, PDO::PARAM_STR);

            $paramShipmentId = $this->shipmentId;

            if ($stmt->execute()) {
                echo "Successfully updated a record!";
            } else {

                echo "Something went wrong, shipment progress was not successfully updated!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
    /*
    public function getShipmentId()
    {
        $array3 = $this->getVehicleInfo();

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT shipment_id FROM shipment WHERE shipment_number = :shipment_number AND plate_number = :plate_number";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":shipment_number", $paramShipmentNumber, PDO::PARAM_STR);
            $stmt->bindParam(":plate_number", $paramVehicleId, PDO::PARAM_STR);

            $paramShipmentNumber = $this->shipmentNumberAdd;
            $paramVehicleId = $array3[0][0];

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
*/
    private function editVehicleSubmit()
    {
        $sql = "UPDATE
        vehicle 
        SET
        vehicle_status = :vehicle_status
        WHERE
        plate_number = :plate_number";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":vehicle_status", $paramVehicleStatusEdit, PDO::PARAM_STR);
            $stmt->bindParam(":plate_number", $paramVehicleIdEdit, PDO::PARAM_STR);

            $paramVehicleStatusEdit = "Available";
            $paramVehicleIdEdit = $this->vehicleId;

            if ($stmt->execute()) {
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                //echo "Successfully edited a record!";
            } else {
                /*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
                //echo "Something went wrong, edit was not successful!";
            }


            unset($stmt);
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
