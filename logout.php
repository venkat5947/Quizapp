<?php 
	session_start();
    // echo $_SESSION['id'];
	if(isset($_SESSION['id'])) {
		session_unset();
		session_destroy();
		// unset($_SESSION['id']);
		// unset($_SESSION['name']);

		echo "<script>document.location = 'index.php'; alert('logout Successful'); </script>";
	}
 ?>