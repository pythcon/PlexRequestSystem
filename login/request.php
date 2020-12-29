<?php
session_start();
include('../account.php');
include('../functions.php');

if (!gatekeeper()){
	redirect("You are not logged in!");
}

$id = filter_input(INPUT_GET, "id");

$requestInfo = getRequestInfo($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Todd's Plex Request System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css">
	<link rel="icon" href="../logo.ico" type="image/icon type">
  	<link rel="apple-touch-icon" href="../icon.png">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="../index.html"><img src="../logo.png" style="width: 2rem;"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	        <a class="nav-link" href="../index.html">Home</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="admin.php">Requests</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="logout.php">Logout</a>
	      </li>
	</nav>
	<div class="container">
		<div class="row justify-content-center d-flex">
			<div class="col-5 mainLogo">
				<img src="../plex.png">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 headerContainer d-flex justify-content-center text-center">
				<div class="">
					<h3>Edit Request!</h3>
				</div>
			</div>
		</div>
		<div class="row justify-content-center d-flex">
			<div class="col-lg-10">
				<form class="form" method="POST" action="submit.php">
					<input type="hidden" class="form-control" name="id" <?php echo "value='".$id."'";?>>
					<div class="form-group">
						<label for="firstName">First Name:</label>
						<input type="text" class="form-control" name="firstName" <?php echo "value='".$requestInfo[0]."'";?>>
					</div>
					<div class="form-group">
						<label for="type">Type of Media:</label>
					</div>
					<div class="form-group">
						<?php
						switch ($requestInfo[1]) {
							case 'Movie':{
								$movieType = 'checked';
								break;
							}
							case 'TV Show':{
								$tvType = 'checked';
								break;
							}
							case 'Other':{
								$otherType = 'checked';
								break;
							}
						}
						?>
						<label class="radio-inline"><input type="radio" name="type" value="Movie" <?php echo $movieType;?>> Movie</label>
						&nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" name="type" value="TV Show" <?php echo $tvType;?>> TV Show</label>
						&nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" name="type" value="Other" <?php echo $otherType;?>> Other</label>
					</div>
					<div class="form-group">
						<label for="media">Name of Media:</label>
						<input type="text" class="form-control" name="media" <?php echo "value='".$requestInfo[2]."'";?>>
					</div>
					<div class="form-group">
						<label for="dateCreated">Date Created:</label>
						<input type="text" class="form-control" name="dateCreated" <?php echo "value='".$requestInfo[3]."'";?>>
					</div>
					<div class="form-inline">
						<label for="dateCompleted">Date Completed:&nbsp;</label>
						<input type="text" class="form-control" name="dateCompleted" <?php echo "value='".$requestInfo[4]."'";?>>
						&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-outline-danger form-control submitBtn" <?php echo "onclick='window.location.replace(\"completeRequest.php?id=".$id."\");'";?>>Complete Now</button>
					</div>
					<div class="form-group">
						<label for="notes">Notes:</label>
						<input type="text" class="form-control" name="notes" <?php echo "value='".$requestInfo[5]."'";?>>
					</div>
					<div class="form-group">
						<br>
						<button type="submit" class="btn btn-outline-danger form-control submitBtn">Update Request</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<footer class="page-footer font-small cyan darken-3">

	  <!-- Copyright -->
	  <div class="footer-copyright text-center py-3">© 2020
	    <a href="http://toddamurphy.me/"> Todd</a>
	  </div>
	  <!-- Copyright -->

	</footer>
	<!-- Footer -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 