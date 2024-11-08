<?php
include '../include/autoloader.php';
if(isset($_POST["submit"]))
{
    //Get Post data
    echo $Username = $_POST["username"];
    echo $Password = $_POST["password"];

    $login = new LoginController($Username, $Password);
    //Error Handlers
    $login->doLogin();
    //Redirect to front page
    header("location: ../main.php");
}

?>