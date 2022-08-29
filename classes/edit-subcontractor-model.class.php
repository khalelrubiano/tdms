<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class EditSubcontractorModel
{
    private $usernameEdit;
    private $passwordEdit;
    private $firstNameEdit;
    private $middleNameEdit;
    private $lastNameEdit;
    private $companyId;

    public function __construct(
        $usernameEdit,
        $passwordEdit,
        $firstNameEdit,
        $middleNameEdit,
        $lastNameEdit,
        $companyId
    ) {

        $this->usernameEdit = $usernameEdit;
        $this->passwordEdit = $passwordEdit;
        $this->firstNameEdit = $firstNameEdit;
        $this->middleNameEdit = $middleNameEdit;
        $this->lastNameEdit = $lastNameEdit;
        $this->companyId = $companyId;
    }

    public function editSubcontractorRecord()
    {
/*
        if ($this->usernameValidator() == false) {
            echo "The username you entered is already taken!";
            exit();
        }
*/
        $this->editSubcontractorSubmit();
    }

    private function editSubcontractorSubmit()
    {

        $sql = "UPDATE
        subcontractor 
        SET
        password = :password, 
        first_name = :first_name, 
        middle_name = :middle_name, 
        last_name = :last_name
        WHERE username = :username";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":username", $paramUsernameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":password", $paramPasswordEdit, PDO::PARAM_STR);
            $stmt->bindParam(":first_name", $paramFirstNameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":middle_name", $paramMiddleNameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $paramLastNameEdit, PDO::PARAM_STR);
            //$stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

            $paramUsernameEdit = $this->usernameEdit;
            $paramPasswordEdit = password_hash($this->passwordEdit, PASSWORD_DEFAULT);
            $paramFirstNameEdit = $this->firstNameEdit;
            $paramMiddleNameEdit = $this->middleNameEdit;
            $paramLastNameEdit = $this->lastNameEdit;
            //$paramCompanyId = $this->companyId;

            if ($stmt->execute()) {
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                echo "Successfully edited an account!";
            } else {
/*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
                echo "Something went wrong, account edit was not successful!";
            }


            unset($stmt);
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
/*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
            }

            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }
}
