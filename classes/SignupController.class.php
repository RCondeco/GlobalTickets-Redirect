<?php

class SignupController extends Signup {

   private $username; 
   private $password; 
   private $passwordRepeat; 
   private $email; 

   public function __construct($username, $password, $passwordRepeat, $email) {

    $this->username = $username;
    $this->password = $password;
    $this->passwordRepeat = $passwordRepeat;
    $this->email = $email;
   }

   public function doSignup() {
    if ($this->emptyInputs() == false) {
        //Inputs are empty
        header("location: ../index.php?error=emptyinput");
        exit();
    }
    if ($this->usernameValidation() == false) {
        //Username it's invalid
        header("location: ../index.php?error=username");
        exit();
    }
    if ($this->emailValidation() == false) {
        //Email it's invalid
        header("location: ../index.php?error=email");
        exit();
    }
    if ($this->passMatch() == false) {
        //Passwords don't match
        header("location: ../index.php?error=passwordmatch");
        exit();
    }
    if ($this->userExists() == false) {
        // Username/email already exists
        header("location: ../index.php?error=usertaken");
        exit();
    }

    $this->createUser($this->username, $this->password, $this->email);
   }

   //Error Handlers
   private function emptyInputs() {
    $return;

    if(empty($this->username || $this->password || $this->passwordRepeat || $this->email)){
        $return = false;
    }else{
        $return = true;
    }

    return $return;
   }

   private function usernameValidation(){

    if(!preg_match("/^[a-zA-Z0-9]*$/", $this->username)){
        $return = false;
    }else{
        $return = true;
    }

    return $return;
   }

   private function emailValidation(){
    $return;

    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
        $return = false;
    }else{
        $return = true;
    }

    return $return;
   }

   private function passMatch(){
    $return;

    if($this->password !== $this->passwordRepeat){
        $return = false;
    }else{
        $return = true;
    }

    return $return;
   }

   private function userExists(){
    $return;

    if(!$this->checkUser($this->username, $this->email)){
        $return = false;
    }else{
        $return = true;
    }

    return $return;
   }

}

?>