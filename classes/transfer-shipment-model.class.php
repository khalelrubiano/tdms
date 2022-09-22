<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

class TransferShipmentModel
{
    private $shipmentId;
    private $shipmentNumber;
    private $vehicleId;
    private $vehicleIdOld;
    private $companyId;
    private $transferReason;

    public function __construct(
        $shipmentId,
        $shipmentNumber,
        $vehicleId,
        $vehicleIdOld,
        $companyId,
        $transferReason
    ) {

        $this->shipmentId = $shipmentId;
        $this->shipmentNumber = $shipmentNumber;
        $this->vehicleId = $vehicleId;
        $this->vehicleIdOld = $vehicleIdOld;
        $this->companyId = $companyId;
        $this->transferReason = $transferReason;
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
        $vehicleId1 = $this->vehicleId;
        $vehicleId2 = $this->vehicleIdOld;

        $this->transferShipmentSubmit1();
        $this->transferShipmentSubmit2();
        $this->transferShipmentSubmit3();
        $this->addShipmentProgressSubmit();
        $this->editVehicleSubmit("On-Delivery", $vehicleId1);
        //echo $vehicleId2 . "sample" . $vehicleId1;
        $this->editVehicleSubmit("Available", $vehicleId2);
    }

    public function getVehicleInfoNew()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT 
        plate_number, 
        commission_rate, 
        driver_id,
        helper_id
        FROM vehicle WHERE plate_number = :plate_number";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":plate_number", $paramVehicleId, PDO::PARAM_STR);

            $paramVehicleId = $this->vehicleId;

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

    public function getShipmentInfo()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT 
        *
        FROM shipment
        WHERE shipment_id = :shipment_id";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":shipment_id", $param1, PDO::PARAM_STR);

            $param1 = $this->shipmentId;

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
            $paramCancelReason = "Transferred: " . $this->transferReason;


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
        $array1 = $this->getShipmentInfo();
        $array2 = $this->getVehicleInfoNew();

        $sql = "INSERT INTO 
                shipment(
                shipment_number, 
                shipment_status, 
                shipment_description,
                date_of_delivery, 
                call_time, 
                client_id, 
                area_name, 
                destination, 
                area_rate, 
                vehicle_type, 
                plate_number, 
                commission_rate, 
                driver_id, 
                helper_id,
                company_id
                ) 
                VALUES( 
                :shipment_number, 
                :shipment_status, 
                :shipment_description,
                :date_of_delivery, 
                :call_time, 
                :client_id, 
                :area_name, 
                :destination, 
                :area_rate, 
                :vehicle_type, 
                :plate_number, 
                :commission_rate, 
                :driver_id, 
                :helper_id,
                :company_id
                )";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":shipment_number", $param1, PDO::PARAM_STR);
            $stmt->bindParam(":shipment_status", $param2, PDO::PARAM_STR);
            $stmt->bindParam(":shipment_description", $param3, PDO::PARAM_STR);
            $stmt->bindParam(":date_of_delivery", $param4, PDO::PARAM_STR);
            $stmt->bindParam(":call_time", $param5, PDO::PARAM_STR);
            $stmt->bindParam(":client_id", $param6, PDO::PARAM_STR);
            $stmt->bindParam(":area_name", $param7, PDO::PARAM_STR);
            $stmt->bindParam(":destination", $param8, PDO::PARAM_STR);
            $stmt->bindParam(":area_rate", $param9, PDO::PARAM_STR);
            $stmt->bindParam(":vehicle_type", $param10, PDO::PARAM_STR);
            $stmt->bindParam(":plate_number", $param11, PDO::PARAM_STR);
            $stmt->bindParam(":commission_rate", $param12, PDO::PARAM_STR);
            $stmt->bindParam(":driver_id", $param13, PDO::PARAM_STR);
            $stmt->bindParam(":helper_id", $param14, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $param15, PDO::PARAM_STR);

            $param1 = $array1[0][1];
            $param2 = "In-progress";
            $param3 = $array1[0][3];
            $param4 = $array1[0][4];
            $param5 = $array1[0][5];
            $param6 = $array1[0][7];
            $param7 = $array1[0][8];
            $param8 = $array1[0][9];
            $param9 = $array1[0][10];
            $param10 = $array1[0][11];
            $param11 = $array2[0][0];
            $param12 = $array2[0][1];
            $param13 = $array2[0][2];
            $param14 = $array2[0][3];
            $param15 = $this->companyId;

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

        $sql = "SELECT shipment_id FROM shipment WHERE shipment_number = :shipment_number AND plate_number = :plate_number";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":shipment_number", $paramShipmentNumber, PDO::PARAM_STR);
            $stmt->bindParam(":plate_number", $paramVehicleId, PDO::PARAM_STR);

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

    private function editVehicleSubmit($statusVar, $vehicleIdVar)
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

            $paramVehicleStatusEdit = $statusVar;
            $paramVehicleIdEdit = $vehicleIdVar;

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
