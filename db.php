<?php
// class
class DbConnection {
    private $_dbHostName = "localhost";
    private $_dbName = "quizappdb";
    private $_dbUserName = "root";
    private $_dbPassword = "";
    private $_conn;
    // __construct
    public function __construct() {
    	try {

        
    $this->_conn = new PDO("mysql:host=$this->_dbHostName;dbname=$this->_dbName", $this->_dbUserName, $this->_dbPassword, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
    $this->_conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    } catch(PDOException $e) {
			echo "Error!: " . $e->getMessage();
		}
 
    }
    public function returnConnection() {
        // $this->_conn->set_charset("utf8");
        return $this->_conn;
    }
}
?>
