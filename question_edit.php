<?php
session_start();
include_once  "./init.php";
function __autoload($class){
    require "./Controllers/".$class.".php";
}

$exam = new Exam;
if(isset($_GET['question_type'])){
    $question_type = $_GET['question_type'];
    $question = new Question;
    $disblayQues = $question->displayOfType($question_type);
}


#########################################################
        // <!-- start header area -->
require_once "./layouts/header.php"; 
############################################################
?>


<section class="" >
<div class="container q mt-sm-5 my-1">
<div class="card text-white bg-dark">
  <h5 class="card-header">Display Questions <?php echo $question_type ?></h5>
  <div class="card-body" style="height: 256px;overflow-y: scroll;">
      <table class="table table-dark">
          <thead>
              <tr>
                  <th scope="col">Title</th>
                  <th scope="col">Answer</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($disblayQues as $item): ?>
            <tr>
                
                <input type='hidden' name='question_id' class="question" value='<?php echo $item["question_id"] ?>'>
                    <td><?php echo $item['question_title'] ?></td>
                    <td>
                        <select class="form-control test">
                        <?php foreach($question->displayOption($item["question_id"]) as $option): ?>
                        <option value="<?php echo $option["option_number"] ?>" 
                        <?php if($option["option_number"] === $item['answer_option']) echo 'selected' ?>
                        ><?php echo $option["option_title"] ?></option>
                        <?php endforeach ?>
                        </select>
                    </td>
               
            </tr>
            <?php endforeach ?>
        </tbody>
        </table>
</div>
</div>
</div>
</section>

        <!-- start footer area -->
        <?php  require_once "./layouts/footer.php"; ?>
        <!-- end footer area -->
        <script type="text/javascript">
    $(document).on('change','.test',function(){
    var answar = $(this).val();
    var question = $(this).closest('tr').find('.question').val();
    console.log(answar);
    console.log(question);
    $.ajax({
        method:'POST',
        url:'<?php echo $root_path ?>/ajax_option.php',
        data: {submit: 'test',question_id: question,answer_option: answar},
        success: function(data){
            // console.log(data);
             Lobibox.notify('success', {
                    sound: false,
                    msg: "update option answar success"
                });
        }
    })
});
</script>
