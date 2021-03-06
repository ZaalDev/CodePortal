<?php
	if(!isset($_SESSION))
		session_start();

	if (!isset($_GET['id'])) {
		header('location: ./home.php');
		exit;
	}

	require_once __DIR__.'/path.php';
	require_once UTILS_DIR.'informationUtil.php';
	require_once UTILS_DIR.'profilePicUtil.php';

	$res = id2Username($_GET['id'])->fetch_assoc();
	$target_username = $res['Username'];
	$target_id = $_GET['id'];

	// Flag per sapere se l'utente che sta guardando la pagina
	// e' amico dell'utente mostrato nel qual caso
	// viene visualizzato il pulsante adeguatamente
	$friends_flag = 0;
	if (isLogged()) {
		$friends_flag = checkFriendship($_GET['id']);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $target_username; ?>'s Profile - CodePortal</title>
	<meta charset="utf-8">
	<meta name="author" content="Mario Virdis">
	<meta name="keywords" content="coding code programming social network socialnetwork programs C C++ Java Python">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
	<link rel="stylesheet" href="./../style/profile.css" type="text/css">
	<link rel="stylesheet" href="./../style/menu.css" type="text/css">

	<link rel="icon" type="image/png" href="./../images/codeportal_logo2.png"  >
</head>
<body>
	<?php
		if (isLogged()) include LAYOUT_DIR.'menu.php';
	?>
	<div>
		<div class="heading">
			<div class="profile_pic">
				<?php echo getPic($_GET['id']); ?>
			</div>
			<div class="username">
				<h1><?php echo $target_username; ?></h1>
			</div>
			<form action="./utils/interactionDB.php?action=sendReq" method="POST">
				<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
				<?php
					if ($friends_flag == 1) {

						echo '<input type="submit" value="Pending Request" disabled></input>';

					} elseif ($friends_flag == 0) {

						echo '<input type="submit" value="Add Friend"></input>';

					}
				?>
			</form>
			<?php include LAYOUT_DIR.'profile_stats.php'; ?>
		</div>
	</div>
</body>
</html>