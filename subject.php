<?php
session_start();

function __autoload($class){
    require "Controllers/".$class.".php";
}
include_once  "./init.php";
new Auth;
$subject = new Subject;
    $disblaySub = $subject->display();
if(isset($_POST['submit'])){
    $request = array(
        'subject_name'=> $_POST['subject_name'],
    );
    $subject->store($request);
}
if (isset($_GET['destroy'])) {
  $destroy = $_GET['destroy'];
  $subject->destroy($destroy);
}
        // start header area
require_once "./layouts/header.php"; 
?>
<section>
<div class="container py-5">
    <!-- start aleart area -->
    <?php if(!empty($subject->messErrors)): ?>
            <div class="container">
        <div class="alert alert-warning alert-success-style3 alert-success-stylenone">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
					<span class="icon-sc-cl" aria-hidden="true">×</span>
				</button>
            <?php foreach($subject->messErrors as $errors): ?>
            <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro admin-check-pro-none" aria-hidden="true"></i>
            <p class="message-alert-none text-center"><strong>Warning!</strong> <?php echo  $errors ?></p>
            <?php endforeach ?>
        </div>
        </div>
        <?php endif ?>
        <!-- start aleart area -->
<div class="card text-white bg-dark">
  <h5 class="card-header">Add Subject</h5>
  <div class="card-body">
  <form method="POST" autocomplete="off">
  <div class="form-group">
    <label for="name">Subject Name</label>
    <input type="text" class="form-control" id="name" name="subject_name">
  </div>
  <button name="submit" type="submit" class="btn btn-primary">Add</button>
</form>
  </div>
</div>

</div>
</section>
<section>
<div class="container">
<div class="card text-white bg-dark">
  <h5 class="card-header">Display Subjects</h5>
  <div class="card-body">
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          <?php foreach($disblaySub as $item): ?>
            <tr>
            <td><?php echo $item['subject_name'] ?></td>
            <td><a href="<?php echo $root_path ?>/e&q.php?ref=<?php echo $item['subject_id']?>" class="btn btn-success" title="Add questions for exams">Add questions to exam</a></td>
            <td><a  class="btn btn-danger" href="?destroy=<?php echo $item['subject_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
            </tr>
            <?php endforeach ?>
        </tbody>
        </table>
</div>
</div>
</div>
</section>


<?php
 //start footer area 
require_once "./layouts/footer.php"; ?>
       
