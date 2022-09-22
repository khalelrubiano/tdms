
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class AddSubcontractorModel
{
    private $subcontractorNumberAdd;
    private $usernameAdd;
    private $passwordAdd;
    private $firstNameAdd;
    private $middleNameAdd;
    private $lastNameAdd;
    private $companyId;

    public function __construct(
        $subcontractorNumberAdd,
        $usernameAdd,
        $passwordAdd,
        $firstNameAdd,
        $middleNameAdd,
        $lastNameAdd,
        $companyId
    ) {
        $this->subcontractorNumberAdd = $subcontractorNumberAdd;
        $this->usernameAdd = $usernameAdd;
        $this->passwordAdd = $passwordAdd;
        $this->firstNameAdd = $firstNameAdd;
        $this->middleNameAdd = $middleNameAdd;
        $this->lastNameAdd = $lastNameAdd;
        $this->companyId = $companyId;
    }

    public function addSubcontractorRecord()
    {
/*
        if ($this->usernameValidator() == false) {
            echo "The username you entered is already taken!";
            exit();
        }
*/
        $this->addSubcontractorSubmit();
    }

    private function addSubcontractorSubmit()
    {

        $sql = "INSERT INTO 
        subcontractor 
        (subcontractor_number,
        username, 
        password, 
        first_name, 
        middle_name, 
        last_name,
        company_id) 
        VALUES 
        (:subcontractor_number,
        :username, 
        :password, 
        :first_name, 
        :middle_name, 
        :last_name,
        :company_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":subcontractor_number", $param1, PDO::PARAM_STR);
            $stmt->bindParam(":username", $paramUsernameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":password", $paramPasswordAdd, PDO::PARAM_STR);
            $stmt->bindParam(":first_name", $paramFirstNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":middle_name", $paramMiddleNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $paramLastNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

            $param1 = $this->subcontractorNumberAdd;
            $paramUsernameAdd = $this->usernameAdd;
            $paramPasswordAdd = password_hash($this->passwordAdd, PASSWORD_DEFAULT);
            $paramFirstNameAdd = $this->firstNameAdd;
            $paramMiddleNameAdd = $this->middleNameAdd;
            $paramLastNameAdd = $this->lastNameAdd;
            $paramCompanyId = $this->companyId;

            if ($stmt->execute()) {
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                echo "Successfully created an account!";
            } else {
/*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
                echo "Something went wrong, account creation was not successful!";
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

            $stmt->bindParam(":username", $paramUsernameAdd, PDO::PARAM_STR);


            $paramUsernameAdd = $this->usernameAdd;


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
