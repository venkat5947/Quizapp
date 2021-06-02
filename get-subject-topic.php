<?php
include("user.php");
$que = new user();
$data = json_decode($_POST['data']);

if( isset($data->str) and $data->str==""){
	                $str="";
					$sql="SELECT * FROM subject_table";
					$stmt = $que->db->prepare($sql);
					$stmt->execute();
					$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
					foreach($result as $row)
					{
						$str.="<option value='".$row['subject_name']."'> ".$row['subject_name']." </option>";
					}
					echo json_encode( 
						array("subjects"=>$str) 
					);
}
else if(isset($data->str) and $data->str=='gettopic')
{
                    $topics="";
	                $temp="SELECT * FROM subject_table where subject_name LIKE :subject_name ;";
	                $tempstmt = $que->db->prepare($temp);
					$tempstmt->execute([
						"subject_name"=>$data->subject
					]);
					$y = $tempstmt->fetch(PDO::FETCH_ASSOC);
                    $sql="SELECT * FROM topic_table where subject_id LIKE :subject_id";
					$stmt = $que->db->prepare($sql);
					$stmt->execute([
						'subject_id'=>$y['subject_id']
					]);
					$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

					foreach($result as $row)
					{
						$topics.="<option value='{$row['topic_name']}'>{$row['topic_name']}</option>";
					}
					$topics.="<option value='other_topic'>OTHER</option>";
					echo json_encode(
						array("topics"=>$topics) 
					);
}



















?>