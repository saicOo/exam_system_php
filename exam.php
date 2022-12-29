<?php
session_start();
include_once  "./init.php";
function __autoload($class){
    require "controllers/".$class.".php";
}

$exam = new Exam;
    $disblayExam = $exam->display();
    $subject = new Subject;
    $disblaySub = $subject->display();
if(isset($_POST['submit'])){
    $request = array(
        'exam_title'=> $_POST['exam_title'],
        'sub_id'=> $_POST['sub_id'],
    );
    $exam->store($request);
}
if (isset($_GET['destroy'])) {
  $destroy = $_GET['destroy'];
  $exam->destroy($destroy);
}
        // start header area
require_once "./layouts/header.php"; 
?>
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
        <select name="sub_id" class="form-control">
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
          <?php foreach($disblayExam as $item): 
            $quesCuont =  $exam->questionCount($item['exam_id'])['c'];
            ?>
            <tr>
            <td><?php echo $item['exam_title'] ?></td>
            <td><?php echo $quesCuont ?></td>
            <td><a  class="btn btn-success" href="/<?php echo $root_path ?>/start_exam.php?ref=<?php echo $item['exam_id'].'&page=1' ?>">start exam</a></td>
            <td><a  class="btn btn-danger" href="?destroy=<?php echo $item['exam_id']?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
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
       
