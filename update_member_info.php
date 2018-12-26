<html lang="en">

<?php  

require_once 'session.php';

$idNumber = "";
$accountNumber = "";

$firstName = "";
$middleName = "";
$lastName = "";

$firstNameT = "";
$middleNameT = "";
$lastNameT = "";

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

$memberOrigin = "";
$referalIdNumber = "";
$membershipStatus = "";
$dateMembership = "";

$infomessage = "";

$identifier = "";
$countErr = "";

$idNumberSearch = "";
$searchMember = "";
$exitB = "";
$submitApplication = "";
$searchIDMember = "";

include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(!empty($_POST["idNumber"])){
		$idNumber = test_input($_POST["idNumber"]);
	}

  if(!empty($_POST["idNumberSearch"])){
    $idNumberSearch = test_input($_POST["idNumberSearch"]);
  }


  if(!empty($_POST["identifier"])){
    $identifier = test_input($_POST["identifier"]);
  }


  if(!empty($_POST["submitApplication"])){
    $submitApplication = test_input($_POST["submitApplication"]);
  }

  if(!empty($_POST["searchMember"])){
    $searchMember = test_input($_POST["searchMember"]);
  }

  if(!empty($_POST["searchIDMember"])){
    $searchIDMember = test_input($_POST["searchIDMember"]);
  }

  if(!empty($_POST["exitB"])){
    $exitB = test_input($_POST["exitB"]);
  }

  if($exitB == "exitB" ){
    session_destroy();
    header("Location: http://system.local/home/login.php");
  }

  if (!empty($_POST["referalIdNumber"])) {
    $referalIdNumber= test_input($_POST["referalIdNumber"]);
  }

    if (!empty($_POST["firstNameT"])) {
      $firstNameT = test_input($_POST["firstNameT"]);
      // check if first name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$firstNameT)) {
        $countErr++;
      }
     }


    if(!empty($_POST["middleNameT"])){
        $middleNameT = test_input($_POST["middleNameT"]);
    }
      
   if (!empty($_POST["lastNameT"])) {
      $lastNameT = test_input($_POST["lastNameT"]);
      // check if first name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$lastNameT)) {
        $countErr++;
      }
   }

  if($searchMember == "searchMember"){

    $sqlSearchName = "SELECT * FROM name_table WHERE CONCAT(first_name, ' ', last_name) LIKE '%$identifier%' OR last_name LIKE '%$identifier%' or  id_number = '$identifier' ";
    $resultSearchName = $conn->query($sqlSearchName);

    if($resultSearchName->num_rows > 0){
        while($row = mysqli_fetch_array($resultSearchName)){
          $referalIdNumber = $row['id_number'];
          $firstNameT = $row['first_name'];
          $middleNameT = $row['middle_name'];
          $lastNameT = $row['last_name'];
        }
    }
  }

  if (empty($_POST["accountNumber"])) {
    $countErr++;
  }else {
    $accountNumber = test_input($_POST["accountNumber"]);
  }

	if (empty($_POST["firstName"])) {
	  $countErr++;
	 }else {
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
  if (!empty($_POST["presentAddress"])) {
    $presentAddress = test_input($_POST["presentAddress"]);
  }

  if (!empty($_POST["permanentAddress"])) {
    $permanentAddress = test_input($_POST["permanentAddress"]);
  }

  if (!empty($_POST["provincialAddress"])) {
    $provincialAddress = test_input($_POST["provincialAddress"]);
  }
  

  //Set value of variables of birth information
  if (!empty($_POST["birthPlace"])) {
    $birthPlace = test_input($_POST["birthPlace"]);
  }

  if (!empty($_POST["birthDate"])) {
    $birthDate = test_input($_POST["birthDate"]);
  }


  if (!empty($_POST["tinNumber"])) {
    $tinNumber = test_input($_POST["tinNumber"]);
  }

  if (!empty($_POST["sssNumber"])) {
    $sssNumber = test_input($_POST["sssNumber"]);
  }

  if (!empty($_POST["religion"])) {
    $religion = test_input($_POST["religion"]);
  }

  if (!empty($_POST["educationalAttainment"])) {
    $educationalAttainment = test_input($_POST["educationalAttainment"]);
  }

  if (!empty($_POST["occupation"])) {
    $occupation = test_input($_POST["occupation"]);
  }
  
  if (!empty($_POST["brNumber"])) {
    $brNumber = test_input($_POST["brNumber"]);
  }

  if (empty($_POST["gender"])) {
    $countErr++;
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if (empty($_POST["civilStatus"])) {
    $countErr++;
  } else {
    $civilStatus = test_input($_POST["civilStatus"]);
  }

    //Set value of variables of contact information

  if (!empty($_POST["emailAddress"])) {
    $emailAddress = test_input($_POST["emailAddress"]);
  }
  

  if (empty($_POST["mobileNumber"])) {
    $mobileNumber = test_input($_POST["mobileNumber"]);
  }

  if (empty($_POST["emergencyContactName"])) {
    $emergencyContactName = test_input($_POST["emergencyContactName"]);
  }

  if (empty($_POST["emergencyContactNumber"])) {
    $emergencyContactNumber = test_input($_POST["emergencyContactNumber"]);
  }

  if (empty($_POST["membershipStatus"])) {
    $countErr++;
  } else {
    $membershipStatus= test_input($_POST["membershipStatus"]);
  }

  if (!empty($_POST["memberOrigin"])) {
    $memberOrigin= test_input($_POST["memberOrigin"]);
  }

  if (empty($_POST["typeMembership"])) {
    $countErr++;
  } else {
    $typeMembership= test_input($_POST["typeMembership"]);
  }

  if (empty($_POST["dateMembership"])) {
    $countErr++;
  } else {
    $dateMembership= test_input($_POST["dateMembership"]);
  }

  if($searchIDMember == "searchIDMember"){
    //$sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumberSearch' or last_name= '$idNumberSearch'";
    $sqlSearchName = "SELECT * FROM name_table WHERE CONCAT(first_name, ' ', last_name) LIKE '%$idNumberSearch%' OR last_name LIKE '%$idNumberSearch%' or  id_number = '$idNumberSearch' ";
    $resultSearchName = $conn->query($sqlSearchName);

    if($resultSearchName->num_rows > 0){
        while($row = mysqli_fetch_array($resultSearchName)){
          $idNumber = $row['id_number'];
          $accountNumber = $row['account_number'];
          $firstName = $row['first_name'];
          $middleName = $row['middle_name'];
          $lastName = $row['last_name'];
          $typeMembership = $row['type_membership'];
          $referalIdNumber = $row['referral'];
          $membershipStatus = $row['member_status'];
          $dateMembership = $row['date_membership'];
        }
    }

    $sqlSearchAddress = "SELECT * FROM address_table WHERE id_number = '$idNumber'";
    $resultSearchAddress = $conn->query($sqlSearchAddress);

    if($resultSearchAddress->num_rows > 0){
        while($row = mysqli_fetch_array($resultSearchAddress)){
          $presentAddress = $row['present_address'];
          $permanentAddress = $row['permanent_address'];
          $provincialAddress = $row['provincial_address'];
        }
    }

    $sqlSearchContact = "SELECT * FROM contact_table WHERE id_number = '$idNumber'";
    $resultSearchContact = $conn->query($sqlSearchContact);

    if($resultSearchContact->num_rows > 0){
        while($row = mysqli_fetch_array($resultSearchContact)){
          $mobileNumber = $row['mobile_number'];
          $emailAddress = $row['email_address'];
          $emergencyContactName = $row['emergency_contact_name'];
          $emergencyContactNumber = $row['emergency_contact_number'];
        }
    }

    $sqlSearchOther = "SELECT * FROM other_info_table WHERE id_number = '$idNumber'";
    $resultSearchOther = $conn->query($sqlSearchOther);

    if($resultSearchOther->num_rows > 0){
        while($row = mysqli_fetch_array($resultSearchOther)){
          $birthPlace = $row['birth_place'];
          $birthDate = $row['birth_date'];
          $tinNumber = $row['tin_number'];
          $sssNumber = $row['sss_number'];
          $religion = $row['religion'];
          $educationalAttainment = $row['educational_attainment'];
          $occupation = $row['occupation'];
          $brNumber = $row['br_number'];
          $gender = $row['gender'];
          $civilStatus = $row['civil_status'];
        }

        $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$referalIdNumber'";
        $resultSearchName = $conn->query($sqlSearchName);

        if($resultSearchName->num_rows > 0){
            while($row = mysqli_fetch_array($resultSearchName)){
              $firstNameT = $row['first_name'];
              $middleNameT = $row['middle_name'];
              $lastNameT = $row['last_name'];
            }
        }
    }
  }

  if($submitApplication == "submitApplication"){
    if ($countErr == 0){

        $sql = "UPDATE name_table SET
        first_name = '$firstName',
        middle_name = '$middleName',
        last_name = '$lastName',
        type_membership = '$typeMembership',
        referral = '$referalIdNumber',
        member_status = '$membershipStatus',
        date_membership = '$dateMembership'
        WHERE id_number = '$idNumber'";

        $sql1 = "UPDATE address_table SET
        present_address = '$presentAddress',
        permanent_address = '$permanentAddress',
        provincial_address = '$provincialAddress'
        WHERE id_number = '$idNumber'";

        $sql2 = "UPDATE contact_table SET
        mobile_number = '$mobileNumber',
        email_address = '$emailAddress',
        emergency_contact_name = '$emergencyContactName',
        emergency_contact_number = '$emergencyContactNumber'
        WHERE id_number = '$idNumber'";
  	 
  	    $sql3 = "UPDATE other_info_table SET
        birth_place = '$birthPlace',
        birth_date = '$birthDate',
        tin_number = '$tinNumber',
        sss_number = '$sssNumber',
        educational_attainment = '$educationalAttainment',
        religion = '$religion',
        occupation = '$occupation',
        br_number = '$brNumber',
        gender = '$gender',
        civil_status = '$civilStatus'
        WHERE id_number = '$idNumber'";

  	    if ($conn->query($sql) === TRUE and $conn->query($sql1) === TRUE and $conn->query($sql2) === TRUE and $conn->query($sql3) === TRUE) {
  	       $infomessage = "Record updated successfully";
           //echo "$infomessage";
  	    } 

        else { 
  	          echo "Error: " . $sql . "<br>" . $conn->error;
  	          echo "Error: " . $sql1 . "<br>" . $conn->error;
  	          echo "Error: " . $sql2 . "<br>" . $conn->error;
  	          echo "Error: " . $sql3 . "<br>" . $conn->error;
  	    }

  	    $conn->close();
    }
    else{
      $infomessage = "FILL UP EMPTY FIELDS";
      //echo "$infomessage";
    }
  }

}

function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<head>
    <?php include "css.html" ?>
    <title>Update Member</title>

</head>

<body>
	<div>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <?php //include 'topbar.php';?>
      <div>
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-10" style="margin-top:70px;margin-left: 16.7%;">
                <p align="center"><span><?php echo $infomessage;?></span><br></p>
                <h5 align="margin-left">UPDATE MEMBER INFORMATION</h5>
            		<div class="row">
                  <!--member account info-->
                  <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                      <h5>Account Information</h5>
                          <div class="form-group">
                              <label class="col-md-6 control-label">ID Number</label>
                              <div class="col-md-10">
                                  <input type="text" class="form-control" value = "<?php echo $idNumberSearch;?>" name = "idNumberSearch">
                              </div>
                          </div>

                          <div class="col-sm-10">
                                <button class="btn btn-outline-success my-2 my-sm-0" id = "search" name = "searchIDMember" value = "searchIDMember" type="submit">Search</button>
                          </div>
                  </div>
                </div>
                <div class="row">
                    <!--member personal info-->
                    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                        <h5>Personal Information</h5>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $idNumber;?>" name = "idNumber" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $accountNumber;?>" readonly name = "accountNumber">
                                </div>  
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="First Name" value = "<?php echo $firstName;?>" name = "firstName">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Middle Name" value = "<?php echo $middleName;?>" name = "middleName">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Last Name" value = "<?php echo $lastName;?>" name = "lastName">
                                </div>
                            </div>
                    </div>

                    <!--member address info-->
                    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                        <h5>Account Information</h5>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="presentAddress" placeholder="Present Address" value = "<?php echo $presentAddress;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="permanentAddress" placeholder="Permanent Address" value = "<?php echo $permanentAddress;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name ="provincialAddress" placeholder="Provincial Address" value = "<?php echo $provincialAddress;?>">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row">
                  <!--other info-->
                  <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px;">
                      <h5>Other Information</h5>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Birth Place" value = "<?php echo $birthPlace;?>" name = "birthPlace">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="date" class="form-control" placeholder="Birth Date" value = "<?php echo $birthDate;?>" name = "birthDate">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Tin No." value = "<?php echo $tinNumber;?>" name = "tinNumber">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="SSS No." value = "<?php echo $sssNumber;?>" name = "sssNumber">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Religion" value = "<?php echo $religion;?>" name = "religion">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <select class="form-control" id="tpres" name="educationalAttainment" value="<?php echo $educationalAttainment;?>">
                                  <option value="" <?php if($educationalAttainment == "") echo "selected"; ?>>Select</option>
                                  <option value="College" <?php if($educationalAttainment == "College") echo "selected"; ?>>College</option>
                                  <option value="Undergraduate" <?php if($educationalAttainment == "Undergraduate") echo "selected"; ?>>Undergraduate</option>
                                  <option value="Secondary" <?php if($educationalAttainment == "Secondary") echo "selected"; ?>>Secondary</option>
                                  <option value="Primary" <?php if($educationalAttainment == "Primary") echo "selected"; ?>>Primary</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Occupation" value = "<?php echo $occupation;?>" name = "occupation">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="BR Number" value = "<?php echo $brNumber;?>" name = "brNumber">
                            </div>
                        </div>
                        
                        <div class="radio" style="display: inline-block;">
                            <label class="control-label">Gender</label>
                            <br>
                            <input type="radio" name="gender"
                          <?php if (isset($gender) && $gender=="Male") echo "checked";?>
                          value="Male">Male
                        </div>
                        <div class="radio" style="display: inline-block;">
                            <input type="radio" name="gender"
                          <?php if (isset($gender) && $gender=="Female") echo "checked";?>
                          value="Female">Female 
                        </div>
                        <br><br>

                        <div class="radio" style="display: inline-block;">
                            <label class="control-label">Civil Status</label>
                            <br>
                            <input type="radio" name="civilStatus" 
                          <?php if (isset($civilStatus) && $civilStatus=="Single") echo "checked";?>
                          value="Single">Single
                        </div>
                        <div class="radio" style="display: inline-block;">
                            <input type="radio" name="civilStatus"
                          <?php if (isset($civilStatus) && $civilStatus=="Married") echo "checked";?> 
                          value="Married">Married
                        </div>
                        <br><br>

                        <div class="radio" style="display: inline-block;">
                            <label class="control-label">Type 0f Membership</label>
                            <br>
                            <input type="radio" name="typeMembership" 
                          <?php if (isset($typeMembership) && $typeMembership=="Regular") echo "checked";?>
                          value="Regular">Regular
                        </div>
                        <div class="radio" style="display: inline-block;">
                            <input type="radio" name="typeMembership"
                          <?php if (isset($typeMembership) && $typeMembership=="Associate") echo "checked";?> 
                          value="Associate">Associate
                        </div>

                  </div>
                  <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                      <!--member contact info-->
                      <h5>Contact Information</h5>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Mobile Number" value = "<?php echo $mobileNumber;?>" name = "mobileNumber">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Email Address" value = "<?php echo $emailAddress;?>" name = "emailAddress">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Emergency Contact Name" value = "<?php echo $emergencyContactName;?>" name = "emergencyContactName">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Emergency Contact Number" value = "<?php echo $emergencyContactNumber;?>" name = "emergencyContactNumber">
                            </div>
                        </div>
                    <!--member status info-->
                    <h5>Member Status</h5>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="date" class="form-control" value = "<?php echo $dateMembership;?>" name = "dateMembership">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <select class="form-control" id="membershipStatus" name="membershipStatus" value="<?php echo $membershipStatus;?>">
                                  <option value="" <?php if($membershipStatus == "") echo "selected"; ?>>Select</option>
                                  <option value="Active" <?php if($membershipStatus == "Active") echo "selected"; ?>>Active</option>
                                  <option value="Inactive" <?php if($membershipStatus == "Inactive") echo "selected"; ?>>Inactive</option>
                                  <option value="Diseased" <?php if($membershipStatus == "Diseased") echo "selected"; ?>>Diseased</option>
                                  <option value="Resigned" <?php if($membershipStatus == "Resigned") echo "selected"; ?>>Resigned</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <select class="form-control" id="memberOrigin" name="memberOrigin" value="<?php echo $memberOrigin;?>">
                                  <option value="" <?php if($memberOrigin == "") echo "selected"; ?>>Select</option>
                                  <option value="Refferal" <?php if($memberOrigin == "Refferal") echo "selected"; ?>>Refferal</option>
                                  <option value="Walk-in" <?php if($memberOrigin == "Walk-in") echo "selected"; ?>>Walk-in
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                              <input class="form-control mr-sm-2" type="search" id = "" name="identifier" value = "<?php echo $identifier;?>">
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <button class="btn btn-outline-success my-2 my-sm-0" id = "search" name = "searchMember" value = "searchMember" type="submit">Search</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text"  class="form-control" placeholder="ID NUMBER" readonly="" value = "<?php echo $referalIdNumber;?>" name = "referalIdNumber">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="First Name" readonly="" value = "<?php echo $firstNameT;?>" name = "firstNameT">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Middle Name" readonly="" value = "<?php echo $middleNameT;?>" name = "middleNameT">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Last Name" readonly="" value = "<?php echo $lastNameT;?>" name = "lastNameT">
                            </div>
                        </div>
                  </div>
                </div>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name = "submitApplication" value = "submitApplication" style="align-self: center;">UPDATE</button>
            </div>
        </div>
      </div>
    </form>
  </div>

	<?php include 'footer.php';?>

</body>
    <?php include "css1.html" ?>
</html>