<?php
require_once '../oauth/oauth.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $github_login = $_POST['github_login'];

    if($github_login == 'Log in with GitHub'){
        OAuth();
    }
}
?>