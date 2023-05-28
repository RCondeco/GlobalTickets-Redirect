<?php
include '/include/autoloader.php';
if(isset($_POST["submit"]))
{
    //Get Post data
    $Username = $_POST["username"];
    $Password = $_POST["password"];

    $login = new LoginController($Username, $Password);
    //Error Handlers
    $login->doLogin();
    //Redirect to front page
    header("location: ../index.php?error=none");
}

?>