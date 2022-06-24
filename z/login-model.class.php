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

        $this->loginSubmit();
        $this->getPermission();
    }

    private function loginSubmit()
    {

        $configObj = new Config();
        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT 
        username, 
        password,
        firstName,
        middleName,
        lastName,
        role,
        companyName 
        FROM user
        WHERE username = :username";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":username", $paramUsername, PDO::PARAM_STR);

            $paramUsername = trim($this->username);

            if ($stmt->execute()) {

                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {

                        $username = $row["username"];
                        $firstName = $row["firstName"];
                        $middleName = $row["middleName"];
                        $lastName = $row["lastName"];
                        $role = $row["role"];
                        $companyName = $row["companyName"];
                        $hashedPassword = $row["password"];

                        if (password_verify($this->password, $hashedPassword)) {


                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;
                            $_SESSION["password"] = $hashedPassword;
                            $_SESSION["firstName"] = $firstName;
                            $_SESSION["middleName"] = $middleName;
                            $_SESSION["lastName"] = $lastName;
                            $_SESSION["role"] = $role;
                            $_SESSION["companyName"] = $companyName;
                            //$_SESSION["shipmentAccess"] = 'Yes';

                            

                            header("location: ../index.php");
                        } else {

                            $_SESSION["prompt"] = "Invalid username or password!";
                            header('location: ../prompt.php');
                            exit();
                        }
                    }
                } else {

                    $_SESSION["prompt"] = "Invalid username or password!";
                    header('location: ../prompt.php');
                    exit();
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

    private function getPermission()
    {

        $configObj = new Config();
        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT 
        *
        FROM permission
        WHERE role = :role 
        AND companyName = :companyName";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":role", $paramRole, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);

            $paramRole = $_SESSION["role"];
            $paramCompanyName = $_SESSION["companyName"];

            if ($stmt->execute()) {

                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $accountType = $row["accountType"];
                        $shipmentAccess = $row["shipmentAccess"];
                        $accountAccess = $row["accountAccess"];

                        $_SESSION["accountType"] = $accountType;
                        $_SESSION["shipmentAccess"] = $shipmentAccess;
                        $_SESSION["accountAccess"] = $accountAccess;
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
