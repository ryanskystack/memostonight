<?php
	include "include/config.php";
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Celebrity Phonebook | Memos Tonight</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/stylesheet.css">
	
	


</head>
<body>

<!-- HEADER STARTS -->
<?php 
     include 'include/header.php';

?>
<!-- HEADER ENDS -->

<!-- BREADCRUMBS START -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>    
    <li class="breadcrumb-item active" aria-current="Phonebook">Book</li>
  </ol>
	<?php if(isset($_SESSION['userLogin'])){ ?>
		<ol class="breadcrumb">
			<li class="breadcrumb-item active" id="loginTag" >
				<?php
					echo "Logged in as: " . $_SESSION['userLogin'];
				?>
			</li>
		</ol>
	<?php } ?>
</nav>
<!-- BREADCRUMBS END -->


<div class="alert alert-dismissable centered">
    <div id="message"></div>
	<!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
	
</div>

<div class="container phonebook-container row col-lg-12">
	<div class="container phonebook col-lg-4">
		<h4>Search for Celebrity</h4>
		<hr class="heading-underline" />
		<p class="lead">Enter your search criteria below</p>
        <div>
            <div class="form-group">
		        <label for="searchName">Search by Name:</label>
                <input type="searchName" name="searchName" class="form-control" id="searchByName">                
		    </div>
		    <input class="btn btn-primary" name="search" value="Search" type="button" id="searchView" onclick="displayCele()" />
    	</div>
	</div>
	<div class="container phonebook col-lg-4">
		<h4>View All Celebrities</h4>
		<hr class="heading-underline" />
		<p class="lead">Click the button to view all your celebrities</p><br>
        <input class="btn btn-primary" name="viewAll" value="ViewAll" type="button" id="showAll" onclick="displayAllCele()" />

    </div>
	<!-- Button trigger add modal -->
	


	<?php if(isset($_SESSION['userLogin'])){ ?>
		<div class="container phonebook col-lg-4">
		    <h4>Add Celebrity</h4>
		    <hr class="heading-underline" />
		    <p class="lead">Click the button to add your celebrity</p><br>
            <!-- <input class="btn btn-primary" name="addCele" value="Add" type="button" id="addCele" onclick="addACele()" /> -->
            <button type="button" class="btn btn-primary" name="addCele" id="addCele" onclick="displayAdd()" >Add New</button>
        </div>
	<?php } ?>


    <!-- Add Modal -->
    <div class="container" id="addFrame" style="display:none">	
        <div class="modal-dialog modal-dialog-centered modal-lg" >
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add New Celebrity</h5>	        
              </div>
	          <div class="modal-body">                    
                    <form id="addCelebrity" method="POST" enctype="multipart/form-data">
                       	<div class="form-row">
	        				<div class="form-group col">
	        				  <label for="addFirstName">First Name:</label>
	        				  <input type="text" name="addFirstName" id="addFirstName" class="form-control" placeholder="Enter First Name" required>
	        				</div>
	        				<div class="form-group col">
	        				  <label for="addMiddleName" >Middle Name:</label>
	        				  <input type="text" name="addMiddleName" id="addMiddleName" class="form-control" placeholder="Enter Middle Name" data-toggle="tooltip" data-placement="bottom" title="Put space if there is no middle name">
	        				</div>
	        				<div class="form-group col">
	        				  <label for="addLastName">Last Name:</label>
	        				  <input type="text" name="addLastName" id="addLastName" class="form-control" placeholder="Enter Last Name" required>
	        				</div>
	        			</div>
	        			<div class="form-row">
	        				<div class="form-group col">
	        					<label for="addOccupation">Occupation:</label>
	        					<select name="addOccupation" id="addOccupation" class="form-control" required>
                                       <option value='0'>Select an occupation</option>                                  
                                       <?php
	        							$sqlOccupation="SELECT * FROM occupation";
	        							$rowOccupation=$conn->query($sqlOccupation);
	        							while ($row=$rowOccupation->fetch(PDO::FETCH_ASSOC)){
	        								echo "<option value='$row[occupationId]'>" . $row['occupation'] . "</option>";
	        							}
	        						?>             
	        					</select>
	        				</div>
	        				<div class="form-group col">
	        				</div>
	        			</div>
	        			<div class="form-row">
                            <div class="form-group col">
	        					<label for="addCountry">Enter Country:</label>
	        					<select name="addCountry" id="addCountry" class="form-control" onchange="addLoadStates(this);" required>
	        					   	<option value='0'>Select a country</option>
                                          <?php
	        							$sqlCountry="SELECT * FROM country";
	        							$rowCountry=$conn->query($sqlCountry);
	        							while ($row=$rowCountry->fetch(PDO::FETCH_ASSOC)){
	        								echo "<option value='$row[countryId]'>" . $row['country'] . "</option>";
                                           }
                                          ?>                               
	        					</select>
	        				</div>
	        				<div class="form-group col">
	        					<label for="addState">Enter State:</label>
	        					<select name="addState" id="addState" class="form-control" required >
                                       <option value='0'>Select a state</option>
	        					</select>
	        				</div>
	        				<div class="form-group col">
	        					<label for="addSuburb">Enter Suburb:</label>
	        					<select name="addSuburb" id="addSuburb" class="form-control" required>
                                       <option value='0'>Select a suburb</option>
                                       <?php
	        							$sqlSuburb="SELECT * FROM suburb_postcode";
	        							$rowSuburb=$conn->query($sqlSuburb);
	        							while ($row=$rowSuburb->fetch(PDO::FETCH_ASSOC)){
	        								echo "<option value='$row[postcodeId]'>" . $row['suburb'] . "</option>";
	        							}?>
	        					</select>
	        				</div>
	        			</div>
	        			<div class="form-row">
	        				<div class="form-group col">
	        					<label for="addStreetNumber">Street Number:</label>
	        					<input type="text" name="addStreetNumber" id="addStreetNumber" class="form-control" placeholder="Enter Street Number" required>
	        				</div>
	        				<div class="form-group col">
	        					<label for="addStreetName">Street Name:</label>
	        					<input type="text" name="addStreetName" id="addStreetName" class="form-control" placeholder="Enter Street Name" required>
	        				</div>
	        			</div>
	        			<div class="form-row">
	        				<div class="form-group col">
	        				  <label for="addMobile">Mobile Number:</label>
	        				  <input type="text" name="addMobile" id="addMobile" class="form-control" placeholder="Enter Mobile Number" required>
	        				</div>
	        				<div class="form-group col">
	        				  <label for="addEmail">Email Address:</label>
	        				  <input type="email" name="addEmail" id="addEmail" class="form-control" placeholder="Enter Email Address" required>
	        				</div>
	        			</div>
	        			<div class="form-row">
	        				<div class="form-group col">
                                <input type="file" id='addImage' name="addImage" class="custom-file" value="Add Picture" accept="image/*"  required>     
                                                        
	        				</div>
	        			</div>
	        			<input type="submit" class="btn btn-info update" name="addCelebrityButton" value="Add">
	        		</form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAdd()">Close</button>
              </div>
            </div>
        </div>
    </div>

