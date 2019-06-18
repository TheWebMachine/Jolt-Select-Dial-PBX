<?php

/**** **** **** **** **** **** **** **** **** **** **** **** **** **** 
 * freepbx_call.php
 * 
 * This script is a compliment to the project at: 
 *  https://github.com/Jolt1/Jolt-Select-Dial-PBX
 *
 * Instructions:
 *      Place a copy of this file in /var/www/html. Modify the Jolt
 *		extension URL to call this file.
 *		i.e.  https://pbx_address/freepbx_call.php
 *
 * License:
 *    The original MIT license terms apply
 *  
 *
 **** **** **** **** **** **** **** **** **** **** **** **** **** ****/

error_reporting(E_ALL);
ini_set('display_errors', 1);

// FreeBPX bootstrap, works on FreePBX 13+ 
$bootstrap_settings = array();
$bootstrap_settings['freepbx_auth'] = false;
include '/etc/freepbx.conf';



global $db;  		// FreePBX asterisk database connector
global $amp_conf;	// don't think we need this
global $astman;		// phpagi class

// User Parameters
	# set the context for dialling 
	$strContext = "from-internal";
	# specify the amount of time (in milliseconds) you want to try calling the specified channel before hanging up
	# make sure this time is shorter than the time it takes for voice mail to answer
	$strWaitTime = "5000";
	# specify the priority you wish to place on making this call
	$strPriority = "1";
	# specify the maximum amount of retries
	$strMaxRetry = "1";
	# Async setting
	$strAsync = 'no';

// get arguments
$ext = $_GET['exten'];

// Taken from call.php, some of this is prob not necessary
if(isset($_GET['number'])){
	$number=strtolower($_GET['number']);
}
elseif (isset($_GET['phone'])) {
	$number=strtolower($_GET['phone']);
}
//Clean up number
$number = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
$number = preg_replace("/[^0-9,.]/", "", $number);


// Get a 2D array of all FreePBX extension details
$get_all = FALSE;
$extension_array = FreePBX::Core()->listUsers($get_all);

// Convert the 2d array to a 1d array of just extension numbers
foreach ($extension_array as $bar) {
	$ext_list[] = $bar[0];
}

// Check if the extension number passed to the script is a valid system extension
if (in_array($ext,$ext_list)) {

	$strChannel = "local/".$ext."@$strContext";;    // Still need to carry the ext forward, tho
}
else {
	echo "Error: '$ext' is not a valid extension!";
	exit;
}


// Construct an array for dialling
$dial = array();
$dial['Channel'] = $strChannel;
$dial['Context'] = $strContext;
$dial['Exten'] = $number;
$dial['Priority'] = $strPriority;
$dial['Async'] = $strAsync;
$dial['Timeout'] = $strWaitTime;
$dial['CallerID'] = '"Click to dial" <'.$number.'>';

echo "Bridging extension $ext to number $number..." ;

// using $astman class from bootstrap, originate the call
$astman->Originate($dial);

