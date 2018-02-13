<?php

if(!isset($_SESSION))
	session_start();

require_once './path.php';
require_once UTILS_DIR.'sessionUtil.php';
require_once UTILS_DIR.'informationUtil.php';

if(!isLogged() || !isset($_GET['id'])) {
	header('location: ./login.php');
	exit;
}

$request = getRequest($_GET['id']);

if ($request==null) {
	header('location: ./home.php');
	exit;
}

$request = $request->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Request <?php echo $request['Titolo']; ?> - CodePortal</title>
	<meta charset="utf-8">
	<meta name="author" content="Mario Virdis">
	<meta name="keywords" content="coding code programming social network socialnetwork programs C C++ Java Python">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
	<link rel="stylesheet" href="./../style/view.css" type="text/css">
	<link rel="stylesheet" href="./../style/menu.css" type="text/css">

	<link rel="icon" type="image/png" href="./../images/codeportal_logo2.png"  >
</head>
<body>
	<?php include LAYOUT_DIR.'menu.php'; ?>
	<section>
		<div class="container">
			<h1><?php echo $request['Titolo']; ?></h1>
		</div>
	</section>
</body>
</html>