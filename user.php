<?php
// include("db.php");
include("questions.php");
// $que = new Questions();
// session_close();
// Student
// alert("in user");
// echo "Hi";
class user extends Questions
{
    // Properties    
  public $db;
  private $_user_name;
  private $_user_email;
  private $_user_password;
  private $_user_phone;
  private $_user_address;
  private $_user_age;
  private $_user_id;
          // Methods
         public function setuserid($x) {
            $this->_user_id = $x;
        }
        public function setusername($x) {
          $this->_user_name = $x;
        }
        public function setuseremail($x) {
          $this->_user_email=$x;
        }
        public function setpassword($x) {
          $this->_user_password = $x;
        }
        public function setphone($x) {
          $this->_user_phone = $x;
        }
        public function setaddress($address) {
          $this->_user_address = $address;
        }
        public function setage($age) {
          $this->_user_age = $age;
        }



        public function getusername() {
          return $this->_user_name;
        }
        public function getuseremail() {
          return $this->_user_email;
        }
        public function getpassword() {
          return $this->_user_password;
        }
        public function getphone() {
          return $this->_user_phone;
        }
        public function getaddress() {
          return $this->_user_address;
        }
        public function getage() {
          return $this->_user_age;
        }

        public function getuserid()
        {
          return $this->_user_id;
        }

          // __construct
       

    // create student record in database
  public function create() {
       // echo "in create";
        // echo $this->_user_name;
        try {
            $sql = 'INSERT INTO admin_table (user_name,user_email,user_phone,user_address,user_age,user_password)  VALUES (:x, :y, :z, :p, :q, :r)';
            $data = [
             'x' => $this->_user_name,
             'y' => $this->_user_email,
             'z' => $this->_user_phone,
             'p' => $this->_user_address,
             'q' => $this->_user_age,
             'r' => $this->_user_password,
           ];
  
           $stmt = $this->db->prepare($sql);
           $stmt->execute($data);
           $status = $this->db->lastInsertId();
           return $status;
  
        } 
     catch (Exception $err) {
          die("Error!: ".$err);
       }

    }


  //   // update student record in database
  //   public function update() {
  //       try {
		//     $sql = "UPDATE student SET roll_no=:roll_no, name=:name, email=:email, address=:address, class_name=:class_name, gender=:gender WHERE id=:student_id";
		//      $data = [
		// 	    'roll_no' => $this->_rollNo,
  //               'name' => $this->_name,
  //               'email' => $this->_email,
  //               'address' => $this->_address,
  //               'class_name' => $this->_className,
  //               'gender' => $this->_gender,
  //               'student_id' => $this->_studentID,
		// 	];
		// 	$stmt = $this->db->prepare($sql);
		// 	$stmt->execute($data);
		// 	$status = $stmt->rowCount();
  //           return $status;
		// } catch (Exception $err) {
		// 	die("Error!: " . $err);
		// }
  //   }

    // gwt student record from database
public function getTotalResult() {
  try {
    $sql = "SELECT * FROM admin_table";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->rowCount();
    return $result;
  } 
  catch (Exception $e) {
    die("Error!: " . $e);
  }
}

    // get all student records from database
public function getList() {
 try {
            // keyword serach


     $sql = "SELECT * FROM admin_table";
     $stmt = $this->db->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
     return $result;
     } 
     catch (Exception $err) {
    die("Error!: " . $err);
    }

}


public function getUserByEmail() {
      $stmt = $this->db->prepare('SELECT * FROM admin_table WHERE user_email = :email');
      $stmt->bindParam(':email', $this->_user_email);
      $y=[];
      try {
        if($stmt->execute()) {
          $y = $stmt->fetch(PDO::FETCH_ASSOC);
        }
      } catch (Exception $e) {
        
        echo $e->getMessage();
      }

      return $y;
    }

    public function getUserById() {
      $stmt = $this->db->prepare('SELECT * FROM admin_table WHERE user_id = :id');
      $stmt->bindParam(':id', $this->_user_id);
      try {
        if($stmt->execute()) {
          $y = $stmt->fetch(PDO::FETCH_ASSOC);
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
      return $y;
    }


    public function update_profile(){

        try{
            // echo $_SESSION["ueer_id"];
          // echo "infun";
            $sql="UPDATE admin_table set user_name=':user_name', user_phone=':user_phone', user_address=':user_address', user_age=':user_age'  where (user_id like ':user_id');";
            // echo "\n\n".$sql."\n\n\n\n";
            $stmt = $this->db->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $stmt->execute([
              "user_name"=>$this->_user_name,
              "user_phone"=>$this->_user_phone,
              "user_address"=>$this->_user_address,
              "user_age"=>$this->_user_age,
              "user_id"=>$this->_user_id
            ]);
            // $status = $this->db->lastInsertId();
            // return $status;
        }
        catch (Exception $err){
            die("Error".$err);
        }
    }
    public function getUserDetails($user_id){
      $sql = "SELECT * FROM admin_table where(user_id like :user_id) ;";
      $stmt = $this->db->prepare($sql);
      $stmt->execute([
        'user_id'=>$user_id
      ]);
      $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return $result;

    }
    public function personalContests($user_id){
      $sql="select * from contest_table where user_id = :user_id ORDER BY contest_id DESC ";
      $sql1 = "select * from contest_table where user_id = :user_id";
      if($_POST["length"] != -1)
      {
        $sql .= 'LIMIT '.$_POST['start'].' , '.$_POST["length"];
      }
      $sql.=" ;";
      $sql1.=" ;";
      // echo $sql;
      $stmt = $this->db->prepare($sql);
        $stmt->execute([
          "user_id" => $user_id
        ]);
      $stmt1 = $this->db->prepare($sql1);
        $stmt1->execute([
          "user_id"=>$user_id
        ]);
      $total = $stmt1->rowCount();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $set = array();
      foreach ($result as $que) {
        $set[] = array(
          $que['contest_id'],
          $que['total_questions'],
          $que['score'],
          $que['topic'],
          $que['difficulty'],
          $que['timestamp']
        );
      }
      
      $list = array(
        "draw"	=>	intval($_POST['draw']),
        "recordsTotal" => $total,	
        "recordsFiltered" => $total,
        "data"          =>  $set
      );
      return $list;
    }
  //   // gwt student record from database
  //   public function getStudent() {
  //       try {
  //           $sql = "SELECT id, roll_no, name, email, address, class_name, gender, created_date FROM student WHERE id=:student_id";
  //           $stmt = $this->db->prepare($sql);
  //           $data = [
  //               'student_id' => $this->_studentID
  //           ];
  //           $stmt->execute($data);
  //           $result = $stmt->fetch(\PDO::FETCH_ASSOC);
  //           return $result;
  //       } catch (Exception $e) {
  //           die("Error!: " . $err);
  //       }
  //   }

  //   // delete student record from database
  //   public function delete() {
  //   	try {
	 //    	$sql = "DELETE FROM student WHERE id=:student_id";
		//     $stmt = $this->db->prepare($sql);
		//     $data = [
		//     	'student_id' => $this->_studentID
		// 	];
	 //    	$stmt->execute($data);
  //           $status = $stmt->rowCount();
  //           return $status;
	 //    } catch (Exception $err) {
		//     die("Error!: " . $err);
		// }
  //   }

}
?>