<?php

function __autoload($class){
    require "controllers/".$class.".php";
}
include_once  "./init.php";
        // start header area
require_once "./layouts/header.php"; 
?>
<div class="container">
    <h1 class="text-center text-info display-1">Welcome To Exam System</h1>
    
    
    <br>
    <!-- start step 1 -->
    <div class="card bg-dark text-white">
        <img src="./assets/images/1.png" class="card-img">
        <div class="card-img-overlay">
            <h5 class="card-title">Step 1</h5>
            <p class="card-text">1.Add subject</p>
            <p class="card-text">2.Go to qustions page</p>
        </div>
    </div>
    <!-- end step 1 -->
    <br>
    <!-- start step 2 -->
    <div class="card bg-dark text-white">
        <img src="./assets/images/2.png" class="card-img">
        <div class="card-img-overlay">
            <h5 class="card-title">Step 2</h5>
            <p class="card-text">1.Add qustions True False or Multiple choice</p>
            <p class="card-text">2.Go to exam page</p>
        </div>
    </div>
    <!-- end step 2 -->
    <br>
    <!-- start step 3 -->
    <div class="card bg-dark text-white">
        <img src="./assets/images/3.png" class="card-img">
        <div class="card-img-overlay">
            <h5 class="card-title">Step 3</h5>
            <p class="card-text">1.Add exam</p>
            <p class="card-text">2.Go back subject page</p>
        </div>
    </div>
    <!-- end step 3 -->
    <br>
    <!-- start step 4 -->
    <div class="card bg-dark text-white">
        <img src="./assets/images/4.png" class="card-img">
        <div class="card-img-overlay">
            <h5 class="card-title">Step 4</h5>
            <p class="card-text">1.Choose subject</p>
            <p class="card-text">2.Click on (Add questions to exam)</p>
        </div>
    </div>
    <!-- end step 4 -->
    <br>
    <!-- start step 5 -->
    <div class="card bg-dark text-white">
        <img src="./assets/images/5.png" class="card-img">
        <div class="card-img-overlay">
            <h5 class="card-title">Step 5</h5>
            <p class="card-text">1.Add questions to the exams manually or randomly</p>
            <p class="card-text">2.Go back exam page</p>
        </div>
    </div>
    <!-- end step 5 -->
    <br>
    <!-- start step 6 -->
    <div class="card bg-dark text-white">
        <img src="./assets/images/6.png" class="card-img">
        <div class="card-img-overlay">
            <h5 class="card-title">Step 6</h5>
            <p class="card-text">1.Choose exam</p>
            <p class="card-text">2.Click on (start exam)</p>
        </div>
    </div>
    <!-- end step 6 -->
</div>
</div> 
<br><br><br>
<?php
 //start footer area 
require_once "./layouts/footer.php"; ?>
       
