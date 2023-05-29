<?php

class Login extends Conn {

    protected function getUser($username, $password) {
        $stmt = $this->connect()->prepare('SELECT password FROM users WHERE username = ? or email = ? ;');


        if (!$stmt->execute(array($username, $password))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();

        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=usernotfound1");
            exit();
        }
        
        $passHash = $stmt->fetchAll();
        $checkPass = password_verify($password, $passHash[0]["password"]);

        if($checkPass == false){
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        }elseif ($checkPass == true) {
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE username = ? or email = ? AND password = ?;');

            if (!$stmt->execute(array($username, $username, $password))) {
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0){
                $stmt = null;
                header("location: ../index.php?error=usernotfound2");
                exit();
            }

            $user = $stmt->fetchAll();
            session_start();
            $_SESSION["userID"] = $user[0]["ID"];
            $_SESSION["userName"] = $user[0]["username"];
        }


        $stmt = null;
        
    }

}

?>