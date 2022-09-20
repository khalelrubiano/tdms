
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class AddClientAreaModel
{
    private $areaNameAdd;
    private $areaRateAdd;
    private $clientId;
    private $destinationAdd;
    private $typeAdd;
    public function __construct(
        $areaNameAdd,
        $areaRateAdd,
        $clientId,
        $destinationAdd,
        $typeAdd,
    ) {

        $this->areaNameAdd = $areaNameAdd;
        $this->areaRateAdd = $areaRateAdd;
        $this->clientId = $clientId;
        $this->destinationAdd = $destinationAdd;
        $this->typeAdd = $typeAdd;
    }

    public function addClientAreaRecord()
    {
/*
        if ($this->usernameValidator() == false) {
            echo "The username you entered is already taken!";
            exit();
        }
*/
        $this->addClientAreaSubmit();
    }

    private function addClientAreaSubmit()
    {

        $sql = "INSERT INTO clientarea 
        (area_name,
        destination,
        vehicle_type,
        area_rate,
        client_id) 
        VALUES 
        (:area_name,
        :destination,
        :vehicle_type,
        :area_rate,
        :client_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":area_name", $paramAreaNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":area_rate", $paramAreaRateAdd, PDO::PARAM_STR);
            $stmt->bindParam(":client_id", $paramClientId, PDO::PARAM_STR);
            $stmt->bindParam(":destination", $param4, PDO::PARAM_STR);
            $stmt->bindParam(":vehicle_type", $param5, PDO::PARAM_STR);

            $paramAreaNameAdd = $this->areaNameAdd;
            $paramAreaRateAdd = $this->areaRateAdd;
            $paramClientId = $this->clientId;
            $param4 = $this->destinationAdd;
            $param5 = $this->typeAdd;

            if ($stmt->execute()) {
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                echo "Successfully registered an area!";
            } else {
/*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
                echo "Something went wrong, area registration was not successful!";
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
