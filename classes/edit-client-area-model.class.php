
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class EditClientAreaModel
{
    private $areaRateEdit;
    private $areaId;

    public function __construct(
        $areaRateEdit,
        $areaId
    ) {

        $this->areaRateEdit = $areaRateEdit;
        $this->areaId = $areaId;
    }

    public function editClientAreaRecord()
    {
/*
        if ($this->usernameValidator() == false) {
            echo "The username you entered is already taken!";
            exit();
        }
*/
        $this->editClientAreaSubmit();
    }

    private function editClientAreaSubmit()
    {

        $sql = "UPDATE clientarea
        SET 
        area_rate = :area_rate
        WHERE area_id = :area_id";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":area_rate", $paramAreaRateEdit, PDO::PARAM_STR);
            $stmt->bindParam(":area_id", $paramAreaId, PDO::PARAM_STR);

            $paramAreaRateEdit = $this->areaRateEdit;
            $paramAreaId = $this->areaId;

            if ($stmt->execute()) {
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                //echo $paramRoleNameEdit . $paramShipmentAccessEdit . $paramEmployeeAccessEdit . $paramSubcontractorAccessEdit . $paramClientAccessEdit . $paramBillingAccessEdit . $paramPayrollAccessEdit . $paramPermissionIdEdit . $paramCompanyId;
                echo "Successfully edited an area!";
            } else {
/*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
                echo "Something went wrong, area edit was not successful!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

   /*
    public function getPermissionId()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT * FROM permission WHERE role_name = :role_name AND company_id = :company_id";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);
            $stmt->bindParam(":role_name", $paramRoleName, PDO::PARAM_STR);

            $paramCompanyId = $this->companyId;
            $paramRoleName = "Default";

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
    }*/
/*
    public function usernameValidator()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT * FROM user WHERE user_name = :user_name";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":user_name", $paramUsernameEdit, PDO::PARAM_STR);


            $paramUsernameEdit = $this->usernameEdit;


            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $result = false;
                } else {
                    $result = true;
                }
            } else {

                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }

            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }*/
}
