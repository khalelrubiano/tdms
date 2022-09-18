
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class EditPayslipModel
{
    private $billingId;
    private $ownerId;
    private $plateNumber;

    public function __construct(
        $billingId,
        $ownerId,
        $plateNumber
    ) {
        $this->billingId = $billingId;
        $this->ownerId = $ownerId;
        $this->plateNumber = $plateNumber;
    }

    public function editPayslipRecord()
    {
        /*
        if ($this->usernameValidator() == false) {
            echo "The username you entered is already taken!";
            exit();
        }
*/
        $this->getBilledShipment();
    }

    private function editSubmit($shipmentIdVar)
    {
        $sql = "UPDATE
        payroll 
        SET
        payroll_status = 'Settled'
        WHERE
        shipment_id = :shipment_id";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":shipment_id", $param1, PDO::PARAM_STR);

            $param1 = $shipmentIdVar;

            if ($stmt->execute()) {
                //$this->getBilledShipment();
                //$this->editDateSubmit();
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                //echo "Payslip status was updated!";
            } else {
                /*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
                echo "Something went wrong, update was not successful!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function editDateSubmit($payrollIdVar)
    {

        $sql = "INSERT INTO 
        payrolldate 
        (payroll_id) 
        VALUES 
        (:payroll_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":payroll_id", $param1, PDO::PARAM_STR);

            $param1 = $payrollIdVar;
            if ($stmt->execute()) {
                //echo "Successfully created a group!";
            } else {
                //echo "Something went wrong, group creation was not successful!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function editPayrollSubmit($shipmentIdVar)
    {

        $sql = "INSERT INTO 
        payroll 
        (payroll_status, 
        shipment_id) 
        VALUES 
        ('Unsettled', 
        :shipment_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":shipment_id", $param1, PDO::PARAM_STR);

            $param1 = $shipmentIdVar;

            if ($stmt->execute()) {
                //echo "Successfully created a group!";
            } else {
                //echo "Something went wrong, group creation was not successful!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }


    public function getBilledShipment()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT shipment.shipment_id, payroll.payroll_id
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
        AND ownergroup.owner_id = :owner_id
        AND vehicle.plate_number = :plate_number";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":billing_id", $param1, PDO::PARAM_STR);
            $stmt->bindParam(":owner_id", $param2, PDO::PARAM_STR);
            $stmt->bindParam(":plate_number", $param3, PDO::PARAM_STR);

            $param1 = $this->billingId;
            $param2 = $this->ownerId;
            $param3 = $this->plateNumber;

            if ($stmt->execute()) {
                $row = $stmt->fetchAll();

                for ($i = 0; $i < count($row); $i++) {
                    $this->editSubmit($row[$i][0]);
                    $this->editDateSubmit($row[$i][1]);
                }
                echo "Payslip status was updated!";
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

    public function usernameValidator()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT * FROM employee WHERE username = :username";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":username", $paramUsernameEdit, PDO::PARAM_STR);


            $paramUsernameEdit = $this->usernameEdit;


            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $result = false;
                } else {
                    $result = true;
                }
            } else {
            }

            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }
}
