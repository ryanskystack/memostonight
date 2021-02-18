<?php
    include "include/config.php";
    include "process_form.php";
	session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>View Celebrity Phonebook | Memos Tonight</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>



<!-- CARD AREA STARTS -->
<div class="container card">
  <img class="card-img-top centered thumbnail" src="profile_pics/<?= $v_picture ?>" alt="Celebrity Image" >
 
  <div class="card-body">
    <h4 class="card-title centered"><?= $v_first_name ?> <?= $v_middle_name ?> <?= $v_last_name ?>
			<br><span class="occupation">( <?= $v_occupation ?> )</span>
		</h4>
    <p class="card-text centered lead">
			<span class="content-head"> Contact Number: </span>
			<?= $v_mobile_number ?>
			<br/>
			<span class="address">
				<span class="content-head"> Address: </span>
				<?=  $v_street_no . " " . $v_street_name . ", <br/> " . $v_suburb . "  " . $v_state . " <br/> " . $v_country; ?>
			</span>
			<br/>
			<span class="email">
				<span class="content-head"> Email: </span>
				<?= $v_email ?>
			</span>
		</p>
  </div>
</div>
<!-- CARD AREA ENDS -->



<script src="script5.js"></script>
<script src="https://kit.fontawesome.com/41a0117d0b.js" crossorigin="anonymous"></script>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/all.js"></script>


</body>
</html>

