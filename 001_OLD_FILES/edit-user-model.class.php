<?php

if ( !isset($_SESSION) ) {
    session_start();
}

require_once "../config.php";

class EditUserModel{
    private $usernameEdit;
    private $passwordEdit;
    private $accessTypeEdit;
    private $firstNameEdit;
    private $middleNameEdit;
    private $lastNameEdit;
    private $companyName;

    public function __construct(
        $usernameEdit, 
        $passwordEdit, 
        $accessTypeEdit,
        $firstNameEdit,
        $middleNameEdit,
        $lastNameEdit,
        $companyName
        ){

        $this->usernameEdit = $usernameEdit;
        $this->passwordEdit = $passwordEdit;
        $this->accessTypeEdit = $accessTypeEdit;
        $this->firstNameEdit = $firstNameEdit;
        $this->middleNameEdit = $middleNameEdit;
        $this->lastNameEdit = $lastNameEdit;
        $this->companyName = $companyName;

    }

    public function editUserRecord(){

        if($this->emptyValidator() == false || $this->lengthValidator() == false || $this->patternValidator() == false ){
            
            $_SESSION['prompt'] = "The information you entered are not valid!";
            header('location: ../modal-prompt.php');
            exit();
        }

        $this->editUserSubmit();
    }

    private function editUserSubmit(){

        $sql = "UPDATE user
                SET 
                password = :password, 
                accessType = :accessType,
                firstName = :firstName, 
                middleName = :middleName,
                lastName = :lastName
                WHERE username = :username AND companyName = :companyName";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":username", $paramUsernameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":password", $paramPasswordEdit, PDO::PARAM_STR);
            $stmt->bindParam(":accessType", $paramAccountTypeEdit, PDO::PARAM_STR);
            $stmt->bindParam(":firstName", $paramFirstNameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":middleName", $paramMiddleNameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":lastName", $paramLastNameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramUsernameEdit = $this->usernameEdit;
            $paramPasswordEdit = password_hash($this->passwordEdit, PASSWORD_DEFAULT);
            $paramAccountTypeEdit = $this->accessTypeEdit;
            $paramFirstNameEdit = $this->firstNameEdit;
            $paramMiddleNameEdit = $this->middleNameEdit;
            $paramLastNameEdit = $this->lastNameEdit;
            $paramCompanyName = $this->companyName;

            if($_SESSION["username"] == $this->usernameEdit){
                $_SESSION["accessType"] = $this->accessTypeEdit;
            }
            
            

            if($stmt->execute()){

            } else{
               
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function emptyValidator(){
        if(empty(trim($this->usernameEdit)) || empty(trim($this->passwordEdit)) || empty(trim($this->accessTypeEdit))|| empty(trim($this->firstNameEdit))|| empty(trim($this->middleNameEdit))|| empty(trim($this->lastNameEdit))){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function lengthValidator(){
        if(strlen(trim($this->usernameEdit)) < 6 && strlen(trim($this->usernameEdit)) > 20 && 
        strlen(trim($this->passwordEdit)) < 6 && strlen(trim($this->passwordEdit)) > 20 &&
        strlen(trim($this->firstNameEdit)) < 1 && strlen(trim($this->firstNameEdit)) > 255 &&
        strlen(trim($this->middleNameEdit)) < 1 && strlen(trim($this->middleNameEdit)) > 255 &&
        strlen(trim($this->lastNameEdit)) < 1 && strlen(trim($this->lastNameEdit)) > 255){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function patternValidator(){
        if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($this->usernameEdit)) || !preg_match('/^[a-zA-Z\s]+$/', trim($this->firstNameEdit)) || !preg_match('/^[a-zA-Z\s]+$/', trim($this->middleNameEdit))|| !preg_match('/^[a-zA-Z\s]+$/', trim($this->lastNameEdit)) ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
}