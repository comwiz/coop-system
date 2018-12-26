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

$loanAmount = 0;
$loanInterest = 0;
$loanTerm = 0;
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

//Special 
$principalAmount = 0;
$interestAmount = 0;
$datePayment = "";
$referencenumber = "";
$idNumberSearch = "";

include 'dbconnection.php';

$sql = "SELECT * FROM pl_loan_table";
$result = $conn->query($sql);
$count = mysqli_num_rows($result);
$loanApplicationNumber = $count + 1;
$loanApplicationNumber = 'PL' . $loanApplicationNumber;

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

    if (empty($_POST["loanAmount"]) && !is_numeric($_POST["loanAmount"])) {
        $countErr++;
    }else {
        $loanAmount = test_input($_POST["loanAmount"]);
    }

    if (empty($_POST["loanInterest"]) && !is_numeric($_POST["loanInterest"])) {
        $countErr++;
    }else {
        $loanInterest = test_input($_POST["loanInterest"]);
    }

    if (empty($_POST["loanTerm"]) && !is_numeric($_POST["loanTerm"])) {
        $countErr++;
    }else {
        $loanTerm = test_input($_POST["loanTerm"]);
    }

    if (empty($_POST["paymentTerm"])) {
        if($loanAmount != 0){
            $countErr++;
        }
    }else {
        $paymentTerm = test_input($_POST["paymentTerm"]);
    }

    if (empty($_POST["dateApplication"])) {
        if($loanAmount != 0){
            $countErr++;
        }
    }else {
        $dateApplication = test_input($_POST["dateApplication"]);
    }

    if (empty($_POST["principalAmount"]) && !is_numeric($_POST["principalAmount"])) {
        $countErr++;
    }else {
        $principalAmount = test_input($_POST["principalAmount"]);
    }

    if (empty($_POST["interestAmount"]) && !is_numeric($_POST["interestAmount"])) {
        $countErr++;
    }else {
        $interestAmount = test_input($_POST["interestAmount"]);
    }

    if (!empty($_POST["referencenumber"])) {
        $referencenumber = test_input($_POST["referencenumber"]);
    }

    if (!empty($_POST["datePayment"])) {
        $datePayment = test_input($_POST["datePayment"]);
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

        //$loanApplicationNumber = "";
        //$loanAmount = "";
        //$loanInterest = "";
        //$loanTerm = "";
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
    }

    
    if($submitApplication == "submitApplication"){
        if ($countErr <= 0) {
            $sql = "SELECT * FROM pl_loan_table WHERE loan_application_number = 'loanApplicationNumber' ";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            
            if($count <= 0){
                if($loanAmount !=0){
                    $sql = "INSERT INTO pl_loan_table(id_number, loan_application_number, loan_service_id,loan_amount, loan_term, loan_interest, payment_term,loan_status) 
                                VALUES ('$idNumber','$loanApplicationNumber','$loanServiceId','$loanAmount','$loanTerm', '$loanInterest','$paymentTerm','Released')";

                    $sql1 = "INSERT INTO loan_date_table(loan_application_number, date_application, date_approved_denied, date_released) 
                        VALUES ('$loanApplicationNumber','$dateApplication', '$dateApplication', '$dateApplication')";

                    $sql2 = "INSERT INTO loan_encoder_table(loan_application_number, encoded_by, reviewed_by, approved_denied_by,released_by) 
                            VALUES ('$loanApplicationNumber','1','1','1','1')";

                    if ($conn->query($sql) === TRUE){
                        $infomessage = "New record created successfully";
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    if ($conn->query($sql1) === TRUE){
                        $infomessage = "New record created successfully";
                    }else{
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }

                    if ($conn->query($sql2) === TRUE){
                        $infomessage = "New record created successfully";
                        //$loanApplicationNumber = "";
                        $loanServiceId = "";
                        $loanAmount = "";
                        $loanTerm = "";
                        $loanInterest = "";
                        $paymentTerm = "";
                        $dateApplication = "";

                        //$idNumber = "";
                        $firstName = "";
                        $middleName = "";
                        $lastName = "";
                        $accountNumber = "";

                    }else{
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }
                }
            }

            if( $principalAmount != 0 and $interestAmount != 0 and $referencenumber !=""){

                $sql = "INSERT INTO pl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                            VALUES ('$idNumber','$referencenumber','$loanApplicationNumber','$principalAmount','$datePayment', '1')";

                $sql1 = "INSERT INTO pl_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                    VALUES ('$idNumber','$loanApplicationNumber','$referencenumber','$interestAmount','$datePayment', '1')";

                if ($conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                        $informessage = "New record created successfully";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    echo "Error: " . $sql1 . "<br>" . $conn->error;
                }
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
                                    <input type="text" class="form-control" value = "<?php echo $loanApplicationNumber;?>" name = "loanApplicationNumber" placeholder="Loan Application Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="date" class="form-control" value = "<?php echo $dateApplication;?>" name = "dateApplication">
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
                                    <input type="date" class="form-control" value = "<?php echo $datePayment;?>" name = "datePayment">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $referencenumber;?>" name = "referencenumber" placeholder="OR Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Principal</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $principalAmount;?>" name = "principalAmount" placeholder="Principal Amount">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Interest</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $interestAmount;?>" name = "interestAmount" placeholder="Interest Amount">
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