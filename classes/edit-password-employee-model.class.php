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

        $sql = "UPDATE employee
                SET 
                password = :password
                WHERE employee_id = :employee_id";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":employee_id", $param1, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param2, PDO::PARAM_STR);

            
            $param1 = $_SESSION["employeeId"];
            $param2 = password_hash($this->passwordEdit, PASSWORD_DEFAULT);

            if($stmt->execute()){
                $_SESSION["password"] = $param2;
                echo "Successfully changed password!";
            } else{
               
                //$_SESSION ["prompt"] = "Something went wrong!";
                //header('location: ../modal-prompt.php');
                //exit();
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