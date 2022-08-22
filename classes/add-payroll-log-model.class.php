<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

class AddLogModel
{
    private $logDescription;
    private $userDescription;
    private $companyId;
    private $billingId;
    private $ownerId;

    public function __construct(
        $logDescription,
        $userDescription,
        $companyId,
        $billingId,
        $ownerId
    ) {

        $this->logDescription = $logDescription;
        $this->userDescription = $userDescription;
        $this->companyId = $companyId;
        $this->billingId = $billingId;
        $this->ownerId = $ownerId;
    }

    public function addLogRecord()
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
        $this->getBilledShipment();
        
    }

    public function addLogSubmit($var1, $var2)
    {

        $sql = "INSERT INTO 
                payrolllog(
                log_description, 
                user_description, 
                payroll_description,
                company_id
                ) 
                VALUES( 
                :log_description, 
                :user_description, 
                :payroll_description,
                :company_id
                )";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":log_description", $paramLogDescription, PDO::PARAM_STR);
            $stmt->bindParam(":user_description", $paramUserDescription, PDO::PARAM_STR);
            $stmt->bindParam(":payroll_description", $paramPayrollDescription, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

            $paramLogDescription = $this->logDescription;
            $paramUserDescription = $this->userDescription;
            $paramPayrollDescription = "Batch " . $var1 . " - Plate Number: " . $var2;
            $paramCompanyId = $this->companyId;

            if ($stmt->execute()) {
                //echo "Successfully added a record!";
            } else {

                //echo "Something went wrong, shipment was not successfully added!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    public function getBilledShipment()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT shipment.shipment_id, payroll.payroll_id, vehicle.plate_number, billing.billing_id
        FROM billing 
        INNER JOIN billedshipment
        ON billing.billing_id = billedshipment.billing_id
        INNER JOIN shipment
        ON billedshipment.shipment_id = shipment.shipment_id
        INNER JOIN vehicle
        ON shipment.vehicle_id = vehicle.vehicle_id
        INNER JOIN ownergroup
        ON vehicle.group_id = ownergroup.group_id
        INNER JOIN payroll
        ON shipment.shipment_id = payroll.shipment_id
        WHERE billing.billing_id = :billing_id
        AND ownergroup.owner_id = :owner_id";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":billing_id", $param1, PDO::PARAM_STR);
            $stmt->bindParam(":owner_id", $param2, PDO::PARAM_STR);

            $param1 = $this->billingId;
            $param2 = $this->ownerId;

            if ($stmt->execute()) {
                $row = $stmt->fetchAll();
                $this->addLogSubmit($row[0][3], $row[0][2]);
                /*
                for ($i = 0; $i < count($row); $i++) {
                    
                    //$this->editDateSubmit($row[$i][1]);
                }*/
                //echo $row[0][2];
            } else {
                session_start();
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
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

            $paramShipmentNumber = $this->shipmentNumberAdd;
            $paramVehicleId = $this->vehicleAdd;

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
