<!DOCTYPE html>
<html>

<?php 

$savingsServiceID = "";
$savingsReferenceNumber = "";
$savingsServiceName = "";
$savingsTermCount = "";
$savingsTermSuffix = "";
$savingsInterest = "";
$encodedBy = "";

$countErr = "";
$identifier = "";

include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 if (empty($_POST["savingsReferenceNumber"])) {
	$countErr++;
  }else {
    $savingsReferenceNumber = test_input($_POST["savingsReferenceNumber"]);
  }

  if (empty($_POST["savingsServiceName"])) {
	$countErr++;
  }else {
    $savingsServiceName = test_input($_POST["savingsServiceName"]);
  }

  if (empty($_POST["savingsTermCount"])) {
      $countErr++;
  }else {
      $savingsTermCount = test_input($_POST["savingsTermCount"]);
  }

  if (empty($_POST["savingsTermSuffix"])) {
	  	$countErr++;
	}else {
    	$savingsTermSuffix = test_input($_POST["savingsTermSuffix"]);
  	}

  	if (empty($_POST["savingsInterest"])) {
	  	$countErr++;
	}else {
    	$savingsInterest = test_input($_POST["savingsInterest"]);
  	}

	$sql = "INSERT INTO savings_services_table(savings_service_name, reference_number, savings_term_count, savings_term_suffix, savings_interest_rate, encoded_by) 
		    VALUES ('$savingsServiceName','$savingsReferenceNumber','$savingsTermCount','$savingsTermSuffix','$savingsInterest', '1')";

	if ($conn->query($sql) === TRUE){
		$informessage = "New record created successfully";
	}else{
		echo "Error: " . $sql . "<br>" . $conn->error;
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
  <title></title>
  <?php include "css.html" ?>
</head>

<body>
  <div>
    <?php include 'topbar.php';?>
    <div class="row">
        <?php include 'navigation.php';?>
        <div class="col-sm-10" style="margin-top:70px;margin-left: 16.7%;">
            <div>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="row">
                    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                        <h5>Savings Service Entry</h5>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $savingsServiceID;?>" name = "savingsServiceID" placeholder="Savings Service ID">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="<?php echo $savingsReferenceNumber;?>" name = "savingsReferenceNumber" placeholder="Reference">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $savingsServiceName;?>" name = "savingsServiceName" placeholder="Savings Service Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $savingsTermCount;?>" name = "savingsTermCount" placeholder="Term">
                                </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <select class="form-control" id="ea" name="savingsTermSuffix">
                                  <option value="" <?php if($savingsTermSuffix == "") echo "selected"; ?>>Select</option>
                                  <option value="Monthly" <?php if($savingsTermSuffix == "Monthly") echo "selected"; ?>>Monthly</option>
                                  <option value="Yearly" <?php if($savingsTermSuffix == "Yearly") echo "selected"; ?>>Yearly</option>
                               </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $savingsInterest;?>" name = "savingsInterest" placeholder="Savings Interest Rate">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="align-self: center;">Submit</button>
                </div>
              </form>
            </div>
        </div>
    </div>
  </div>
	
</body>
  <?php include "css1.html" ?>
</html>