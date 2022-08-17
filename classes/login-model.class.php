<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once "../config.php";


class LoginModel
{
    private $username;
    private $password;

    public function __construct($username, $password)
    {

        $this->username = $username;
        $this->password = $password;
    }

    public function login()
    {

        $this->loginEmployeeSubmit();
        $this->loginSubcontractorSubmit();
    }

    private function loginEmployeeSubmit()
    {

        $configObj = new Config();
        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT
        employee_id,
        username, 
        password,
        first_name,
        middle_name,
        last_name,
        permission_id 
        FROM employee
        WHERE username = :username";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":username", $paramUsername, PDO::PARAM_STR);

            $paramUsername = trim($this->username);

            if ($stmt->execute()) {

                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {

                        $employeeId = $row["employee_id"];
                        $username = $row["username"];
                        $firstName = $row["first_name"];
                        $middleName = $row["middle_name"];
                        $lastName = $row["last_name"];
                        $permissionId = $row["permission_id"];
                        $hashedPassword = $row["password"];

                        if (password_verify($this->password, $hashedPassword)) {


                            $_SESSION["loggedin"] = true;
                            $_SESSION["employeeId"] = $employeeId;
                            $_SESSION["username"] = $username;
                            $_SESSION["password"] = $hashedPassword;
                            $_SESSION["firstName"] = $firstName;
                            $_SESSION["middleName"] = $middleName;
                            $_SESSION["lastName"] = $lastName;
                            $_SESSION["permissionId"] = $permissionId;
                            //$_SESSION["shipmentAccess"] = 'Yes';

                            $this->getPermission();
                            header("location: ../dashboard.php");
                            exit();
                        } else {

                            //$_SESSION["prompt"] = "Invalid username or password!";
                            //header('location: ../prompt.php');
                            exit();
                        }
                    }
                } else {

                    //$_SESSION["prompt"] = "Invalid username or password!";
                    //header('location: ../prompt.php');
                    //exit();
                }
            } else {

                //$_SESSION["prompt"] = "Something went wrong!";
                //header('location: ../prompt.php');
                //exit();
            }
            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function loginSubcontractorSubmit()
    {

        $configObj = new Config();
        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT
        subcontractor_id,
        username, 
        password,
        first_name,
        middle_name,
        last_name,
        company_id 
        FROM subcontractor WHERE username = :username";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":username", $paramUsername, PDO::PARAM_STR);

            $paramUsername = trim($this->username);

            if ($stmt->execute()) {

                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {

                        $subcontractorId = $row["subcontractor_id"];
                        $username = $row["username"];
                        $firstName = $row["first_name"];
                        $middleName = $row["middle_name"];
                        $lastName = $row["last_name"];
                        $hashedPassword = $row["password"];
                        $companyId = $row["company_id"];

                        if (password_verify($this->password, $hashedPassword)) {


                            $_SESSION["loggedin"] = true;
                            $_SESSION["subcontractorId"] = $subcontractorId;
                            $_SESSION["username"] = $username;
                            $_SESSION["password"] = $hashedPassword;
                            $_SESSION["firstName"] = $firstName;
                            $_SESSION["middleName"] = $middleName;
                            $_SESSION["lastName"] = $lastName;
                            $_SESSION["companyId"] = $companyId;
                            
                            $this->getSubcontractorRole1($subcontractorId);
                            $this->getSubcontractorRole2($subcontractorId);

                            header("location: ../dashboard-subcontractor.php");
                        } else {

                            //$_SESSION["prompt"] = "Invalid username or password!";
                            //header('location: ../prompt.php');
                            exit();
                        }
                    }
                } else {

                    //$_SESSION["prompt"] = "Invalid username or password!";
                    //header('location: ../prompt.php');
                    //exit();
                }
            } else {

                //$_SESSION["prompt"] = "Something went wrong!";
                //header('location: ../prompt.php');
                //exit();
            }
            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function getPermission()
    {

        $configObj = new Config();
        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT * FROM permission WHERE permission_id = :permission_id";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":permission_id", $paramPermissionId, PDO::PARAM_STR);

            $paramPermissionId = $_SESSION["permissionId"];

            if ($stmt->execute()) {

                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {

                        $roleName = $row["role_name"];
                        $shipmentAccess = $row["shipment_access"];
                        $employeeAccess = $row["employee_access"];
                        $subcontractorAccess = $row["subcontractor_access"];
                        $clientAccess = $row["client_access"];
                        $billingAccess = $row["billing_access"];
                        $payrollAccess = $row["payroll_access"];
                        $companyId = $row["company_id"];

                        $_SESSION["roleName"] = $roleName;
                        $_SESSION["shipmentAccess"] = $shipmentAccess;
                        $_SESSION["employeeAccess"] = $employeeAccess;
                        $_SESSION["subcontractorAccess"] = $subcontractorAccess;
                        $_SESSION["clientAccess"] = $clientAccess;
                        $_SESSION["billingAccess"] = $billingAccess;
                        $_SESSION["payrollAccess"] = $payrollAccess;
                        $_SESSION["companyId"] = $companyId;
                    }
                }
            } else {

                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }
            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function getSubcontractorRole1($idVar)
    {

        $configObj = new Config();
        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT 
        driver_id,
        helper_id
        FROM vehicle";

        if ($stmt = $pdoVessel->prepare($sql)) {

            //$stmt->bindParam(":permission_id", $paramPermissionId, PDO::PARAM_STR);

            //$paramPermissionId = $_SESSION["permissionId"];

            if ($stmt->execute()) {
                $row = $stmt->fetchAll();

                for ($i = 0; $i < count($row); $i++) {
                    /*
                    if ($idVar == $row[$i][0]) {
                        //$returnValue = $row[$i][2] . " " . $row[$i][3] . " " . $row[$i][4];
                        $_SESSION["isOwner"] = "Yes";
                    }
                    if ($idVar == $row[$i][1]) {
                        //$returnValue = $row[$i][2] . " " . $row[$i][3] . " " . $row[$i][4];
                        $_SESSION["isDriver"] = "Yes";
                    }
                    */
                    switch ($idVar) {
                        case $row[$i][0]:
                            $_SESSION["isOwner"] = "No";
                            $_SESSION["isDriver"] = "Yes";
                            $_SESSION["isHelper"] = "No";
                            break;
                        case $row[$i][1]:
                            $_SESSION["isOwner"] = "No";
                            $_SESSION["isDriver"] = "No";
                            $_SESSION["isHelper"] = "Yes";
                            break;
                    }
                }
            } else {
            }

            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function getSubcontractorRole2($idVar)
    {

        $configObj = new Config();
        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT 
        owner_id
        FROM ownergroup";

        if ($stmt = $pdoVessel->prepare($sql)) {

            //$stmt->bindParam(":permission_id", $paramPermissionId, PDO::PARAM_STR);

            //$paramPermissionId = $_SESSION["permissionId"];

            if ($stmt->execute()) {
                $row = $stmt->fetchAll();

                for ($i = 0; $i < count($row); $i++) {

                    if ($idVar == $row[$i][0]) {
                        //$returnValue = $row[$i][2] . " " . $row[$i][3] . " " . $row[$i][4];
                        $_SESSION["isOwner"] = "Yes";
                        $_SESSION["isDriver"] = "No";
                        $_SESSION["isHelper"] = "No";
                    } 
                }
            } else {
            }

            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function emptyValidator()
    {
        if (empty(trim($this->username)) || empty(trim($this->password))) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
