<?php
include("user.php");
$que = new user();

$data = json_decode($_POST['data']);
$val = $data->val;
if(isset($val)&& $val=="problem-set"){
    echo json_encode( $que->problem_set() );
}
else if($val=="personal-que"){
    echo json_encode($que->personal_question($_SESSION['user_id']));    
}
else if($val=="edit-que"){
    $result = $que->edit_question($data->qid);
	echo json_encode($result); 
    
}
else if($val == "update-que"){
    
    if($data->topic!='' and $data->discription!='' and $data->opt1!=''  and $data->opt2!=''   and $data->opt3!=''  and $data->opt4!=''  and $data->ans!=''  and $data->explanation!=''){
        if(isset($data->opt5)) $que-> update_question($data->qid, $data->topic,$data->subject,$data->discription,$data->opt1,$data->opt2,$data->opt3,$data->opt4,$data->ans,$data->explanation,$data->difficlty,$data->opt5);
        else $que-> update_question($data->qid,$data->topic,$data->subject,$data->discription,$data->opt1,$data->opt2,$data->opt3,$data->opt4,$data->ans,$data->explanation,$data->difficlty);
        echo json_encode(
            array("message"=>"Done Updataing question")
        );
    }
    else{
        echo json_encode(
            array("message"=>"check your inputs again, there are some emty feilds")
        );
        exit;
    }
    
}
else if($val == "delete-que"){
    $id = $data->qid;
    $que->delete_question($id);
    echo json_encode(array("message"=>"Question Deleted"));
    
}
else if($val == "get-details"){
    
    $result = $que->getUserDetails($_SESSION['user_id']);
    echo json_encode(
        array(
            "user_name"=>$result[0]['user_name'],
            "user_phone"=>$result[0]['user_phone'],
            "user_address"=>$result[0]['user_address'],
            "user_age"=>$result[0]['user_age']
        )
    );
}
else if($val== "update-profile"){

    $validate['user_name1'] = filter_var($data->user_name1, FILTER_SANITIZE_STRING);
    if(false == $validate['user_name1']) {
        echo json_encode( ["status" => 0, "msg" => "Enter valid name"] );
        exit;
    }
    $validate['user_phone1'] = filter_var($data->user_phone1, FILTER_SANITIZE_NUMBER_INT);
    if(false == $validate['user_phone1']) {
        echo json_encode( ["status" => 0, "msg" => "Enter valid number"] );
        exit;
    }
    $validate['user_address1'] = filter_var($data->user_address1, FILTER_SANITIZE_STRING);
    if(false == $validate['user_address1']) {
        echo json_encode( ["status" => 0, "msg" => "Enter valid address"] );
        exit;
    }
    $validate['user_age1'] = filter_var($data->user_age1, FILTER_SANITIZE_NUMBER_INT);
    if(false == $validate['user_age1']) {
        echo json_encode( ["status" => 0, "msg" => "Enter valid age"] );
        exit;
    }

    
    $que->setuserid($_SESSION['user_id']);
    $que->setusername($data->user_name1);
    $que->setaddress($data->user_address1);
    $que->setage($data->user_age1);
    $que->setphone($data->user_phone1);
    $que->update_profile();
    echo json_encode( array("status" => 1, "msg" => "Update successfull.") );
}
else if($val == "score-calc"){
    $user_ans=$data->user_ans;
    $tempData = str_replace("\\", "",$user_ans);
    $cleanData = json_decode($tempData);
    $arr=array();
    if(isset($cleanData)){
        foreach ($cleanData as $key => $value) {
            $arr+=array((int)$key => $value);
        }       
    }
    echo json_encode($que->score_calc($arr));
}
else if($val== "score-table-creation"){
    $user_ans=$data->user_ans;
    $diff = $data->diff;
    $topic=$data->topic;
    $user_id=$_SESSION['user_id'];
    $date = date_default_timezone_set('Asia/Kolkata');
    $sec = date('s') - $_SESSION["timeSec"];
    $min= date('i') - $_SESSION["timeMin"];
    $hr = date('H') - $_SESSION["timeHr"];
    if($sec<0){

        $sec+=60;
        $min-=1;
    }
    if($min<0){

        $min+=60;
        $hr-=1;
    }
    
    $time = $hr.':'.$min.':'.$sec;
    $tempData = str_replace("\\", "",$user_ans);
    $cleanData = json_decode($tempData);
    $arr=array();
    if(isset($cleanData)){
        foreach ($cleanData as $key => $value) {
            $arr+=array((int)$key => $value);
        }
    }
    echo json_encode($que->score_table_creation($arr,$diff,$topic,$user_id,$time));
}
else if($val=="question-validate"){
    if(!isset($_SESSION['id'])){
        if ($_SESSION['count']==3)
        exit ;
        else  $_SESSION['count']+=1;
    }
    $id =  $data->id;
    $opt = $data->opt;
    echo json_encode(array(
        "value"=>$que->question_validate($id,$opt)
    
    ));
}
else if($val=="contest-questions"){
    $count_ques=$data->no_of_ques;
    $diff = $data->diff;
    $topic = $data->topic;
    $subject = $data->subject;
    echo json_encode($que->contest_questions($count_ques,$diff,$topic,$subject));

    $date = date_default_timezone_set('Asia/Kolkata');
    $_SESSION['timeHr']  = date('H');
    $_SESSION['timeMin'] = date('i');
    $_SESSION['timeSec']  = date('s');


}
?>