<?php
include '../include/autoloader.php';

if(isset($_POST["submit"]))
{
    //Get Post data
    $Username = $_POST["username"];
    $Password = $_POST["password"];
    $PassRepeat = $_POST["passrepeat"];
    $Email = $_POST["email"];

    $signup = new SignupController($Username, $Password, $PassRepeat, $Email);
    //Error Handlers
    $signup->doSignup();
    //Redirect to front page
    header("location: ../index.php?error=created");
}

?>