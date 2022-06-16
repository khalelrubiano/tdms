<?php

if ( !isset($_SESSION) ) {
    session_start();
}

require_once "../config.php";

class EditPasswordModel{

    private $passwordEdit;


    public function __construct(
        $passwordEdit, 
        ){
        $this->passwordEdit = $passwordEdit;
    }

    public function editPasswordRecord(){
/*
        if($this->emptyValidator() == false || $this->lengthValidator() == false){
            
            $_SESSION['prompt'] = "The information you entered are not valid!";
            header('location: ../modal-prompt.php');
            exit();
        }
*/
        $this->editPasswordSubmit();
    }

    private function editPasswordSubmit(){

        $sql = "UPDATE user
                SET 
                password = :password
                WHERE username = :username AND companyName = :companyName";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":username", $paramUsernameEdit, PDO::PARAM_STR);
            $stmt->bindParam(":password", $paramPasswordEdit, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramUsernameEdit = $_SESSION["username"];
            $paramPasswordEdit = password_hash($this->passwordEdit, PASSWORD_DEFAULT);
            $paramCompanyName = $_SESSION["companyName"];

            if($stmt->execute()){
                $_SESSION["password"] = $paramPasswordEdit;
                echo "Successfully changed password!";
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
        if(empty(trim($this->passwordEdit))){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function lengthValidator(){
        if(strlen(trim($this->passwordEdit)) < 6 && strlen(trim($this->passwordEdit)) > 20){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
}