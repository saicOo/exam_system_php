<?php

function __autoload($class){
    require "controllers/".$class.".php";
}
include_once  "./init.php";
        // start header area
require_once "./layouts/header.php"; 
?>
<h1 class="text-center text-info display-1">Welcome To Exam System</h1>

<?php
 //start footer area 
require_once "./layouts/footer.php"; ?>
       
