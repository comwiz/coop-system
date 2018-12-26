<!DOCTYPE html>
<html>

<?php  
require_once 'session.php';
//session_start();
/*session_cache_expire( 20 );
require_once 'session.php';
//session_start(); // NEVER FORGET TO START THE SESSION!!!
$inactive = 300;
if(isset($_SESSION['start']) ) {
    $session_life = time() - $_SESSION['start'];
    if($session_life > $inactive){
        //header("Location: user_logout.php");
        header("Location: http://system.local/MWMMPC/home/login.php");
    }
}
$_SESSION['start'] = time();
*/

$typePaymentCCHK = 0;

$idNumber = "";
$firstName = "";
$middleName = "";
$lastName = "";
$accountNumber = "";

$loanApplicationNumberId = "";
$referencenumber = "";
$amountPayment = 0;

$blLA = "Business Loan:";
$blPayment = 0;
$chklLA = "Check Loan:";
$chklPayment = 0;
$cllLA = "Calamity Loan:";
$cllPayment = 0;
$clLA = "Cash Loan:";
$clPayment = 0;
$cmlLA = "Chartgage Loan:";
$cmlPayment = 0;
$edlLA = "Education Loan:";
$edlPayment = 0;
$emlLA = "Emergency Loan:";
$emlPayment = 0;
$rlLA = "Regular Loan:";
$rlPayment = 0;
$slLA = "Special Loan:";
$slPayment = 0;
$plLA = "Previous Loan";
$plPayment = 0;
$pliPayment = 0;
$rclLA = "Rice Loan (P)";
$rclPayment = 0;
$rclPLA = "Rice Loan(I)";
$rclPPayment = 0;

$datePayment = date("Y-m-d");

//$amountPaymentPD = "";
//$datePaymentPD = "";
$amountPaymentP[] = "";
$amountPI[] = "";
$amountPaymentPP[] = "";
$amountBalance[] = "";
$datePaymentP[] = "";
$orNumber[] = "";

$loanApplicationNumberP = "";
$loanServiceIdP = 0;
$loanAmountP = 0;
$loanInterestP = 0;
$loanTermP = 0;
$typeInterestP = "";
$monthDate = "";
$paymentTerm = "";
$paymentTermP = 0;
$invoiceNumberP = "";

//
$otherIncome = "";
$otherAmountPayment = 0;

$amountPayment = 0;
$quantity = 0;
//$RiceLoanAP = "";

$loanApplicationNumber[] = "";
$loanServiceId[] = "";
$loanAmount[] = "";
$loanTerm[] = "";
$loanInterest[] = "";

$countErr = "";
$submitApplication = "";
$searchMember = "";
$identifier = "";
$displayProperty = "none";
$paidLoan = "";
$withdrawSavings = "";
$withdrawShareCapital = "";
$withdrawTimeDeposit = "";
$withdrawFixedDeposit = "";

$numRow = 0;
$infomessage = "";
$idNumberSearch = "";

//
$invoiceNumber = "";
$quantityCash = 0;
//paymentName

$mbfPayment = 0;
$scfPayment = 0;
$cbuDeposit = 0;
$savingsDeposit = 0;
$timeDeposit = 0;
$fixedDeposit = 0;
$plfPayment = 0;
$pnfPayment = 0;
$msfPayment = 0;
$rcfPayment = 0;
$rcfPaymentI = 0;
$ptfPayment = 0;
$rifPayment = 0;
$rrfPayment = 0;
$tffPayement = 0;

$infPayment =0;
$rbfPayment = 0;

$totalPayment = 0;
$typePayment = "";
$postPayment = "";

//cahier
$bl = 0;
$cll = 0;
$cml = 0;
$edl = 0;
$rl = 0;
$pl = 0;
$cl = 0;
$ckl = 0;
$eml = 0;
$sl = 0;
$rcl = 0;
$rcc = 0;
$oi = 0;
$sc = 0;
$sd = 0;
$td = 0;
$fd = 0;

$exitB = "";
$paymentCount = "";

$CBURecruit = "";
$depositReference = "";
$depositTerm = "";
$depositInterest = "";

$cashRegister = "";

$idNumberS = $_SESSION["idSession"];

$sqlOR = "SELECT * FROM `cashier_report_table` WHERE or_number=(SELECT MAX(or_number) FROM `cashier_report_table`)";
$resultOR = $conn->query($sqlOR);

