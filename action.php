<?php


// include class 
include( 'user.php' );
// object
$user = new user();
// post method

$_post = $_POST;
$json = array();	
$studentInfo = array();
$data = json_decode($_post['data']);
if(!empty($data->action) && $data->action=="previous_contests"){
	$list = $user->personalContests($_SESSION['user_id']);
	echo json_encode($list);
}
if(!empty($data->action) && $data->action=='create') {
	// echo "in if";
	// $value = isset($_post['user_name']) ? $_POST['user_name'] : '';
	// echo $_POST['user_name'];
	// echo $value;
	$validate = validateRegForm($data);
	$user->setusername($data->user_name);
	$user->setuseremail($data->user_email);
	$user->setaddress($data->user_address);
	$user->setage($data->user_age);
	$user->setphone($data->user_phone);
	$user->setpassword(md5($data->user_password));

	$userData = $user->getUserByEmail();
	// echo $userData;
		if( $userData!=[] and $userData['user_email'] == $validate['user_email']) {
			echo json_encode(['msg'=>'Email is already registered']);
			exit;
		}
	$status = $user->create();
	if(!empty($status)){
		$json['msg'] = 'success';
		$json['task_id'] = $status;
	} else {
		$json['msg'] = 'failed';
		$json['task_id'] = '';
	}
	// $_post['result'] ="Successfully";
	// header('Content-Type: application/json');
	echo json_encode($json);  	
	// echo $json['msg'];
	exit;
}
if(!empty($data->action) && $data->action=="fetch_all_student") {
 // if(true){

		  // get total result
	$totalResult = $user->getTotalResult();
		  // get student information
		  // echo "total";
		  // echo $totalResult;
	$studentInformation = $user->getList();
	foreach($studentInformation as $key=>$element) {    
		$studentInfo[] = array(
			$element['user_id'], 
			$element['user_name'], 
			$element['user_email'],
			$element['user_phone'], 
			$element['user_address'], 
			$element['user_age'],  
			$element['user_password'],
		);    
	}
		  // draw data  
	$json['studentData'] = array(
		"draw"        =>  intval($_post["draw"]),
		"recordsTotal"    =>  $totalResult,
		"recordsFiltered"   =>  count($studentInformation),  
		"data"          => $studentInfo
	);
	
	
}



if(isset($data->action) && $data->action == 'login') {
	// echo "in action";
	$users = validateLoginForm($data);
	$user->setuseremail($users['email']);
	 $user->setpassword(md5($users['pwd']));
	 $userData = $user->getUserByEmail();
	 $rememberMe = isset($_POST['remember-me']) ? 1 : 0;
	 // echo $rememberMe;
	 if(is_array($userData) && count($userData) > 0) {
		 if($userData['user_password'] == $user->getpassword()) {
			 // if($userData['activated'] == 1 ) {
				 if($rememberMe == 1) {
					 setcookie('email', $user->getuseremail(),time()+(10 * 365 * 24 * 60 * 60));
					 setcookie('pass', base64_encode($users['pwd']),time()+(10 * 365 * 24 * 60 * 60));
					 // session_start();
					 }
				 $_SESSION['id'] = session_id();
				 $_SESSION['name'] = $userData['user_name'];
				 $_SESSION['email']=$userData['user_email'];
				$_SESSION['user_id']=$userData['user_id'];
				 echo json_encode( ["status" => 1, "msg" => "login successfull."] );
			 // } else {
				 // echo json_encode( ["status" => 0, "msg" => "Please activate your account to login."] );
			 // }
		 } else {
			 echo json_encode( ["status" => 0, "msg" => "Email or Password is wrong."] );
		 }
	 } else {
		 echo json_encode( ["status" => 0, "msg" => "Email or Password is wrong."] );
	 }
}

