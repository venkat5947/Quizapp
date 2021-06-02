<?php
session_start();
include("db.php");
class Questions {

    public function __construct() {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }



    function add_question($topic, $subject, $discription, $opt_a, $opt_b, $opt_c, $opt_d, $correct_ans, $explanation,$difficulty="medium",$opt_e="NULL"){
        try{
            // echo $_SESSION["ueer_id"];
            $sql="Insert into questions (user_id,discription, topic, subject, opt_a, opt_b, opt_c, opt_d, opt_e, correct_ans, explanation,difficulty) values (:user_id, :discription, :topic, :subject, :opt_a, :opt_b, :opt_c, :opt_d, :opt_e, :correct_ans, :explanation,:difficulty)";
            $stmt = $this->db->prepare($sql);
            
	    	$stmt->execute([
                'user_id' => $_SESSION['user_id'],
                'discription' => $discription,
                'topic' => $topic,
                'subject' => $subject,
                'opt_a' => $opt_a,
                'opt_b' => $opt_b,
                'opt_c' => $opt_c,
                'opt_d' => $opt_d,
                'opt_e' => $opt_e,
                'correct_ans' => $correct_ans,
                'explanation' => $explanation,
                'difficulty' =>  $difficulty

            ]);
            $status = $this->db->lastInsertId();
            return $status;
        }
        catch (Exception $err){
            die("Error".$err);
        }
    }
    public function add_new_topic($subject, $topic, $topic_disc){
        $sql = "select * from subject_table where subject_name like ':subject' ;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "subject"=>$subject
        ]);
        $id = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0]['subject_id'];
        $sql = "insert into topic_table (topic_name, topic_description, subject_id) values (:topic, :topic_desc, :id);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "topic"=>$topic,
            "topic_desc"=>$topic_disc,
            "id" => $id
        ]);
        return "Done";
    }
    public function getTotalResult() {
        try {
            $sql = "SELECT id FROM questions";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->rowCount();
            return $result;
        } catch (Exception $e) {
            die("Error!: " . $e);
        }
    }
    public function getQidResult($qid) {
        try {
            $sql = "SELECT id FROM questions where(id like :qid ) ;";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(
                [
                    'qid'=> $qid
                ]
            );
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);;
            return $result;
        } catch (Exception $e) {
            die("Error!: " . $e);
        }
    }

    function problem_set(){
        try{
            $sql="select * from questions ";
            $sql1 = "select * from questions ";
            if(isset($_POST["search"]["value"]))
            {
                $sql .= 'WHERE (';
                $sql .= 'discription LIKE "%'.$_POST["search"]["value"].'%" ) ';
                $sql1 .= 'WHERE (';
                $sql1.= 'discription LIKE "%'.$_POST["search"]["value"].'%" ) ';
            }
            if(isset($_POST["order"]))
            {
            $sql .= 'ORDER BY '.$_POST['order']['0']['column'].', '.$_POST['order']['0']['dir'].' ';
            }
            else
            {
                $sql .= 'ORDER BY id ASC ';
            }
            if($_POST["length"] != -1)
            {
                $sql .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
            }
            $sql.=' ;';
            $sql1.=' ;';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->execute();
            $total = $stmt1->rowCount();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $set = array();
            foreach ($result as $que) {
                $string = '<div style="text-align:left;">
                
                                <div class=" alert alert-success " role="alert" id = "'.$que["id"].'crct">
                                    Correct
                                    
                                </div>
                                <div class=" alert alert-danger" role="alert" id = "'.$que["id"].'wrng">
                                    Wrong, Please Try Again
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div  class="container "><h5 id="'.$que["id"].'" > ' . $que['discription'] . '</h5></div>
                                <div class="container"> <input data-id="'.$que['id'].'" value="a" type="radio" class="radio form-check-input" name="opt' . $que['id'] . '" id="' . $que["id"] . 'a"><label class="form-check-label" for = "' . $que["id"] . 'a">' . $que["opt_a"] . '</label> </div>
                                <div class="container"> <input data-id="'.$que['id'].'" value="b" type="radio" class="radio form-check-input" name="opt' . $que['id'] . '" id="' . $que["id"] . 'b"><label class="form-check-label" for = "' . $que["id"] . 'b">' . $que["opt_b"] . '</label> </div>
                                <div class="container"> <input data-id="'.$que['id'].'" value="c" type="radio" class="radio form-check-input" name="opt' . $que['id'] . '" id="' . $que["id"] . 'c"><label class="form-check-label" for = "' . $que["id"] . 'c">' . $que["opt_c"] . '</label> </div>
                                <div class="container"> <input data-id="'.$que['id'].'" value="d" type="radio" class="radio form-check-input" name="opt' . $que['id'] . '" id="' . $que["id"] . 'd"><label class="form-check-label" for = "' . $que["id"] . 'd">' . $que["opt_d"] . '</label> </div>';
                                if($que["opt_e"]!="")
                                {
                                         $string.='<div class="container"> <input data-id="'.$que['id'].'" value="e" type="radio" class="radio form-check-input" name="opt' . $que['id'] . '" id="' . $que["id"] . 'e"><label class="form-check-label" for = "' . $que["id"] . 'e">' . $que["opt_e"] . '</label> </div>';
                                }
                               
                        
                                $string.=' 
                                <button data-id="'.$que['id'].'" class = "show btn btn-primary" id = "'.$que["id"].'btn">Show Answer with Explanation </button>
                                <div data-id="'.$que['id'].'" class=" alert alert-info" role="alert" id = "'.$que["id"].'show">
                                    '.$que['correct_ans'].'<br><br>
                                    '.$que['explanation'].'
                                    
                                </div>
                                
                                </div>
    
                                    </div>
                                    '; 
                            
                $set[] = array(
                    '',$string
                );
            }
            $list = array(
                "draw"	=>	intval($_POST['draw']),
                "recordsTotal" => $this->getTotalResult(),	
                "recordsFiltered" => $total,
                "data"          =>  $set
            );
            return $list;



        }
        catch (Exception $err){
            die("Error!: " . $err);    
        }
    }
    function edit_question($id){
        $sql = "SELECT * FROM questions where(id like :id) ;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "id"=>$id
        ]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    function update_question($id, $topic, $subject, $discription, $opt_a, $opt_b, $opt_c, $opt_d, $correct_ans, $explanation, $difficulty="medium",$opt_e="NULL"){
        try{
            $sql="UPDATE questions set discription=:discription, topic=:topic, subject=:subject, opt_a=:opt_a, opt_b=:opt_b, opt_c=:opt_c, opt_d=:opt_d, opt_e=:opt_e, correct_ans=:correct_ans, explanation=:explanation  where (id like :id);";
            $stmt = $this->db->prepare($sql);
	    	$stmt->execute([
                "discription"=>$discription,
                "topic"=>$topic,
                "subject"=>$subject,
                "opt_a"=>$opt_a,
                "opt_b"=>$opt_b,
                "opt_c"=>$opt_c,
                "opt_d"=>$opt_d,
                "opt_e"=>$opt_e,
                'correct_ans' => $correct_ans,
                'explanation' => $explanation,
                'difficulty' =>  $difficulty,
                "id"=>$id
            ]);
            $status = $this->db->lastInsertId();
            return $status;
        }
        catch (Exception $err){
            die("Error".$err);
        }
    }

    function delete_question($id){
        try{
            $sql = "DELETE from questions where (id like :id);";
            $stmt = $this->db->prepare($sql);
	    	$stmt->execute([
                "id"=>$id
            ]);
            return 1;
        }
        catch (Exception $err){
            die("Error".$err);
        }
    }
    function personal_question($user_id){
        $sql = "select * from questions where (user_id= :user_id) ;";
        $stmt= $this->db->prepare($sql);
        $stmt->execute([
            'user_id'=>$user_id
        ]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $set = array();
        foreach ($result as $que) {
            $set[] = array(
                $que['id'],
                $que["discription"],
                "<button class = 'edit btn btn-primary' data-id=".$que['id']."> EDIT </button>",                                                                                        
                "<button class = 'delete btn btn-danger' data-id=".$que['id']."> DELETE </button>"
            );
        }
        $list = array(
            "draw"	=>	intval($_POST['draw']),
            "recordsFiltered" => count($set),
            "recordsTotal" => count($set),	
            "data"          =>  $set
        );
        // print_r($set);
        return $list;
    }

    function score_calc($arr){
        $set = array();
        $_SESSION['score']=0;
        foreach( $_SESSION['ARRAY'] as $x)
        {
            $y='Did not Chose any option ';
            if(isset($arr[$x])){
                $y=$arr[$x];
            }
            $sql = "select * from questions where (id like :id) ;";
            $stmt= $this->db->prepare($sql);
            $stmt->execute([
                "id"=>$x
            ]);
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $string="";
            if($y=='Did not Chose any option ')
            {
                    $string.='<div class=" alert alert-info " role="alert" >
                                    Did not Answer
                                    
                                </div>';
            }
            else if($y==$result[0]['correct_ans'])
            {	$string.='<div class=" alert alert-success " role="alert" >
                                    Correct
                                    
                                </div>';
                                $_SESSION['score']+=1;

            }
            else
                $string.='<div class=" alert alert-danger" role="alert" >
                                    Wrong Answer
                                    
                                </div>';

            foreach($result as $que)
            {

                $string .= '<div style="text-align:left;">
                
                                
                                <div  class="container "><h5 id="'.$que["id"].'" > ' . $que['discription'] . '</h5></div>
                                <div class="container"> <label class="form-check-label" for = "' . $que["id"] . 'a"> (A) ' . $que["opt_a"] . '</label> </div>
                                <div class="container"> <label class="form-check-label" for = "' . $que["id"] . 'b"> (B)' . $que["opt_b"] . '</label> </div>
                                <div class="container"> <label class="form-check-label" for = "' . $que["id"] . 'c"> (C)' . $que["opt_c"] . '</label> </div>
                                <div class="container"> <label class="form-check-label" for = "' . $que["id"] . 'd"> (D) ' . $que["opt_d"] . '</label> </div>';

                                
                                
                            
                if($que["opt_e"]!="")
                {
                    $string.='<div class="container"> <label class="form-check-label" for = "' . $que["id"] . 'e">' . $que["opt_e"] . '</label> </div>';
                                
                }

                $string.=' <br>
                    <div class="container"> <h5>Your Answer:</h5>  <p>'.$y.'</p> </div>
                    <div class="container"> <h5>Correct answer:</h5> <p>   ' . $que["correct_ans"] . '</p> </div>
                    <div class="container"> <h5>Explanation:</h5>  <p>   ' . $que["explanation"] . '</p> </div>
                </div>

                
                                ';
                $set[] = array(
                    '',$string
                );
            }


        }
        $list = array(
                    "draw"	=>	intval($_POST['draw']),
                    "recordsTotal" =>count($_SESSION['ARRAY']),	
                    "recordsFiltered" =>count($_SESSION['ARRAY']),
                    "data"          =>  $set
                );
        // header('Content-Type: applicatmion/json');
        return $list;
            
    }

    function score_table_creation($arr,$diff,$topic,$user_id,$time){
        $set = array();
        $not_attempted=0;
        $wrong_ans=0;
        $attempted = 0;
        $correct_ans=0;
        $total = count($_SESSION['ARRAY']);
        foreach( $_SESSION['ARRAY'] as $x)
        {
            $y='Did not Chose any option ';

            if(isset($arr[$x]))
                {$y=$arr[$x];}
                $sql = "select * from questions where (id like ':id') ;";
                $stmt= $this->db->prepare($sql);
                $stmt->execute([
                    "id"=>$x
                ]);
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                $string="";
                if($y=='Did not Chose any option ')
                {
                    $not_attempted+=1;
                        
                }
                else if($y==$result[0]['correct_ans'])
                {
                    $attempted+=1;                   
                    $correct_ans+=1;

                }
                else{
                    $attempted+=1;
                    $wrong_ans+=1;
                }


        }

        $value_of_que=0;
        if($diff == 'all' or $diff=='medium') $value_of_que=2;
        else if($diff == 'hard') $value_of_que=3;
        else $value_of_que=1;

        $set  = array(
                array(strval( strval($correct_ans*$value_of_que).'/'.strval($total*$value_of_que)), 
                strval($not_attempted), 
                strval($attempted), 
                    strval($correct_ans),
                    strval($wrong_ans),
                    strval($time)
                
                )
                    
        );

        $sql = "insert into contest_table (user_id, total_questions, score, topic, difficulty, timestamp) values (:user_id,:total,:score,:topic,:difficulty,:timestamp);";
        $stmt= $this->db->prepare($sql);
        $stmt->execute([
            "user_id"=>$user_id,
            "total_questions"=>$total,
            "score"=>$correct_ans*$value_of_que,
            "topic"=>$topic,
            "difficulty"=>$diff,
            "timestamp"=>$time
        ]);

        $list = array(
            "draw"	=>	intval($_POST['draw']),
            "recordsTotal" =>1,	
            "recordsFiltered" =>1,
            "data"          =>  $set
        );
        // header('Content-Type: applicatmion/json');
        return $list;
    }
    function question_validate($id,$opt)
    {
       
        $sql = "select correct_ans from questions where id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "id"=>$id
        ]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if($opt == $result[0]["correct_ans"]){
            return 1;
            exit;
        }
        else{
            return 0;
            exit;
        }


    }
    function contest_questions($count_ques, $diff, $topic,$subject){
        $sql = "select * from (select * from questions ";
        if($subject=='all'){
            if($diff!='all'){
                $sql.= "where difficulty like '".$diff."' ";
            }
        }
        else {
            $sql.=" where subject like '".$subject."' ";
            if($topic=='any'){
                if($diff!='all'){
                    $sql.= "and difficulty like '".$diff."' ";
                }
            }
            else{
                $sql.=" and topic like '".$topic."' ";
                if($diff!='all'){
                    $sql.= "and difficulty like '".$diff."' ";
                }
            }
        }

        $sql.="  order by RAND()  LIMIT ".$count_ques."  ) xyz order by id asc; ";

        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        // print_r($result);
        $set = array();

        $_SESSION['ARRAY']=array();
        foreach ($result as $que) {
            $_SESSION['ARRAY'][]=$que['id'];
            $string = '<div style="text-align:left;">
                        
                                        
                                        <div  class="container "><h5 id="'.$que["id"].'" > ' . $que['discription'] . '</h5></div>
                                        <div class="container"> <input data-id="'.$que['id'].'" value="a" type="radio" class="form-check-input radio" name="opt' . $que['id'] . '" id="' . $que["id"] . 'a"><label class="form-check-label" for = "' . $que["id"] . 'a">' . $que["opt_a"] . '</label> </div>
                                        <div class="container"> <input data-id="'.$que['id'].'" value="b" type="radio" class="form-check-input radio" name="opt' . $que['id'] . '" id="' . $que["id"] . 'b"><label class="form-check-label" for = "' . $que["id"] . 'b">' . $que["opt_b"] . '</label> </div>
                                        <div class="container"> <input data-id="'.$que['id'].'" value="c" type="radio" class="form-check-input radio" name="opt' . $que['id'] . '" id="' . $que["id"] . 'c"><label class="form-check-label" for = "' . $que["id"] . 'c">' . $que["opt_c"] . '</label> </div>
                                        <div class="container"> <input data-id="'.$que['id'].'" value="d" type="radio" class="form-check-input radio" name="opt' . $que['id'] . '" id="' . $que["id"] . 'd"><label class="form-check-label" for = "' . $que["id"] . 'd">' . $que["opt_d"] . '</label> </div>
                                    ';

                // echo $que['opt_e'];
                // echo "hi";
                if($que["opt_e"]!="")
                {
                        $string.='<div class="container"> <input data-id="'.$que['id'].'" value="e" type="radio" class="form-check-input radio" name="opt' . $que['id'] . '" id="' . $que["id"] . 'e"><label class="form-check-label" for = "' . $que["id"] . 'e">' . $que["opt_e"] . '</label> </div>';
                }
            

                                $string.='     
                                        <div class="container"> <button data-id="'.$que['id'].'" class = "btn btn-warning clear">Clear</button> </div>
                                                                        <div class="container"> <p id="' . $que["id"] . 'crt_ans">
                                                                </p>
                                                                <p id="' . $que["id"] . 'Exp">
                                                                </p></div>
                                    </div>

                                        </div>
                                        ';
                        $set[] = array(
                            '',$string
                        );
        }
        $list = array(
            "draw"	=>	intval($_POST['draw']),
            "recordsTotal" => count($set),	
            "recordsFiltered" => count($set),
            "data"          =>  $set
        );
        return $list;
    }
}
?>