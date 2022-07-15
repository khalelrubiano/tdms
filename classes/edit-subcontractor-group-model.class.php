
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class EditSubcontractorGroupModel
{
    private $groupIdEdit;
    private $groupNameEdit;
    private $groupOwnerEdit;
    private $companyId;

    public function __construct(
        $groupIdEdit,
        $groupNameEdit,
        $groupOwnerEdit,
        $companyId
    ) {

        $this->groupIdEdit = $groupIdEdit;
        $this->groupNameEdit = $groupNameEdit;
        $this->groupOwnerEdit = $groupOwnerEdit;
        $this->companyId = $companyId;
    }

    public function editSubcontractorGroupRecord()
    {
/*
        if ($this->usernameValidator() == false) {
            echo "The username you entered is already taken!";
            exit();
        }
*/
        $this->editSubcontractorGroupSubmit();
    }

    private function editOwnerAccountSubmit()
    {

        $sql = "INSERT INTO 
        subcontractor 
        (username, 
        password, 
        first_name, 
        middle_name, 
        last_name,
        company_id) 
        VALUES 
        (:username, 
        :password, 
        :first_name, 
        :middle_name, 
        :last_name,
        :company_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":username", $paramUsernameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":password", $paramPasswordEdit, PDO::PARAM_STR);
            $stmt->bindParam(":first_name", $paramFirstNameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":middle_name", $paramMiddleNameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $paramLastNameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

            $paramUsernameEdit = $this->usernameEdit;
            $paramPasswordEdit = password_hash($this->passwordEdit, PASSWORD_DEFAULT);
            $paramFirstNameEdit = $this->firstNameEdit;
            $paramMiddleNameEdit = $this->middleNameEdit;
            $paramLastNameEdit = $this->lastNameEdit;
            $paramCompanyId = $this->companyId;

            if ($stmt->execute()) {
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                //echo "Successfully created an account!";
            } else {
/*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
                //echo "Something went wrong, account creation was not successful!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function editSubcontractorGroupSubmit()
    {

        $sql = "UPDATE
        ownergroup 
        SET
        group_name = :group_name, 
        owner_id = :owner_id
        WHERE
        group_id = :group_id";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":group_id", $paramGroupIdEdit, PDO::PARAM_STR);
            $stmt->bindParam(":group_name", $paramGroupNameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":owner_id", $paramGroupOwnerEdit, PDO::PARAM_STR);

            $paramGroupIdEdit = $this->groupIdEdit;
            $paramGroupNameEdit = $this->groupNameEdit;
            $paramGroupOwnerEdit = $this->groupOwnerEdit;

            if ($stmt->execute()) {
                echo "Successfully edited a group!";
            } else {
                echo "Something went wrong, group edit was not successful!";
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

            $stmt->bindParam(":username", $paramUsernameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);
            

            $paramUsernameEdit = $this->usernameEdit;
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

            $stmt->bindParam(":username", $paramUsernameEdit, PDO::PARAM_STR);


            $paramUsernameEdit = $this->usernameEdit;


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
