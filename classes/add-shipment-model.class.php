<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

class AddShipmentModel
{
    private $shipmentNumberAdd;
    private $shipmentDescriptionAdd;
    private $dateOfDeliveryAdd;
    private $callTimeAdd;
    private $clientAdd;
    private $destinationAdd;
    private $vehicleAdd;
    private $companyId;


    public function __construct(
        $shipmentNumberAdd,
        $shipmentDescriptionAdd,
        $dateOfDeliveryAdd,
        $callTimeAdd,
        $clientAdd,
        $destinationAdd,
        $vehicleAdd,
        $companyId
    ) {

        $this->shipmentNumberAdd = $shipmentNumberAdd;
        $this->shipmentDescriptionAdd = $shipmentDescriptionAdd;
        $this->dateOfDeliveryAdd = $dateOfDeliveryAdd;
        $this->callTimeAdd = $callTimeAdd;
        $this->clientAdd = $clientAdd;
        $this->destinationAdd = $destinationAdd;
        $this->vehicleAdd = $vehicleAdd;
        $this->companyId = $companyId;
    }

    public function addShipmentRecord()
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
        $this->addShipmentSubmit();
        $this->addShipmentProgressSubmit();
        $this->editVehicleSubmit();
        //echo $this->getShipmentId();
        
    }

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

    public function addShipmentSubmit()
    {

        $array1 = $this->getVehicleInfo();
        $array2 = $this->getClientInfo();

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

            $param1 = $this->shipmentNumberAdd;
            $param2 = "In-progress";
            $param3 = $this->shipmentDescriptionAdd;
            $param4 = $this->dateOfDeliveryAdd;
            $param5 = $this->callTimeAdd;
            $param6 = $this->clientAdd;
            $param7 = $array2[0][0];
            $param8 = $array2[0][1];
            $param9 = $array2[0][2];
            $param10 = $array2[0][3];
            $param11 = $array1[0][0];
            $param12 = $array1[0][1];
            $param13 = $array1[0][2];
            $param14 = $array1[0][3];
            $param15 = $this->companyId;

            if ($stmt->execute()) {
                echo "Successfully added a record!";
            } else {

                echo "Something went wrong, shipment was not successfully added!";
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

    private function editVehicleSubmit()
    {
        $sql = "UPDATE
        vehicle 
        SET
        vehicle_status = :vehicle_status
        WHERE
        vehicle_id = :vehicle_id";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":vehicle_status", $paramVehicleStatusEdit, PDO::PARAM_STR);
            $stmt->bindParam(":vehicle_id", $paramVehicleIdEdit, PDO::PARAM_STR);

            $paramVehicleStatusEdit = "On-Delivery";
            $paramVehicleIdEdit = $this->vehicleAdd;

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
