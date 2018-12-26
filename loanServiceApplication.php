<!DOCTYPE html>
<html>

<?php  

require_once 'session.php';

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
$typeInterest = "";

$riceQuantity = 0;
$invoiceNumber = 0;

$loanAmount = "";
$loanInterest = "";
$loanTerm = "";
$paymentTerm = "";
$loanStatus = "";

$dateApplication = date("Y/m/d");
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

$exitB = "";
$generateProposal = "";
$displayPropertyLoan = "none";

$sqlOR = "SELECT * FROM `rice_loan_table` WHERE invoice_number=(SELECT MAX(invoice_number) FROM `rice_loan_table`)";
$resultOR = $conn->query($sqlOR);

if($resultOR->num_rows > 0){
    while ($row = mysqli_fetch_array($resultOR)) {
        $invoiceNumber = $row['invoice_number'] + 1;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["submitApplication"])) {
        $submitApplication = test_input($_POST["submitApplication"]);
    }

    if (!empty($_POST["generateProposal"])) {
        $generateProposal = test_input($_POST["generateProposal"]);
    }

    if (!empty($_POST["exitB"])) {
        $exitB = test_input($_POST["exitB"]);
    }

    if (!empty($_POST["searchMember"])) {
        $searchMember = test_input($_POST["searchMember"]);
    }

    if (!empty($_POST["loanServiceType"])){
        $loanServiceType = test_input($_POST["loanServiceType"]);
    }

    if (!empty($_POST["typeInterest"])){
        $typeInterest = test_input($_POST["typeInterest"]);
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

    if (empty($_POST["invoiceNumber"]) && !is_numeric($_POST["invoiceNumber"])) {
        $countErr++;
    }else {
        $invoiceNumber = test_input($_POST["invoiceNumber"]);
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

    if($exitB == "exitB"){
        session_destroy();
        header("Location: http://localhost/projectkikz/samplemwmmpc/application/views/home/login.php");
    }

    if($generateProposal == "generateProposal"){
        //loanAmount/loanInterest/loanTerm/paymentTerm/
        if($typeInterest == "Diminishing"){
            $displayPropertyLoan = "inline";
            $loanInterestP = $loanInterest;
            $loanInterestP = $loanInterestP/100;

            $numberator = $loanAmount*$loanInterestP;
            $denominator = 1-pow((1+$loanInterestP),-$loanTerm);
              $monthlyAmortization = $numberator / $denominator;

              $OSBalance = $loanAmount;
              $totalPrincipal = 0;
              $totalInterest = 0;
              $actualInterest = 0;

              $actualPrincipal = 0;
              $actualInterest = 0;
              $actualBalanceTemp = 0;
              $actualBalance = $loanAmount;

              $monthlyAmortization = round($monthlyAmortization,2,PHP_ROUND_HALF_DOWN);
              $interestPayment = $loanAmount * $loanInterestP;

              //actual
              $actualInterest = $loanAmount * $loanInterestP;
              $loanTermA = $loanTerm;

              if ($paymentTerm == "Daily") {
                  $loanTermA = $loanTermA * 30;
                  $paymentTermP = 30;
              }elseif ($paymentTerm == "Semi Monthly") {
                  $loanTermA = $loanTermA * 2;
                  $paymentTermP = 2;
              }
              elseif ($paymentTerm == "Monthly") {
                  $loanTermA = $loanTermA * 1;  
                  $paymentTermP = 1;
              }

              $monthlyAmortization = $monthlyAmortization / $paymentTermP;
              $monthlyAmortization = round($monthlyAmortization,2,PHP_ROUND_HALF_ODD);

              $interestPayment = $interestPayment / $paymentTermP;
              $interestPayment =  round($interestPayment,2,PHP_ROUND_HALF_ODD);

              //actual
              $actualInterest = $interestPayment / $paymentTermP;
              $actualInterest =  round($actualInterest,2,PHP_ROUND_HALF_ODD);
        }  
    }

    if ($searchMember == "searchMember") {
        $sqlSearchName = "SELECT * FROM name_table WHERE (CONCAT(first_name, ' ', last_name) LIKE '%$idNumberSearch%' OR last_name LIKE '%$idNumberSearch%' or  id_number = '$idNumberSearch') and  (member_status != 'Resigned' and member_status != 'Diseased' ) ";
        $resultSearchName = $conn->query($sqlSearchName);
        //$sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber' or last_name= '$idNumber' ";
        //$resultSearchName = $conn->query($sqlSearchName);

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
            $loanTerm = $row['loan_terms_count'];
            $typeInterest = $row['type_interest'];

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

        }elseif ($loanServiceName == "Privilege Loan") {
            $sql = "SELECT * FROM ckl_loan_table";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            $loanApplicationNumber = $count + 10;
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
            $loanApplicationNumber = $count + 5000;
            $loanApplicationNumber = 'RCL' . $loanApplicationNumber;
        }else{
            $sql = "SELECT * FROM rl_loan_table";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            $loanApplicationNumber = $count + 100;
            $loanApplicationNumber = 'RL' . $loanApplicationNumber;
        }
    }

    if($submitApplication == "submitApplication"){
        if ($countErr <= 0) {
            if($loanServiceName == "Emergency Loan"){
                $sql = "INSERT INTO eml_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }elseif($loanServiceName == "Educational Loan"){
                $sql = "INSERT INTO edl_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }elseif($loanServiceName == "Calamity Loan"){
                $sql = "INSERT INTO cll_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }elseif($loanServiceName == "Privilege Loan"){
                $sql = "INSERT INTO ckl_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }elseif($loanServiceName == "Cash Loan"){
                $sql = "INSERT INTO cl_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }elseif($loanServiceName == "Business Loan"){
                $sql = "INSERT INTO bl_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }elseif($loanServiceName == "Chattel Mortgage Loan 1" or $loanServiceName == "Chattel Mortgage Loan 2"){
                $sql = "INSERT INTO cml_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }elseif($loanServiceName == "Special Loan"){
                $sql = "INSERT INTO sl_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }elseif($loanServiceName == "Rice Loan"){
                $sql = "INSERT INTO rice_loan_table(id_number, loan_application_number, loan_service_id, invoice_number ,quantity, loan_amount, loan_term, loan_interest, payment_term,loan_status, date_released) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId', '$invoiceNumber' ,'$riceQuantity','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Released', '$dateApplication')";
            }else{
                $sql = "INSERT INTO rl_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                        VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Approved')";
            }

            if ($conn->query($sql) === TRUE){
                $infomessage = "New record created successfully";

                $sqlOR = "SELECT * FROM `rice_loan_table` WHERE invoice_number=(SELECT MAX(invoice_number) FROM `rice_loan_table`)";
                $resultOR = $conn->query($sqlOR);

                if($resultOR->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultOR)) {
                        $invoiceNumber = $row['invoice_number'] + 1;
                    }
                }
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
                    VALUES ('$loanApplicationNumber','encodedBy','0','0','0')";

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

    <script>
    //i = 0;
    $(document).ready(function(){
        $("#rcqv").keyup(function(){

            var riceIA = 0;
            riceIA = Number($("#rcqv").val()) * Number(70);

            $("#rcia").val(riceIA);
        });

    });
    </script>
</head>

<body>
<div>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php //include 'topbar.php';?>
    	<div>
            <div class="row" >
                <?php include 'navigation.php';?>
                <div class="col-sm-10" style="margin-top:70px;margin-left: 16.7%; margin-bottom: 20px">  
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
                                    <input type="text" class="form-control" value = "<?php echo $idNumber;?>" name = "idNumber" readonly>
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
                                    <input type="text" class="form-control" value = "<?php echo $typeInterest;?>" name = "typeInterest" placeholder="Loan Type" readonly>
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
                                    <label>Loan Service ID</label>
                                    <input type="text" class="form-control" value = "<?php echo $loanApplicationNumber;?>" name = "loanApplicationNumber" placeholder="Loan Application Number" readonly>
                                </div>
                            </div>
                            <div class= "<?php if(substr($loanApplicationNumber, 0 ,3) == "RCL"){echo "inline";}else{echo "none";}?>">
                                <div class="col-md-10 form-group">
                                    <input id ="rcqv" type="text" class="form-control" value = "<?php echo $riceQuantity;?>" name = "riceQuantity" placeholder="Rice Quantity" autocomplete="off" >
                                </div>
                            </div>
                            <div class= "<?php if(substr($loanApplicationNumber, 0 ,3) == "RCL"){echo "inline";}else{echo "none";}?>">
                                <div class="col-md-10 form-group">
                                    <input type="text" class="form-control" value = "<?php echo $invoiceNumber;?>" name = "invoiceNumber" placeholder="Invoice Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Loan Interest</label>
                                <div class="col-md-10">
                                    <input id = "rcia" type="text" class="form-control" value = "<?php echo $loanInterest;?>" name = "loanInterest" placeholder="Loan Interest">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Loan Term</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanTerm;?>" name = "loanTerm" placeholder="Loan Term">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanAmount;?>" name = "loanAmount" placeholder="Loan Amount">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Type of Payment</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="paymentTerm" name="paymentTerm" value="<?php echo $paymentTerm;?>">
                                      <option value="" <?php if(substr($loanApplicationNumber,0,3) != "RCL" and $paymentTerm == "") echo "selected"; ?>>Select</option>
                                      <option value="Daily" <?php if($paymentTerm == "Daily") echo "selected"; ?>>Daily</option>
                                      <option value="Semi Monthly" <?php if($paymentTerm == "Semi Monthly") echo "selected"; ?>>Semi Monthly</option>
                                      <option value="Monthly" <?php if(substr($loanApplicationNumber,0,3) == "RCL" or $paymentTerm == "Monthly") echo "selected"; ?>>Monthly</option>
                                      <option value="One Time Payment" <?php if($paymentTerm == "One Time Payment") echo "selected"; ?>>One Time Payment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <?php //$dateApplication = date("Y/m/d") ?>
                                    <input type="date" class="form-control" value = "<?php echo $dateApplication; ?>" name = "dateApplication">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <button class="btn btn-outline-success my-2 my-sm-0" name = "generateProposal" value = "generateProposal" type="submit" style="align-self: center;">Generate Proposal</button>

                                    <button class="btn btn-outline-success my-2 my-sm-0" name = "submitApplication" value = "submitApplication" type="submit" style="align-self: center;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6" style="margin-top:70px;margin-left: 16.7%;">
                    <div class="table table-striped table-hover table-dark">
                        <?php

                          if($displayPropertyLoan != "none"){

                              echo "<br>";

                              echo "<table>
                              <tr>";
                              echo "<th>" . "SCHEDULE OF LOAN PAYMENTS" .  "</th>";
                                echo "<th>" . "Loan Ledger:" ."</th>";
                                echo "<th>" . $loanServiceId ."</th>";
                                echo "<th>" . "Loan Amount:" ."</th>";
                                echo "<th>" . "&#8369;" .number_format($loanAmount,'2',',','.') ."</th>";
                              echo"

                              </tr>";

                              echo
                              "<tr>";
                                echo "<th>" . "" .  "</th>";
                                echo "<th>" . "Loan Term:" ."</th>";
                                echo "<th>" . $loanTerm . " " . "Months" ."</th>";
                                echo "<th>" . "Mode of Payment:" ."</th>";
                                echo "<th>" . $paymentTerm ."</th>";

                              echo "
                              <tr>  
                                  <th>Due Date</th>
                                  <th>Monthly Amortization</th>
                                  <th>Principal Payment</th>
                                  <th>Interest Payment</th>
                                  <th>O/S Balance</th>
                              </tr>";
                              
                              $counterh = 0;
                              //if(substr($loanApplicationNumberId, 0,2) == "PL"){
                                //$counterPayment = $counterPayment + $counterPaymentPL;
                                //$counterComparison = $counterPaymentPL;
                              //}else{
                                //$counterComparison = $counterPayment;
                              //}
                              
                              $sumPrincipal = 0;
                              $monthDate = new DateTime($dateApplication);

                              while($counterh < $loanTermA) {
                                  $check = $counterh + 1;

                                  $totalInterest = $totalInterest + $interestPayment;
                                  $principalPayment = round(($monthlyAmortization - $interestPayment),2,PHP_ROUND_HALF_ODD);

                                  $OSBalance = $OSBalance - $principalPayment;
                                  $OSBalanceTemp = round($OSBalance,2,PHP_ROUND_HALF_ODD);

                                  if($loanTermA == $check){
                                      if($OSBalanceTemp > 0){
                                          $OSBalanceTemp = 0;
                                      }elseif($OSBalanceTemp < 0){
                                          $OSBalanceTemp = 0;
                                      }
                                  }
                                  
                                  //new DateTime($monthDateA);
                                  if($paymentTerm == "Monthly"){
                                      $monthDate->add(new DateInterval('P'.(30).'D'));
                                  }elseif($paymentTerm == "Semi Monthly"){
                                      $monthDate->add(new DateInterval('P'.(15).'D'));
                                  }else{
                                      $monthDate->add(new DateInterval('P'.(1).'D'));
                                  }


                                  echo "<tr>"; 
                                      echo "<td>"; echo $monthDate->format('Y-m-d');  echo "</td>";
                                      echo "<td>" . number_format($monthlyAmortization,'2','.',',') . "</td>";
                                      echo "<td>" . number_format($principalPayment,'2','.',',') . "</td>";
                                      echo "<td>" . number_format($interestPayment,'2','.',',') . "</td>";
                                      echo "<td>" . number_format($OSBalanceTemp,'2','.',',') . "</td>";
                                  echo "</tr>";

                                  $counterh ++;
                                  
                                  if($paymentTerm == "Semi Monthly"){
                                      $identifier = $counterh % 2;
                                      if($identifier == 1){
                                          $interestPayment = $interestPayment;
                                      }else{
                                          $interestPayment = round($OSBalanceTemp * $loanInterestP,2,PHP_ROUND_HALF_ODD);
                                          $interestPayment = $interestPayment / $paymentTermP;
                                      }
                                      
                                  }elseif($paymentTerm == "Daily"){
                                      $identifier = (($counterh+1) % 30);
                                      if($identifier >= 1){
                                          $interestPayment = $interestPayment;
                                      }else{
                                          $interestPayment = round($OSBalanceTemp * $loanInterestP,2,PHP_ROUND_HALF_ODD);
                                          $interestPayment = $interestPayment / $paymentTermP;
                                      }
                                  }
                                  else{
                                      $interestPayment = round($OSBalanceTemp * $loanInterestP,2,PHP_ROUND_HALF_ODD);
                                      $interestPayment = $interestPayment / $paymentTermP;
                                  }
                                  
                                  $interestPayment = round($interestPayment,2,PHP_ROUND_HALF_ODD);
                                  $OSBalance = round($OSBalanceTemp,2,PHP_ROUND_HALF_ODD);

                                  $totalPrincipal = $totalPrincipal + $principalPayment;
                              }

                              if($totalInterest != 0 or $totalPrincipal !=0){
                                  $actualInterest = round(($totalInterest/$totalPrincipal) * 100);
                              }

                               $monthlyAmortization = $monthlyAmortization * $loanTermA;

                               if( $totalPrincipal != $loanAmount ){
                                  $monthlyAmortization = $monthlyAmortization - ($totalPrincipal - $loanAmount);
                                  $totalPrincipal = $totalPrincipal - ($totalPrincipal - $loanAmount);
                               }
                               echo "<tr>";
                                  echo "<td>" . "" . " </button> </td>";
                                  echo "<td>" . number_format($monthlyAmortization,'2','.',',') . "</td>";
                                  echo "<td>" . number_format($totalPrincipal,'2','.',',') . "</td>";
                                  echo "<td>" . number_format($totalInterest,'2','.',',') . "</td>";
                                  echo "<td>" . "" . " </button> </td>";
                                  echo "<td>" . "" . " </button> </td>";
                              echo "</tr>";
                          }
                        ?>
                    </div>
                </div>
            </div>
    	</div>
	</form>
</div>

</body>
    <?php include "css1.html" ?>
</html>