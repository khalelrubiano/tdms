
<?php
//PART OF NEW SYSTEM
require_once "../config.php";


class SignUpCompanyModel
{
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

    public function __construct($username, $password, $companyName, $companyEmail, $companyNumber, $companyAddress, $region, $province, $city, $barangay)
    {

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
        $sql = "INSERT INTO permission (role_name, account_type, dashboard_access, shipment_access, employee_access, subcontractor_access, company_id) VALUES (:role_name, :account_type, :dashboard_access, :shipment_access, :employee_access, :subcontractor_access, :company_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":role_name", $paramRoleName, PDO::PARAM_STR);
            $stmt->bindParam(":account_type", $paramAccountType, PDO::PARAM_STR);
            $stmt->bindParam(":dashboard_access", $paramDashboardAccess, PDO::PARAM_STR);
            $stmt->bindParam(":shipment_access", $paramShipmentAccess, PDO::PARAM_STR);
            $stmt->bindParam(":employee_access", $paramEmployeeAccess, PDO::PARAM_STR);
            $stmt->bindParam(":subcontractor_access", $paramSubcontractorAccess, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

            $paramRoleName = 'Admin';
            $paramAccountType = 'Employee';
            $paramDashboardAccess = 'Yes';
            $paramShipmentAccess = 'Yes';
            $paramEmployeeAccess = 'Yes';
            $paramSubcontractorAccess = 'Yes';
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
        $sql = "INSERT INTO permission (role_name, account_type, dashboard_access, shipment_access, employee_access, subcontractor_access, company_id) VALUES (:role_name, :account_type, :dashboard_access, :shipment_access, :employee_access, :subcontractor_access, :company_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":role_name", $paramRoleName, PDO::PARAM_STR);
            $stmt->bindParam(":account_type", $paramAccountType, PDO::PARAM_STR);
            $stmt->bindParam(":dashboard_access", $paramDashboardAccess, PDO::PARAM_STR);
            $stmt->bindParam(":shipment_access", $paramShipmentAccess, PDO::PARAM_STR);
            $stmt->bindParam(":employee_access", $paramEmployeeAccess, PDO::PARAM_STR);
            $stmt->bindParam(":subcontractor_access", $paramSubcontractorAccess, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

            $paramRoleName = 'Default';
            $paramAccountType = 'Default';
            $paramDashboardAccess = 'No';
            $paramShipmentAccess = 'No';
            $paramEmployeeAccess = 'No';
            $paramSubcontractorAccess = 'No';
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

        $sql = "INSERT INTO user (user_name, password, first_name, middle_name, last_name, permission_id) VALUES (:user_name, :password, :first_name, :middle_name, :last_name, :permission_id)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":user_name", $paramUsername, PDO::PARAM_STR);
            $stmt->bindParam(":password", $paramPassword, PDO::PARAM_STR);
            $stmt->bindParam(":first_name", $paramFirstName, PDO::PARAM_STR);
            $stmt->bindParam(":middle_name", $paramMiddleName, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $paramLastName, PDO::PARAM_STR);
            $stmt->bindParam(":permission_id", $paramPermissionId, PDO::PARAM_STR);

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

        $sql = "INSERT INTO company (company_name, company_email, company_number, company_address, region, province, city, barangay) VALUES (:company_name, :company_email, :company_number, :company_address, :region, :province, :city, :barangay)";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":company_name", $paramCompanyName, PDO::PARAM_STR);
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
