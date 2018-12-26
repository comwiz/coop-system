<!DOCTYPE html>
<html>

<?php  

require_once 'session.php';

$idNumber = "";
$firstName = "";
$middleName = "";
$lastName = "";
$accountNumber = "";

$loanApplicationNumberId = "";
$referencenumber = "";
$amountPayment = 0;

$datePayment = "";

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

$countErr = "";
$submitApplication = "";
$searchMember = "";
$searchOR = "";
$identifier = "";
$displayProperty = "none";
$paidLoan = "";
$withdrawSavings = "";
$withdrawShareCapital = "";
$withdrawTimeDeposit = "";

$numRow = 0;
$infomessage = "";
$idNumberSearch = "";

//Loan Payment
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
$slLA = "Secial Loan:";
$slPayment = 0;
$plLA = "Previous Loan";
$plPayment = 0;
$pliPayment = 0;
$rclLA = "Rice Loan (P)";
$rclPayment = 0;
$rclPLA = "Rice Loan(I)";
$rclPPayment = 0;

//
$invoiceNumberP = "";
$invoiceNumber = "";
$quantityCash = 0;
//paymentName
$mbfPayment = 0;
$scfPayment = 0;
$cbuDeposit = 0;
$savingsDeposit = 0;
$timeDeposit = 0;
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

$blValue = 0;
$bliValue = 0;
$cllValue = 0;
$clliValue = 0;
$cmlValue = 0;
$cmliValue = 0;
$edlValue = 0;
$edliValue = 0;
$rlValue = 0;
$rliValue = 0;
$plValue = 0;
$pliValue = 0;
$clValue = 0;
$cklValue = 0;
$emlValue = 0;
$slValue = 0;
$rclValue = 0;
$rcliValue = 0;
$rccValue = 0;
$rcciValue = 0;
$oiValue = 0;
$scValue = 0;
$sdValue = 0;
$tdValue = 0;
$fdValue = 0;