function validateRegForm($data) {
	// print_r($data);
	$validate['user_name'] = filter_var( $data->user_name, FILTER_SANITIZE_STRING);
	if(false == $validate['user_name']) {
		json_encode(["msg"=> "Enter valid name"]);
		exit;
	}
	$validate['user_phone'] = filter_var( $data->user_phone, FILTER_SANITIZE_NUMBER_INT);
		// echo $validate['user_phone'];
	if(false == $validate['user_phone']) {
		json_encode(["msg"=> "Enter valid number"]);
		exit;
	}

	$validate['user_email'] = filter_var( $data->user_email, FILTER_VALIDATE_EMAIL);
	if(false == $validate['user_email']) {
		json_encode(["msg"=> "Enter valid Email"]);
		exit;
	}

	$validate['user_address'] = filter_var( $data->user_address, FILTER_SANITIZE_STRING);
	if(false == $validate['user_address']) {
		json_encode(["msg"=> "Enter valid address"]);
		exit;
	}


	$validate['user_age'] = filter_var( $data->user_age, FILTER_SANITIZE_NUMBER_INT);
	if(false == $validate['user_age']) {
		json_encode(["msg"=> "Enter valid age"]);
		exit;
	}

	$validate['user_password'] = filter_var( $data->user_password, FILTER_SANITIZE_STRING);
	if(false == $validate['user_password']) {
		json_encode(["msg"=> "Enter valid valid pass"]);
		exit;
	}
	$validate['cfm_pass'] = filter_var( $data->cfm_pass, FILTER_SANITIZE_STRING);
	if(false == $validate['cfm_pass']) {
		json_encode(["msg"=> "Enter valid valid confirm pass"]);
		exit;
	}

	if($validate['user_password'] != $validate['cfm_pass']) {
		echo json_encode(["msg"=> 'Password and confirm password not match']);
		exit;
	}

	return $validate;
}


function validateLoginForm($data) {
		$users['email'] = filter_var( $data->email, FILTER_VALIDATE_EMAIL);
		if(false == $users['email']) {
			echo json_encode( ["status" => 0, "msg" => "Enter valid Email"] );
			exit;
		}

		$users['pwd'] = filter_var( $data->pwd, FILTER_SANITIZE_STRING);
		if(false == $users['pwd']) {
			echo json_encode( ["status" => 0, "msg" => "Enter valid valid pass"] );
			exit;
		}

		return $users;
	}
	if(isset($data->action) && $data->action == 'checkCookie')
	{
		if(isset($_COOKIE['email'],$_COOKIE['pass']))
		{
			$data=['email'=>$_COOKIE['email'],'pass'=>base64_decode($_COOKIE['pass'])];
			echo json_encode($data);
		}
	}
// // get all student records in database
// if(!empty($data->action) && $data->action=="fetch_all_student") {

//   if(!empty($_post["search"]["value"])){
//        $studentObj->setSearchVal($_post["search"]["value"]);       
//   }
//   if(!empty($_post["order"])){
//     $studentObj->setOrderBy($_post["order"]);
//   } 


//   if($_post["length"]){
//       $studentObj->setStart($_post["start"]);
//       $studentObj->setLength($_post["length"]);
//   }
//   // get total result
//   $totalResult = $studentObj->getTotalResult();
//   // get student information
//   $studentInformation = $studentObj->getList();
//   foreach($studentInformation as $key=>$element) {    
//       $studentInfo[] = array(
//         $element['roll_no'], 
//         $element['name'], 
//         $element['gender'],
//         $element['email'], 
//         $element['address'], 
//         $element['class_name'],  
//         '<a data-studentid="'.$element["id"].'" class="text-white btn btn-info btn-sm view-student"> View </a>  <a data-studentid="'.$element["id"].'" class="text-white btn btn-success btn-sm update-student"> Edit </a>  <a data-studentid="'.$element["id"].'" class="text-white btn btn-danger btn-sm delete-student"> Delete</a>',
//       );    
//     }
//   // draw data  
//   $json['studentData'] = array(
//       "draw"        =>  intval($_post["draw"]),
//       "recordsTotal"    =>  $totalResult,
//       "recordsFiltered"   =>  count($studentInformation),  
//       "data"          =>  $studentInfo
//     );
//   header('Content-Type: application/json');
//   echo json_encode($json['studentData']); 
// }

// get student record in database


// // update student record in database
// if(!empty($data->action) && $data->action=="update") {
// 	$studentObj->setStudentID($_post['student_id']);
//   $studentObj->setRollNo($_post['roll_no']);
// 	$studentObj->setName($_post['name']);
//   $studentObj->setEmail($_post['email']);
//   $studentObj->setAddress($_post['address']);
//   $studentObj->setGender($_post['gender']);
//   $studentObj->setClass($_post['class_name']);
// 	$status = $studentObj->update();
// 	if(!empty($status)){
// 		$json['msg'] = 'success';
// 	} else {
// 		$json['msg'] = 'failed';
// 	}
// 	header('Content-Type: application/json');	
// 	echo json_encode($json); 
// }

// // delete student record from database
// if(!empty($data->action) && $data->action=="delete") {
// 	$studentObj->setStudentID($_post['student_id']);
// 	$status = $studentObj->delete();
// 	if(!empty($status)){
// 		$json['msg'] = 'success';
// 	} else {
// 		$json['msg'] = 'failed';
// 	}
// 	header('Content-Type: application/json');	
// 	echo json_encode($json);	
// }
?>