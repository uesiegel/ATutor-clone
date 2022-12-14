<?php
/****************************************************************/
/* ATutor														*/
/****************************************************************/
/* Copyright (c) 2002-2010                                      */
/* Inclusive Design Institute                                   */
/* http://atutor.ca												*/
/*                                                              */
/* This program is free software. You can redistribute it and/or*/
/* modify it under the terms of the GNU General Public License  */
/* as published by the Free Software Foundation.				*/
/****************************************************************/

define('AT_INCLUDE_PATH', '../../../../include/');
require(AT_INCLUDE_PATH.'vitals.inc.php');
admin_authenticate(AT_ADMIN_PRIV_ADMIN);

function getValidURI($uri)
{
	if (substr($uri, 0, 7) != 'http://' && substr($uri, 0, 8) != 'https://') {
		return false;
	}
	// add ending slash if uri does not contain
	if (substr($uri, -1) != '/') {
		$uri .= '/';
	}
	
	$connection = @file_get_contents($uri.'index.php');
	if (!$connection) {
		return false;
	}
	else {
		return $uri;
	}
}

if($_POST['submit']){
	$_POST['transformable_uri'] = trim($_POST['transformable_uri']);
	$_POST['transformable_web_service_id'] = trim($_POST['transformable_web_service_id']);
	$_POST['transformable_oauth_expire'] = intval($_POST['transformable_oauth_expire']);
	
	if ($_POST['transformable_uri'] == ''){
		$msg->addError('TRANSFORMABLE_URI_EMPTY');
	}
	
	$_POST['transformable_uri'] = getValidURI($_POST['transformable_uri']);

	if (!$_POST['transformable_uri']){
		$msg->addError('TRANSFORMABLE_URI_INVALID');
	}

	if (!$_POST['transformable_web_service_id']){
		$msg->addError('TRANSFORMABLE_ID_EMPTY');
	}		

	if (!$msg->containsErrors()) {
		$_POST['transformable_uri'] = $addslashes($_POST['transformable_uri']);
		$sql = "REPLACE INTO ".TABLE_PREFIX."config VALUES ('transformable_uri', '".$_POST['transformable_uri']."')";
		mysql_query($sql, $db);

		$_POST['transformable_web_service_id'] = $addslashes($_POST['transformable_web_service_id']);
		$sql = "REPLACE INTO ".TABLE_PREFIX."config VALUES ('transformable_web_service_id', '".$_POST['transformable_web_service_id']."')";
		mysql_query($sql, $db);
		
		$sql = "REPLACE INTO ".TABLE_PREFIX."config VALUES ('transformable_oauth_expire', '".$_POST['transformable_oauth_expire']."')";
		mysql_query($sql, $db);
		
		$msg->addFeedback('TRANSFORMABLE_CONFIG_SAVED');
	
		header('Location: '.$_SERVER['PHP_SELF']);
		exit;
	}
}

$onload = "document.form.transformable_uri.focus();";
require (AT_INCLUDE_PATH.'header.inc.php');
?>
    <div class="input-form">
        <div class="row">
            <p><?php echo _AT('tile_setup_txt');  ?></p>
        </div>
    </div>


<?php 
$savant->display('admin/system_preferences/module_setup.tmpl.php');
require(AT_INCLUDE_PATH.'footer.inc.php'); ?>