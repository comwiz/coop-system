<?php  


// ADD COMMENT  GITHUB
// ADD BRANCH
// WEB COMMENT

require_once 'session.php';
require('public/fpdf181/fpdf.php');
require ("function.php");

$idNumber [] = "";
$accountNumber [] = "";

$idNumberW [] = "";

$transactionNumber  [] = "";
$orNumber [] = "";
$invoiceNumber [] = "";
$totalAmount [] = "";
$dateTransaction [] = "";
$encoder  [] = "";
$numRow = "";

$transactionNumberW  [] = "";
$orNumberW [] = "";
$totalAmountW [] = "";
$dateTransactionW [] = "";
$encoderW  [] = "";
$numRowWithdraw = "";

$dateToday = date('Y-m-d');
$printReport = "";
$printSummary = "";
$editOR = "";

//cahier
$bl[] = 0;
$cll[] = 0;
$cml[] = 0;
$edl[] = 0;
$rl[] = 0;
$pl[] = 0;
$cl[] = 0;
$ckl[] = 0;
$eml[] = 0;
$sl[] = 0;
$rcl[] = 0;
$rcc[] = 0;
$oi[] = 0;
$sc[] = 0;
$sd[] = 0;
$td[] = 0;
$fd[] = 0;

$oiW[] = 0;
$scW[] = 0;
$sdW[] = 0;
$tdW[] = 0;
$fdW[] = 0;

$blValue[] = 0;
$bliValue[] = 0;
$cllValue[] = 0;
$clliValue[] = 0;
$cmlValue[] = 0;
$cmliValue[] = 0;
$edlValue[] = 0;
$edliValue[] = 0;
$rlValue[] = 0;
$rliValue[] = 0;
$plValue[] = 0;
$pliValue[] = 0;
$clValue[] = 0;
$cklValue[] = 0;
$emlValue[] = 0;
$slValue[] = 0;
$rclValue[] = 0;
$rcliValue[] = 0;
$rccValue[] = 0;
$rcciValue[] = 0;
$oiValue[] = 0;
$scValue[] = 0;
$sdValue[] = 0;
$tdValue[] = 0;
$fdValue[] = 0;

$scValueW[] = 0;
$sdValueW[] = 0;
$tdValueW[] = 0;
$fdValueW[] = 0;

$exitB = "";
$countErr = 0;

$totalAmountS = 0;
$totalAmountBL = 0;
$totalAmountCLL = 0;
$totalamountCML = 0;
$totalAmountEDL = 0;
$totalAmountRL = 0;
$totalAmountPL = 0;
$totalAmountCL = 0;
$totalAmountCKL = 0;
$totalAmountEML = 0;
$totalAmountSL = 0;
$totalAmountRCL = 0;
$totalAmountRCC = 0;
$totalAmountOI = 0;
$totalAmountSC = 0;
$totalAmountSD = 0;
$totalAmountTD = 0;
$totalAmountFD = 0;

$totalLending[] = 0;
$totalTrading[] = 0;
$totalInterest[] = 0;

$totalLendingF = 0;
$totalTradingF = 0;
$totalInterestF = 0;

$totalPenaltyRice = 0;
$totalPenaltyLoan = 0;
$totalRentalIncome = 0;

$totalMembership = 0;
$totalInsurance = 0;
$totalMiscellaneous = 0;
$totalTransferFee = 0;

$totalRCLI = 0;
$totalRCCI = 0;

$oiValueTemp = 0;
$penaltyLoan[] = 0;
$penaltyRice[] = 0;
$RentalIncome[] = 0;

$membership[] = 0;
$miscellaneous[] = 0;
$insurance[] = 0;
$transferFee[] = 0;
//$invoiceNumber[] = "";
$invoiceNumberL[] = "";
$invoiceNumberC[] = "";

$searchReport = "";

//Remit
$remitCollection = "";
$startOR = "";
$endOR = "";
$dateRemit = "";
$am_pm = "";
$startSRN = "";
$endSRN = "";

$thousandQ = 0;
$thousandV = 0;
$fhundterQ = 0;
$fhundterV = 0;
$thundredQ = 0;
$thundredV = 0;
$ohundredQ = 0;
$ohundredV = 0;
$ftenQ = 0;
$ftenV = 0;
$ttenQ = 0;
$ttenV = 0;
$tpesoQ = 0;
$tpesoV = 0;
$fpesoQ = 0;
$fpesoV = 0;
$opesoQ = 0;
$opesoV = 0;
$cpesoQ = 0;
$cpesoV = 0;
$totalCR = 0;

//
$startORP = "";
$endORP = "";
$startSRNP = "";
$endSRNP = "";
$thousandQP = 0;
$thousandVP = 0;
$fhundterQP = 0;
$fhundterVP = 0;
$thundredQP = 0;
$thundredVP = 0;
$ohundredQP = 0;
$ohundredVP = 0;
$ftenQP = 0;
$ftenVP = 0;
$ttenQP = 0;
$ttenVP = 0;
$tpesoQP = 0;
$tpesoVP = 0;
$fpesoQP = 0;
$fpesoVP = 0;
$opesoQP = 0;
$opesoVP = 0;
$cpesoVP = 0;
$cpesoQP = 0;
$totalCRP = 0;

$startORPM = "";
$endORPM = "";
$startSRNPM = "";
$endSRNPM = "";
$thousandQPM = 0;
$thousandVPM = 0;
$fhundterQPM = 0;
$fhundterVPM = 0;
$thundredQPM = 0;
$thundredVPM = 0;
$ohundredQPM= 0;
$ohundredVPM = 0;
$ftenQPM = 0;
$ftenVPM = 0;
$ttenQPM = 0;
$ttenVPM = 0;
$tpesoQPM = 0;
$tpesoVPM = 0;
$fpesoQPM = 0;
$fpesoVPM = 0;
$opesoQPM = 0;
$opesoVPM = 0;
$cpesoVPM = 0;
$cpesoQPM = 0;
$totalCRPM = 0;

$printAM = "";
$printPM = "";

$showAM = "";
$showPM = "";

$displayPropertyAM = "none";
$displayPropertyPM = "none";

$totalCheck = 0;
$totalCheckWithdraw = 0;
$actualCollection = 0;
$typePayment[] = 0;
$typePaymentW[] = 0;

$preparedBy = "LEONIDA S. CATACUTAN";
$checkedBy = "AILEN R. AGAS";
$receivedBy = "ZENAIDA T. OCAMPO";
$notedBy = "EMERITA C. KIUNISALA";

