<?php

require_once "../config.php";

class DeleteUserModel{
    private $usernameDelete;
    private $companyName;

    public function __construct( $usernameDelete, $companyName){
        $this->usernameDelete = $usernameDelete;
        $this->companyName = $companyName;
    }

    public function deleteUserRecord(){
        $this->deleteUserSubmit();
    }

    public function deleteUserSubmit(){

        $sql = "DELETE FROM user WHERE username = :username AND companyName = :companyName";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":username", $paramUsernameDelete, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);

            $paramUsernameDelete = $this->usernameDelete;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
               session_start();
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}