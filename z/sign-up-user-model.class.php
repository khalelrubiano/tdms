
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class AddUserModel
{
    private $usernameAdd;
    private $passwordAdd;
    private $firstNameAdd;
    private $middleNameAdd;
    private $lastNameAdd;
    private $companyName;

    public function __construct(
        $usernameAdd,
        $passwordAdd,
        $firstNameAdd,
        $middleNameAdd,
        $lastNameAdd,
        $companyName
    ) {

        $this->usernameAdd = $usernameAdd;
        $this->passwordAdd = $passwordAdd;
        $this->firstNameAdd = $firstNameAdd;
        $this->middleNameAdd = $middleNameAdd;
        $this->lastNameAdd = $lastNameAdd;
        $this->companyName = $companyName;
    }

    public function addUserRecord()
    {
/*
        if ($this->usernameValidator() == false) {

            $_SESSION['prompt'] = "The username you entered is already taken!";
            header('location: ../prompt.php');
            exit();
        }
*/
        $this->addUserSubmit();
    }

    private function addUserSubmit()
    {

        $sql = "INSERT INTO user (username, password, role, firstName, middleName, lastName, companyName) VALUES (:username, :password, :role, :firstName, :middleName, :lastName, :companyName)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":username", $paramUsernameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":password", $paramPasswordAdd, PDO::PARAM_STR);
            $stmt->bindParam(":role", $paramRole, PDO::PARAM_STR);
            $stmt->bindParam(":firstName", $paramFirstNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":middleName", $paramMiddleNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":lastName", $paramLastNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);

            $paramUsernameAdd = $this->usernameAdd;
            $paramPasswordAdd = password_hash($this->passwordAdd, PASSWORD_DEFAULT);
            $paramRole = "Default";
            $paramFirstNameAdd = $this->firstNameAdd;
            $paramMiddleNameAdd = $this->middleNameAdd;
            $paramLastNameAdd = $this->lastNameAdd;
            $paramCompanyName = $this->companyName;

            if ($stmt->execute()) {
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
            } else {

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

        $sql = "SELECT * FROM user WHERE username = :username";

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

                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }

            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }
}
