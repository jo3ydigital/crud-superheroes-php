<?php
/**
 * Simple Login api class
 * @author Joey Digital
 * @version v1.0 | 2017-07-18
 *
 */

class api {
	private $db;
	private $table_users = 'users';

	# Constructor - open DB connection
	public function __construct() {
		// This displays the FULL MySQL ERROR (if any), but it will kill our return output if we use it: 
		//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		$conf = json_decode(file_get_contents('configuration.json'), TRUE);
		$this->db = new mysqli($conf["host"], $conf["user"], $conf["password"], $conf["database"]);
	}

	# Destructor - close DB connection
	public function __destruct() {
		$this->db->close();
	}

	# ---------------------
	# Main Search functions
	# ---------------------

	# Get the total amount of rows in DB
	public function login($username, $password) {
		$query = "SELECT * FROM $this->table_users WHERE username='$username' AND password='$password'";
		$result = $this->db->query($query);
		$res;
		$rowcount=mysqli_num_rows($result);
		$rowcount == '1' ? $res=1 : $res=0;
		return $res;
	}

}