$clearOR = "";
$cancelOR = "";
$exitB = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["searchMember"])) {
        $searchMember = test_input($_POST["searchMember"]);
    }

    if (!empty($_POST["searchOR"])) {
        $searchOR = test_input($_POST["searchOR"]);
    }

    if (!empty($_POST["clearOR"])) {
        $clearOR = test_input($_POST["clearOR"]);
    }

    if (!empty($_POST["cancelOR"])) {
        $cancelOR = test_input($_POST["cancelOR"]);
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

    if (!empty($_POST["withdrawTimeDeposit"]) ) {
        $withdrawTimeDeposit = test_input($_POST["withdrawTimeDeposit"]);
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

    if (empty($_POST["rclLA"]) && !is_numeric($_POST["rclLA"])) {
        $countErr++;
    }else {
        $rclLA = test_input($_POST["rclLA"]);
    }

    if (empty($_POST["rclPayment"]) && !is_numeric($_POST["rclPayment"])) {
        $countErr++;
    }else {
        $rclPayment = test_input($_POST["rclPayment"]);
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


    if($exitB == "exitB"){
        session_destroy();
        header("Location: http://localhost/projectkikz/samplemwmmpc/application/views/home/login.php");
    }

    if($searchOR == "searchOR"){
        $sqlName = "SELECT * FROM  cashier_report_table WHERE or_number = '$referencenumber' ";

        $resultName = $conn->query($sqlName);
        $numRow = mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                //$dateTransaction = $row['date_transaction'];

                $transactionNumber= $row['transaction_number'];
                $idNumber= $row['id_number'];
                $orNumber= $row['or_number'];
                $totalAmount= $row['total_amount'];
                $bl= $row['bl'];
                $cll= $row['cll'];
                $cml= $row['cml'];
                $edl= $row['edl'];
                $rl= $row['rl'];
                $pl= $row['pl'];
                $cl= $row['cl'];
                $ckl= $row['ckl'];
                $eml= $row['eml'];
                $sl= $row['sl'];
                $rcl= $row['rcl'];
                $rcc= $row['rcc'];
                $oi= $row['oi'];
                $sc= $row['sc'];
                $sd= $row['sd'];
                $td= $row['td'];
                $fd= $row['fd'];
                $datePayment= $row['date_transaction'];
                $encodedBy= $row['encoded_by'];

                if($bl== 1){
                    $sqlLP1 = "SELECT * FROM  bl_loan_payment_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "SELECT * FROM  bl_credit_revenue_table WHERE reference_number = '$referencenumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $blValue= $row['amount'];
                            $blLA = $row['loan_application_number'];
                        }
                    }

                    //Interest
                    if($resultLP2->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP2)) {
                            # code...
                            $bliValue = $row['interest_revenue'];
                            $blLA = $row['loan_application_number'];
                        }
                    }

                    $blPayment = $blValue + $bliValue;
                }else{
                    $blValue= 0;
                    $bliValue= 0;
                    $blPayment = 0;
                }

                if($cll== 1){
                    $sqlLP1 = "SELECT * FROM  cll_loan_payment_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "SELECT * FROM  cll_credit_revenue_table WHERE reference_number = '$referencenumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $cllValue= $row['amount'];
                            $cllLA = $row['loan_application_number'];
                        }
                    }

                    //Interest
                    if($resultLP2->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP2)) {
                            # code...
                            $clliValue= $row['interest_revenue'];
                            $cllLA = $row['loan_application_number'];
                        }
                    }

                    $cllPayment = $cllValue + $clliValue;
                }else{
                    $cllValue= 0;
                    $clliValue= 0;
                    $cllPayment = 0;
                }

                if($cml== 1){
                    $sqlLP1 = "SELECT * FROM  cml_loan_payment_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "SELECT * FROM  cml_credit_revenue_table WHERE reference_number = '$referencenumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $cmlValue= $row['amount'];
                            $cmlLA = $row['loan_application_number'];
                        }
                    }

                    //Interest
                    if($resultLP2->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP2)) {
                            # code...
                            $cmliValue= $row['interest_revenue'];
                            $cmlLA = $row['loan_application_number'];
                        }
                    }
                    $cmlPayment = $cmlValue + $cmliValue;
                }else{
                    $cmlValue= 0;
                    $cmliValue= 0;
                }

                if($edl== 1){
                   $sqlLP1 = "SELECT * FROM  edl_loan_payment_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "SELECT * FROM  edl_credit_revenue_table WHERE reference_number = '$referencenumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $edlValue = $row['amount'];
                            $edlLA = $row['loan_application_number'];
                        }
                    }

                    //Interest
                    if($resultLP2->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP2)) {
                            # code...
                            $edliValue = $row['interest_revenue'];
                            $edlLA = $row['loan_application_number'];
                        }
                    }

                    $edlPayment = $edlValue + $edliValue;
                }else{
                    $edlValue= 0;
                    $edliValue= 0;
                    $edlPayment= 0;
                }

                if($rl== 1){
                    $sqlLP1 = "SELECT * FROM  rl_loan_payment_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "SELECT * FROM  rl_credit_revenue_table WHERE reference_number = '$referencenumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $rlValue= $row['amount'];
                            $rlLA = $row['loan_application_number'];
                        }
                    }

                    //Interest
                    if($resultLP2->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP2)) {
                            # code...
                            $rliValue= $row['interest_revenue'];
                            $rlLA = $row['loan_application_number'];
                        }
                    }

                    $rlPayment = $rlValue + $rliValue;
                }else{
                    $rlValue= 0;
                    $rliValue= 0;
                    $rlPayment=0;
                }

                if($pl== 1){
                    $sqlLP1 = "SELECT * FROM  pl_loan_payment_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "SELECT * FROM  pl_credit_revenue_table WHERE reference_number = '$referencenumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        $plValueTemp = 0;
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $plValueTemp = $plValueTemp + $row['amount'];
                            $plValue= $plValueTemp;
                            $plLA = $row['loan_application_number'];
                        }
                    }

                    //Interest
                    if($resultLP2->num_rows > 0){
                        $pliValueTemp = 0;
                        while ($row = mysqli_fetch_array($resultLP2)) {
                            # code...
                            $pliValueTemp = $pliValueTemp + $row['interest_revenue'];
                            $pliValue= $pliValueTemp;
                            $plLA = $row['loan_application_number'];
                        }
                    }
                    $plPayment = $plValue;
                    $pliPayment =  $pliValue;
                }else{
                    $plValue= 0;
                    $pliValue= 0;
                    $plPayment = 0;
                    $pliPayment =  0;
                }

                if($cl== 1){
                    $sqlLP1 = "SELECT * FROM  cl_loan_payment_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $clPayment= $row['amount'];
                            $cllLA = $row['loan_application_number'];
                        }
                    }
                }else{
                    $clPayment= 0;
                }

                if($ckl== 1){
                    $sqlLP1 = "SELECT * FROM  ckl_loan_payment_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $chklPayment= $row['amount'];
                            $chklLA = $row['loan_application_number'];
                        }
                    }
                }else{
                    $chklPayment= 0;
                }

                if($eml== 1){
                    $sqlLP1 = "SELECT * FROM  eml_loan_payment_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $emlPayment= $row['amount'];
                            $emlLA = $row['loan_application_number'];
                        }
                    }
                }else{
                    $emlPayment= 0;
                }

                if($sl== 1){
                    $sqlLP1 = "SELECT * FROM  sl_loan_payment_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $slPayment= $row['amount'];
                            $slLA = $row['loan_application_number'];
                        }
                    }
                }else{
                    $slPayment= 0 ;
                }

                if($rcl== 1){
                    $sqlLP1 = "SELECT * FROM  rice_loan_payment_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "SELECT * FROM  rice_credit_revenue_table WHERE reference_number = '$referencenumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $rclPayment= $row['amount'];
                            $rcllA = $row['loan_application_number'];
                        }
                    }

                    //Interest
                    if($resultLP2->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP2)) {
                            # code...
                            $rclPPayment= $row['interest_revenue'];
                            $rcllA = $row['loan_application_number'];
                        }
                    }

                    $sqlLP = "SELECT * FROM  rice_loan_table WHERE loan_application_number = '$rcllA' ";
                    $resultLP = $conn->query($sqlLP);

                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $invoiceNumberP= $row['invoice_number'];
                            $quantity= $row['quantity'];
                        }
                    }
                }else{
                    $rclPayment= 0;
                    $rclPPayment= 0;
                    $invoiceNumberP = "";
                    $quantity = 0;

                }

                if($rcc== 1){
                    $sqlLP1 = "SELECT * FROM  rice_cash_revenue_table WHERE or_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $invoiceNumber = $row['invoice_number'];
                            $quantityCash = $row['quantity'];
                            $rcfPayment= $row['principal_amount'];
                            $rcfPaymentI= $row['interest_amount'];
                        }
                    }
                }else{
                    $rcfPayment= 0;
                    $rcfPaymentI= 0;
                    $invoiceNumber = "";
                    $quantityCash = 0;


                }

                if($oi== 1){
                    $sqlLP1 = "SELECT * FROM  other_income_table WHERE or_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        $oiValueTemp = 0;
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...

                            if($row['income_code'] == "insi"){
                                $infPayment = $row['amount'];
                            }else{
                                $infPayment = 0;
                            }

                            if($row['income_code'] == "mbsi"){
                                $mbfPayment = $row['amount'];
                            }else{
                                $mbfPayment = 0;
                            }

                            if($row['income_code'] == "msli"){
                                $msfPayment = $row['amount'];
                            }else{
                                $msfPayment = 0;
                            }

                            if($row['income_code'] == "plti"){
                                $plfPayment = $row['amount'];
                            }else{
                                $plfPayment = 0;
                            }

                            if($row['income_code'] == "pnti"){
                                $pnfPayment = $row['amount'];
                            }else{
                                $pnfPayment = 0;
                            }

                            if($row['income_code'] == "ptci"){
                                $ptfPayment = $row['amount'];
                            }else{
                                $ptfPayment = 0;
                            }

                            if($row['income_code'] == "rnti"){
                                $rifPayment = $row['amount'];
                            }else{
                                $rifPayment = 0;
                            }

                            if($row['income_code'] == "rntr"){
                                $rrfPayment = $row['amount'];
                            }else{
                                $rrfPayment = 0;
                            }

                            if($row['income_code'] == "tffi"){
                                $tffPayement = $row['amount'];
                            }else{
                                $tffPayement = 0;
                            }

                            if($row['income_code'] == "oifi"){
                                $rbfPayment = $row['amount'];
                            }else{
                                $rbfPayment = 0;
                            }
                        }
                    }
                }else{
                    $infPayment = 0;
                    $mbfPayment = 0;
                    $msfPayment = 0;
                    $plfPayment = 0;
                    $pnfPayment = 0;
                    $ptfPayment = 0;
                    $rifPayment = 0;
                    $rrfPayment = 0;
                    $tffPayement = 0;
                    $rbfPayment = 0;
                }

                if($sc== 1){
                    $sqlLP1 = "SELECT * FROM  share_capital_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            if($row['amount'] == "type_transaction"){
                                $cbuDeposit = $row['amount'];
                            }else{
                                $cbuDeposit = 0;
                            }

                            if($row['amount'] == "type_transaction"){
                                $scfPayment = $row['amount'];
                            }else{
                                $scfPayment = 0;
                            }
                            
                        }
                    }
                }else{
                    $cbuDeposit = 0;
                    $scfPayment = 0;
                }

                if($sd== 1){
                    $sqlLP1 = "SELECT * FROM  savings_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $savingsDeposit= $row['amount'];
                        }
                    }
                }else{
                    $savingsDeposit= 0;
                }

                if($td== 1){
                    $sqlLP1 = "SELECT * FROM  time_deposit_table WHERE reference_number = '$referencenumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    //Principal
                    if($resultLP1->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP1)) {
                            # code...
                            $timeDeposit = $row['amount'];
                        }
                    }
                }else{
                    $timeDeposit = 0;
                }

                if($fd== 1){

                }else{
                    $fdValue= 0;   
                }
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
    }

    if($clearOR == "clearOR"){
        $sqlName = "SELECT * FROM cashier_report_table WHERE or_number = '$referencenumber' and id_number = '$idNumber' ";

        $resultName = $conn->query($sqlName);
        $numRow = mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                //$dateTransaction = $row['date_transaction'];

                $transactionNumber= $row['transaction_number'];
                $idNumber= $row['id_number'];
                $orNumber= $row['or_number'];
                $totalAmount= $row['total_amount'];
                $bl= $row['bl'];
                $cll= $row['cll'];
                $cml= $row['cml'];
                $edl= $row['edl'];
                $rl= $row['rl'];
                $pl= $row['pl'];
                $cl= $row['cl'];
                $ckl= $row['ckl'];
                $eml= $row['eml'];
                $sl= $row['sl'];
                $rcl= $row['rcl'];
                $rcc= $row['rcc'];
                $oi= $row['oi'];
                $sc= $row['sc'];
                $sd= $row['sd'];
                $td= $row['td'];
                $fd= $row['fd'];
                $datePayment= $row['date_transaction'];
                $encodedBy= $row['encoded_by'];

                if($bl== 1){
                    $sqlLP1 = "DELETE FROM  bl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  bl_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                        echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                        echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }else{
                    $blValue= 0;
                    $bliValue= 0;
                    $blPayment = 0;
                }

                if($cll== 1){
                    $sqlLP1 = "DELETE FROM  cll_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  cll_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else{ 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }else{
                    $cllValue= 0;
                    $clliValue= 0;
                    $cllPayment = 0;
                }

                if($cml== 1){
                    $sqlLP1 = "DELETE FROM  cml_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  cml_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    } 
                }else{
                    $cmlValue= 0;
                    $cmliValue= 0;
                }

                if($edl== 1){
                   $sqlLP1 = "DELETE FROM  edl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  edl_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }else{
                    $edlValue= 0;
                    $edliValue= 0;
                    $edlPayment= 0;
                }

                if($rl== 1){
                    $sqlLP1 = "DELETE FROM  rl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  rl_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    } 
                }else{
                    $rlValue= 0;
                    $rliValue= 0;
                    $rlPayment=0;
                }

                if($pl== 1){
                    $sqlLP1 = "DELETE FROM  pl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  pl_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }else{
                    $plValue= 0;
                    $pliValue= 0;
                    $plPayment = 0;
                    $pliPayment =  0;
                }

                if($cl== 1){
                    $sqlLP1 = "DELETE FROM  cl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }

                    $sql = "UPDATE cl_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                }else{
                    $clPayment= 0;
                }

                if($ckl== 1){
                    $sqlLP1 = "DELETE FROM  ckl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }

                    $sql = "UPDATE ckl_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                }else{
                    $chklPayment= 0;
                }

                if($eml== 1){
                    $sqlLP1 = "DELETE FROM  eml_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }

                    $sql = "UPDATE eml_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                }else{
                    $emlPayment= 0;
                }

                if($sl== 1){
                    $sqlLP1 = "DELETE FROM  sl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }

                    $sql = "UPDATE sl_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }else{
                    $slPayment= 0 ;
                }

                if($rcl== 1){
                    $sqlLP1 = "DELETE FROM  rice_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  rice_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }

                    $sql = "UPDATE rice_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }else{
                    $rclPayment= 0;
                    $rclPPayment= 0;
                    $invoiceNumberP = "";
                    $quantity = 0;

                }

                if($rcc== 1){
                    $sqlLP1 = "DELETE FROM  rice_cash_revenue_table 
                    WHERE or_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $rcfPayment= 0;
                    $rcfPaymentI= 0;
                    $invoiceNumber = "";
                    $quantityCash = 0;


                }

                if($oi== 1){
                    $sqlLP1 = "DELETE FROM  other_income_table 
                    WHERE or_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $infPayment = 0;
                    $mbfPayment = 0;
                    $msfPayment = 0;
                    $plfPayment = 0;
                    $pnfPayment = 0;
                    $ptfPayment = 0;
                    $rifPayment = 0;
                    $rrfPayment = 0;
                    $tffPayement = 0;
                    $rbfPayment = 0;
                }

                if($sc== 1){
                    $sqlLP1 = "DELETE FROM  share_capital_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $cbuDeposit = 0;
                    $scfPayment = 0;
                }

                if($sd== 1){
                    $sqlLP1 = "DELETE FROM  savings_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $savingsDeposit= 0;
                }

                if($td== 1){
                    $sqlLP1 = "DELETE FROM  time_deposit_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $timeDeposit = 0;
                }

                if($fd== 1){

                }else{
                    $fdValue= 0;   
                }

                $sqlLP1 = "DELETE FROM  cashier_report_table 
                WHERE or_number = '$referencenumber' and id_number = '$idNumber' ";
                $resultLP1 = $conn->query($sqlLP1);

                if ($conn->query($sqlLP1) === TRUE) {
                   $infomessage = "Record updated successfully";
                }else { 
                      echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                }
            }
        }
    }

    if($cancelOR == "cancelOR"){
        $sqlName = "SELECT * FROM cashier_report_table WHERE or_number = '$referencenumber' and id_number = '$idNumber' ";

        $resultName = $conn->query($sqlName);
        $numRow = mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                //$dateTransaction = $row['date_transaction'];

                $transactionNumber= $row['transaction_number'];
                $idNumber= $row['id_number'];
                $orNumber= $row['or_number'];
                $totalAmount= $row['total_amount'];
                $bl= $row['bl'];
                $cll= $row['cll'];
                $cml= $row['cml'];
                $edl= $row['edl'];
                $rl= $row['rl'];
                $pl= $row['pl'];
                $cl= $row['cl'];
                $ckl= $row['ckl'];
                $eml= $row['eml'];
                $sl= $row['sl'];
                $rcl= $row['rcl'];
                $rcc= $row['rcc'];
                $oi= $row['oi'];
                $sc= $row['sc'];
                $sd= $row['sd'];
                $td= $row['td'];
                $fd= $row['fd'];
                $datePayment= $row['date_transaction'];
                $encodedBy= $row['encoded_by'];

                if($bl== 1){
                    $sqlLP1 = "DELETE FROM  bl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  bl_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                        echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                        echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }else{
                    $blValue= 0;
                    $bliValue= 0;
                    $blPayment = 0;
                }

                if($cll== 1){
                    $sqlLP1 = "DELETE FROM  cll_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  cll_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else{ 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }else{
                    $cllValue= 0;
                    $clliValue= 0;
                    $cllPayment = 0;
                }

                if($cml== 1){
                    $sqlLP1 = "DELETE FROM  cml_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  cml_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    } 
                }else{
                    $cmlValue= 0;
                    $cmliValue= 0;
                }

                if($edl== 1){
                   $sqlLP1 = "DELETE FROM  edl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  edl_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }else{
                    $edlValue= 0;
                    $edliValue= 0;
                    $edlPayment= 0;
                }

                if($rl== 1){
                    $sqlLP1 = "DELETE FROM  rl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  rl_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    } 
                }else{
                    $rlValue= 0;
                    $rliValue= 0;
                    $rlPayment=0;
                }

                if($pl== 1){
                    $sqlLP1 = "DELETE FROM  pl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  pl_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }else{
                    $plValue= 0;
                    $pliValue= 0;
                    $plPayment = 0;
                    $pliPayment =  0;
                }

                if($cl== 1){
                    $sqlLP1 = "DELETE FROM  cl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $clPayment= 0;
                }

                if($ckl== 1){
                    $sqlLP1 = "DELETE FROM  ckl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $chklPayment= 0;
                }

                if($eml== 1){
                    $sqlLP1 = "DELETE FROM  eml_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $emlPayment= 0;
                }

                if($sl== 1){
                    $sqlLP1 = "DELETE FROM  sl_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $slPayment= 0 ;
                }

                if($rcl== 1){
                    $sqlLP1 = "DELETE FROM  rice_loan_payment_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  rice_credit_revenue_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }else{
                    $rclPayment= 0;
                    $rclPPayment= 0;
                    $invoiceNumberP = "";
                    $quantity = 0;

                }

                if($rcc== 1){
                    $sqlLP1 = "DELETE FROM  rice_cash_revenue_table 
                    WHERE or_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $rcfPayment= 0;
                    $rcfPaymentI= 0;
                    $invoiceNumber = "";
                    $quantityCash = 0;


                }

                if($oi== 1){
                    $sqlLP1 = "DELETE FROM  other_income_table 
                    WHERE or_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $infPayment = 0;
                    $mbfPayment = 0;
                    $msfPayment = 0;
                    $plfPayment = 0;
                    $pnfPayment = 0;
                    $ptfPayment = 0;
                    $rifPayment = 0;
                    $rrfPayment = 0;
                    $tffPayement = 0;
                    $rbfPayment = 0;
                }

                if($sc== 1){
                    $sqlLP1 = "DELETE FROM  share_capital_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $cbuDeposit = 0;
                    $scfPayment = 0;
                }

                if($sd== 1){
                    $sqlLP1 = "DELETE FROM  savings_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $savingsDeposit= 0;
                }

                if($td== 1){
                    $sqlLP1 = "DELETE FROM  time_deposit_table 
                    WHERE reference_number = '$referencenumber' and id_number = '$idNumber' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }else{
                    $timeDeposit = 0;
                }

                if($fd== 1){

                }else{
                    $fdValue= 0;   
                }

                $sql = "UPDATE cashier_report_table SET
                id_number = 'CANCEL',
                invoice_number = '',
                bl = '0',
                cll = '0',
                cml = '0',
                edl = '0',
                rl = '0',
                pl = '0',
                cl = '0',
                ckl = '0',
                eml = '0',
                sl = '0',
                rcl = '0',
                rcc = '0',
                oi = '0',
                sc = '0',
                sd = '0',
                td = '0',
                fd = '0',
                total_amount = '0'

                WHERE or_number = '$referencenumber' and id_number = '$idNumber' ";

                if ($conn->query($sql) === TRUE) {
                   $infomessage = "Record updated successfully";
                }else { 
                      echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
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
    });
    </script>