$clearOR = "";
$cancelOR = "";
$cashRegister = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["searchReport"])) {
        $searchReport = test_input($_POST["searchReport"]);
    }

    if (!empty($_POST["printAM"])) {
        $printAM = test_input($_POST["printAM"]);
    }

    if (!empty($_POST["printPM"])) {
        $printPM = test_input($_POST["printPM"]);
    }

    if (!empty($_POST["showAM"])) {
        $showAM = test_input($_POST["showAM"]);
        $displayPropertyAM = "inline";
    }

    if (!empty($_POST["showPM"])) {
        $showPM = test_input($_POST["showPM"]);
        $displayPropertyPM = "inline";
    }


    if (!empty($_POST["printSummary"])) {
        $printSummary = test_input($_POST["printSummary"]);
    }

    if (!empty($_POST["exitB"])) {
        $exitB = test_input($_POST["exitB"]);
    }

    if (!empty($_POST["remitCollection"])) {
        $remitCollection = test_input($_POST["remitCollection"]);
    }

    if (empty($_POST["dateToday"])) {
        $countErr++;
    }else {
        $dateToday = test_input($_POST["dateToday"]);
    }

    if (empty($_POST["dateRemit"]) && !is_numeric($_POST["dateRemit"])) {
        $countErr++;
    }else {
        $dateRemit = test_input($_POST["dateRemit"]);
    }

    if (empty($_POST["startOR"])) {
        $countErr++;
    }else {
        $startOR = test_input($_POST["startOR"]);
    }

    if (empty($_POST["endOR"])) {
        $countErr++;
    }else {
        $endOR = test_input($_POST["endOR"]);
    }

    if (!empty($_POST["startSRN"])) {
        $startSRN = test_input($_POST["startSRN"]);
    }

    if (!empty($_POST["endSRN"])) {
        $endSRN = test_input($_POST["endSRN"]);
    }

    if (empty($_POST["am_pm"]) && !is_numeric($_POST["am_pm"])) {
        $countErr++;
    }else {
        $am_pm = test_input($_POST["am_pm"]);
    }

    if (empty($_POST["thousandQ"]) && !is_numeric($_POST["thousandQ"])) {
        $countErr++;
    }else {
        $thousandQ = test_input($_POST["thousandQ"]);
    }

    if (empty($_POST["thousandV"]) && !is_numeric($_POST["thousandV"])) {
        $countErr++;
    }else {
        $thousandV = test_input($_POST["thousandV"]);
    }

    if (empty($_POST["fhundterQ"]) && !is_numeric($_POST["fhundterQ"])) {
        $countErr++;
    }else {
        $fhundterQ = test_input($_POST["fhundterQ"]);
    }

    if (empty($_POST["fhundterV"]) && !is_numeric($_POST["fhundterV"])) {
        $countErr++;
    }else {
        $fhundterV = test_input($_POST["fhundterV"]);
    }

    if (empty($_POST["thundredQ"]) && !is_numeric($_POST["thundredQ"])) {
        $countErr++;
    }else {
        $thundredQ = test_input($_POST["thundredQ"]);
    }

    if (empty($_POST["thundredV"]) && !is_numeric($_POST["thundredV"])) {
        $countErr++;
    }else {
        $thundredV = test_input($_POST["thundredV"]);
    }

    if (empty($_POST["ohundredQ"]) && !is_numeric($_POST["ohundredQ"])) {
        $countErr++;
    }else {
        $ohundredQ = test_input($_POST["ohundredQ"]);
    }

    if (empty($_POST["ohundredV"]) && !is_numeric($_POST["ohundredV"])) {
        $countErr++;
    }else {
        $ohundredV = test_input($_POST["ohundredV"]);
    }

    if (empty($_POST["ftenQ"]) && !is_numeric($_POST["ftenQ"])) {
        $countErr++;
    }else {
        $ftenQ = test_input($_POST["ftenQ"]);
    }

    if (empty($_POST["ftenV"]) && !is_numeric($_POST["ftenV"])) {
        $countErr++;
    }else {
        $ftenV = test_input($_POST["ftenV"]);
    }

    if (empty($_POST["ttenQ"]) && !is_numeric($_POST["ttenQ"])) {
        $countErr++;
    }else {
        $ttenQ = test_input($_POST["ttenQ"]);
    }

    if (empty($_POST["ttenV"]) && !is_numeric($_POST["ttenV"])) {
        $countErr++;
    }else {
        $ttenV = test_input($_POST["ttenV"]);
    }

    if (empty($_POST["fpesoQ"]) && !is_numeric($_POST["fpesoQ"])) {
        $countErr++;
    }else {
        $fpesoQ = test_input($_POST["fpesoQ"]);
    }

    if (empty($_POST["fpesoV"]) && !is_numeric($_POST["fpesoV"])) {
        $countErr++;
    }else {
        $fpesoV = test_input($_POST["fpesoV"]);
    }

    if (empty($_POST["tpesoV"]) && !is_numeric($_POST["tpesoV"])) {
        $countErr++;
    }else {
        $tpesoV = test_input($_POST["tpesoV"]);
    }

    if (empty($_POST["tpesoQ"]) && !is_numeric($_POST["tpesoQ"])) {
        $countErr++;
    }else {
        $tpesoQ = test_input($_POST["tpesoQ"]);
    }

    if (empty($_POST["fpesoQ"]) && !is_numeric($_POST["fpesoQ"])) {
        $countErr++;
    }else {
        $fpesoQ = test_input($_POST["fpesoQ"]);
    }

    if (empty($_POST["fpesoV"]) && !is_numeric($_POST["fpesoV"])) {
        $countErr++;
    }else {
        $fpesoV = test_input($_POST["fpesoV"]);
    }

    if (empty($_POST["opesoQ"]) && !is_numeric($_POST["opesoQ"])) {
        $countErr++;
    }else {
        $opesoQ = test_input($_POST["opesoQ"]);
    }

    if (empty($_POST["opesoV"]) && !is_numeric($_POST["opesoV"])) {
        $countErr++;
    }else {
        $opesoV = test_input($_POST["opesoV"]);
    }

    if (empty($_POST["cpesoQ"]) && !is_numeric($_POST["cpesoQ"])) {
        $countErr++;
    }else {
        $cpesoQ = test_input($_POST["cpesoQ"]);
    }

    if (empty($_POST["cpesoV"]) && !is_numeric($_POST["cpesoV"])) {
        $countErr++;
    }else {
        $cpesoV = test_input($_POST["cpesoV"]);
    }

    if (empty($_POST["totalCR"]) && !is_numeric($_POST["totalCR"])) {
        $countErr++;
    }else {
        $totalCR = test_input($_POST["totalCR"]);
    }

    if (!empty($_POST["startORP"])) {
        $startORP = test_input($_POST["startORP"]);
    }

    if (!empty($_POST["endORP"])) {
        $endORP = test_input($_POST["endORP"]);
    }

    if (!empty($_POST["startORPM"])) {
        $startORPM = test_input($_POST["startORPM"]);
    }

    if (!empty($_POST["endORPM"])) {
        $endORPM = test_input($_POST["endORPM"]);
    }

    if (!empty($_POST["startSRNP"])) {
        $startSRNP = test_input($_POST["startSRNP"]);
    }

    if (!empty($_POST["endSRNP"])) {
        $endSRNP = test_input($_POST["endSRNP"]);
    }

    if (!empty($_POST["startSRNPM"])) {
        $startSRNPM = test_input($_POST["startSRNPM"]);
    }

    if (!empty($_POST["endSRNPM"])) {
        $endSRNPM = test_input($_POST["endSRNPM"]);
    }

    if (!empty($_POST["clearOR"])) {
        $clearOR = test_input($_POST["clearOR"]);
    }

    if (!empty($_POST["cancelOR"])) {
        $cancelOR = test_input($_POST["cancelOR"]);
    }   

    if (!empty($_POST["cashRegister"])) {
        $cashRegister = test_input($_POST["cashRegister"]);
    }


    if ($cashRegister == "cashRegister") {
        header("Location: http://system.local/MWMMPC/home/loanPayment.php");
    }

    if($exitB = $exitB){
        session_destroy();
        header("Location: http://system.local/MWMMPC/home/login.php");
    }

    if($clearOR != ""){

        $idNumberCOR = "";

        $sqlName = "SELECT * FROM  cashier_report_table WHERE or_number = '$clearOR' ";

        $resultName = $conn->query($sqlName);
        $numRow = mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                $idNumberCOR= $row['id_number'];
            }
        }

        $sqlName = "SELECT * FROM cashier_report_table WHERE or_number = '$clearOR' and id_number = '$idNumberCOR' ";

        $resultName = $conn->query($sqlName);
        $numRow = mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                //$dateTransaction = $row['date_transaction'];

                $transactionNumber= $row['transaction_number'];
                $idNumberCOR= $row['id_number'];
                //$orNumber= $row['or_number'];
                //$totalAmount = $row['total_amount'];
                $blcr= $row['bl'];
                $cllcr= $row['cll'];
                $cmlcr= $row['cml'];
                $edlcr= $row['edl'];
                $rlcr= $row['rl'];
                $plcr= $row['pl'];
                $clcr= $row['cl'];
                $cklcr= $row['ckl'];
                $emlcr= $row['eml'];
                $slcr= $row['sl'];
                $rclcr= $row['rcl'];
                $rcccr= $row['rcc'];
                $oicr= $row['oi'];
                $sccr= $row['sc'];
                $sdcr= $row['sd'];
                $tdcr= $row['td'];
                $fdcr= $row['fd'];
                $datePayment = $row['date_transaction'];
                $encodedBy = $row['encoded_by'];

                if($blcr == 1){
                    $sqlLP1 = "DELETE FROM  bl_loan_payment_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  bl_credit_revenue_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                        echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                        echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }

                if($cllcr == 1){
                    $sqlLP1 = "DELETE FROM  cll_loan_payment_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  cll_credit_revenue_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else{ 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }

                if($cmlcr == 1){
                    $sqlLP1 = "DELETE FROM  cml_loan_payment_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  cml_credit_revenue_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    } 
                }

                if($edlcr == 1){
                   $sqlLP1 = "DELETE FROM  edl_loan_payment_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  edl_credit_revenue_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }

                if($rlcr == 1){
                    $sqlLP1 = "DELETE FROM  rl_loan_payment_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  rl_credit_revenue_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    } 
                }

                if($plcr == 1){
                    $sqlLP1 = "DELETE FROM  pl_loan_payment_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  pl_credit_revenue_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }

                if($clcr == 1){
                    $sqlLP1 = "DELETE FROM  cl_loan_payment_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }

                    /*$sql = "UPDATE cl_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumberCOR' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }*/
                }

                if($cklcr == 1){
                    $sqlLP1 = "DELETE FROM  ckl_loan_payment_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }

                    /*$sql = "UPDATE ckl_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumberCOR' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }*/
                }

                if($emlcr == 1){
                    $sqlLP1 = "DELETE FROM  eml_loan_payment_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }

                    /*$sql = "UPDATE eml_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumberCOR' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }*/
                }

                if($slcr == 1){
                    $sqlLP1 = "DELETE FROM  sl_loan_payment_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }

                    /*$sql = "UPDATE sl_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumberCOR' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }*/
                }

                if($rclcr == 1){
                    $sqlLP1 = "DELETE FROM  rice_loan_payment_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  rice_credit_revenue_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }

                    /*$sql = "UPDATE rice_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumberCOR' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }*/
                }

                if($rcccr == 1){
                    $sqlLP1 = "DELETE FROM  rice_cash_revenue_table 
                    WHERE or_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }

                if($oicr == 1){
                    $sqlLP1 = "DELETE FROM  other_income_table 
                    WHERE or_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }

                if($sccr == 1){
                    $sqlLP1 = "DELETE FROM  share_capital_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }

                if($sdcr == 1){
                    $sqlLP1 = "DELETE FROM  savings_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }

                if($tdcr == 1){
                    $sqlLP1 = "DELETE FROM  time_deposit_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }

                if($fd== 1){
                    $sqlLP1 = "DELETE FROM  fixed_deposit_table 
                    WHERE reference_number = '$clearOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }

                $sqlLP1 = "DELETE FROM  cashier_report_table 
                WHERE or_number = '$clearOR' and id_number = '$idNumberCOR' ";
                $resultLP1 = $conn->query($sqlLP1);

                if ($conn->query($sqlLP1) === TRUE) {
                   $infomessage = "Record updated successfully";
                }else { 
                      echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                }
            }
        }

        $searchReport = "searchReport";
        $clearOR = "";
        $idNumberCOR = "";
    }

    if($cancelOR != ""){

        $idNumberCOR = "";

        $sqlName = "SELECT * FROM  cashier_report_table WHERE or_number = '$cancelOR' ";

        $resultName = $conn->query($sqlName);
        $numRow = mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                $idNumberCOR= $row['id_number'];
            }
        }

        $sqlName = "SELECT * FROM cashier_report_table WHERE or_number = '$cancelOR' and id_number = '$idNumberCOR' ";

        $resultName = $conn->query($sqlName);
        $numRow = mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                //$dateTransaction = $row['date_transaction'];

                $transactionNumber= $row['transaction_number'];
                $idNumberCOR= $row['id_number'];
                //$orNumber= $row['or_number'];
                //$totalAmount = $row['total_amount'];
                $blcr= $row['bl'];
                $cllcr= $row['cll'];
                $cmlcr= $row['cml'];
                $edlcr= $row['edl'];
                $rlcr= $row['rl'];
                $plcr= $row['pl'];
                $clcr= $row['cl'];
                $cklcr= $row['ckl'];
                $emlcr= $row['eml'];
                $slcr= $row['sl'];
                $rclcr= $row['rcl'];
                $rcccr= $row['rcc'];
                $oicr= $row['oi'];
                $sccr= $row['sc'];
                $sdcr= $row['sd'];
                $tdcr= $row['td'];
                $fdcr= $row['fd'];
                $datePayment = $row['date_transaction'];
                $encodedBy = $row['encoded_by'];

                if($blcr == 1){
                    $sqlLP1 = "DELETE FROM  bl_loan_payment_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  bl_credit_revenue_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                        echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                        echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }

                if($cllcr == 1){
                    $sqlLP1 = "DELETE FROM  cll_loan_payment_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  cll_credit_revenue_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else{ 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }

                if($cmlcr == 1){
                    $sqlLP1 = "DELETE FROM  cml_loan_payment_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  cml_credit_revenue_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    } 
                }

                if($edlcr == 1){
                   $sqlLP1 = "DELETE FROM  edl_loan_payment_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  edl_credit_revenue_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }

                if($rlcr == 1){
                    $sqlLP1 = "DELETE FROM  rl_loan_payment_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  rl_credit_revenue_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    } 
                }

                if($plcr == 1){
                    $sqlLP1 = "DELETE FROM  pl_loan_payment_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  pl_credit_revenue_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }
                }

                if($clcr == 1){
                    $sqlLP1 = "DELETE FROM  cl_loan_payment_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }

                    /*$sql = "UPDATE cl_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumberCOR' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }*/
                }

                if($cklcr == 1){
                    $sqlLP1 = "DELETE FROM  ckl_loan_payment_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }

                    /*$sql = "UPDATE ckl_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumberCOR' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }*/
                }

                if($emlcr == 1){
                    $sqlLP1 = "DELETE FROM  eml_loan_payment_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }

                    /*$sql = "UPDATE eml_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumberCOR' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }*/
                }

                if($slcr == 1){
                    $sqlLP1 = "DELETE FROM  sl_loan_payment_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }

                    /*$sql = "UPDATE sl_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumberCOR' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }*/
                }

                if($rclcr == 1){
                    $sqlLP1 = "DELETE FROM  rice_loan_payment_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    $sqlLP2 = "DELETE FROM  rice_credit_revenue_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP2 = $conn->query($sqlLP2);

                    if ($conn->query($sqlLP1) === TRUE and $conn->query($sqlLP2) === TRUE) {
                       $infomessage = "Record updated successfully";
                       //echo "$infomessage";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                          echo "Error: " . $sqlLP2 . "<br>" . $conn->error;
                    }

                    /*$sql = "UPDATE rice_loan_table SET
                    loan_status = 'Released'
                    WHERE id_number = '$idNumberCOR' and loan_application_number =  '$loanApplicationNumberP' ";

                    if ($conn->query($sql) === TRUE) {
                       $infomessage = "Record updated successfully";
                    } 
                    else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                    }*/
                }

                if($rcccr == 1){
                    $sqlLP1 = "DELETE FROM  rice_cash_revenue_table 
                    WHERE or_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }

                if($oicr == 1){
                    $sqlLP1 = "DELETE FROM  other_income_table 
                    WHERE or_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }

                if($sccr == 1){
                    $sqlLP1 = "DELETE FROM  share_capital_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }

                if($sdcr == 1){
                    $sqlLP1 = "DELETE FROM  savings_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }

                if($tdcr == 1){
                    $sqlLP1 = "DELETE FROM  time_deposit_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else { 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
                }

                if($fd== 1){
                    $sqlLP1 = "DELETE FROM  fixed_deposit_table 
                    WHERE reference_number = '$cancelOR' and id_number = '$idNumberCOR' ";
                    $resultLP1 = $conn->query($sqlLP1);

                    if ($conn->query($sqlLP1) === TRUE) {
                       $infomessage = "Record updated successfully";
                    }else{ 
                          echo "Error: " . $sqlLP1 . "<br>" . $conn->error;
                    }
   
                }

                $sql = "UPDATE cashier_report_table SET
                id_number = 'CANCELLED',
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
                WHERE or_number = '$cancelOR' and id_number = '$idNumberCOR' ";

                if ($conn->query($sql) === TRUE) {
                   $infomessage = "Record updated successfully";
                }else { 
                      echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }


        $searchReport = "searchReport";
        $clearOR = "";
        $idNumberCOR = "";
    }

    if($remitCollection == "remitCollection"){
        if($countErr <= 0){
            $remitStatus = 0;
            if($startSRN != "" and $endSRN!= ""){
                $remitStatus = 1;
            }

            echo "$tpesoV";

            $sql = "INSERT INTO remit_table(reference_status, starting_srn, ending_srn ,date_transaction, am_pm,starting_or, ending_or,tq, tv,fhq, fhv, thq, thv, ohq, ohv, ftq, ftv, twq, twv, tnq, tnv, fvq, fvv, opq, opv, cnq, cnv, total_remit) 
                VALUES ('$remitStatus', '$startSRN' , '$endSRN' ,'$dateRemit','$am_pm','$startOR','$endOR','$thousandQ', '$thousandV', '$fhundterQ', '$fhundterV', '$thundredQ', '$thundredV', '$ohundredQ', '$ohundredV', '$ftenQ', '$ftenV', '$ttenQ', '$ttenV', '$tpesoQ', '$tpesoV', '$fpesoQ', '$fpesoV', '$opesoQ', '$opesoV', '$cpesoQ', '$cpesoV', $totalCR)";

            if ($conn->query($sql) === TRUE){
                $informessage = "Collection Remit";
                $remitStatus = 0;
                $startSRN = "";
                $endSRN = "";
                $dateRemit = "";
                $am_pm = "";
                $startOR = "";
                $endOR = "";
                $thousandQ = 0;
                $thousandV = 0;
                $fhundterQ = 0;
                $fhundterV = 0;
                $thundredQ = 0;
                $thundredV = 0;
                $ohundredQ = 0;
                $ohundredV = 0;
                $ftenQ = 0;
                $ftenV = 0;
                $ttenQ = 0;
                $ttenV = 0;
                $tpesoQ = 0;
                $tpesoV = 0;
                $fpesoQ = 0;
                $fpesoV = 0;
                $opesoQ = 0;
                $opesoV = 0;
                $cpesoQ = 0;
                $cpesoV = 0;
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }else{
            $informessage = "Fill Up Empty Field";
        }
    }

    if($searchReport == "searchReport" OR $printAM == "printAM" OR $printPM == "printPM" OR $showAM == "showAM" OR $showPM == "showPM" OR $printSummary == "printSummary"){

        $dateRemit = $dateToday;

        $sqlName = "SELECT * FROM  remit_table WHERE date_transaction = '$dateToday' and  am_pm = 'AM' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);
        //$counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                $startSRNP = $row['starting_srn'];
                $endSRNP = $row['ending_srn'];
                $startORP = $row['starting_or'];
                $endORP = $row['ending_or'];
                $thousandQP = $row['tq'];
                $thousandVP = $row['tv'];
                $fhundterQP = $row['fhq'];
                $fhundterVP = $row['fhv'];
                $thundredQP = $row['thq'];
                $thundredVP = $row['thv'];
                $ohundredQP = $row['ohq'];
                $ohundredVP = $row['ohv'];
                $ftenQP = $row['ftq'];
                $ftenVP = $row['ftv'];
                $ttenQP = $row['twq'];
                $ttenVP = $row['twv'];
                $tpesoQP = $row['tnq'];
                $tpesoVP = $row['tnv'];
                $fpesoQP = $row['fvq'];
                $fpesoVP = $row['fvv'];
                $opesoQP = $row['opq'];
                $opesoVP = $row['opv'];
                $cpesoQP = $row['cnq'];
                $cpesoVP = $row['cnv'];
                $totalCRP = $row['total_remit'];

            }
        }else{
            $startORP = "";
            $endORP = "";
            $thousandQP = 0;
            $thousandVP = 0;
            $fhundterQP = 0;
            $fhundterVP = 0;
            $thundredQP = 0;
            $thundredVP = 0;
            $ohundredQP = 0;
            $ohundredVP = 0;
            $ftenQP = 0;
            $ftenVP = 0;
            $ttenQP = 0;
            $ttenVP = 0;
            $tpesoQP = 0;
            $tpesoVP = 0;
            $fpesoQP = 0;
            $fpesoVP = 0;
            $opesoQP = 0;
            $opesoVP = 0;
            $cpesoVP = 0;
            $cpesoQP = 0;
            $totalCRP = 0;
        }

        $sqlName = "SELECT * FROM  remit_table WHERE date_transaction = '$dateToday' and  am_pm = 'PM' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);
        //$counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                $startSRNPM = $row['starting_srn'];
                $endSRNPM = $row['ending_srn'];
                $startORPM = $row['starting_or'];
                $endORPM = $row['ending_or'];
                $thousandQPM = $row['tq'];
                $thousandVPM = $row['tv'];
                $fhundterQPM = $row['fhq'];
                $fhundterVPM = $row['fhv'];
                $thundredQPM = $row['thq'];
                $thundredVPM = $row['thv'];
                $ohundredQPM = $row['ohq'];
                $ohundredVPM = $row['ohv'];
                $ftenQPM = $row['ftq'];
                $ftenVPM = $row['ftv'];
                $ttenQPM = $row['twq'];
                $ttenVPM = $row['twv'];
                $tpesoQPM = $row['tnq'];
                $tpesoVPM = $row['tnv'];
                $fpesoQPM = $row['fvq'];
                $fpesoVPM = $row['fvv'];
                $opesoQPM = $row['opq'];
                $opesoVPM = $row['opv'];
                $cpesoQPM = $row['cnq'];
                $cpesoVPM = $row['cnv'];
                $totalCRPM = $row['total_remit'];

            }
        }else{
            $startORPM = "";
            $endORPM = "";
            $thousandQPM = 0;
            $thousandVPM = 0;
            $fhundterQPM = 0;
            $fhundterVPM = 0;
            $thundredQPM = 0;
            $thundredVPM = 0;
            $ohundredQPM= 0;
            $ohundredVPM = 0;
            $ftenQPM = 0;
            $ftenVPM = 0;
            $ttenQPM = 0;
            $ttenVPM = 0;
            $tpesoQPM = 0;
            $tpesoVPM = 0;
            $fpesoQPM = 0;
            $fpesoVPM = 0;
            $opesoQPM = 0;
            $opesoVPM = 0;
            $cpesoVPM = 0;
            $cpesoQPM = 0;
            $totalCRPM = 0;
        }
        
        if($showAM == "showAM" or $printAM == "printAM"){
            $sqlName = "SELECT * FROM  cashier_report_table WHERE date_transaction = '$dateToday' and or_number >= '$startORP' and or_number <= '$endORP'  order by or_number asc";

            $resultName = $conn->query($sqlName);
            $numRow = mysqli_num_rows($resultName);
            $counter = 0;

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    # code...
                    $transactionNumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $orNumber[$counter] = $row['or_number'];
                    $invoiceNumber[$counter] = $row['invoice_number'];
                    $totalAmount[$counter] = $row['total_amount'];
                    $bl[$counter] = $row['bl'];
                    $cll[$counter] = $row['cll'];
                    $cml[$counter] = $row['cml'];
                    $edl[$counter] = $row['edl'];
                    $rl[$counter] = $row['rl'];
                    $pl[$counter] = $row['pl'];
                    $cl[$counter] = $row['cl'];
                    $ckl[$counter] = $row['ckl'];
                    $eml[$counter] = $row['eml'];
                    $sl[$counter] = $row['sl'];
                    $rcl[$counter] = $row['rcl'];
                    $rcc[$counter] = $row['rcc'];
                    $oi[$counter] = $row['oi'];
                    $sc[$counter] = $row['sc'];
                    $sd[$counter] = $row['sd'];
                    $td[$counter] = $row['td'];
                    $fd[$counter] = $row['fd'];
                    $dateTransaction[$counter] = $row['date_transaction'];
                    $encodedBy[$counter] = $row['encoded_by'];
                    $typePayment[$counter] = $row['payment_type'];

                    if($bl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  bl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter] ";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  bl_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and  payment_count = $invoiceNumber[$counter] ";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $blValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $bliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $blValue[$counter] = 0;
                        $bliValue[$counter] = 0;
                    }

                    if($cll[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  cll_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  cll_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $cllValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $clliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $cllValue[$counter] = 0;
                        $clliValue[$counter] = 0;
                    }

                    if($cml[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  cml_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  cml_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $cmlValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $cmliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $cmlValue[$counter] = 0;
                        $cmliValue[$counter] = 0;
                    }

                    if($edl[$counter] == 1){
                       $sqlLP1 = "SELECT * FROM  edl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  edl_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $edlValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $edliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $edlValue[$counter] = 0;
                        $edliValue[$counter] = 0;
                    }

                    if($rl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  rl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  rl_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $rlValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $rliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $rlValue[$counter] = 0;
                        $rliValue[$counter] = 0;
                    }

                    if($pl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  pl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  pl_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            $plValueTemp = 0;
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                //$plValueTemp = $plValueTemp + $row['amount'];
                                $plValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            $pliValueTemp = 0;
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                //$pliValueTemp = $pliValueTemp + $row['interest_revenue'];
                                $pliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $plValue[$counter] = 0;
                        $pliValue[$counter] = 0;
                    }

                    if($cl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  cl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $clValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $clValue[$counter] = 0;
                    }

                    if($ckl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  ckl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $cklValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $cklValue[$counter] = 0;
                    }

                    if($eml[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  eml_loan_payment_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $emlValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $emlValue[$counter] = 0;
                    }

                    if($sl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  sl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $slValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $slValue[$counter] = 0 ;
                    }

                    if($rcl[$counter] == 1){

                        $rclapn = "";
                        $sqlIN = "SELECT * FROM  rice_loan_table WHERE invoice_number = '$invoiceNumber[$counter]' and id_number = '$idNumber[$counter]'";
                        $resultIN = $conn->query($sqlIN);

                        if($resultIN->num_rows > 0){
                            while ($rowIN = mysqli_fetch_array($resultIN)) {
                                $rclapn = $rowIN['loan_application_number'];
                            }
                        }else{
                            $invoiceNumberL[$counter] = "";
                        }

                        $sqlLP1 = "SELECT * FROM  rice_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and loan_application_number = '$rclapn' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  rice_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and loan_application_number = '$rclapn' ";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $rclValue[$counter] = $row['amount'];

                                /*$rclapn = "";
                                $rclapn = $row['loan_application_number'];

                                echo "$rclapn";

                                $sqlIN = "SELECT * FROM  rice_loan_table WHERE loan_application_number = '$rclapn' ";
                                $resultIN = $conn->query($sqlIN);

                                if($resultIN->num_rows > 0){
                                    while ($rowIN = mysqli_fetch_array($resultIN)) {
                                        $invoiceNumberL[$counter] = $rowIN['invoice_number'];
                                    }
                                }else{
                                    $invoiceNumberL[$counter] = "";
                                }*/
                            }
                        }else{
                            $rclValue[$counter] = 0;
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $rcliValue[$counter] = $row['interest_revenue'];
                                //$invoiceNumberL[$counter] = $row['voucher_number'];
                            }
                        }else{
                            $rcliValue[$counter] = 0;
                        }
                    }else{
                        $rclValue[$counter] = 0;
                        $rcliValue[$counter] = 0;
                        //$invoiceNumberL[$counter] = "";
                    }

                    if($rcc[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  rice_cash_revenue_table WHERE or_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $invoiceNumberC[$counter] = $row['invoice_number'];
                                $rccValue[$counter] = $row['principal_amount'];
                                $rcciValue[$counter] = $row['interest_amount'];
                            }
                        }
                    }else{
                        $invoiceNumberC[$counter] = "";
                        $rccValue[$counter] = 0;
                        $rcciValue[$counter] = 0;
                    }

                    if($oi[$counter] == 1){
                        /*$oiValueTemp = 0;
                        $penaltyLoan[] = 0;
                        $penaltyRice[] = 0;
                        $RentalIncome[] = 0;

                        $membership[] = 0;
                        $miscellaneous[] = 0;
                        $insurance[] = 0;
                        $transferFee[] = 0;*/

                        $oiStat = 0;
                        $plStat = 0;
                        $prStat = 0;
                        $riStat = 0;

                        $mbsStat = 0;
                        $mscStat = 0;
                        $insStat = 0;
                        $trfStat = 0;



                        $sqlLP1 = "SELECT * FROM  other_income_table WHERE or_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                if ($row['income_code'] == "pnti"){
                                    //echo "string";
                                    $penaltyRice[$counter] = $row['amount'];
                                    $prStat = 1;
                                }elseif ($row['income_code'] == "plti") {
                                    $penaltyLoan[$counter] = $row['amount'];
                                    $plStat = 1;
                                }elseif ($row['income_code'] == "rnti") {
                                    $RentalIncome[$counter] = $row['amount'];
                                    $riStat = 1;
                                }elseif ($row['income_code'] == "mbsi") {
                                    $membership[$counter] = $row['amount'];
                                    $mbsStat = 1;
                                }elseif ($row['income_code'] == "msli") {
                                    $miscellaneous[$counter] = $row['amount'];
                                    $mscStat = 1;
                                }elseif ($row['income_code'] == "tffi") {
                                    $transferFee[$counter] = $row['amount'];
                                    $trfStat = 1;
                                }elseif ($row['income_code'] == "insi") {
                                    $insurance[$counter] = $row['amount'];
                                    $insStat = 1;
                                }else{
                                    //$oiValueTemp = $oiValueTemp + $row['amount'];
                                    $oiValue[$counter] = $row['amount'];
                                    $oiStat = 1;
                                }
                            }
                        }

                        if($oiStat == 0){
                            $oiValue[$counter] = 0;
                        }

                        if($plStat == 0){
                            $penaltyLoan[$counter] = 0;
                        }

                        if($prStat == 0){
                            $penaltyRice[$counter] = 0;
                        }

                        if($riStat == 0){
                            $RentalIncome[$counter] = 0;
                        }

                        if($mbsStat == 0){
                            $membership[$counter] = 0;
                        }

                        if($mscStat == 0){
                            $miscellaneous[$counter] = 0;
                        }

                        if($trfStat == 0){
                            $transferFee[$counter] = 0;
                        }

                        if($insStat == 0){
                            $insurance[$counter] = 0;
                        }
                    }else{
                        $oiValue[$counter] = 0;
                        $penaltyLoan[$counter] = 0;
                        $penaltyRice[$counter] = 0;
                        $RentalIncome[$counter] = 0;

                        $membership[$counter] = 0;
                        $miscellaneous[$counter] = 0;
                        $insurance[$counter] = 0;
                        $transferFee[$counter] = 0;
                    }

                    if($sc[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  share_capital_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $scValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                         $scValue[$counter] = 0;
                    }

                    if($sd[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  savings_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $sdValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $sdValue[$counter] = 0;
                    }

                    if($td[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  time_deposit_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $tdValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $tdValue[$counter] = 0;
                    }

                    if($fd[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  fixed_deposit_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $fdValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $fdValue[$counter] = 0;   
                    }

                    if($idNumber[$counter] != "CANCEL"){
                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' order by last_name asc ";
                            $resultLS = $conn->query($sqlLS);
                            //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){

                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                //$idNumberS[$counter] = $row['id_number'];
                                $firstName[$counter] = $row['first_name'];
                                $middleName[$counter] = $row['middle_name'];
                                $lastName[$counter] = $row['last_name'];
                            }
                        }
                    }else{
                        $firstName[$counter] = "";
                        $middleName[$counter] = "";
                        $lastName[$counter] = "";
                    }

                    $counter++;
                }
            }

            $sqlName = "SELECT * FROM  cashier_withdraw_table WHERE date_transaction = '$dateToday' and or_number >= '$startSRNP' and or_number <= '$endSRNP'  order by or_number asc";

            $resultName = $conn->query($sqlName);
            $numRowWithdraw = mysqli_num_rows($resultName);
            $counterWithdraw = 0;

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    # code...
                    $transactionNumberW[$counterWithdraw] = $row['transaction_number'];
                    $idNumberW[$counterWithdraw] = $row['id_number'];
                    $orNumberW[$counterWithdraw] = $row['or_number'];
                    $totalAmountW[$counterWithdraw] = $row['total_amount'];

                    $scW[$counterWithdraw] = $row['cbuw'];
                    $sdW[$counterWithdraw] = $row['sdw'];
                    $tdW[$counterWithdraw] = $row['tdw'];
                    $fdW[$counterWithdraw] = $row['fdw'];

                    $dateTransactionW[$counterWithdraw] = $row['date_transaction'];
                    $encodedByW[$counterWithdraw] = $row['encoded_by'];
                    $typePaymentW[$counterWithdraw] = $row['payment_type'];

                    if($scW[$counterWithdraw] == 1){
                        $sqlLP1 = "SELECT * FROM  share_capital_table WHERE reference_number = '$orNumberW[$counterWithdraw]' and type_transaction = 'Withdraw' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $scValueW[$counterWithdraw] = $row['amount'];
                            }
                        }
                    }else{
                         $scValueW[$counterWithdraw] = 0;
                    }

                    if($sdW[$counterWithdraw] == 1){
                        $sqlLP1 = "SELECT * FROM  savings_table WHERE reference_number = '$orNumberW[$counterWithdraw]' and type_transaction = 'Withdraw'";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $sdValueW[$counterWithdraw] = $row['amount'];
                            }
                        }
                    }else{
                        $sdValueW[$counterWithdraw] = 0;
                    }

                    if($tdW[$counterWithdraw] == 1){
                        $sqlLP1 = "SELECT * FROM  time_deposit_table WHERE reference_number = '$orNumberW[$counterWithdraw]' and type_transaction = 'Withdraw'";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $tdValueW[$counterWithdraw] = $row['amount'];
                            }
                        }
                    }else{
                        $tdValueW[$counterWithdraw] = 0;
                    }

                    if($fdW[$counterWithdraw] == 1){
                        $sqlLP1 = "SELECT * FROM  fixed_deposit_table WHERE reference_number = '$orNumberW[$counterWithdraw]' and type_transaction = 'Withdraw'";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $fdValueW[$counterWithdraw] = $row['amount'];
                            }
                        }
                    }else{
                        $fdValueW[$counterWithdraw] = 0;   
                    }

                    $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumberW[$counterWithdraw]' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            //$idNumberS[$counter] = $row['id_number'];
                            $firstNameW[$counterWithdraw] = $row['first_name'];
                            $middleNameW[$counterWithdraw] = $row['middle_name'];
                            $lastNameW[$counterWithdraw] = $row['last_name'];
                        }
                    }

                    $counterWithdraw++;
                }
            }
        }elseif($showPM == "showPM" or $printPM == "printPM"){
            $lastORAM = "";
            $sqlgetLastOR = "SELECT * FROM  remit_table WHERE date_transaction = '$dateToday' and am_pm = 'AM' ";
            $resultNamegetLastOR = $conn->query($sqlgetLastOR);

            if($resultNamegetLastOR->num_rows > 0){
                while ($rowgetLastOR = mysqli_fetch_array($resultNamegetLastOR)) {
                    $lastORAM = $rowgetLastOR['ending_or'];
                }
            }
            //$numRow = mysqli_num_rows($resultName);
            //$counter = 0;

            $sqlName = "SELECT * FROM  cashier_report_table WHERE (date_transaction = '$dateToday') and (or_number > '$lastORAM') order by or_number asc";

            $resultName = $conn->query($sqlName);
            $numRow = mysqli_num_rows($resultName);
            $counter = 0;

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    # code...
                    $transactionNumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $orNumber[$counter] = $row['or_number'];
                    $invoiceNumber[$counter] = $row['invoice_number'];
                    $totalAmount[$counter] = $row['total_amount'];
                    $bl[$counter] = $row['bl'];
                    $cll[$counter] = $row['cll'];
                    $cml[$counter] = $row['cml'];
                    $edl[$counter] = $row['edl'];
                    $rl[$counter] = $row['rl'];
                    $pl[$counter] = $row['pl'];
                    $cl[$counter] = $row['cl'];
                    $ckl[$counter] = $row['ckl'];
                    $eml[$counter] = $row['eml'];
                    $sl[$counter] = $row['sl'];
                    $rcl[$counter] = $row['rcl'];
                    $rcc[$counter] = $row['rcc'];
                    $oi[$counter] = $row['oi'];
                    $sc[$counter] = $row['sc'];
                    $sd[$counter] = $row['sd'];
                    $td[$counter] = $row['td'];
                    $fd[$counter] = $row['fd'];
                    $dateTransaction[$counter] = $row['date_transaction'];
                    $encodedBy[$counter] = $row['encoded_by'];
                    $typePayment[$counter] = $row['payment_type'];

                    if($bl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  bl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter] ";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  bl_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and  payment_count = $invoiceNumber[$counter] ";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $blValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $bliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $blValue[$counter] = 0;
                        $bliValue[$counter] = 0;
                    }

                    if($cll[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  cll_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  cll_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $cllValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $clliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $cllValue[$counter] = 0;
                        $clliValue[$counter] = 0;
                    }

                    if($cml[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  cml_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  cml_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $cmlValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $cmliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $cmlValue[$counter] = 0;
                        $cmliValue[$counter] = 0;
                    }

                    if($edl[$counter] == 1){
                       $sqlLP1 = "SELECT * FROM  edl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  edl_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $edlValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $edliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $edlValue[$counter] = 0;
                        $edliValue[$counter] = 0;
                    }

                    if($rl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  rl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  rl_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $rlValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $rliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $rlValue[$counter] = 0;
                        $rliValue[$counter] = 0;
                    }

                    if($pl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  pl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  pl_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            $plValueTemp = 0;
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                //$plValueTemp = $plValueTemp + $row['amount'];
                                $plValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            $pliValueTemp = 0;
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                //$pliValueTemp = $pliValueTemp + $row['interest_revenue'];
                                $pliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $plValue[$counter] = 0;
                        $pliValue[$counter] = 0;
                    }

                    if($cl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  cl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $clValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $clValue[$counter] = 0;
                    }

                    if($ckl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  ckl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $cklValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $cklValue[$counter] = 0;
                    }

                    if($eml[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  eml_loan_payment_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $emlValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $emlValue[$counter] = 0;
                    }

                    if($sl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  sl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $slValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $slValue[$counter] = 0 ;
                    }

                    if($rcl[$counter] == 1){

                        $rclapn = "";
                        $sqlIN = "SELECT * FROM  rice_loan_table WHERE invoice_number = '$invoiceNumber[$counter]' and id_number = '$idNumber[$counter]'";
                        $resultIN = $conn->query($sqlIN);

                        if($resultIN->num_rows > 0){
                            while ($rowIN = mysqli_fetch_array($resultIN)) {
                                $rclapn = $rowIN['loan_application_number'];
                            }
                        }else{
                            $invoiceNumberL[$counter] = "";
                        }

                        $sqlLP1 = "SELECT * FROM  rice_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and loan_application_number = '$rclapn' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  rice_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and loan_application_number = '$rclapn' ";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $rclValue[$counter] = $row['amount'];

                                /*$rclapn = "";
                                $rclapn = $row['loan_application_number'];

                                echo "$rclapn";

                                $sqlIN = "SELECT * FROM  rice_loan_table WHERE loan_application_number = '$rclapn' ";
                                $resultIN = $conn->query($sqlIN);

                                if($resultIN->num_rows > 0){
                                    while ($rowIN = mysqli_fetch_array($resultIN)) {
                                        $invoiceNumberL[$counter] = $rowIN['invoice_number'];
                                    }
                                }else{
                                    $invoiceNumberL[$counter] = "";
                                }*/
                            }
                        }else{
                            $rclValue[$counter] = 0;
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $rcliValue[$counter] = $row['interest_revenue'];
                                //$invoiceNumberL[$counter] = $row['voucher_number'];
                            }
                        }else{
                            $rcliValue[$counter] = 0;
                        }
                    }else{
                        $rclValue[$counter] = 0;
                        $rcliValue[$counter] = 0;
                        //$invoiceNumberL[$counter] = "";
                    }

                    if($rcc[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  rice_cash_revenue_table WHERE or_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $invoiceNumberC[$counter] = $row['invoice_number'];
                                $rccValue[$counter] = $row['principal_amount'];
                                $rcciValue[$counter] = $row['interest_amount'];
                            }
                        }
                    }else{
                        $invoiceNumberC[$counter] = "";
                        $rccValue[$counter] = 0;
                        $rcciValue[$counter] = 0;
                    }

                    if($oi[$counter] == 1){
                        /*$oiValueTemp = 0;
                        $penaltyLoan[] = 0;
                        $penaltyRice[] = 0;
                        $RentalIncome[] = 0;

                        $membership[] = 0;
                        $miscellaneous[] = 0;
                        $insurance[] = 0;
                        $transferFee[] = 0;*/

                        $oiStat = 0;
                        $plStat = 0;
                        $prStat = 0;
                        $riStat = 0;

                        $mbsStat = 0;
                        $mscStat = 0;
                        $insStat = 0;
                        $trfStat = 0;



                        $sqlLP1 = "SELECT * FROM  other_income_table WHERE or_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                if ($row['income_code'] == "pnti"){
                                    //echo "string";
                                    $penaltyRice[$counter] = $row['amount'];
                                    $prStat = 1;
                                }elseif ($row['income_code'] == "plti") {
                                    $penaltyLoan[$counter] = $row['amount'];
                                    $plStat = 1;
                                }elseif ($row['income_code'] == "rnti") {
                                    $RentalIncome[$counter] = $row['amount'];
                                    $riStat = 1;
                                }elseif ($row['income_code'] == "mbsi") {
                                    $membership[$counter] = $row['amount'];
                                    $mbsStat = 1;
                                }elseif ($row['income_code'] == "msli") {
                                    $miscellaneous[$counter] = $row['amount'];
                                    $mscStat = 1;
                                }elseif ($row['income_code'] == "tffi") {
                                    $transferFee[$counter] = $row['amount'];
                                    $trfStat = 1;
                                }elseif ($row['income_code'] == "insi") {
                                    $insurance[$counter] = $row['amount'];
                                    $insStat = 1;
                                }else{
                                    //$oiValueTemp = $oiValueTemp + $row['amount'];
                                    $oiValue[$counter] = $row['amount'];
                                    $oiStat = 1;
                                }
                            }
                        }

                        if($oiStat == 0){
                            $oiValue[$counter] = 0;
                        }

                        if($plStat == 0){
                            $penaltyLoan[$counter] = 0;
                        }

                        if($prStat == 0){
                            $penaltyRice[$counter] = 0;
                        }

                        if($riStat == 0){
                            $RentalIncome[$counter] = 0;
                        }

                        if($mbsStat == 0){
                            $membership[$counter] = 0;
                        }

                        if($mscStat == 0){
                            $miscellaneous[$counter] = 0;
                        }

                        if($trfStat == 0){
                            $transferFee[$counter] = 0;
                        }

                        if($insStat == 0){
                            $insurance[$counter] = 0;
                        }
                    }else{
                        $oiValue[$counter] = 0;
                        $penaltyLoan[$counter] = 0;
                        $penaltyRice[$counter] = 0;
                        $RentalIncome[$counter] = 0;

                        $membership[$counter] = 0;
                        $miscellaneous[$counter] = 0;
                        $insurance[$counter] = 0;
                        $transferFee[$counter] = 0;
                    }

                    if($sc[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  share_capital_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $scValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                         $scValue[$counter] = 0;
                    }

                    if($sd[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  savings_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $sdValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $sdValue[$counter] = 0;
                    }

                    if($td[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  time_deposit_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $tdValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $tdValue[$counter] = 0;
                    }

                    if($fd[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  fixed_deposit_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $fdValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $fdValue[$counter] = 0;   
                    }

                    if($idNumber[$counter] != "CANCEL"){
                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' order by last_name asc ";
                            $resultLS = $conn->query($sqlLS);
                            //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){

                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                //$idNumberS[$counter] = $row['id_number'];
                                $firstName[$counter] = $row['first_name'];
                                $middleName[$counter] = $row['middle_name'];
                                $lastName[$counter] = $row['last_name'];
                            }
                        }
                    }else{
                        $firstName[$counter] = "";
                        $middleName[$counter] = "";
                        $lastName[$counter] = "";
                    }

                    $counter++;
                }
            }

            $sqlName = "SELECT * FROM  cashier_withdraw_table WHERE (date_transaction = '$dateToday') and (or_number > '$lastORAM')  order by or_number asc";

            $resultName = $conn->query($sqlName);
            $numRowWithdraw = mysqli_num_rows($resultName);
            $counterWithdraw = 0;

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    # code...
                    $transactionNumberW[$counterWithdraw] = $row['transaction_number'];
                    $idNumberW[$counterWithdraw] = $row['id_number'];
                    $orNumberW[$counterWithdraw] = $row['or_number'];
                    $totalAmountW[$counterWithdraw] = $row['total_amount'];

                    $scW[$counterWithdraw] = $row['cbuw'];
                    $sdW[$counterWithdraw] = $row['sdw'];
                    $tdW[$counterWithdraw] = $row['tdw'];
                    $fdW[$counterWithdraw] = $row['fdw'];

                    $dateTransactionW[$counterWithdraw] = $row['date_transaction'];
                    $encodedByW[$counterWithdraw] = $row['encoded_by'];
                    $typePaymentW[$counterWithdraw] = $row['payment_type'];

                    if($scW[$counterWithdraw] == 1){
                        $sqlLP1 = "SELECT * FROM  share_capital_table WHERE reference_number = '$orNumberW[$counterWithdraw]' and type_transaction = 'Withdraw' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $scValueW[$counterWithdraw] = $row['amount'];
                            }
                        }
                    }else{
                         $scValueW[$counterWithdraw] = 0;
                    }

                    if($sdW[$counterWithdraw] == 1){
                        $sqlLP1 = "SELECT * FROM  savings_table WHERE reference_number = '$orNumberW[$counterWithdraw]' and type_transaction = 'Withdraw'";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $sdValueW[$counterWithdraw] = $row['amount'];
                            }
                        }
                    }else{
                        $sdValueW[$counterWithdraw] = 0;
                    }

                    if($tdW[$counterWithdraw] == 1){
                        $sqlLP1 = "SELECT * FROM  time_deposit_table WHERE reference_number = '$orNumberW[$counterWithdraw]' and type_transaction = 'Withdraw'";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $tdValueW[$counterWithdraw] = $row['amount'];
                            }
                        }
                    }else{
                        $tdValueW[$counterWithdraw] = 0;
                    }

                    if($fdW[$counterWithdraw] == 1){
                        $sqlLP1 = "SELECT * FROM  fixed_deposit_table WHERE reference_number = '$orNumberW[$counterWithdraw]' and type_transaction = 'Withdraw'";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $fdValueW[$counterWithdraw] = $row['amount'];
                            }
                        }
                    }else{
                        $fdValueW[$counterWithdraw] = 0;   
                    }

                    $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumberW[$counterWithdraw]' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            //$idNumberS[$counter] = $row['id_number'];
                            $firstNameW[$counterWithdraw] = $row['first_name'];
                            $middleNameW[$counterWithdraw] = $row['middle_name'];
                            $lastNameW[$counterWithdraw] = $row['last_name'];
                        }
                    }

                    $counterWithdraw++;
                }
            }
        }else{
            $sqlName = "SELECT * FROM  cashier_report_table WHERE date_transaction = '$dateToday' order by or_number asc";

            $resultName = $conn->query($sqlName);
            $numRow = mysqli_num_rows($resultName);
            $counter = 0;

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    # code...
                    $transactionNumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $orNumber[$counter] = $row['or_number'];
                    $invoiceNumber[$counter] = $row['invoice_number'];
                    $totalAmount[$counter] = $row['total_amount'];
                    $bl[$counter] = $row['bl'];
                    $cll[$counter] = $row['cll'];
                    $cml[$counter] = $row['cml'];
                    $edl[$counter] = $row['edl'];
                    $rl[$counter] = $row['rl'];
                    $pl[$counter] = $row['pl'];
                    $cl[$counter] = $row['cl'];
                    $ckl[$counter] = $row['ckl'];
                    $eml[$counter] = $row['eml'];
                    $sl[$counter] = $row['sl'];
                    $rcl[$counter] = $row['rcl'];
                    $rcc[$counter] = $row['rcc'];
                    $oi[$counter] = $row['oi'];
                    $sc[$counter] = $row['sc'];
                    $sd[$counter] = $row['sd'];
                    $td[$counter] = $row['td'];
                    $fd[$counter] = $row['fd'];
                    $dateTransaction[$counter] = $row['date_transaction'];
                    $encodedBy[$counter] = $row['encoded_by'];
                    $typePayment[$counter] = $row['payment_type'];

                    if($bl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  bl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter] ";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  bl_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and  payment_count = $invoiceNumber[$counter] ";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $blValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $bliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $blValue[$counter] = 0;
                        $bliValue[$counter] = 0;
                    }

                    if($cll[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  cll_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  cll_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $cllValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $clliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $cllValue[$counter] = 0;
                        $clliValue[$counter] = 0;
                    }

                    if($cml[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  cml_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  cml_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $cmlValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $cmliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $cmlValue[$counter] = 0;
                        $cmliValue[$counter] = 0;
                    }

                    if($edl[$counter] == 1){
                       $sqlLP1 = "SELECT * FROM  edl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  edl_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $edlValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $edliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $edlValue[$counter] = 0;
                        $edliValue[$counter] = 0;
                    }

                    if($rl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  rl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  rl_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $rlValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $rliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $rlValue[$counter] = 0;
                        $rliValue[$counter] = 0;
                    }

                    if($pl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  pl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  pl_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and payment_count = $invoiceNumber[$counter]";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            $plValueTemp = 0;
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                //$plValueTemp = $plValueTemp + $row['amount'];
                                $plValue[$counter] = $row['amount'];
                            }
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            $pliValueTemp = 0;
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                //$pliValueTemp = $pliValueTemp + $row['interest_revenue'];
                                $pliValue[$counter] = $row['interest_revenue'];
                            }
                        }
                    }else{
                        $plValue[$counter] = 0;
                        $pliValue[$counter] = 0;
                    }

                    if($cl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  cl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $clValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $clValue[$counter] = 0;
                    }

                    if($ckl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  ckl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $cklValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $cklValue[$counter] = 0;
                    }

                    if($eml[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  eml_loan_payment_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $emlValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $emlValue[$counter] = 0;
                    }

                    if($sl[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  sl_loan_payment_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $slValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $slValue[$counter] = 0 ;
                    }

                    if($rcl[$counter] == 1){

                        $rclapn = "";
                        $sqlIN = "SELECT * FROM  rice_loan_table WHERE invoice_number = '$invoiceNumber[$counter]' and id_number = '$idNumber[$counter]'";
                        $resultIN = $conn->query($sqlIN);

                        if($resultIN->num_rows > 0){
                            while ($rowIN = mysqli_fetch_array($resultIN)) {
                                $rclapn = $rowIN['loan_application_number'];
                            }
                        }else{
                            $invoiceNumberL[$counter] = "";
                        }

                        $sqlLP1 = "SELECT * FROM  rice_loan_payment_table WHERE reference_number = '$orNumber[$counter]' and loan_application_number = '$rclapn' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        $sqlLP2 = "SELECT * FROM  rice_credit_revenue_table WHERE reference_number = '$orNumber[$counter]' and loan_application_number = '$rclapn' ";
                        $resultLP2 = $conn->query($sqlLP2);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $rclValue[$counter] = $row['amount'];

                                /*$rclapn = "";
                                $rclapn = $row['loan_application_number'];

                                echo "$rclapn";

                                $sqlIN = "SELECT * FROM  rice_loan_table WHERE loan_application_number = '$rclapn' ";
                                $resultIN = $conn->query($sqlIN);

                                if($resultIN->num_rows > 0){
                                    while ($rowIN = mysqli_fetch_array($resultIN)) {
                                        $invoiceNumberL[$counter] = $rowIN['invoice_number'];
                                    }
                                }else{
                                    $invoiceNumberL[$counter] = "";
                                }*/
                            }
                        }else{
                            $rclValue[$counter] = 0;
                        }

                        //Interest
                        if($resultLP2->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP2)) {
                                # code...
                                $rcliValue[$counter] = $row['interest_revenue'];
                                //$invoiceNumberL[$counter] = $row['voucher_number'];
                            }
                        }else{
                            $rcliValue[$counter] = 0;
                        }
                    }else{
                        $rclValue[$counter] = 0;
                        $rcliValue[$counter] = 0;
                        //$invoiceNumberL[$counter] = "";
                    }

                    if($rcc[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  rice_cash_revenue_table WHERE or_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $invoiceNumberC[$counter] = $row['invoice_number'];
                                $rccValue[$counter] = $row['principal_amount'];
                                $rcciValue[$counter] = $row['interest_amount'];
                            }
                        }
                    }else{
                        $invoiceNumberC[$counter] = "";
                        $rccValue[$counter] = 0;
                        $rcciValue[$counter] = 0;
                    }

                    if($oi[$counter] == 1){
                        /*$oiValueTemp = 0;
                        $penaltyLoan[] = 0;
                        $penaltyRice[] = 0;
                        $RentalIncome[] = 0;

                        $membership[] = 0;
                        $miscellaneous[] = 0;
                        $insurance[] = 0;
                        $transferFee[] = 0;*/

                        $oiStat = 0;
                        $plStat = 0;
                        $prStat = 0;
                        $riStat = 0;

                        $mbsStat = 0;
                        $mscStat = 0;
                        $insStat = 0;
                        $trfStat = 0;



                        $sqlLP1 = "SELECT * FROM  other_income_table WHERE or_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                if ($row['income_code'] == "pnti"){
                                    //echo "string";
                                    $penaltyRice[$counter] = $row['amount'];
                                    $prStat = 1;
                                }elseif ($row['income_code'] == "plti") {
                                    $penaltyLoan[$counter] = $row['amount'];
                                    $plStat = 1;
                                }elseif ($row['income_code'] == "rnti") {
                                    $RentalIncome[$counter] = $row['amount'];
                                    $riStat = 1;
                                }elseif ($row['income_code'] == "mbsi") {
                                    $membership[$counter] = $row['amount'];
                                    $mbsStat = 1;
                                }elseif ($row['income_code'] == "msli") {
                                    $miscellaneous[$counter] = $row['amount'];
                                    $mscStat = 1;
                                }elseif ($row['income_code'] == "tffi") {
                                    $transferFee[$counter] = $row['amount'];
                                    $trfStat = 1;
                                }elseif ($row['income_code'] == "insi") {
                                    $insurance[$counter] = $row['amount'];
                                    $insStat = 1;
                                }else{
                                    //$oiValueTemp = $oiValueTemp + $row['amount'];
                                    $oiValue[$counter] = $row['amount'];
                                    $oiStat = 1;
                                }
                            }
                        }

                        if($oiStat == 0){
                            $oiValue[$counter] = 0;
                        }

                        if($plStat == 0){
                            $penaltyLoan[$counter] = 0;
                        }

                        if($prStat == 0){
                            $penaltyRice[$counter] = 0;
                        }

                        if($riStat == 0){
                            $RentalIncome[$counter] = 0;
                        }

                        if($mbsStat == 0){
                            $membership[$counter] = 0;
                        }

                        if($mscStat == 0){
                            $miscellaneous[$counter] = 0;
                        }

                        if($trfStat == 0){
                            $transferFee[$counter] = 0;
                        }

                        if($insStat == 0){
                            $insurance[$counter] = 0;
                        }
                    }else{
                        $oiValue[$counter] = 0;
                        $penaltyLoan[$counter] = 0;
                        $penaltyRice[$counter] = 0;
                        $RentalIncome[$counter] = 0;

                        $membership[$counter] = 0;
                        $miscellaneous[$counter] = 0;
                        $insurance[$counter] = 0;
                        $transferFee[$counter] = 0;
                    }

                    if($sc[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  share_capital_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $scValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                         $scValue[$counter] = 0;
                    }

                    if($sd[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  savings_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $sdValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $sdValue[$counter] = 0;
                    }

                    if($td[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  time_deposit_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $tdValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $tdValue[$counter] = 0;
                    }

                    if($fd[$counter] == 1){
                        $sqlLP1 = "SELECT * FROM  fixed_deposit_table WHERE reference_number = '$orNumber[$counter]' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $fdValue[$counter] = $row['amount'];
                            }
                        }
                    }else{
                        $fdValue[$counter] = 0;   
                    }

                    if($idNumber[$counter] != "CANCEL"){
                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' order by last_name asc ";
                            $resultLS = $conn->query($sqlLS);
                            //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){

                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                //$idNumberS[$counter] = $row['id_number'];
                                $firstName[$counter] = $row['first_name'];
                                $middleName[$counter] = $row['middle_name'];
                                $lastName[$counter] = $row['last_name'];
                            }
                        }
                    }else{
                        $firstName[$counter] = "";
                        $middleName[$counter] = "";
                        $lastName[$counter] = "";
                    }

                    $counter++;
                }
            }

            $sqlName = "SELECT * FROM  cashier_withdraw_table WHERE date_transaction = '$dateToday' order by or_number asc";

            $resultName = $conn->query($sqlName);
            $numRowWithdraw = mysqli_num_rows($resultName);
            $counterWithdraw = 0;

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    # code...
                    $transactionNumberW[$counterWithdraw] = $row['transaction_number'];
                    $idNumberW[$counterWithdraw] = $row['id_number'];
                    $orNumberW[$counterWithdraw] = $row['or_number'];
                    $totalAmountW[$counterWithdraw] = $row['total_amount'];

                    $scW[$counterWithdraw] = $row['cbuw'];
                    $sdW[$counterWithdraw] = $row['sdw'];
                    $tdW[$counterWithdraw] = $row['tdw'];
                    $fdW[$counterWithdraw] = $row['fdw'];
                    $typePaymentW[$counterWithdraw] = $row['payment_type'];

                    $dateTransactionW[$counterWithdraw] = $row['date_transaction'];
                    $encodedByW[$counterWithdraw] = $row['encoded_by'];

                    if($scW[$counterWithdraw] == 1){
                        $sqlLP1 = "SELECT * FROM  share_capital_table WHERE reference_number = '$orNumberW[$counterWithdraw]' and type_transaction = 'Withdraw' ";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $scValueW[$counterWithdraw] = $row['amount'];
                            }
                        }
                    }else{
                         $scValueW[$counterWithdraw] = 0;
                    }

                    if($sdW[$counterWithdraw] == 1){
                        $sqlLP1 = "SELECT * FROM  savings_table WHERE reference_number = '$orNumberW[$counterWithdraw]' and type_transaction = 'Withdraw'";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $sdValueW[$counterWithdraw] = $row['amount'];
                            }
                        }
                    }else{
                        $sdValueW[$counterWithdraw] = 0;
                    }

                    if($tdW[$counterWithdraw] == 1){
                        $sqlLP1 = "SELECT * FROM  time_deposit_table WHERE reference_number = '$orNumberW[$counterWithdraw]' and type_transaction = 'Withdraw'";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $tdValueW[$counterWithdraw] = $row['amount'];
                            }
                        }
                    }else{
                        $tdValueW[$counterWithdraw] = 0;
                    }

                    if($fdW[$counterWithdraw] == 1){
                        $sqlLP1 = "SELECT * FROM  fixed_deposit_table WHERE reference_number = '$orNumberW[$counterWithdraw]' and type_transaction = 'Withdraw'";
                        $resultLP1 = $conn->query($sqlLP1);

                        //Principal
                        if($resultLP1->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP1)) {
                                # code...
                                $fdValueW[$counterWithdraw] = $row['amount'];
                            }
                        }
                    }else{
                        $fdValueW[$counterWithdraw] = 0;   
                    }

                    $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumberW[$counterWithdraw]' ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            //$idNumberS[$counter] = $row['id_number'];
                            $firstNameW[$counterWithdraw] = $row['first_name'];
                            $middleNameW[$counterWithdraw] = $row['middle_name'];
                            $lastNameW[$counterWithdraw] = $row['last_name'];
                        }
                    }

                    $counterWithdraw++;
                }
            }
        }

        if($printSummary == "printSummary" or $printAM == "printAM" or $printPM == "printPM"){

            $pdf = new FPDF();

            $rowCounter = 0;

            $pdf->SetFont('Arial','B',9);
            $pdf->AddPage('P','Legal', 0);
            
            //foreach($header as $col)

            //Title
            $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
            $pdf->Cell(100,7,"Daily Cash Register");$pdf->Ln();
            $pdf->Cell(15,7,"Date:");
            $pdf->Cell(30,7,"$dateToday");$pdf->Ln();
            //$pdf->Cell(30,7,"To");
            //$pdf->Cell(30,7,"$endDate");$pdf->Ln();

            $pdf->Cell(20,7,"ID #",1);
            $pdf->Cell(65,7,"Name",1);
            $pdf->Cell(15,7,"OR #",1);
            $pdf->Cell(15,7,"Invoice #",1);
            $pdf->Cell(25,7,"Grand Total #",1);
            $pdf->Cell(25,7,"Total Trading",1);
            $pdf->Cell(25,7,"Total Lending",1);
            $pdf->Ln();

            $checkCounter = 0;
            $chequeIDNumber[] = "";
            $chequelastName[] = "";
            $chequefirstName[] = "";
            $chequemiddleName[] = "";
            $chequeAmount[] = "";
            $chequeReferenceN[] = "";

            $fullName[] = "";
            while($rowCounter < $numRow) {
                $pdf->Cell(20,7,"$idNumber[$rowCounter]",1);
                $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                $pdf->Cell(65,7,"$fullName[$rowCounter]",1);
                $pdf->Cell(15,7,"$orNumber[$rowCounter]",1);

                if("$invoiceNumber[$rowCounter]" != "0"){
                    $pdf->Cell(15,7,"$invoiceNumber[$rowCounter]",1);
                }else{
                    $pdf->Cell(15,7,"",1);
                }
                


                $totalAmountS = $totalAmountS + $totalAmount[$rowCounter];
                if($typePayment[$rowCounter] == 1){
                    $totalCheck =  $totalCheck + $totalAmount[$rowCounter];

                    $chequeIDNumber[$checkCounter] = $idNumber[$rowCounter];
                    $chequelastName[$checkCounter] = $firstName[$rowCounter];
                    $chequefirstName[$checkCounter] = $lastName[$rowCounter];
                    $chequemiddleName[$checkCounter] = $middleName[$rowCounter];
                    $chequeAmount[$checkCounter] = $totalAmount[$rowCounter];
                    $chequeReferenceN[$checkCounter] = $orNumber[$rowCounter];

                    $checkCounter++;
                }
                if($totalAmount[$rowCounter] == 0){
                    $totalAmount[$rowCounter] = "";
                }else{
                    $totalAmount[$rowCounter] = number_format($totalAmount[$rowCounter],'2','.',',');
                }
                $pdf->Cell(25,7,$totalAmount[$rowCounter],1);

                $totalTrading[$rowCounter] = $rclValue[$rowCounter] + $rccValue[$rowCounter] + $sdValue[$rowCounter] + $tdValue[$rowCounter] + $rcliValue[$rowCounter] + $rcciValue[$rowCounter] + $penaltyRice[$rowCounter];
                $totalTradingF = $totalTradingF + $totalTrading[$rowCounter];
                if($totalTrading[$rowCounter] == 0){
                    $totalTrading[$rowCounter] = "";
                }else{
                    $totalTrading[$rowCounter] = number_format($totalTrading[$rowCounter],'2','.',',');
                }
                $pdf->Cell(25,7,$totalTrading[$rowCounter],1);

                $totalLending[$rowCounter] = $blValue[$rowCounter] + $cllValue[$rowCounter] + $cmlValue[$rowCounter] + $edlValue[$rowCounter] + $rlValue[$rowCounter] + $plValue[$rowCounter] + $clValue[$rowCounter] + $cklValue[$rowCounter] + $emlValue[$rowCounter] + $slValue[$rowCounter] + $scValue[$rowCounter] + $oiValue[$rowCounter] + $fdValue[$rowCounter] + $bliValue[$rowCounter] + $clliValue[$rowCounter] + $cmliValue[$rowCounter] + $edliValue[$rowCounter] + $rliValue[$rowCounter] + $pliValue[$rowCounter] + $penaltyLoan[$rowCounter] + $RentalIncome[$rowCounter] + $membership[$rowCounter] + $miscellaneous[$rowCounter] + $transferFee[$rowCounter] + $insurance[$rowCounter];

                $totalLendingF = $totalLendingF + $totalLending[$rowCounter];
                if($totalLending[$rowCounter] == 0){
                    $totalLending[$rowCounter] = "";
                }else{
                    $totalLending[$rowCounter] = number_format($totalLending[$rowCounter],'2','.',',');
                }
                $pdf->Cell(25,7,$totalLending[$rowCounter],1);
                $pdf->Ln();
                $rowCounter ++;
            }

            $pdf->Cell(20,7,"TOTAL",1);
            $pdf->Cell(65,7,"",1);
            $pdf->Cell(15,7,"",1);
            $pdf->Cell(15,7,"",1);
            $pdf->Cell(25,7,number_format($totalAmountS,'2','.',','),1);
            $pdf->Cell(25,7,number_format($totalTradingF,'2','.',','),1);
            $pdf->Cell(25,7,number_format($totalLendingF,'2','.',','),1);
            $pdf->Ln();
            $pdf->Ln();


            $pdf->Cell(35,7,"WITHDRAW");$pdf->Ln();
            $pdf->Cell(35,7,"Transaction #",1);
            $pdf->Cell(20,7,"ID #",1);
            $pdf->Cell(65,7,"MEMBER NAME",1);
            $pdf->Cell(20,7,"SLIP #",1);
            $pdf->Cell(20,7,"AMOUNT",1);
            $pdf->Ln();
            //Withdrawal

            $counterh = 0;
            $totalWithdraw = 0;
            $totalSDW = 0;
            $totalTDW = 0;
            $totalFDW = 0;
            $totalSCW = 0;


            while($counterh < $numRowWithdraw) {
                $pdf->Cell(35,7,"$transactionNumberW[$counterh]",1);
                $pdf->Cell(20,7,"$idNumberW[$counterh]",1);
                $fullName[$counterh] = $lastNameW[$counterh] . ", " . $firstNameW[$counterh] . " " . $middleNameW[$counterh];
                $pdf->Cell(65,7,"$fullName[$counterh]",1);
                $pdf->Cell(20,7,"$orNumberW[$counterh]",1);

                $totalWithdraw = $totalWithdraw + $totalAmountW[$counterh];
                if($typePaymentW[$counterh] == 1){
                    $totalCheckWithdraw =  $totalCheckWithdraw + $totalAmountW[$counterh];

                    $chequeIDNumber[$checkCounter] = $idNumberW[$counterh];
                    $chequelastName[$checkCounter] = $firstNameW[$counterh];
                    $chequefirstName[$checkCounter] = $lastNameW[$counterh];
                    $chequemiddleName[$checkCounter] = $middleNameW[$counterh];
                    $chequeAmount[$checkCounter] = $totalAmountW[$counterh];
                    $chequeReferenceN[$checkCounter] = $orNumberW[$counterh];

                    $checkCounter++;
                }
                $pdf->Cell(20,7,$totalAmountW[$counterh],1);
                $pdf->Ln();
                $counterh ++;
            }

            $pdf->Cell(35,7,"TOTAL WITHDRAW",1);
            $pdf->Cell(20,7,"",1);
            $pdf->Cell(65,7,"",1);
            $pdf->Cell(20,7,"",1);
            $pdf->Cell(20,7,"$totalWithdraw",1);
            $pdf->Ln();
            $pdf->Ln();

            //Checque
            $pdf->Cell(35,7,"CHECQUE");$pdf->Ln();
            $pdf->Cell(20,7,"ID #",1);
            $pdf->Cell(65,7,"MEMBER NAME",1);
            $pdf->Cell(20,7,"OR / SLIP #",1);
            $pdf->Cell(20,7,"AMOUNT",1);
            $pdf->Ln();

            $counterC = 0;
            while($counterC < $checkCounter) {

                $pdf->Cell(20,7,"$chequeIDNumber[$counterC]",1);
                $fullName[$counterC] = $chequelastName[$counterC] . ", " . $chequefirstName[$counterC] . " " . $chequemiddleName[$counterC];
                $pdf->Cell(65,7,"$fullName[$counterC]",1);
                $pdf->Cell(20,7,"$chequeReferenceN[$counterC]",1);
                $pdf->Cell(20,7,"$chequeAmount[$counterC]",1);
                $pdf->Ln();
                $counterC ++;
            }

            $pdf->Ln();
            $pdf->Ln();
            //Checque
            $pdf->Cell(35,7,"COLLECTION");$pdf->Ln();
            $pdf->Cell(40,7,"TOTAL COLLECTION",1);
            $pdf->Cell(40,7,"TOTAL WITHDRAW",1);
            $pdf->Cell(40,7,"CHECQUE COLLECTION",1);
            $pdf->Cell(40,7,"CHECQUE WITHDRAW",1);
            $pdf->Cell(40,7,"ACTUAL COLLECTION",1);
            $pdf->Ln();

            $actualCollection = $totalAmountS - $totalWithdraw - $totalCheck;
            $pdf->Cell(40,7,number_format($totalAmountS,'2','.',','),1);
            $pdf->Cell(40,7,number_format($totalWithdraw,'2','.',','),1);
            $pdf->Cell(40,7,number_format($totalCheck,'2','.',','),1);
            $pdf->Cell(40,7,number_format($totalCheckWithdraw,'2','.',','),1);
            $pdf->Cell(40,7,number_format($actualCollection,'2','.',','),1);

            $pdf->Ln();
            $pdf->Ln();

            if($printAM == "printAM"){
                $pdf->Cell(20,7,"REMIT");
                $pdf->Cell(30,7,"AM");
                $pdf->Ln();
                $pdf->Cell(45,7,"STARTING OR #:");
                $pdf->Cell(30,7,"$startORP");
                $pdf->Cell(45,7,"ENDING OR #:");
                $pdf->Cell(30,7,"$endORP");
                $pdf->Ln();

                $pdf->Cell(45,7,"STARTING SLIP #:");
                $pdf->Cell(30,7,"$startSRNP");
                $pdf->Cell(45,7,"ENDING SLIP #:");
                $pdf->Cell(30,7,"$endSRNP");
                $pdf->Ln();

                $pdf->Cell(45,7,"DENOMINATION",1);
                $pdf->Cell(30,7,"QUANTITY",1);
                $pdf->Cell(30,7,"AMOUNT",1);
                $pdf->Ln();

                $pdf->Cell(45,7,"1000",1);
                $pdf->Cell(30,7,"$thousandQP",1);
                $pdf->Cell(30,7,number_format($thousandVP,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"500",1);
                $pdf->Cell(30,7,"$fhundterQP",1);
                $pdf->Cell(30,7,number_format($fhundterVP,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"200",1);
                $pdf->Cell(30,7,"$thundredQP",1);
                $pdf->Cell(30,7,number_format($thundredVP,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"100",1);
                $pdf->Cell(30,7,"$ohundredQP",1);
                $pdf->Cell(30,7,number_format($ohundredVP,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"50",1);
                $pdf->Cell(30,7,"$ftenQP",1);
                $pdf->Cell(30,7,number_format($ftenVP,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"20",1);
                $pdf->Cell(30,7,"$ftenVP",1);
                $pdf->Cell(30,7,number_format($ftenVP,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"10",1);
                $pdf->Cell(30,7,"$tpesoQP",1);
                $pdf->Cell(30,7,number_format($tpesoVP,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"5",1);
                $pdf->Cell(30,7,"$fpesoQP",1);
                $pdf->Cell(30,7,number_format($fpesoVP,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"1",1);
                $pdf->Cell(30,7,"$opesoQP",1);
                $pdf->Cell(30,7,number_format($opesoVP,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,".25",1);
                $pdf->Cell(30,7,"$cpesoQP",1);
                $pdf->Cell(30,7,number_format($cpesoVP,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"TOTAL",1);
                $pdf->Cell(30,7,"",1);
                $pdf->Cell(30,7,number_format($totalCRP,'2','.',','),1);
                $pdf->Ln();
            }

            if($printPM == "printPM"){
                $pdf->Cell(20,7,"REMIT");
                $pdf->Cell(30,7,"PM");
                $pdf->Ln();
                $pdf->Cell(45,7,"STARTING OR #:");
                $pdf->Cell(30,7,"$startORPM");
                $pdf->Cell(45,7,"ENDING OR #:");
                $pdf->Cell(30,7,"$endORPM");
                $pdf->Ln();

                $pdf->Cell(45,7,"STARTING SLIP #:");
                $pdf->Cell(30,7,"$startSRNPM");
                $pdf->Cell(45,7,"ENDING SLIP #:");
                $pdf->Cell(30,7,"$endSRNPM");
                $pdf->Ln();

                $pdf->Cell(45,7,"DENOMINATION",1);
                $pdf->Cell(30,7,"QUANTITY",1);
                $pdf->Cell(30,7,"AMOUNT",1);
                $pdf->Ln();

                $pdf->Cell(45,7,"1000",1);
                $pdf->Cell(30,7,"$thousandQPM",1);
                $pdf->Cell(30,7,number_format($thousandVPM,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"500",1);
                $pdf->Cell(30,7,"$fhundterQPM",1);
                $pdf->Cell(30,7,number_format($fhundterVPM,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"200",1);
                $pdf->Cell(30,7,"$thundredQPM",1);
                $pdf->Cell(30,7,number_format($thundredVPM,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"100",1);
                $pdf->Cell(30,7,"$ohundredQPM",1);
                $pdf->Cell(30,7,number_format($ohundredVPM,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"50",1);
                $pdf->Cell(30,7,"$ftenQPM",1);
                $pdf->Cell(30,7,number_format($ftenVPM,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"20",1);
                $pdf->Cell(30,7,"$ftenVPM",1);
                $pdf->Cell(30,7,number_format($ftenVPM,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"10",1);
                $pdf->Cell(30,7,"$tpesoQPM",1);
                $pdf->Cell(30,7,number_format($tpesoVPM,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"5",1);
                $pdf->Cell(30,7,"$fpesoQPM",1);
                $pdf->Cell(30,7,number_format($fpesoVPM,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"1",1);
                $pdf->Cell(30,7,"$opesoQPM",1);
                $pdf->Cell(30,7,number_format($opesoVPM,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,".25",1);
                $pdf->Cell(30,7,"$cpesoQPM",1);
                $pdf->Cell(30,7,number_format($cpesoVPM,'2','.',','),1);
                $pdf->Ln();

                $pdf->Cell(45,7,"TOTAL",1);
                $pdf->Cell(30,7,"",1);
                $pdf->Cell(30,7,number_format($totalCRPM,'2','.',','),1);
                $pdf->Ln();
            }

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();

            if($printSummary == "printSummary"){
                $pdf->Cell(50,7,"PREPARED BY:");
                $pdf->Cell(50,7,"CHECKED BY:");
                $pdf->Cell(50,7,"RECEIVED BY:");
                $pdf->Cell(50,7,"NOTED BY:");

                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Cell(50,7,"$preparedBy");
                $pdf->Cell(50,7,"$checkedBy");
                $pdf->Cell(50,7,"$receivedBy");
                $pdf->Cell(50,7,"$notedBy");

                $pdf->Ln();
                $pdf->Cell(50,7,"Cashier");
                $pdf->Cell(50,7,"BOOKKEEPER");
                $pdf->Cell(50,7,"Treasurer");
                $pdf->Cell(50,7,"Manager");
            }

            $pdf->Output();
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Daily Report</title>
    <?php include "css.html" ?>
</head>
<body>

<div style="position: relative;">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php //include 'topbar.php';?>
        
        <!--<div class="row fixed-top">

            echo "<table>
                <tr>
                    <th> 'Transaction #</th>
                    <th>ID #</th>
                    <th>MEMBER NAME</th>
                    <th>OR #</th>
                    <th>Invoice #</th>
                    <th>Grand Total</th>
                    <th>Trading Total</th>
                    <th>Lending Total</th>
                    <th>Interest</th>
                    <th>BL</th>
                    <th>CLL</th>
                    <th>CML</th>
                    <th>EDL</th>
                    <th>RL</th>
                    <th>PL</th>
                    <th>CL</th>
                    <th>CKL</th>
                    <th>EML</th>
                    <th>SL</th>
                    <th>Penalty</th>
                    <th>RR</th>
                    <th>MBF</th>
                    <th>MSC</th>
                    <th>TF</th>
                    <th>INS</th>
                    <th>OI</th>
                    <th>CBU</th>
                    <th>FD</th>
                    <th>RLR</th>
                    <th>IR</th>
                    <th>AR</th>
                    <th>IR</th>
                    <th>Penalty</th>
                    <th>SD</th>
                    <th>TD</th>
                    <th>Date</th>
                    <th>Encoder</th>
                </tr>";
        </div>-->

        <div class="row">
            <?php include 'navigation.php';?>
            <div style="margin-top:70px;margin-left: 16.7%;margin-bottom: 20px;">
                <div class="row">
                    <div class="form-group">
                        
                        <div class="col-md-10">
                            <div class="col-md-10">
                                <input type="date" style="width: 150px;" value = "<?php echo $dateToday;?>" name = "dateToday">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 form">
                            <button class="btn btn-outline-success my-2 my-sm-0" name = "searchReport" value = "searchReport" type="submit" style="align-self: center;">SEARCH</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 form">
                            <button class="btn btn-outline-success my-2 my-sm-0" name = "showAM" value = "showAM" type="submit" style="align-self: center;">SHOW AM</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 form">
                            <button class="btn btn-outline-success my-2 my-sm-0" name = "showPM" value = "showPM" type="submit" style="align-self: center;">SHOW PM</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 form">
                            <button class="btn btn-outline-success my-2 my-sm-0" name = "printAM" value = "printAM" type="submit" style="align-self: center;">PRINT AM</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 form">
                            <button class="btn btn-outline-success my-2 my-sm-0" name = "printPM" value = "printPM" type="submit" style="align-self: center;">PRINT PM</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 form">
                            <button style="width:auto;" class="btn btn-outline-success my-2 my-sm-0" name = "printSummary" value = "printSummary" type="submit">PRINT SUMMARY</button>
                        </div>
                    </div>
                </div>

                <div class="table table-bordered table-striped table-hover table-dark">
                    <?php
                        echo "<table>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>ID #__________</th>
                            <th>MEMBER NAME_______________________________</th>
                            <th>OR #</th>
                            <th>Invoice # | Payment Count</th>
                            <th></th>
                            <th>Grand Total</th>
                            <th>Trading Total</th>
                            <th>Lending Total</th>
                            <th>Interest</th>
                            <th>BL</th>
                            <th>CLL</th>
                            <th>CML</th>
                            <th>EDL</th>
                            <th>RL</th>
                            <th>PL</th>
                            <th>CL</th>
                            <th>CKL</th>
                            <th>EML</th>
                            <th>SL</th>
                            <th>Penalty</th>
                            <th>RR</th>
                            <th>MBF</th>
                            <th>MSC</th>
                            <th>TF</th>
                            <th>INS</th>
                            <th>OI</th>
                            <th>CBU</th>
                            <th>FD</th>
                            <th>RLR</th>
                            <th>IR</th>
                            <th>AR</th>
                            <th>IR</th>
                            <th>Penalty</th>
                            <th>SD</th>
                            <th>TD</th>
                            <th>Date_______</th>
                            <th>Encoder</th>
                        </tr>";
                        
                        $counterh = 0;
                        $checkCounter = 0;
                        $chequeIDNumber[] = "";
                        $chequelastName[] = "";
                        $chequefirstName[] = "";
                        $chequemiddleName[] = "";
                        $chequeAmount[] = "";
                        $chequeReferenceN[] = "";

                        while($counterh < $numRow) {
                                echo "<tr>";
                                    echo "<td>  <button class =". "deletebutton". " "  . "type =" . "submit" . " " . " " ."value=". "$orNumber[$counterh]" . " " . "name=" . "clearOR". ">"  . "CLEAR" . " </button> </td>";
                                    echo "<td> <button class =". "deletebutton". " " . "type =" . "submit" . " " . " " ."value=". "$orNumber[$counterh]" . " " . "name=" . "cancelOR" . ">"  . "CANCEL" . " </button> </td>";
                                    echo "<td>" . $idNumber[$counterh] . "</td>";

                                    if($idNumber[$counterh] == "CANCELLED"){
                                        echo "<td>" . "Cancelled OR" . "</td>";
                                    }else{
                                        echo "<td>" . $lastName[$counterh] . ", " . $firstName[$counterh] . " " . $middleName[$counterh] . "</td>";
                                    }
                                    
                                    echo "<td>" . $orNumber[$counterh] . "</td>";
                                    //$invoiceNumber[$counterh] = $invoiceNumberL[$counterh] . " " . $invoiceNumberC[$counterh];
                                    if($invoiceNumber[$counterh] == 0){
                                        $invoiceNumber[$counterh] = "";
                                    }
                                    echo "<td>" . $invoiceNumber[$counterh] . "</td>";

                                    //GRAND TOTAL
                                    $totalAmountS = $totalAmountS + $totalAmount[$counterh];

                                    if($typePayment[$counterh] == 1){
                                        $totalCheck =  $totalCheck + $totalAmount[$counterh];

                                        $chequeIDNumber[$checkCounter] = $idNumber[$counterh];
                                        $chequelastName[$checkCounter] = $firstName[$counterh];
                                        $chequefirstName[$checkCounter] = $lastName[$counterh];
                                        $chequemiddleName[$checkCounter] = $middleName[$counterh];
                                        $chequeAmount[$checkCounter] = $totalAmount[$counterh];
                                        $chequeReferenceN[$checkCounter] = $orNumber[$counterh];

                                        $checkCounter++;
                                    }

                                    //TRADING
                                    $totalTrading[$counterh] = $rclValue[$counterh] + $rccValue[$counterh] + $sdValue[$counterh] + $tdValue[$counterh] + $rcliValue[$counterh] + $rcciValue[$counterh] + $penaltyRice[$counterh];

                                    //LENDING
                                    $totalLending[$counterh] = $blValue[$counterh] + $cllValue[$counterh] + $cmlValue[$counterh] + $edlValue[$counterh] + $rlValue[$counterh] + $plValue[$counterh] + $clValue[$counterh] + $cklValue[$counterh] + $emlValue[$counterh] + $slValue[$counterh] + $scValue[$counterh] + $oiValue[$counterh] + $fdValue[$counterh] + $bliValue[$counterh] + $clliValue[$counterh] + $cmliValue[$counterh] + $edliValue[$counterh] + $rliValue[$counterh] + $pliValue[$counterh] + $penaltyLoan[$counterh] + $RentalIncome[$counterh] + $membership[$counterh] + $miscellaneous[$counterh] + $transferFee[$counterh] + $insurance[$counterh];

                                    //CHECK ACCURACY
                                    $totalL = 0;
                                    $totalA = 0;
                                    $totalT = 0;
                                    if($totalLending[$counterh] != "" and $totalTrading[$counterh] == 0){
                                        $totalL = number_format($totalLending[$counterh],'2','.','');
                                        $totalA = number_format($totalAmount[$counterh],'2','.','');
                                        $diff = $totalL - $totalA;
                                        if($diff == "0"){
                                            echo "<td " . "style=" . "color:#42FF33" . ">" . "|" . "</td>";
                                        }else{
                                            echo "<td " . "style=" . "color:#FF3333" . ">" . "__" . "</td>";
                                        }
                                    }elseif($totalTrading[$counterh] != "" and $totalLending[$counterh] == ""){
                                        $totalT = number_format($totalTrading[$counterh],'2','.','');
                                        $totalA = number_format($totalAmount[$counterh],'2','.','');
                                        $diff = $totalT - $totalA;
                                        if($diff == "0"){
                                            echo "<td " . "style=" . "color:#42FF33" . ">" . "|" . "</td>";
                                        }else{
                                            echo "<td " . "style=" . "color:#FF3333" . ">" . "__" . "</td>";
                                        }
                                    }elseif($totalTrading[$counterh] != "" and $totalLending[$counterh] != ""){
                                        $totalLT = $totalTrading[$counterh] + $totalLending[$counterh];
                                        $totalA = $totalAmount[$counterh];

                                        $totalLT = number_format($totalLT,'2','.','');
                                        $totalA = number_format($totalA,'2','.','');

                                        $diff = $totalA - $totalLT;
                                        if($diff == "0"){
                                            echo "<td " . "style=" . "color:#42FF33" . ">" . "|" . "</td>";
                                        }else{
                                            echo "<td " . "style=" . "color:#FF3333" . ">" . "__" . "</td>";
                                        }
                                    }elseif($totalTrading[$counterh] == "0" and $totalLending[$counterh] == "0" and $idNumber[$counterh] != "CANCELLED"){
                                        echo "<td " . "style=" . "color:#FF3333" . ">" . "__" . "</td>";
                                    }else{
                                        echo "<td " . "style=" . "color:#42FF33" . ">" . "|" . "</td>";
                                    }

                                    if($totalAmount[$counterh] == 0){
                                        $totalAmount[$counterh] = "";
                                    }else{
                                        $totalAmount[$counterh] = number_format($totalAmount[$counterh],'2','.',',');
                                    }
                                    echo "<td " . "style=" . "color:orange" . ">" . $totalAmount[$counterh] . "</td>";

                                    $totalTradingF = $totalTradingF + $totalTrading[$counterh];
                                    if($totalTrading[$counterh] == 0){
                                        $totalTrading[$counterh] = "";
                                    }else{
                                        $totalTrading[$counterh] = number_format($totalTrading[$counterh],'2','.',',');
                                    }
                                    echo "<td " . "style=" . "color:blue" . ">" . $totalTrading[$counterh] . "</td>";

                                    $totalLendingF = $totalLendingF + $totalLending[$counterh];
                                    if($totalLending[$counterh] == 0){
                                        $totalLending[$counterh] = "";
                                    }else{
                                        $totalLending[$counterh] = number_format($totalLending[$counterh],'2','.',',');
                                    }
                                    echo "<td " . "style=" . "color:#21e5d6" . ">" . $totalLending[$counterh] . "</td>";

                                    
                                    //TRADING INTEREST
                                    $totalInterest[$counterh] = $bliValue[$counterh] + $clliValue[$counterh] + $cmliValue[$counterh] + $edliValue[$counterh] + $rliValue[$counterh] + $pliValue[$counterh];
                                    $totalInterestF = $totalInterestF +  $totalInterest[$counterh];

                                    if($totalInterest[$counterh] == 0){
                                        $totalInterest[$counterh] = "";
                                    }else{
                                        $totalInterest[$counterh] = number_format($totalInterest[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $totalInterest[$counterh] . "</td>";

                                    $totalAmountBL = $totalAmountBL + $blValue[$counterh];
                                    if($blValue[$counterh] == 0){
                                        $blValue[$counterh] = "";
                                    }else{
                                        $blValue[$counterh] = number_format($blValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $blValue[$counterh] . "</td>";

                                    $totalAmountCLL= $totalAmountCLL + $cllValue[$counterh];
                                    if($cllValue[$counterh] == 0){
                                        $cllValue[$counterh] = "";
                                    }else{
                                        $cllValue[$counterh] = number_format($cllValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $cllValue[$counterh] . "</td>";

                                    $totalamountCML= $totalamountCML + $cmlValue[$counterh];
                                    if($cmlValue[$counterh] == 0){
                                        $cmlValue[$counterh] = "";
                                    }else{
                                        $cmlValue[$counterh] = number_format($cmlValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $cmlValue[$counterh] . "</td>";

                                    $totalAmountEDL= $totalAmountEDL + $edlValue[$counterh];
                                    if($edlValue[$counterh] == 0){
                                        $edlValue[$counterh] = "";
                                    }else{
                                        $edlValue[$counterh] = number_format($edlValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $edlValue[$counterh] . "</td>";

                                    $totalAmountRL= $totalAmountRL + $rlValue[$counterh];
                                    if($rlValue[$counterh] == 0){
                                        $rlValue[$counterh] = "";
                                    }else{
                                        $rlValue[$counterh] = number_format($rlValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $rlValue[$counterh] . "</td>";

                                    $totalAmountPL= $totalAmountPL + $plValue[$counterh];
                                    if($plValue[$counterh] == 0){
                                        $plValue[$counterh] = "";
                                    }else{
                                        $plValue[$counterh] = number_format($plValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $plValue[$counterh] . "</td>";

                                    $totalAmountCL= $totalAmountCL + $clValue[$counterh];
                                    if($clValue[$counterh] == 0){
                                        $clValue[$counterh] = "";
                                    }else{
                                        $clValue[$counterh] = number_format($clValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $clValue[$counterh] . "</td>";

                                    $totalAmountCKL= $totalAmountCKL + $cklValue[$counterh];
                                    if($cklValue[$counterh] == 0){
                                        $cklValue[$counterh] = "";
                                    }else{
                                        $cklValue[$counterh] = number_format($cklValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $cklValue[$counterh] . "</td>";
                                    
                                    $totalAmountEML= $totalAmountEML + $emlValue[$counterh];
                                    if($emlValue[$counterh] == 0){
                                        $emlValue[$counterh] = "";
                                    }else{
                                        $emlValue[$counterh] = number_format($emlValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $emlValue[$counterh] . "</td>";
                                    
                                    $totalAmountSL= $totalAmountSL + $slValue[$counterh];
                                    if($slValue[$counterh] == 0){
                                        $slValue[$counterh] = "";
                                    }else{
                                        $slValue[$counterh] = number_format($slValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $slValue[$counterh] . "</td>";
                                    
                                    //$totalAmountSL= $totalAmountSL + $slValue[$counterh];
                                    $totalPenaltyLoan = $totalPenaltyLoan + $penaltyLoan[$counterh];
                                    if($penaltyLoan[$counterh] == 0){
                                        $penaltyLoan[$counterh] = "";
                                    }else{
                                        $penaltyLoan[$counterh] = number_format($penaltyLoan[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $penaltyLoan[$counterh] . "</td>";

                                    $totalRentalIncome = $totalRentalIncome + $RentalIncome[$counterh];
                                    if($RentalIncome[$counterh] == 0){
                                        $RentalIncome[$counterh] = "";
                                    }else{
                                        $RentalIncome[$counterh] = number_format($RentalIncome[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $RentalIncome[$counterh] . "</td>";

                                    $totalMembership = $totalMembership + $membership[$counterh];
                                    if($membership[$counterh] == 0){
                                        $membership[$counterh] = "";
                                    }else{
                                        $membership[$counterh] = number_format($membership[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $membership[$counterh] . "</td>";

                                    $totalMiscellaneous = $totalMiscellaneous + $miscellaneous[$counterh];
                                    if($miscellaneous[$counterh] == 0){
                                        $miscellaneous[$counterh] = "";
                                    }else{
                                        $miscellaneous[$counterh] = number_format($miscellaneous[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $miscellaneous[$counterh] . "</td>";

                                    $totalTransferFee = $totalTransferFee + $transferFee[$counterh];
                                    if($transferFee[$counterh] == 0){
                                        $transferFee[$counterh] = "";
                                    }else{
                                        $transferFee[$counterh] = number_format($transferFee[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $transferFee[$counterh] . "</td>";

                                    $totalInsurance = $totalInsurance + $insurance[$counterh];
                                    if($insurance[$counterh] == 0){
                                        $insurance[$counterh] = "";
                                    }else{
                                        $insurance[$counterh] = number_format($insurance[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $insurance[$counterh] . "</td>";

                                    $totalAmountOI= $totalAmountOI + $oiValue[$counterh];
                                    if($oiValue[$counterh] == 0){
                                        $oiValue[$counterh] = "";
                                    }else{
                                        $oiValue[$counterh] = number_format($oiValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $oiValue[$counterh] . "</td>";

                                    $totalAmountSC= $totalAmountSC + $scValue[$counterh];
                                    if($scValue[$counterh] == 0){
                                        $scValue[$counterh] = "";
                                    }else{
                                        $scValue[$counterh] = number_format($scValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $scValue[$counterh] . "</td>";

                                    $totalAmountFD= $totalAmountFD + $fdValue[$counterh];
                                    if($fdValue[$counterh] == 0){
                                        $fdValue[$counterh] = "";
                                    }else{
                                        $fdValue[$counterh] = number_format($fdValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $fdValue[$counterh] . "</td>";

                                    //TRADING
                                    $totalAmountRCL= $totalAmountRCL + $rclValue[$counterh];
                                    if($rclValue[$counterh] == 0){
                                        $rclValue[$counterh] = "";
                                    }else{
                                        $rclValue[$counterh] = number_format($rclValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $rclValue[$counterh] . "</td>";

                                    $totalRCLI= $totalRCLI + $rcliValue[$counterh];
                                    if($rcliValue[$counterh] == 0){
                                        $rcliValue[$counterh] = "";
                                    }else{
                                        $rcliValue[$counterh] = number_format($rcliValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $rcliValue[$counterh] . "</td>";

                                    $totalAmountRCC= $totalAmountRCC + $rccValue[$counterh];
                                    if($rccValue[$counterh] == 0){
                                        $rccValue[$counterh] = "";
                                    }else{
                                        $rccValue[$counterh] = number_format($rccValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $rccValue[$counterh] . "</td>";

                                    $totalRCCI= $totalRCCI + $rcciValue[$counterh];
                                    if($rcciValue[$counterh] == 0){
                                        $rcciValue[$counterh] = "";
                                    }else{
                                        $rcciValue[$counterh] = number_format($rcciValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $rcciValue[$counterh] . "</td>";

                                    $totalPenaltyRice = $totalPenaltyRice + $penaltyRice[$counterh];
                                    if($penaltyRice[$counterh] == 0){
                                        $penaltyRice[$counterh] = "";
                                    }else{
                                        $penaltyRice[$counterh] = number_format($penaltyRice[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $penaltyRice[$counterh] . "</td>";

                                    $totalAmountSD= $totalAmountSD + $sdValue[$counterh];
                                    if($sdValue[$counterh] == 0){
                                        $sdValue[$counterh] = "";
                                    }else{
                                        $sdValue[$counterh] = number_format($sdValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $sdValue[$counterh] . "</td>";

                                    $totalAmountTD= $totalAmountTD + $tdValue[$counterh];
                                    if($tdValue[$counterh] == 0){
                                        $tdValue[$counterh] = "";
                                    }else{
                                        $tdValue[$counterh] = number_format($tdValue[$counterh],'2','.',',');
                                    }
                                    echo "<td>" . $tdValue[$counterh] . "</td>";

                                    echo "<td>" . $dateTransaction[$counterh] . "</td>";
                                    echo "<td>" . $encodedBy[$counterh] . "</td>";
                                echo "</tr>";
                            $counterh ++;
                        }

                        echo "<tr>
                            <th></th>
                            <th></th>
                            <th>ID #</th>
                            <th>MEMBER NAME</th>
                            <th>OR #</th>
                            <th>Invoice #</th>
                            <th></th>
                            <th>Grand Total</th>
                            <th>Trading Total</th>
                            <th>Lending Total</th>
                            <th>Interest</th>
                            <th>BL</th>
                            <th>CLL</th>
                            <th>CML</th>
                            <th>EDL</th>
                            <th>RL</th>
                            <th>PL</th>
                            <th>CL</th>
                            <th>CKL</th>
                            <th>EML</th>
                            <th>SL</th>
                            <th>Penalty</th>
                            <th>RR</th>
                            <th>MBF</th>
                            <th>MSC</th>
                            <th>TF</th>
                            <th>INS</th>
                            <th>OI</th>
                            <th>CBU</th>
                            <th>FD</th>
                            <th>RLR</th>
                            <th>IR</th>
                            <th>AR</th>
                            <th>IR</th>
                            <th>Penalty</th>
                            <th>SD</th>
                            <th>TD</th>
                            <th>Date</th>
                            <th>Encoder</th>
                        </tr>";

                        echo "<tr>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . "". "</td>";
                            echo "<td>" . "". "</td>";
                            echo "<td>" . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . "</td>";
                            echo "<td>" . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . "</td>";
                            echo "<td>" . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . "</td>";

                            $totalLTGT = $totalTradingF + $totalLendingF;
                            $totalGT = $totalAmountS;

                            $totalLTGTF = number_format($totalLTGT,'2','.','');
                            $totalGTF = number_format($totalGT,'2','.','');

                            $diff = $totalGTF - $totalLTGTF;
                            if($diff == "0"){
                                echo "<td " . "style=" . "color:#42FF33" . ">" . "|||" . "</td>";
                            }else{
                                echo "<td " . "style=" . "color:#FF3333" . ">" . "__" . "</td>";
                            }



                            echo "<td " . "style=" . "color:orange " . "bgcolor =" . "#151515" . ">" . number_format($totalAmountS,'2','.',',') . "</td>";
                            echo "<td " . "style=" . "color:blue " . "bgcolor =" . "#151515" . ">" . number_format($totalTradingF,'2','.',',') . "</td>";
                            echo "<td " . "style=" . "color:#21e5d6 " . "bgcolor =" . "#151515" . ">" . number_format($totalLendingF,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalInterestF,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountBL,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountCLL,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalamountCML,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountEDL,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountRL,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountPL,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountCL,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountCKL,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountEML,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountSL,'2','.',',') . "</td>";

                            //RENTAL
                            echo "<td>" . number_format($totalPenaltyLoan,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalRentalIncome,'2','.',',') . "</td>";

                            echo "<td>" . number_format($totalMembership,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalMiscellaneous,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalTransferFee,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalInsurance,'2','.',',') . "</td>";

                            echo "<td>" . number_format($totalAmountOI,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountSC,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountFD,'2','.',',') . "</td>";

                            //TRADING
                            echo "<td>" . number_format($totalAmountRCL,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalRCLI,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountRCC,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalRCCI,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalPenaltyRice,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountSD,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalAmountTD,'2','.',',') . "</td>";
                            
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . "" . "</td>";
                        echo "</tr>";

                        echo "</table>";


                        //Withdrawal
                        echo "<table>
                        <tr>'&nbsp'</tr>
                        <tr>
                            <th>WITHDRAW</th>
                        </tr>

                        <tr>
                            <th>Transaction #</th>
                            <th>ID #</th>
                            <th>MEMBER NAME</th>
                            <th>SLIP #</th>
                            <th>Withdraw</th>
                            <th>Savings</th>
                            <th>Time Deposit</th>
                            <th>Fixed Deposit</th>
                            <th>SC</th>
                            <th>Date</th>
                            <th>Encoder</th>
                        </tr>";

                        $counterh = 0;
                        $totalWithdraw = 0;
                        $totalSDW = 0;
                        $totalTDW = 0;
                        $totalFDW = 0;
                        $totalSCW = 0;

                        while($counterh < $numRowWithdraw) {
                            echo "<tr>";
                                echo "<td>" . $transactionNumberW[$counterh] . "</td>";
                                echo "<td>" . $idNumberW[$counterh] . "</td>";
                                echo "<td>" . $lastNameW[$counterh] . ", " . $firstNameW[$counterh] . " " . $middleNameW[$counterh] . "</td>";
                                echo "<td>" . $orNumberW[$counterh] . "</td>";
                                
                                $totalWithdraw = $totalWithdraw + $totalAmountW[$counterh];

                                if($typePaymentW[$counterh] == 1){
                                    $totalCheckWithdraw =  $totalCheckWithdraw + $totalAmountW[$counterh];

                                    $chequeIDNumber[$checkCounter] = $idNumberW[$counterh];
                                    $chequelastName[$checkCounter] = $firstNameW[$counterh];
                                    $chequefirstName[$checkCounter] = $lastNameW[$counterh];
                                    $chequemiddleName[$checkCounter] = $middleNameW[$counterh];
                                    $chequeAmount[$checkCounter] = $totalAmountW[$counterh];
                                    $chequeReferenceN[$checkCounter] = $orNumberW[$counterh];

                                    $checkCounter++;
                                }
                                echo "<td>" . number_format($totalAmountW[$counterh],'2','.',',') . "</td>";
                                $totalSDW = $totalSDW + $sdValueW[$counterh];
                                echo "<td>" . number_format($sdValueW[$counterh],'2','.',',') . "</td>";
                                $totalTDW = $totalTDW + $tdValueW[$counterh];
                                echo "<td>" . number_format($tdValueW[$counterh],'2','.',',') . "</td>";
                                $totalFDW = $totalFDW + $fdValueW[$counterh];
                                echo "<td>" . number_format($fdValueW[$counterh],'2','.',',') . "</td>";
                                $totalSCW = $totalSCW + $scValueW[$counterh];
                                echo "<td>" . number_format($scValueW[$counterh],'2','.',',') . "</td>";

                                echo "<td>" . $dateTransactionW[$counterh] . "</td>";
                                echo "<td>" . $encodedByW[$counterh] . "</td>";
                            echo "</tr>";
                            $counterh ++;
                        }

                        echo "<tr>";
                            echo "<td>" . "TOTAL WITHDRAW" . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . "" . "</td>";
                            
                            echo "<td>" . number_format($totalWithdraw,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalSDW,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalTDW,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalFDW,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalSCW,'2','.',',') . "</td>";

                            echo "<td>" . "" . "</td>";
                            echo "<td>" . "" . "</td>";
                        echo "</tr>";
                        echo "</table>";

                        //Checque
                        echo "<table>
                        <tr>'&nbsp'</tr>
                        <tr>
                            <th>CHECQUE COLLECTION</th>
                        </tr>

                        <tr>
                            <th>ID #</th>
                            <th>MEMBER NAME</th>
                            <th>OR / SLIP #</th>
                            <th>Amount</th>
                        </tr>";

                        $counterC = 0;
                        while($counterC < $checkCounter) {
                            echo "<tr>";
                                echo "<td>" . $chequeIDNumber[$counterC] . "</td>";
                                echo "<td>" . $chequelastName[$counterC] . ", " . $chequefirstName[$counterC] . " " . $chequemiddleName[$counterC] . "</td>";
                                echo "<td>" . $chequeReferenceN[$counterC] . "</td>";
                                echo "<td>" . number_format($chequeAmount[$counterC],'2','.',',') . "</td>";
                            echo "</tr>";
                            $counterC ++;
                        }

                        //Summary
                        echo "<table>
                        <tr>'&nbsp'</tr>
                        <tr>
                            <th>COLLECTION</th>
                        </tr>

                        <tr>
                            <th>TOTAL COLLECTION</th>
                            <th>TOTAL WITHDRAW</th>
                            <th>TOTAL CHECK COLLECTION</th>
                            <th>TOTAL CHECK WITHDRAW</th>
                            <th>ACTUAL COLLECTION</th>
                        </tr>";

                        $actualCollection = $totalAmountS - $totalWithdraw - $totalCheck;
                        echo "<tr>";
                            echo "<td>" . number_format($totalAmountS,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalWithdraw,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalCheck,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalCheckWithdraw,'2','.',',') . "</td>";
                            echo "<td>" . number_format($actualCollection,'2','.',',') . "</td>";
                        echo "</tr>";
                        echo "</table>";
                    ?>
                </div>
                <div class="table table-bordered">
                    <?php
                        if($displayPropertyAM != "none"){
                            //Remit
                            echo "<table>
                            <tr>'&nbsp'</tr>
                            <tr>
                                <th>REMIT</th>";
                                echo "<th>" . "$dateToday" . "</th>";

                            echo" 
                                <th>AM</th>
                            </tr>

                            <tr>
                                <th></th>
                                <th>OR Start</th>
                                <th>OR End</th>
                            </tr>";

                            echo "<tr>";
                                echo "<th>" . "SALES OR" . "</th>";
                                echo "<td> <input type =" . "text" . " " . "style=" . "width:80px;border:none;" . " " . "readonly" . " " . "name=" . "startORP" . " " . "value=". $startORP . ">". "</td>";
                                echo "<td> <input type =" . "text" . " " . "style=" . "width:80px;border:none;" . " " . "readonly" . " " . "name=" . "endORP" . " " ."value=". $endORP . ">". "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<th>" . "WITHDRAW OR" . "</th>";
                                echo "<td> <input type =" . "text" . " " . "style=" . "width:80px;border:none;" . " " . "readonly" . " " . "name=" . "startORP" . " " . "value=". $startSRNP . ">". "</td>";
                                echo "<td> <input type =" . "text" . " " . "style=" . "width:80px;border:none;" . " " . "readonly" . " " . "name=" . "endORP" . " " ."value=". $endSRNP . ">". "</td>";
                            echo "</tr>";

                            echo"
                            <tr>
                                <th>DENOMINATION</th>
                                <th>QUANTITY</th>
                                <th>AMOUNT</th>
                            </tr>";

                            echo "<tr>";
                                echo "<td>" . "1000" . "</td>";
                                echo "<td>" . $thousandQP . "</td>";
                                echo "<td>" . $thousandVP. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "500" . "</td>";
                                echo "<td>" . $fhundterQP . "</td>";
                                echo "<td>" . $fhundterVP. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "200" . "</td>";
                                echo "<td>" . $thundredQP . "</td>";
                                echo "<td>" . $thundredVP. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "100" . "</td>";
                                echo "<td>" . $ohundredQP . "</td>";
                                echo "<td>" . $ohundredVP. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "50" . "</td>";
                                echo "<td>" . $ftenQP . "</td>";
                                echo "<td>" . $ftenVP. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "20" . "</td>";
                                echo "<td>" . $ttenQP . "</td>";
                                echo "<td>" . $ttenVP. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "10" . "</td>";
                                echo "<td>" . $tpesoQP . "</td>";
                                echo "<td>" . $tpesoVP. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "5" . "</td>";
                                echo "<td>" . $fpesoQP . "</td>";
                                echo "<td>" . $fpesoVP. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "1" . "</td>";
                                echo "<td>" . $opesoQP . "</td>";
                                echo "<td>" . $opesoVP. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . ".25" . "</td>";
                                echo "<td>" . $cpesoQP . "</td>";
                                echo "<td>" . $cpesoVP. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "TOTAL" . "</td>";
                                echo "<td>" . "" . "</td>";
                                echo "<td>" . $totalCRP. "</td>";
                            echo "</tr>";

                            echo "</table>";
                        }
                    ?>
                </div>
                <div class="table table-bordered">
                    <?php
                        if($displayPropertyPM != "none"){
                            //Remit
                            echo "<table>
                            <tr>'&nbsp'</tr>
                            <tr>
                                <th>REMIT</th>";
                                echo "<th>" . "$dateToday" . "</th>";

                            echo" 
                                <th>AM</th>
                            </tr>

                            <tr>
                                <th></th>
                                <th>OR Start</th>
                                <th>OR End</th>
                            </tr>";

                            echo "<tr>";
                                echo "<th>" . "SALES OR" . "</th>";
                                echo "<td> <input type =" . "text" . " " . "style=" . "width:80px;border:none;" . " " . "readonly" . " " . "name=" . "startORP" . " " . "value=". $startORPM . ">". "</td>";
                                echo "<td> <input type =" . "text" . " " . "style=" . "width:80px;border:none;" . " " . "readonly" . " " . "name=" . "endORP" . " " ."value=". $endORPM . ">". "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<th>" . "WITHDRAW OR" . "</th>";
                                echo "<td> <input type =" . "text" . " " . "style=" . "width:80px;border:none;" . " " . "readonly" . " " . "name=" . "startORP" . " " . "value=". $startSRNPM . ">". "</td>";
                                echo "<td> <input type =" . "text" . " " . "style=" . "width:80px;border:none;" . " " . "readonly" . " " . "name=" . "endORP" . " " ."value=". $endSRNPM . ">". "</td>";
                            echo "</tr>";

                            echo"
                            <tr>
                                <th>DENOMINATION</th>
                                <th>QUANTITY</th>
                                <th>AMOUNT</th>
                            </tr>";

                            echo "<tr>";
                                echo "<td>" . "1000" . "</td>";
                                echo "<td>" . $thousandQPM . "</td>";
                                echo "<td>" . $thousandVPM. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "500" . "</td>";
                                echo "<td>" . $fhundterQPM . "</td>";
                                echo "<td>" . $fhundterVPM. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "200" . "</td>";
                                echo "<td>" . $thundredQPM . "</td>";
                                echo "<td>" . $thundredVPM. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "100" . "</td>";
                                echo "<td>" . $ohundredQPM . "</td>";
                                echo "<td>" . $ohundredVPM. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "50" . "</td>";
                                echo "<td>" . $ftenQPM . "</td>";
                                echo "<td>" . $ftenVPM. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "20" . "</td>";
                                echo "<td>" . $ttenQPM . "</td>";
                                echo "<td>" . $ttenVPM. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "10" . "</td>";
                                echo "<td>" . $tpesoQPM . "</td>";
                                echo "<td>" . $tpesoVPM. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "5" . "</td>";
                                echo "<td>" . $fpesoQPM . "</td>";
                                echo "<td>" . $fpesoVPM. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "1" . "</td>";
                                echo "<td>" . $opesoQPM . "</td>";
                                echo "<td>" . $opesoVPM . "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . ".25" . "</td>";
                                echo "<td>" . $cpesoQPM . "</td>";
                                echo "<td>" . $cpesoVPM. "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td>" . "TOTAL" . "</td>";
                                echo "<td>" . "" . "</td>";
                                echo "<td>" . $totalCRPM. "</td>";
                            echo "</tr>";

                            echo "</table>";
                        }
                    ?>
                </div>
                <button class="btn btn-outline-success my-2 my-sm-0" style="align-self: center;" type = "submit" name = "cashRegister" value = "cashRegister" >CASH REGISTER</button>

            </div>

            <div id="postView" class="modal">
                <div class="modal-content modal-content-common" >
                    <div>
                        <span onclick="document.getElementById('postView').style.display='none'" class="close">&times;</span>
                        <label style="width: 150px">Starting OR:</label>
                        <input id = "orv" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text"  name = "startOR" value = "<?php echo $startOR;?>">
                        <label style="width: 150px">Ending OR:</label>
                        <input id = "orv" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text"  name = "endOR" value = "<?php echo $endOR;?>"><br>

                        <label style="width: 150px">Starting SRN:</label>
                        <input id = "orv" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text"  name = "startSRN" value = "<?php echo $startSRN;?>">
                        <label style="width: 150px">Ending SRN:</label>
                        <input id = "orv" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text"  name = "endSRN" value = "<?php echo $endSRN;?>"><br>

                        <label style="width: 150px">Date</label>
                        <input id = "dv" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text" readonly name = "dateRemit" value = "<?php echo $dateRemit;?>">

                        <label style="width: 150px">AM | PM:</label>
                        <select  style="width: 150px" name="am_pm" value="<?php echo $am_pm;?>">
                          <option value="" <?php if($am_pm == "") echo "selected"; ?>>Select</option>
                          <option value="AM" <?php if($am_pm == "AM") echo "selected"; ?>>AM</option>
                          <option value="PM" <?php if($am_pm == "PM") echo "selected"; ?>>PM</option>
                        </select><br>

                        <label style="width: 150px">TOTAL COLLECTION</label>
                        <input id = "tc" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" type="text"  name = "totalC" value = "<?php echo $actualCollection ;?>">

                        <h6>Denomination</h6>

                        <label style="width: 150px"></label>
                        <label style="width: 130px">Quantity</label>
                        <label style="width: 150px"></label>
                        <label style="width: 130px">Value</label>

                        <label style="width: 150px">1000</label>
                        <input id = "tq" class="quantitym" style="width: 130px" type="text" style="border: none;" autocomplete="off" name = "thousandQ" value = "<?php echo $thousandQ;?>">
                        <label style="width: 150px"></label>
                        <input id = "tv" class="famount" style="width: 130px" type="text" style="border: none;" readonly name = "thousandV" value = "<?php echo $thousandV;?>"><br>

                        <label style="width: 150px">500</label>
                        <input id = "fhq" class="quantitym" style="width: 130px" type="text" style="border: none;" autocomplete="off" name = "fhundterQ" value = "<?php echo $fhundterQ;?>">
                        <label style="width: 150px"></label>
                        <input id = "fhv" class="famount" style="width: 130px" type="text" style="border: none;" readonly name = "fhundterV" value = "<?php echo $fhundterV;?>"><br>

                        <label style="width: 150px">200</label>
                        <input id = "thq" class="quantitym" style="width: 130px" type="text" style="border: none;" autocomplete="off" name = "thundredQ" value = "<?php echo $thundredQ;?>">
                        <label style="width: 150px"></label>
                        <input id = "thv" class="famount" style="width: 130px" type="text" style="border: none;" readonly name = "thundredV" value = "<?php echo $thundredV;?>"><br>

                        <label style="width: 150px">100</label>
                        <input id = "ohq" class="quantitym" style="width: 130px" type="text" style="border: none;" autocomplete="off" name = "ohundredQ" value = "<?php echo $ohundredQ;?>">
                        <label style="width: 150px"></label>
                        <input id = "onv" class="famount" style="width: 130px" type="text" style="border: none;" readonly name = "ohundredV" value = "<?php echo $ohundredV;?>"><br>

                        <label style="width: 150px">50</label>
                        <input id = "ftq" class="quantitym" class="quantitym" style="width: 130px" type="text" style="border: none;" autocomplete="off" name = "ftenQ" value = "<?php echo $ftenQ;?>">
                        <label style="width: 150px"></label>
                        <input id = "ftv" class="famount" style="width: 130px" type="text" style="border: none;" readonly name = "ftenV" value = "<?php echo $ftenV;?>"><br>

                        <label style="width: 150px">20</label>
                        <input id = "twq" class="quantitym" style="width: 130px" type="text" style="border: none;" autocomplete="off" name = "ttenQ" value = "<?php echo $ttenQ;?>">
                        <label style="width: 150px"></label>
                        <input id = "twv" class="famount" style="width: 130px" type="text" style="border: none;" readonly name = "ttenV" value = "<?php echo $ttenV;?>"><br>

                        <label style="width: 150px">10</label>
                        <input id = "tnq" class="quantitym" style="width: 130px" type="text" style="border: none;" autocomplete="off" name = "tpesoQ" value = "<?php echo $tpesoQ;?>">
                        <label style="width: 150px"></label>
                        <input id = "tnv" class="famount" style="width: 130px" type="text" style="border: none;" readonly name = "tpesoV" value = "<?php echo $tpesoV;?>"><br>

                        <label style="width: 150px">5</label>
                        <input id = "fvq" class="quantitym" style="width: 130px" type="text" style="border: none;" autocomplete="off" name = "fpesoQ" value = "<?php echo $fpesoQ;?>">
                        <label style="width: 150px"></label>
                        <input id = "fvv" class="famount" style="width: 130px" type="text" style="border: none;" readonly name = "fpesoV" value = "<?php echo $fpesoV;?>"><br>

                        <label style="width: 150px">1</label>
                        <input id = "opq" class="quantitym" style="width: 130px" type="text" style="border: none;" autocomplete="off" name = "opesoQ" value = "<?php echo $opesoQ;?>">
                        <label style="width: 150px"></label>
                        <input id = "opv" class="famount" style="width: 130px" type="text" style="border: none;" readonly name = "opesoV" value = "<?php echo $opesoV;?>"><br>

                        <label style="width: 150px">.25</label>
                        <input id = "cnq" class="quantitym" style="width: 130px" type="text" style="border: none;" autocomplete="off" name = "cpesoQ" value = "<?php echo $cpesoQ;?>">
                        <label style="width: 150px"></label>
                        <input id = "cnv" class="famount" style="width: 130px" type="text" style="border: none;" readonly name = "cpesoV" value = "<?php echo $cpesoV;?>"><br>

                        <label style="width: 150px;font-size: 25px">REMAINING</label>
                        <input id = "remain" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;font-size: 25px" type="text">

                        <label style="width: 150px;font-size: 25px">TOTAL</label>
                        <input id = "totalCR" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;font-size: 25px" type="text" readonly name = "totalCR" value = "<?php echo $totalCR;?>"><br>
                    </div>
                    
                    <button style="width:auto;" class="btn btn-outline-success my-2 my-sm-0" name = "remitCollection" value = "remitCollection" type="submit">REMIT</button>
                </div>
            </div>

            <div id="postSigned" class="modal">
                <div class="modal-content modal-cashregistry" >
                    <div>
                        <span onclick="document.getElementById('postSigned').style.display='none'" class="close">&times;</span>
                        <br>
                        <br>
                        <label style="width: 150px">PREPARED BY:</label>
                        <input id = "orv" style="width: 200px;border: none;border-bottom: 2px solid red;color: red;" type="text"  name = "preparedBy" value = "<?php echo $preparedBy;?>"><br>
                        <label style="width: 150px">CHECK BY:</label>
                        <input id = "orv" style="width: 200px;border: none;border-bottom: 2px solid red;color: red;" type="text"  name = "checkedBy" value = "<?php echo $checkedBy;?>"><br>
                        <label style="width: 150px">RECEIVED BY:</label>
                        <input id = "orv" style="width: 200px;border: none;border-bottom: 2px solid red;color: red;" type="text"  name = "receivedBy" value = "<?php echo $receivedBy;?>"><br>
                        <label style="width: 150px">NOTED BY:</label>
                        <input id = "orv" style="width: 200px;border: none;border-bottom: 2px solid red;color: red;" type="text"  name = "notedBy" value = "<?php echo $notedBy;?>"><br>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="col-sm-12">
        <nav class="navbar navbar-dark" style="background-color:#fff">
            <br>
            <div class="<?php //echo $displayProperty;?>">
                <button id = "remit" onclick="viewModal()" class="btn btn-outline-success my-2 my-sm-0" style="align-self: center;">REMIT CASH COLLECTION</button>
            </div>
        </nav>
    </div>
</div>

<script>
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

    function viewSinged(){
        document.getElementById('postSigned').style.display='block';
    }
</script>

</body>
</html>
