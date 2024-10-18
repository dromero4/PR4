<?php
if(session_start()){
    session_destroy();
}

header('Location:../vista/login.php');
echo "<br>Has sortit del compte";
?>