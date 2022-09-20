
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class EditVehicleModel
{
    private $vehicleStatusEdit;
    private $vehicleIdEdit;
    private $reason;


    public function __construct(
        $vehicleStatusEdit,
        $vehicleIdEdit,
        $reason
    ) {

        $this->vehicleStatusEdit = $vehicleStatusEdit;
        $this->vehicleIdEdit = $vehicleIdEdit;
        $this->reason = $reason;
    }

    public function editVehicleRecord()
    {
/*
        if ($this->usernameValidator() == false) {
            echo "The username you entered is already taken!";
            exit();
        }
*/
        $this->editVehicleSubmit();
    }

    private function editVehicleSubmit()
    {
        $sql = "UPDATE
        vehicle 
        SET
        vehicle_status = :vehicle_status,
        status_remark = :status_remark
        WHERE
        vehicle_id = :vehicle_id";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":vehicle_status", $paramVehicleStatusEdit, PDO::PARAM_STR);
            $stmt->bindParam(":vehicle_id", $paramVehicleIdEdit, PDO::PARAM_STR);
            $stmt->bindParam(":status_remark", $param3, PDO::PARAM_STR);

            $paramVehicleStatusEdit = $this->vehicleStatusEdit;
            $paramVehicleIdEdit = $this->vehicleIdEdit;
            $param3 = $this->reason;

            if ($stmt->execute()) {
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                echo "Successfully edited a record!";
            } else {
/*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
                echo "Something went wrong, edit was not successful!";
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
