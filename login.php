<?php
    include "include/config.php";
	session_start();
	if (isset($_SESSION['userLogin'])) {
		header("location:book.php?message=You've already logged in.");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login | Memos Tonight</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/stylesheet.css">
</head>
<body>

<!-- HEADER STARTS -->
<?php 
     include "include/header.php";

?>
<!-- HEADER ENDS -->

<!-- BREADCRUMBS START -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="Login">Login</li>
  </ol>
	<?php if(isset($_SESSION['userLogin'])){ ?>
		<ol class="breadcrumb">
			<li class="breadcrumb-item active">
				<?php
					print "Logged in as: " . $_SESSION['userLogin'];
				?>
			</li>
		</ol>
	<?php } ?>
</nav>
<!-- BREADCRUMBS END -->




<div class="row">
	<div class="container">
		<form action="process_form.php" method="post" enctype="multipart/form-data">
		  <div class="form-group">
		    <label for="userName">User Name:</label>
		    <input type="userName" name="userName" class="form-control" id="userName" required>
		  </div>
		  <div class="form-group">
		    <label for="userPassword">Password:</label>
		    <input type="password" name="userPassword" class="form-control" id="userPassword" required>
		  </div>
	  	<input class="btn btn-primary" name="login" value="Login" type="submit">
		</form>
	</div>
</div>

<hr class="separator"/>


<!-- FOOTER STARTS -->
<?php include "include/footer.php"; ?>
<!-- FOOTER ENDS -->


<script src="https://kit.fontawesome.com/41a0117d0b.js" crossorigin="anonymous"></script>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/all.js"></script>
<script src="script.js"></script>
</body>
</html>