</head>

<style>

    .none{
        display: none;
    }
    .inline{
        display: inline;
    }

    /* Full-width input fields 
    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }*/

    /* Set a style for all buttons 
    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }*/

    /* The Modal (background) */


    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 10px; /* Location of the box */
        left: 0;
        top: 50px;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 44%;
    }

    .modal-content2 {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 25%;
    }
    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<body>
<div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php //include 'topbar.php';?>
        <!--member account info-->
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-12" style="margin-top:25px;margin-left: 16.7%;margin-bottom: 200px;">  
                <p align="center"><span><?php echo $infomessage;?></span><br></p>
                <div class="row">
                    <!-- -->
                    <div class="col-lg-1.5" style="background-color:#fff; padding: 2.5px; margin: 2.5px">
                        <h6>Payment Transaction</h6>

                        <label style="width: 120px">OR number</label><br>
                        <input style="width: 140px" id = "orvv" type="number" value = "<?php echo $referencenumber;?>" name = "referencenumber"><br><br>

                        <button class="btn btn-outline-success my-2 my-sm-0" name = "searchOR" value = "searchOR" type="submit" style="align-self: center;">SEARCH</button><br>

                        <label style="width: 120px">Date</label><br>
                        <input style="width: 140px" id = "dvv" type="date" value = "<?php echo $datePayment;?>" name = "datePayment"><br>

                        <!--<label style="width: 120px">Amount</label><br>
                        <input style="width: 140px" type="text" id = "pap" type="text"><br><br>

                        <button onclick="postAmount()" class="btn btn-outline-success my-2 my-sm-0" style="align-self: center;" name = "postPayment" value = "postPayment">POST</button>-->
                    </div>

                    <div class="col-lg-1.5" style="background-color:#fff; padding: 2.5px; margin: 2.5px">
                        <h6>Account Information</h6>
                        <label style="width: 140px">Search</label><br>
                        <input style="width: 140px" type="text" placeholder="Search Member" value = "<?php echo $idNumberSearch;?>" name = "idNumberSearch"><br><br>

                        <button class="btn btn-outline-success my-2 my-sm-0" name = "searchMember" value = "searchMember" type="submit" style="align-self: center;">SEARCH</button><br><br>

                        <input style="width: 140px" type="text" placeholder="ID Number" value = "<?php echo $idNumber;?>" name = "idNumber" readonly><br><br>

                        <input style="width: 140px" type="text" placeholder="First Name" value = "<?php echo $firstName;?>" readonly><br><br>

                        <input style="width: 140px" type="text" placeholder="Middle Name" value = "<?php echo $middleName;?>" readonly><br><br>

                        <input style="width: 140px" type="text" placeholder="Last Name" value = "<?php echo $lastName;?>" readonly>
                    </div>

                    <div class="col-lg-2.5" style="background-color:#fff; padding: 2.5px; margin: 2.5px">
                        <h6>Rice Cash</h6>
                        <label style="width: 120px">Invoice Number</label>  
                        <input style="width: 75px" id = "inva" type="text" value = "<?php echo $invoiceNumber;?>" name="invoiceNumber"><br>
                        <label style="width: 120px">Quantity</label>  
                        <input style="width: 75px" id = "rcqva" type="text" value = "<?php echo $quantityCash;?>" name="quantityCash"><br>
                        <label style="width: 120px">Rice (Principal)</label>  
                        <input style="width: 75px" id = "rcfp" type="text" value = "<?php echo number_format($rcfPayment,'2','.','');?>" name="rcfPayment"><br>
                        <label style="width: 120px">Rice (Interest)</label>  
                        <input style="width: 75px" id = "rcfi" type="text" value = "<?php echo number_format($rcfPaymentI,'2','.','');?>" name="rcfPaymentI">

                        <h6>Rice Loan</h6>
                        <input style="width: 120px" type="text" value = "Invoice Number" name="Invoice Number">
                        <input style="width: 75px" value = "<?php echo $invoiceNumberP;?>" name = "invoiceNumberP"><br>
                        <input style="width: 120px" type="text" value = "Quantity" name="Quantity">
                        <input style="width: 75px" value = "<?php echo $quantity;?>" name = "quantity"><br>
                        <input style="width: 120px" id = "rclpl" type="text" value = "<?php echo $rclLA;?>" name="rclLA">  
                        <input style="width: 75px" id = "rclp" type="text" value = "<?php echo number_format($rclPayment,'2','.','');?>" name="rclPayment"><br>
                        <input style="width: 120px" id = "rclil" type="text" value = "<?php echo $rclPLA;?>" name="rclPLA">  
                        <input style="width: 75px" id = "rcli" type="text" value = "<?php echo number_format($rclPPayment,'2','.','');?>" name="rclPPayment"><br>
                    </div>

                    <div class="col-lg-2.5" style="background-color:#fff; padding: 2.5px; margin: 2.5px">
                        <h6>Loan Payment</h6>
                        <input style="width: 120px" id = "bll" type="text" value = "<?php echo $blLA;?>" name="blLA" readonly> 
                        <input style="width: 75px" id = "bl" type="text" value = "<?php echo number_format($blPayment,'2','.','');?>" name="blPayment"><br>

                        <input style="width: 120px" id = "clll" type="text" value = "<?php echo $cllLA;?>" name="cllLA" readonly>
                        <input style="width: 75px" id = "cll" type="text" value = "<?php echo number_format($cllPayment,'2','.','');?>" name="cllPayment"><br>

                        <input style="width: 120px" id = "cls" type="text" value = "<?php echo $clLA;?>" name="clLA" readonly>  
                        <input style="width: 75px" id = "cl" type="text" value = "<?php echo number_format($clPayment,'2','.','');?>" name="clPayment"><br>

                        <input style="width: 120px" id = "cmll" type="text" value = "<?php echo $cmlLA;?>" name="cmlLA" readonly>
                        <input style="width: 75px" id = "cml" type="text" value = "<?php echo number_format($cmlPayment,'2','.','');?>" name="cmlPayment"><br>

                        <input style="width: 120px" id = "chkll" type="text" value = "<?php echo $chklLA;?>" name="chklLA" readonly> 
                        <input style="width: 75px" id = "chkl" type="text" value = "<?php echo number_format($chklPayment,'2','.','');?>" name="chklPayment"><br>

                        <input style="width: 120px" id = "edll" type="text" value = "<?php echo $edlLA;?>" name="edlLA" readonly>  
                        <input style="width: 75px" id = "edl" type="text" value = "<?php echo number_format($edlPayment,'2','.','');?>" name="edlPayment"><br>
                        <input style="width: 120px" id = "emll" type="text" value = "<?php echo $emlLA;?>" name="emlLA" readonly>  
                        <input style="width: 75px" id = "eml" type="text" value = "<?php echo number_format($emlPayment,'2','.','');?>" name="emlPayment"><br>
                        <input style="width: 120px" id = "sll" type="text" value = "<?php echo $slLA;?>" name="slLA" readonly>
                        <input style="width: 75px" id = "sl" type="text" value = "<?php echo number_format($slPayment,'2','.','');?>" name="slPayment"><br>
                        <input style="width: 120px" id = "rll" type="text" value = "<?php echo $rlLA?>" name="rlLA" readonly>   
                        <input style="width: 75px" id = "rl" type="text" value = "<?php echo number_format($rlPayment,'2','.','');?>" name="rlPayment"><br>
                        <input style="width: 120px" id = "pll" type="text" value = "<?php echo $plLA;?>" name="plLA" readonly>   
                        <input style="width: 75px" id = "pl" type="text" value = "<?php echo number_format($plPayment,'2','.','');?>" name="plPayment"><br>
                        <input style="width: 120px" id = "plil" type="text" value = "Previous Loan (I)" name="pliLA" readonly>   
                        <input style="width: 75px" id = "plif" type="text" value = "<?php echo number_format($pliPayment,'2','.','');?>" name="pliPayment"><br><br>
                    </div>

                    <div class="col-lg-2.5" style="background-color:#fff; padding: 2.5px; margin: 2.5px">
                        <h6>Other Payment</h6>
                        <label style="width: 140px">Membership:</label>  
                        <input style="width: 75px" id = "mbf" type="text" value = "<?php echo number_format($mbfPayment,'2','.','');?>" name="mbfPayment"><br>
                        <label style="width: 140px">Subscribe Capital:</label>   
                        <input style="width: 75px" id = "scf" type="text" value = "<?php echo number_format($scfPayment,'2','.','');?>" name="scfPayment"><br>
                        <label style="width: 140px">Capital Build Up:</label>  
                        <input style="width: 75px" id = "cbu" type="text" value = "<?php echo number_format($cbuDeposit,'2','.','');?>" name="cbuDeposit">
                        <label> W </label>
                        <input id="wsc" type="checkbox" value = "Withdraw" name = "withdrawShareCapital"><br>
                        <label style="width: 140px">Savings:</label>  
                        <input style="width: 75px" id = "sdf" type="text" value = "<?php echo number_format($savingsDeposit,'2','.','');?>" name="savingsDeposit">
                        <label> W </label>
                        <input id = "wsd" type="checkbox" value = "Withdraw" name = "withdrawSavings"><br>
                        <label style="width: 140px">Time Deposit:</label>  
                        <input style="width: 75px" id = "tdp" type="text" value = "<?php echo number_format($timeDeposit,'2','.','');?>" name="timeDeposit">
                        <label> W </label>
                        <input id = "wtd" type="checkbox" value = "Withdraw" name = "withdrawTimeDeposit"><br>
                        <label style="width: 140px">Penalty Loan:</label>  
                        <input style="width: 75px" id = "plf" type="text" value = "<?php echo number_format($plfPayment,'2','.','');?>" name="plfPayment"><br>
                        <label style="width: 140px">Penalty Rice:</label>  
                        <input style="width: 75px" id = "pnf" type="text" value = "<?php echo number_format($pnfPayment,'2','.','');?>" name="pnfPayment"><br>
                        <label style="width: 140px">Miscellaneous:</label>  
                        <input style="width: 75px" id = "msf" type="text" value = "<?php echo number_format($msfPayment,'2','.','');?>" name="msfPayment"><br><br>
                    </div>

                    <div class="col-lg-2.5" style="background-color:#fff; padding: 2.5px; margin: 2.5px">
                        <h6>Other Income</h6>
                        <label style="width: 140px">Photocopy:</label>  
                        <input style="width: 75px" id = "ptf" type="text" value = "<?php echo number_format($ptfPayment,'2','.','');?>" name="ptfPayment"><br>
                        <label style="width: 140px">Rental Income:</label>  
                        <input style="width: 75px" id = "rif" type="text" value = "<?php echo number_format($rifPayment,'2','.','');?>" name="rifPayment"><br>
                        <label style="width: 140px">Rental Receivable:</label>  
                        <input style="width: 75px" id = "rrf" type="text" value = "<?php echo number_format($rrfPayment,'2','.','');?>" name="rrfPayment"><br>
                        <label style="width: 140px">Transfer Fee:</label>  
                        <input style="width: 75px" id = "tff" type="text" value = "<?php echo number_format($tffPayement,'2','.','');?>" name="tffPayement"><br>
                        <label style="width: 140px">Insurance:</label>  
                        <input style="width: 75px" id = "inf" type="text" value = "<?php echo number_format($infPayment,'2','.','');?>" name="infPayment"><br>
                        <label style="width: 140px">Other Income:</label>  
                        <input style="width: 75px" id = "oif" type="text" value = "<?php echo number_format($rbfPayment,'2','.','');?>" name="rbfPayment"><br>


                        <label style="width: 140px">TOTAL:</label>
                        <input style="width: 75px;font-size: 25px;" id = "totalP" type="text" value = "<?php echo number_format($totalPayment,'2','.','');?>" name="totalPayment">

                        <br><br><br><br><br>
                        <button style="width:auto;" class="btn btn-outline-success my-2 my-sm-0" name = "clearOR" value = "clearOR" type="submit"> CLEAR OR</button><br><br>

                        <button style="width:auto;" class="btn btn-outline-success my-2 my-sm-0" name = "cancelOR" value = "cancelOR" type="submit"> CANCEL OR</button><br>
                    </div>
                </div> 
            </div>
        </div>
        <div id="postView" class="modal">
            <div class="modal-content" >
                <div>
                    <span onclick="document.getElementById('postView').style.display='none'" class="close">&times;</span>
                    <p>Cash Receipt</p>
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
                    <label style="width: 150px">Penalty Loan</label>
                    <input id = "pnlv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Emergency Loan</label>
                    <input id = "emlv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Penalty Rice</label>
                    <input id = "pnrv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Special Loan</label>
                    <input id = "slv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Miscellaneous</label>
                    <input id = "msfv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Regular Loan</label>
                    <input id = "rlv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Photocopy</label>
                    <input id = "ptfv" style="width: 130px" type="text" style="border: none;" readonly><br>


                    <label style="width: 150px">Rice Loan P</label>
                    <input id = "rlpv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Rental Income</label>
                    <input id = "rntiv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Rice Loan I</label>
                    <input id = "rliv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Rental Receivables</label>
                    <input id = "rntrv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Rice Cash P</label>
                    <input id = "rcpv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Transfer Fee</label>
                    <input id = "tffv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Rice Cash I</label>
                    <input id = "rciv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">Loan Insurance</label>
                    <input id = "insv" style="width: 130px" type="text" style="border: none;" readonly><br>

                    <label style="width: 150px">Other Income</label>
                    <input id = "oiv" style="width: 130px" type="text" style="border: none;" readonly>
                    <label style="width: 150px">TOTAL</label>
                    <input id = "totalPv" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text" readonly><br>
                </div>
                
                <button style="width:auto;" class="btn btn-outline-success my-2 my-sm-0" name = "paidLoan" value = "paidLoan" type="submit"> POST PAYMENT</button>
            </div>
        </div>

        <div id="postAmountM" class="modal">
            <div class="modal-content2" >
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
                        <label style="width: 150px">Loan Interest</label>
                        <input style="width: 335px;height: 50px;text-align: right;font-size: 40px;" type="text" id = "lii" autocomplete="off"><br><br>
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
        }else if(y[x].value == "tmdp"){
            document.getElementById("tdp").value = document.getElementById("pap").value;
        }else if(y[x].value == "insi"){
            document.getElementById("inf").value = document.getElementById("pap").value;
        }else if(y[x].value == "othi"){
            document.getElementById("oif").value = document.getElementById("pap").value;
        }

        var str = y[x].value;
        var LoanAID = str.substring(0, 2);
        if(LoanAID == "BL"){
            document.getElementById("bll").value = y[x].value; 
            document.getElementById("bl").value = document.getElementById("pap").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "CLL"){
            document.getElementById("clll").value = y[x].value; 
            document.getElementById("cll").value = document.getElementById("pap").value;
        }
        var LoanAID = str.substring(0, 2);
        if(LoanAID == "CL"){
            document.getElementById("cls").value = y[x].value; 
            document.getElementById("cl").value = document.getElementById("pap").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "CML"){
            document.getElementById("cmll").value = y[x].value; 
            document.getElementById("cml").value = document.getElementById("pap").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "CKL"){
            document.getElementById("chkll").value = y[x].value; 
            document.getElementById("chkl").value = document.getElementById("pap").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "EDL"){
            document.getElementById("edll").value = y[x].value; 
            document.getElementById("edl").value = document.getElementById("pap").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "EML"){
            document.getElementById("emll").value = y[x].value; 
            document.getElementById("eml").value = document.getElementById("pap").value;
        }
        var LoanAID = str.substring(0, 2);
        if(LoanAID == "SL"){
            document.getElementById("sll").value = y[x].value; 
            document.getElementById("sl").value = document.getElementById("pap").value;
        }
        var LoanAID = str.substring(0, 2);
        if(LoanAID == "RL"){
            document.getElementById("rll").value = y[x].value; 
            document.getElementById("rl").value = document.getElementById("pap").value;
        }
        var LoanAID = str.substring(0, 2);
        if(LoanAID == "PL"){
            document.getElementById("pll").value = y[x].value; 
            document.getElementById("pl").value = document.getElementById("lip").value;
            document.getElementById("plif").value = document.getElementById("lii").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "RCL"){
            document.getElementById("rclpl").value = y[x].value; 
            document.getElementById("rclp").value = document.getElementById("pap").value;
        }

        alert(LoanAID);
    }

    function viewModal(){
        document.getElementById('postView').style.display='block';

        var scTemp = document.getElementById("wsc");
        if(scTemp.checked  == true){
            var wscvs = document.getElementById("wscv").checked = true;
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
        }else if(str.substring(0, 3) == "RCL"){
            document.getElementById('ricePost').style.display='none';
            document.getElementById('otherPost').style.display='none';
            document.getElementById('interestPost').style.display='none';
        }else if(str.substring(0, 2) == "PL"){
            document.getElementById('ricePost').style.display='none';
            document.getElementById('otherPost').style.display='none';
            document.getElementById('interestPost').style.display='block';
        }else{
            document.getElementById('ricePost').style.display='none';
            document.getElementById('otherPost').style.display='block';
            document.getElementById('interestPost').style.display='none';
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
</body>
    <?php include "css1.html" ?>
</html>