
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
    private $companyId;

    public function __construct(
        $usernameAdd,
        $passwordAdd,
        $firstNameAdd,
        $middleNameAdd,
        $lastNameAdd,
        $companyId
    ) {

        $this->usernameAdd = $usernameAdd;
        $this->passwordAdd = $passwordAdd;
        $this->firstNameAdd = $firstNameAdd;
        $this->middleNameAdd = $middleNameAdd;
        $this->lastNameAdd = $lastNameAdd;
        $this->companyId = $companyId;
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

        $sql = "INSERT INTO user (user_name, password, first_name, middle_name, last_name, permission_id) VALUES (:user_name, :password, :first_name, :middle_name, :last_name, :permission_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":user_name", $paramUsernameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":password", $paramPasswordAdd, PDO::PARAM_STR);
            $stmt->bindParam(":first_name", $paramFirstNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":middle_name", $paramMiddleNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $paramLastNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":permission_id", $paramPermissionId, PDO::PARAM_STR);

            $paramUsernameAdd = $this->usernameAdd;
            $paramPasswordAdd = password_hash($this->passwordAdd, PASSWORD_DEFAULT);
            $paramFirstNameAdd = $this->firstNameAdd;
            $paramMiddleNameAdd = $this->middleNameAdd;
            $paramLastNameAdd = $this->lastNameAdd;
            $paramPermissionId = $this->getPermissionId();

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
