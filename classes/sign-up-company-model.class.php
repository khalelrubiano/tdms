
<?php
//PART OF NEW SYSTEM
require_once "../config.php";


class SignUpCompanyModel
{
    private $employeeNumberAdd;
    private $username;
    private $password;
    private $companyName;
    private $companyEmail;
    private $companyNumber;
    private $companyAddress;
    private $region;
    private $province;
    private $city;
    private $barangay;
    private $tin;
    public function __construct($employeeNumberAdd, $username, $password, $companyName, $companyEmail, $companyNumber, $companyAddress, $region, $province, $city, $barangay, $tin)
    {
        $this->employeeNumberAdd = $employeeNumberAdd;
        $this->username = $username;
        $this->password = $password;
        $this->companyName = $companyName;
        $this->companyEmail = $companyEmail;
        $this->companyNumber = $companyNumber;
        $this->companyAddress = $companyAddress;
        $this->region = $region;
        $this->province = $province;
        $this->city = $city;
        $this->barangay = $barangay;
        $this->tin = $tin;
    }

    public function signUpCompany()
    {
        //FIX THIS
        /*
        if ($this->usernameValidator() == false) {
            session_start();
            $_SESSION['prompt'] = "The username you entered is already taken!";
            header('location: ../prompt.php');
            exit();
        }

        if ($this->companyValidator() == false) {
            session_start();
            $_SESSION['prompt'] = "A company with the same name is already registered!";
            header('location: ../prompt.php');
            exit();
        }
        */


        //PUT THESE IN IF STATEMENT
        $this->companySubmit();

        $this->roleAdminSubmit();

        $this->accountSubmit();
    }

