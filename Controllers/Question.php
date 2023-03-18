<?php
require_once "Connect.php";

class Question extends Connect{
    public $messErrors = [];
    
###############################################################
########################     display all question      ########
    public function display(){
        $sql = "SELECT * FROM `questions` ORDER BY question_id DESC";
        $result = $this->conn->query($sql);
        return $result;
    }

###############################################################
########################     show question      ########
    public function show($subject_id){
        $sql = "SELECT * FROM `questions` WHERE subject_id = $subject_id ";
        $result = $this->conn->query($sql);
        return $result;
    }
###############################################################
########################  display option index of question ########
    public function displayOption($question_id){
        $sql = "SELECT * FROM `options` WHERE question_id = $question_id";
        $result = $this->conn->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

###############################################################
########################     store question,option     ########
    public function store($request){
        $subject_id=  $request['sub_id'];
        $question_title=  $request['question_title'];
        $type=  $request['type'];
         if($type === "ques2"){
            $option_title1=  $request['option_title1'];
            $option_title2=  $request['option_title2'];
            $option_title3=  $request['option_title3'];
            $option_title4=  $request['option_title4'];
            $option_title = [$option_title1,$option_title2,$option_title3,$option_title4];
            $question_type ="multiple choice";
         }else{
            $question_type ="true or false";
         }
        

        $answer_option=  $request['answer_option'];
        /********************************************
        *** check inputs empty
        */
        if(empty($subject_id)) $this->messErrors[] = "the input subject name is empty";
        if(empty($question_title)) $this->messErrors[] = "the input question title is empty";
        if(empty($answer_option)) $this->messErrors[] = "the input answer option is empty";
        /********************************************
        *** check inputs length
        */
            // #### Check for errors ####
            if(empty($this->messErrors)){
                try{
                    // ISERT QUESTION
                    $sql = "INSERT INTO `questions`(`question_id`, `question_title`,`question_type`,`subject_id`) 
                    VALUES (NULL,'$question_title','$question_type','$subject_id')";
                    $result = $this->conn->exec($sql);
                } catch(Exception $e) {
                    $this->messErrors[] = 'Wrong Entry';
                }
                
                // GET LAST ROW ID
                $show = "SELECT * FROM `questions` ORDER BY question_id DESC LIMIT 1 ";
                $row = $this->conn->query($show);
                $question_id = $row->fetch(PDO::FETCH_ASSOC)['question_id'] ;
                // INSERT OPTION
                if($type === "ques2"){
                    for ($i=0; $i < 4; $i++) { 

                        $title = $option_title[$i];
                        $count = $i +1;
                    $insertOption = "INSERT INTO `options`(`option_id`, `question_id`, `option_number`,`option_title`) 
                    VALUES (NULL,$question_id,$count,'$title')";
                    $this->conn->exec($insertOption);

                    }
                }else{
                  
                    for ($i=0; $i < 2; $i++) { 
                        $count = $i +1;
                        $title = $count == 1 ? "true" : "false";

                    $insertOption = "INSERT INTO `options`(`option_id`, `question_id`, `option_number`,`option_title`) 
                    VALUES (NULL,$question_id,$count,'$title')";
                    $this->conn->exec($insertOption);
                    }
                   
                }
               
                // ISERT QUESTION
                $sql = "UPDATE `questions` SET `answer_option` = $answer_option WHERE `question_id` = $question_id";
                $result = $this->conn->exec($sql);


                $_SESSION['success'] = "The exam has been successfully registered";
                header("Refresh:0");
                exit;
            }else{
                
              return  $this->messErrors;
            }
    }

    public function destroy($ques_id){
        $sql = "DELETE FROM questions WHERE `question_id` = $ques_id";
        $result = $this->conn->exec($sql);
        $_SESSION['success'] = "question deleted successfully";
        header("location:/question.php");
        exit;
        
    }
}