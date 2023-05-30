<?php
include_once '../classes/conn.class.php';
class Url extends Conn {
    protected function readUserURL($uid) {
        $stmt = $this->connect()->prepare('SELECT Long_URL, Short_URL, ID FROM url WHERE User_ID = ?;');

        if (!$stmt->execute(array($uid))) {
            $stmt = null;
            header("location: ../main.php?error=stmtfailed");
            exit();
        }
        $return = $stmt->fetchAll();
        return $return;
    }

    protected function createURL($long_url, $uid) {
        //Prepare the statment for creating the new short url
        $stmt = $this->connect()->prepare('INSERT INTO url(Long_URL, Short_URL, User_ID) VALUES(?, ?, ?);');

        $number=rand(0,99999);
        $short_url=base_convert($number,20,36);
        if (!$stmt->execute(array($long_url, $short_url, $uid))) {
            $stmt = null;
            header("location: ../main.php?error=stmtfailed");
            exit();

        }
        $stmt = null;
        
    }

    
  
    protected function updateUserURL($short_url, $long_url, $url_id){
        $stmt = $this->connect()->prepare('UPDATE url SET Long_Url = ?, Shor_URL = ? WHERE ID = ?');
        if (!$stmt->execute(array($long_url, $short_url, $url_id))) {
            $stmt = null;
            header("location: ../main.php?error=stmtfailed");
            exit();

        }

    }

    protected function deleteUserURL($url_id, $uid){
        $stmt = $this->connect()->prepare('DELETE FROM url WHERE ID = ? and User_ID = ?');
        if (!$stmt->execute(array($url_id, $uid))) {
            $stmt = null;
            header("location: ../main.php?error=stmtfailed");
            exit();

        }
    }
}