<?php  

require_once 'session.php';

$idNumber [] = "";
$accountNumber [] = "";

$firstName  [] = "";
$middleName [] = "";
$lastName [] = "";

$transactionnumber[] = "";
$loanApplicationNumber[] = "";
$voucherNumber[] = "";
//$orNumber[] = 0;
//cr
$serviceFee[] = 0;
$fillingFee[] = 0;
$notarialFee[] = 0;
//$PrincipalFee[] = 0;
$insuranceFee[] = 0;
$interestRevenue[] = 0;
$dateTransaction[] = "";
$scAmount[] = 0;
$sdAmount[] = 0;


//reloan cr
$loanBalance[] = 0;
$riceLoan[] = 0;
$loanPenalty[] = 0;
$ricePenalty[] = 0;

//Exp dr
$expenses[] = 0;
$loanRelease[] = 0;
$loanAmount[] = 0;


$totalServiceFee = 0;
$totalFillinfFee = 0;
$totalNotarialFee = 0;
$totalInsuranceFee = 0;
$totalPrincipal = 0;
$totalInterestRevenue = 0;
$totalscAmount = 0;
$totalsdAmount = 0;
$totalLoanBalance = 0;
$totalLoanPenalty = 0;
$totalRiceBalance = 0;
$totalRicePenalty = 0;

$totalLoanAmount = 0;
$totalLoanRelease = 0;
$totalExpenses = 0;

$startDate = "";
$endDate = "";
$releaseDate = "";

$searchReport = "";
$printReport = "";
$numRow = "";

$exitB = "";

$countErr = 0;

$fullNameD[] = "";