    private function roleAdminSubmit()
    {
        //UPDATE THIS FOR EACH MODULE
        $sql = "INSERT INTO 
        permission 
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

            $stmt->bindParam(":role_name", $paramRoleName, PDO::PARAM_STR);
            $stmt->bindParam(":shipment_access", $paramShipmentAccess, PDO::PARAM_STR);
            $stmt->bindParam(":employee_access", $paramEmployeeAccess, PDO::PARAM_STR);
            $stmt->bindParam(":subcontractor_access", $paramSubcontractorAccess, PDO::PARAM_STR);
            $stmt->bindParam(":client_access", $paramClientAccess, PDO::PARAM_STR);
            $stmt->bindParam(":billing_access", $paramBillingAccess, PDO::PARAM_STR);
            $stmt->bindParam(":payroll_access", $paramPayrollAccess, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

            $paramRoleName = 'Admin';
            $paramShipmentAccess = 'true';
            $paramEmployeeAccess = 'true';
            $paramSubcontractorAccess = 'true';
            $paramClientAccess = 'true';
            $paramBillingAccess = 'true';
            $paramPayrollAccess = 'true';
            $paramCompanyId = $this->getCompanyId();

            if ($stmt->execute()) {
            } else {
                session_start();
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function roleDefaultSubmit()
    {
        //UPDATE THIS FOR EACH MODULE
        $sql = "INSERT INTO 
        permission 
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

            $stmt->bindParam(":role_name", $paramRoleName, PDO::PARAM_STR);
            $stmt->bindParam(":shipment_access", $paramShipmentAccess, PDO::PARAM_STR);
            $stmt->bindParam(":employee_access", $paramEmployeeAccess, PDO::PARAM_STR);
            $stmt->bindParam(":subcontractor_access", $paramSubcontractorAccess, PDO::PARAM_STR);
            $stmt->bindParam(":client_access", $paramClientAccess, PDO::PARAM_STR);
            $stmt->bindParam(":billing_access", $paramBillingAccess, PDO::PARAM_STR);
            $stmt->bindParam(":payroll_access", $paramPayrollAccess, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

            $paramRoleName = 'Default';
            $paramShipmentAccess = 'false';
            $paramEmployeeAccess = 'false';
            $paramSubcontractorAccess = 'false';
            $paramClientAccess = 'false';
            $paramBillingAccess = 'false';
            $paramPayrollAccess = 'false';
            $paramCompanyId = $this->getCompanyId();

            if ($stmt->execute()) {
            } else {
                session_start();
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function accountSubmit()
    {

        $sql = "INSERT INTO 
        employee 
        (employee_number,
        username, 
        password, 
        first_name, 
        middle_name, 
        last_name, 
        permission_id) 
        VALUES 
        (:employee_number,
        :username, 
        :password, 
        :first_name, 
        :middle_name, 
        :last_name, 
        :permission_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":employee_number", $param1, PDO::PARAM_STR);
            $stmt->bindParam(":username", $paramUsername, PDO::PARAM_STR);
            $stmt->bindParam(":password", $paramPassword, PDO::PARAM_STR);
            $stmt->bindParam(":first_name", $paramFirstName, PDO::PARAM_STR);
            $stmt->bindParam(":middle_name", $paramMiddleName, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $paramLastName, PDO::PARAM_STR);
            $stmt->bindParam(":permission_id", $paramPermissionId, PDO::PARAM_STR);

            $param1 = $this->employeeNumberAdd;
            $paramUsername = $this->username;
            $paramPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $paramFirstName = 'Company';
            $paramMiddleName = 'Admin';
            $paramLastName = 'Account';
            $paramPermissionId = $this->getPermissionId();

            if ($stmt->execute()) {
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
            } else {
                session_start();
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function companySubmit()
    {

        $sql = "INSERT INTO company (company_name, tin, company_email, company_number, company_address, region, province, city, barangay) VALUES (:company_name, :tin, :company_email, :company_number, :company_address, :region, :province, :city, :barangay)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":company_name", $paramCompanyName, PDO::PARAM_STR);
            $stmt->bindParam(":tin", $paramTin, PDO::PARAM_STR);
            $stmt->bindParam(":company_email", $paramCompanyEmail, PDO::PARAM_STR);
            $stmt->bindParam(":company_number", $paramCompanyNumber, PDO::PARAM_STR);
            $stmt->bindParam(":company_address", $paramCompanyAddress, PDO::PARAM_STR);
            $stmt->bindParam(":region", $paramRegion, PDO::PARAM_STR);
            $stmt->bindParam(":province", $paramProvince, PDO::PARAM_STR);
            $stmt->bindParam(":city", $paramCity, PDO::PARAM_STR);
            $stmt->bindParam(":barangay", $paramBarangay, PDO::PARAM_STR);

            $paramCompanyName = $this->companyName;
            $paramCompanyEmail = $this->companyEmail;
            $paramCompanyNumber = $this->companyNumber;
            $paramCompanyAddress = $this->companyAddress;
            $paramRegion = $this->regionConverter($this->region);
            $paramProvince = $this->provinceConverter($this->province);
            $paramCity = $this->cityConverter($this->city);
            $paramBarangay = strtoupper($this->barangayConverter($this->barangay));
            $paramTin = $this->tin;

            if ($stmt->execute()) {
            } else {
                session_start();
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    public function getCompanyId()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT * FROM company WHERE company_name = :company_name";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":company_name", $paramCompanyName, PDO::PARAM_STR);

            $paramCompanyName = $this->companyName;

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

    public function getPermissionId()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT * FROM permission WHERE role_name = :role_name AND company_id = :company_id";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);
            $stmt->bindParam(":role_name", $paramRoleName, PDO::PARAM_STR);

            $paramCompanyId = $this->getCompanyId();
            $paramRoleName = "Admin";

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

            $stmt->bindParam(":username", $paramUsername, PDO::PARAM_STR);

            $paramUsername = $this->username;

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $result = false;
                } else {
                    $result = true;
                }
            } else {
                session_start();
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }

            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }

    public function companyValidator()
    {
        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        $sql = "SELECT * FROM company WHERE companyName = :companyName";

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":companyName", $paramCompany, PDO::PARAM_STR);

            $paramCompany = $this->companyName;

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $result = false;
                } else {
                    $result = true;
                }
            } else {
                session_start();
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }

            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }

    private function regionConverter($regionCode)
    {

        $json = file_get_contents('../json/refregion.json');
        $jsonData = json_decode($json, true);

        for ($i = 0; $i <= count($jsonData); $i++) {
            if ($jsonData[$i]['regCode'] == $regionCode) {
                $regionVal = $jsonData[$i]['regDesc'];
                return $regionVal;
                break;
            }
        }
    }
    private function provinceConverter($provinceCode)
    {

        $json = file_get_contents('../json/refprovince.json');
        $jsonData = json_decode($json, true);

        for ($i = 0; $i <= count($jsonData); $i++) {
            if ($jsonData[$i]['provCode'] == $provinceCode) {
                $provinceVal = $jsonData[$i]['provDesc'];
                return $provinceVal;
                break;
            }
        }
    }
    private function cityConverter($cityCode)
    {

        $json = file_get_contents('../json/refcitymun.json');
        $jsonData = json_decode($json, true);

        for ($i = 0; $i <= count($jsonData); $i++) {
            if ($jsonData[$i]['citymunCode'] == $cityCode) {
                $cityVal = $jsonData[$i]['citymunDesc'];
                return $cityVal;
                break;
            }
        }
    }
    private function barangayConverter($barangayCode)
    {

        $json = file_get_contents('../json/refbrgy.json');
        $jsonData = json_decode($json, true);

        for ($i = 0; $i <= count($jsonData); $i++) {
            if ($jsonData[$i]['brgyCode'] == $barangayCode) {
                $barangayVal = $jsonData[$i]['brgyDesc'];
                return $barangayVal;
                break;
            }
        }
    }
}
