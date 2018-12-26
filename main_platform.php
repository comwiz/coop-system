<html lang="en">

<?php  

$userName = "";
$userPassword = "";

$idNumber = "";
$accountNumber = "";

$firstName = "";
$middleName = "";
$lastName = "";

$presentAddress = "";
$permanentAddress = "";
$provincialAddress = "";

$birthPlace = "";
$birthDate = "";
$tinNumber = "";
$sssNumber = "";
$religion = "";
$educationalAttainment = "";
$brNumber = "";
$occupation = "";
$gender = "";
$civilStatus = "";

$mobileNumber = "";
$emailAddress = "";
$emergencyContactName = "";
$emergencyContactNumber = "";

$referalIdNumber = "";
$membershipStatus = "";

$identifier = "";
$countErr = "";

include 'dbconnection.php';

$sql = "SELECT * FROM name_table";
$result = $conn->query($sql);
$count = mysqli_num_rows($result);

$idNumber = $count + 1;
$accountNumber = 'MWMMPC' . $idNumber;


if ($_SERVER["REQUEST_METHOD"] == "POST") {


	if(!empty($_POST["idNumber"])){
		$idNumber = test_input($_POST["idNumber"]);
	}
	
	if(!empty($_POST["idNumber"])){
		$accountNumber = test_input($POST["accountNumber"]);
	}

	if (empty($_POST["firstName"])) {
	    $countErr++;
	 } else {
	    $firstName = test_input($_POST["firstName"]);
	    // check if first name only contains letters and whitespace
	    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
	      $countErr++;
	    }
     }
	 

	 if(!empty($_POST["middleName"])){
		$middleName = test_input($_POST["middleName"]);
	}
	  
	 if (empty($_POST["lastName"])) {
	    $countErr++;
	 } else {
	    $lastName = test_input($_POST["lastName"]);
	    // check if first name only contains letters and whitespace
	    if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
	      $countErr++;
	    }
	 }

  //Set value of variables of address information
  if (empty($_POST["presentAddress"])) {
    $countErr++;
  } else {
    $numberAddress = test_input($_POST["presentAddress"]);
  }
  if (empty($_POST["permanentAddress"])) {
    $countErr++;
  } else {
    $streetAddress = test_input($_POST["permanentAddress"]);
  }
  if (empty($_POST["provincialAddress"])) {
    $countErr++;
  } else {
    $barangayAddress = test_input($_POST["provincialAddress"]);
  }
  

    //Set value of variables of contact information

  if (!empty($_POST["emailAddress"])) {
    $emailAddress = test_input($_POST["emailAddress"]);
  }
  

  if (empty($_POST["mobileNumber"])) {
    $countErr++;
  } else {
    $mobileNumber = test_input($_POST["mobileNumber"]);
  }

  if (empty($_POST["emergencyContactName"])) {
    $countErr++;
  } else {
    $emergencyContactName = test_input($_POST["emergencyContactName"]);
  }

  if (empty($_POST["emergencyContactNumber"])) {
    $countErr++;
  } else {
    $emergencyContactNumber = test_input($_POST["emergencyContactNumber"]);
  }

  //Set value of variables of birth information
  if (empty($_POST["birthPlace"])) {
    $countErr++;
  } else {
    $birthPlace = test_input($_POST["birthPlace"]);
  }
  if (empty($_POST["birthDate"])) {
    $countErr++;
  } else {
    $birthDate = test_input($_POST["birthDate"]);
  }


  if (empty($_POST["tinNumber"])) {
    $countErr++;
  } else {
    $tinNumber = test_input($_POST["tinNumber"]);
  }

  if (empty($_POST["sssNumber"])) {
    $countErr++;
  } else {
    $sssNumber = test_input($_POST["sssNumber"]);
  }

  if (empty($_POST["religion"])) {
    $countErr++;
  } else {
    $religion = test_input($_POST["religion"]);
  }

  if (empty($_POST["educationalAttainment"])) {
    $countErr++;
  } else {
    $educationalAttainment = test_input($_POST["educationalAttainment"]);
  }

  if (empty($_POST["occupation"])) {
    $countErr++;
  } else {
    $occupation = test_input($_POST["occupation"]);
  }
  
  if (empty($_POST["brNumber"])) {
    $countErr++;
  } else {
    $brNumber = test_input($_POST["brNumber"]);
  }

  if (empty($_POST["gender"])) {
    $countErr++;
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if (empty($_POST["referalIdNumber"])) {
    $countErr++;
  } else {
    $referalIdNumber= test_input($_POST["referalIdNumber"]);
  }


    if ($countErr == 0){
    
	    $sql = "INSERT INTO name_table(first_name, middle_name, last_name) 
	    VALUES ('$firstName','$middleName','$lastName')";

	    $sql1 = "INSERT INTO address_table(present_address, permanent_address, provincial_address) 
	    VALUES ('$presentAddress','$permanentAddress','$provincialAddress')";

	    $sql2 = "INSERT INTO contact_table(mobile_number, email_address, emergency_contact_name, emergency_contact_number) 
	    VALUES ('$mobileNumber','$emailAddress','$emergencyContactName', '$emergencyContactNumber')";

	    $sql3 = "INSERT INTO other_info_table(birth_place, birth_date, tin_number, sss_number, educational_attainment, occupation, br_number, gender, civil_status, referral, member_status) 
	    VALUES ('$birthPlace','$birthDate','$tinNumber','$sssNumber', '$educationalAttainment', '$occupation', '$br_number', '$gender', '$civilStatus', '$referral', '$membershipStatus')";

	    if ($conn->query($sql) === TRUE and $conn->query($sql1) === TRUE and $conn->query($sql2) === TRUE and $conn->query($sql3) === TRUE) {
	        echo "New record created successfully";
	    } else { 
	          echo "Error: " . $sql4 . "<br>" . $conn->error;
	    }

	    $conn->close();
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MWMMPC</title>
    <!-- Bootstrap core CSS -->
    <!--<link href="../library/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    <link href="../library/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../library/bootstrap-3.3.7-dist/css/bootstrap-theme.css" rel="stylesheet">
    <link href="../library/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet">-->
    <link href="../../../public/bootstrap-4.0.0-dist/css/bootstrap.css" rel="stylesheet">
    <!--<link href="../library/css/mdb.min.css" rel="stylesheet">-->
    <link href="../../../public/libraries/fontawesome-free-5.0.9/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

        <!-- Bootstrap core JavaScript
    ================================================== 
    <!-- Placed at the end of the document so the pages load faster-->
</head>


<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div>
		<!-- Top Bar -->
		<div class="row fixed-top"      >
			<!-- Left Top Bar -->
			<div class="col-sm-2">
				<div class="text-center">
					<img src="../../../public/icons/admin_word.png " style="width: 100px; height:70px">
				</div>
			</div>
			<!-- Right Top Bar -->
			<div class="col-sm-10">
	          	<nav class="navbar navbar-dark" style="background-color:#fff">
				  <form class="form-inline" >
				  	<!-- data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation" 
				  	<button class="navbar-toggler" type="button" >
			      		<span class="navbar-toggler-icon"></span>
			    	</button>-->
				    <input class="form-control mr-sm-2" type="search" name="identifier" value="<?php echo $identifier;?>">
				    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				  </form>
				</nav>
        	</div>
		</div>

		<!-- Main Page -->
		<div class="row">
			<div class="col-sm-2 fixed-top" style="margin-top: 70px;">
				<!-- Left Pane (Navigation) -->

					<!-- User Account Info -->
					<div>
						<div class="text-center" >
							<img src="../../../public/icons/user.png " style="width: 60px; height: 60px">
							<h6>User Name</h6>
							<a href=""><i class="fa fa-lock-open"></i></a>
							<a href=""><i class="fa fa-suitcase"></i></a>
							<div>
								<span> &nbsp </span>
								<span> &nbsp </span>
							</div>
						</div>
					</div>
					<!-- Navigation -->
					<div>
						<li class="list-unstyled text-muted menu-title">Navigation</li>

						<li class="active list-unstyled">
							<a href="#dashboard" class="dropdown-toggle card-drop" data-toggle="collapse">
								<i class="fa fa-microchip"></i>
								<span> &nbsp </span>
								<span>Dashboard</span>
							</a>
						</li>

						<div id = "dashboard" class="collapse">
				            <ol class="list-unstyled">
				              <li class="active"><a href=""><span> &nbsp&nbsp </span> Dashboard 1</a></li>
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Dashboard 2</a></li>
				            </ol>
			            </div>

						<li class="active list-unstyled">
							<a href="#registration" class="dropdown-toggle card-drop" data-toggle="collapse">
								<i class="fa fa-id-card"></i>
								<span> &nbsp </span>
								<span>Member Interface</span>
							</a>
						</li>

						<div id = "registration" class="collapse">
				            <ul class="list-unstyled">
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Registration Form</a></li>
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Member Info</a></li>
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Update Info</a></li>
				            </ul>
			            </div>

			            <li class="active list-unstyled">
							<a href="#transaction" class="dropdown-toggle card-drop" data-toggle="collapse">
								<i class="fa fa-keyboard"></i>
								<span> &nbsp </span>
								<span>Transaction</span>
							</a>
						</li>
						<div id = "transaction" class="collapse">
				            <ul class="list-unstyled">
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Payment</a></li>
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Expenses</a></li>
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Loan</a></li>
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Savings</a></li>
				            </ul>
			            </div>
			    
			            <li class="active list-unstyled">
							<a href="#reports" class="dropdown-toggle card-drop" data-toggle="collapse">
								<i class="fa fa-list-ol"></i>
								<span> &nbsp </span>
								<span>Reports</span>
							</a>
						</li>
						<div id = "reports" class="collapse">
				            <ul class="list-unstyled">
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Members</a></li>
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Expenses</a></li>
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Loans</a></li>
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Savings</a></li>
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Transactions</a></li>
				            </ul>
			            </div>

			            <li class="active list-unstyled">
							<a href="#contacts" class="dropdown-toggle card-drop" data-toggle="collapse">
								<i class="fa fa-lightbulb"></i>
								<span> &nbsp </span>
								<span>Contact</span>
							</a>
						</li>
						<div id = "contacts" class="collapse">
				            <ul class="list-unstyled">
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> FAQ</a></li>
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Write Message</a></li>
				              <li class="active"><a href="">  <span> &nbsp&nbsp </span> Contact Info</a></li>
				            </ul>
			            </div>

			            <li class="active list-unstyled">
							<a href="#about" class="dropdown-toggle card-drop" data-toggle="collapse">
								<i class="fa fa-map-pin"></i>
								<span> &nbsp </span>
								<span>About</span>
							</a>
						</li>
					</div>

			</div>

			<div class="col-sm-10" style="margin-top:70px;margin-left: 16.7%;">
				<!-- Right Panel (Working Space) -->

					<div class="container-fluid" style="background-color:#fff">
						
						<div class="row">
						    <!--member account info-->
						    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
						        <h5>Account Information</h5>
						        <form class="form-horizontal" role="form">
						            <div class="form-group">
						                <label class="col-md-6 control-label">ID Number</label>
						                <div class="col-md-10">
						                    <input type="number" class="form-control" value = "<?php echo $idNumber;?>" readonly="">
						                </div>
						            </div>
						            <div class="form-group">
						                <label class="col-md-6 control-label">Account Number</label>
						                <div class="col-md-10">
						                    <input type="text" class="form-control" value = "<?php echo $accountNumber;?>" readonly="">
						                </div>  
						            </div>
						        </form>
						    </div>
						</div>
						<div class="row">
						    <!--member personal info-->
						    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
						        <h5>Personal Information</h5>
						        <form class="form-horizontal" role="form">
						            <div class="form-group">
						                <div class="col-md-10">
						                    <input type="text" class="form-control" placeholder="First Name" value = "<?php echo $firstName;?>">
						                </div>
						            </div>
						            <div class="form-group">
						                <div class="col-md-10">
						                    <input type="text" class="form-control" placeholder="Middle Name" value = "<?php echo $middleName;?>">
						                </div>
						            </div>
						            <div class="form-group">
						                <div class="col-md-10">
						                    <input type="text" class="form-control" placeholder="Last Name" value = "<?php echo $lastName;?>">
						                </div>
						            </div>
						        </form>
						    </div>

												        <!--member address info-->
						    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
						        <h5>Account Information</h5>
						        <form class="form-horizontal" role="form">
						            <div class="form-group">
						                <div class="col-md-10">
						                    <input type="text" class="form-control" value="" placeholder="Present Address" value = "<?php echo $presentAddress;?>">
						                </div>
						            </div>
						            <div class="form-group">
						                <div class="col-md-10">
						                    <input type="text" class="form-control" value="" placeholder="Permanent Address" value = "<?php echo $permanentAddress;?>">
						                </div>
						            </div>
						            <div class="form-group">
						                <div class="col-md-10">
						                    <input type="text" class="form-control" value="" placeholder="Provincial Address" value = "<?php echo $provincialAddress;?>">
						                </div>
						            </div>
						        </form>
						    </div>
						</div>
					</div>
					<div class="row">
				    <!--other info-->
				    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px;">
				        <h5>Other Information</h5>
				        <form class="form-horizontal" role="form">
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="text" class="form-control" placeholder="Birth Place" value = "<?php echo $birthPlace;?>">
				                </div>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="date" class="form-control" placeholder="Birth Date" value = "<?php echo $birthDate;?>">
				                </div>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="number" class="form-control" placeholder="Tin No." value = "<?php echo $tinNumber;?>">
				                </div>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="number" class="form-control" placeholder="SSS No." value = "<?php echo $sssNumber;?>">
				                </div>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="text" class="form-control" placeholder="Religion" value = "<?php echo $religion;?>">
				                </div>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <select class="form-control" value = "<?php echo $educationalAttainment;?>">
				                        <option>Educational attainment</option>
				                        <option>College</option>
				                        <option>Undergraduate</option>
				                        <option>Secondary</option>
				                        <option>Primary</option>
				                    </select>
				                </div>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="text" class="form-control" placeholder="Occupation" value = "<?php echo $occupation;?>">
				                </div>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="number" class="form-control" placeholder="BR Number" value = "<?php echo $brNumber;?>">
				                </div>
				            </div>
				            <p class="text-muted font-13 m-b-15 m-t-20">Gender</p>
				            <div class="radio" style="display: inline-block;">
				                <input type="radio" id="male" value="$gender" name="radioInline" checked="">
				                <label for="inlineRadio1"> Male </label>
				            </div>
				            <div class="radio" style="display: inline-block;">
				                <input type="radio" id="female" value="$gender" name="radioInline" checked="">
				                <label for="inlineRadio2"> Female </label>
				            </div>
				             <p class="text-muted font-13 m-b-15 m-t-20">Civil Status</p>
				            <div class="radio" style="display: inline-block;">
				                <input type="radio" id="male" value="civilStatus" name="radioInline" checked="">
				                <label for="inlineRadio1"> Single </label>
				            </div>
				            <div class="radio" style="display: inline-block;">
				                <input type="radio" id="Married" value="civilStatus" name="radioInline" checked="">
				                <label for="inlineRadio2"> Married </label>
				            </div>
				        </form>
				    </div>
				    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
				        <!--member contact info-->
				        <h5>Contact Information</h5>
				        <form class="form-horizontal" role="form">
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="number" class="form-control" placeholder="Mobile Number" value = "<?php echo $mobileNumber;?>">
				                </div>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="text" class="form-control" placeholder="Email Address" value = "<?php echo $emailAddress;?>">
				                </div>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="text" class="form-control" placeholder="Emergency Contact Name" value = "<?php echo $emergencyContactName;?>">
				                </div>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="number" class="form-control" placeholder="Emergency Contact Number" value = "<?php echo $emergencyContactNumber;?>">
				                </div>
				            </div>
				        </form>
				        <!--member status info-->
				        <h5>Member Status</h5>
				        <form class="form-horizontal" role="form">
				            <div class="form-group">
				                <div class="col-md-10">
				                    <select class="form-control">
				                        <option>Membership Origin</option>
				                        <option>Refferal</option>
				                        <option>Walk-in</option>
				                    </select>
				                </div>
				            </div>
				            <div class="form-group">
				                <form class="form-inline">

				                </form>
				            </div>
				            <div class="col-sm-10">
				                  <form class="form-inline">
				                    <input class="form-control mr-sm-2" type="search" name="identifier" value = "<?php echo $referalIdNumber;?>">
				                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				                  </form>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="text" class="form-control" placeholder="First Name">
				                </div>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="text" class="form-control" placeholder="Middle Name">
				                </div>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <input type="text" class="form-control" placeholder="Last Name">
				                </div>
				            </div>
				            <div class="form-group">
				                <div class="col-md-10">
				                    <select class="form-control" value = "<?php echo $membershipStatus;?>">
				                        <option>Status</option>
				                        <option>Active</option>
				                        <option>Inactive</option>
				                    </select>
				                </div>
				            </div>
				        </form>
				    </div>
				</div>

				<div>
				    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="align-self: center;">Submit</button>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php';?>
</form>

</body>
    <script src="../../../public/library/js/jquery.min.js"></script>
    <!--<script src="../library/bootstrap-3.3.7-dist/js/bootstrap.js"></script>-->
    <script src="../../../public/library/bootstrap-4.0.0-dist/js/bootstrap.js"></script>
</html>