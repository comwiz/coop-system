<!DOCTYPE html>
<html>

<?php  

$idNumber = "";
$firstName = "";
$middleName = "";
$lastName = "";
$accountNumber = "";

$loanApplicationNumber = "";

$loanServiceId = "";
$loanServiceType = "";
$loanServiceNameL = "";
$loanServiceName = "";
$loanServiceEntitlement = "";
$loanableAmountMin = "";
$loanableAmountMax = "";

$riceQuantity = 0;
$loanAmount = "";
$loanInterest = "";
$loanTerm = "";
$paymentTerm = "";
$loanStatus = "";

$dateApplication = "";
$dateApprovedDenied = "";
$dateReleased = "";
$datePaid = "";

$reviewedBy = "";
$approveddeniedBy = "";
$releasedBy = "";

$countErr = "";
$submitApplication = "";
$searchMember = "";
$identifier = "";
$infomessage = "";
$idNumberSearch = "";

include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["submitApplication"])) {
        $submitApplication = test_input($_POST["submitApplication"]);
    }

    if (!empty($_POST["searchMember"])) {
        $searchMember = test_input($_POST["searchMember"]);
    }

    if (!empty($_POST["loanServiceType"])){
        $loanServiceType = test_input($_POST["loanServiceType"]);
    }

    if (!empty($_POST["loanServiceEntitlement"])){
        $loanServiceEntitlement = test_input($_POST["loanServiceEntitlement"]);
    }

    if (!empty($_POST["loanableAmountMin"])){
        $loanableAmountMin = test_input($_POST["loanableAmountMin"]);
    }

    if (!empty($_POST["loanableAmountMax"])){
        $loanableAmountMax = test_input($_POST["loanableAmountMax"]);
    }

    if (!empty($_POST["loanServiceName"])){
        $loanServiceName = test_input($_POST["loanServiceName"]);
    }

    if (!empty($_POST["loanServiceNameL"])){
        $loanServiceNameL = test_input($_POST["loanServiceNameL"]);
    }

	if (empty($_POST["idNumber"])) {
	  	$countErr++;
	}else {
    	$idNumber = test_input($_POST["idNumber"]);
  	}

    if (empty($_POST["loanApplicationNumber"])) {
        $countErr++;
    }else {
        $loanApplicationNumber = test_input($_POST["loanApplicationNumber"]);
    }

    if (empty($_POST["loanServiceId"])) {
        $countErr++;
    }else {
        $loanServiceId = test_input($_POST["loanServiceId"]);
    }

    if (empty($_POST["riceQuantity"]) && !is_numeric($_POST["riceQuantity"])) {
        $countErr++;
    }else {
        $riceQuantity = test_input($_POST["riceQuantity"]);
    }

    if (empty($_POST["loanAmount"]) && !is_numeric($_POST["loanAmount"]) ) {
        $countErr++;
    }else {
        $loanAmount = test_input($_POST["loanAmount"]);
    }

    if (empty($_POST["loanInterest"]) && !is_numeric($_POST["loanInterest"]) ) {
        $countErr++;
    }else {
        $loanInterest = test_input($_POST["loanInterest"]);
    }

    if (empty($_POST["loanTerm"])) {
        $countErr++;
    }else {
        $loanTerm = test_input($_POST["loanTerm"]);
    }

    if (empty($_POST["paymentTerm"])) {
        $countErr++;
    }else {
        $paymentTerm = test_input($_POST["paymentTerm"]);
    }

    if (empty($_POST["dateApplication"])) {
        $countErr++;
    }else {
        $dateApplication = test_input($_POST["dateApplication"]);
    }

    if (!empty($_POST["firstName"])) {
        $firstName = test_input($_POST["firstName"]);
    }
    if (!empty($_POST["middleName"])) {
        $middleName = test_input($_POST["middleName"]);
    }

    if (!empty($_POST["lastName"])) {
        $lastName = test_input($_POST["lastName"]);
    }

    if (!empty($_POST["accountNumber"])) {
       $accountNumber = test_input($_POST["accountNumber"]);
    }

    if (!empty($_POST["idNumberSearch"])) {
       $idNumberSearch = test_input($_POST["idNumberSearch"]);
    }

    if ($searchMember == "searchMember") {
        $sqlSearchName = "SELECT * FROM name_table WHERE CONCAT(first_name, ' ', last_name) LIKE '%$idNumberSearch%' OR last_name LIKE '%$idNumberSearch%' or  id_number = '$idNumberSearch' ";
        $resultSearchName = $conn->query($sqlSearchName);

        if($resultSearchName->num_rows > 0){
            while($row = mysqli_fetch_array($resultSearchName)){
              $idNumber = $row['id_number'];
              $accountNumber = $row['account_number'];
              $firstName = $row['first_name'];
              $middleName = $row['middle_name'];
              $lastName = $row['last_name'];
            }
        }

        $loanApplicationNumber = "";
        $loanAmount = "";
        $loanInterest = "";
        $loanTerm = "";
        $paymentTerm = "";
        $dateApplication = "";
    }

    if($loanServiceNameL != ""){
        $sqlSeaarchLS =  "SELECT * FROM loan_services_table WHERE loan_service_name = '$loanServiceNameL'";
        $resultSEarchLS = $conn->query($sqlSeaarchLS);

    	while($row = mysqli_fetch_array($resultSEarchLS)){
    		$loanServiceId = $row['loan_service_id'];
    		$loanServiceName = $row['loan_service_name'];
    		$loanServiceType = $row['loan_service_type'];
            $loanServiceEntitlement = $row['loan_service_entitlement'];
    		$loanableAmountMin = $row['loanable_amount_min'];
    		$loanableAmountMax = $row['loanable_amount_max'];
            $loanInterest = $row['loan_interest'];
    	}

        if($loanServiceName == "Emergency Loan"){
            $sql = "SELECT * FROM eml_loan_table";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            $loanApplicationNumber = $count + 1;
            $loanApplicationNumber = 'EML' . $loanApplicationNumber;

        }elseif ($loanServiceName == "Educational Loan") {
            $sql = "SELECT * FROM edl_loan_table";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            $loanApplicationNumber = $count + 1;
            $loanApplicationNumber = 'EDL' . $loanApplicationNumber;

        }elseif ($loanServiceName == "Calamity Loan") {
            $sql = "SELECT * FROM cll_loan_table";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            $loanApplicationNumber = $count + 1;
            $loanApplicationNumber = 'CLL' . $loanApplicationNumber;

        }elseif ($loanServiceName == "Check Loan") {
            $sql = "SELECT * FROM ckl_loan_table";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            $loanApplicationNumber = $count + 1;
            $loanApplicationNumber = 'CKL' . $loanApplicationNumber;

        }elseif($loanServiceName == "Cash Loan"){
            $sql = "SELECT * FROM cl_loan_table";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            $loanApplicationNumber = $count + 1;
            $loanApplicationNumber = 'CL' . $loanApplicationNumber;

        }elseif ($loanServiceName == "Business Loan") {
            $sql = "SELECT * FROM bl_loan_table";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            $loanApplicationNumber = $count + 1;
            $loanApplicationNumber = 'BL' . $loanApplicationNumber;

        }elseif ($loanServiceName == "Chattel Mortgage Loan 1" or $loanServiceName == "Chattel Mortgage Loan 2") {
            $sql = "SELECT * FROM cml_loan_table";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            $loanApplicationNumber = $count + 1;
            $loanApplicationNumber = 'CML' . $loanApplicationNumber;

        }elseif ($loanServiceName == "Special Loan") {
            $sql = "SELECT * FROM sl_loan_table";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            $loanApplicationNumber = $count + 1;
            $loanApplicationNumber = 'SL' . $loanApplicationNumber;

        }elseif ($loanServiceName == "Rice Loan") {
            $sql = "SELECT * FROM rice_loan_table";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            $loanApplicationNumber = $count + 1;
            $loanApplicationNumber = 'RCL' . $loanApplicationNumber;
        }else{
            $sql = "SELECT * FROM rl_loan_table";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            $loanApplicationNumber = $count + 1;
            $loanApplicationNumber = 'RL' . $loanApplicationNumber;
        }
    }

    
    if($submitApplication == "submitApplication"){
        echo "$countErr";
        if ($countErr <= 0) {
            if($loanServiceName == "Emergency Loan"){
                $sql = "INSERT INTO eml_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Released')";
            }elseif($loanServiceName == "Educational Loan"){
                $sql = "INSERT INTO edl_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }elseif($loanServiceName == "Calamity Loan"){
                $sql = "INSERT INTO cll_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }elseif($loanServiceName == "Check Loan"){
                $sql = "INSERT INTO ckl_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Released')";
            }elseif($loanServiceName == "Cash Loan"){
                $sql = "INSERT INTO cl_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Released')";
            }elseif($loanServiceName == "Business Loan"){
                $sql = "INSERT INTO bl_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }elseif($loanServiceName == "Chattel Mortgage Loan 1" or $loanServiceName == "Chattel Mortgage Loan 2"){
                $sql = "INSERT INTO cml_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }elseif($loanServiceName == "Special Loan"){
                $sql = "INSERT INTO sl_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Released')";
            }elseif($loanServiceName == "Rice Loan"){
                $sql = "INSERT INTO rice_loan_table(id_number, loan_application_number, loan_service_id, quantity,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId', '$riceQuantity','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Released')";
            }else{
                $sql = "INSERT INTO rl_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }

            if ($conn->query($sql) === TRUE){
                $infomessage = "New record created successfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $sql1 = "INSERT INTO loan_date_table(loan_application_number, date_application, date_approved_denied, date_released) 
                    VALUES ('$loanApplicationNumber','$dateApplication', '$dateApplication', '$dateApplication')";

            if ($conn->query($sql1) === TRUE){
                $infomessage = "New record created successfully";
            }else{
                echo "Error: " . $sql1 . "<br>" . $conn->error;
            }

            $sql2 = "INSERT INTO loan_encoder_table(loan_application_number, encoded_by, reviewed_by, approved_denied_by,released_by) 
                    VALUES ('$loanApplicationNumber','1','1','1','1')";

            if ($conn->query($sql2) === TRUE){
                $infomessage = "New record created successfully";
                $loanApplicationNumber = "";
                $loanServiceId = "";
                $loanAmount = "";
                $loanTerm = "";
                $loanInterest = "";
                $paymentTerm = "";
                $dateApplication = "";

                $idNumber = "";
                $firstName = "";
                $middleName = "";
                $lastName = "";
                $accountNumber = "";

            }else{
                echo "Error: " . $sql1 . "<br>" . $conn->error;
            }
        }else{
            $infomessage = "FILL UP EMPTY FIELD";
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
    <title>Loan Application</title>
</head>
<style type="text/css">
.none{
    display: none;
}
.inline{
    display: inline;
}
</style>
<body>
<div>
    <?php include 'topbar.php';?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    	<div>
            <div class="row" >
                <?php include 'navigation.php';?>
                <div class="col-sm-10" style="margin-top:70px;margin-left: 16.7%; margin-bottom: 200px">  
                    <p align="center"><span><?php echo $infomessage;?></span><br></p>
                    <div class="row">
                        <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                            <h5>Account Information</h5>
                            <div class="form-group">
                                <label class="col-md-6 control-label">ID Number</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $idNumberSearch;?>" name = "idNumberSearch">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <button class="btn btn-outline-success my-2 my-sm-0" name = "searchMember" value = "searchMember" type="submit" style="align-self: center;">Submit</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $idNumber;?>" name = "idNumber">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $accountNumber;?>" name = "accountNumber" readonly>
                                </div>  
                            </div>
                            

                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="First Name" value = "<?php echo $firstName;?>" name = "firstName" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Middle Name" value = "<?php echo $middleName;?>" name = "middleName" reaadonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Last Name" value = "<?php echo $lastName;?>" name = "lastName" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                            <h5>Loan Service</h5>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <select class="form-control" id="loanServiceNameL" name= "loanServiceNameL" onchange="this.form.submit()">-->
                                        <?php
                                            $sqlloanServiceName = "SELECT DISTINCT loan_service_name FROM loan_services_table ORDER BY loan_service_name ASC";
                                            $resultloanServiceName = $conn->query($sqlloanServiceName);
                                            $countLoanID = 0;
                                            echo '<option value='.''.'>'.'Select Loan Service'.'</option>';
                                            while($loanServiceNameList = mysqli_fetch_array($resultloanServiceName)) {
                                                $countLoanID ++;
                                                echo '<option value="'.$loanServiceNameList[0].'">'.$loanServiceNameList[0].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanServiceId;?>" name = "loanServiceId" placeholder="Loan Service ID" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanServiceType;?>" name = "loanServiceType" placeholder="Loan Type" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanServiceName;?>" name = "loanServiceName" placeholder="Loan Service Name" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanServiceEntitlement;?>" name = "loanServiceEntitlement" placeholder="Loan Service Entitlement" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanableAmountMin;?>" name = "loanableAmountMin" placeholder="Loanable Minimum Amount" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanableAmountMax;?>" name = "loanableAmountMax" placeholder="Loanable Maximum Amount" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                            <h5>Loan Application</h5>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanApplicationNumber;?>" name = "loanApplicationNumber" placeholder="Loan Application Number" readonly>
                                </div>
                            </div>
                            <div class= "<?php if(substr($loanApplicationNumber, 0 ,3) == "RCL"){echo "inline";}else{echo "none";}?>">
                                <div class="col-md-10 form-group">
                                    <input type="text" class="form-control" value = "<?php echo $riceQuantity;?>" name = "riceQuantity" placeholder="Rice Quantity">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanAmount;?>" name = "loanAmount" placeholder="Loan Amount">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanInterest;?>" name = "loanInterest" placeholder="Loan Interest">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanTerm;?>" name = "loanTerm" placeholder="Loan Term">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <select class="form-control" id="paymentTerm" name="paymentTerm" value="<?php echo $paymentTerm;?>">
                                      <option value="" <?php if($paymentTerm == "") echo "selected"; ?>>Select</option>
                                      <option value="Daily" <?php if($paymentTerm == "Daily") echo "selected"; ?>>Daily</option>
                                      <option value="Semi Monthly" <?php if($paymentTerm == "Semi Monthly") echo "selected"; ?>>Semi Monthly</option>
                                      <option value="Monthly" <?php if($paymentTerm == "Monthly") echo "selected"; ?>>Monthly</option>
                                      <option value="One Time Payment" <?php if($paymentTerm == "One Time Payment") echo "selected"; ?>>One Time Payment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="date" class="form-control" value = "<?php echo $dateApplication;?>" name = "dateApplication">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <button class="btn btn-outline-success my-2 my-sm-0" name = "submitApplication" value = "submitApplication" type="submit" style="align-self: center;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
	</form>
</div>

</body>
    <?php include "css1.html" ?>
</html>