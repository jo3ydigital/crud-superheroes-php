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

	private $img_path = "../../src/assets/images/superheroes/";
	private $angular_img_path = '../assets/images/superheroes/';

	# Constructor - open DB connection
	public function __construct() {
		$conf = json_decode(file_get_contents('configuration.json'), TRUE);
		$this->db = new mysqli($conf["host"], $conf["user"], $conf["password"], $conf["database"]);
	}

	# Destructor - close DB connection
	public function __destruct() {
		$this->db->close();
	}

	# -------------------
	# Main CRUD functions
	# -------------------

	# CREATE the user
	public function createUser($editable, $name, $realname, $actor, $img) {
		// check for existing user (where $name is unique since this is a silly "superheroes" crud api)
		$query = "SELECT * FROM $this->table_users WHERE name='$name'";
		$result = $this->db->query($query);

		if(mysqli_num_rows($result) > 0) {
			return 'user aleady exists';
		} else {
			// add new user to the DB
			$query = "INSERT INTO $this->table_users SET enable_edit='$editable', name='$name', realname='$realname', actor='$actor', img='$img'";
			$result = $this->db->query($query);
			return ($result == '1' ? '1' : '0'); // 1 = good, 0 = query failed
		}
	}

	# READ the entire list and SORT or ORDER it by user params
	public function readUsersSort($orderBy, $type) {
		$query = "SELECT * FROM $this->table_users ORDER BY $orderBy $type";
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

	# READ the entire list of users -or- a single user (by ID)
	public function readUsers($params) {
		if($params == '') {
			// grab everything
			$query = "SELECT * FROM $this->table_users ORDER BY name ASC";
		} else {
			$id_count = substr_count($params, ",");
			if($id_count == '0') {
				// grab specific entry
				$query = "SELECT * FROM $this->table_users WHERE id = '$params' ORDER BY id DESC";
			}
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
			$res = '{"response":"no records found"}';
			echo json_encode($res);
		}
	}

	# UPDATE a user in the DB by user id
	public function updateUser($name, $realname, $actor, $img, $id) {
		$query = "SELECT * FROM $this->table_users WHERE id='$id'";
		$result = $this->db->query($query);
			
		if(mysqli_num_rows($result) > 0) {
			while ($row = $result->fetch_array()) {
				$db_name = $row['name'];
				$db_realname = $row['realname'];
				$db_actor = $row['actor'];
				$db_image = $row['img'];
			}

			if($name == '') { $name = $db_name; }
			if($realname == '') { $realname = $db_realname; }
			if($actor == '') { $actor = $db_actor; }
			if($img == '') { $img = $db_image; }

			$query = "UPDATE $this->table_users SET enable_edit='1', name='$name', realname='$realname', actor='$actor', img='$img' WHERE id='$id'";
			$result = $this->db->query($query);
			return ($result == '1' ? '1' : '0'); // 1 = good, 0 = query failed
		} else {
			return ($result == '1' ? '1' : '0');
		}
		//$this->db->close();
	}

	# DELETE a user from the DB by user id
	public function deleteUser($id) {
		$query = "SELECT * FROM $this->table_users WHERE id='$id'";
		$result = $this->db->query($query);

		if(mysqli_num_rows($result) > 0) {
			// delete the user from the db
			$query = "DELETE FROM $this->table_users WHERE id='$id'";
			$result = $this->db->query($query);
			return ($result == '1' ? '1' : '0'); // 1 = good, 0 = query failed
		} else {
			return 'cannot delete a user that does not exist';
		}
		//$this->db->close();
	}

}
