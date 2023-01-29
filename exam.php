<?php
session_start();
include_once  "./init.php";
function __autoload($class){
    require "Controllers/".$class.".php";
}
$traffic = new Traffic;
$traffic->increaseTraffic();
$exam = new Exam;
$disblayExam = $exam->display();
if(isset($_POST['exam_id'])){
  $revision = new Revision;
      $exam->updateStatusExam($_POST['exam_id'],2);
      $revision->revisionsEmpty($_POST['exam_id']);
}
if(isset($_SESSION['exam_id'])){
  $revision = new Revision;
      $exam->updateStatusExam($_SESSION['exam_id'],2);
      $revision->revisionsEmpty($_SESSION['exam_id']);
      
}
// if(isset($_COOKIE['exam_id'])){
//   $revision = new Revision;
//       $exam->updateStatusExam($_COOKIE['exam_id'],2);
//       $revision->revisionsEmpty($_COOKIE['exam_id']);
// }
    $subject = new Subject;
    $disblaySub = $subject->display();
if(isset($_POST['submit'],$_SESSION['admin'])){
    $request = array(
        'exam_title'=> $_POST['exam_title'],
        'total_question'=> $_POST['total_question'],
        'sub_id'=> $_POST['sub_id'],
    );
    $exam->store($request);
}
if(isset($_POST['subscribe'])){
    $request = array(
        'message'=> $_POST['message'],
    );
    $subscribe = new Subscribe;
    $subscribe->store($request);
}
if (isset($_GET['destroy'],$_SESSION['admin'])) {
  $destroy = $_GET['destroy'];
  $exam->destroy($destroy);
}
        // start header area
require_once "./layouts/header.php"; 
?>
<?php if(isset($_SESSION['admin'])): ?>
<section>
<div class="container py-5">
<div class="card text-white bg-dark">
  <h5 class="card-header">Add Exam</h5>
  <div class="card-body">
  <form method="POST" autocomplete="off">
  <div class="form-group">
    <label for="exam_title">Exam Title</label>
    <input type="text" class="form-control" id="exam_title" name="exam_title">
  </div>
  <div class="form-group">
    <label for="total_question">Number Questions</label>
    <input type="number" class="form-control" id="total_question" name="total_question">
  </div>
  <div class="form-group">
  <label for="subject">Select Subject</label>
        <select name="sub_id" class="form-control" id="subject">
        <option value="">Select Subject</option>
        <?php foreach($disblaySub as $item): ?>
            <option value="<?php echo $item['subject_id'] ?>"><?php echo $item['subject_name'] ?></option>
        <?php endforeach ?>																			
		</select>
</div>
  <button name="submit" type="submit" class="btn btn-primary">Add</button>
</form>
  </div>
</div>

</div>
</section>
<?php endif; ?>
<!-- start subscribe -->
<section>
<div class="container py-5">
<div class="card text-white bg-dark">
  <div class="card-body">
  <?php if(!empty($subscribe->messErrors)): ?>
            <div class="container">
        <div class="alert alert-warning alert-success-style3 alert-success-stylenone">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
					<span class="icon-sc-cl" aria-hidden="true">×</span>
				</button>
            <?php foreach($subscribe->messErrors as $errors): ?>
            <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro admin-check-pro-none" aria-hidden="true"></i>
            <p class="message-alert-none text-center"><strong>Warning!</strong> <?php echo  $errors ?></p>
            <?php endforeach ?>
        </div>
        </div>
        <?php endif ?>
  <form class="form-inline justify-content-center" method="POST" autocomplete="off">
  <div class="form-group mx-sm-3 mb-2" style="width: 60%;">
    <label for="inputSubscribe" class="sr-only">Subscribe</label>
    <input type="text" class="form-control" name="message" id="inputSubscribe" placeholder="message..." style="width: 100%;" required>
  </div>
  <button type="submit" name="subscribe" class="btn btn-warning mb-2">Send</button>
</form>
  </div>
</div>

</div>
</section>
<!-- end subscribe -->
<br>
<section>
<div class="container">
<div class="card text-white bg-dark">
  <h5 class="card-header">Display Exams</h5>
  <div class="card-body">
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Count Question</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          <?php foreach($disblayExam as $item): ?>
            <tr>
            <td><?php echo $item['exam_title'] ?></td>
            <td><?php echo $item['total_question'] ?></td>
            <?php if($item['status'] != 2): ?>
              <td><a  class="btn btn-success disabled" href="#">wait...</a></td>
              <?php else: ?>
                <td><a  class="btn btn-success" href="<?php echo $root_path ?>/start_exam.php?ref=<?php echo $item['exam_id'].'&page=1' ?>">start exam</a></td>
                <?php endif; ?>
                <?php if(isset($_SESSION['admin'])): ?>
                  <td><a  class="btn btn-danger" href="?destroy=<?php echo $item['exam_id']?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                  <?php if($item['status'] == 1): ?>
                  <td> 
                    <form method="post">
                      <input type="hidden" name="exam_id" value="<?php echo $item['exam_id']?>">
                    <button type="submit" class="btn btn-info"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                  </form>
                  </td>
                  <?php endif; ?>
                  <?php endif; ?>
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
       
