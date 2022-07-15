<?php

require_once "../config.php";

class DeleteEmployeeModel{
    private $usernameDelete;
    
    public function __construct( $usernameDelete){
        $this->usernameDelete = $usernameDelete;
    }

    public function deleteEmployeeRecord(){
        $this->deleteEmployeeSubmit();
    }

    public function deleteEmployeeSubmit(){

        $sql = "DELETE FROM employee WHERE username = :username";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":username", $paramUsernameDelete, PDO::PARAM_STR);

            $paramUsernameDelete = $this->usernameDelete;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
                echo "Something went wrong, unable to delete employee account!";
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}