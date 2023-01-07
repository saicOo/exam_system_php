<?php
if(isset($_POST['submit'])){
    ###############################################################
########################     update answer option    ########
    
 $host = "localhost";
 $db ="exam_system_online_v2";
 $user ="root";
 $pass ="";

        $conn = new PDO ("mysql:host=".$host.";dbname=".$db."","$user",$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $question_id =  $_POST['question_id'];
        $answer_option =  $_POST['answer_option'];
    
            $sql = "UPDATE `questions` SET `answer_option`='$answer_option' WHERE `question_id` = $question_id";
            $conn->exec($sql);
        }