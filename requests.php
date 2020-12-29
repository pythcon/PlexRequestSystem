<?php
include('account.php');
include('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Todd's Plex Request System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="logo.ico" type="image/icon type">
  	<link rel="apple-touch-icon" href="icon.png">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="index.html"><img src="logo.png" style="width: 2rem;"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	        <a class="nav-link" href="index.html">Home</a>
	      </li>
	      <li class="nav-item active">
	        <a class="nav-link" href="requests.php">Requests <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="./login/index.html">Login</a>
	      </li>
	</nav>
	<div class="container">
		<div class="row justify-content-center d-flex">
			<div class="col-5 mainLogo">
				<img src="plex.png">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 headerContainer d-flex justify-content-center text-center">
				<div class="">
					<h3>Here are a list of all the requests!</h3>
					<p>(<span style="color: red;">Red</span> = not started | <span style="color: yellow;">Yellow</span> = in progress | <span style="color: green;">Green</span> = complete)</p>
				</div>
			</div>
		</div>
		<div class="row justify-content-center d-flex">
			<div class="col-lg-10" style="overflow: auto;">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Name</th>
							<th>Type</th>
							<th>Name of Media</th>
							<th>Date Created</th>
							<th>Date Completed</th>
							<th>Notes</th>
						</tr>
					</thead>
					<tbody>
						<?php echo getRequests(); ?>
					</tbody>
				</table>
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