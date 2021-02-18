<?php
session_start();
$_SESSION["countryId"] = null;
$_SESSION["postcode"] = null;
$_SESSION["stateId"] = null;

include ('include/config.php');

$sql="";

if ((isset($_POST["mode"])) && $_POST["mode"] == "showAll")
{
	$viewAllArr = array();
    $sql = "SELECT distinct * FROM celebrities, state, suburb_postcode, country, occupation
	WHERE celebrities.occupationId=occupation.occupationId
	AND celebrities.stateId=state.stateId
	AND celebrities.countryId=country.countryId
	AND celebrities.postcodeId=suburb_postcode.postcodeId
    ORDER BY celebrity_first_name ASC"
  ;
	$result = $conn->query($sql);//query is a method od PDO class, conn is an object of the PDO class
	//echo $result->rowCount();
	if ($result->rowCount() != 0)	
	{
		while ($row = $result->fetch(PDO::FETCH_ASSOC))//row is an associative array
		{
			array_push($viewAllArr, $row);
		}
    echo json_encode($viewAllArr);
	}
	else
	{

		echo -1;
	}
}else
if ((isset($_POST["mode"])) && $_POST["mode"] == "search")
{
	$celeName = $_POST["celeName"];
	$searchArray = array();
	$sql = "select * from celebrities 
        	left join state on celebrities.stateId=state.stateId
        	left join suburb_postcode on celebrities.postcodeId=suburb_postcode.postcodeId
        	left join country on celebrities.countryId=country.countryId
        	left join occupation on celebrities.occupationId=occupation.occupationId
        	where celebrities.celebrity_first_name LIKE '%" . $celeName . "%'
        	or celebrities.celebrity_middle_name LIKE '%" . $celeName . "%' 
        	or celebrities.celebrity_last_name LIKE '%" . $celeName . "%'
        	ORDER BY celebrity_first_name ASC
           ";
									   

	$result = $conn->query($sql);//query is a method od PDO class, conn is an object of the PDO class
	//echo $result->rowCount();
	//exit();
	if ($result->rowCount() != 0)	
	{
		while ($row = $result->fetch(PDO::FETCH_ASSOC))//row is an associative array
		{
			array_push($searchArray, $row);
			
		}
		echo json_encode($searchArray);
	}
	else
	{
		echo -1;
	}
}else if(isset($_POST['login'])){


		$user_name=$_POST['userName'];
		$user_password=$_POST['userPassword'];
	
		$userIdQuery="SELECT * FROM administrator WHERE admin_userid = :admin_userid
		              AND admin_password = :admin_password
		             ";		
		$userIdStmt=$conn->prepare($userIdQuery);
		$userIdStmt->bindParam(":admin_userid",$user_name);
		$userIdStmt->bindParam(":admin_password",$user_password);
		$userIdStmt->execute();
			if($userIdStmt->rowCount() != 0)
		    {
				$userLogin=$userIdStmt->fetch(PDO::FETCH_ASSOC);				
				$_SESSION['userLogin']=$userLogin['admin_name'];
				header('location:book.php');
		    }else{
				header("location:login.php?response=Valid user name or password.&res_type=danger");
				exit();
			}

}else
if ((isset($_POST["mode"])) && $_POST["mode"] == "loadStates")
{
	$countryID = $_POST["CountryID"];
	
	$countryArray = array();
	$sql = "select distinct county_state.stateId, state.state from county_state
			left join state on county_state.stateId=state.stateId 
			where county_state.`countyId` = $countryID";

	$result = $conn->query($sql);
	if ($result->rowCount() != 0){
			while ($row = $result->fetch(PDO::FETCH_ASSOC))			
		{
			array_push($countryArray, $row);
		}		
	}
	echo json_encode($countryArray);

} else if (isset($_POST["addFirstName"])) {
	
	$addFN = $_POST["addFirstName"];
	$addMN = $_POST["addMiddleName"];
	$addLN = $_POST["addLastName"];
	$addOccupationId = $_POST["addOccupation"];
	$addCountryId= $_POST["addCountry"];
	$addStateId= $_POST["addState"];
	$addStreetNo=$_POST['addStreetNumber'];
    $addStreetName=$_POST['addStreetName'];
    $addPostcode=$_POST['addSuburb'];    
    $addEmail=$_POST['addEmail'];
    $addMobile=$_POST['addMobile'];
	$photo= ($_FILES['addImage']['name']);	
    $upload= "profile_pics/".$photo;

	$searchQuery="SELECT * FROM celebrities 
	WHERE celebrity_first_name='$addFN' 
	AND celebrity_last_name='$addLN' 
	AND occupationId  = '$addOccupationId'
	AND countryId = '$addCountryId'
	";
	
	$result = $conn->query($searchQuery);
	if ($result->rowCount() != 0) {
		echo "The celebrity exists. Adding process fails!";
	}
	else
	{
		
	  //prepare sql and bind parameters
	  $stmt = $conn->prepare("INSERT INTO celebrities
      VALUES (celebrity_id, :celebrity_first_name,
	  :celebrity_middle_name, :celebrity_last_name,
	  :occupationId, :celebrity_street_no, :celebrity_street_name,
	  :stateId, :postcodeId, :countryId,
	  :celebrity_email, :celebrity_mobile_number, :celebrity_picture	  
	  )"); 	  
	  	  
	 $stmt->bindParam(':celebrity_first_name', $addFN);
	 $stmt->bindParam(':celebrity_middle_name', $addMN);
	 $stmt->bindParam(':celebrity_last_name', $addLN);
	 $stmt->bindParam(':occupationId', $addOccupationId);
	 $stmt->bindParam(':celebrity_street_no', $addStreetNo);
	 $stmt->bindParam(':celebrity_street_name', $addStreetName);
	 $stmt->bindParam(':stateId', $addStateId);
	 $stmt->bindParam(':postcodeId', $addPostcode);
	 $stmt->bindParam(':countryId', $addCountryId);
	 $stmt->bindParam(':celebrity_email', $addEmail);
	 $stmt->bindParam(':celebrity_mobile_number', $addMobile);
	 $stmt->bindParam(':celebrity_picture', $photo);

	 $stmt->execute();
	 move_uploaded_file($_FILES['addImage']['tmp_name'],$upload);

	 if ($stmt)
	 {
		 echo "Add Successfully! The new added celebrity is " . $addFN." ".$addMN." ". $addLN;
	 }
	 else
	 {
		 echo "Adding process fails.";
	 } 

	}

}else if (isset($_GET['view'])) {
	$viewid=$_GET['view'];

// prepare sql and bind parameters

$viewQuery = "select * from celebrities 
        	 left join state on celebrities.stateId=state.stateId
        	 left join suburb_postcode on celebrities.postcodeId=suburb_postcode.postcodeId
        	 left join country on celebrities.countryId=country.countryId
        	 left join occupation on celebrities.occupationId=occupation.occupationId
        	 where celebrities.celebrity_id= :celebrity_id
             ";
$viewStmt = $conn->prepare($viewQuery);
$viewStmt->bindParam(':celebrity_id', $viewid);
$viewStmt->execute();

	if ($viewStmt->rowCount() != 0){
		$viewRow=$viewStmt->fetch(PDO::FETCH_ASSOC);
		$v_id=$viewRow['celebrity_id'];
        $v_first_name=$viewRow['celebrity_first_name'];
        $v_middle_name=$viewRow['celebrity_middle_name'];
        $v_last_name=$viewRow['celebrity_last_name'];
        $v_occupation_id=$viewRow['occupationId'];
        $v_occupation=$viewRow['occupation'];
        $v_street_no=$viewRow['celebrity_street_no'];
        $v_street_name=$viewRow['celebrity_street_name'];
        $v_state_id=$viewRow['stateId'];
        $v_state=$viewRow['state'];
        $v_suburb_postcode=$viewRow['postcode'];
        $v_suburb=$viewRow['suburb'];
        $v_country_id=$viewRow['countryId'];
        $v_country=$viewRow['country'];
        $v_email=$viewRow['celebrity_email'];
        $v_mobile_number=$viewRow['celebrity_mobile_number'];
        $v_picture=$viewRow['celebrity_picture'];	
		
	}else{
      echo "Viewing process fails.";
	} 
}else
if ((isset($_POST["mode"])) && $_POST["mode"] == "delete")
{
	$deleteCeleID = $_POST["celebrityID"];
	$deleteCelePic = $_POST["celebrityPic"];
	$imagepath="profile_pics/" . $deleteCelePic;
    unlink($imagepath);
	$deleteQuery = "delete from celebrities where celebrity_id  = $deleteCeleID";
	$deleteResult = $conn->query($deleteQuery);

	if ($deleteResult)
	{
		echo 1;
	}
	else
	{
		echo -1;
	}
}else 
if(isset($_POST['updateFirstName'])){
    $id=$_POST['cele_id'];
    $updateFN=$_POST['updateFirstName'];
    $updateMN=$_POST['updateMiddleName'];
    $updateLN=$_POST['updateLastName'];
    $updateOccupationId=$_POST['updateOccupation'];
    $updateStreetNo=$_POST['updateStreetNumber'];
    $updateStreetName=$_POST['updateStreetName'];
    $updateStateId=$_POST['updateState'];
    $updatePostcode=$_POST['updateSuburb'];
    $updateCountryId=$_POST['updateCountry'];
    $updateEmail=$_POST['updateEmail'];
    $updateMobile=$_POST['updateMobile'];
    $oldimage=$_POST['oldLink'];

    if(isset($_FILES['updateImage']['name']) && ($_FILES['updateImage']['name']!="")){
      $newimage=$_FILES['updateImage']['name'];
      $newimagepath="profile_pics/".$_FILES['updateImage']['name'];
      unlink($oldimage);
      move_uploaded_file($_FILES['updateImage']['tmp_name'],$newimagepath);
    }
    else{
      $newimage=$oldimage;
    }
    $updateQuery="UPDATE celebrities SET celebrity_first_name=:celebrity_first_name,
                  celebrity_middle_name=:celebrity_middle_name,celebrity_last_name=:celebrity_last_name,
                  occupationId=:occupationId,celebrity_street_no=:celebrity_street_no,celebrity_street_name=:celebrity_street_name,
                  stateId=:stateId,postcodeId=:postcodeId,countryId=:countryId,
                  celebrity_email=:celebrity_email,celebrity_mobile_number=:celebrity_mobile_number,celebrity_picture=:celebrity_picture
                  WHERE celebrity_id=:celebrity_id;
				  ";
	$stmt = $conn->prepare($updateQuery);
	$stmt->bindParam(':celebrity_first_name', $updateFN);
	$stmt->bindParam(':celebrity_middle_name', $updateMN);
	$stmt->bindParam(':celebrity_last_name', $updateLN);
	$stmt->bindParam(':occupationId', $updateOccupationId);
	$stmt->bindParam(':celebrity_street_no', $updateStreetNo);
	$stmt->bindParam(':celebrity_street_name', $updateStreetName);
	$stmt->bindParam(':stateId', $updateStateId);
	$stmt->bindParam(':postcodeId', $updatePostcode);
	$stmt->bindParam(':countryId', $updateCountryId);
	$stmt->bindParam(':celebrity_email', $updateEmail);
	$stmt->bindParam(':celebrity_mobile_number', $updateMobile);
	$stmt->bindParam(':celebrity_picture', $newimage);
	$stmt->bindParam(':celebrity_id', $id);
	$stmt->execute();

	if ($stmt)
	{
		echo "Update Successfully! The updated celebrity is " . $updateFN." ".$updateMN." ". $updateLN;
	}
	else
	{
		echo "Updating process fails.";
	}    
}    
    

?>


