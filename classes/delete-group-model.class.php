<?php

require_once "../config.php";

class DeleteGroupModel{
    private $usernameDelete;
    
    public function __construct( $usernameDelete){
        $this->usernameDelete = $usernameDelete;
    }

    public function deleteGroupRecord(){
        $this->deleteGroupSubmit();
    }

    public function deleteGroupSubmit(){

        $sql = "DELETE FROM ownergroup WHERE group_id = :group_id";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":group_id", $paramUsernameDelete, PDO::PARAM_STR);

            $paramUsernameDelete = $this->usernameDelete;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
                echo "Something went wrong, unable to delete group!";
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}