require('public/fpdf181/fpdf.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["searchReport"])) {
        $searchReport = test_input($_POST["searchReport"]);
    }

    if (!empty($_POST["printReport"])) {
        $printReport = test_input($_POST["printReport"]);
    }

    if (!empty($_POST["exitB"])) {
        $exitB = test_input($_POST["exitB"]);
    }

    if (empty($_POST["startDate"])) {
        $countErr++;
    }else {
        $startDate = test_input($_POST["startDate"]);
    }

    if (empty($_POST["endDate"])) {
        $countErr++;
    }else {
        $endDate = test_input($_POST["endDate"]);
    }

    if($exitB == "exitB"){
        session_destroy();
    }

    if($searchReport == "searchReport" or $printReport == "printReport"){
        $cl[] = 0;
        $lb[] = 0;
        $pnl[] = 0;
        $pnr[] = 0;
        $rcln[] = 0;
        $exp[] = 0;
        $cbur[] = 0;
        $sdr[] = 0;
        $tdw[] = 0;
        $fdw[] = 0;
        $cbuw[] = 0;
        $voucherNumberD[] = "";
        $dateTransactionD[] = "";
        $idNumberD[] = "";
        $counter = 0;

        $counterD = 0;

        $sqlNameD = "SELECT * FROM  disbursement_table WHERE date_transaction ='$startDate' order by voucher_number  asc";
        $resultNameD = $conn->query($sqlNameD);
        $numRow = mysqli_num_rows($resultNameD);

        if($resultNameD->num_rows > 0){
            while ($row = mysqli_fetch_array($resultNameD)) {
                $cl[$counterD] = $row['cl'];
                $lb[$counterD] = $row['lb'];
                $pnl[$counterD] = $row['pnl'];
                $pnr[$counterD] = $row['pnr'];
                $rcln[$counterD] = $row['rcln'];
                $exp[$counterD] = $row['exp'];
                $cbur[$counterD] = $row['cbur'];
                $sdr[$counterD] = $row['sdr'];
                $tdw[$counterD] = $row['tdw'];
                $fdw[$counterD] = $row['fdw'];
                $cbuw[$counterD] = $row['cbuw'];
                $voucherNumberD[$counterD] = $row['voucher_number'];
                $dateTransactionD[$counterD] = $row['date_transaction'];
                $idNumberD[$counterD] = $row['id_number'];

                if($cl[$counterD] == 1){

                    $expenses[$counter] = 0;
                    $cr_dr[$counter] = "";
                    $accountExpense[$counter] = "";


                    //BL
                    $sqlName = "SELECT * FROM  bl_credit_revenue_table WHERE voucher_number ='$voucherNumberD[$counterD]' and id_number = '$idNumberD[$counterD]' ";
                    $resultName = $conn->query($sqlName);
                    //$numRow = mysqli_num_rows($resultName);
                    

                    if($resultName->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultName)) {
                            # code...
                            //$releaseDate = $row['date_transaction'];
                            $transactionnumber[$counter] = $row['transaction_number'];
                            $idNumber[$counter] = $row['id_number'];
                            $loanApplicationNumber[$counter] = $row['loan_application_number'];
                            $voucherNumber[$counter] = $row['voucher_number'];
                            $serviceFee[$counter] = $row['service_fee'];
                            $fillingFee[$counter] = $row['filling_fee'];
                            $notarialFee[$counter] = $row['notarial_fee'];
                            $insuranceFee[$counter] = $row['insurance_fee'];
                            $interestRevenue[$counter] = $row['interest_revenue'];
                            $loanBalance[$counter] = $row['loanb_v'];
                            $loanRelease[$counter] = $row['amount_release'];
                            
                            $dateTransaction[$counter] = $row['date_transaction'];
                            $expenses[$counter] = 0;
                            $cr_dr[$counter] = "";
                            $accountExpense[$counter] = "";


                            if($cbur[$counterD] == 1){
                                $sqlName = "SELECT * FROM  share_capital_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $scAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $scAmount[$counter] = 0;
                            }

                            if($sdr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  savings_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $sdAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $sdAmount[$counter] = 0;
                            }

                            if($pnl[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'pnti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $ricePenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $ricePenalty[$counter] = 0;
                            }

                            if($pnr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'plti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $loanPenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $loanPenalty[$counter] = 0;
                            }

                            if($rcln[$counterD] == 1){
                                $sqlName = "SELECT * FROM  disbursement_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumber[$counter]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){

                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $riceLoan[$counter] = $row['rcln_value'];
                                    }
                                }
                            }else{
                                $riceLoan[$counter] = 0;
                            }

                            $loanAmount[$counter] = $loanRelease[$counter] + $serviceFee[$counter] + $fillingFee[$counter] + $notarialFee[$counter] + $insuranceFee[$counter] + $interestRevenue[$counter] + $loanBalance[$counter] + $riceLoan[$counter] + $loanPenalty[$counter] + $ricePenalty[$counter] + $sdAmount[$counter] + $scAmount[$counter];
                        }
                    }else{
                        //$numRow--;
                    }

                    //RL
                    $sqlName = "SELECT * FROM  rl_credit_revenue_table WHERE voucher_number ='$voucherNumberD[$counterD]' and id_number = '$idNumberD[$counterD]' ";
                    $resultName = $conn->query($sqlName);
                    //$numRow = $numRow + mysqli_num_rows($resultName);
                    //$counter = 0;

                    if($resultName->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultName)) {
                            # code...
                            //$releaseDate = $row['date_transaction'];
                            $transactionnumber[$counter] = $row['transaction_number'];
                            $idNumber[$counter] = $row['id_number'];
                            $loanApplicationNumber[$counter] = $row['loan_application_number'];
                            $voucherNumber[$counter] = $row['voucher_number'];
                            $serviceFee[$counter] = $row['service_fee'];
                            $fillingFee[$counter] = $row['filling_fee'];
                            $notarialFee[$counter] = $row['notarial_fee'];
                            $insuranceFee[$counter] = $row['insurance_fee'];
                            $interestRevenue[$counter] = $row['interest_revenue'];
                            $loanBalance[$counter] = $row['loanb_v'];
                            $loanRelease[$counter] = $row['amount_release'];

                            $dateTransaction[$counter] = $row['date_transaction'];
                            $expenses[$counter] = 0;
                            $cr_dr[$counter] = "";
                            $accountExpense[$counter] = "";


                            if($cbur[$counterD] == 1){
                                $sqlName = "SELECT * FROM  share_capital_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $scAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $scAmount[$counter] = 0;
                            }

                            if($sdr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  savings_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $sdAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $sdAmount[$counter] = 0;
                            }

                            if($pnl[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'pnti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $ricePenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $ricePenalty[$counter] = 0;
                            }

                            if($pnr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'plti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $loanPenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $loanPenalty[$counter] = 0;
                            }

                            if($rcln[$counterD] == 1){
                                $sqlName = "SELECT * FROM  disbursement_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumber[$counter]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){

                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $riceLoan[$counter] = $row['rcln_value'];
                                    }
                                }
                            }else{
                                $riceLoan[$counter] = 0;
                            }

                            $loanAmount[$counter] = $loanRelease[$counter] + $serviceFee[$counter] + $fillingFee[$counter] + $notarialFee[$counter] + $insuranceFee[$counter] + $interestRevenue[$counter] + $loanBalance[$counter] + $riceLoan[$counter] + $loanPenalty[$counter] + $ricePenalty[$counter] + $sdAmount[$counter] + $scAmount[$counter];
                        }
                    }else{
                        //$numRow--;
                    }

                    //CL
                    $sqlName = "SELECT * FROM  cl_credit_revenue_table WHERE voucher_number ='$voucherNumberD[$counterD]' and id_number = '$idNumberD[$counterD]' ";
                    $resultName = $conn->query($sqlName);
                    //$numRow = $numRow + mysqli_num_rows($resultName);
                    //$counter = 0;

                    if($resultName->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultName)) {
                            # code...
                            //$releaseDate = $row['date_transaction'];
                            $transactionnumber[$counter] = $row['transaction_number'];
                            $idNumber[$counter] = $row['id_number'];
                            $loanApplicationNumber[$counter] = $row['loan_application_number'];
                            $voucherNumber[$counter] = $row['voucher_number'];
                            $serviceFee[$counter] = $row['service_fee'];
                            $fillingFee[$counter] = $row['filling_fee'];
                            $notarialFee[$counter] = $row['notarial_fee'];
                            $insuranceFee[$counter] = $row['insurance_fee'];
                            $interestRevenue[$counter] = $row['interest_revenue'];
                            $loanBalance[$counter] = $row['loanb_v'];
                            $loanRelease[$counter] = $row['amount_release'];

                            $dateTransaction[$counter] = $row['date_transaction'];
                            $expenses[$counter] = 0;
                            $cr_dr[$counter] = "";
                            $accountExpense[$counter] = "";


                            if($cbur[$counterD] == 1){
                                $sqlName = "SELECT * FROM  share_capital_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $scAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $scAmount[$counter] = 0;
                            }

                            if($sdr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  savings_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $sdAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $sdAmount[$counter] = 0;
                            }

                            if($pnl[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'pnti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $ricePenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $ricePenalty[$counter] = 0;
                            }

                            if($pnr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'plti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $loanPenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $loanPenalty[$counter] = 0;
                            }

                            if($rcln[$counterD] == 1){
                                $sqlName = "SELECT * FROM  disbursement_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumber[$counter]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){

                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $riceLoan[$counter] = $row['rcln_value'];
                                    }
                                }
                            }else{
                                $riceLoan[$counter] = 0;
                            }

                            $loanAmount[$counter] = $loanRelease[$counter] + $serviceFee[$counter] + $fillingFee[$counter] + $notarialFee[$counter] + $insuranceFee[$counter] + $interestRevenue[$counter] + $loanBalance[$counter] + $riceLoan[$counter] + $loanPenalty[$counter] + $ricePenalty[$counter] + $sdAmount[$counter] + $scAmount[$counter];
                        }
                    }else{
                        //$numRow--;
                    }

                    //EDL
                    $sqlName = "SELECT * FROM  edl_credit_revenue_table WHERE voucher_number ='$voucherNumberD[$counterD]' and id_number = '$idNumberD[$counterD]' ";
                    $resultName = $conn->query($sqlName);
                    //$numRow = $numRow + mysqli_num_rows($resultName);
                    //$counter = 0;

                    if($resultName->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultName)) {
                            # code...
                            //$releaseDate = $row['date_transaction'];
                            $transactionnumber[$counter] = $row['transaction_number'];
                            $idNumber[$counter] = $row['id_number'];
                            $loanApplicationNumber[$counter] = $row['loan_application_number'];
                            $voucherNumber[$counter] = $row['voucher_number'];
                            $serviceFee[$counter] = $row['service_fee'];
                            $fillingFee[$counter] = $row['filling_fee'];
                            $notarialFee[$counter] = $row['notarial_fee'];
                            $insuranceFee[$counter] = $row['insurance_fee'];
                            $interestRevenue[$counter] = $row['interest_revenue'];
                            $loanBalance[$counter] = $row['loanb_v'];
                            $loanRelease[$counter] = $row['amount_release'];

                            $dateTransaction[$counter] = $row['date_transaction'];
                            $expenses[$counter] = 0;
                            $cr_dr[$counter] = "";
                            $accountExpense[$counter] = "";


                            if($cbur[$counterD] == 1){
                                $sqlName = "SELECT * FROM  share_capital_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $scAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $scAmount[$counter] = 0;
                            }

                            if($sdr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  savings_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $sdAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $sdAmount[$counter] = 0;
                            }

                            if($pnl[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'pnti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $ricePenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $ricePenalty[$counter] = 0;
                            }

                            if($pnr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'plti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $loanPenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $loanPenalty[$counter] = 0;
                            }

                            if($rcln[$counterD] == 1){
                                $sqlName = "SELECT * FROM  disbursement_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumber[$counter]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){

                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $riceLoan[$counter] = $row['rcln_value'];
                                    }
                                }
                            }else{
                                $riceLoan[$counter] = 0;
                            }

                            $loanAmount[$counter] = $loanRelease[$counter] + $serviceFee[$counter] + $fillingFee[$counter] + $notarialFee[$counter] + $insuranceFee[$counter] + $interestRevenue[$counter] + $loanBalance[$counter] + $riceLoan[$counter] + $loanPenalty[$counter] + $ricePenalty[$counter] + $sdAmount[$counter] + $scAmount[$counter];
                        }
                    }else{
                        //$numRow--;
                    }

                    //CML
                    $sqlName = "SELECT * FROM  cml_credit_revenue_table WHERE voucher_number ='$voucherNumberD[$counterD]' and id_number = '$idNumberD[$counterD]' ";
                    $resultName = $conn->query($sqlName);
                    //$numRow = $numRow + mysqli_num_rows($resultName);
                    //$counter = 0;

                    if($resultName->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultName)) {
                            # code...
                            //$releaseDate = $row['date_transaction'];
                            $transactionnumber[$counter] = $row['transaction_number'];
                            $idNumber[$counter] = $row['id_number'];
                            $loanApplicationNumber[$counter] = $row['loan_application_number'];
                            $voucherNumber[$counter] = $row['voucher_number'];
                            $serviceFee[$counter] = $row['service_fee'];
                            $fillingFee[$counter] = $row['filling_fee'];
                            $notarialFee[$counter] = $row['notarial_fee'];
                            $insuranceFee[$counter] = $row['insurance_fee'];
                            $interestRevenue[$counter] = $row['interest_revenue'];
                            $loanBalance[$counter] = $row['loanb_v'];
                            $loanRelease[$counter] = $row['amount_release'];

                            $dateTransaction[$counter] = $row['date_transaction'];
                            $expenses[$counter] = 0;
                            $cr_dr[$counter] = "";
                            $accountExpense[$counter] = "";


                            if($cbur[$counterD] == 1){
                                $sqlName = "SELECT * FROM  share_capital_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $scAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $scAmount[$counter] = 0;
                            }

                            if($sdr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  savings_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $sdAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $sdAmount[$counter] = 0;
                            }

                            if($pnl[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'pnti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $ricePenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $ricePenalty[$counter] = 0;
                            }

                            if($pnr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'plti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $loanPenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $loanPenalty[$counter] = 0;
                            }

                            if($rcln[$counterD] == 1){
                                $sqlName = "SELECT * FROM  disbursement_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumber[$counter]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){

                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $riceLoan[$counter] = $row['rcln_value'];
                                    }
                                }
                            }else{
                                $riceLoan[$counter] = 0;
                            }

                            $loanAmount[$counter] = $loanRelease[$counter] + $serviceFee[$counter] + $fillingFee[$counter] + $notarialFee[$counter] + $insuranceFee[$counter] + $interestRevenue[$counter] + $loanBalance[$counter] + $riceLoan[$counter] + $loanPenalty[$counter] + $ricePenalty[$counter] + $sdAmount[$counter] + $scAmount[$counter];
                        }
                    }else{
                        //$numRow--;
                    }

                    //EML
                    $sqlName = "SELECT * FROM  eml_credit_revenue_table WHERE voucher_number ='$voucherNumberD[$counterD]' and id_number = '$idNumberD[$counterD]' ";
                    $resultName = $conn->query($sqlName);
                    //$numRow = $numRow + mysqli_num_rows($resultName);
                    //$counter = 0;

                    if($resultName->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultName)) {
                            # code...
                            //$releaseDate = $row['date_transaction'];
                            $transactionnumber[$counter] = $row['transaction_number'];
                            $idNumber[$counter] = $row['id_number'];
                            $loanApplicationNumber[$counter] = $row['loan_application_number'];
                            $voucherNumber[$counter] = $row['voucher_number'];
                            $serviceFee[$counter] = $row['service_fee'];
                            $fillingFee[$counter] = $row['filling_fee'];
                            $notarialFee[$counter] = $row['notarial_fee'];
                            $insuranceFee[$counter] = $row['insurance_fee'];
                            $interestRevenue[$counter] = $row['interest_revenue'];
                            $loanBalance[$counter] = $row['loanb_v'];
                            $loanRelease[$counter] = $row['amount_release'];

                            $dateTransaction[$counter] = $row['date_transaction'];
                            $expenses[$counter] = 0;
                            $cr_dr[$counter] = "";
                            $accountExpense[$counter] = "";


                            if($cbur[$counterD] == 1){
                                $sqlName = "SELECT * FROM  share_capital_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $scAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $scAmount[$counter] = 0;
                            }

                            if($sdr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  savings_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $sdAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $sdAmount[$counter] = 0;
                            }

                            if($pnl[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'pnti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $ricePenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $ricePenalty[$counter] = 0;
                            }

                            if($pnr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'plti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $loanPenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $loanPenalty[$counter] = 0;
                            }

                            if($rcln[$counterD] == 1){
                                $sqlName = "SELECT * FROM  disbursement_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumber[$counter]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){

                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $riceLoan[$counter] = $row['rcln_value'];
                                    }
                                }
                            }else{
                                $riceLoan[$counter] = 0;
                            }

                            $loanAmount[$counter] = $loanRelease[$counter] + $serviceFee[$counter] + $fillingFee[$counter] + $notarialFee[$counter] + $insuranceFee[$counter] + $interestRevenue[$counter] + $loanBalance[$counter] + $riceLoan[$counter] + $loanPenalty[$counter] + $ricePenalty[$counter] + $sdAmount[$counter] + $scAmount[$counter];
                        }
                    }else{
                        //$numRow--;
                    }

                    //SL
                    $sqlName = "SELECT * FROM  sl_credit_revenue_table WHERE voucher_number ='$voucherNumberD[$counterD]' and id_number = '$idNumberD[$counterD]' ";
                    $resultName = $conn->query($sqlName);
                    //$numRow = $numRow + mysqli_num_rows($resultName);
                    //$counter = 0;

                    if($resultName->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultName)) {
                            # code...
                            //$releaseDate = $row['date_transaction'];
                            $transactionnumber[$counter] = $row['transaction_number'];
                            $idNumber[$counter] = $row['id_number'];
                            $loanApplicationNumber[$counter] = $row['loan_application_number'];
                            $voucherNumber[$counter] = $row['voucher_number'];
                            $serviceFee[$counter] = $row['service_fee'];
                            $fillingFee[$counter] = $row['filling_fee'];
                            $notarialFee[$counter] = $row['notarial_fee'];
                            $insuranceFee[$counter] = $row['insurance_fee'];
                            $interestRevenue[$counter] = $row['interest_revenue'];
                            $loanBalance[$counter] = $row['loanb_v'];
                            $loanRelease[$counter] = $row['amount_release'];

                            $dateTransaction[$counter] = $row['date_transaction'];
                            $expenses[$counter] = 0;

                            if($cbur[$counterD] == 1){
                                $sqlName = "SELECT * FROM  share_capital_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $scAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $scAmount[$counter] = 0;
                            }

                            if($sdr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  savings_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumberD[$counterD]'";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $sdAmount[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $sdAmount[$counter] = 0;
                            }

                            if($pnl[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'pnti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $ricePenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $ricePenalty[$counter] = 0;
                            }

                            if($pnr[$counterD] == 1){
                                $sqlName = "SELECT * FROM  other_income_table WHERE voucher_number = '$voucherNumber[$counter]' and income_code = 'plti' and id_number = '$idNumberD[$counterD]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){
                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $loanPenalty[$counter] = $row['amount'];
                                    }
                                }
                            }else{
                                $loanPenalty[$counter] = 0;
                            }

                            if($rcln[$counterD] == 1){
                                $sqlName = "SELECT * FROM  disbursement_table WHERE voucher_number = '$voucherNumber[$counter]' and id_number = '$idNumber[$counter]' ";
                                $resultName = $conn->query($sqlName);

                                if($resultName->num_rows > 0){

                                    while ($row = mysqli_fetch_array($resultName)) {
                                        $riceLoan[$counter] = $row['rcln_value'];
                                    }
                                }
                            }else{
                                $riceLoan[$counter] = 0;
                            }

                            $loanAmount[$counter] = $loanRelease[$counter] + $serviceFee[$counter] + $fillingFee[$counter] + $notarialFee[$counter] + $insuranceFee[$counter] + $interestRevenue[$counter] + $loanBalance[$counter] + $riceLoan[$counter] + $loanPenalty[$counter] + $ricePenalty[$counter] + $sdAmount[$counter] + $scAmount[$counter];
                        }
                    }else{
                        //$numRow--;
                    }

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];

                          $fullNameD[$counter] = $lastName[$counter] . ", " . $middleName[$counter] . $firstName[$counter];
                        }
                    }

                    $totalServiceFee = $totalServiceFee + $serviceFee[$counter];
                    $totalFillinfFee = $totalFillinfFee + $fillingFee[$counter];
                    $totalNotarialFee = $totalNotarialFee + $notarialFee[$counter];
                    $totalInsuranceFee = $totalInsuranceFee + $insuranceFee[$counter];
                    $totalInterestRevenue = $totalInterestRevenue + $interestRevenue[$counter];
                    $totalscAmount = $totalscAmount  + $scAmount[$counter];
                    $totalsdAmount = $totalsdAmount  + $sdAmount[$counter];

                    $totalLoanBalance = $totalLoanBalance + $loanBalance[$counter];
                    $totalLoanPenalty = $totalLoanPenalty + $loanPenalty[$counter];

                    $totalRiceBalance = $totalRiceBalance + $riceLoan[$counter];
                    $totalRicePenalty = $totalRicePenalty + $ricePenalty[$counter];

                    $totalLoanAmount = $totalLoanAmount + $loanAmount[$counter];
                    $totalLoanRelease = $totalLoanRelease + $loanRelease[$counter];
                }else{
                    //$transactionnumber[$counter] = $row['transaction_number'];
                    //$idNumber[$counter] = "";
                    //$voucherNumber[$counter] = $row['voucher_number'];
                    $loanApplicationNumber[$counter] = "";
                    $serviceFee[$counter] = 0;
                    $fillingFee[$counter] = 0;
                    $notarialFee[$counter] = 0;
                    $insuranceFee[$counter] = 0;
                    $interestRevenue[$counter] = 0;
                    $loanBalance[$counter] = 0;
                    $sdAmount[$counter] = 0;
                    $scAmount[$counter] = 0;
                    $ricePenalty[$counter] = 0;
                    $loanPenalty[$counter] = 0;
                    $riceLoan[$counter] = 0;
                    $loanRelease[$counter] = 0;
                    $loanAmount[$counter] = 0;
                    //$dateTransaction[$counter] = $row['date_transaction'];
                    //$expenses[$counter] = 0;
                }

                //Expenses
                if($exp[$counterD] == 1){
                    $sqlNameE = "SELECT * FROM  expenses_table WHERE voucher_number ='$voucherNumberD[$counterD]' and expenses_category = '$idNumberD[$counterD]' ";
                    $resultNameE = $conn->query($sqlNameE);
                    //$numRow = mysqli_num_rows($resultName);
                    
                    if($resultNameE->num_rows > 0){
                        while($row = mysqli_fetch_array($resultNameE)){
                            $transactionnumber[$counter] = $row['transaction_number'];
                            $voucherNumber[$counter] = $row['voucher_number'];
                            $dateTransaction[$counter] = $row['date_transaction'];
                            $expenses[$counter] = $row['amount'];
                            $idNumber[$counter] = $row['expenses_category'];
                            $loanApplicationNumber[$counter] = $row['Remarks'];
                            $cr_dr[$counter] = $row['cr_dr'];
                            $accountExpense[$counter] = $row['account_expense'];

                            $sqlbi = "SELECT * FROM  chart_accounts WHERE account_code_lc = '$idNumber[$counter]' ";
                            $resultbi = $conn->query($sqlbi);

                            if($resultbi->num_rows > 0){
                                while ($row = mysqli_fetch_array($resultbi)) {
                                    # code...
                                    $fullNameD[$counter] = $row['account_title'];
                                    $numberCode = $row['account_code'];
                                }
                            }
                            
                            $idNumber[$counter] = $idNumber[$counter] . $numberCode; 
                            $totalExpenses = $totalExpenses + $expenses[$counter];
                        }
                    }
                }

                if($tdw[$counterD] == 1){
                    $sqlNameE = "SELECT * FROM  time_deposit_table WHERE voucher_number ='$voucherNumberD[$counterD]' and id_number = '$idNumberD[$counterD]' ";
                    $resultNameE = $conn->query($sqlNameE);
                    //$numRow = mysqli_num_rows($resultName);
                    
                    if($resultNameE->num_rows > 0){
                        while($row = mysqli_fetch_array($resultNameE)){
                            $transactionnumber[$counter] = $row['transaction_number'];
                            $voucherNumber[$counter] = $row['voucher_number'];
                            $dateTransaction[$counter] = $row['date_transaction'];
                            $expenses[$counter] = $row['amount'];

                            $idNumber[$counter] = $row['id_number'];
                            $loanApplicationNumber[$counter] = 'Time Deposit';
                        }
                    }

                    $totalExpenses = $totalExpenses + $expenses[$counter];

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];

                          $fullNameD[$counter] = $lastName[$counter] . ", " . $middleName[$counter] . $firstName[$counter];
                        }
                    }
                }

                if($fdw[$counterD] == 1){
                    $sqlNameE = "SELECT * FROM  fixed_deposit_table WHERE voucher_number ='$voucherNumberD[$counterD]' and id_number = '$idNumberD[$counterD]' ";
                    $resultNameE = $conn->query($sqlNameE);
                    //$numRow = mysqli_num_rows($resultName);
                    
                    if($resultNameE->num_rows > 0){
                        while($row = mysqli_fetch_array($resultNameE)){
                            $transactionnumber[$counter] = $row['transaction_number'];
                            $voucherNumber[$counter] = $row['voucher_number'];
                            $dateTransaction[$counter] = $row['date_transaction'];
                            $expenses[$counter] = $row['amount'];
                            $loanApplicationNumber[$counter] = 'Fixed Deposit';
                            $idNumber[$counter] = $row['id_number'];                     
                        }
                    }

                    $totalExpenses = $totalExpenses + $expenses[$counter];

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];

                          $fullNameD[$counter] = $lastName[$counter] . ", " . $middleName[$counter] . $firstName[$counter];
                        }
                    }
                }

                if($cbuw[$counterD] == 1){
                    $sqlNameE = "SELECT * FROM  share_capital_table WHERE voucher_number ='$voucherNumberD[$counterD]' and id_number = '$idNumberD[$counterD]' ";
                    $resultNameE = $conn->query($sqlNameE);
                    //$numRow = mysqli_num_rows($resultName);
                    
                    if($resultNameE->num_rows > 0){
                        while($row = mysqli_fetch_array($resultNameE)){
                            $transactionnumber[$counter] = $row['transaction_number'];
                            $voucherNumber[$counter] = $row['voucher_number'];
                            $dateTransaction[$counter] = $row['date_transaction'];
                            $expenses[$counter] = $row['amount'];

                            $idNumber[$counter] = $row['id_number'];
                            $loanApplicationNumber[$counter] = 'Share Capital';
                            //$fullNameD[$counter] = $row['Remarks'];
                            
                        }
                    }

                    $totalExpenses = $totalExpenses + $expenses[$counter];

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];

                          $fullNameD[$counter] = $lastName[$counter] . ", " . $middleName[$counter] . $firstName[$counter];
                        }
                    }
                }

                $counter++;
                $counterD++;
            }
        }

        //CBU/SC
        /*$sqlName = "SELECT * FROM  share_capital_table";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){

            while ($row = mysqli_fetch_array($resultName)) {

                # code...
                $releaseDate = $row['date_transaction'];
                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = "SC";
                    if($row['voucher_number'] != ""){
                        echo "hi";
                        $voucherNumber[$counter] = $row['voucher_number'];
                        $scAmount[$counter] = $row['amount'];
                        $dateTransaction[$counter] = $row['date_transaction'];

                        $serviceFee[$counter] = 0;
                        $fillingFee[$counter] = 0;
                        $notarialFee[$counter] = 0;
                        $insuranceFee[$counter] = 0;
                        $orNumber[$counter] = "-";
                        $interestRevenue[$counter] = 0;
                        $PrincipalFee[$counter] = 0;

                    }elseif($row['reference_number'] != ""){
                        echo "hello";
                        $orNumber[$counter] = $row['reference_number'];
                        $scAmount[$counter] = $row['amount'];
                        $dateTransaction[$counter] = $row['date_transaction'];

                        $interestRevenue[$counter] = 0;
                        $voucherNumber[$counter] = "-";
                        $serviceFee[$counter] = 0;
                        $fillingFee[$counter] = 0;
                        $notarialFee[$counter] = 0;
                        $insuranceFee[$counter] = 0;
                        $PrincipalFee[$counter] = 0;
                    }

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

                    $totalServiceFee = $totalServiceFee + $serviceFee[$counter];
                    $totalFillinfFee = $totalFillinfFee + $fillingFee[$counter];
                    $totalNotarialFee = $totalNotarialFee + $notarialFee[$counter];
                    $totalInsuranceFee = $totalInsuranceFee + $insuranceFee[$counter];
                    $totalPrincipal = $totalPrincipal + $PrincipalFee[$counter];
                    $totalInterestRevenue = $totalInterestRevenue + $interestRevenue[$counter];
                    $totalscAmount = $totalscAmount  + $scAmount[$counter];

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }*/

        //PRINT
        if($printReport == "printReport"){

            $pdf = new FPDF();

            $rowCounter = 0;

            $pdf->SetFont('Arial','B',9);
            $pdf->AddPage('L','Legal', 0);

            //Title
            $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
            $pdf->Cell(100,7,"Credit Cash Receivables");$pdf->Ln();
            $pdf->Cell(30,7,"From");
            $pdf->Cell(30,7,"$startDate");$pdf->Ln();
            $pdf->Cell(30,7,"To");
            $pdf->Cell(30,7,"$endDate");$pdf->Ln();
            //Header
            $pdf->Cell(22,7,"SERVICE ID #",1);
            $pdf->Cell(22,7,"ID #",1);
            $pdf->Cell(65,7,"NAME",1);
            $pdf->Cell(22,7,"VOUCHER #",1);
            $pdf->Cell(22,7,"OR #",1);
            $pdf->Cell(22,7,"SERVICE FEE #",1);
            $pdf->Cell(22,7,"FILLINF FEE",1);
            $pdf->Cell(22,7,"NOTARIAL FEE",1);
            $pdf->Cell(22,7,"INSURANCE FEE",1);
            $pdf->Cell(22,7,"PRINCIPAL FEE",1);
            $pdf->Cell(22,7,"INTEREST FEE",1);
            $pdf->Cell(22,7,"SHARE CAPITAL",1);
            $pdf->Cell(22,7,"DATE",1);
            $pdf->Ln();

            $fullName[] = "";
            $totalSale = 0;

            while($rowCounter < $numRow) {
                $pdf->Cell(22,7,"$loanApplicationNumber[$rowCounter]",1);
                $pdf->Cell(22,7,"$idNumber[$rowCounter]",1);
                $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                $pdf->Cell(65,7,"$fullName[$rowCounter]",1);
                $pdf->Cell(22,7,"$voucherNumber[$rowCounter]",1);
                $pdf->Cell(22,7,"$orNumber[$rowCounter]",1);
                $pdf->Cell(22,7,"$serviceFee[$rowCounter]",1);
                $pdf->Cell(22,7,"$fillingFee[$rowCounter]",1);
                $pdf->Cell(22,7,"$notarialFee[$rowCounter]",1);
                $pdf->Cell(22,7,"$insuranceFee[$rowCounter]",1);
                $pdf->Cell(22,7,"$PrincipalFee[$rowCounter]",1);
                $pdf->Cell(22,7,"$interestRevenue[$rowCounter]",1);
                $pdf->Cell(22,7,"$scAmount[$rowCounter]",1);
                $pdf->Cell(22,7,"$dateTransaction[$rowCounter]",1);
                $pdf->Ln();
                
                $rowCounter ++;
            }

            //Total 
            $pdf->AddPage('L','A4', 0);
            $pdf->Cell(100,7,"Loan Cash Receivables Summary");$pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Loan Summary");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(45,7,"PRINCIPAL",1);
            $pdf->Cell(30,7,"INTEREST",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"$",1);
            $pdf->Cell(45,7,"$totalPrincipal",1);
            $pdf->Cell(30,7,"$totalInterestRevenue",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Service Fee");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"$",1);
            $pdf->Cell(45,7,"$",1);
            $pdf->Cell(30,7,"$totalServiceFee",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Filling Fee");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"$totalFillinfFee",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Notarial Fee");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"$totalNotarialFee",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Insurance Fee");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"$totalInsuranceFee",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Total Share Capital");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"$totalscAmount",1);

            $pdf->Output();
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
<!DOCTYPE html>
<html>
<head>
	<title>Loan Service</title>
    <?php include "css.html" ?>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div>
        <?php //include 'topbar.php';?>
        <div class="row">
            <?php include 'navigation.php';?>
            <div  style="margin-top:70px;margin-left: 16.7%;">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-10">
                            <input type="date" class="form-control" value = "<?php echo $startDate;?>" name = "startDate">
                        </div>
                        <label class="col-md-6 control-label">Start Date</label>
                    </div>

                    <div class="form-group">
                        <div class="col-md-10 form">
                            <button class="btn btn-outline-success my-2 my-sm-0" name = "searchReport" value = "searchReport" type="submit" style="align-self: center;">SEARCH</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 form">
                            <button class="btn btn-outline-success my-2 my-sm-0" name = "printReport" value = "printReport" type="submit" style="align-self: center;">PRINT</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!--
                    <div class="col-lg-3" style="background-color:#fff; padding: 5px; margin: 5px">
                        <h6>Credit Operations</h6>
                        <div class="form-group">
                            <label class="col-md-6 control-label">Service Fees</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $totalServiceFee;?>" readonly>
                            </div>  
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 control-label">Filling Fees</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $totalFillinfFee;?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 control-label">Notarial Fees</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $totalNotarialFee;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 control-label">Insurance Fees</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $totalInsuranceFee;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-10 control-label">Principal</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $totalPrincipal;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-10 control-label">Interest Income from Loans</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $totalInterestRevenue;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-10 control-label">Share Capital</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $totalscAmount;?>" readonly>
                            </div>
                        </div>
                    </div>-->
                </div>
                <p>Loan Cash Receipt</p>
                <br>
                <div class="table table-striped table-hover table-bordered table-dark">
                    <?php
                    echo "<table>
                    <tr>
                        
                        <th>Transaction #</th>
                        <th>ID Number | Code</th>
                        <th>Name | Account</th>
                        <th>Description | Remarks</th>
                        <th>Voucher #</th>
                        <th>Expenses</th>
                        <th>Credit | Debit</th>
                        <th>Trading | Lending</th>
                        <th>Loan Amount</th>
                        <th>Loan Release</th>
                        <th>Service Fee</th>
                        <th>Filing Fee</th>
                        <th>Notarial Fee</th>
                        <th>Insurarance Fee</th>
                        <th>Interest</th>
                        <th>SC Retention</th>
                        <th>SD Retention</th>
                        <th>Loan Balance</th>
                        <th>Loan Penalty</th>
                        <th>Rice Balance</th>
                        <th>Rice Penalty</th>
                        <th>Date Transaction</th>
                    </tr>";

                    $counterh = 0;
                    while($counterh < $numRow) {
                        echo "<tr>";

                            echo "<td>" . $transactionnumber[$counterh] . "</td>";
                            echo "<td>" . $idNumber[$counterh] . "</td>";
                            echo "<td>" . $fullNameD[$counterh] . "</td>";
                            echo "<td>" . $loanApplicationNumber[$counterh] . "</td>";
                            echo "<td>" . $voucherNumber[$counterh] . "</td>";

                            if($expenses[$counterh] == 0){
                                $expenses[$counterh] = "";
                            }
                            echo "<td>" . $expenses[$counterh] . "</td>";

                            if($cr_dr[$counterh] == "cr"){
                                $cr_dr[$counterh] = "Credit";
                            }elseif($cr_dr[$counterh] == "dr"){
                                $cr_dr[$counterh] = "Debit";
                            }

                            echo "<td>" . $cr_dr[$counterh] . "</td>";

                            if($accountExpense[$counterh] == "td"){
                                $accountExpense[$counterh] = "Trading";
                            }elseif($accountExpense[$counterh] == "ld"){
                                $accountExpense[$counterh] = "Lending";
                            }

                            echo "<td>" . $accountExpense[$counterh] . "</td>";

                            if($loanAmount[$counterh] == 0){
                                $loanAmount[$counterh] = "";
                            }
                            echo "<td>" . $loanAmount[$counterh] . "</td>";

                            if($loanRelease[$counterh] == 0){
                                $loanRelease[$counterh] = "";
                            }
                            echo "<td>" . $loanRelease[$counterh] . "</td>";

                            if($serviceFee[$counterh] == 0){
                                $serviceFee[$counterh] = "";
                            }
                            echo "<td>" . $serviceFee[$counterh] . "</td>";

                            if($fillingFee[$counterh] == 0){
                                $fillingFee[$counterh] = "";
                            }
                            echo "<td>" . $fillingFee[$counterh] . "</td>";

                            if($notarialFee[$counterh] == 0){
                                $notarialFee[$counterh] = "";
                            }
                            echo "<td>" . $notarialFee[$counterh] . "</td>";

                            if($insuranceFee[$counterh] == 0){
                                $insuranceFee[$counterh] = "";
                            }
                            echo "<td>" . $insuranceFee[$counterh] . "</td>";

                            if($interestRevenue[$counterh] == 0){
                                $interestRevenue[$counterh] = "";
                            }
                            echo "<td>" . $interestRevenue[$counterh] . "</td>";

                            if($scAmount[$counterh] == 0){
                                $scAmount[$counterh] = "";
                            }
                            echo "<td>" . $scAmount[$counterh] . "</td>";

                            if($sdAmount[$counterh] == 0){
                                $sdAmount[$counterh] = "";
                            }
                            echo "<td>" . $sdAmount[$counterh] . "</td>";

                            if($loanBalance[$counterh] == 0){
                                $loanBalance[$counterh] = "";
                            }
                            echo "<td>" . $loanBalance[$counterh] . "</td>";

                            if($loanPenalty[$counterh] == 0){
                                $loanPenalty[$counterh] = "";
                            }
                            echo "<td>" . $loanPenalty[$counterh] . "</td>";

                            if($riceLoan[$counterh] == 0){
                                $riceLoan[$counterh] = "";
                            }
                            echo "<td>" . $riceLoan[$counterh] . "</td>";

                            if($ricePenalty[$counterh] == 0){
                                $ricePenalty[$counterh] = "";
                            }
                            echo "<td>" . $ricePenalty[$counterh] . "</td>";

                            echo "<td>" . $dateTransaction[$counterh] . "</td>";
                        echo "</tr>";
                        $counterh++;
                    }

                    echo "<tr>";
                            echo "<td>" . "Total" . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . number_format($totalExpenses,'2','.',',') . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . number_format($totalLoanAmount,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalLoanRelease,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalServiceFee,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalFillinfFee,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalNotarialFee,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalInsuranceFee,'2','.',',') . "</td>";    
                            echo "<td>" . number_format($totalInterestRevenue,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalscAmount,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalsdAmount,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalLoanBalance,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalLoanPenalty,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalRiceBalance,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalRicePenalty,'2','.',',') . "</td>";
                            echo "<td>" . "" . "</td>";
                        echo "</tr>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
<?php include "css1.html" ?>
</html>