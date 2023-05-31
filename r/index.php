<?php
include_once '../classes/conn.class.php';
if (isset($_GET['error'])) {

    exit();
} else {

    if (isset($_GET['r'])) {
        $stmt = $pdo->connect()->prepare('SELECT Long_URL FROM url WHERE Short_URL = ?;');

        $short = $_GET['r'];


        if (!$stmt->execute(array($short))) {
            $stmt = null;
            header("location: /index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: /index.php?error=urlnotfound");
            exit();
        }
        $short = $stmt->fetchAll();
        header("location: " . $short[0]['Long_url']);
    }
}
