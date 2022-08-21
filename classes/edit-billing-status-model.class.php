
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class EditBillingModel
{
    private $billingId;


    public function __construct(
        $billingId
    ) {
        $this->billingId = $billingId;
    }

    public function editBillingRecord()
    {
/*
        if ($this->usernameValidator() == false) {
            echo "The username you entered is already taken!";
            exit();
        }
*/
        $this->editSubmit();
        
    }

    private function editSubmit()
    {
        $sql = "UPDATE
        billing 
        SET
        billing_status = 'Settled'
        WHERE
        billing_id = :billing_id";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":billing_id", $param1, PDO::PARAM_STR);

            $param1 = $this->billingId;

            if ($stmt->execute()) {
                $this->getBilledShipment();
                $this->editDateSubmit();
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                echo "Invoice status was updated!";
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

    private function editDateSubmit()
    {

        $sql = "INSERT INTO 
        billingdate 
        (billing_id) 
        VALUES 
        (:billing_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":billing_id", $param1, PDO::PARAM_STR);

            $param1 = $this->billingId;

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

        $sql = "SELECT shipment.shipment_id 
        FROM billing 
        INNER JOIN billedshipment
        ON billing.billing_id = billedshipment.billing_id
        INNER JOIN shipment
        ON billedshipment.shipment_id = shipment.shipment_id
        WHERE billing.billing_id = :billing_id";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":billing_id", $param1, PDO::PARAM_STR);

            $param1 = $this->billingId;

            if ($stmt->execute()) {
                $row = $stmt->fetchAll();

                for ($i = 0; $i < count($row); $i++) {
                    $this->editPayrollSubmit($row[$i][0]);
                }

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
