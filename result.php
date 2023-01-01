<?php
include_once  "./init.php";
function __autoload($class){
    require "Controllers/".$class.".php";
}

$revision = new Revision;
$exam = new Exam;
if(isset($_GET['empty'])){
    header("location:$root_path/exam.php");
        exit;
}
if(isset($_GET['ref'])){
    $exam_id = $_GET['ref'];
    $question = new Question;
    $result =  $revision->resultStudent($exam_id);
    $resultTotal =  $revision->totalResult($exam_id);
}

        // start header area
require_once "./layouts/header.php"; 
?>

<section>
<div class="container py-4">
<div class="card text-white bg-dark">
  <h5 class="card-header">Name Exam : <?php echo $resultTotal['exam_title'] ?></h5>
  <div class="card-body">
      <h6>Result Exam : <?php echo $resultTotal['total_ques'] . " Of " . $resultTotal['mark'] ?></h6>
      <table class="table">
          <thead>
              <tr>
                    <th>Question Title</th>
                    <th>Your Answar</th>
                    <th>Mark</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($result as $item): 
                $option =$question->displayOption($item['question_id']);
                $answar = isset($option[$item['answar_option']-1]['option_title'])? $option[$item['answar_option']-1]['option_title'] : "No answar"
                ?>
                <tr>
                    <td><?php echo $item['question_title'] ?></td>
                    <td><?php echo $answar ?></td>
                    <?php if($item['marks'] == "1 mark"): ?>
                        <td class="text-success"><?php echo $item['marks'] ?></td>
                    <?php else: ?>
                    <td class="text-danger" ><?php echo $item['marks'] ?></td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
        </table>
        <a href="?ref=<?php echo $exam_id ?>&empty=" class="btn btn-danger">Finished</a>
</div>
</div>
</div>
</section>


<?php
 //start footer area 
require_once "./layouts/footer.php"; 

if(isset($_GET['ref'])){
    $exam_id = $_GET['ref'];
    $exam->updateStatusExam($exam_id,0);
    $revision->revisionsEmpty($exam_id);
}
?>
       
