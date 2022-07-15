
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class EditPermissionModel
{
    private $roleNameEdit;
    private $shipmentAccessEdit;
    private $employeeAccessEdit;
    private $subcontractorAccessEdit;
    private $clientAccessEdit;
    private $billingAccessEdit;
    private $payrollAccessEdit;
    private $permissionIdEdit;
    private $companyId;

    public function __construct(
        $roleNameEdit,
        $shipmentAccessEdit,
        $employeeAccessEdit,
        $subcontractorAccessEdit,
        $clientAccessEdit,
        $billingAccessEdit,
        $payrollAccessEdit,
        $permissionIdEdit,
        $companyId
    ) {

        $this->roleNameEdit = $roleNameEdit;
        $this->shipmentAccessEdit = $shipmentAccessEdit;
        $this->employeeAccessEdit = $employeeAccessEdit;
        $this->subcontractorAccessEdit = $subcontractorAccessEdit;
        $this->clientAccessEdit = $clientAccessEdit;
        $this->billingAccessEdit = $billingAccessEdit;
        $this->payrollAccessEdit = $payrollAccessEdit;
        $this->permissionIdEdit = $permissionIdEdit;
        $this->companyId = $companyId;
    }

    public function editPermissionRecord()
    {
/*
        if ($this->usernameValidator() == false) {
            echo "The username you entered is already taken!";
            exit();
        }
*/
        $this->editPermissionSubmit();
    }

    private function editPermissionSubmit()
    {

        $sql = "UPDATE permission
        SET 
        role_name = :role_name,
        shipment_access = :shipment_access, 
        employee_access = :employee_access, 
        subcontractor_access = :subcontractor_access,
        client_access = :client_access,
        billing_access = :billing_access,
        payroll_access = :payroll_access
        WHERE permission_id = :permission_id AND company_id = :company_id";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":role_name", $paramRoleNameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":shipment_access", $paramShipmentAccessEdit, PDO::PARAM_STR);
            $stmt->bindParam(":employee_access", $paramEmployeeAccessEdit, PDO::PARAM_STR);
            $stmt->bindParam(":subcontractor_access", $paramSubcontractorAccessEdit, PDO::PARAM_STR);
            $stmt->bindParam(":client_access", $paramClientAccessEdit, PDO::PARAM_STR);
            $stmt->bindParam(":billing_access", $paramBillingAccessEdit, PDO::PARAM_STR);
            $stmt->bindParam(":payroll_access", $paramPayrollAccessEdit, PDO::PARAM_STR);
            $stmt->bindParam(":permission_id", $paramPermissionIdEdit, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

            $paramRoleNameEdit = $this->roleNameEdit;
            $paramShipmentAccessEdit = $this->shipmentAccessEdit;
            $paramEmployeeAccessEdit = $this->employeeAccessEdit;
            $paramSubcontractorAccessEdit = $this->subcontractorAccessEdit;
            $paramClientAccessEdit = $this->clientAccessEdit;
            $paramBillingAccessEdit = $this->billingAccessEdit;
            $paramPayrollAccessEdit = $this->payrollAccessEdit;
            $paramPermissionIdEdit = $this->permissionIdEdit;
            $paramCompanyId = $this->companyId;

            if ($stmt->execute()) {
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                //echo $paramRoleNameEdit . $paramShipmentAccessEdit . $paramEmployeeAccessEdit . $paramSubcontractorAccessEdit . $paramClientAccessEdit . $paramBillingAccessEdit . $paramPayrollAccessEdit . $paramPermissionIdEdit . $paramCompanyId;
                echo "Successfully edited a role!";
            } else {
/*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
                echo "Something went wrong, role edit was not successful!";
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

            $stmt->bindParam(":user_name", $paramUsernameEdit, PDO::PARAM_STR);


            $paramUsernameEdit = $this->usernameEdit;


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
