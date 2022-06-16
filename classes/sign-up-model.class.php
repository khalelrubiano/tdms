<?php

require_once "../config.php";


class SignUpModel{
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

    public function __construct($username, $password, $companyName, $companyEmail, $companyNumber, $companyAddress, $region, $province, $city, $barangay){

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

    public function signUp(){

        if($this->emptyValidator() == false || $this->lengthValidator() == false || $this->patternValidator() == false ){
            session_start();
            $_SESSION['prompt'] = "The information you entered are not valid!";
            header('location: ../prompt.php');
            exit();
        }

        if($this->usernameValidator() == false){
            session_start();
            $_SESSION['prompt'] = "The username you entered is already taken!";
            header('location: ../prompt.php');
            exit();
        }

        if($this->companyValidator() == false){
            session_start();
            $_SESSION['prompt'] = "A company with the same name is already registered!";
            header('location: ../prompt.php');
            exit();
        }

        $this->companySubmit();
        $this->accountSubmit();

        
        
    }

    private function accountSubmit(){

        $sql = "INSERT INTO user (username, password, accessType, firstName, middleName, lastName, companyName) VALUES (:username, :password, :accessType, :firstName, :middleName, :lastName, :companyName)";


        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":username", $paramUsername, PDO::PARAM_STR);
            $stmt->bindParam(":password", $paramPassword, PDO::PARAM_STR);
            $stmt->bindParam(":accessType", $paramAccessType, PDO::PARAM_STR);
            $stmt->bindParam(":firstName", $paramFirstName, PDO::PARAM_STR);
            $stmt->bindParam(":middleName", $paramMiddleName, PDO::PARAM_STR);
            $stmt->bindParam(":lastName", $paramLastName, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);

            $paramUsername = $this->username;
            $paramPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $paramAccessType = 'Admin';
            $paramFirstName = 'Company';
            $paramMiddleName = 'Admin';
            $paramLastName = 'Account';
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                session_start();
                $_SESSION ["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
            } else{
               session_start();
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function companySubmit(){

        $sql = "INSERT INTO company (companyName, companyEmail, companyNumber, companyAddress, region, province, city, barangay) VALUES (:companyName, :companyEmail, :companyNumber, :companyAddress, :region, :province, :city, :barangay)";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            $stmt->bindParam(":companyEmail", $paramCompanyEmail, PDO::PARAM_STR);
            $stmt->bindParam(":companyNumber", $paramCompanyNumber, PDO::PARAM_STR);
            $stmt->bindParam(":companyAddress", $paramCompanyAddress, PDO::PARAM_STR);
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
            

            if($stmt->execute()){

            } else{
               session_start();
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function emptyValidator(){
        if(empty(trim($this->username)) || empty(trim($this->password)) || empty(trim($this->companyName)) || empty(trim($this->companyEmail)) || empty(trim($this->companyNumber)) || empty(trim($this->companyAddress)) || empty(trim($this->region)) || empty(trim($this->province)) || empty(trim($this->city)) || empty(trim($this->barangay)) ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function lengthValidator(){
        if(strlen(trim($this->username)) < 6 && strlen(trim($this->username)) > 30 && strlen(trim($this->password)) < 6 && strlen(trim($this->password)) > 20 && strlen(trim($this->companyName)) < 1 && strlen(trim($this->companyName)) > 255 && strlen(trim($this->companyNumber)) != 8 && strlen(trim($this->companyNumber)) != 11 && strlen(trim($this->companyAddress)) < 1 && strlen(trim($this->companyAddress)) > 100 ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function patternValidator(){
        if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($this->username)) || !preg_match('/(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/', trim($this->companyEmail)) || !preg_match('/^[0-9]+$/', trim($this->companyNumber)) || !preg_match('/^[a-zA-Z0-9 ]+$/', trim($this->companyAddress)) ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    public function usernameValidator(){
        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();
    
        $sql = "SELECT * FROM user WHERE username = :username";
            
        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":username", $paramUsername, PDO::PARAM_STR);
            
            $paramUsername = $this->username;

            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $result = false;
                }
                else{
                    $result = true;
                }
    
            } else{
                session_start();
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }
    
            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }

    public function companyValidator(){
        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();
    
        $sql = "SELECT * FROM company WHERE companyName = :companyName";
            
        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":companyName", $paramCompany, PDO::PARAM_STR);
            
            $paramCompany = $this->companyName;

            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $result = false;
                }
                else{
                    $result = true;
                }
    
            } else{
                session_start();
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();
            }
    
            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }

    private function regionConverter($regionCode){

        $json = file_get_contents('../json/refregion.json');
        $jsonData = json_decode($json, true);
    
        for ($i = 0; $i <= count($jsonData); $i++) {
            if($jsonData[$i]['regCode'] == $regionCode){
                $regionVal = $jsonData[$i]['regDesc'];
                return $regionVal;
                break;
            }
        }
    }
    private function provinceConverter($provinceCode){

        $json = file_get_contents('../json/refprovince.json');
        $jsonData = json_decode($json, true);
    
        for ($i = 0; $i <= count($jsonData); $i++) {
            if($jsonData[$i]['provCode'] == $provinceCode){
                $provinceVal = $jsonData[$i]['provDesc'];
                return $provinceVal;
                break;
            }
        }
    }
    private function cityConverter($cityCode){

        $json = file_get_contents('../json/refcitymun.json');
        $jsonData = json_decode($json, true);
    
        for ($i = 0; $i <= count($jsonData); $i++) {
            if($jsonData[$i]['citymunCode'] == $cityCode){
                $cityVal = $jsonData[$i]['citymunDesc'];
                return $cityVal;
                break;
            }
        }
    }
    private function barangayConverter($barangayCode){

        $json = file_get_contents('../json/refbrgy.json');
        $jsonData = json_decode($json, true);
    
        for ($i = 0; $i <= count($jsonData); $i++) {
            if($jsonData[$i]['brgyCode'] == $barangayCode){
                $barangayVal = $jsonData[$i]['brgyDesc'];
                return $barangayVal;
                break;
            }
        }
    }
}