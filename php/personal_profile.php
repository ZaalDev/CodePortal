<?php
	if(!isset($_SESSION))
		session_start();

	require_once __DIR__.'/path.php';
	require_once UTILS_DIR.'sessionUtil.php';
	require_once UTILS_DIR.'informationUtil.php';
	require_once UTILS_DIR.'profilePicUtil.php';

	if (!isLogged()) {
		header('location: ./login.php');
		exit;
	}

	$target_id = $_SESSION['userID'];
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_SESSION['username']; ?>'s Profile - CodePortal</title>
	<meta charset="utf-8">
	<meta name="author" content="Mario Virdis">
	<meta name="keywords" content="coding code programming social network socialnetwork programs C C++ Java Python">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
	<link rel="stylesheet" href="./../style/profile.css" type="text/css">
	<link rel="stylesheet" href="./../style/menu.css" type="text/css">

	<link rel="icon" type="image/png" href="./../images/codeportal_logo2.png"  >
</head>
<body>
	<?php include LAYOUT_DIR.'menu.php'; ?>
	<div>
		<div class="heading">
			<div class="profile_pic">
				<?php echo getPic($_SESSION['userID']); ?>
			</div>
			<div class="username">
				<h1><?php echo $_SESSION['username']; ?></h1>
			</div>
			<?php include LAYOUT_DIR.'profile_stats.php'; ?>
		</div>
		<div class="dashboard">
			<h2>Dashboard</h2>
			<ul class="dash_links">
				<li>
					<a>Change Profile Picture</a>
					<form id="profile_change_form" class="hidden"
						  method="POST" action="./utils/uploadUtil.php"
						  enctype="multipart/form-data">
						<input type="file" name="fileToUpload" required>
						<input type="Submit" name="submit" value="Send">
					</form>
				</li>
				<li>
					<a>Remove Profile Picture</a>
				</li>
				<li>
					<a href="./new_request.php">Create new Code request</a>
				</li>
			</ul>
		</div>
		<div style="height: 200px;"></div>
	</div>

	<script>
		var dashboard = document.getElementsByClassName('dashboard')[0];
		var options = dashboard.getElementsByTagName('a');

		// Change prof picture
		options[0].addEventListener('click', function(){
			var form = document.getElementById('profile_change_form');

			// Toggle della visibilita'
			if (form.getAttribute('class') == 'hidden') {
				form.setAttribute('class', '');
			} else {
				form.setAttribute('class', 'hidden');
			}
		});

		// Prof pic removal
		options[1].addEventListener('click', function() {
			if(window.confirm('Do you really want to delete your profile picture?')) {
				window.location = './utils/interactionDB.php?action=rm';
			}
		});
	</script>
</body>
</html>