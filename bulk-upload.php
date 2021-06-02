<?php
use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\IOFactory;
require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();
include('user.php');
$que = new user();
require_once ('./vendor/autoload.php');
// echo "hi";
// echo $_POST['data'];
if (isset($_POST["import"])) {
    // echo "IN import";
    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/csv',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = 'uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

         $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
         $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
         if($ext=="xls")
            $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
         else if($ext=="csv")
            $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();

        // echo $_FILES["file"]["type"];
        // $Reader.= '$_FILES["file"]["type"]';

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);
        // echo "Hello".count($spreadSheetAry[0]);
        // echo "<script> alert($sheetCount)</script>";
        $flag=1;
        for ($i = 0; $i <= $sheetCount; $i ++) {
            $rowcount=0;
            // echo "in loop";
            if(isset($spreadSheetAry[$i]))
            $rowcount=count($spreadSheetAry[$i]);
            if($rowcount<11) continue;
            if($flag==1)
            {
                $flag=0;
                continue;
            }
            $discription = "";
            if (isset($spreadSheetAry[$i][0])) {
                $discription = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
            }
            $topic = "";
            if (isset($spreadSheetAry[$i][1])) {
                $topic = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
            }
            $difficulty = "";
            if (isset($spreadSheetAry[$i][2])) {
                $difficulty = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
            }
            $subject = "";
            if (isset($spreadSheetAry[$i][3])) {
                $subject = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]);
            }
            $opt_a = "";
            if (isset($spreadSheetAry[$i][4])) {
                $opt_a = mysqli_real_escape_string($conn, $spreadSheetAry[$i][4]);
            }
            $opt_b = "";
            if (isset($spreadSheetAry[$i][5])) {
                $opt_b = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]);
            }
            $opt_c = "";
            if (isset($spreadSheetAry[$i][6])) {
                $opt_c = mysqli_real_escape_string($conn, $spreadSheetAry[$i][6]);
            }
            $opt_d = "";
            if (isset($spreadSheetAry[$i][7])) {
                $opt_d = mysqli_real_escape_string($conn, $spreadSheetAry[$i][7]);
            }
            $opt_e = "";
            if (isset($spreadSheetAry[$i][8])) {
                $opt_e = mysqli_real_escape_string($conn, $spreadSheetAry[$i][8]);
            }
            $correct_ans = "";
            if (isset($spreadSheetAry[$i][9])) {
                $correct_ans = mysqli_real_escape_string($conn, $spreadSheetAry[$i][9]);
            }
            $explanation = "";
            if (isset($spreadSheetAry[$i][10])) {
                $explanation = mysqli_real_escape_string($conn, $spreadSheetAry[$i][10]);
            }

            // if($opt_e=="")
            // {
            //     echo $opt_e;
            //     if($correct_ans='e' or $correct_ans=='E') continue;
            // }
            // echo $discription,"<br>",$topic,"<br>",$difficulty,"<br>",$subject,"<br>",$opt_a,"<br>",$opt_b,"<br>",$opt_c,"<br>",$opt_d,"<br>",$opt_e,"<br>",$correct_ans,"<br>",$explanation,"<br>";
            // echo "<br>";
            if (!empty($discription) and !empty($topic) and !empty($difficulty)  and !empty($subject) and !empty($opt_a) and !empty($opt_b) and !empty($opt_c) and !empty($opt_d)  and !empty($correct_ans)  and !empty($explanation) ){

                // echo "<script> alert(hello)</script>";

                $que->add_question($topic,$subject,$discription,$opt_a,$opt_b,$opt_c,$opt_d,$correct_ans,$explanation,$difficulty,$opt_e);
                echo "Done";
                // if (! empty($insertId)) {
                    // $type = "success";
                    // $message = "Excel Data Imported into the Database";
                // } else {
                    // $type = "error";
                    // $message = "Problem in Importing Excel Data";
                // }
            }
        }
    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
    }
}
?>

