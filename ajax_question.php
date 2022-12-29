<?php

function __autoload($class){
    require "controllers/".$class.".php";
}
    $subject = new Subject;
    $disblaySub = $subject->display();
if (isset($_POST['tests']) && $_POST['tests'] == "test2" ):?>

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
        <option value="1">option 1</option>																	
        <option value="2">option 2</option>																	
        <option value="3">option 3</option>																	
        <option value="4">option 4</option>																	
		</select>
</div>
<div class="custom-control ">
  <input class="test" type="radio" name="type" id="test1" value="test1">
  <label for="test1">Question type: True or False</label>
</div>
<div class="custom-control ">
  <input class="test" type="radio" name="type" id="test2" value="test2" checked>
  <label for="test2">Question type: Multiple choice</label>
</div>

<div class="form-group">
    <label for="option1">option 1</label>
    <input type="text" class="form-control" id="option1" name="option1">
  </div>
  <div class="form-group">
    <label for="option2">option 2</label>
    <input type="text" class="form-control" id="option2" name="option2">
  </div>
  <div class="form-group">
    <label for="option3">option 3</label>
    <input type="text" class="form-control" id="option3" name="option3">
  </div>
  <div class="form-group">
    <label for="option4">option 4</label>
    <input type="text" class="form-control" id="option4" name="option4">
  </div>

  <button name="submit" type="submit" class="btn btn-primary">Add</button>
</form>






<?php else: ?>
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
  <input class="test" type="radio" name="type" id="test1" value="test1" checked>
  <label for="test1">Question type: True or False</label>
</div>
<div class="custom-control ">
  <input class="test" type="radio" name="type" id="test2" value="test2">
  <label for="test2">Question type: Multiple choice</label>
</div>

  <button name="submit" type="submit" class="btn btn-primary">Add</button>
</form>
<?php endif ?>
