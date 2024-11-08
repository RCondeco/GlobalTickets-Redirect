<?php

class LoginController extends Login {

   private $username; 
   private $password; 

   public function __construct($username, $password) {

    $this->username = $username;
    $this->password = $password;
   }

   public function doLogin() {
    if ($this->emptyInputs() == false) {
        //Inputs are empty
        header("location: ..index.php?error=emptyinput");
        exit();
    }

    $this->getUser($this->username, $this->password);
   }

   //Error Handlers
   private function emptyInputs() {


    if(empty($this->username || $this->password)){
        $return = false;
    }else{
        $return = true;
    }

    return $return;
   }


}

?>