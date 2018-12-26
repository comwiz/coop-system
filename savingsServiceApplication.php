<?php 

$idNumber = "";
$firstName = "";
$middleName = "";
$lastName = "";
$accountNumber = "";

$savingsServiceID = "";
$savingsServiceName = "";
$savingsServiceNameL = "";
$savingsTermCount = "";

$typeTransaction = "";
$referenceNumber = "";
$amount = "";
$dateTransaction = "";

$countErr = "";
$searchMember = "";
$submitApplication = "";

include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["idNumber"])) {
	  	$countErr++;
	}else {
    	$idNumber = test_input($_POST["idNumber"]);
  	}

    if (empty($_POST["searchMember"])) {
        $countErr++;
    }else {
        $searchMember = test_input($_POST["searchMember"]);
    }

    if (empty($_POST["submitApplication"])) {
        $countErr++;
    }else {
        $submitApplication = test_input($_POST["submitApplication"]);
    }

    if (empty($_POST["savingsServiceID"])) {
        $countErr++;
    }else {
        $savingsServiceID = test_input($_POST["savingsServiceID"]);
    }

    if (empty($_POST["savingsServiceName"])) {
        $countErr++;
    }else {
        $savingsServiceName = test_input($_POST["savingsServiceName"]);
    }

    if (empty($_POST["savingsServiceNameL"])) {
        $countErr++;
    }else {
        $savingsServiceNameL = test_input($_POST["savingsServiceNameL"]);
    }

    if (empty($_POST["savingsTermCount"])) {
        $countErr++;
    }else {
        $savingsTermCount = test_input($_POST["savingsTermCount"]);
    }

    if (empty($_POST["referenceNumber"])) {
        $countErr++;
    }else {
        $referenceNumber = test_input($_POST["referenceNumber"]);
    }
    if (empty($_POST["typeTransaction"])) {
        $countErr++;
    }else {
        $typeTransaction = test_input($_POST["typeTransaction"]);
    }
    if (empty($_POST["amount"])) {
        $countErr++;
    }else {
        $amount = test_input($_POST["amount"]);
    }
    if (empty($_POST["dateTransaction"])) {
        $countErr++;
    }else {
        $dateTransaction = test_input($_POST["dateTransaction"]);
    }

    if($searchMember = "searchMember"){
      	$sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber'";
        $resultSearchName = $conn->query($sqlSearchName);

    	if($resultSearchName->num_rows > 0){
    	    while($row = mysqli_fetch_array($resultSearchName)){
    	      $accountNumber = $row['account_number'];
    	      $firstName = $row['first_name'];
    	      $middleName = $row['middle_name'];
    	      $lastName = $row['last_name'];
    	    }
    	}
    }


	$sqlSeaarchSS =  "SELECT * FROM savings_services_table WHERE savings_service_name = '$savingsServiceNameL'";
	$resultSEarchSS = $conn->query($sqlSeaarchSS);

	while($row = mysqli_fetch_array($resultSEarchSS)){
		$savingsServiceID = $row['savings_service_id'];
		$savingsServiceName = $row['savings_service_name'];
		$savingsTermCount = $row['savings_term_count'];
	}

    if($submitApplication = "$submitApplication"){
        $sql = "INSERT INTO savings_table(id_number, type_transaction, type_savings,reference_number, amount, term, date_transaction, encoded_by) 
                VALUES ('$idNumber','$typeTransaction','$savingsServiceID','$referenceNumber','$amount', 'savingsTermCount', '$dateTransaction', '1')";

        if ($conn->query($sql) === TRUE){
            $informessage = "New record created successfully";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Savings Service Application</title>
    <?php include "css.html" ?>
</head>

<body>
<div>
    <?php include 'topbar.php';?>
    <div class="row">
        <?php include 'navigation.php';?>
        <div class="col-sm-10" style="margin-top:70px;margin-left: 16.7%;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="row">
                    <!--member account info-->
                    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                        <h5>Account Information</h5>
                        <div class="form-group">
                            <label class="col-md-6 control-label">ID Number</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $idNumber;?>" name = "idNumber">
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name = "searchMember"  value = "searchMember" style="align-self: center;">Submit</button>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 control-label">Account Number</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $accountNumber;?>" readonly>
                            </div>  
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="First Name" value = "<?php echo $firstName;?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Middle Name" value = "<?php echo $middleName;?>" reaadonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Last Name" value = "<?php echo $lastName;?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                        <h5>Loan Service</h5>
                        <div class="form-group">
                            <div class="col-md-10">
                                <select class="form-control" id="savingsServiceNameL" name= "savingsServiceNameL" onchange="this.form.submit()">
                                    <?php
                                        $sqlsavingsServiceName = "SELECT DISTINCT savings_service_name FROM savings_services_table ORDER BY savings_service_name ASC";
                                        $resultsavingsServiceName = $conn->query($sqlsavingsServiceName);
                                        $countLoanID = 0;
                                        echo '<option value='.''.'>'.'Select Loan Service'.'</option>';
                                        while($savingsServiceNameList = mysqli_fetch_array($resultsavingsServiceName)) {
                                            $countLoanID ++;
                                            echo '<option value="'.$savingsServiceNameList[0].'">'.$savingsServiceNameList[0].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $savingsServiceID;?>" name = "savingsServiceID" placeholder="Savings Service ID" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $savingsServiceName;?>" name = "savingsServiceName" placeholder="Loan Service Name" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $savingsTermCount;?>" name = "savingsTermCount" placeholder="Term Count" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                        <h5>Loan Transaction</h5>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $referenceNumber;?>" name = "referenceNumber" placeholder="Reference Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $typeTransaction;?>" name = "typeTransaction" placeholder="Type of Transaction">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $amount;?>" name = "amount" placeholder="Amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="date" class="form-control" value = "<?php echo $dateTransaction;?>" name = "dateTransaction">
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name = "submitApplication" value = "submitApplication" style="align-self: center;">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    <?php include "css1.html" ?>
</body>