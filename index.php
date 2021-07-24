<?php
// Different function name to not conflict with 
// /public/header.php function
function safeGetName() {
	$COOK = $_COOKIE['login'];
	$STATS = explode("\0", $COOK);
	$path = cleanFilename($STATS[0]);
	$path = __DIR__ . '/../data/accounts/'.$path;
	$hash = file_get_contents($path . '/psw.txt');
	if ($COOK != '') {
		if (password_verify($STATS[1], $hash)) {
			$match = true;
		} else {
			header('Location: '.$SERVER['DOCUMENT_ROOT'].'/invalidpass.php');
		}
		return $STATS[0];
	}
}
if (safeGetName() == 'admin') {
	echo '<br /><a href="app/tools/edit_tos.php">Edit</a>';
}
?>
