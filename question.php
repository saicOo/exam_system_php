<?php
session_start();

function __autoload($class){
    require "Controllers/".$class.".php";
}
$exam = new Exam;
    $disblayExam = $exam->display();
    $subject = new Subject;
    $disblaySub = $subject->display();
    $showSub = $subject->display();
    $question = new Question;
    $disblayQues = $question->display();
    if(isset($_GET['sub'])){
      $sub_id = $_GET['sub'];
      $disblayQues = $question->show($sub_id);
    }
if(isset($_POST['submit'])){
    if($_POST['type'] === "ques2"){
        $request = array(
            'question_title'=>  $_POST['question_title'],
            'answer_option'=>  $_POST['answer_option'],
            'option_title1'=>  $_POST['option1'],
            'option_title2'=>  $_POST['option2'],
            'option_title3'=>  $_POST['option3'],
            'option_title4'=>  $_POST['option4'],
            'sub_id'=> $_POST['sub_id'],
            'type'=> $_POST['type'],
        );
      
    }else{
        $request = array(
            'question_title'=>  $_POST['question_title'],
            'answer_option'=>  $_POST['answer_option'],
            'sub_id'=> $_POST['sub_id'],
            'type'=> $_POST['type'],
        );
    }
    $question->store($request);
}
if (isset($_GET['destroy'])) {
    $destroy = $_GET['destroy'];
    $question->destroy($destroy);
  }
        // start header area
require_once "./layouts/header.php"; 
?>
<section>
<div class="container py-5">
  <!-- start aleart area -->
  <?php if(!empty($question->messErrors)): ?>
            <div class="container">
        <div class="alert alert-warning alert-success-style3 alert-success-stylenone">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
					<span class="icon-sc-cl" aria-hidden="true">×</span>
				</button>
            <?php foreach($question->messErrors as $errors): ?>
            <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro admin-check-pro-none" aria-hidden="true"></i>
            <p class="message-alert-none text-center"><strong>Warning!</strong> <?php echo  $errors ?></p>
            <?php endforeach ?>
        </div>
        </div>
        <?php endif ?>
<div class="card text-white bg-dark">
  <h5 class="card-header">Add Question</h5>
  <div class="card-body question-form">
  <form method="POST" autocomplete="off">
  <div class="form-group">
    <label for="question_title">Question Title</label>
    <input type="text" class="form-control" id="question_title" name="question_title">
  </div>
  <div class="form-group">
  <label>subject name</label>
        <select name="sub_id" class="form-control">
        <option value="">Select Subject</option>
        <?php foreach($disblaySub as $item): ?>
            <option value="<?php echo $item['subject_id'] ?>"><?php echo $item['subject_name'] ?></option>
        <?php endforeach ?>																			
		</select>
</div>
  <div class="form-group">
  <label for="exam_title">Select option</label>
        <select name="answer_option" class="form-control">
        <option value="1">option true</option>																	
        <option value="2">option false</option>																																	
		</select>
</div>
<div class="custom-control ">
  <input class="ques-choice" type="radio" name="type" id="ques1" value="ques1" checked>
  <label for="ques1">Question type: True or False</label>
</div>
<div class="custom-control ">
  <input class="ques-choice" type="radio" name="type" id="ques2" value="ques2">
  <label for="ques2">Question type: Multiple choice</label>
</div>

  <button name="submit" type="submit" class="btn btn-primary">Add</button>
</form>
  </div>
</div>

</div>
</section>
<section>
<div class="container pb-5">
<div class="card text-white bg-dark">
  <h5 class="card-header">Display Questions</h5>
  <div class="card-body" style="height: 256px;overflow-y: scroll;">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <?php foreach($showSub as $index => $item): ?>
      <li class="nav-item">
        <a class="nav-link 
        <?php echo isset($_GET['sub']) ? $item['subject_id'] == $_GET['sub'] ? 'active' : '' : $index == 0 ? 'active' : '' ?>" 
        href="/question.php?sub=<?php echo $item['subject_id'] ?>"><?php echo $item['subject_name'] ?></a>
      </li>
      <?php endforeach ?>	
    </ul>
      <table class="table table-dark">
          <thead>
              <tr>
                  <th scope="col">Title</th>
                  <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($disblayQues as $item): ?>
            <tr>
            <td><?php echo $item['question_title'] ?></td>
            <td><a  class="btn btn-danger" href="?destroy=<?php echo $item['question_id']?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
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
<script type="text/javascript">
    $(document).on('change','.ques-choice',function(){
    changeT = $(this).val();
    $.ajax({
        method:'POST',
        url:'/ajax_question.php',
        data: {changeQues: changeT},
        success: function(data){    
            $(".question-form").html(data);
        }
    })
});
</script>