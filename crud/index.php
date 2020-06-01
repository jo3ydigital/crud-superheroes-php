<?php
/**
 * Simple CRUD endpoint
 * @author Joey Digital
 * @version v1.0 | 2017-07-18
 * @return JSON messages with the format:
 *
 * { "response": "0" } 
 * { "response": "1" }
 *
 * If the query fails, MySQL will return 0.
 * However, we can return anything that we want for specific use cases, etc.
 */

# TESTING THIS CODE LOCALLY ON YOUR MACHINE
# ---------------------------------------------------------------------------------------------------------------------
# This file can be tested locally with Chrome using the CORS plugin and running WAMP, XAMP or something equivalent.
# Make sure to add this to the "Intercepted URLs or URL patterns" in the CORS plugin:
# http://*/localhost*
#
# This will ensure that we can run this code from Angular or something using a different port than the DB (WAMP , etc).
# If you don't do this the sky will fall on your head!
# ---------------------------------------------------------------------------------------------------------------------

require_once 'api.php'; // Include the api class
$api = new api();       // Create a new instance of the api class

# Our api key
$apiKey = 'jdr9175wz'; //$api->getApiKey($user_api, $user_apiKey);

header("Content-Type: application/json");

#== Get JSON as a string and create an object that we can use
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str);

# Parse JSON
$user_apiKey = $json_obj->api_key;
$api_action = $json_obj->api_action;

# Parse JSON depending on the action
switch($api_action) {
	case 'readSort':
		foreach ($json_obj as $key=>$value) {
			switch($key) {
				case 'orderBy': $orderBy = $value; break;
				case 'type': $type = $value; break;
			}
		}
		break;

	case 'read':
	case 'delete':
		foreach ($json_obj as $key=>$value) {
			switch($key) {
				case 'id': $id = $value; break;
			}
		}
		break;

	case 'create':
	case 'update':
		foreach ($json_obj as $key=>$value) {
			switch($key) {
				case 'editable': $editable = $value; break;
				case 'name': $name = $value; break;
				case 'realname': $realname = $value; break;
				case 'actor': $actor = $value; break;
				case 'img': $img = $value; break;
				case 'id': $id = $value; break;
			}
		}
		break;
}

# Check api credentials 
if($user_apiKey == $apiKey) {

	switch($api_action) {
		case 'readSort':
			$data = $api->readUsersSort($orderBy, $type);
			break;

		//== CRUD OPERATIONS
		case 'create':
			$data = $api->createUser($editable, $name, $realname, $actor, $img);
			break;

		case 'read':
			$data = $api->readUsers($id);
			break;

		case 'update':
			$data = $api->updateUser($name, $realname, $actor, $img, $id);
			break;

		case 'delete':
			$data = $api->deleteUser($id);
			break;
	}

	if($api_action != 'read' && $api_action != 'readSort') {
		$res = '{"response":"'.$data.'"}';
		echo json_encode($res);
	}


} else {
	$res = '{"response":"invalid api credentials"}';
	echo json_encode($res);
}

?>