if($resultOR->num_rows > 0){
    //echo "string";
    while ($row = mysqli_fetch_array($resultOR)) {
        # code...
        $referencenumber = $row['or_number'] + 1;

    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" or $idNumberS != "") {
    
    if($idNumberS == ""){
        if (!empty($_POST["searchMember"])) {
            $searchMember = test_input($_POST["searchMember"]);
        }

        if (!empty($_POST["myButton"])) {
            $loanApplicationNumberId = test_input($_POST["myButton"]);
        }

        if (!empty($_POST["paidLoan"])) {
            $paidLoan = test_input($_POST["paidLoan"]);
        }

        if (!empty($_POST["postPayment"])) {
            $postPayment = test_input($_POST["postPayment"]);
        }

        if (!empty($_POST["typePayment"])) {
            $typePayment = test_input($_POST["typePayment"]);
        }

        if (!empty($_POST["exitB"])) {
            $exitB = test_input($_POST["exitB"]);
        }

    	if (empty($_POST["idNumber"])) {
    	  	$countErr++;
    	}else {
        	$idNumber = test_input($_POST["idNumber"]);
      	}

        if (empty($_POST["referencenumber"])) {
            $countErr++;
        }else {
            $referencenumber = test_input($_POST["referencenumber"]);
        }

        if (!empty($_POST["loanApplicationNumberP"])) {
            $loanApplicationNumberP = test_input($_POST["loanApplicationNumberP"]);
        }

        if (empty($_POST["typePaymentCCHK"]) && !is_numeric($_POST["typePaymentCCHK"])) {
            $countErr++;
        }else {
            $typePaymentCCHK = test_input($_POST["typePaymentCCHK"]);
        }

        if (empty($_POST["datePayment"])) {
            $countErr++;
        }else {
            $datePayment = test_input($_POST["datePayment"]);
        }

        if (!empty($_POST["loanInterestP"])) {
            $loanInterestP = test_input($_POST["loanInterestP"]);
        }

        if (!empty($_POST["typeInterestP"])) {
            $typeInterestP = test_input($_POST["typeInterestP"]);
        }

        if (!empty($_POST["paymentTermP"])) {
            $paymentTermP = test_input($_POST["paymentTermP"]);
        }

        if (!empty($_POST["loanAmountP"]) ) {
            $loanAmountP = test_input($_POST["loanAmountP"]);
        }

        if (empty($_POST["savingsDeposit"]) && !is_numeric($_POST["savingsDeposit"])) {
            $countErr++;
        }else {
            $savingsDeposit = test_input($_POST["savingsDeposit"]);
        }

        if (empty($_POST["timeDeposit"]) && !is_numeric($_POST["timeDeposit"])) {
            $countErr++;
        }else {
            $timeDeposit = test_input($_POST["timeDeposit"]);

            if($timeDeposit > 0){
                if (empty($_POST["depositReference"]) && !is_numeric($_POST["depositReference"])) {
                    $countErr++;
                }else {
                    $depositReference = test_input($_POST["depositReference"]);
                }

                if (empty($_POST["depositInterest"]) && !is_numeric($_POST["depositInterest"])) {
                    $countErr++;
                }else {
                    $depositInterest = test_input($_POST["depositInterest"]);
                }

                if (empty($_POST["depositTerm"]) && !is_numeric($_POST["depositTerm"])) {
                    $countErr++;
                }else {
                    $depositTerm = test_input($_POST["depositTerm"]);
                }
            }
        }

        if (empty($_POST["fixedDeposit"]) && !is_numeric($_POST["fixedDeposit"])) {
            $countErr++;
        }else {
            $fixedDeposit = test_input($_POST["fixedDeposit"]);
            if($fixedDeposit > 0){
                if (empty($_POST["depositReference"]) && !is_numeric($_POST["depositReference"])) {
                    $countErr++;
                }else {
                    $depositReference = test_input($_POST["depositReference"]);
                }

                if (empty($_POST["depositInterest"]) && !is_numeric($_POST["depositInterest"])) {
                    $countErr++;
                }else {
                    $depositInterest = test_input($_POST["depositInterest"]);
                }

                if (empty($_POST["depositTerm"]) && !is_numeric($_POST["depositTerm"])) {
                    $countErr++;
                }else {
                    $depositTerm = test_input($_POST["depositTerm"]);
                }
            }
        }

        if (empty($_POST["cbuDeposit"]) && !is_numeric($_POST["cbuDeposit"])) {
            $countErr++;
        }else {
            $cbuDeposit = test_input($_POST["cbuDeposit"]);
        }

        if (empty($_POST["rcfPayment"]) && !is_numeric($_POST["rcfPayment"])) {
            $countErr++;
        }else {
            $rcfPayment = test_input($_POST["rcfPayment"]);

            if($rcfPayment > 0){
                if (empty($_POST["invoiceNumber"])) {
                    $countErr++;
                }else {
                    $invoiceNumber = test_input($_POST["invoiceNumber"]);
                }

                if (empty($_POST["quantityCash"])) {
                    $countErr++;
                }else {
                    $quantityCash = test_input($_POST["quantityCash"]);
                }
            }
        }

        if (empty($_POST["rcfPaymentI"]) && !is_numeric($_POST["rcfPaymentI"])) {
            $countErr++;
        }else {
            $rcfPaymentI = test_input($_POST["rcfPaymentI"]);
        }

        if (!empty($_POST["withdrawSavings"]) ) {
            $withdrawSavings = test_input($_POST["withdrawSavings"]);
        }

        if (!empty($_POST["withdrawShareCapital"]) ) {
            $withdrawShareCapital = test_input($_POST["withdrawShareCapital"]);
        }

        if (!empty($_POST["CBURecruit"]) ) {
            $CBURecruit = test_input($_POST["CBURecruit"]);
        }

        if (!empty($_POST["withdrawTimeDeposit"]) ) {
            $withdrawTimeDeposit = test_input($_POST["withdrawTimeDeposit"]);
        }

        if (!empty($_POST["withdrawFixedDeposit"]) ) {
            $withdrawFixedDeposit = test_input($_POST["withdrawFixedDeposit"]);
        }

        if (!empty($_POST["idNumberSearch"]) ) {
            $idNumberSearch = test_input($_POST["idNumberSearch"]);
        }

        if (empty($_POST["mbfPayment"]) && !is_numeric($_POST["mbfPayment"])) {
            $countErr++;
        }else {
            $mbfPayment = test_input($_POST["mbfPayment"]);
        }

        if (empty($_POST["scfPayment"]) && !is_numeric($_POST["scfPayment"])) {
            $countErr++;
        }else {
            $scfPayment = test_input($_POST["scfPayment"]);
        }

        if (empty($_POST["plfPayment"]) && !is_numeric($_POST["plfPayment"])) {
            $countErr++;
        }else {
            $plfPayment = test_input($_POST["plfPayment"]);
        }

        if (empty($_POST["pnfPayment"]) && !is_numeric($_POST["pnfPayment"])) {
            $countErr++;
        }else {
            $pnfPayment = test_input($_POST["pnfPayment"]);
        }

        if (empty($_POST["msfPayment"]) && !is_numeric($_POST["msfPayment"])) {
            $countErr++;
        }else {
            $msfPayment = test_input($_POST["msfPayment"]);
        }

        if (empty($_POST["ptfPayment"]) && !is_numeric($_POST["ptfPayment"])) {
            $countErr++;
        }else {
            $ptfPayment = test_input($_POST["ptfPayment"]);
        }

        if (empty($_POST["rifPayment"]) && !is_numeric($_POST["rifPayment"])) {
            $countErr++;
        }else {
            $rifPayment = test_input($_POST["rifPayment"]);
        }

        if (empty($_POST["rrfPayment"]) && !is_numeric($_POST["rrfPayment"])) {
            $countErr++;
        }else {
            $rrfPayment = test_input($_POST["rrfPayment"]);
        }

        if (empty($_POST["tffPayement"]) && !is_numeric($_POST["tffPayement"])) {
            $countErr++;
        }else {
            $tffPayement = test_input($_POST["tffPayement"]);
        }

        if (empty($_POST["blLA"]) && !is_numeric($_POST["blLA"])) {
            $countErr++;
        }else {
            $blLA = test_input($_POST["blLA"]);
        }

        if (empty($_POST["blPayment"]) && !is_numeric($_POST["blPayment"])) {
            $countErr++;
        }else {
            $blPayment = test_input($_POST["blPayment"]);
        }

        if (empty($_POST["chklLA"]) && !is_numeric($_POST["chklLA"])) {
            $countErr++;
        }else {
            $chklLA = test_input($_POST["chklLA"]);
        }

        if (empty($_POST["chklPayment"]) && !is_numeric($_POST["chklPayment"])) {
            $countErr++;
        }else {
            $chklPayment = test_input($_POST["chklPayment"]);
        }

        if (empty($_POST["cllLA"]) && !is_numeric($_POST["cllLA"])) {
            $countErr++;
        }else {
            $cllLA = test_input($_POST["cllLA"]);
        }

        if (empty($_POST["cllPayment"]) && !is_numeric($_POST["cllPayment"])) {
            $countErr++;
        }else {
            $cllPayment = test_input($_POST["cllPayment"]);
        }

        if (empty($_POST["clLA"]) && !is_numeric($_POST["clLA"])) {
            $countErr++;
        }else {
            $clLA = test_input($_POST["clLA"]);
        }

        if (empty($_POST["clPayment"]) && !is_numeric($_POST["clPayment"])) {
            $countErr++;
        }else {
            $clPayment = test_input($_POST["clPayment"]);
        }

        if (empty($_POST["cmlLA"]) && !is_numeric($_POST["cmlLA"])) {
            $countErr++;
        }else {
            $cmlLA = test_input($_POST["cmlLA"]);
        }

        if (empty($_POST["cmlPayment"]) && !is_numeric($_POST["cmlPayment"])) {
            $countErr++;
        }else {
            $cmlPayment = test_input($_POST["cmlPayment"]);
        }

        if (empty($_POST["edlLA"]) && !is_numeric($_POST["edlLA"])) {
            $countErr++;
        }else {
            $edlLA = test_input($_POST["edlLA"]);
        }

        if (empty($_POST["edlPayment"]) && !is_numeric($_POST["edlPayment"])) {
            $countErr++;
        }else {
            $edlPayment = test_input($_POST["edlPayment"]);
        }

        if (empty($_POST["emlLA"]) && !is_numeric($_POST["emlLA"])) {
            $countErr++;
        }else {
            $emlLA = test_input($_POST["emlLA"]);
        }

        if (empty($_POST["emlPayment"]) && !is_numeric($_POST["emlPayment"])) {
            $countErr++;
        }else {
            $emlPayment = test_input($_POST["emlPayment"]);
        }

        if (empty($_POST["rlLA"]) && !is_numeric($_POST["rlLA"])) {
            $countErr++;
        }else {
            $rlLA = test_input($_POST["rlLA"]);
        }

        if (empty($_POST["rlPayment"]) && !is_numeric($_POST["rlPayment"])) {
            $countErr++;
        }else {
            $rlPayment = test_input($_POST["rlPayment"]);
        }

        if (empty($_POST["slLA"]) && !is_numeric($_POST["slLA"])) {
            $countErr++;
        }else {
            $slLA = test_input($_POST["slLA"]);
        }

        if (empty($_POST["slPayment"]) && !is_numeric($_POST["slPayment"])) {
            $countErr++;
        }else {
            $slPayment = test_input($_POST["slPayment"]);
        }

        if (empty($_POST["plLA"]) && !is_numeric($_POST["plLA"])) {
            $countErr++;
        }else {
            $plLA = test_input($_POST["plLA"]);
        }

        if (empty($_POST["plPayment"]) && !is_numeric($_POST["plPayment"])) {
            $countErr++;
        }else {
            $plPayment = test_input($_POST["plPayment"]);
        }

        if (empty($_POST["pliPayment"]) && !is_numeric($_POST["pliPayment"])) {
            $countErr++;
        }else {
            $pliPayment = test_input($_POST["pliPayment"]);
        }

        if (!empty($_POST["paymentCount"])) {
            $paymentCount = test_input($_POST["paymentCount"]);
        }else {
            //$paymentCount = test_input($_POST["paymentCount"]);
        }

        if (empty($_POST["rclLA"]) && !is_numeric($_POST["rclLA"])) {
            $countErr++;
        }else {
            $rclLA = test_input($_POST["rclLA"]);
        }

        if (empty($_POST["rclPayment"]) && !is_numeric($_POST["rclPayment"])) {
            $countErr++;
        }else {
            $rclPayment = test_input($_POST["rclPayment"]);

            if($rclPayment > 0){
                if (empty($_POST["quantity"]) && !is_numeric($_POST["quantity"])) {
                    $countErr++;
                }else {
                    $quantity = test_input($_POST["quantity"]);
                }

                if (empty($_POST["invoiceNumberP"]) && !is_numeric($_POST["invoiceNumberP"])) {
                    $countErr++;
                }else {
                    $invoiceNumberP = test_input($_POST["invoiceNumberP"]);
                }
            }
        }

        if (empty($_POST["rclPPayment"]) && !is_numeric($_POST["rclPPayment"])) {
            $countErr++;
        }else {
            $rclPPayment = test_input($_POST["rclPPayment"]);
        }

        if (empty($_POST["infPayment"]) && !is_numeric($_POST["infPayment"])) {
            $countErr++;
        }else {
            $infPayment = test_input($_POST["infPayment"]);
        }

        if (empty($_POST["rbfPayment"]) && !is_numeric($_POST["rbfPayment"])) {
            $countErr++;
        }else {
            $rbfPayment = test_input($_POST["rbfPayment"]);
        }

        if (empty($_POST["totalPayment"]) && !is_numeric($_POST["totalPayment"])) {
            $countErr++;
        }else {
            $totalPayment = test_input($_POST["totalPayment"]);
        }

        if (!empty($_POST["cashRegister"]) ) {
            $cashRegister = test_input($_POST["cashRegister"]);
        }


        if($exitB == "exitB"){
            session_destroy();
            header("Location: http://localhost/projectkikz/samplemwmmpc/application/views/home/login.php");
        }

        if($cashRegister == "cashRegister"){
            header("Location: http://system.local/MWMMPC/home/cashierDailyReport.php");
        }

        if($postPayment == "postPayment"){
            $totalPayment = $mbfPayment + $scfPayment + $cbuDeposit + $savingsDeposit + $timeDeposit + $plfPayment + $pnfPayment + $msfPayment + $rcfPayment + $rcfPaymentI + $ptfPayment + $rifPayment + $rrfPayment + $tffPayement + $blPayment + $chklPayment + $cllPayment + $clPayment + $cmlPayment + $edlPayment + $emlPayment + $rlPayment + $slPayment + $plPayment + $pliPayment + $rclPayment + $rclPPayment + $infPayment + $rbfPayment + $fixedDeposit;
        }
    }

    if($idNumberS != ""){
        $idNumberSearch = $idNumberS;
        $typePaymentCCHK = 0;
    }
    
    if ($searchMember == "searchMember" or $loanApplicationNumberId != "" or $typePayment != "" or $idNumberSearch != "") {
        # search member..

        $sqlSearchName = "SELECT * FROM name_table WHERE (CONCAT(first_name, ' ', last_name) LIKE '%$idNumberSearch%' OR last_name LIKE '%$idNumberSearch%' or  id_number = '$idNumberSearch') and  (member_status != 'Resigned' and member_status != 'Diseased' ) ";

        $resultSearchName = $conn->query($sqlSearchName);

        if($resultSearchName->num_rows > 0){
            while($row = mysqli_fetch_array($resultSearchName)){
              $idNumber = $row['id_number'];
              $accountNumber = $row['account_number'];
              $firstName = $row['first_name'];
              $middleName = $row['middle_name'];
              $lastName = $row['last_name'];
              //$totalPayment = 0;
            }
        }else{
            $idNumber = "";
            $firstName = "";
            $middleName = "";
            $lastName = "";
            $totalPayment = 0;

        }

        $_SESSION["idSession"] = "";

        $sqlbi = "SELECT * FROM  bl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);
        $counter = 0;

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  ckl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  cml_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  cl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  cll_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  edl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  eml_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  rl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  sl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  pl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {

                $loanServiceTag = $row['loan_service_id'];

                $sqlLSN = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceTag'";
                    $resultLSN = $conn->query($sqlLSN);

                if($resultLSN->num_rows > 0){
                    while ($rowSN = mysqli_fetch_array($resultLSN)){
                        $loanServiceTag = $rowSN['loan_service_name'];
                    }
                }

                if($loanServiceTag == "First Loan" or $loanServiceTag == "Second Loan"){
                    $loanServiceTag = "Regular Loan";
                }

                # code...
                $loanApplicationNumber[$counter] = $row['loan_application_number'] . " " . "(" . $loanServiceTag . ")";
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $counter++;
            }

            $loanServiceTag = "";
        }

        $sqlbi = "SELECT * FROM  rice_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumber[$counter] = $row['loan_application_number'] . " " . "(" . $row['invoice_number'] . ")";
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];
                //$loanInterest[$counter] = $row['loan_interest'];

                $counter++;
            }
        }

        $sqltd = "SELECT * FROM  time_deposit_table WHERE withdraw_td != '1'";
        $resulttd = $conn->query($sqltd);
        
        if($resulttd->num_rows > 0){
            $numRowTD = mysqli_num_rows($resulttd) + 1;
        }else{
            $numRowTD = 1;
        }

        $depositReferenceT = "TD" . $numRowTD;

        $sqltd = "SELECT * FROM  fixed_deposit_table WHERE withdraw_td != '1'";
        $resulttd = $conn->query($sqltd);
        
        if($resulttd->num_rows > 0){
            $numRowTD = mysqli_num_rows($resulttd) + 1;
        }else{
            $numRowTD = 1;
        }

        $depositReferenceF = "FD" . $numRowTD;

        /*
        $sqltd = "SELECT * FROM  fixed_deposit_table WHERE id_number = '$idNumber' and withdraw_td != '1'";
        $resulttd = $conn->query($sqltd);
        $numRowTD = mysqli_num_rows($resulttd);
        $counterTD = 0;

        if($resulttd->num_rows > 0){
            while ($row = mysqli_fetch_array($resulttd)) {
                # code...
                $TDDeposit[$counterTD] = $row['loan_application_number'] . " " . "(" . $row['invoice_number'] . ")";
                $counterTD++;
            }
        }*/


        if($counter > 0){
            $displayProperty = "inline";
        }else{
            $displayProperty = "none";
        }

        if($loanApplicationNumberId != "" or $typePayment != ""){

            if($typePayment != ""){
                $loanApplicationNumberId = $typePayment;
            }
            if(substr($loanApplicationNumberId, 0,2) == "BL"){

                $sqlP = "SELECT * FROM  bl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' ";
                $resultP = $conn->query($sqlP);

                if($resultP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultP)) {
                        # code...
                        $idNumber = $row['id_number'];
                        $loanApplicationNumberP = $row['loan_application_number'];
                        $loanServiceIdP = $row['loan_service_id'];
                        $loanAmountP = $row['loan_amount'];
                        $loanTermP= $row['loan_term'];
                        $loanInterestP = $row['loan_interest'];
                        $paymentTermP = $row['payment_term'];

                        $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $typeInterestP = $row['type_interest'];
                            }
                        }

                        $sqlLP = "SELECT * FROM  bl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLP = $conn->query($sqlLP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterPayment = 0;

                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                # code...
                                $amountPaymentP[$counterPayment] = $row['amount'];
                                $datePaymentP[$counterPayment] = $row['date_payment'];
                                $orNumber[$counterPayment] = $row['reference_number'];
                                $counterPayment++;
                                
                            }
                        }

                        $sqlLIP = "SELECT * FROM  bl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' and interest_revenue != 0";
                        $resultLIP = $conn->query($sqlLIP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterInterest = 0;

                        if($resultLIP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLIP)) {
                                $amountPI[$counterInterest] = $row['interest_revenue'];
                                $orNumber[$counterPayment] = $row['reference_number'];
                                $counterInterest++;
                            }
                        }

                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $accountNumber = $row['account_number'];
                                $firstName = $row['first_name'];
                                $middleName = $row['middle_name'];
                                $lastName = $row['last_name'];
                            }
                        }

                        $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLD = $conn->query($sqlLD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLD->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLD)) {
                                # code...
                                $monthDate = $row['date_application'];
                                $monthDate = new DateTime($monthDate);
                            }
                        }
                    }
                }
            }elseif(substr($loanApplicationNumberId, 0,3) == "CKL"){

                $sqlP = "SELECT * FROM  ckl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' ";
                $resultP = $conn->query($sqlP);

                if($resultP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultP)) {
                        # code...
                        $idNumber = $row['id_number'];
                        $loanApplicationNumberP = $row['loan_application_number'];
                        $loanServiceIdP = $row['loan_service_id'];
                        $loanAmountP = $row['loan_amount'];
                        $loanTermP= $row['loan_term'];
                        $loanInterestP = $row['loan_interest'];
                        $paymentTermP = $row['payment_term'];

                        $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $typeInterestP = $row['type_interest'];
                            }
                        }

                        $sqlLP = "SELECT * FROM  ckl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLP = $conn->query($sqlLP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterPayment = 0;

                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                # code...
                                $amountPaymentP[$counterPayment] = $row['amount'];
                                $datePaymentP[$counterPayment] = $row['date_payment'];
                                $orNumber[$counterPayment] = $row['reference_number'];
                                $counterPayment++;
                                
                            }
                        }

                        $sqlLIP = "SELECT * FROM  ckl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' and interest_revenue != 0";
                        $resultLIP = $conn->query($sqlLIP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterInterest = 0;

                        if($resultLIP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLIP)) {
                                $amountPI[$counterInterest] = $row['interest_revenue'];
                                $counterInterest++;
                            }
                        }

                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $accountNumber = $row['account_number'];
                                $firstName = $row['first_name'];
                                $middleName = $row['middle_name'];
                                $lastName = $row['last_name'];
                            }
                        }

                        $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLD = $conn->query($sqlLD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLD->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLD)) {
                                # code...
                                $monthDate = $row['date_application'];
                                $monthDate = new DateTime($monthDate);
                            }
                        }
                    }
                }
            }elseif(substr($loanApplicationNumberId, 0,3) == "CML"){

                $sqlP = "SELECT * FROM  cml_loan_table WHERE loan_application_number = '$loanApplicationNumberId' ";
                $resultP = $conn->query($sqlP);

                if($resultP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultP)) {
                        # code...
                        $idNumber = $row['id_number'];
                        $loanApplicationNumberP = $row['loan_application_number'];
                        $loanServiceIdP = $row['loan_service_id'];
                        $loanAmountP = $row['loan_amount'];
                        $loanTermP= $row['loan_term'];
                        $loanInterestP = $row['loan_interest'];
                        $paymentTermP = $row['payment_term'];

                        $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $typeInterestP = $row['type_interest'];
                            }
                        }

                        $sqlLP = "SELECT * FROM  cml_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLP = $conn->query($sqlLP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterPayment = 0;

                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                # code...
                                $amountPaymentP[$counterPayment] = $row['amount'];
                                $datePaymentP[$counterPayment] = $row['date_payment'];
                                $orNumber[$counterPayment] = $row['reference_number'];
                                $counterPayment++;
                                
                            }
                        }

                        $sqlLIP = "SELECT * FROM  cml_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' and interest_revenue != 0";
                        $resultLIP = $conn->query($sqlLIP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterInterest = 0;

                        if($resultLIP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLIP)) {
                                $amountPI[$counterInterest] = $row['interest_revenue'];
                                $counterInterest++;
                            }
                        }

                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $accountNumber = $row['account_number'];
                                $firstName = $row['first_name'];
                                $middleName = $row['middle_name'];
                                $lastName = $row['last_name'];
                            }
                        }

                        $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLD = $conn->query($sqlLD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLD->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLD)) {
                                # code...
                                $monthDate = $row['date_application'];
                                $monthDate = new DateTime($monthDate);
                            }
                        }
                    }
                }
            }elseif(substr($loanApplicationNumberId, 0,3) == "CLL"){
                $sqlP = "SELECT * FROM  cll_loan_table WHERE loan_application_number = '$loanApplicationNumberId' ";
                $resultP = $conn->query($sqlP);

                if($resultP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultP)) {
                        # code...
                        $idNumber = $row['id_number'];
                        $loanApplicationNumberP = $row['loan_application_number'];
                        $loanServiceIdP = $row['loan_service_id'];
                        $loanAmountP = $row['loan_amount'];
                        $loanTermP= $row['loan_term'];
                        $loanInterestP = $row['loan_interest'];
                        $paymentTermP = $row['payment_term'];

                        $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $typeInterestP = $row['type_interest'];
                            }
                        }

                        $sqlLP = "SELECT * FROM  cll_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLP = $conn->query($sqlLP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterPayment = 0;

                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                # code...
                                $amountPaymentP[$counterPayment] = $row['amount'];
                                $datePaymentP[$counterPayment] = $row['date_payment'];
                                $orNumber[$counterPayment] = $row['reference_number'];
                                $counterPayment++;
                                
                            }
                        }

                        $sqlLIP = "SELECT * FROM  cll_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' and interest_revenue != 0";
                        $resultLIP = $conn->query($sqlLIP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterInterest = 0;

                        if($resultLIP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLIP)) {
                                $amountPI[$counterInterest] = $row['interest_revenue'];
                                $counterInterest++;
                            }
                        }

                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $accountNumber = $row['account_number'];
                                $firstName = $row['first_name'];
                                $middleName = $row['middle_name'];
                                $lastName = $row['last_name'];
                            }
                        }

                        $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLD = $conn->query($sqlLD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLD->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLD)) {
                                # code...
                                $monthDate = $row['date_application'];
                                $monthDate = new DateTime($monthDate);
                            }
                        }
                    }
                }
            }elseif(substr($loanApplicationNumberId, 0,2) == "CL"){
                $sqlP = "SELECT * FROM  cl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' ";
                $resultP = $conn->query($sqlP);

                if($resultP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultP)) {
                        # code...
                        $idNumber = $row['id_number'];
                        $loanApplicationNumberP = $row['loan_application_number'];
                        $loanServiceIdP = $row['loan_service_id'];
                        $loanAmountP = $row['loan_amount'];
                        $loanTermP= $row['loan_term'];
                        $loanInterestP = $row['loan_interest'];
                        $paymentTermP = $row['payment_term'];

                        $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $typeInterestP = $row['type_interest'];
                            }
                        }

                        $sqlLP = "SELECT * FROM  cl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLP = $conn->query($sqlLP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterPayment = 0;

                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                # code...
                                $amountPaymentP[$counterPayment] = $row['amount'];
                                $datePaymentP[$counterPayment] = $row['date_payment'];
                                $orNumber[$counterPayment] = $row['reference_number'];
                                $counterPayment++;
                                
                            }
                        }

                        $sqlLIP = "SELECT * FROM  cl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' and interest_revenue != 0";
                        $resultLIP = $conn->query($sqlLIP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterInterest = 0;

                        if($resultLIP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLIP)) {
                                $amountPI[$counterInterest] = $row['interest_revenue'];
                                $counterInterest++;
                            }
                        }

                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $accountNumber = $row['account_number'];
                                $firstName = $row['first_name'];
                                $middleName = $row['middle_name'];
                                $lastName = $row['last_name'];
                            }
                        }

                        $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLD = $conn->query($sqlLD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLD->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLD)) {
                                # code...
                                $monthDate = $row['date_application'];
                                $monthDate = new DateTime($monthDate);
                            }
                        }
                    }
                }
            }elseif(substr($loanApplicationNumberId, 0,3) == "EDL"){

                $sqlP = "SELECT * FROM  edl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' ";
                $resultP = $conn->query($sqlP);

                if($resultP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultP)) {
                        # code...
                        $idNumber = $row['id_number'];
                        $loanApplicationNumberP = $row['loan_application_number'];
                        $loanServiceIdP = $row['loan_service_id'];
                        $loanAmountP = $row['loan_amount'];
                        $loanTermP= $row['loan_term'];
                        $loanInterestP = $row['loan_interest'];
                        $paymentTermP = $row['payment_term'];

                        $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $typeInterestP = $row['type_interest'];
                            }
                        }

                        $sqlLP = "SELECT * FROM  edl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLP = $conn->query($sqlLP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterPayment = 0;

                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                # code...
                                $amountPaymentP[$counterPayment] = $row['amount'];
                                $datePaymentP[$counterPayment] = $row['date_payment'];
                                $orNumber[$counterPayment] = $row['reference_number'];
                                $counterPayment++;
                                
                            }
                        }

                        $sqlLIP = "SELECT * FROM  edl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' and interest_revenue != 0";
                        $resultLIP = $conn->query($sqlLIP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterInterest = 0;

                        if($resultLIP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLIP)) {
                                $amountPI[$counterInterest] = $row['interest_revenue'];
                                $counterInterest++;
                            }
                        }

                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $accountNumber = $row['account_number'];
                                $firstName = $row['first_name'];
                                $middleName = $row['middle_name'];
                                $lastName = $row['last_name'];
                            }
                        }

                        $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLD = $conn->query($sqlLD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLD->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLD)) {
                                # code...
                                $monthDate = $row['date_application'];
                                $monthDate = new DateTime($monthDate);
                            }
                        }
                    }
                }
            }elseif(substr($loanApplicationNumberId, 0,3) == "EML"){

                $sqlP = "SELECT * FROM  eml_loan_table WHERE loan_application_number = '$loanApplicationNumberId' ";
                $resultP = $conn->query($sqlP);

                if($resultP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultP)) {
                        # code...
                        $idNumber = $row['id_number'];
                        $loanApplicationNumberP = $row['loan_application_number'];
                        $loanServiceIdP = $row['loan_service_id'];
                        $loanAmountP = $row['loan_amount'];
                        $loanTermP= $row['loan_term'];
                        $loanInterestP = $row['loan_interest'];
                        $paymentTermP = $row['payment_term'];

                        $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $typeInterestP = $row['type_interest'];
                            }
                        }

                        $sqlLP = "SELECT * FROM  eml_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLP = $conn->query($sqlLP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterPayment = 0;

                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                # code...
                                $amountPaymentP[$counterPayment] = $row['amount'];
                                $datePaymentP[$counterPayment] = $row['date_payment'];
                                $orNumber[$counterPayment] = $row['reference_number'];
                                $counterPayment++;
                                
                            }
                        }

                        $sqlLIP = "SELECT * FROM  eml_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' and interest_revenue != 0";
                        $resultLIP = $conn->query($sqlLIP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterInterest = 0;

                        if($resultLIP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLIP)) {
                                $amountPI[$counterInterest] = $row['interest_revenue'];
                                $counterInterest++;
                            }
                        }

                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $accountNumber = $row['account_number'];
                                $firstName = $row['first_name'];
                                $middleName = $row['middle_name'];
                                $lastName = $row['last_name'];
                            }
                        }

                        $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLD = $conn->query($sqlLD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLD->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLD)) {
                                # code...
                                $monthDate = $row['date_application'];
                                $monthDate = new DateTime($monthDate);
                            }
                        }
                    }
                }
            }elseif(substr($loanApplicationNumberId, 0,2) == "RL"){

                $sqlP = "SELECT * FROM  rl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' ";
                $resultP = $conn->query($sqlP);

                if($resultP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultP)) {
                        # code...
                        $idNumber = $row['id_number'];
                        $loanApplicationNumberP = $row['loan_application_number'];
                        $loanServiceIdP = $row['loan_service_id'];
                        $loanAmountP = $row['loan_amount'];
                        $loanTermP= $row['loan_term'];
                        $loanInterestP = $row['loan_interest'];
                        $paymentTermP = $row['payment_term'];

                        $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $typeInterestP = $row['type_interest'];
                            }
                        }

                        $sqlLP = "SELECT * FROM  rl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLP = $conn->query($sqlLP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterPayment = 0;

                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                # code...
                                $amountPaymentP[$counterPayment] = $row['amount'];
                                $datePaymentP[$counterPayment] = $row['date_payment'];
                                $orNumber[$counterPayment] = $row['reference_number'];
                                $counterPayment++;
                                
                            }
                        }

                        $sqlLIP = "SELECT * FROM  rl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' and interest_revenue != 0";
                        $resultLIP = $conn->query($sqlLIP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterInterest = 0;

                        if($resultLIP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLIP)) {
                                $amountPI[$counterInterest] = $row['interest_revenue'];
                                $counterInterest++;
                            }
                        }

                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $accountNumber = $row['account_number'];
                                $firstName = $row['first_name'];
                                $middleName = $row['middle_name'];
                                $lastName = $row['last_name'];
                            }
                        }

                        $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLD = $conn->query($sqlLD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLD->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLD)) {
                                # code...
                                $monthDate = $row['date_application'];
                                $monthDate = new DateTime($monthDate);
                            }
                        }
                    }
                }
            }elseif(substr($loanApplicationNumberId, 0,2) == "SL"){

                $sqlP = "SELECT * FROM  sl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' ";
                $resultP = $conn->query($sqlP);

                if($resultP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultP)) {
                        # code...
                        $idNumber = $row['id_number'];
                        $loanApplicationNumberP = $row['loan_application_number'];
                        $loanServiceIdP = $row['loan_service_id'];
                        $loanAmountP = $row['loan_amount'];
                        $loanTermP= $row['loan_term'];
                        $loanInterestP = $row['loan_interest'];
                        $paymentTermP = $row['payment_term'];

                        $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $typeInterestP = $row['type_interest'];
                            }
                        }

                        $sqlLP = "SELECT * FROM  sl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLP = $conn->query($sqlLP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterPayment = 0;

                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                # code...
                                $amountPaymentP[$counterPayment] = $row['amount'];
                                $datePaymentP[$counterPayment] = $row['date_payment'];
                                $orNumber[$counterPayment] = $row['reference_number'];
                                $counterPayment++;
                                
                            }
                        }

                        $sqlLIP = "SELECT * FROM  sl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' and interest_revenue != 0";
                        $resultLIP = $conn->query($sqlLIP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterInterest = 0;

                        if($resultLIP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLIP)) {
                                $amountPI[$counterInterest] = $row['interest_revenue'];
                                $counterInterest++;
                            }
                        }

                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $accountNumber = $row['account_number'];
                                $firstName = $row['first_name'];
                                $middleName = $row['middle_name'];
                                $lastName = $row['last_name'];
                            }
                        }

                        $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLD = $conn->query($sqlLD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLD->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLD)) {
                                # code...
                                $monthDate = $row['date_application'];
                                $monthDate = new DateTime($monthDate);
                            }
                        }
                    }
                }
            }elseif(substr($loanApplicationNumberId, 0,2) == "PL"){

                $sqlP = "SELECT * FROM  pl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' ";
                $resultP = $conn->query($sqlP);

                if($resultP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultP)) {
                        # code...
                        $idNumber = $row['id_number'];
                        $loanApplicationNumberP = $row['loan_application_number'];
                        $loanServiceIdP = $row['loan_service_id'];
                        $loanAmountP = $row['loan_amount'];
                        $loanTermP= $row['loan_term'];
                        $loanInterestP = $row['loan_interest'];
                        $paymentTermP = $row['payment_term'];

                        $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $typeInterestP = $row['type_interest'];
                            }
                        }

                        $sqlLP = "SELECT * FROM  pl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLP = $conn->query($sqlLP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterPayment = 0;

                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                # code...
                                $amountPaymentP[$counterPayment] = $row['amount'];
                                $datePaymentP[$counterPayment] = $row['date_payment'];
                                $orNumber[$counterPayment] = $row['reference_number'];
                                $counterPayment++;
                                
                            }
                        }

                        $sqlLIP = "SELECT * FROM  pl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' and interest_revenue != 0";
                        $resultLIP = $conn->query($sqlLIP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterInterest = 0;

                        if($resultLIP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLIP)) {
                                $amountPI[$counterInterest] = $row['interest_revenue'];
                                $counterInterest++;
                            }
                        }

                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $accountNumber = $row['account_number'];
                                $firstName = $row['first_name'];
                                $middleName = $row['middle_name'];
                                $lastName = $row['last_name'];
                            }
                        }

                        $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLD = $conn->query($sqlLD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLD->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLD)) {
                                # code...
                                $monthDate = $row['date_application'];
                                $monthDate = new DateTime($monthDate);
                            }
                        }
                    }
                }
            }elseif(substr($loanApplicationNumberId, 0,3) == "RCL"){

                $sqlP = "SELECT * FROM  rice_loan_table WHERE loan_application_number = '$loanApplicationNumberId' ";
                $resultP = $conn->query($sqlP);

                if($resultP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultP)) {
                        # code...
                        $idNumber = $row['id_number'];
                        $loanApplicationNumberP = $row['loan_application_number'];
                        $invoiceNumberP = $row['invoice_number'];
                        $loanServiceIdP = $row['loan_service_id'];
                        $loanAmountP = $row['loan_amount'];
                        $loanTermP= $row['loan_term'];
                        $loanInterestP = $row['loan_interest'];
                        $paymentTermP = $row['payment_term'];
                        $quantity = $row['quantity'];

                        $rclPayment = $loanAmountP;
                        $rclPPayment = $loanInterestP;
                        $totalPayment = $loanAmountP + $loanInterestP;

                        $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $typeInterestP = $row['type_interest'];
                            }
                        }

                        $sqlLP = "SELECT * FROM  rice_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLP = $conn->query($sqlLP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterPayment = 0;

                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                # code...
                                $amountPaymentP[$counterPayment] = $row['amount'];
                                $datePaymentP[$counterPayment] = $row['date_payment'];
                                $orNumber[$counterPayment] = $row['reference_number'];
                                $counterPayment++;
                                
                            }
                        }

                        $sqlLIP = "SELECT * FROM  rice_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' and interest_revenue != 0";
                        $resultLIP = $conn->query($sqlLIP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterInterest = 0;

                        if($resultLIP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLIP)) {
                                $amountPI[$counterInterest] = $row['interest_revenue'];
                                $counterInterest++;
                            }
                        }

                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $accountNumber = $row['account_number'];
                                $firstName = $row['first_name'];
                                $middleName = $row['middle_name'];
                                $lastName = $row['last_name'];
                            }
                        }

                        $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                        $resultLD = $conn->query($sqlLD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLD->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLD)) {
                                # code...
                                $monthDate = $row['date_application'];
                                $monthDate = new DateTime($monthDate);
                            }
                        }
                    }
                }
            }

            $displayProperty = "inline";
        }

        if($searchMember == "searchMember"){
            $typeInterestP = "";
            $loanAmountP = "";
            $loanInterestP = "";
            $loanApplicationNumberP = "";

            $blLA = "Business Loan:";
            $chklLA = "Check Loan:";
            $cllLA = "Calamity Loan:";
            $clLA = "Cash Loan:";
            $cmlLA = "Chartgage Loan:";
            $edlLA = "Education Loan:";
            $emlLA = "Emergency Loan:";
            $rlLA = "Regular Loan:";
            $slLA = "Special Loan:";
            $plLA = "Previous Loan";
            $rclLA = "Rice Loan (P)";
            $rclPLA = "Rice Loan (I)";

            //$referencenumber = "";
            $quantity = 0;

            $mbfPayment = 0;
            $scfPayment = 0;
            $cbuDeposit = 0;
            $savingsDeposit = 0;
            $timeDeposit = 0;
            $fixedDeposit = 0;
            $plfPayment = 0;
            $pnfPayment = 0;
            $msfPayment = 0;
            $rcfPayment = 0;
            $rcfPaymentI = 0;
            $ptfPayment = 0;
            $rifPayment = 0;
            $rrfPayment = 0;
            $tffPayement = 0;

            $blPayment = 0;
            $chklPayment = 0;
            $cllPayment = 0;
            $clPayment = 0;
            $cmlPayment = 0;
            $edlPayment = 0;
            $emlPayment = 0;
            $rlPayment = 0;
            $slPayment = 0;
            $plPayment = 0;
            $pliPayment = 0;
            $rclPayment = 0;
            $rclPPayment = 0;
            $infPayment = 0;
            $rbfPayment = 0;

            $invoiceNumberP = "";
            $invoiceNumber = "";
            $quantityCash = "";

            $depositTerm = "";
            $depositReference = "";
            $depositInterest = "";

            $totalPayment = 0;

            $typePaymentCCHK = 0;
        }
    }

    if($paidLoan == "paidLoan"){
        if($countErr<=0){
            if($paymentCount == 0){
                //$paymentCount = "";
            }

            
            //BL
            if(substr("$blLA",0,2) == "BL" and $blPayment != 0){
                $bl = 1;

                if($paymentCount > 0){
                    $blPayment = $blPayment/$paymentCount;
                    $paymentCounter = 1;
                }else{
                    $paymentCounter = 0;
                }

                while($paymentCount >= $paymentCounter){
                    $sqlLP = "SELECT * FROM  bl_loan_payment_table WHERE loan_application_number = '$blLA' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  bl_credit_revenue_table WHERE loan_application_number = '$blLA' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "SELECT * FROM  bl_loan_table WHERE loan_application_number = '$blLA' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    $currentBalance  = 0;
                    //TotalPayment
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $totalPrincipalPayment = $row['amount'];
                            $currentBalance = $currentBalance + $totalPrincipalPayment;
                        }
                    }
                    //Get Next Interest
                    $counterI = 0;
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            if($row['interest_revenue'] != 0){
                                $lastInterest[$counterI] = $row['interest_revenue'];
                                $counterI++;
                            }
                        }
                    }else{
                        $lastInterest[$counterI] = 0;
                    }
                    //Get loan info
                    if($resultLP2->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP2)) {
                            $loanInterestP = $row['loan_interest'];
                            $paymentTermP =  $row['payment_term'];
                            $loanAmountP = $row['loan_amount'];
                        }
                    }

                    //Connert int
                    $loanInterestP = $loanInterestP/100;
                    $currentPrincipal = 0;
                    $currentInterest = 0;

                    //check term of payment
                    if ($paymentTermP == "Daily") {
                        $loanTermP = $loanTermP * 30;
                        $paymentTerm = 30;
                    }elseif ($paymentTermP == "Semi Monthly") {
                        $loanTermP = $loanTermP * 2;
                        $paymentTerm = 2;
                    }
                    elseif ($paymentTermP == "Monthly") {
                        $loanTermP = $loanTermP * 1;  
                        $paymentTerm = 1;
                    }

                    $currentBalance = $loanAmountP - $currentBalance;

                    //Current Interest Semi . Daily. Monthly
                    $checkInterestP = ($counterI + 1)%2;
                    $checkInterestPI = ($counterI + 1)%30;

                    //Comute Interest
                    if( ($checkInterestP == 0 and $paymentTerm == 2) or ($checkInterestPI != 1 and $counterI!=0 and $paymentTerm == 30) ){
                        $currentInterest = $lastInterest[$counterI-1];
                    }else{
                        $currentInterest = ($currentBalance * $loanInterestP)/$paymentTerm;
                    }

                    $currentInterest = round($currentInterest,2,PHP_ROUND_HALF_ODD);

                    //Compute Principal
                    $currentPrincipal = $blPayment - $currentInterest;
                    $currentPrincipal = round($currentPrincipal,2,PHP_ROUND_HALF_ODD);

                    $currentBalanceTemp = $currentBalance;

                    //Update Status if Paid
                    //echo "$currentBalanceTemp";

                    if($currentBalanceTemp <= $blPayment){
                        $sql = "UPDATE bl_loan_table SET
                        loan_status = 'Paid',
                        last_payment = '$datePayment',
                        date_paid = '$datePayment' WHERE id_number = '$idNumber' and loan_application_number = '$blLA' ";

                        if ($conn->query($sql) === TRUE) {
                            $infomessage = "Record updated successfully";

                            $sqlDP = "UPDATE loan_date_table SET
                            date_paid = '$datePayment';
                            WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberId' ";

                            if ($conn->query($sqlDP) === TRUE) {
                               $infomessage = "Loan Paid";
                            } 
                            else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                            }

                        } 
                        else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }else{
                        $sql = "UPDATE bl_loan_table SET
                        last_payment = '$datePayment' 
                        WHERE id_number = '$idNumber' and loan_application_number = '$blLA' ";

                        if ($conn->query($sql) === TRUE) {
                            $infomessage = "Record updated successfully";
                        } 
                        else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    $sql = "INSERT INTO bl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by, payment_count) 
                        VALUES ('$idNumber','$referencenumber','$blLA','$currentPrincipal','$datePayment', '$encodedBy', '$paymentCounter')";

                    $sql1 = "INSERT INTO bl_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by, payment_count) 
                        VALUES ('$idNumber','$blLA','$referencenumber','$currentInterest','$datePayment', '$encodedBy', '$paymentCounter')";

                    if ($conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                        $informessage = "New record created successfully";
                        if($paymentCount == $paymentCounter){
                            $blPayment = 0;
                            $blLA = "Business Loan:";
                        }

                        $currentPrincipal = 0;
                        $currentInterest = 0;

                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }

                    $paymentCounter++;
                }
            }

            //CLL
            if(substr("$cllLA",0,3) == "CLL" and $cllPayment != 0){
                $cll = 1;

                if($paymentCount > 0){
                    $cllPayment = $cllPayment/$paymentCount;
                    $paymentCounter = 1;
                }else{
                    $paymentCounter = 0;
                }

                while($paymentCount >= $paymentCounter){
                    $sqlLP = "SELECT * FROM  cll_loan_payment_table WHERE loan_application_number = '$cllLA' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  cll_credit_revenue_table WHERE loan_application_number = '$cllLA' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "SELECT * FROM  cll_loan_table WHERE loan_application_number = '$cllLA' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    $currentBalance  = 0;
                    //TotalPayment
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $totalPrincipalPayment = $row['amount'];
                            $currentBalance = $currentBalance + $totalPrincipalPayment;
                        }
                    }
                    //Get Next Interest
                    $counterI = 0;
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            if($row['interest_revenue'] != 0){
                                $lastInterest[$counterI] = $row['interest_revenue'];
                                $counterI++;
                            }
                        }
                    }else{
                        $lastInterest[$counterI] = 0;
                    }
                    //Get loan info
                    if($resultLP2->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP2)) {
                            $loanInterestP = $row['loan_interest'];
                            $paymentTermP =  $row['payment_term'];
                            $loanAmountP = $row['loan_amount'];
                        }
                    }

                    //Connert int
                    $loanInterestP = $loanInterestP/100;
                    $currentPrincipal = 0;
                    $currentInterest = 0;

                    //check term of payment
                    if ($paymentTermP == "Daily") {
                        $loanTermP = $loanTermP * 30;
                        $paymentTerm = 30;
                    }elseif ($paymentTermP == "Semi Monthly") {
                        $loanTermP = $loanTermP * 2;
                        $paymentTerm = 2;
                    }
                    elseif ($paymentTermP == "Monthly") {
                        $loanTermP = $loanTermP * 1;  
                        $paymentTerm = 1;
                    }

                    $currentBalance = $loanAmountP - $currentBalance;

                    //Current Interest Semi . Daily. Monthly
                    $checkInterestP = ($counterI + 1)%2;
                    $checkInterestPI = ($counterI + 1)%30;

                    //Comute Interest
                    if( ($checkInterestP == 0 and $paymentTerm == 2) or ($checkInterestPI != 1 and $counterI!=0 and $paymentTerm == 30) ){
                        $currentInterest = $lastInterest[$counterI-1];
                    }else{
                        $currentInterest = ($currentBalance * $loanInterestP)/$paymentTerm;
                    }

                    $currentInterest = round($currentInterest,2,PHP_ROUND_HALF_ODD);

                    //Compute Principal
                    $currentPrincipal = $cllPayment - $currentInterest;
                    $currentPrincipal = round($currentPrincipal,2,PHP_ROUND_HALF_ODD);

                    $currentBalanceTemp = $currentBalance;

                    //Update Status if Paid
                    if($currentBalanceTemp <= $cllPayment){
                        $sql = "UPDATE cll_loan_table SET
                        loan_status = 'Paid',
                        last_payment = '$datePayment',
                        date_paid = '$datePayment' WHERE id_number = '$idNumber' and loan_application_number = '$cllLA' ";

                        if ($conn->query($sql) === TRUE) {
                            $infomessage = "Record updated successfully";

                            $sqlDP = "UPDATE loan_date_table SET
                            date_paid = '$datePayment';
                            WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberId' ";

                            if ($conn->query($sqlDP) === TRUE) {
                               $infomessage = "Loan Paid";
                            } 
                            else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                            }

                        } 
                        else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }else{
                        $sql = "UPDATE cll_loan_table SET
                        last_payment = '$datePayment' 
                        WHERE id_number = '$idNumber' and loan_application_number = '$cllLA' ";

                        if ($conn->query($sql) === TRUE) {
                            $infomessage = "Record updated successfully";
                        } 
                        else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    $sql = "INSERT INTO cll_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$cllLA','$currentPrincipal','$datePayment', '$encodedBy')";

                    $sql1 = "INSERT INTO cll_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                        VALUES ('$idNumber','$cllLA','$referencenumber','$currentInterest','$datePayment', '$encodedBy')";

                    if ($conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                        $informessage = "New record created successfully";

                        if($paymentCount == $paymentCounter){
                            $cllPayment = 0;
                            $cllLA = "Calamity Loan:";
                        }

                        $currentPrincipal = 0;
                        $currentInterest = 0;

                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }

                    $paymentCounter++;
                }
            }

            //CML
            if(substr("$cmlLA",0,3) == "CML" and $cmlPayment != 0){
                $cml = 1;

                if($paymentCount > 0){
                    $cmlPayment = $cmlPayment/$paymentCount;
                    $paymentCounter = 1;
                }else{
                    $paymentCounter = 0;
                }

                while($paymentCount >= $paymentCounter){
                    $sqlLP = "SELECT * FROM  cml_loan_payment_table WHERE loan_application_number = '$cmlLA' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  cml_credit_revenue_table WHERE loan_application_number = '$cmlLA' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "SELECT * FROM  cml_loan_table WHERE loan_application_number = '$cmlLA' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    $currentBalance  = 0;
                    //TotalPayment
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $totalPrincipalPayment = $row['amount'];
                            $currentBalance = $currentBalance + $totalPrincipalPayment;
                        }
                    }
                    //Get Next Interest
                    $counterI = 0;
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            if($row['interest_revenue'] != 0){
                                $lastInterest[$counterI] = $row['interest_revenue'];
                                $counterI++;
                            }
                        }
                    }else{
                        $lastInterest[$counterI] = 0;
                    }
                    //Get loan info
                    if($resultLP2->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP2)) {
                            $loanInterestP = $row['loan_interest'];
                            $paymentTermP =  $row['payment_term'];
                            $loanAmountP = $row['loan_amount'];
                        }
                    }

                    //Connert int
                    $loanInterestP = $loanInterestP/100;
                    $currentPrincipal = 0;
                    $currentInterest = 0;

                    //check term of payment
                    if ($paymentTermP == "Daily") {
                        $loanTermP = $loanTermP * 30;
                        $paymentTerm = 30;
                    }elseif ($paymentTermP == "Semi Monthly") {
                        $loanTermP = $loanTermP * 2;
                        $paymentTerm = 2;
                    }
                    elseif ($paymentTermP == "Monthly") {
                        $loanTermP = $loanTermP * 1;  
                        $paymentTerm = 1;
                    }

                    $currentBalance = $loanAmountP - $currentBalance;

                    //Current Interest Semi . Daily. Monthly
                    $checkInterestP = ($counterI + 1)%2;
                    $checkInterestPI = ($counterI + 1)%30;

                    //Comute Interest
                    if( ($checkInterestP == 0 and $paymentTerm == 2) or ($checkInterestPI == 0 and $paymentTerm == 30) ){
                        $currentInterest = $lastInterest[$counterI-1];
                    }else{
                        $currentInterest = ($currentBalance * $loanInterestP)/$paymentTerm;
                    }

                    $currentInterest = round($currentInterest,2,PHP_ROUND_HALF_ODD);

                    //Compute Principal
                    $currentPrincipal = $cmlPayment - $currentInterest;
                    $currentPrincipal = round($currentPrincipal,2,PHP_ROUND_HALF_ODD);

                    $currentBalanceTemp = $currentBalance;

                    //Update Status if Paid
                    if($currentBalanceTemp <= $cmlPayment){
                        $sql = "UPDATE cml_loan_table SET
                        loan_status = 'Paid',
                        last_payment = '$datePayment',
                        date_paid = '$datePayment' WHERE id_number = '$idNumber' and loan_application_number = '$cmlLA' ";

                        if ($conn->query($sql) === TRUE) {
                            $infomessage = "Record updated successfully";

                            $sqlDP = "UPDATE loan_date_table SET
                            date_paid = '$datePayment';
                            WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberId' ";

                            if ($conn->query($sqlDP) === TRUE) {
                               $infomessage = "Loan Paid";
                            } 
                            else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                            }

                        } 
                        else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }else{
                        $sql = "UPDATE cml_loan_table SET
                        last_payment = '$datePayment' 
                        WHERE id_number = '$idNumber' and loan_application_number = '$cmlLA' ";

                        if ($conn->query($sql) === TRUE) {
                            $infomessage = "Record updated successfully";
                        } 
                        else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    $sql = "INSERT INTO cml_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by, payment_count) 
                        VALUES ('$idNumber','$referencenumber','$cmlLA','$currentPrincipal','$datePayment', '$encodedBy','$paymentCounter')";

                    $sql1 = "INSERT INTO cml_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by, payment_count) 
                        VALUES ('$idNumber','$cmlLA','$referencenumber','$currentInterest','$datePayment', '$encodedBy', '$paymentCounter')";

                    if ($conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                        $informessage = "New record created successfully";

                        if($paymentCount == $paymentCounter){
                            $cmlPayment = 0;
                            $cmlLA = "Chattel Loan:";
                        }

                        $currentPrincipal = 0;
                        $currentInterest = 0;

                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }

                    $paymentCounter++;
                }
            }

            //EDL
            if(substr("$edlLA",0,3) == "EDL" and $edlPayment != 0){
                $edl = 1;

                if($paymentCount > 0){
                    $rlPayment = $rlPayment/$paymentCount;
                    $paymentCounter = 1;
                }else{
                    $paymentCounter = 0;
                }

                while($paymentCount >= $paymentCounter){
                    $sqlLP = "SELECT * FROM  edl_loan_payment_table WHERE loan_application_number = '$edlLA' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  edl_credit_revenue_table WHERE loan_application_number = '$edlLA' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "SELECT * FROM  edl_loan_table WHERE loan_application_number = '$edlLA' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    $currentBalance  = 0;
                    //TotalPayment
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $totalPrincipalPayment = $row['amount'];
                            $currentBalance = $currentBalance + $totalPrincipalPayment;
                        }
                    }
                    //Get Next Interest
                    $counterI = 0;
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            if($row['interest_revenue'] != 0){
                                $lastInterest[$counterI] = $row['interest_revenue'];
                                $counterI++;
                            }
                        }
                    }else{
                        $lastInterest[$counterI] = 0;
                    }
                    //Get loan info
                    if($resultLP2->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP2)) {
                            $loanInterestP = $row['loan_interest'];
                            $paymentTermP =  $row['payment_term'];
                            $loanAmountP = $row['loan_amount'];
                        }
                    }

                    //Connert int
                    $loanInterestP = $loanInterestP/100;
                    $currentPrincipal = 0;
                    $currentInterest = 0;

                    //check term of payment
                    if ($paymentTermP == "Daily") {
                        $loanTermP = $loanTermP * 30;
                        $paymentTerm = 30;
                    }elseif ($paymentTermP == "Semi Monthly") {
                        $loanTermP = $loanTermP * 2;
                        $paymentTerm = 2;
                    }
                    elseif ($paymentTermP == "Monthly") {
                        $loanTermP = $loanTermP * 1;  
                        $paymentTerm = 1;
                    }

                    $currentBalance = $loanAmountP - $currentBalance;

                    //Current Interest Semi . Daily. Monthly
                    $checkInterestP = ($counterI + 1)%2;
                    $checkInterestPI = ($counterI + 1)%30;
                    //Comute Interest
                    if( ($checkInterestP == 0 and $paymentTerm == 2) or ($checkInterestPI != 1 and $counterI!=0 and $paymentTerm == 30) ){
                        $currentInterest = $lastInterest[$counterI-1];
                    }else{
                        $currentInterest = ($currentBalance * $loanInterestP)/$paymentTerm;
                    }

                    $currentInterest = round($currentInterest,2,PHP_ROUND_HALF_ODD);

                    //Compute Principal
                    $currentPrincipal = $edlPayment - $currentInterest;
                    $currentPrincipal = round($currentPrincipal,2,PHP_ROUND_HALF_ODD);

                    $currentBalanceTemp = $currentBalance;

                    //Update Status if Paid
                    if($currentBalanceTemp <= $edlPayment){
                        $sql = "UPDATE edl_loan_table SET
                        loan_status = 'Paid',
                        last_payment = '$datePayment',
                        date_paid = '$datePayment' WHERE id_number = '$idNumber' and loan_application_number = '$edlLA' ";

                        if ($conn->query($sql) === TRUE) {
                            $infomessage = "Record updated successfully";

                            $sqlDP = "UPDATE loan_date_table SET
                            date_paid = '$datePayment';
                            WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberId' ";

                            if ($conn->query($sqlDP) === TRUE) {
                               $infomessage = "Loan Paid";
                            } 
                            else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                            }

                        } 
                        else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }else{
                        $sql = "UPDATE edl_loan_table SET
                        last_payment = '$datePayment' 
                        WHERE id_number = '$idNumber' and loan_application_number = '$edlLA' ";

                        if ($conn->query($sql) === TRUE) {
                            $infomessage = "Record updated successfully";
                        } 
                        else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    $sql = "INSERT INTO edl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by, payment_count) 
                        VALUES ('$idNumber','$referencenumber','$edlLA','$currentPrincipal','$datePayment', '$encodedBy', '$paymentCounter')";

                    $sql1 = "INSERT INTO edl_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by,payment_count) 
                        VALUES ('$idNumber','$edlLA','$referencenumber','$currentInterest','$datePayment', '$encodedBy','$paymentCounter')";

                    if ($conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                        $informessage = "New record created successfully";
                        //$loanApplicationNumberP = "";
                        //$typeInterestP = "";
                        //$loanInterestP = "";
                        //$loanAmountP = "";
                        if($paymentCount == $paymentCounter){
                            $edlPayment = 0;
                            $edlLA = "Regular Loan:";
                        }

                        $currentPrincipal = 0;
                        $currentPrincipal = 0;

                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }

                    $paymentCounter++;
                }
            }

            //RL
            if(substr("$rlLA",0,2) == "RL" and $rlPayment != 0){
                $rl = 1;

                if($paymentCount > 0){
                    $rlPayment = $rlPayment/$paymentCount;
                    $paymentCounter = 1;
                }else{
                    $paymentCounter = 0;
                }

                while($paymentCount >= $paymentCounter){
                    $sqlLP = "SELECT * FROM  rl_loan_payment_table WHERE loan_application_number = '$rlLA' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  rl_credit_revenue_table WHERE loan_application_number = '$rlLA' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "SELECT * FROM  rl_loan_table WHERE loan_application_number = '$rlLA' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    $currentBalance  = 0;
                    //TotalPayment
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $totalPrincipalPayment = $row['amount'];
                            $currentBalance = $currentBalance + $totalPrincipalPayment;
                        }
                    }
                    //Get Next Interest
                    $counterI = 0;
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            if($row['interest_revenue'] != 0){
                                $lastInterest[$counterI] = $row['interest_revenue'];
                                $counterI++;
                            }
                        }
                    }else{
                        $lastInterest[$counterI] = 0;
                    }
                    //Get loan info
                    if($resultLP2->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP2)) {
                            $loanInterestP = $row['loan_interest'];
                            $paymentTermP =  $row['payment_term'];
                            $loanAmountP = $row['loan_amount'];
                        }
                    }

                    //Connert int
                    $loanInterestP = $loanInterestP/100;
                    $currentPrincipal = 0;
                    $currentInterest = 0;

                    //check term of payment
                    if ($paymentTermP == "Daily") {
                        $loanTermP = $loanTermP * 30;
                        $paymentTerm = 30;
                    }elseif ($paymentTermP == "Semi Monthly") {
                        $loanTermP = $loanTermP * 2;
                        $paymentTerm = 2;
                    }
                    elseif ($paymentTermP == "Monthly") {
                        $loanTermP = $loanTermP * 1;  
                        $paymentTerm = 1;
                    }

                    $currentBalance = $loanAmountP - $currentBalance;

                    //Current Interest Semi . Daily. Monthly
                    $checkInterestP = ($counterI + 1)%2;
                    $checkInterestPI = ($counterI + 1)%30;
                    //Comute Interest
                    if( ($checkInterestP == 0 and $paymentTerm == 2) or ($checkInterestPI != 1 and $counterI!=0 and $paymentTerm == 30) ){
                        $currentInterest = $lastInterest[$counterI-1];
                    }else{
                        $currentInterest = ($currentBalance * $loanInterestP)/$paymentTerm;
                    }

                    $currentInterest = round($currentInterest,2,PHP_ROUND_HALF_ODD);

                    //Compute Principal
                    $currentPrincipal = $rlPayment - $currentInterest;
                    $currentPrincipal = round($currentPrincipal,2,PHP_ROUND_HALF_ODD);

                    $currentBalanceTemp = $currentBalance;

                    //Update Status if Paid
                    if($currentBalanceTemp <= $rlPayment){
                        $sql = "UPDATE rl_loan_table SET
                        loan_status = 'Paid',
                        last_payment = '$datePayment',
                        date_paid = '$datePayment' WHERE id_number = '$idNumber' and loan_application_number = '$rlLA' ";

                        if ($conn->query($sql) === TRUE) {
                            $infomessage = "Record updated successfully";

                            $sqlDP = "UPDATE loan_date_table SET
                            date_paid = '$datePayment';
                            WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberId' ";

                            if ($conn->query($sqlDP) === TRUE) {
                               $infomessage = "Loan Paid";
                            } 
                            else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                            }

                        } 
                        else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }else{
                        $sql = "UPDATE rl_loan_table SET
                        last_payment = '$datePayment' 
                        WHERE id_number = '$idNumber' and loan_application_number = '$rlLA' ";

                        if ($conn->query($sql) === TRUE) {
                            $infomessage = "Record updated successfully";
                        } 
                        else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    $sql = "INSERT INTO rl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by, payment_count) 
                        VALUES ('$idNumber','$referencenumber','$rlLA','$currentPrincipal','$datePayment', '$encodedBy', '$paymentCounter')";

                    $sql1 = "INSERT INTO rl_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by,payment_count) 
                        VALUES ('$idNumber','$rlLA','$referencenumber','$currentInterest','$datePayment', '$encodedBy','$paymentCounter')";

                    if ($conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                        $informessage = "New record created successfully";
                        //$loanApplicationNumberP = "";
                        //$typeInterestP = "";
                        //$loanInterestP = "";
                        //$loanAmountP = "";
                        if($paymentCount == $paymentCounter){
                            $rlPayment = 0;
                            $rlLA = "Regular Loan:";
                        }

                        $currentPrincipal = 0;
                        $currentPrincipal = 0;

                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }

                    $paymentCounter++;
                }
            }

            //PL
            if(substr("$plLA",0,2) == "PL" and ($plPayment != 0 or $pliPayment !=0)){
                $pl = 1;

                if($paymentCount > 0){
                    $plPayment = $plPayment/$paymentCount;
                    $paymentCounter = 1;
                }else{
                    $paymentCounter = 0;
                }

                while($paymentCount >= $paymentCounter){

                    $sqlLP = "SELECT * FROM  pl_loan_payment_table WHERE loan_application_number = '$plLA' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  pl_credit_revenue_table WHERE loan_application_number = '$plLA' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "SELECT * FROM  pl_loan_table WHERE loan_application_number = '$plLA' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    $currentBalance  = 0;
                    //TotalPayment
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $totalPrincipalPayment = $row['amount'];
                            $currentBalance = $currentBalance + $totalPrincipalPayment;
                        }
                    }
                    //Get Next Interest
                    $counterI = 0;
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            if($row['interest_revenue'] != 0){
                                $lastInterest[$counterI] = $row['interest_revenue'];
                                $counterI++;
                            }
                        }
                    }else{
                        $lastInterest[$counterI] = 0;
                    }
                    //Get loan info
                    if($resultLP2->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP2)) {
                            $loanInterestP = $row['loan_interest'];
                            $paymentTermP =  $row['payment_term'];
                            $loanAmountP = $row['loan_amount'];
                            $loanCounter = $row['counter_payment'];
                        }
                    }

                    //Connert int
                    $loanInterestP = $loanInterestP/100;
                    $currentPrincipal = 0;
                    $currentInterest = 0;

                    //check term of payment
                    if ($paymentTermP == "Daily") {
                        $loanTermP = $loanTermP * 30;
                        $paymentTerm = 30;
                    }elseif ($paymentTermP == "Semi Monthly") {
                        $loanTermP = $loanTermP * 2;
                        $paymentTerm = 2;
                    }
                    elseif ($paymentTermP == "Monthly") {
                        $loanTermP = $loanTermP * 1;  
                        $paymentTerm = 1;
                    }

                    $currentBalance = $loanAmountP - $currentBalance;

                    $counterI = $loanCounter + $counterI;
                    //Current Interest Semi . Daily. Monthly
                    $checkInterestP = ($counterI + 1)%2;
                    $checkInterestPI = ($counterI + 1)%30;

                    //Comute Interest
                    if( ($checkInterestP == 0 and $paymentTerm == 2) or ($checkInterestPI != 1 and $counterI!=0 and $paymentTerm == 30) ){
                        $counterI = $counterI - $loanCounter;
                        $currentInterest = $lastInterest[$counterI-1];
                    }else{
                        $currentInterest = ($currentBalance * $loanInterestP)/$paymentTerm;
                    }

                    $currentInterest = round($currentInterest,2,PHP_ROUND_HALF_ODD);

                    //Compute Principal
                    $currentPrincipal = $plPayment - $currentInterest;
                    $currentPrincipal = round($currentPrincipal,2,PHP_ROUND_HALF_ODD);

                    $currentBalanceTemp = $currentBalance;

                    //Update Status if Paid
                    if($currentBalanceTemp <= $plPayment){
                        $sql = "UPDATE pl_loan_table SET
                        loan_status = 'Paid',
                        last_payment = '$datePayment',
                        date_paid = '$datePayment' WHERE id_number = '$idNumber' and loan_application_number = '$plLA' ";

                        if ($conn->query($sql) === TRUE) {
                            $infomessage = "Record updated successfully";

                            $sqlDP = "UPDATE loan_date_table SET
                            date_paid = '$datePayment';
                            WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberId' ";

                            if ($conn->query($sqlDP) === TRUE) {
                               $infomessage = "Loan Paid";
                            } 
                            else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                            }

                        } 
                        else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }else{
                        $sql = "UPDATE pl_loan_table SET
                        last_payment = '$datePayment' 
                        WHERE id_number = '$idNumber' and loan_application_number = '$plLA' ";

                        if ($conn->query($sql) === TRUE) {
                            $infomessage = "Record updated successfully";
                        } 
                        else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                    
                    //For revision if balance updated
                    $sql = "INSERT INTO pl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by, payment_count) 
                        VALUES ('$idNumber','$referencenumber','$plLA','$currentPrincipal','$datePayment', '$encodedBy', '$paymentCounter')";

                    $sql1 = "INSERT INTO pl_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by,payment_count) 
                        VALUES ('$idNumber','$plLA','$referencenumber','$currentInterest','$datePayment', '$encodedBy','$paymentCounter')";

                    if ($conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                        $informessage = "New record created successfully";
                        //$loanApplicationNumberP = "";
                        //$typeInterestP = "";
                        //$loanInterestP = "";
                        //$loanAmountP = "";
                        if($paymentCount == $paymentCounter){
                            $plPayment = 0;
                            $pliPayment = 0;
                            $plLA = "Previous Loan:";
                        }

                        $currentPrincipal = 0;
                        $currentInterest = 0;

                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }

                    $paymentCounter++;

                }
            }

            //CKL
            if(substr("$chklLA",0,3) == "CKL" and $chklPayment != 0){
                $ckl = 1;
                /*$sql = "INSERT INTO ckl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','$chklLA','$chklPayment','$datePayment', '$encodedBy')";
                if ($conn->query($sql)){
                    $informessage = "New record created successfully";
                    $chklPayment = 0;
                    $chklLA = "Check Loan";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }*/
                $sqlLP = "SELECT * FROM  ckl_loan_table WHERE loan_application_number = '$chklLA' ";
                    $resultLP = $conn->query($sqlLP);

                $totalPSL = 0;

                if($resultLP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLP)) {
                        $totalPSL = $row['loan_amount'];
                        //$totalPSL = $totalPSL + $principalAmount;
                    }
                }

                $paymentdiff = 0;
                $paymentdiff = $totalPSL - $chklPayment;
                
                if($paymentdiff <= 0){
                    $sql = "UPDATE ckl_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$datePayment',
                    date_paid = '$datePayment' WHERE id_number = '$idNumber' and loan_application_number = '$chklLA' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";

                        $sqlDP = "UPDATE loan_date_table SET
                        date_paid = '$datePayment';
                        WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberId' ";

                        if ($conn->query($sqlDP) === TRUE) {
                           $infomessage = "Loan Paid";
                        } 
                        else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }else{
                    $sql = "UPDATE ckl_loan_table SET
                    last_payment = '$datePayment' 
                    WHERE id_number = '$idNumber' and loan_application_number = '$chklLA' ";

                    if ($conn->query($sql) === TRUE) {
                        $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                $sql = "INSERT INTO ckl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','$chklLA','$chklPayment','$datePayment', '$encodedBy')";
                if ($conn->query($sql) === TRUE){
                    $informessage = "New record created successfully";
                    $clPayment = 0;
                    $clLA = "Cash Loan";

                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            //CL
            if(substr("$clLA",0,2) == "CL" and $clPayment != 0){
                $cl = 1;

                $sqlLP = "SELECT * FROM  cl_loan_table WHERE loan_application_number = '$clLA' ";
                    $resultLP = $conn->query($sqlLP);

                $totalPSL = 0;

                if($resultLP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLP)) {
                        $totalPSL = $row['loan_amount'];
                        //$totalPSL = $totalPSL + $principalAmount;
                    }
                }

                $paymentdiff = 0;
                $paymentdiff = $totalPSL - $clPayment;
                
                if($paymentdiff <= 0){
                    $sql = "UPDATE cl_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$datePayment',
                    date_paid = '$datePayment' WHERE id_number = '$idNumber' and loan_application_number = '$clLA' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";

                        $sqlDP = "UPDATE loan_date_table SET
                        date_paid = '$datePayment';
                        WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberId' ";

                        if ($conn->query($sqlDP) === TRUE) {
                           $infomessage = "Loan Paid";
                        } 
                        else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }else{
                    $sql = "UPDATE cl_loan_table SET
                    last_payment = '$datePayment' 
                    WHERE id_number = '$idNumber' and loan_application_number = '$clLA' ";

                    if ($conn->query($sql) === TRUE) {
                        $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                $sql = "INSERT INTO cl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','$clLA','$clPayment','$datePayment', '$encodedBy')";
                if ($conn->query($sql) === TRUE){
                    $informessage = "New record created successfully";
                    $clPayment = 0;
                    $clLA = "Cash Loan";

                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            //EML
            if(substr("$emlLA",0,3) == "EML" and $emlPayment != 0){
                $eml = 1;

                //get initial credit
                $sqlLP = "SELECT * FROM  eml_loan_table WHERE loan_application_number = '$emlLA' ";
                    $resultLP = $conn->query($sqlLP);

                $totalPSL = 0;

                if($resultLP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLP)) {
                        $totalPSL = $row['loan_amount'];
                        //$totalPSL = $totalPSL + $principalAmount;
                    }
                }

                $paymentdiff = 0;
                $paymentdiff = $totalPSL - $emlPayment;
                
                if($paymentdiff <= 0){
                    $sql = "UPDATE eml_loan_table SET
                    last_payment = '$datePayment',
                    date_paid = '$datePayment' WHERE id_number = '$idNumber' and loan_application_number = '$emlLA' ";

                    if ($conn->query($sql) === TRUE) {
                        $infomessage = "Record updated successfully";

                        $sqlDP = "UPDATE loan_date_table SET
                        date_paid = '$datePayment';
                        WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberId' ";

                        if ($conn->query($sqlDP) === TRUE) {
                           $infomessage = "Loan Paid";
                        } 
                        else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                if($paymentdiff <= 0){
                    $sql = "UPDATE eml_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$datePayment',
                    date_paid = '$datePayment' WHERE id_number = '$idNumber' and loan_application_number = '$emlLA' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";

                        $sqlDP = "UPDATE loan_date_table SET
                        date_paid = '$datePayment';
                        WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberId' ";

                        if ($conn->query($sqlDP) === TRUE) {
                           $infomessage = "Loan Paid";
                        } 
                        else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }else{
                    $sql = "UPDATE eml_loan_table SET
                    last_payment = '$datePayment' 
                    WHERE id_number = '$idNumber' and loan_application_number = '$emlLA' ";

                    if ($conn->query($sql) === TRUE) {
                        $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                $sql = "INSERT INTO eml_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','$emlLA','$emlPayment','$datePayment', '$encodedBy')";
                if ($conn->query($sql) === TRUE){
                    $informessage = "New record created successfully";
                    $emlPayment = 0;
                    $emlLA = "Emergency Loan";

                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            //SL
            if(substr("$slLA",0,2) == "SL" and $slPayment != 0){
                $sl = 1;

                //get initial credit
                $sqlLP = "SELECT * FROM  sl_loan_table WHERE loan_application_number = '$slLA' ";
                    $resultLP = $conn->query($sqlLP);

                $totalPSL = 0;

                if($resultLP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLP)) {
                        $totalPSL = $row['loan_amount'];
                        //$totalPSL = $totalPSL + $principalAmount;
                    }
                }

                $paymentdiff = 0;
                $paymentdiff = $totalPSL - $slPayment;

                if($paymentdiff <= 0){
                    $sql = "UPDATE sl_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$datePayment',
                    date_paid = '$datePayment' WHERE id_number = '$idNumber' and loan_application_number = '$slLA' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";

                        $sqlDP = "UPDATE loan_date_table SET
                        date_paid = '$datePayment';
                        WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberId' ";

                        if ($conn->query($sqlDP) === TRUE) {
                           $infomessage = "Loan Paid";
                        } 
                        else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }else{
                    $sql = "UPDATE sl_loan_table SET
                    last_payment = '$datePayment' 
                    WHERE id_number = '$idNumber' and loan_application_number = '$slLA' ";

                    if ($conn->query($sql) === TRUE) {
                        $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }


                $sql = "INSERT INTO sl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','$slLA','$slPayment','$datePayment', '$encodedBy')";

                if ($conn->query($sql) === TRUE){
                    $informessage = "New record created successfully";
                    $slPayment = 0;
                    $slLA = "Special Loan";

                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            //RCL LOAN
            if(substr("$rclLA",0,3) == "RCL" and ($rclPayment != 0 or $rclPPayment != 0)){

                $rcl = 1;

                //get initial credit
                $sqlLP = "SELECT * FROM  rice_loan_table WHERE loan_application_number = '$rclLA' ";
                    $resultLP = $conn->query($sqlLP);

                if($resultLP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLP)) {
                        $principalAmount = $row['loan_amount'];
                        $interestAmount = $row['loan_interest'];
                    }
                }

                //Get total interest paid
                $sqlLP = "SELECT * FROM  rice_credit_revenue_table WHERE loan_application_number = '$rclLA' ";
                    $resultLP = $conn->query($sqlLP);

                $totalRInterest = 0;
                if($resultLP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLP)) {
                        $totalRInterest = $totalRInterest + $row['interest_revenue'];
                    }
                }

                //Get total principal paid
                $sqlLP = "SELECT * FROM  rice_loan_payment_table WHERE loan_application_number = '$rclLA' ";
                    $resultLP = $conn->query($sqlLP);

                $totalRPrincipal = 0;
                if($resultLP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLP)) {
                        $totalRPrincipal = $totalRPrincipal + $row['amount'];
                    }
                }

                $totalRPrincipal = $totalRPrincipal + $rclPayment;
                $totalRInterest = $totalRInterest + $rclPPayment;

                $diffPrincipal = $principalAmount-$totalRPrincipal;
                $diffInterest = $interestAmount-$totalRInterest;

                if( $diffPrincipal <= 0 and $diffInterest <= 0){
                    $sql = "UPDATE rice_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$datePayment',
                    date_paid = '$datePayment' WHERE id_number = '$idNumber' and loan_application_number = '$rclLA' ";

                    if ($conn->query($sql) === TRUE) {
                        $infomessage = "Record updated successfully";

                        $sqlDP = "UPDATE loan_date_table SET
                        date_paid = '$datePayment';
                        WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberId' ";

                        if ($conn->query($sqlDP) === TRUE) {
                           $infomessage = "Loan Paid";
                        } 
                        else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }else{
                    $sql = "UPDATE rice_loan_table SET
                    last_payment = '$datePayment' 
                    WHERE id_number = '$idNumber' and loan_application_number = '$rclLA' ";

                    if ($conn->query($sql) === TRUE) {
                        $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                //Principal Interest
                if($rclPayment != 0 or $rclPPayment != 0){
                    $sqlRL1 = "INSERT INTO rice_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','$rclLA','$rclPayment','$datePayment', '$encodedBy')";

                    if ($conn->query($sqlRL1) === TRUE){
                        $informessage = "New record created successfully";
                        $rclPayment = 0;
                        
                        //$invoiceNumberP = "";
                        $quantity = "";
                    }else{
                        echo "Error: " . $sqlRL1 . "<br>" . $conn->error;
                    }

                    $sqlRL = "INSERT INTO rice_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                    VALUES ('$idNumber','$rclLA','$referencenumber','$rclPPayment','$datePayment', '$encodedBy')";

                    if ($conn->query($sqlRL) === TRUE){
                        $informessage = "New record created successfully";
                        $rclPPayment = 0;
                        $rclLA = "Rice Loan (P)";

                    }else{
                        echo "Error: " . $sqlRL . "<br>" . $conn->error;
                    }
                }
            }


            //SAVINGS/ADD TIME DEP
            if($savingsDeposit != 0){
                $sd = 1;

                if($withdrawSavings == ""){
                    $withdrawSavings = "Deposit";
                }

                $sql5 = "INSERT INTO savings_table(id_number, type_transaction, type_savings,reference_number,amount, date_transaction, encoded_by) 
                    VALUES ('$idNumber','$withdrawSavings','S1','$referencenumber','$savingsDeposit','$datePayment','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $savingsDeposit = 0;
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $savingsDeposit = 0;
            }

            //TIME DEPOSIT
            if($timeDeposit != 0){
                $td = 1;

                if($withdrawTimeDeposit == ""){
                    $withdrawTimeDeposit = "Deposit";
                }

                $sql5 = "INSERT INTO time_deposit_table(id_number, type_transaction, type_savings, reference_number, amount, term, interest_rate, date_transaction, encoded_by) 
                    VALUES ('$idNumber', '$withdrawTimeDeposit', '$depositReference', '$referencenumber', '$timeDeposit', $depositTerm, $depositInterest, '$datePayment', '$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $timeDeposit = 0;
                   $depositReference = "";
                   $depositInterest = "";
                   $depositTerm = "";
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $timeDeposit = 0;
            }

            //FIXED DEPOSIT
            if($fixedDeposit != 0){
                $fd = 1;

                if($withdrawFixedDeposit == ""){
                    $withdrawFixedDeposit = "Deposit";
                }

                $sql5 = "INSERT INTO fixed_deposit_table(id_number, type_transaction, type_savings, reference_number, amount, term, interest_rate, date_transaction, encoded_by) 
                    VALUES ('$idNumber', '$withdrawFixedDeposit', '$depositReference', '$referencenumber', '$fixedDeposit', '0', $depositInterest, '$datePayment', '$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $fixedDeposit = 0;
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $fixedDeposit = 0;
            }
            
            //CBU/SC
            if($cbuDeposit != 0 or $scfPayment !=0){
                $sc = 1;
                if($withdrawShareCapital == ""){
                    if($CBURecruit != "" ){
                        $withdrawShareCapital = "Recruit";
                    }else{
                        $withdrawShareCapital = "CBU";
                    }
                }
                    
                //SC
                if($scfPayment != 0){
                    $sql4 = "INSERT INTO share_capital_table(id_number, type_transaction,reference_number,amount, date_transaction, encoded_by) 
                        VALUES ('$idNumber','SCF','$referencenumber','$scfPayment','$datePayment','$encodedBy')";

                    if ($conn->query($sql4) === TRUE) {
                       $infomessage = "Record updated successfully";
                       
                       $scfPayment = 0;
                       //$idNumber = "";
                       //$referencenumber = "";
                       //$datePayment = ""; 

                       //$accountNumber = "";
                       //$firstName = "";
                       //$middleName = "";
                       //$lastName = "";
                    } 
                    else { 
                          echo "Error: " . $sql4 . "<br>" . $conn->error;
                    }
                }else{
                    $scfPayment = 0;
                }
                //CBU
                if($cbuDeposit != 0){
                    $sql4 = "INSERT INTO share_capital_table(id_number, type_transaction,reference_number,amount, date_transaction, encoded_by) 
                        VALUES ('$idNumber','$withdrawShareCapital','$referencenumber','$cbuDeposit','$datePayment','1')";

                    if ($conn->query($sql4) === TRUE) {
                       $infomessage = "Record updated successfully";
                       
                       $cbuDeposit = 0;
                       //$idNumber = "";
                       //$referencenumber = "";
                       //$datePayment = ""; 

                       //$accountNumber = "";
                       //$firstName = "";
                       //$middleName = "";
                       //$lastName = "";
                    } 
                    else { 
                          echo "Error: " . $sql4 . "<br>" . $conn->error;
                    }
                }else{
                    $cbuDeposit = 0;
                }
            }

            //RICE CASH PAYMENT
            if($loanApplicationNumberP == "" and  $rcfPayment != 0){
                $rcc = 1;
                $sql = "INSERT INTO rice_cash_revenue_table(id_number, invoice_number , or_number,quantity, principal_amount,interest_amount, date_transaction,encoded_by) 
                    VALUES ('$idNumber','$invoiceNumber' , '$referencenumber' ,'$quantityCash','$rcfPayment', $rcfPaymentI,'$datePayment', '$encodedBy')";
                if ($conn->query($sql) === TRUE) {
                   $infomessage = "Record updated successfully";
                   
                   $rcfPayment = 0;
                   $rcfPaymentI = 0;
                   //$invoiceNumber = "";
                   $quantityCash = 0;
                } 
                else { 
                      echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }else{
                $rcfPayment = 0;
                $rcfPaymentI = 0;
            }

            //Membership
            if($mbfPayment != 0){
                $oi = 1;
                $sql5 = "INSERT INTO other_income_table(id_number, or_number, income_code,amount,date_transaction, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','mbsi','$mbfPayment','$datePayment','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $mbfPayment = 0;
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $mbfPayment = 0;
            }

            //Miscellaneous
            if($msfPayment != 0){
                $oi = 1;
                $sql5 = "INSERT INTO other_income_table(id_number, or_number, income_code,amount,date_transaction, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','msli','$msfPayment','$datePayment','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $msfPayment = 0;
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $msfPayment = 0;
            }
            //Penalty loan
            if($plfPayment != 0){
                $oi = 1;
                $sql5 = "INSERT INTO other_income_table(id_number, or_number, income_code,amount,date_transaction, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','plti','$plfPayment','$datePayment','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $plfPayment = 0;
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $plfPayment = 0;
            }

            //Penalty rice
            if($pnfPayment != 0){
                $oi = 1;
                $sql5 = "INSERT INTO other_income_table(id_number, or_number, income_code,amount,date_transaction, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','pnti','$pnfPayment','$datePayment','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $pnfPayment = 0;
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $pnfPayment = 0;
            }

            //Photocopy
            if($ptfPayment != 0){
                $oi = 1;
                $sql5 = "INSERT INTO other_income_table(id_number, or_number, income_code,amount,date_transaction, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','ptci','$ptfPayment','$datePayment','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $ptfPayment = 0;
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $ptfPayment = 0;
            }

            //Rent income
            if($rifPayment != 0){
                $oi = 1;
                $sql5 = "INSERT INTO other_income_table(id_number, or_number, income_code,amount,date_transaction, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','rnti','$rifPayment','$datePayment','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $rifPayment = 0;
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $rifPayment = 0;
            }

            //Rent Receivable
            if($rrfPayment != 0){
                $oi = 1;
                $sql5 = "INSERT INTO other_income_table(id_number, or_number, income_code,amount,date_transaction, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','rntr','$rrfPayment','$datePayment','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $rrfPayment = 0;
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $rrfPayment = 0;
            }

            //Transfer Fee
            if($tffPayement != 0){
                $oi = 1;
                $sql5 = "INSERT INTO other_income_table(id_number, or_number, income_code,amount,date_transaction, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','tffi','$tffPayement','$datePayment','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $tffPayement = 0;
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $tffPayement = 0;
            }

            //Other
            if($infPayment != 0){
                $oi = 1;
                $sql5 = "INSERT INTO other_income_table(id_number, or_number, income_code,amount,date_transaction, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','insi','$infPayment','$datePayment','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $infPayment = 0;
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $infPayment = 0;
            }

            if($rbfPayment != 0){
                $oi = 1;
                $sql5 = "INSERT INTO other_income_table(id_number, or_number, income_code,amount,date_transaction, encoded_by) 
                    VALUES ('$idNumber','$referencenumber','oifi','$rbfPayment','$datePayment','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $rbfPayment = 0;
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $rbfPayment = 0;
            }

            if($totalPayment != 0){
                if($withdrawSavings != "Withdraw" and $withdrawShareCapital != "Withdraw" and $withdrawTimeDeposit != "Withdraw" and $withdrawFixedDeposit != "Withdraw"){

                    $invoiceNumberContainer = "";

                    if($invoiceNumber != "" and $invoiceNumberP != ""){
                        $invoiceNumberContainer = $invoiceNumber . " " . $invoiceNumberP;
                    }elseif($invoiceNumber != ""){
                        $invoiceNumberContainer = $invoiceNumber;
                    }elseif($invoiceNumberP != ""){
                        $invoiceNumberContainer = $invoiceNumberP;
                    }else{
                        $invoiceNumberContainer = "";
                    }

                    if(($paymentCount == 0 or $paymentCount == "") and $invoiceNumber == "" and $invoiceNumberP == ""){
                        $invoiceNumberContainer = 0;
                    }elseif($paymentCount == 0 and $invoiceNumber != ""){
                        $invoiceNumberContainer = $invoiceNumber;
                    }elseif($paymentCount == 0 and $invoiceNumberP != ""){
                        $invoiceNumberContainer = $invoiceNumberP;
                    }else{
                        $invoiceNumberContainer = $paymentCount;
                    }

                    if($paymentCount == 0 or $paymentCount == ""){
                        $sql5 = "INSERT INTO cashier_report_table( id_number ,or_number, invoice_number,total_amount, bl, cll, cml, edl, rl, pl, cl, ckl, eml, sl, rcl, rcc, oi, sc, sd, td, fd ,date_transaction, encoded_by, or_status, payment_type) 
                            VALUES ('$idNumber', '$referencenumber', '$invoiceNumberContainer' ,'$totalPayment', '$bl', '$cll','$cml','$edl','$rl','$pl','$cl','$ckl','$eml','$sl','$rcl','$rcc','$oi','$sc','$sd','$td','$fd','$datePayment','$encodedBy', '1', '$typePaymentCCHK')";

                        if ($conn->query($sql5) === TRUE) {
                            $infomessage = "Record updated successfully";
                            $totalPayment = 0;

                            $bl = 0;
                            $cll = 0;
                            $cml = 0;
                            $edl = 0;
                            $rl = 0;
                            $pl = 0;
                            $cl = 0;
                            $ckl = 0;
                            $eml = 0;
                            $sl = 0;
                            $rcl = 0;
                            $rcc = 0;
                            $oi = 0;
                            $sc = 0;
                            $sd = 0;
                            $td = 0;
                            $fd = 0;
                            $totalPayment = 0;

                            $invoiceNumber = "";
                            $invoiceNumberP = "";
                            $invoiceNumberContainer = "";
                            $paymentCount = 0;
                        } 
                        else { 
                            echo "Error: " . $sql5 . "<br>" . $conn->error;
                        }
                    }else{
                        $totalPayment = $totalPayment/$paymentCount;
                        $paymentCounterContainer = 1;
                        while($paymentCount >= 1){
                            $sql5 = "INSERT INTO cashier_report_table( id_number ,or_number, invoice_number,total_amount, bl, cll, cml, edl, rl, pl, cl, ckl, eml, sl, rcl, rcc, oi, sc, sd, td, fd ,date_transaction, encoded_by, or_status, payment_type) 
                                VALUES ('$idNumber', '$referencenumber', '$paymentCounterContainer' ,'$totalPayment', '$bl', '$cll','$cml','$edl','$rl','$pl','$cl','$ckl','$eml','$sl','$rcl','$rcc','$oi','$sc','$sd','$td','$fd','$datePayment','$encodedBy', '1', '$typePaymentCCHK')";

                            if ($conn->query($sql5) === TRUE) {

                                if($paymentCount == 1){
                                    $infomessage = "Record updated successfully";
                                    $totalPayment = 0;

                                    $bl = 0;
                                    $cll = 0;
                                    $cml = 0;
                                    $edl = 0;
                                    $rl = 0;
                                    $pl = 0;
                                    $cl = 0;
                                    $ckl = 0;
                                    $eml = 0;
                                    $sl = 0;
                                    $rcl = 0;
                                    $rcc = 0;
                                    $oi = 0;
                                    $sc = 0;
                                    $sd = 0;
                                    $td = 0;
                                    $fd = 0;
                                    $totalPayment = 0;

                                    $invoiceNumber = "";
                                    $invoiceNumberP = "";
                                    $paymentCounterContainer = "";
                                    $paymentCount = 0;
                                }
                            } 
                            else { 
                                echo "Error: " . $sql5 . "<br>" . $conn->error;
                            }
                            $paymentCount--;
                            $paymentCounterContainer++;
                        }
                    }
                }else{
                    $sql5 = "INSERT INTO cashier_withdraw_table( id_number ,or_number, total_amount, sdw, tdw, fdw, cbuw,date_transaction, encoded_by, or_status,payment_type) 
                        VALUES ('$idNumber', '$referencenumber','$totalPayment', '$sd', '$td','$fd','$sc','$datePayment','$encodedBy', '1', '$typePaymentCCHK')";

                    if ($conn->query($sql5) === TRUE) {
                        $infomessage = "Record updated successfully";
                        $totalPayment = 0;

                        $sdw = 0;
                        $tdw = 0;
                        $fdw = 0;
                        $cbuw = 0;
                        $totalPayment = 0;
                    } 
                    else { 
                        echo "Error: " . $sql5 . "<br>" . $conn->error;
                    }
                }
            }else{
                $totalPayment = 0;
            }

            $sqlOR = "SELECT * FROM `cashier_report_table` WHERE or_number=(SELECT MAX(or_number) FROM `cashier_report_table`)";
            $resultOR = $conn->query($sqlOR);

            if($resultOR->num_rows > 0){
                //echo "string";
                while ($row = mysqli_fetch_array($resultOR)) {
                    # code...
                    $referencenumber = $row['or_number'] + 1;

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
    <title>Payment</title>

    <script>
    //i = 0;
    $(document).ready(function(){
        $("#rcqv").keyup(function(){

            var riceIA = 0;
            riceIA = Number($("#rcqv").val()) * Number(40);

            $("#rcia").val(riceIA);
        });

        $(".famount").keyup(function(){

            var totalC = 0;
            $('.famount').each(function() {
                totalC += Number($(this).val());
            });

            //var totalR = 0;
            //totalR = Number($("#la").val()) - Number(totalC);

            $("#totalP").val(totalC);
            //$("#tarelease").val(totalR);
        });
    });
    </script>
</head>

<body>
<div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php //include 'topbar.php';?>
        <!--member account info-->
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-12" style="margin-top:50px;margin-left: 16.7%;margin-bottom: 100px; position: absolute;width: 80%">
                <div class="row">
                    <div class="col-lg-12" style="background-color:#fff; padding: 5px; margin: 5px; border: solid gray 1px">
                        <h6>Search Member</h6>

                        <label style="width: 75px">Search</label>
                        <input type="text" value = "<?php echo $idNumberSearch;?>" name = "idNumberSearch" style="border:none;border-bottom: 2px solid red;">
                        
                        <label style="width: 75px"></label>
                        <input type="text" value = "<?php echo $idNumber;?>" name = "idNumber" readonly style = "width: 100px;border:none;font-size: 20px;" placeholder = "ID Number">
                        <input type="text" placeholder="First Name" value = "<?php echo $firstName;?>" readonly style = "width: 120px;border:none;font-size: 20px;">
                        <input type="text" placeholder="Middle Name" value = "<?php echo $middleName;?>" readonly style = "width: 120px;border:none;font-size: 20px;">
                        <input type="text" placeholder="Last Name" value = "<?php echo $lastName;?>" readonly style = "width: 120px;border:none;font-size: 20px;">

                        <br>
                        <label style="width: 75px"></label>
                        <button style="width: 190px" class="btn btn-outline-success my-2 my-sm-0" name = "searchMember" value = "searchMember" type="submit">Search</button>
                    </div>

                    <br>
                    <div class="col-lg-12">
                        <p align="center"><span style="color: red"><?php echo $infomessage;?></span></p>
                    <br>
                    </div>

                    <div class="col-lg-2.5" style="background-color:#fff; padding: 2.5px; margin: 2.5px">
                        <h6>Payment Transaction</h6>
                        <br>
                        <label style="width: 120px">Type of Payment</label>
                        <select style="width: 160px;border: none;border-bottom: 2px solid red;font-size: 20px;" name = "typePaymentCCHK">
                          <option value="0" <?php if($typePaymentCCHK == "0") echo "selected"; ?>>Cash</option>
                          <option value="1" <?php if($typePaymentCCHK == "1") echo "selected"; ?>>Checque</option>
                        </select><br><br>
                        <label style="width: 120px">Payment</label>
                        <select onchange ="viewAmount()" style="width: 160px;border: none;border-bottom: 2px solid red;font-size: 20px;" id="top" name = "typePayment">
                          <option value="" <?php if($otherIncome == "") echo "selected"; ?>>Select</option>
                            <?php 
                                if($idNumber != "" or $loanApplicationNumberId != ""){
                                    $counterh = 0;
                                    while($counterh < $numRow) {
                                        echo "<option value=". $loanApplicationNumber[$counterh] . ">"  . "$loanApplicationNumber[$counterh]" . " </option> ";
                                        $counterh ++;
                                    }
                                }
                            ?>
                          <option value="cbui" <?php if($otherIncome == "cbui") echo "selected"; ?>>Capital Build Up</option>
                          <option value="fxdi" <?php if($otherIncome == "fxdi") echo "selected"; ?>>Fixed Deposit</option>
                          <option value="insi" <?php if($otherIncome == "insi") echo "selected"; ?>>Loan Insurance</option>
                          <!--<option value="pli" <?php if($otherIncome == "pli") echo "selected"; ?>>Loan Interest</option>-->
                          <option value="mbsi" <?php if($otherIncome == "mbsi") echo "selected"; ?>>Membership</option>
                          <option value="msli" <?php if($otherIncome == "msli") echo "selected"; ?>>Miscellaneous</option>
                          <option value="plti" <?php if($otherIncome == "plti") echo "selected"; ?>>Penalty (Loan)</option>
                          <option value="pnti" <?php if($otherIncome == "pnti") echo "selected"; ?>>Penalty (Rice)</option>
                          <option value="ptci" <?php if($otherIncome == "ptci") echo "selected"; ?>>Photocopy</option>
                          <option value="rnti" <?php if($otherIncome == "rnti") echo "selected"; ?>>Rental Income</option>
                          <option value="rntr" <?php if($otherIncome == "rntr") echo "selected"; ?>>Rental Receivables</option>
                          <option value="rcpi" <?php if($otherIncome == "rcpi") echo "selected"; ?>>Rice Cash</option>
                          <!--<option value="rcii" <?php if($otherIncome == "rcii") echo "selected"; ?>>Rice Cash (Interest)</option>-->
                          <!--<option value="rlli" <?php if($otherIncome == "rlli") echo "selected"; ?>>Rice Loan (Interest)</option>-->
                          <option value="svdi" <?php if($otherIncome == "svdi") echo "selected"; ?>>Savings</option>
                          <option value="ssci" <?php if($otherIncome == "ssci") echo "selected"; ?>>Subscribe Share Capital</option>
                          <option value="tmdp" <?php if($otherIncome == "tmdp") echo "selected"; ?>>Time Deposit</option>
                          <option value="tffi" <?php if($otherIncome == "tffi") echo "selected"; ?>>Transfer Fee</option>
                          <option value="othi" <?php if($otherIncome == "othi") echo "selected"; ?>>Others</option>
                        </select><br><br>
                        <label style="width: 120px">Date</label>
                        <input style="width: 160px;border: none;border-bottom: 2px solid red;font-size: 20px;" id = "dvv" type="date" value = "<?php echo $datePayment;?>" name = "datePayment"><br><br>

                        <label style="width: 120px">OR number</label>
                        <input style="width: 160px;border: none;border-bottom: 2px solid red;font-size: 20px;" id = "orvv" type="text" value = "<?php echo $referencenumber;?>" name = "referencenumber"><br><br>
                    </div>

                    <div class="col-lg-2.5" style="background-color:#fff; padding: 2.5px; margin: 2.5px">
                        <h6>Rice Trading</h6>
                        <br>

                        <h6>Rice Cash</h6>
                        <label style="width: 120px">Invoice Number</label>  
                        <input style="width: 75px" id = "inva" type="text" value = "<?php echo $invoiceNumber;?>" name="invoiceNumber" readonly><br>
                        <label style="width: 120px">Quantity</label>  
                        <input style="width: 75px" id = "rcqva" type="text" value = "<?php echo $quantityCash;?>" name="quantityCash" readonly><br>
                        <label style="width: 120px">Rice (Principal)</label>  
                        <input style="width: 75px" class = 'famount' id = "rcfp" type="text" value = "<?php echo number_format($rcfPayment,'2','.','');?>" name="rcfPayment" readonly><br>
                        <label style="width: 120px">Rice (Interest)</label>  
                        <input style="width: 75px" class = 'famount' id = "rcfi" type="text" value = "<?php echo number_format($rcfPaymentI,'2','.','');?>" name="rcfPaymentI" readonly>

                        <br>
                        
                        <h6>Rice Loan</h6>
                        <label style="width: 120px">Invoice Number</label> 
                        <input style="width: 75px" value = "<?php echo $invoiceNumberP;?>" name = "invoiceNumberP" readonly><br>
                        <input style="width: 120px" type="text" value = "Quantity" name="Quantity" readonly>
                        <input style="width: 75px" value = "<?php echo $quantity;?>" name = "quantity" readonly><br>
                        <input style="width: 120px" id = "rclpl" type="text" value = "<?php echo $rclLA;?>" name="rclLA" readonly>  
                        <input style="width: 75px" class = 'famount' id = "rclp" type="text" value = "<?php echo number_format($rclPayment,'2','.','');?>" name="rclPayment"><br>
                        <input style="width: 120px" id = "rclil" type="text" value = "<?php echo $rclPLA;?>" name="rclPLA" readonly>  
                        <input style="width: 75px" class = 'famount' id = "rcli" type="text" value = "<?php echo number_format($rclPPayment,'2','.','');?>" name="rclPPayment"><br><br>

                        <h6>Rice Penalty</h6>
                        <label style="width: 120px">Penalty Rice:</label>  
                        <input style="width: 75px" id = "pnf" type="text" value = "<?php echo number_format($pnfPayment,'2','.','');?>" name="pnfPayment" class = 'famount' readonly><br>
                    </div>

                    <div class="col-lg-2.5" style="background-color:#fff; padding: 2.5px; margin: 2.5px">
                        <h6>Loan Payment</h6>
                        <br>
                        <label style="width: 120px">Payment Count</label>  
                        <input style="width: 75px" id = "lpc" type="text" value = "<?php echo $paymentCount; ?>" name="paymentCount" readonly><br>
                        <input style="width: 120px" id = "bll" type="text" value = "<?php echo $blLA;?>" name="blLA" readonly> 
                        <input style="width: 75px" id = "bl" type="text" value = "<?php echo number_format($blPayment,'2','.','');?>" name="blPayment" class = 'famount' readonly><br>

                        <input style="width: 120px" id = "clll" type="text" value = "<?php echo $cllLA;?>" name="cllLA" readonly>
                        <input style="width: 75px" id = "cll" type="text" value = "<?php echo number_format($cllPayment,'2','.','');?>" name="cllPayment" class = 'famount' readonly><br>

                        <input style="width: 120px" id = "cls" type="text" value = "<?php echo $clLA;?>" name="clLA" readonly>  
                        <input style="width: 75px" id = "cl" type="text" value = "<?php echo number_format($clPayment,'2','.','');?>" name="clPayment" class = 'famount' readonly><br>

                        <input style="width: 120px" id = "cmll" type="text" value = "<?php echo $cmlLA;?>" name="cmlLA" readonly>
                        <input style="width: 75px" id = "cml" type="text" value = "<?php echo number_format($cmlPayment,'2','.','');?>" name="cmlPayment" class = 'famount' readonly><br>

                        <input style="width: 120px" id = "chkll" type="text" value = "<?php echo $chklLA;?>" name="chklLA" readonly> 
                        <input style="width: 75px" id = "chkl" type="text" value = "<?php echo number_format($chklPayment,'2','.','');?>" name="chklPayment" class = 'famount' readonly><br>

                        <input style="width: 120px" id = "edll" type="text" value = "<?php echo $edlLA;?>" name="edlLA" readonly>  
                        <input style="width: 75px" id = "edl" type="text" value = "<?php echo number_format($edlPayment,'2','.','');?>" name="edlPayment" class = 'famount' readonly><br>
                        <input style="width: 120px" id = "emll" type="text" value = "<?php echo $emlLA;?>" name="emlLA" readonly>  
                        <input style="width: 75px" id = "eml" type="text" value = "<?php echo number_format($emlPayment,'2','.','');?>" name="emlPayment" class = 'famount' readonly><br>
                        <input style="width: 120px" id = "sll" type="text" value = "<?php echo $slLA;?>" name="slLA" readonly>
                        <input style="width: 75px" id = "sl" type="text" value = "<?php echo number_format($slPayment,'2','.','');?>" name="slPayment" class = 'famount' readonly><br>
                        <input style="width: 120px" id = "rll" type="text" value = "<?php echo $rlLA?>" name="rlLA" readonly>   
                        <input style="width: 75px" id = "rl" type="text" value = "<?php echo number_format($rlPayment,'2','.','');?>" name="rlPayment" class = 'famount' readonly><br>
                        <input style="width: 120px" id = "pll" type="text" value = "<?php echo $plLA;?>" name="plLA" readonly>   
                        <input style="width: 75px" id = "pl" type="text" value = "<?php echo number_format($plPayment,'2','.','');?>" name="plPayment" class = 'famount' readonly><br>
                        <input style="width: 120px" id = "plil" type="text" value = "Previous Loan (I)" name="pliLA" readonly>   
                        <input style="width: 75px" id = "plif" type="text" value = "<?php echo number_format($pliPayment,'2','.','');?>" name="pliPayment" class = 'famount' readonly><br><br>

                        <h6>Loan Penalty</h6>
                        <label style="width: 120px">Penalty Loan:</label>  
                        <input style="width: 75px" id = "plf" type="text" value = "<?php echo number_format($plfPayment,'2','.','');?>" name="plfPayment" class = 'famount' readonly><br>
                    </div>

                    <div class="col-lg-2.5" style="background-color:#fff; padding: 2.5px; margin: 2.5px">
                        <h6>Deposits</h6>
                        <br>
                        <label style="width: 120px">Subscribe Capital:</label>   
                        <input style="width: 75px" id = "scf" type="text" value = "<?php echo number_format($scfPayment,'2','.','');?>" name="scfPayment" class = 'famount' readonly><br>
                        <label style="width: 120px">Capital Build Up:</label>  
                        <input style="width: 75px" id = "cbu" type="text" value = "<?php echo number_format($cbuDeposit,'2','.','');?>" name="cbuDeposit" class = 'famount' readonly>
                        <label> R </label>
                        <input id="rct" type="checkbox" value = "Recruit" name = "CBURecruit">
                        <label> W </label>
                        <input id="wsc" type="checkbox" value = "Withdraw" name = "withdrawShareCapital"><br>

                        <label style="width: 120px">Savings:</label>  
                        <input style="width: 75px" id = "sdf" type="text" value = "<?php echo number_format($savingsDeposit,'2','.','');?>" name="savingsDeposit" class = 'famount' readonly>
                        <label> W </label>
                        <input id = "wsd" type="checkbox" value = "Withdraw" name = "withdrawSavings"><br>
                        <label style="width: 120px">Time Deposit:</label>  
                        <input style="width: 75px" id = "tdp" type="text" value = "<?php echo number_format($timeDeposit,'2','.','');?>" name="timeDeposit" class = 'famount' readonly>
                        <label> W </label>
                        <input id = "wtd" type="checkbox" value = "Withdraw" name = "withdrawTimeDeposit"><br>
                        <!--FD-->
                        <label style="width: 120px">Fixed Deposit:</label>  
                        <input style="width: 75px" id = "fdp" type="text" value = "<?php echo number_format($fixedDeposit,'2','.','');?>" name="fixedDeposit" class = 'famount' readonly>
                        <label> W </label>

                        <input id = "wfd" type="checkbox" value = "Withdraw" name = "withdrawFixedDeposit"><br>
                        <label style="width: 120px">Deposit Reference:</label>  
                        <input style="width: 75px" id = "sdr" type="text" value = "<?php echo $depositReference;?>" name="depositReference" readonly><br>
                        <label style="width: 120px">Deposit Term:</label>  
                        <input style="width: 75px" id = "sdt" type="text" value = "<?php echo $depositTerm;?>" name="depositTerm" readonly><br>
                        <label style="width: 120px">Deposit Interest:</label>  
                        <input style="width: 75px" id = "sdi" type="text" value = "<?php echo $depositInterest;?>" name="depositInterest" readonly><br>
                    </div>

                    <div class="col-lg-2.5" style="background-color:#fff; padding: 2.5px; margin: 2.5px">
                        <h6>Other Payment</h6>
                        <br>
                        <label style="width: 140px">Membership:</label>  
                        <input style="width: 75px" id = "mbf" type="text" value = "<?php echo number_format($mbfPayment,'2','.','');?>" name="mbfPayment" class = 'famount' readonly><br>
                        <label style="width: 140px">Miscellaneous:</label>  
                        <input style="width: 75px" id = "msf" type="text" value = "<?php echo number_format($msfPayment,'2','.','');?>" name="msfPayment" class = 'famount' readonly><br>
                        <label style="width: 140px">Photocopy:</label>  
                        <input style="width: 75px" id = "ptf" type="text" value = "<?php echo number_format($ptfPayment,'2','.','');?>" name="ptfPayment" class = 'famount' readonly><br>
                        <label style="width: 140px">Rental Income:</label>  
                        <input style="width: 75px" id = "rif" type="text" value = "<?php echo number_format($rifPayment,'2','.','');?>" name="rifPayment" class = 'famount' readonly><br>
                        <label style="width: 140px">Rental Receivable:</label>  
                        <input style="width: 75px" id = "rrf" type="text" value = "<?php echo number_format($rrfPayment,'2','.','');?>" name="rrfPayment" class = 'famount' readonly><br>
                        <label style="width: 140px">Transfer Fee:</label>  
                        <input style="width: 75px" id = "tff" type="text" value = "<?php echo number_format($tffPayement,'2','.','');?>" name="tffPayement" class = 'famount' readonly><br>
                        <label style="width: 140px">Insurance:</label>  
                        <input style="width: 75px" id = "inf" type="text" value = "<?php echo number_format($infPayment,'2','.','');?>" name="infPayment" class = 'famount' readonly><br>
                        <label style="width: 140px">Other Income:</label>  
                        <input style="width: 75px" id = "oif" type="text" value = "<?php echo number_format($rbfPayment,'2','.','');?>" name="rbfPayment" class = 'famount' readonly><br>


                        <br>
                        <label style="width: 100px;font-size: 25px;">TOTAL: &#8369;</label>
                        <input style="width: 120px;border: none;border-bottom: 2px solid red;font-size: 25px;" id = "totalP" type="text" value = "<?php echo number_format($totalPayment,'2','.','');?>" name="totalPayment">

                        <br>
                        <button style="width:auto;" class="btn btn-outline-success my-2 my-sm-0" name = "cashRegister" value = "cashRegister" type="submit"> CASH REGISTER</button>
                    </div>
                </div> 
            </div>
        </div>
        <div id="postView" class="modal">
            <div class="modal-content modal-content-common" >
                <div>
                    <span onclick="document.getElementById('postView').style.display='none'" class="close">&times;</span>
                    <label style="width: 150px">OR Number</label>
                    <input id = "orv" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text" readonly>
                    <label style="width: 150px">Date</label>
                    <input id = "dv" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text" readonly><br>

                    <label style="width: 150px">Previous Loan</label>
                    <input id = "plv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Previous Loan I</label>
                    <input id = "pliv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Business Loan</label>
                    <input id = "blv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Membership</label>
                    <input id = "mbfv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Calamity Loan</label>
                    <input id = "cllv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Subscribe SC</label>
                    <input id = "scfv" style="width: 130px" type="text" style="border: none;" readonly>
                    <br>

                    <label style="width: 150px">Cash Loan</label>
                    <input id = "clv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Capital Build Up</label>
                    <input id = "cbuv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label id = "rctvv"> R </label>
                    <input id="rctv" type="checkbox"<br>
                    <label id = "sclv"> W </label>
                    <input id="wscv" type="checkbox"<br>
                    <br>

                    <label style="width: 150px">Chattel Loan</label>
                    <input id = "cmlv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Savings</label>
                    <input id = "sdv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label  id = "sdlv"> W </label>
                    <input id="wsdv" type="checkbox"<br>
                    <br>

                    <label style="width: 150px">Check Loan</label>
                    <input id = "cklv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Time Deposit</label>
                    <input id = "tdv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label id = "tdlv"> W </label>
                    <input id="wtdv" type="checkbox"<br>
                    <br>

                    <label style="width: 150px">Education Loan</label>
                    <input id = "edlv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Fixed Deposit</label>
                    <input id = "fdv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label id = "fdlv"> W </label>
                    <input id="wfdv" type="checkbox"<br>
                    <br>
                    

                    <label style="width: 150px">Emergency Loan</label>
                    <input id = "emlv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Penalty Loan</label>
                    <input id = "pnlv" style="width: 130px" type="text" style="border: none;" readonly><br>
                    

                    <label style="width: 150px">Special Loan</label>
                    <input id = "slv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Penalty Rice</label>
                    <input id = "pnrv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Regular Loan</label>
                    <input id = "rlv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Miscellaneous</label>
                    <input id = "msfv" style="width: 130px" type="text" style="border: none;" readonly><br>


                    <label style="width: 150px">Rice Loan P</label>
                    <input id = "rlpv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Photocopy</label>
                    <input id = "ptfv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Rice Loan I</label>
                    <input id = "rliv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Rental Income</label>
                    <input id = "rntiv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Rice Cash P</label>
                    <input id = "rcpv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Rental Receivables</label>
                    <input id = "rntrv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Rice Cash I</label>
                    <input id = "rciv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Transfer Fee</label>
                    <input id = "tffv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Other Income</label>
                    <input id = "oiv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Loan Insurance</label>
                    <input id = "insv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px;font-size: 25px"></label>
                    <input id = "" style="width: 130px;border:none;" type="text" readonly>

                    <label style="width: 150px;font-size: 25px">TOTAL</label>
                    <input id = "totalPv" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;font-size: 25px" type="text" readonly><br>
                </div>
                <button style="width:auto;" class="btn btn-outline-success my-2 my-sm-0" name = "paidLoan" value = "paidLoan" type="submit"> POST PAYMENT</button>
            </div>
        </div>

        <div id="postAmountM" class="modal">
            <div class="modal-content modal-payment" >
                <div>
                    <span onclick="document.getElementById('postAmountM').style.display='none'" class="close">&times;</span>
                    <h1 id = "amountLabel"></h1>

                    <div id = "ricePost">
                        <label style="width: 150px">Invoice Number</label>
                        <input id = "inv" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text" autocomplete="off"><br>
                        <label style="width: 150px">Quantity</label>
                        <input id = "rcqv" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text" autocomplete="off"><br>
                        <label style="width: 150px">Interest Amount</label>
                        <input id = "rcia" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text" autocomplete="off"><br>
                        <label style="width: 150px">Principal Amount</label>
                        <input id = "rcpa" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text" autocomplete="off"><br>
                    </div>

                    <div id ="otherPost">
                        <input style="width: 335px;height: 50px;text-align: right;font-size: 40px;" type="text" id = "pap" autocomplete="off"><br><br>
                    </div>

                    <div id ="interestPost">
                        <label style="width: 150px">Loan Principal</label>
                        <input style="width: 335px;height: 50px;text-align: right;font-size: 40px;" type="text" id = "lip" autocomplete="off"><br><br>
                        <!--<label style="width: 150px">Loan Interest</label>
                        <input style="width: 335px;height: 50px;text-align: right;font-size: 40px;" type="text" id = "lii" autocomplete="off"><br><br>-->
                        <label style="width: 150px">Payment Count</label>
                        <input style="width: 335px;height: 50px;text-align: right;font-size: 40px;" type="text" id = "lpcmi" autocomplete="off" value="0"><br><br>
                    </div>  

                    <div id ="loanPost">
                        <input style="width: 335px;height: 50px;text-align: right;font-size: 40px;" type="text" id = "paplpc" autocomplete="off"><br><br>
                        <label style="width: 150px">Payment Count</label>
                        <input style="width: 335px;height: 50px;text-align: right;font-size: 40px;" type="text" id = "lpcm" autocomplete="off" value="0"><br><br>
                    </div>

                    <div id = "otherSavingsPost">
                        <label style="width: 150px">Deposit Reference</label>
                        <input id = "dpr" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text" autocomplete="off" readonly><br>
                        <label style="width: 150px">Deposit Amount</label>
                        <input id = "dpa" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text" autocomplete="off"><br>
                        <label style="width: 150px">Term</label>
                        <input id = "dpt" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text" autocomplete="off"><br>
                        <label style="width: 150px">Intest Rate</label>
                        <input id = "dpi" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text" autocomplete="off"><br>
                        <input id = "dprT" style="width: 130px;border;visibility: hidden; : none;border-bottom: 2px solid red;color: red;" type="text" autocomplete="off" value = "<?php echo $depositReferenceT;?>" name="depositReferenceT" readonly><br>
                        <input id = "dprF" style="width: 130px;border;visibility: hidden; : none;border-bottom: 2px solid red;color: red;" type="text" autocomplete="off" value = "<?php echo $depositReferenceF;?>" name="depositReferenceF" readonly><br>
                    </div>

                </div>
                
                <button style="width:335px;" onclick="postAmount()" class="btn btn-outline-success my-2 my-sm-0" name = "postPayment" value = "postPayment">POST</button>
            </div>
        </div>
    </form>

    <div class="col-sm-12">
        <nav class="navbar navbar-dark" style="background-color:#fff">
            <br>
            <div class="<?php //echo $displayProperty;?>">
                <button onclick="viewModal()" style="width:auto;" class="btn btn-outline-success my-2 my-sm-0">POST PAYMENT</button>
            </div>
        </nav>
    </div>
<div>
    
<script>
    // Get the modal
    var modal = document.getElementById('postView');
    var modal2 = document.getElementById('postAmountM');

    function postAmount() {

        //document.getElementById("cbu").value = document.getElementById("pap").value;

        //if(substr(document.getElementById("top").value) = "BL"){
            //document.getElementById("pap").value = document.getElementById("bl").value;
        //}else 

        //var x = document.getElementById("top").selectedIndex;
        //var y = document.getElementById("top").options;
        //alert("Index: " + y[x].index + " is " + y[x].text);

        var x = document.getElementById("top").selectedIndex;
        var y = document.getElementById("top").options;
        //alert("Index: " + y[x].index + " is " + y[x].value)

        //var loanAIDTemp = y[x].value;
        

        //var e = document.getElementById("top");
        //var strUser = e.options[e.selectedIndex].value;

        if(y[x].value == "cbui"){
            document.getElementById("cbu").value = document.getElementById("pap").value;
        }else if(y[x].value == "svdi"){
            document.getElementById("sdf").value = document.getElementById("pap").value;
        }else if(y[x].value == "rcpi"){
            //document.getElementById("rcfp").value = document.getElementById("pap").value;
            document.getElementById("inva").value = document.getElementById("inv").value;
            document.getElementById("rcqva").value = document.getElementById("rcqv").value;
            document.getElementById("rcfp").value = document.getElementById("rcpa").value;
            document.getElementById("rcfi").value = document.getElementById("rcia").value;
        }else if(y[x].value == "rcii"){
            //document.getElementById("rcfi").value = document.getElementById("pap").value;
        }else if(y[x].value == "rlli"){
            //document.getElementById("rcli").value = document.getElementById("pap").value;
        }else if(y[x].value == "mbsi"){
            document.getElementById("mbf").value = document.getElementById("pap").value;
        }else if(y[x].value == "ssci"){
            document.getElementById("scf").value = document.getElementById("pap").value;
        }else if(y[x].value == "plti"){
            document.getElementById("plf").value = document.getElementById("pap").value;
        }else if(y[x].value == "pnti"){
            document.getElementById("pnf").value = document.getElementById("pap").value;
        }else if(y[x].value == "pli"){
            //document.getElementById("plif").value = document.getElementById("pap").value;
        }else if(y[x].value == "msli"){
            document.getElementById("msf").value = document.getElementById("pap").value;
        }else if(y[x].value == "ptci"){
            document.getElementById("ptf").value = document.getElementById("pap").value;
        }else if(y[x].value == "rnti"){
            document.getElementById("rif").value = document.getElementById("pap").value;
        }else if(y[x].value == "rntr"){
            document.getElementById("rrf").value = document.getElementById("pap").value;
        }else if(y[x].value == "tffi"){
            document.getElementById("tff").value = document.getElementById("pap").value;
        }else if(y[x].value == "fxdi"){
            document.getElementById("fdp").value = document.getElementById("dpa").value;
            document.getElementById("sdr").value = document.getElementById("dpr").value;
            document.getElementById("sdt").value = document.getElementById("dpt").value;
            document.getElementById("sdi").value = document.getElementById("dpi").value;
        }else if(y[x].value == "tmdp"){
            document.getElementById("tdp").value = document.getElementById("dpa").value;
            document.getElementById("sdr").value = document.getElementById("dpr").value;
            document.getElementById("sdt").value = document.getElementById("dpt").value;
            document.getElementById("sdi").value = document.getElementById("dpi").value;
        }else if(y[x].value == "insi"){
            document.getElementById("inf").value = document.getElementById("pap").value;
        }else if(y[x].value == "othi"){
            document.getElementById("oif").value = document.getElementById("pap").value;
        }

        var str = y[x].value;
        var LoanAID = str.substring(0, 2);
        if(LoanAID == "BL"){
            document.getElementById("bll").value = y[x].value; 
            document.getElementById("bl").value = document.getElementById("paplpc").value;
            document.getElementById("lpc").value = document.getElementById("lpcm").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "CLL"){
            document.getElementById("clll").value = y[x].value; 
            document.getElementById("cll").value = document.getElementById("paplpc").value;
            document.getElementById("lpc").value = document.getElementById("lpcm").value;
        }
        var LoanAID = str.substring(0, 2);
        if(LoanAID == "CL"){
            document.getElementById("cls").value = y[x].value; 
            document.getElementById("cl").value = document.getElementById("pap").value;
            //document.getElementById("lpc").value = document.getElementById("lpcm").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "CML"){
            document.getElementById("cmll").value = y[x].value; 
            document.getElementById("cml").value = document.getElementById("paplpc").value;
            document.getElementById("lpc").value = document.getElementById("lpcm").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "CKL"){
            document.getElementById("chkll").value = y[x].value; 
            document.getElementById("chkl").value = document.getElementById("pap").value;
            //document.getElementById("lpc").value = document.getElementById("lpcm").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "EDL"){
            document.getElementById("edll").value = y[x].value; 
            document.getElementById("edl").value = document.getElementById("paplpc").value;
            document.getElementById("lpc").value = document.getElementById("lpcm").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "EML"){
            document.getElementById("emll").value = y[x].value; 
            document.getElementById("eml").value = document.getElementById("pap").value;
            //document.getElementById("lpc").value = document.getElementById("lpcm").value;
        }
        var LoanAID = str.substring(0, 2);
        if(LoanAID == "SL"){
            document.getElementById("sll").value = y[x].value; 
            document.getElementById("sl").value = document.getElementById("pap").value;
            //document.getElementById("lpc").value = document.getElementById("lpcm").value;
        }
        var LoanAID = str.substring(0, 2);
        if(LoanAID == "RL"){
            document.getElementById("rll").value = y[x].value; 
            document.getElementById("rl").value = document.getElementById("paplpc").value;
            document.getElementById("lpc").value = document.getElementById("lpcm").value;
        }
        var LoanAID = str.substring(0, 2);
        if(LoanAID == "PL"){
            document.getElementById("pll").value = y[x].value; 
            document.getElementById("pl").value = document.getElementById("lip").value;
            //document.getElementById("plif").value = document.getElementById("lii").value;
            document.getElementById("lpc").value = document.getElementById("lpcmi").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "RCL"){
            document.getElementById("rclpl").value = y[x].value; 
            document.getElementById("rclp").value = document.getElementById("pap").value;
        }

        //alert(LoanAID);
    }

    function viewModal(){
        document.getElementById('postView').style.display='block';

        var scTemp = document.getElementById("wsc");
        if(scTemp.checked  == true){
            var wscvs = document.getElementById("wscv").checked = true;
        }

        var rcTemp = document.getElementById("rct");
        if(rcTemp.checked  == true){
            var rctvs = document.getElementById("rctv").checked = true;
        }

        var sdTemp = document.getElementById("wsd");
        if(sdTemp.checked  == true){
            var wsdvs = document.getElementById("wsdv").checked = true;
            //var sdlvs = document.getElementById("sdlv").color = red;
        }

        var tdTemp = document.getElementById("wtd");
        if(tdTemp.checked  == true){
            var wtdvs = document.getElementById("wtdv").checked = true;
        }

        var fdTemp = document.getElementById("wfd");
        if(fdTemp.checked  == true){
            var wfdvs = document.getElementById("wfdv").checked = true;
        }


        var orvs = document.getElementById("orv").value = document.getElementById("orvv").value;
        //var orvsc = document.getElementById("orv").text.color = "ff0000";
        var dvs = document.getElementById("dv").value = document.getElementById("dvv").value;
        //var dvsc = document.getElementById("dv").style.color = "ff0000";
        var totalPvs = document.getElementById("totalPv").value = document.getElementById("totalP").value;
        //var totalPvsc = document.getElementById("totalPv").style.color = "ff0000";

        var blvs = document.getElementById("blv").value = document.getElementById("bl").value;
        if(blvs != 0.00){
            document.getElementById("blv").style.border = '2px solid red';
        }
        var cllvs = document.getElementById("cllv").value = document.getElementById("cll").value;
        if(cllvs != 0.00){
            document.getElementById("cllv").style.border = '2px solid red';
        }
        var cmlvs = document.getElementById("cmlv").value = document.getElementById("cml").value;
        if(cmlvs != 0.00){
            document.getElementById("cmlv").style.border = '2px solid red';
        }
        var edlvs = document.getElementById("edlv").value = document.getElementById("edl").value;
        if(edlvs != 0.00){
            document.getElementById("edlv").style.border = '2px solid red';
        }
        var rlvs = document.getElementById("rlv").value = document.getElementById("rl").value;
        if(rlvs != 0.00){
            document.getElementById("rlv").style.border = '2px solid red';
        }

        var plvs = document.getElementById("plv").value = document.getElementById("pl").value;
        if(plvs != 0.00){
            document.getElementById("plv").style.border = '2px solid red';
        }
        var plivs = document.getElementById("pliv").value = document.getElementById("plif").value;
        if(plivs != 0.00){
            document.getElementById("pliv").style.border = '2px solid red';
        }

        var clvs = document.getElementById("clv").value = document.getElementById("cl").value;
        if(clvs != 0.00){
            document.getElementById("clv").style.border = '2px solid red';
        }
        var chkls = document.getElementById("cklv").value = document.getElementById("chkl").value;
        if(chkls != 0.00){
            document.getElementById("cklv").style.border = '2px solid red';
        }
        var emlvs = document.getElementById("emlv").value = document.getElementById("eml").value;
        if(emlvs != 0.00){
            document.getElementById("emlv").style.border = '2px solid red';
        }
        var chkls = document.getElementById("cklv").value = document.getElementById("chkl").value;
        if(chkls != 0.00){
            document.getElementById("cklv").style.border = '2px solid red';
        }
        var slvs = document.getElementById("slv").value = document.getElementById("sl").value;
        if(slvs != 0.00){
            document.getElementById("slv").style.border = '2px solid red';
        }
        var rlpvs = document.getElementById("rlpv").value = document.getElementById("rclp").value;
        if(rlpvs != 0.00){
            document.getElementById("rlpv").style.border = '2px solid red';
        }
        var rlivs = document.getElementById("rliv").value = document.getElementById("rcli").value;
        if(rlivs != 0.00){
            document.getElementById("rliv").style.border = '2px solid red';
        }

        var mbfvs = document.getElementById("mbfv").value = document.getElementById("mbf").value;
        if(mbfvs != 0.00){
            document.getElementById("mbfv").style.border = '2px solid red';
        }
        var scfvs = document.getElementById("scfv").value = document.getElementById("scf").value;
        if(scfvs != 0.00){
            document.getElementById("scfv").style.border = '2px solid red';
        }
        var cbuvs = document.getElementById("cbuv").value = document.getElementById("cbu").value;
        if(cbuvs != 0.00){
            document.getElementById("cbuv").style.border = '2px solid red';
        }
        var sdvs = document.getElementById("sdv").value = document.getElementById("sdf").value;
        if(sdvs != 0.00){
            document.getElementById("sdv").style.border = '2px solid red';
        }
        var tdvs = document.getElementById("tdv").value = document.getElementById("tdp").value;
        if(tdvs != 0.00){
            document.getElementById("tdv").style.border = '2px solid red';
        }

        var fdvs = document.getElementById("fdv").value = document.getElementById("fdp").value;
        if(fdvs != 0.00){
            document.getElementById("fdv").style.border = '2px solid red';
        }

        var pnlvs = document.getElementById("pnlv").value = document.getElementById("plf").value;
        if(pnlvs != 0.00){
            document.getElementById("pnlv").style.border = '2px solid red';
        }
        var pnrvs = document.getElementById("pnrv").value = document.getElementById("pnf").value;
        if(pnrvs != 0.00){
            document.getElementById("pnrv").style.border = '2px solid red';
        }
        var msfvs = document.getElementById("msfv").value = document.getElementById("msf").value;
        if(msfvs != 0.00){
            document.getElementById("msfv").style.border = '2px solid red';
        }
        var rcpvs = document.getElementById("rcpv").value = document.getElementById("rcfp").value;
        if(rcpvs != 0.00){
            document.getElementById("rcpv").style.border = '2px solid red';
        }
        var rcivs = document.getElementById("rciv").value = document.getElementById("rcfi").value;
        if(rcivs != 0.00){
            document.getElementById("rciv").style.border = '2px solid red';
        }
        var ptfvs = document.getElementById("ptfv").value = document.getElementById("ptf").value;
        if(ptfvs != 0.00){
            document.getElementById("ptfv").style.border = '2px solid red';
        }
        var rntivs = document.getElementById("rntiv").value = document.getElementById("rif").value;
        if(rntivs != 0.00){
            document.getElementById("rntiv").style.border = '2px solid red';
        }
        var rntrvs = document.getElementById("rntrv").value = document.getElementById("rrf").value;
        if(rntrvs != 0.00){
            document.getElementById("rntrv").style.border = '2px solid red';
        }
        var tffvs = document.getElementById("tffv").value = document.getElementById("tff").value;
        if(tffvs != 0.00){
            document.getElementById("tffv").style.border = '2px solid red';
        }

        var insvs = document.getElementById("insv").value = document.getElementById("inf").value;
        if(insvs != 0.00){
            document.getElementById("insv").style.border = '2px solid red';
        }

        var oivs = document.getElementById("oiv").value = document.getElementById("oif").value;
        if(oivs != 0.00){
            document.getElementById("oiv").style.border = '2px solid red';
        }

        //tasf = document.getElementById("sfv").value;
        //taff = document.getElementById("ffv").value;

        //asf = tasf;
        //aff = taff;

        //var totalCharges = asf + aff;


        //alert(totalCharges);

        //var tcff=  document.getElementById("tcff").value = z;
    }

    function viewAmount(){
        document.getElementById('postAmountM').style.display='block';
        document.getElementById('pap').focus();
        var x = document.getElementById("top").selectedIndex;
        var y = document.getElementById("top").options;

        amountLabel.innerText = y[x].text;

        var str = y[x].value;
        if(str.substring(0, 4) == "rcpi"){
            document.getElementById('ricePost').style.display='block';
            document.getElementById('otherPost').style.display='none';
            document.getElementById('interestPost').style.display='none';
            document.getElementById('loanPost').style.display='none';
            document.getElementById('otherSavingsPost').style.display='none';
        }else if(str.substring(0, 3) == "RCL"){
            document.getElementById('ricePost').style.display='none';
            document.getElementById('otherPost').style.display='none';
            document.getElementById('interestPost').style.display='none';
            document.getElementById('loanPost').style.display='none';
            document.getElementById('otherSavingsPost').style.display='none';
        }else if(str.substring(0, 2) == "PL"){
            document.getElementById('ricePost').style.display='none';
            document.getElementById('otherPost').style.display='none';
            document.getElementById('interestPost').style.display='block';
            document.getElementById('loanPost').style.display='none';
            document.getElementById('otherSavingsPost').style.display='none';
        }else if(str.substring(0, 2) == "RL" || str.substring(0, 2) == "BL" || str.substring(0, 3) == "CLL" || str.substring(0, 3) == "EDL" || str.substring(0, 3) == "CML"){
            document.getElementById('ricePost').style.display='none';
            document.getElementById('otherPost').style.display='none';
            document.getElementById('interestPost').style.display='none';
            document.getElementById('loanPost').style.display='inline';
            document.getElementById('otherSavingsPost').style.display='none';
        }else if(str.substring(0, 4) == "tmdp" || str.substring(0, 4) == "fxdi"){

            if(str.substring(0, 4) == "tmdp"){
                document.getElementById("dpr").value = document.getElementById("dprT").value; ;
            }else{
                document.getElementById("dpr").value = document.getElementById("dprF").value; ;
            }

            document.getElementById('ricePost').style.display='none';
            document.getElementById('otherPost').style.display='none';
            document.getElementById('interestPost').style.display='none';
            document.getElementById('loanPost').style.display='none';
            document.getElementById('otherSavingsPost').style.display='block';
        }else{
            document.getElementById('ricePost').style.display='none';
            document.getElementById('otherPost').style.display='block';
            document.getElementById('interestPost').style.display='none';
            document.getElementById('loanPost').style.display='none';
            document.getElementById('otherSavingsPost').style.display='none';
        }
    }

    //put data

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>
    <?php include "css1.html" ?>
</html>