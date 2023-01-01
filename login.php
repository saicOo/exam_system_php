<?php
session_start();
include_once  "./init.php";
function __autoload($class){
    require "Controllers/".$class.".php";
}

Auth::checkAuth();

if(isset($_POST['submit'])){
    $request = array(
        'email'=> $_POST['email'],
        'password'=> $_POST['password'],
    );
    $admin = new Admin;
    $admin->login($request);
}

        // start header area
require_once "./layouts/header.php"; 
?>
<section>
<div class="container py-5">
<div class="card text-white bg-dark">
  <h5 class="card-header">Login</h5>
  <div class="card-body">
  <?php if(!empty($admin->messErrors)): ?>
            <div class="container">
        <div class="alert alert-warning alert-success-style3 alert-success-stylenone">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
					<span class="icon-sc-cl" aria-hidden="true">×</span>
				</button>
            <?php foreach($admin->messErrors as $errors): ?>
            <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro admin-check-pro-none" aria-hidden="true"></i>
            <p class="message-alert-none text-center"><strong>Warning!</strong> <?php echo  $errors ?></p>
            <?php endforeach ?>
        </div>
        </div>
        <?php endif ?>
  <form method="POST" autocomplete="off">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button name="submit" type="submit" class="btn btn-primary">Login</button>
</form>
  </div>
</div>

</div>
</section>


<?php
 //start footer area 
require_once "./layouts/footer.php"; ?>
       
