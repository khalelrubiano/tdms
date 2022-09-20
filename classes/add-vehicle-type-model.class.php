
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class AddVehicleModel
{
    private $typeAdd2;
    private $groupIdAdd;

    public function __construct(
        $typeAdd2,
        $companyId
    ) {

        $this->typeAdd2 = $typeAdd2;
        $this->companyId = $companyId;
    }

    public function addVehicleRecord()
    {
/*
        if ($this->usernameValidator() == false) {
            echo "The username you entered is already taken!";
            exit();
        }
*/
        $this->addVehicleSubmit();
    }

    private function addVehicleSubmit()
    {

        $sql = "INSERT INTO 
        vehicletype 
        (vehicle_type, 
        company_id) 
        VALUES 
        (:vehicle_type, 
        :company_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":vehicle_type", $param1, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $param2, PDO::PARAM_STR);

            $param1 = $this->typeAdd2;
            $param2 = $this->companyId;

            if ($stmt->execute()) {
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                echo "Successfully added vehicle type!";
            } else {
/*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
                echo "Something went wrong, registration was not successful!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function addSubcontractorGroupSubmit()
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

            $stmt->bindParam(":group_name", $paramGroupNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":owner_id", $paramGroupOwnerAdd, PDO::PARAM_STR);

            $paramGroupNameAdd = $this->groupNameAdd;
            $paramGroupOwnerAdd = $this->groupOwnerAdd;

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

            $stmt->bindParam(":username", $paramUsernameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);
            

            $paramUsernameAdd = $this->usernameAdd;
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

            $stmt->bindParam(":username", $paramUsernameAdd, PDO::PARAM_STR);


            $paramUsernameAdd = $this->usernameAdd;


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
