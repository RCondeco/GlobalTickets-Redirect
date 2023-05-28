<?php

class Signup extends Conn {

    protected function createUser($username, $password,$email) {
        $stmt = $this->connect()->prepare('INSERT INTO users(username, password, email) VALUES(?, ?, ?);');

        $hashPass = password_hash($password, PASSWORD_DEFAULT);


        if (!$stmt->execute(array($username, $hashPass, $email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();

        }
        $stmt = null;
        
    }

    
    protected function checkUser($username, $email) {
        $stmt = $this->connect()->prepare('SELECT username FROM users WHERE username = ? OR email = ?;');

        if (!$stmt->execute(array($username, $email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();

        }

        $return;
        if ($stmt->rowCount() > 0) {
            $return = false;
        }else{
            $return = true;
        }

        return $return;
    }

}

?>