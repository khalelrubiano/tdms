
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class AddModel
{
    private $trackerId;
    private $vehicleId;


    public function __construct(
        $trackerId,
        $vehicleId
    ) {

        $this->trackerId = $trackerId;
        $this->vehicleId = $vehicleId;

    }

    public function addRecord()
    {
/*
        if ($this->usernameValidator() == false) {
            echo "The username you entered is already taken!";
            exit();
        }
*/
        $this->addSubmit();
    }

    private function addSubmit()
    {

        $sql = "INSERT INTO tracking 
        (tracking_number,
        vehicle_id) 
        VALUES 
        (:tracking_number,
        :vehicle_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":tracking_number", $param1, PDO::PARAM_STR);
            $stmt->bindParam(":vehicle_id", $param2, PDO::PARAM_STR);


            $param1 = $this->trackerId;
            $param2 = $this->vehicleId;


            if ($stmt->execute()) {
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                echo "Successfully added tracker!";
            } else {
/*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
                echo "Something went wrong, tracker registration was not successful!";
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

            $stmt->bindParam(":user_name", $paramUsernameAdd, PDO::PARAM_STR);


            $paramUsernameAdd = $this->usernameAdd;


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
