<?php
session_start();
function __autoload($class){
    require "./Controllers/".$class.".php";
}

$exam = new Exam;
if(isset($_GET['ref'])){
    
    $exam_id = $_GET['ref'];
    $total_questions = $exam->totalQuestions($exam_id);
    $revision = new Revision;
    $revision->satartExam($exam_id);
    if(isset($_SESSION['exam_id']) && $exam_id != $_SESSION['exam_id']){
            $exam->updateStatusExam($_SESSION['exam_id'],2);
            $revision->revisionsEmpty($_SESSION['exam_id']);
            header("location:$root_path/exam.php");
            exit;
      }
    // if(!isset($_COOKIE["exam_id"])) setcookie("exam_id", $exam_id, time() + (86400 * 7), "/");
    if(!isset($_SESSION["exam_id"])) $_SESSION["exam_id"] = $exam_id;
 // **********************************************************//
// ******** Make sure to return to the start page ******** //
    $page = isset($_GET['page'])?$_GET['page']:1;
    // **********************************************************//
// ******** show single question index of exam and page ******** //
    $question = $exam->showQuestion($exam_id,$page);
    if(!$question){
        header("location:$root_path/subject.php");
        exit;
    }
    $exam->updateStatusExam($exam_id,1);
    $ques_id = $question['question_id'];
    $ques_type = $question['question_type'];
    $option = $exam->option($ques_id);
}
// **********************************************************//
// ******** Go to the next page and save the answer ******** //
if(isset($_POST['next'])){
    $exam_id = $_GET['ref'];
    $page = $_GET['page'];
    $option =  $_POST['option'];
    $exam->saveAnswarNext($exam_id,$page,$ques_id,$option);
}
// **********************************************************//
// ******** Go to the previous page and save the answer ******** //
if(isset($_POST['prev'])){
    $exam_id = $_GET['ref'];
    $page = $_GET['page'];
    $option =  $_POST['option'];
    $exam->saveAnswarPrev($exam_id,$page,$ques_id,$option);
}

#########################################################
        // <!-- start header area -->
require_once "./layouts/header.php"; 
############################################################
?>
<style>

.question{
    width: 75%;
}
.options{
    position: relative;
    padding-left: 40px;
}
#options label{
    display: block;
    margin-bottom: 15px;
    font-size: 14px;
    cursor: pointer;
}
.options input{
    opacity: 0;
}
.checkmark {
    position: absolute;
    top: -1px;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #04091e;
    border: 1px solid #ddd;
    border-radius: 50%;
}
.options input:checked ~ .checkmark:after {
    display: block;
}
.options .checkmark:after{
    content: "";
	width: 10px;
    height: 10px;
    display: block;
	background: white;
    position: absolute;
    top: 50%;
	left: 50%;
    border-radius: 50%;
    transform: translate(-50%,-50%) scale(0);
    transition: 300ms ease-in-out 0s;
}
.options input[type="radio"]:checked ~ .checkmark{
    background: #21bf73;
    transition: 300ms ease-in-out 0s;
}
.options input[type="radio"]:checked ~ .checkmark:after{
    transform: translate(-50%,-50%) scale(1);
}
.btn-primary{
    background-color: #04091e;
    color: #ddd;
    border: 1px solid #ddd;
}
.btn-primary:hover{
    background-color: #21bf73;
    border: 1px solid #21bf73;
}
.btn-success{
    padding: 5px 25px;
    background-color: #21bf73;
}
@media(max-width:576px){
    .question{
        width: 100%;
        word-spacing: 2px;
    } 
}
</style>

<section class="whole-wrap mb-30" style="direction: rtl">
<div class="container q mt-sm-5 my-1">
    <div class="text-right">
        <span class="text-right border border-danger p-2"><?php echo $page . ' : ' .  $total_questions ?></span>
    </div>
    <div class="question ml-sm-5 pl-sm-5 pt-2">
        <div class="py-2 mb-4 h4"><b><?php echo $question['question_title'] ?></b></div>
        <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3" id="options">
            <form method="post" autocomplete="off">
            <label class="options"><?php echo $option[0]['option_title'] ?>
                <input type="radio" name="option" value="<?php echo $option[0]['option_number'] ?>"
                 <?php if( $exam->checkOption($question['question_id'],$exam_id) == $option[0]['option_number']) echo "checked"  ?> >
                <span class="checkmark"></span>
            </label>
            <label class="options"><?php echo $option[1]['option_title'] ?>
                <input type="radio" name="option" value="<?php echo $option[1]['option_number'] ?>"
                <?php if( $exam->checkOption($question['question_id'],$exam_id) == $option[1]['option_number']) echo "checked"  ?>>
                <span class="checkmark"></span>
            </label>
            <?php if($ques_type == "multiple choice"): ?>
            <label class="options"><?php echo $option[2]['option_title'] ?>
                <input type="radio" name="option" value="<?php echo $option[2]['option_number'] ?>"
                <?php if( $exam->checkOption($question['question_id'],$exam_id) == $option[2]['option_number']) echo "checked"  ?>>
                <span class="checkmark"></span>
            </label>
            <label class="options"><?php echo $option[3]['option_title'] ?>
                <input type="radio" name="option" value="<?php echo $option[3]['option_number'] ?>"
                <?php if( $exam->checkOption($question['question_id'],$exam_id) == $option[3]['option_number']) echo "checked"  ?>>
                <span class="checkmark"></span>
            </label>
            <?php endif ?>
        </div>
    </div>
    <div class="d-flex align-items-center pt-3">
        <div id="prev">
            <a href="/result.php?ref=<?php echo $exam_id ?>" class="btn btn-primary">Finish</a>
            <button name="prev" class="btn btn-primary">Previous</button>
        </div>
        <div class="ml-auto mr-sm-5">
            <button name="next" class="btn btn-success">Next</button>
        </div>
    </div>
    </form>
</div>
</section>

        <!-- start footer area -->
        <?php  require_once "./layouts/footer.php"; ?>
        <!-- end footer area -->

