
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class AddVehicleModel
{
    private $plateNumberAdd;
    private $commissionRateAdd;
    private $driverAdd;
    private $helperAdd;
    private $groupIdAdd;

    public function __construct(
        $plateNumberAdd,
        $commissionRateAdd,
        $driverAdd,
        $helperAdd,
        $groupIdAdd
    ) {

        $this->plateNumberAdd = $plateNumberAdd;
        $this->commissionRateAdd = $commissionRateAdd;
        $this->driverAdd = $driverAdd;
        $this->helperAdd = $helperAdd;
        $this->groupIdAdd = $groupIdAdd;
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
        vehicle 
        (plate_number, 
        commission_rate, 
        driver_id, 
        helper_id, 
        group_id,
        vehicle_status) 
        VALUES 
        (:plate_number, 
        :commission_rate, 
        :driver_id, 
        :helper_id, 
        :group_id,
        :vehicle_status)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":plate_number", $paramPlateNumberAdd, PDO::PARAM_STR);
            $stmt->bindParam(":commission_rate", $paramCommissionRateAdd, PDO::PARAM_STR);
            $stmt->bindParam(":driver_id", $paramDriverIdAdd, PDO::PARAM_STR);
            $stmt->bindParam(":helper_id", $paramHelperIdAdd, PDO::PARAM_STR);
            $stmt->bindParam(":group_id", $paramGroupIdAdd, PDO::PARAM_STR);
            $stmt->bindParam(":vehicle_status", $paramVehicleStatusAdd, PDO::PARAM_STR);

            $paramPlateNumberAdd = $this->plateNumberAdd;
            $paramCommissionRateAdd = $this->commissionRateAdd;
            $paramDriverIdAdd = $this->driverAdd;
            $paramHelperIdAdd = $this->helperAdd;
            $paramGroupIdAdd = $this->groupIdAdd;
            $paramVehicleStatusAdd = "Unavailable";

            if ($stmt->execute()) {
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                echo "Successfully registered a vehicle!";
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
