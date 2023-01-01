<?php
session_start();

function __autoload($class){
    require "Controllers/".$class.".php";
}
include_once  "./init.php";
new Auth;
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
    if($_POST['type'] === "test2"){
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
<div class="card text-white bg-dark">
  <h5 class="card-header">Add Question</h5>
  <div class="card-body xxx">
  <form method="POST" autocomplete="off">
  <div class="form-group">
    <label for="question_title">Question Title</label>
    <input style="direction: rtl" type="text" class="form-control" id="question_title" name="question_title">
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
  <input class="test" type="radio" name="type" id="test1" value="test1" checked>
  <label for="test1">Question type: True or False</label>
</div>
<div class="custom-control ">
  <input class="test" type="radio" name="type" id="test2" value="test2">
  <label for="test2">Question type: Multiple choice</label>
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
      <table class="table table-dark">
      <ul class="nav justify-content-center">
      <?php foreach($showSub as $item): ?>
  <li class="nav-item">
    <a class="nav-link text-warning" href="<?php echo $root_path ?>/question.php?sub=<?php echo $item['subject_id'] ?>"><?php echo $item['subject_name'] ?></a>
  </li>
  <?php endforeach ?>		
</ul>
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
    $(document).on('change','.test',function(){
    changeT = $(this).val();
    console.log(changeT);
    $.ajax({
        method:'POST',
        url:'<?php echo $root_path ?>ajax_question.php',
        data: {tests: changeT},
        success: function(data){
            console.log(data);
           
            $(".xxx").html(data);
        }
    })
});
</script>