
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

    private function editSubcontractorGroupSubmit()
    {

        $sql = "INSERT INTO 
        ownergroup 
        (group_name, 
        owner_id) 
        VALUES 
        (:group_name, 
        :owner_id) ";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":group_name", $paramGroupNameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":owner_id", $paramGroupOwnerEdit, PDO::PARAM_STR);

            $paramGroupNameEdit = $this->groupNameEdit;
            $paramGroupOwnerEdit = $this->groupOwnerEdit;

            if ($stmt->execute()) {
                echo "Successfully created a group!";
            } else {
                echo "Something went wrong, group creation was not successful!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

   
    public function getSubcontractorId()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT * FROM subcontractor WHERE username = :username AND company_id = :company_id";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":username", $paramUsernameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);
            

            $paramUsernameEdit = $this->usernameEdit;
            $paramCompanyId = $this->companyId;

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