</div>

<!-- <hr class="separator"/> -->

<!-- viewAll and search show place include two paginator bars-->
<div class="container " id="viewAllFrame" style="display:none">
    <div class="justify-content-center">
        <input type="button" class="page-item" id="first1" onclick="firstPage()" value="first" />
        <input type="button" class="page-item" id="previous1" onclick="previousPage()" value="<<" />
        <input type="button" class="page-item" id="next1" onclick="nextPage()" value=">>" />
        <input type="button" class="page-item" id="last1" onclick="lastPage()" value="last" />
    </div>
    <div class="container  col-lg-12" id="display"></div>
    <div class="justify-content-center">
        <input type="button" class="page-item" id="first2" onclick="firstPage()" value="first" />
        <input type="button" class="page-item" id="previous2" onclick="previousPage()" value="<<" />
        <input type="button" class="page-item" id="next2" onclick="nextPage()" value=">>" />
        <input type="button" class="page-item" id="last2" onclick="lastPage()" value="last" />
    </div>
</div><br><br>

<!-- Update Modal -->
<div class="container" id="updateFrame" style="display:none">	
  <div class="modal-dialog modal-dialog-centered modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update a Celebrity</h5>	        
      </div>
		<div class="modal-body">                    
            <form id="updateCelebrity" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <span id="keyIndex" style="visibility: hidden"></span>
                                   
                </div>
                <input type="hidden" name="cele_id" id="cele_id" value="" >
               	<div class="form-row">
					<div class="form-group col">
					  <label for="updateFirstName">First Name:</label>
					  <input type="text" name="updateFirstName" id="updateFirstName" class="form-control" placeholder="Enter First Name" required>
					</div>
					<div class="form-group col">
					  <label for="updateMiddleName" >Middle Name:</label>
					  <input type="text" name="updateMiddleName" id="updateMiddleName" class="form-control" placeholder="Enter Middle Name" data-toggle="tooltip" data-placement="bottom" title="Put space if there is no middle name">
					</div>
					<div class="form-group col">
					  <label for="updateLastName">Last Name:</label>
					  <input type="text" name="updateLastName" id="updateLastName" class="form-control" placeholder="Enter Last Name" required>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col">
						<label for="updateOccupation">Occupation:</label>
						<select name="updateOccupation" id="updateOccupation" class="form-control" required>
                               <option value='0'>Select an occupation</option>                                  
                               <?php
								$sqlOccupation="SELECT * FROM occupation";
								$rowOccupation=$conn->query($sqlOccupation);
								while ($row=$rowOccupation->fetch(PDO::FETCH_ASSOC)){
									echo "<option value='$row[occupationId]'>" . $row['occupation'] . "</option>";
								}
							?>             
						</select>
					</div>
					<div class="form-group col">
					</div>
				</div>
				<div class="form-row">
                    <div class="form-group col">
						<label for="updateCountry">Enter Country:</label>
						<select name="updateCountry" id="updateCountry" class="form-control" onchange="updateLoadStates(this);" required>
						   	<option value='0'>Select a country</option>
                                  <?php
								$sqlCountry="SELECT * FROM country";
								$rowCountry=$conn->query($sqlCountry);
								while ($row=$rowCountry->fetch(PDO::FETCH_ASSOC)){
									echo "<option value='$row[countryId]'>" . $row['country'] . "</option>";
                                   }
                                  ?>                               
						</select>
					</div>
					<div class="form-group col">
						<label for="updateState">Enter State:</label>
						<select name="updateState" id="updateState" class="form-control" required >
                               <option value='0'>Select a state</option>
						</select>
					</div>
					<div class="form-group col">
						<label for="updateSuburb">Enter Suburb:</label>
						<select name="updateSuburb" id="updateSuburb" class="form-control" required>
                               <option value='0'>Select a suburb</option>
                               <?php
								$sqlSuburb="SELECT * FROM suburb_postcode";
								$rowSuburb=$conn->query($sqlSuburb);
								while ($row=$rowSuburb->fetch(PDO::FETCH_ASSOC)){
									echo "<option value='$row[postcodeId]'>" . $row['suburb'] . "</option>";
								}?>
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col">
						<label for="updateStreetNumber">Street Number:</label>
						<input type="text" name="updateStreetNumber" id="updateStreetNumber" class="form-control" placeholder="Enter Street Number" required>
					</div>
					<div class="form-group col">
						<label for="updateStreetName">Street Name:</label>
						<input type="text" name="updateStreetName" id="updateStreetName" class="form-control" placeholder="Enter Street Name" required>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col">
					  <label for="updateMobile">Mobile Number:</label>
					  <input type="text" name="updateMobile" id="updateMobile" class="form-control" placeholder="Enter Mobile Number" required>
					</div>
					<div class="form-group col">
					  <label for="updateEmail">Email updateress:</label>
					  <input type="email" name="updateEmail" id="updateEmail" class="form-control" placeholder="Enter Email updateress" required>
					</div>
				</div>
                <div class="form-row">
				    <div class="form-group col">
                        <input type="file" id='updateImage' name="updateImage" class="custom-file" value="Update Picture" accept="image/*"  required>  
                        <input type="submit" class="btn btn-info update" name="updateCelebrityButton" value="Update">
				    </div>
				    <div class="form-group col">
                        <input type="hidden" name="oldLink" id="oldLink" value="">
				    	   
				    	<img src="" class="thumbnail" id="oldImage"alt="Old Image">
				    </div>
			    </div>
                <div class="form-row">
				    <div class="form-group col">				    	
				    </div>
				    <div class="form-group col">
				    	<p id="imageName"></p>
				    </div>
			    </div>
			</form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeUpdate()">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- View Modal -->
<div class="container card" id="viewFrame" style="display:none">    
    

    
</div>

<!-- FOOTER STARTS -->
<?php include "include/footer.php"; ?>
<!-- FOOTER ENDS -->

<script src="https://kit.fontawesome.com/41a0117d0b.js" crossorigin="anonymous"></script>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/all.js"></script>
<script src="script.js"></script>
<script type="text/javascript">  
            function googleTranslateElementInit() {  
                new google.translate.TranslateElement( 
                    {pageLanguage: 'en'},  
                    'google_translate_element' 
                );  
            }  
</script>      
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"> 
</script>  



</body>
</html>

