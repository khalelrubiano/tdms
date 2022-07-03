<?php

require_once "../config.php";

class DeleteUserModel{
    private $usernameDelete;
    
    public function __construct( $usernameDelete){
        $this->usernameDelete = $usernameDelete;
    }

    public function deleteUserRecord(){
        $this->deleteUserSubmit();
    }

    public function deleteUserSubmit(){

        $sql = "DELETE FROM user WHERE user_name = :user_name";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":user_name", $paramUsernameDelete, PDO::PARAM_STR);

            $paramUsernameDelete = $this->usernameDelete;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
                echo "Something went wrong, unable to delete user account!";
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}