
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class AddPermissionModel
{
    private $roleNameAdd;
    private $shipmentAccessAdd;
    private $employeeAccessAdd;
    private $subcontractorAccessAdd;
    private $clientAccessAdd;
    private $billingAccessAdd;
    private $payrollAccessAdd;
    private $companyId;

    public function __construct(
        $roleNameAdd,
        $shipmentAccessAdd,
        $employeeAccessAdd,
        $subcontractorAccessAdd,
        $clientAccessAdd,
        $billingAccessAdd,
        $payrollAccessAdd,
        $companyId
    ) {

        $this->roleNameAdd = $roleNameAdd;
        $this->shipmentAccessAdd = $shipmentAccessAdd;
        $this->employeeAccessAdd = $employeeAccessAdd;
        $this->subcontractorAccessAdd = $subcontractorAccessAdd;
        $this->clientAccessAdd = $clientAccessAdd;
        $this->billingAccessAdd = $billingAccessAdd;
        $this->payrollAccessAdd = $payrollAccessAdd;
        $this->companyId = $companyId;
    }

    public function addPermissionRecord()
    {
/*
        if ($this->usernameValidator() == false) {
            echo "The username you entered is already taken!";
            exit();
        }
*/
        $this->addPermissionSubmit();
    }

    private function addPermissionSubmit()
    {

        $sql = "INSERT INTO permission 
        (role_name,
        shipment_access, 
        employee_access, 
        subcontractor_access,
        client_access,
        billing_access, 
        payroll_access, 
        company_id) 
        VALUES 
        (:role_name,
        :shipment_access, 
        :employee_access, 
        :subcontractor_access,
        :client_access,
        :billing_access, 
        :payroll_access, 
        :company_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":role_name", $paramRoleNameAdd, PDO::PARAM_STR);
            $stmt->bindParam(":shipment_access", $paramShipmentAccessAdd, PDO::PARAM_STR);
            $stmt->bindParam(":employee_access", $paramEmployeeAccessAdd, PDO::PARAM_STR);
            $stmt->bindParam(":subcontractor_access", $paramSubcontractorAccessAdd, PDO::PARAM_STR);
            $stmt->bindParam(":client_access", $paramClientAccessAdd, PDO::PARAM_STR);
            $stmt->bindParam(":billing_access", $paramBillingAccessAdd, PDO::PARAM_STR);
            $stmt->bindParam(":payroll_access", $paramPayrollAccessAdd, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

            $paramRoleNameAdd = $this->roleNameAdd;
            $paramShipmentAccessAdd = $this->shipmentAccessAdd;
            $paramEmployeeAccessAdd = $this->employeeAccessAdd;
            $paramSubcontractorAccessAdd = $this->subcontractorAccessAdd;
            $paramClientAccessAdd = $this->clientAccessAdd;
            $paramBillingAccessAdd = $this->billingAccessAdd;
            $paramPayrollAccessAdd = $this->payrollAccessAdd;
            $paramCompanyId = $this->companyId;

            if ($stmt->execute()) {
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                echo "Successfully created a role!";
            } else {
/*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
                echo "Something went wrong, role creation was not successful!";
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
