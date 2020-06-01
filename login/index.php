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

# Our api key - TODO: create an api-users table with api key, username, email, etc.
$apiKey = 'jdr9175wz'; //$api->getApiKey($user_api, $user_apiKey);

//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Origin: http://localhost:4200');
//header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
//header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Content-Type: application/json");

#== Get JSON as a string and create an object that we can use
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str);

#== Parse JSON
$user_apiKey = $json_obj->api_key;
$username = $json_obj->username;
$password = $json_obj->password;

# Check api credentials 
if($user_apiKey == $apiKey) {

	$data = $api->login($username, $password);
	//$res = '{"response":"'.$data.'"}';
	echo json_encode($data);

} else {
	$res = '{"response":"invalid api credentials"}';
	echo json_encode($res);
}

?>