<!DOCTYPE html>
<html>

<?php  

$loanServiceId = "";
$loanServiceType = "";
$loanServiceName = "";
$loanServiceEntitlement = "";
$loanReferenceNumber = "";
$loanableAmountMin = "";
$loanableAmountMax = "";
$loanTermsCount = "";
$loanTermsSuffix = "";
$loanInterest = "";
$typeInterest = "";
$serviceFee = "";
$filingFee = "";
$cbuLoanRetention = "";
$savingsLoanRetention = "";
$notarialFee = "";
$insuranceFee = "";
$remarks = "";
$encodedBy = "";

$searchLoanId = "";
$updateLoanService = "";

$countErr = "";
$identifier = "";
$infomessage = "";

include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!empty($_POST["searchLoanId"])) {
      $searchLoanId = test_input($_POST["searchLoanId"]);
  }

  if (!empty($_POST["updateLoanService"])) {
      $updateLoanService = test_input($_POST["updateLoanService"]);
  }

  if (empty($_POST["loanServiceId"])) {
      $countErr++;
  }else {
      $loanServiceId = test_input($_POST["loanServiceId"]);
  }

	if (empty($_POST["loanServiceType"])) {
	  	$countErr++;
	}else {
    	$loanServiceType = test_input($_POST["loanServiceType"]);
  }

  if (empty($_POST["loanServiceName"])) {
	  	$countErr++;
	}else {
    	$loanServiceName = test_input($_POST["loanServiceName"]);
  }

  if (empty($_POST["loanServiceEntitlement"])) {
      $countErr++;
  }else {
      $loanServiceEntitlement = test_input($_POST["loanServiceEntitlement"]);
  }

  if (empty($_POST["loanReferenceNumber"])) {
	  	$countErr++;
	}else {
    	$loanReferenceNumber = test_input($_POST["loanReferenceNumber"]);
  	}

  	if (empty($_POST["loanableAmountMin"])) {
	  	$countErr++;
	}else {
    	$loanableAmountMin = test_input($_POST["loanableAmountMin"]);
  	}

  	if (empty($_POST["loanableAmountMax"])) {
	  	$countErr++;
	}else {
    	$loanableAmountMax = test_input($_POST["loanableAmountMax"]);
  	}

  	if (empty($_POST["loanTermsCount"])) {
	  	$countErr++;
	}else {
    	$loanTermsCount = test_input($_POST["loanTermsCount"]);
  	}

  	if (empty($_POST["loanTermsSuffix"])) {
	  	$countErr++;
	}else {
    	$loanTermsSuffix = test_input($_POST["loanTermsSuffix"]);
  	}

  	if (empty($_POST["loanInterest"])) {
	  	$countErr++;
	}else {
    	$loanInterest = test_input($_POST["loanInterest"]);
  	}

  	if (empty($_POST["typeInterest"])) {
	  	$countErr++;
	}else {
    	$typeInterest = test_input($_POST["typeInterest"]);
  	}

  	if (empty($_POST["serviceFee"])) {
	  	$countErr++;
	}else {
    	$serviceFee = test_input($_POST["serviceFee"]);
  	}

  	if (empty($_POST["filingFee"])) {
	  	$countErr++;
	}else {
    	$filingFee = test_input($_POST["filingFee"]);
  	}

  	if (empty($_POST["cbuLoanRetention"])) {
	  	$countErr++;
	}else {
    	$cbuLoanRetention = test_input($_POST["cbuLoanRetention"]);
  	}

  	if (empty($_POST["savingsLoanRetention"])) {
	  	$countErr++;
	}else {
    	$savingsLoanRetention = test_input($_POST["savingsLoanRetention"]);
  	}

  	if (empty($_POST["notarialFee"])) {
	  	$countErr++;
	}else {
    	$notarialFee = test_input($_POST["notarialFee"]);
  	}

  	if (empty($_POST["insuranceFee"])) {
	  	$countErr++;
	}else {
    	$insuranceFee = test_input($_POST["insuranceFee"]);
  	}

  	if (empty($_POST["remarks"])) {
	  	$countErr++;
	}else {
    	$remarks = test_input($_POST["remarks"]);
  }

  if($searchLoanId == "searchLoanId"){
    $sqlSearchName = "SELECT * FROM loan_services_table WHERE loan_service_id = '$loanServiceId'";
    $resultSearchName = $conn->query($sqlSearchName);


    echo "$loanServiceId";

    if($resultSearchName->num_rows > 0){
        while($row = mysqli_fetch_array($resultSearchName)){
          $loanServiceType = $row['loan_service_type'];
          $loanServiceName = $row['loan_service_name'];
          $loanServiceEntitlement = $row['loan_service_entitlement'];
          $loanReferenceNumber = $row['loan_reference_number'];
          $loanableAmountMin = $row['loanable_amount_min'];
          $loanableAmountMax = $row['loanable_amount_max'];
          $loanableAmountMin = $row['loanable_amount_min'];
          $loanTermsCount = $row['loan_terms_count'];
          $loanTermsSuffix = $row['loan_terms_suffix'];
          $loanInterest = $row['loan_interest'];
          $typeInterest = $row['type_interest'];
          $serviceFee = $row['service_fee'];
          $filingFee = $row['filing_fee'];
          $cbuLoanRetention = $row['cbu_loan_retention'];
          $savingsLoanRetention = $row['savings_loan_retention'];
          $notarialFee = $row['notarial_fee'];
          $insuranceFee = $row['insurance_fee'];
          $remarks = $row['remarks'];
        }
    }
  }


  if($updateLoanService == "updateLoanService"){    

     $sql = "UPDATE loan_services_table SET
        loan_service_type = '$loanServiceType',
        loan_service_name = '$loanServiceName',
        loan_service_entitlement = '$loanServiceEntitlement',
        loan_reference_number = '$loanReferenceNumber',
        loanable_amount_min = '$loanableAmountMin',
        loanable_amount_min = '$loanableAmountMax',
        loan_terms_count = '$loanTermsCount',
        loan_terms_suffix = '$loanTermsSuffix',
        loan_interest = '$loanInterest',
        type_interest = '$typeInterest',
        service_fee = '$serviceFee',
        filing_fee = '$filingFee',
        cbu_loan_retention = '$cbuLoanRetention',
        savings_loan_retention = '$savingsLoanRetention',
        notarial_fee = '$notarialFee',
        insurance_fee = '$insuranceFee',
        remarks = '$remarks'
        WHERE loan_service_id = '$loanServiceId'";

  	if ($conn->query($sql) === TRUE){
  		$infomessage = "Loan Service Entry has been updated";
  	}else{
  		echo "Error: " . $sql . "<br>" . $conn->error;
      $infomessage = "FILL UP EMPTY FIELDS";
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
    <title>Loan Service Entry</title>
    <?php include "css.html" ?>
</head>

<body>
	<div>
    <?php include 'topbar.php';?>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  		<div>
        <div>
            
        </div>
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-10" style="margin-top:70px;margin-left: 16.7%;">
                  <p align="center"><span><?php echo $infomessage;?></span><br></p>
                  <div>
                    <div class="row">
                        <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                            <h5>Loan Service Entry</h5>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanServiceId;?>" name = "loanServiceId" placeholder="Loan Service ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                  <button class="btn btn-outline-success my-2 my-sm-0" name = "searchLoanId" value = "searchLoanId" type="submit" style="align-self: center;">SEARCH</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="<?php echo $loanServiceType;?>" name = "loanServiceType" placeholder="Loan Type">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text"  class="form-control" value = "<?php echo $loanServiceName;?>" name = "loanServiceName" placeholder="Loan Description">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <textarea type="text" class="form-control" value = "<?php echo $loanServiceEntitlement;?>" name = "loanServiceEntitlement" placeholder="Loan Entitlement">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanReferenceNumber;?>" name = "loanReferenceNumber" placeholder="Reference">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanableAmountMin;?>" name = "loanableAmountMin" placeholder="Minimum Loanable Amount">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanableAmountMax;?>" name = "loanableAmountMax" placeholder="Maximum Loanable Amount">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanTermsCount;?>" name = "loanTermsCount" placeholder="Term">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <select class="form-control" id="ea" name="loanTermsSuffix">
                                      <option value="" <?php if($loanTermsSuffix == "") echo "selected"; ?>>Select</option>
                                      <option value="Monthly" <?php if($loanTermsSuffix == "Months") echo "selected"; ?>>Months</option>
                                      <option value="Yearly" <?php if($loanTermsSuffix == "Years") echo "selected"; ?>>Years</option>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanInterest;?>" name = "loanInterest" placeholder="Loan Interest Rate">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <select class="form-control" id="ea" name="typeInterest">
                                      <option value="" <?php if($typeInterest == "") echo "selected"; ?>>Select</option>
                                      <option value="Diminishing" <?php if($typeInterest == "Diminishing") echo "selected"; ?>>Diminishing</option>
                                      <option value="Flat" <?php if($typeInterest == "Flat") echo "selected"; ?>>Flat</option>
                                   </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $serviceFee;?>" name = "serviceFee" placeholder="Service Fee">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $filingFee;?>" name = "filingFee" placeholder="Filing Fee">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $cbuLoanRetention;?>" name = "cbuLoanRetention" placeholder="CBU Loan Retention">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $savingsLoanRetention;?>" name = "savingsLoanRetention" placeholder="Savings Loan Retention">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $notarialFee;?>" name = "notarialFee" placeholder="Notarial Fee">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $insuranceFee;?>" name = "insuranceFee" placeholder="Insurance Fee">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $remarks;?>" name = "remarks" placeholder="Remarks.......">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                  <button class="btn btn-outline-success my-2 my-sm-0"  name = "updateLoanService" value = "updateLoanService" type="submit" style="align-self: center;">UPDATE</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
		  </div>
    </form>
	</div>

  <?php include 'footer.php';?>
  
</body>
    <?php include "css1.html" ?>
</html>