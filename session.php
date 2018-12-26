<?php  

	session_start();
	
	require_once 'dbconnection.php';
	$userName = "";
	$userPassword = "";
	$encodedBy = "";
	$userAccess = "";
	$employeeNumber = "";

	$userName = $_SESSION["userName"];
	$userPassword = $_SESSION["userPassword"];

	$sqlSearchName = "SELECT * FROM user_account_table WHERE user_name = '$userName' and user_password = '$userPassword' ";
	$resultSearchName = $conn->query($sqlSearchName);

	if($resultSearchName->num_rows > 0){
	  while ($row = mysqli_fetch_array($resultSearchName)) {
	      # code...
	      $encodedBy = $row['employee_number'];
	  }

	$sqlSP = "SELECT * FROM user_info_table WHERE employee_number = '$encodedBy'";
	$resultSP = $conn->query($sqlSP);

	if($resultSP->num_rows > 0){
		while ($rowSP = mysqli_fetch_array($resultSP)) {
			$userAccess = $rowSP['employee_position'];
		}
	}

	}else{
	    header("Location: http://system.local/MWMMPC/hone/login.php");
	}

?>