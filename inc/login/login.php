<?php
function cleaner ($s) {
	if (get_magic_quotes_gpc()) {
		$s = stripslashes($s);
	}
	
	if (phpversion() >= '4.3.0') {
		$s = mysql_real_escape_string($s);
	} else {
		$s = mysql_escape_string($s);
	}
	return $s;
}

$mysqli = new mysqli('localhost', 'root', 'root', 'photobrawler');
if ($mysqli->connect_errno) {
	echo 'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
} else {
	
	$email = cleaner($_POST['email']);
	$password = cleaner($_POST['password']);

	$stmt = $mysqli->prepare('
		SELECT email, password, id FROM accounts
		WHERE email = ? AND password = ?
	');
	
	$stmt->bind_param('ss', $email, $password);
	echo 'email: ' . $email . '<br/>';
	//echo 'password: ' . $password . '<br/>';
	if ($stmt->execute()) {
		$stmt->bind_result($col1, $col2, $col3);
		if ($stmt->fetch() == 1) {
			session_start();
			$_SESSION['email'] = $email;
			$_SESSION['userid'] = $col3;
			header('Location: ../../index.php?loggedin=true');
			exit;
		} else {
			header('Location: ../../index.php?loggedin=false');
			exit;
		}
	} else {
		echo 'Failed to execute.';
	}
}
