<?php
/**
 * Simple CRUD api class
 * @author Joey Digital
 * @version v1.0 | 2017-07-18
 *
 */

class api {
	private $db;
	private $table_users = 'superheroes';

	# Constructor - open DB connection
	public function __construct() {
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
	public function getNumRows() {
		$query = "SELECT COUNT(*) FROM $this->table_users";
		$result = $this->db->query($query);
		echo json_encode($result);
	}

	# Search DB (pagination)
	public function search_paginate($offset, $maxRows) {
		$query = "SELECT * FROM $this->table_users ORDER BY id DESC LIMIT '$offset','$maxRows'";
		$result = $this->db->query($query);

		// return the results
		if(mysqli_num_rows($result) > 0) {
			$list = array();
			while ($row = $result->fetch_array()) {
				array_push($list, $row);
			}
			echo json_encode($list);
		} else {
			$res = '{"response":"no records found"}';
			echo json_encode($res);
		}
	}

	# Search DB (user defined search)
	public function search($terms, $field) {
		if($field == '') {
			// use default field
			$query = "SELECT * FROM $this->table_users WHERE name LIKE '$terms%' ORDER BY id DESC";
		} else {
			$query = "SELECT * FROM $this->table_users WHERE $field LIKE '$terms%' ORDER BY id DESC";
		}
		$result = $this->db->query($query);

		// return the results
		if(mysqli_num_rows($result) > 0) {
			$list = array();
			while ($row = $result->fetch_array()) {
				array_push($list, $row);
			}
			echo json_encode($list);
		} else {
			// Angular MUST have an array (for the respone) to work with (in this case)
			$res = ['no results']; //$res = '{"response":"no records found"}';
			echo json_encode($res);
		}
	}

}
