<?php
    include("questions.php");
    $que = new Questions();
    $data = json_decode($_POST['data']);
    try{
        if($data->subject!='' and $data->discription!=''  and $data->topic!=''  and $data->opt1!=''  and $data->opt2!=''   and $data->opt3!=''  and $data->opt4!=''  and $data->ans!=''  and $data->explanation!=''){
            if(isset($data->opt5)) {
                $que-> add_question($data->topic,$data->subject,$data->discription,$data->opt1,$data->opt2,$data->opt3,$data->opt4,$data->ans,$data->explanation, $data->difficulty, $data->opt5);
            }
            else {
                $que-> add_question($data->topic,$data->subject,$data->discription,$data->opt1,$data->opt2,$data->opt3,$data->opt4,$data->ans,$data->explanation,$data->difficulty);
            }
            if($data->topic_flag) $que->add_new_topic($data->subject, $data->topic, $data->topic_disc);
            echo json_encode(
                array("message"=>"DONE")
            );
        }
        else{
            echo json_encode(
                array("message"=>"Please Check Your Inputs again, they are empty")
            );
            exit;
        }

    }
    catch(Exception $err){
        die("Error!: " . $err);
    }
?>