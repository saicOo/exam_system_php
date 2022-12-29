<?php
session_start();
include_once  "./init.php";
function __autoload($class){
    require "controllers/".$class.".php";
}

if(isset($_GET['ref'])){
    $ref =$_GET['ref'];
    $subject = new Subject;
    $exam = new Exam;
    $showExam = $exam->show($ref);
    $question = new Question;
    $showQuestion = $question->show($ref);
if(isset($_POST['submitRand'])){
    $request = array(
        'exam_id'=> $_POST['exam_id'],
        'subject_id'=> $ref,
    );
    $subject->storeEQRand($request);
}
if(isset($_POST['submit'])){
    $request = array(
        'exam_id'=> $_POST['exam_id'],
        'question_id'=> $_POST['question_id'],
    );
    $subject->storeEQ($request);
}
}

        // start header area
require_once "./layouts/header.php";
?>
<section>
<div class="container py-5">
<div class="card text-white bg-dark">
  <h5 class="card-header">Add questions for exams</h5>
  <div class="card-body">
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
  <form method="POST" autocomplete="off">
  <div class="form-group">
        <select name="exam_id" class="form-control">
        <option value="">Select Exam</option>
        <?php foreach($showExam as $item): ?>
            <option value="<?php echo $item['exam_id'] ?>"><?php echo $item['exam_title'] ?></option>
        <?php endforeach ?>																
		</select>
</div>
  <div class="form-group">
        <select name="question_id" class="form-control">
        <option value="">Select Question</option>
        <?php foreach($showQuestion as $item): ?>
            <option value="<?php echo $item['question_id'] ?>"><?php echo $item['question_title'] ?></option>
        <?php endforeach ?>																			
		</select>
</div>
  <button name="submit" type="submit" class="btn btn-primary">Add</button>
  <button name="submitRand" type="submit" class="btn btn-info">Random Add</button>
</form>
  </div>
</div>

</div>
</section>

<?php
 //start footer area 
require_once "./layouts/footer.php"; ?>
       
