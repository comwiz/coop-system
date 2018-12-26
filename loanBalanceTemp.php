<?php  

require_once 'session.php';

$idNumber [] = "";
$accountNumber [] = "";

$firstName  [] = "";
$middleName [] = "";
$lastName [] = "";

$startDate = "";
$endDate = "";
$releaseDate = "";

$searchReport = "";
$printReport = "";
$numRow = "";

$totalPaymentBLIT[] = 0;
$totalPaymentBLPT[] = 0;
$totalPaymentBLI[] = 0;
$totalPaymentBLP[] = 0;
$totalBalance[] = 0;

$countErr = "";

$blCheck = "";
$cllCheck = "";
$cmlCheck = "";
$edlCheck = "";
$rlCheck = "";

$clCheck = "";
$cklCheck = "";
$emlCheck = "";
$slCheck = "";

$rclCheck = "";

$alCheck = "";

$exitB = "";
$numRow = 0;

$rclFlag = 0;

$rclPrevP[] = 0;
$rclPrevI[] = 0;

$totalCollectionLR = 0;
$totalCollectionLRP = 0;
$totalCollectionLRI = 0;
$totalBalanceLR = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST"){

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
        header("Location: http://localhost/projectkikz/samplemwmmpc/application/views/home/login.php");
    }

    if (!empty($_POST["blCheck"])) {
        $blCheck = test_input($_POST["blCheck"]);
    }

    if (!empty($_POST["cllCheck"])) {
        $cllCheck = test_input($_POST["cllCheck"]);
    }

    if (!empty($_POST["cmlCheck"])) {
        $cmlCheck = test_input($_POST["cmlCheck"]);
    }

    if (!empty($_POST["edlCheck"])) {
        $edlCheck = test_input($_POST["edlCheck"]);
    }

    if (!empty($_POST["rlCheck"])) {
        $rlCheck = test_input($_POST["rlCheck"]);
    }

    if (!empty($_POST["clCheck"])) {
        $clCheck = test_input($_POST["clCheck"]);
    }

    if (!empty($_POST["cklCheck"])) {
        $cklCheck = test_input($_POST["cklCheck"]);
    }

    if (!empty($_POST["emlCheck"])) {
        $emlCheck = test_input($_POST["emlCheck"]);
    }

    if (!empty($_POST["slCheck"])) {
        $slCheck = test_input($_POST["slCheck"]);
    }

    if (!empty($_POST["rclCheck"])) {
        $rclCheck = test_input($_POST["rclCheck"]);
    }

    if (!empty($_POST["alCheck"])) {
        $alCheck = test_input($_POST["alCheck"]);
    }

    if($searchReport == "searchReport"){

        $counterBalance = 0;
        //BL WHERE loan_status != 'Paid' 
        if($blCheck == "BL" or $alCheck == "AL"){
            $sqlP = "SELECT * FROM  bl_loan_table WHERE (loan_status = 'Paid' and date_paid >= '$startDate' and date_paid <= '$endDate') or (loan_status = 'Released' and date_released <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$endDate') ";
            $resultP = $conn->query($sqlP);
            $numRow = mysqli_num_rows($resultP);

            if($resultP->num_rows > 0){
                while ($row = mysqli_fetch_array($resultP)) {
                    # code...

                    $idNumber[$counterBalance] = $row['id_number'];
                    $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];
                    $loanServiceId[$counterBalance] = $row['loan_service_id'];
                    $loanAmount[$counterBalance] = $row['loan_amount'];
                    $loanTerm[$counterBalance]= $row['loan_term'];
                    $loanInterest[$counterBalance] = $row['loan_interest'];
                    $paymentTerm[$counterBalance] = $row['payment_term'];
                    //new
                    $loanStatus[$counterBalance] = $row['loan_status'];
                    $dateReleased[$counterBalance] = $row['date_released'];
                    $datePaid[$counterBalance] = $row['date_paid'];
                    $loanRelease[$counterBalance] =  "";
                    $loanReleaseP[$counterBalance] = "";
                    $loanReleaseI[$counterBalance] = "";

                    $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counterBalance]' order by last_name asc ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $idNumberS[$counterBalance] = $row['id_number'];
                            $firstName[$counterBalance] = $row['first_name'];
                            $middleName[$counterBalance] = $row['middle_name'];
                            $lastName[$counterBalance] = $row['last_name'];
                        }
                    }

                    $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLD = $conn->query($sqlLD);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLD->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLD)) {
                            # code...
                            $monthDate[$counterBalance] = $row['date_released'];
                            //$monthDate = new DateTime($monthDate);
                        }
                    }

                    //Principal
                    $sqlLP = "SELECT * FROM  bl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;
                    $amountPrincipalTemp = 0;
                    $amountPrincipalTempC = 0;
                    
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            $releaseDate = $row['date_payment'];
                            //Current Principal
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountPrincipalTempC =  $amountPrincipalTempC + $row['amount'];
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }else{
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }
                            
                            if($endDate >= $releaseDate){
                                $amountPrincipalTemp = $amountPrincipalTemp + $row['amount'];
                            }
                            
                            $counterPayment++;
                        }
                        
                        $totalPaymentBLP[$counterBalance] = $amountPrincipalTemp;               
                    }else{
                        $totalPaymentBLP[$counterBalance] = 0;
                        $totalPaymentBLPT[$counterBalance] = 0;
                    }

                    //Interest

                    $sqlLIP = "SELECT * FROM  bl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' and reference_number != '' ";
                    $resultLIP = $conn->query($sqlLIP);
                    $counterInterest = 0;
                    $amountInterestTemp = 0;
                    $amountInterestTempC = 0;
                    
                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $releaseDate = $row['date_transaction'];
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountInterestTempC =  $amountInterestTempC + $row['interest_revenue'];
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }else{
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }
                            if($endDate >= $releaseDate){
                                $amountInterestTemp = $amountInterestTemp + $row['interest_revenue'];
                            }
                            
                            $counterPayment++;
                        }
                        $totalPaymentBLI[$counterBalance] = $amountInterestTemp;
                    }else{
                        $totalPaymentBLI[$counterBalance] = 0;
                        $totalPaymentBLIT[$counterBalance] = 0;
                    }

                    $totalBalance[$counterBalance] = $loanAmount[$counterBalance] - ($totalPaymentBLP[$counterBalance] - $totalPaymentBLPT[$counterBalance]) - $totalPaymentBLPT[$counterBalance];
                    
                    $counterBalance++;
                }
            }
        }

        //CLL
        if($cllCheck == "CLL" or $alCheck == "AL"){
            $sqlP = "SELECT * FROM  cll_loan_table WHERE ((loan_status = 'Paid' and date_paid >= '$startDate' and date_paid <= '$endDate') or loan_status = 'Released' and date_released <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$endDate') ";
            $resultP = $conn->query($sqlP);
            $numRow = $numRow + mysqli_num_rows($resultP);

            if($resultP->num_rows > 0){
                while ($row = mysqli_fetch_array($resultP)) {
                    # code...

                    $idNumber[$counterBalance] = $row['id_number'];
                    $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];
                    $loanServiceId[$counterBalance] = $row['loan_service_id'];
                    $loanAmount[$counterBalance] = $row['loan_amount'];
                    $loanTerm[$counterBalance]= $row['loan_term'];
                    $loanInterest[$counterBalance] = $row['loan_interest'];
                    $paymentTerm[$counterBalance] = $row['payment_term'];

                    $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counterBalance]' order by last_name asc ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $idNumberS[$counterBalance] = $row['id_number'];
                            $firstName[$counterBalance] = $row['first_name'];
                            $middleName[$counterBalance] = $row['middle_name'];
                            $lastName[$counterBalance] = $row['last_name'];
                        }
                    }

                    $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLD = $conn->query($sqlLD);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLD->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLD)) {
                            # code...
                            $monthDate[$counterBalance] = $row['date_released'];
                            //$monthDate = new DateTime($monthDate);
                        }
                    }

                    //remooval
                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counterBalance]' ";
                    $resultLS = $conn->query($sqlLS);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterest = $row['type_interest'];
                        }
                    }

                    //Principal
                    $sqlLP = "SELECT * FROM  cll_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;
                    $amountPrincipalTemp = 0;
                    $amountPrincipalTempC = 0;
                    
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            $releaseDate = $row['date_payment'];
                            //Current Principal
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountPrincipalTempC =  $amountPrincipalTempC + $row['amount'];
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }else{
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }

                            if($endDate >= $releaseDate){
                                $amountPrincipalTemp = $amountPrincipalTemp + $row['amount'];
                            }
                            
                            $counterPayment++;
                        }
                        
                        $totalPaymentBLP[$counterBalance] = $amountPrincipalTemp;               
                    }else{
                        $totalPaymentBLP[$counterBalance] = 0;
                        $totalPaymentBLPT[$counterBalance] = 0;
                    }

                    $sqlLIP = "SELECT * FROM  cll_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' and reference_number != '' ";
                    $resultLIP = $conn->query($sqlLIP);
                    $counterInterest = 0;
                    $amountInterestTemp = 0;
                    $amountInterestTempC = 0;
                    
                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $releaseDate = $row['date_transaction'];
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountInterestTempC =  $amountInterestTempC + $row['interest_revenue'];
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }else{
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }
                            if($endDate >= $releaseDate){
                                $amountInterestTemp = $amountInterestTemp + $row['interest_revenue'];
                            }
                            
                            $counterPayment++;
                        }
                        $totalPaymentBLI[$counterBalance] = $amountInterestTemp;
                    }else{
                        $totalPaymentBLI[$counterBalance] = 0;
                        $totalPaymentBLIT[$counterBalance] = 0;
                    }

                    $totalBalance[$counterBalance] = $loanAmount[$counterBalance] - ($totalPaymentBLP[$counterBalance] - $totalPaymentBLPT[$counterBalance]) - $totalPaymentBLPT[$counterBalance];
                    $counterBalance++;
                }
            }
        }

        //EDL
        if($edlCheck == "EDL" or $alCheck == "AL"){
            $sqlP = "SELECT * FROM  edl_loan_table WHERE (loan_status = 'Released' and date_released <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$startDate' and date_paid <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$endDate') ";
            $resultP = $conn->query($sqlP);
            $numRow = $numRow + mysqli_num_rows($resultP);

            if($resultP->num_rows > 0){
                while ($row = mysqli_fetch_array($resultP)) {
                    # code...
                    $idNumber[$counterBalance] = $row['id_number'];
                    $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];
                    $loanServiceId[$counterBalance] = $row['loan_service_id'];
                    $loanAmount[$counterBalance] = $row['loan_amount'];
                    $loanTerm[$counterBalance]= $row['loan_term'];
                    $loanInterest[$counterBalance] = $row['loan_interest'];
                    $paymentTerm[$counterBalance] = $row['payment_term'];

                    $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counterBalance]' order by last_name asc ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $idNumberS[$counterBalance] = $row['id_number'];
                            $firstName[$counterBalance] = $row['first_name'];
                            $middleName[$counterBalance] = $row['middle_name'];
                            $lastName[$counterBalance] = $row['last_name'];
                        }
                    }

                    $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLD = $conn->query($sqlLD);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLD->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLD)) {
                            # code...
                            $monthDate[$counterBalance] = $row['date_released'];
                            //$monthDate = new DateTime($monthDate);
                        }
                    }

                    //remooval
                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counterBalance]' ";
                    $resultLS = $conn->query($sqlLS);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterest = $row['type_interest'];
                        }
                    }

                    //Principal
                    $sqlLP = "SELECT * FROM  edl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;
                    $amountPrincipalTemp = 0;
                    $amountPrincipalTempC = 0;
                    
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            $releaseDate = $row['date_payment'];
                            //Current Principal
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountPrincipalTempC =  $amountPrincipalTempC + $row['amount'];
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }else{
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }

                            if($endDate >= $releaseDate){
                                $amountPrincipalTemp = $amountPrincipalTemp + $row['amount'];
                            }
                            
                            $counterPayment++;
                        }
                        
                        $totalPaymentBLP[$counterBalance] = $amountPrincipalTemp;               
                    }else{
                        $totalPaymentBLP[$counterBalance] = 0;
                        $totalPaymentBLPT[$counterBalance] = 0;
                    }

                    $sqlLIP = "SELECT * FROM  edl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' and reference_number != '' ";
                    $resultLIP = $conn->query($sqlLIP);
                    $counterInterest = 0;
                    $amountInterestTemp = 0;
                    $amountInterestTempC = 0;
                    
                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $releaseDate = $row['date_transaction'];
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountInterestTempC =  $amountInterestTempC + $row['interest_revenue'];
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }else{
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }
                            if($endDate >= $releaseDate){
                                $amountInterestTemp = $amountInterestTemp + $row['interest_revenue'];
                            }
                            
                            $counterPayment++;
                        }
                        $totalPaymentBLI[$counterBalance] = $amountInterestTemp;
                    }else{
                        $totalPaymentBLI[$counterBalance] = 0;
                        $totalPaymentBLIT[$counterBalance] = 0;
                    }

                    $totalBalance[$counterBalance] = $loanAmount[$counterBalance] - ($totalPaymentBLP[$counterBalance] - $totalPaymentBLPT[$counterBalance]) - $totalPaymentBLPT[$counterBalance];
                    $counterBalance++;
                }
            }
        }

        
        //CML
        if($cmlCheck == "CML" or $alCheck == "AL"){
            $sqlP = "SELECT * FROM  cml_loan_table WHERE (loan_status = 'Released' and date_released <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$startDate' and date_paid <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$endDate') ";
            $resultP = $conn->query($sqlP);
            $numRow = $numRow + mysqli_num_rows($resultP);

            if($resultP->num_rows > 0){
                while ($row = mysqli_fetch_array($resultP)) {
                    # code...
                    $idNumber[$counterBalance] = $row['id_number'];
                    $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];
                    $loanServiceId[$counterBalance] = $row['loan_service_id'];
                    $loanAmount[$counterBalance] = $row['loan_amount'];
                    $loanTerm[$counterBalance]= $row['loan_term'];
                    $loanInterest[$counterBalance] = $row['loan_interest'];
                    $paymentTerm[$counterBalance] = $row['payment_term'];

                    $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counterBalance]' order by last_name asc ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $idNumberS[$counterBalance] = $row['id_number'];
                            $firstName[$counterBalance] = $row['first_name'];
                            $middleName[$counterBalance] = $row['middle_name'];
                            $lastName[$counterBalance] = $row['last_name'];
                        }
                    }

                    $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLD = $conn->query($sqlLD);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLD->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLD)) {
                            # code...
                            $monthDate[$counterBalance] = $row['date_released'];
                            //$monthDate = new DateTime($monthDate);
                        }
                    }

                    //remooval
                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counterBalance]' ";
                    $resultLS = $conn->query($sqlLS);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterest = $row['type_interest'];
                        }
                    }

                    //Principal
                    $sqlLP = "SELECT * FROM  cml_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;
                    $amountPrincipalTemp = 0;
                    $amountPrincipalTempC = 0;
                    
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            $releaseDate = $row['date_payment'];
                            //Current Principal
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountPrincipalTempC =  $amountPrincipalTempC + $row['amount'];
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }else{
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }

                            if($endDate >= $releaseDate){
                                $amountPrincipalTemp = $amountPrincipalTemp + $row['amount'];
                            }
                            $counterPayment++;
                        }
                        
                        $totalPaymentBLP[$counterBalance] = $amountPrincipalTemp;               
                    }else{
                        $totalPaymentBLP[$counterBalance] = 0;
                        $totalPaymentBLPT[$counterBalance] = 0;
                    }

                    $sqlLIP = "SELECT * FROM  cml_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' and reference_number != '' ";
                    $resultLIP = $conn->query($sqlLIP);
                    $counterInterest = 0;
                    $amountInterestTemp = 0;
                    $amountInterestTempC = 0;
                    
                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $releaseDate = $row['date_transaction'];
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountInterestTempC =  $amountInterestTempC + $row['interest_revenue'];
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }else{
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }
                            if($endDate >= $releaseDate){
                                $amountInterestTemp = $amountInterestTemp + $row['interest_revenue'];
                            }
                            
                            $counterPayment++;
                        }
                        $totalPaymentBLI[$counterBalance] = $amountInterestTemp;
                    }else{
                        $totalPaymentBLI[$counterBalance] = 0;
                        $totalPaymentBLIT[$counterBalance] = 0;
                    }

                    $totalBalance[$counterBalance] = $loanAmount[$counterBalance] - ($totalPaymentBLP[$counterBalance] - $totalPaymentBLPT[$counterBalance]) - $totalPaymentBLPT[$counterBalance];
                    $counterBalance++;
                }
            }
        }

        $amount = 0;

        //RL
        if($rlCheck == "RL" or $alCheck == "AL"){
            $sqlP = "SELECT * FROM  rl_loan_table WHERE (loan_status = 'Paid' and date_paid >= '$startDate' and date_paid <= '$endDate') or (loan_status = 'Released' and date_released <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$endDate') ";
            $resultP = $conn->query($sqlP);
            $numRow = $numRow + mysqli_num_rows($resultP);

            if($resultP->num_rows > 0){
                while ($row = mysqli_fetch_array($resultP)) {
                    # code...
                    $idNumber[$counterBalance] = $row['id_number'];
                    $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];
                    $loanServiceId[$counterBalance] = $row['loan_service_id'];
                    $loanAmount[$counterBalance] = $row['loan_amount'];
                    $loanTerm[$counterBalance]= $row['loan_term'];
                    $loanInterest[$counterBalance] = $row['loan_interest'];
                    $paymentTerm[$counterBalance] = $row['payment_term'];
                    //new
                    $loanStatus[$counterBalance] = $row['loan_status'];
                    $dateReleased[$counterBalance] = $row['date_released'];
                    $datePaid[$counterBalance] = $row['date_paid'];
                    $loanRelease[$counterBalance] =  "";
                    $loanReleaseP[$counterBalance] = "";
                    $loanReleaseI[$counterBalance] = "";

                    $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counterBalance]' order by last_name asc ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $idNumberS[$counterBalance] = $row['id_number'];
                            $firstName[$counterBalance] = $row['first_name'];
                            $middleName[$counterBalance] = $row['middle_name'];
                            $lastName[$counterBalance] = $row['last_name'];
                        }
                    }

                    $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLD = $conn->query($sqlLD);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLD->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLD)) {
                            # code...
                            $monthDate[$counterBalance] = $row['date_released'];
                            //$monthDate = new DateTime($monthDate);
                        }
                    }

                    //remooval
                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counterBalance]' ";
                    $resultLS = $conn->query($sqlLS);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterest = $row['type_interest'];
                        }
                    }

                    //Principal
                    $sqlLP = "SELECT * FROM  rl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;
                    $amountPrincipalTemp = 0;
                    $amountPrincipalTempC = 0;
                    
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            $releaseDate = $row['date_payment'];
                            //Current Principal
                            
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountPrincipalTempC =  $amountPrincipalTempC + $row['amount'];
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }else{
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }

                            if($endDate >= $releaseDate){
                                $amountPrincipalTemp = $amountPrincipalTemp + $row['amount'];
                            }
                            
                            $counterPayment++;
                        }
                        $totalPaymentBLP[$counterBalance] = $amountPrincipalTemp;               
                    }else{
                        $totalPaymentBLP[$counterBalance] = 0;
                        $totalPaymentBLPT[$counterBalance] = 0;
                    }

                    

                    $sqlLIP = "SELECT * FROM  rl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' and reference_number != '' ";
                    $resultLIP = $conn->query($sqlLIP);
                    $counterInterest = 0;
                    $amountInterestTemp = 0;
                    $amountInterestTempC = 0;
                    
                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $releaseDate = $row['date_transaction'];
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountInterestTempC =  $amountInterestTempC + $row['interest_revenue'];
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }else{
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }
                            if($endDate >= $releaseDate){
                                $amountInterestTemp = $amountInterestTemp + $row['interest_revenue'];
                            }
                            
                            $counterPayment++;
                        }
                        $totalPaymentBLI[$counterBalance] = $amountInterestTemp;
                    }else{
                        $totalPaymentBLI[$counterBalance] = 0;
                        $totalPaymentBLIT[$counterBalance] = 0;
                    }

                    $totalBalance[$counterBalance] = $loanAmount[$counterBalance] - ($totalPaymentBLP[$counterBalance] - $totalPaymentBLPT[$counterBalance]) - $totalPaymentBLPT[$counterBalance];
                    $counterBalance++;
                }
            }
        }

        //PL
        if($rlCheck == "PL" or $alCheck == "AT"){
            $sqlP = "SELECT * FROM  pl_loan_table WHERE (loan_status = 'Released' and date_released <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$startDate' and date_paid <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$endDate') ";
            $resultP = $conn->query($sqlP);
            $numRow = $numRow + mysqli_num_rows($resultP);

            if($resultP->num_rows > 0){
                while ($row = mysqli_fetch_array($resultP)) {
                    # code...
                    $idNumber[$counterBalance] = $row['id_number'];
                    $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];
                    $loanServiceId[$counterBalance] = $row['loan_service_id'];
                    $loanAmount[$counterBalance] = $row['loan_amount'];
                    $loanTerm[$counterBalance]= $row['loan_term'];
                    $loanInterest[$counterBalance] = $row['loan_interest'];
                    $paymentTerm[$counterBalance] = $row['payment_term'];

                    $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counterBalance]' order by last_name asc ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $idNumberS[$counterBalance] = $row['id_number'];
                            $firstName[$counterBalance] = $row['first_name'];
                            $middleName[$counterBalance] = $row['middle_name'];
                            $lastName[$counterBalance] = $row['last_name'];
                        }
                    }

                    $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLD = $conn->query($sqlLD);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLD->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLD)) {
                            # code...
                            $monthDate[$counterBalance] = $row['date_released'];
                            //$monthDate = new DateTime($monthDate);
                        }
                    }

                    //remooval
                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counterBalance]' ";
                    $resultLS = $conn->query($sqlLS);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterest = $row['type_interest'];
                        }
                    }

                    //Principal
                    $sqlLP = "SELECT * FROM  pl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;
                    $amountPrincipalTemp = 0;
                    $amountPrincipalTempC = 0;
                    
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            $releaseDate = $row['date_payment'];
                            //Current Principal
                            
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountPrincipalTempC =  $amountPrincipalTempC + $row['amount'];
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }else{
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }

                            if($endDate >= $releaseDate){
                                $amountPrincipalTemp = $amountPrincipalTemp + $row['amount'];
                            }
                            
                            $counterPayment++;
                        }
                        $totalPaymentBLP[$counterBalance] = $amountPrincipalTemp;               
                    }else{
                        $totalPaymentBLP[$counterBalance] = 0;
                        $totalPaymentBLPT[$counterBalance] = 0;
                    }

                    

                    $sqlLIP = "SELECT * FROM  pl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' and reference_number != '' ";
                    $resultLIP = $conn->query($sqlLIP);
                    $counterInterest = 0;
                    $amountInterestTemp = 0;
                    $amountInterestTempC = 0;
                    
                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $releaseDate = $row['date_transaction'];
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountInterestTempC =  $amountInterestTempC + $row['interest_revenue'];
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }else{
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }
                            if($endDate > $releaseDate){
                                $amountInterestTemp = $amountInterestTemp + $row['interest_revenue'];
                            }
                            
                            $counterPayment++;
                        }
                        $totalPaymentBLI[$counterBalance] = $amountInterestTemp;
                    }else{
                        $totalPaymentBLI[$counterBalance] = 0;
                        $totalPaymentBLIT[$counterBalance] = 0;
                    }

                    $totalBalance[$counterBalance] = $loanAmount[$counterBalance] - ($totalPaymentBLP[$counterBalance] - $totalPaymentBLPT[$counterBalance]) - $totalPaymentBLPT[$counterBalance];
                    $counterBalance++;
                }
            }
        }
        
        //PL
        $serviceIDBL = "";
        $serviceIDCLL = "";
        $serviceIDEDL = "";
        $serviceIDCML = "";
        $serviceIDCML2 = "";
        $serviceIDRLF = "";
        $serviceIDRLS = "";

        if($blCheck == "BL" or $cllCheck == "CLL" or $edlCheck == "EDL" or $cmlCheck == "CML" or $rlCheck == "RL" or $alCheck == "AL"){

            if($blCheck == "BL"){
                $serviceIDBL = "LS6";
            }

            if($cllCheck == "CLL"){
                $serviceIDCLL = "LS12";
            }

            if($edlCheck == "EDL"){
                $serviceIDEDL = "LS10";
            }

            if($cmlCheck == "CML"){
                $serviceIDCML = "LS13";
                $serviceIDCML2 = "LS14";
            }

            if($rlCheck == "RL"){
                $serviceIDRLF = "LS1";
                $serviceIDRLS = "LS2";
            }

            $sqlP = "SELECT * FROM  pl_loan_table WHERE (loan_status = 'Released' and date_released <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$startDate' and date_paid <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$endDate') ";
            $resultP = $conn->query($sqlP);
            $numRow = $numRow + mysqli_num_rows($resultP);

            if($resultP->num_rows > 0){
                while ($row = mysqli_fetch_array($resultP)) {
                    # code...
                    $loanServiceId[$counterBalance] = $row['loan_service_id'];

                    if($serviceIDBL == $loanServiceId[$counterBalance] or $serviceIDCLL == $loanServiceId[$counterBalance] or $serviceIDCML == $loanServiceId[$counterBalance] or $serviceIDCML2 == $loanServiceId[$counterBalance] or $serviceIDEDL == $loanServiceId[$counterBalance] or $serviceIDRLF == $loanServiceId[$counterBalance] or $serviceIDRLS == $loanServiceId[$counterBalance] or $alCheck != ""){
                        $idNumber[$counterBalance] = $row['id_number'];
                        $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];
                        $loanAmount[$counterBalance] = $row['loan_amount'];
                        $loanTerm[$counterBalance]= $row['loan_term'];
                        $loanInterest[$counterBalance] = $row['loan_interest'];
                        $paymentTerm[$counterBalance] = $row['payment_term'];
                        //new
                        $loanStatus[$counterBalance] = $row['loan_status'];
                        $dateReleased[$counterBalance] = $row['date_released'];
                        $datePaid[$counterBalance] = $row['date_paid'];
                        $loanRelease[$counterBalance] =  "";
                        $loanReleaseP[$counterBalance] = "";
                        $loanReleaseI[$counterBalance] = "";

                        $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counterBalance]' order by last_name asc ";
                        $resultLS = $conn->query($sqlLS);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $idNumberS[$counterBalance] = $row['id_number'];
                                $firstName[$counterBalance] = $row['first_name'];
                                $middleName[$counterBalance] = $row['middle_name'];
                                $lastName[$counterBalance] = $row['last_name'];
                            }
                        }

                        $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                        $resultLD = $conn->query($sqlLD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultLD->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLD)) {
                                # code...
                                $monthDate[$counterBalance] = $row['date_released'];
                                //$monthDate = new DateTime($monthDate);
                            }
                        }

                        //remooval
                        $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counterBalance]' ";
                        $resultLS = $conn->query($sqlLS);

                        if($resultLS->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLS)) {
                                # code...
                                $typeInterest = $row['type_interest'];
                            }
                        }

                        //Principal
                        $sqlLP = "SELECT * FROM  pl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                        $resultLP = $conn->query($sqlLP);
                        //$numRow = mysqli_num_rows($resultName);
                        $counterPayment = 0;
                        $amountPrincipalTemp = 0;
                        $amountPrincipalTempC = 0;
                        
                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                $releaseDate = $row['date_payment'];
                                //Current Principal
                                
                                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                    $amountPrincipalTempC =  $amountPrincipalTempC + $row['amount'];
                                    $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                                }else{
                                    $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                                }

                                if($endDate >= $releaseDate){
                                    $amountPrincipalTemp = $amountPrincipalTemp + $row['amount'];
                                }
                                
                                $counterPayment++;
                            }
                                
                            $totalPaymentBLP[$counterBalance] = $amountPrincipalTemp;               
                        }else{
                            $totalPaymentBLP[$counterBalance] = 0;
                            $totalPaymentBLPT[$counterBalance] = 0;
                        }

                        $sqlLIP = "SELECT * FROM  pl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' and reference_number != '' ";
                        $resultLIP = $conn->query($sqlLIP);
                        $counterInterest = 0;
                        $amountInterestTemp = 0;
                        $amountInterestTempC = 0;
                        
                        if($resultLIP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLIP)) {
                                $releaseDate = $row['date_transaction'];
                                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                    $amountInterestTempC =  $amountInterestTempC + $row['interest_revenue'];
                                    $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                                }else{
                                    $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                                }
                                if($endDate >= $releaseDate){
                                    $amountInterestTemp = $amountInterestTemp + $row['interest_revenue'];
                                }
                                
                                $counterPayment++;
                            }
                            $totalPaymentBLI[$counterBalance] = $amountInterestTemp;
                        }else{
                            $totalPaymentBLI[$counterBalance] = 0;
                            $totalPaymentBLIT[$counterBalance] = 0;
                        }

                        $totalBalance[$counterBalance] = $loanAmount[$counterBalance] - ($totalPaymentBLP[$counterBalance] - $totalPaymentBLPT[$counterBalance]) - $totalPaymentBLPT[$counterBalance];

                        $counterBalance++;
                    }else{
                        $numRow--;
                    }
                }
            }
        }

        //CKL
        if($cklCheck == "CKL" or $alCheck == "AL"){
            $sqlP = "SELECT * FROM  ckl_loan_table WHERE (loan_status = 'Released' and date_released <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$startDate' and date_paid <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$endDate') ";
            $resultP = $conn->query($sqlP);
            $numRow = $numRow + mysqli_num_rows($resultP);

            if($resultP->num_rows > 0){
                while ($row = mysqli_fetch_array($resultP)){
                    # code...
                    $idNumber[$counterBalance] = $row['id_number'];
                    $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];
                    $loanServiceId[$counterBalance] = $row['loan_service_id'];
                    $loanAmount[$counterBalance] = $row['loan_amount'];
                    $loanTerm[$counterBalance]= $row['loan_term'];
                    $loanInterest[$counterBalance] = $row['loan_interest'];
                    $paymentTerm[$counterBalance] = $row['payment_term'];

                    $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counterBalance]' order by last_name asc ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $idNumberS[$counterBalance] = $row['id_number'];
                            $firstName[$counterBalance] = $row['first_name'];
                            $middleName[$counterBalance] = $row['middle_name'];
                            $lastName[$counterBalance] = $row['last_name'];
                        }
                    }

                    $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLD = $conn->query($sqlLD);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLD->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLD)) {
                            # code...
                            $monthDate[$counterBalance] = $row['date_released'];
                            //$monthDate = new DateTime($monthDate);
                        }
                    }

                    //remooval
                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counterBalance]' ";
                    $resultLS = $conn->query($sqlLS);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterest = $row['type_interest'];
                        }
                    }

                    //Principal
                    $sqlLP = "SELECT * FROM  ckl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;
                    $amountPrincipalTemp = 0;
                    $amountPrincipalTempC = 0;
                    
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            $releaseDate = $row['date_payment'];
                            //Current Principal
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountPrincipalTempC =  $amountPrincipalTempC + $row['amount'];
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }else{
                                $totalPaymentBLPT[$counterBalance] = 0;
                            }
                            $amountPrincipalTemp = $amountPrincipalTemp + $row['amount'];
                            //$datePaymentP[$counterPayment] = $row['date_payment'];
                            //$amountPrincipalTemp = $amountPrincipalTemp + $amountPaymentP[$counterPayment];
                            
                            $counterPayment++;
                        }
                        
                        $totalPaymentBLP[$counterBalance] = $amountPrincipalTemp;               
                    }else{
                        $totalPaymentBLP[$counterBalance] = 0;
                        $totalPaymentBLPT[$counterBalance] = 0;
                    }

                    $sqlLIP = "SELECT * FROM  ckl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' and reference_number != '' ";
                    $resultLIP = $conn->query($sqlLIP);
                    $counterInterest = 0;
                    $amountInterestTemp = 0;
                    $amountInterestTempC = 0;
                    
                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $releaseDate = $row['date_transaction'];
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountInterestTempC =  $amountInterestTempC + $row['interest_revenue'];
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }else{
                                $totalPaymentBLIT[$counterBalance] = 0;
                            }
                            //$amountPaymentP[$counterPayment] = $row['amount'];
                            //$datePaymentP[$counterPayment] = $row['date_payment'];
                            $amountInterestTemp = $amountInterestTemp + $row['interest_revenue'];
                            
                            $counterPayment++;
                        }
                        $totalPaymentBLI[$counterBalance] = $amountInterestTemp;
                    }else{
                        $totalPaymentBLI[$counterBalance] = 0;
                        $totalPaymentBLIT[$counterBalance] = 0;
                    }

                    $totalBalance[$counterBalance] = $loanAmount[$counterBalance] - ($totalPaymentBLP[$counterBalance] - $totalPaymentBLPT[$counterBalance]) - $totalPaymentBLPT[$counterBalance];
                    $counterBalance++; 
                }
            }
        }

        //CL
        if($clCheck == "CL" or $alCheck == "AL"){
            $sqlP = "SELECT * FROM  cl_loan_table WHERE (loan_status = 'Released' and date_released <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$startDate' and date_paid <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$endDate') ";
            $resultP = $conn->query($sqlP);
            $numRow = $numRow + mysqli_num_rows($resultP);

            if($resultP->num_rows > 0){
                while ($row = mysqli_fetch_array($resultP)){
                    # code...
                    $idNumber[$counterBalance] = $row['id_number'];
                    $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];
                    $loanServiceId[$counterBalance] = $row['loan_service_id'];
                    $loanAmount[$counterBalance] = $row['loan_amount'];
                    $loanTerm[$counterBalance]= $row['loan_term'];
                    $loanInterest[$counterBalance] = $row['loan_interest'];
                    $paymentTerm[$counterBalance] = $row['payment_term'];

                    $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counterBalance]' order by last_name asc ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $idNumberS[$counterBalance] = $row['id_number'];
                            $firstName[$counterBalance] = $row['first_name'];
                            $middleName[$counterBalance] = $row['middle_name'];
                            $lastName[$counterBalance] = $row['last_name'];
                        }
                    }

                    $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLD = $conn->query($sqlLD);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLD->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLD)) {
                            # code...
                            $monthDate[$counterBalance] = $row['date_released'];
                            //$monthDate = new DateTime($monthDate);
                        }
                    }

                    //remooval
                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counterBalance]' ";
                    $resultLS = $conn->query($sqlLS);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterest = $row['type_interest'];
                        }
                    }

                    //Principal
                    $sqlLP = "SELECT * FROM  cl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;
                    $amountPrincipalTemp = 0;
                    $amountPrincipalTempC = 0;
                    
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            $releaseDate = $row['date_payment'];
                            //Current Principal
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountPrincipalTempC =  $amountPrincipalTempC + $row['amount'];
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }else{
                                $totalPaymentBLPT[$counterBalance] = 0;
                            }
                            $amountPrincipalTemp = $amountPrincipalTemp + $row['amount'];
                            //$datePaymentP[$counterPayment] = $row['date_payment'];
                            //$amountPrincipalTemp = $amountPrincipalTemp + $amountPaymentP[$counterPayment];
                            
                            $counterPayment++;
                        }
                        
                        $totalPaymentBLP[$counterBalance] = $amountPrincipalTemp;               
                    }else{
                        $totalPaymentBLP[$counterBalance] = 0;
                        $totalPaymentBLPT[$counterBalance] = 0;
                    }

                    $sqlLIP = "SELECT * FROM  cl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' and reference_number != '' ";
                    $resultLIP = $conn->query($sqlLIP);
                    $counterInterest = 0;
                    $amountInterestTemp = 0;
                    $amountInterestTempC = 0;
                    
                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $releaseDate = $row['date_transaction'];
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountInterestTempC =  $amountInterestTempC + $row['interest_revenue'];
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }else{
                                $totalPaymentBLIT[$counterBalance] = 0;
                            }
                            //$amountPaymentP[$counterPayment] = $row['amount'];
                            //$datePaymentP[$counterPayment] = $row['date_payment'];
                            $amountInterestTemp = $amountInterestTemp + $row['interest_revenue'];
                            
                            $counterPayment++;
                        }
                        $totalPaymentBLI[$counterBalance] = $amountInterestTemp;
                    }else{
                        $totalPaymentBLI[$counterBalance] = 0;
                        $totalPaymentBLIT[$counterBalance] = 0;
                    }

                    $totalBalance[$counterBalance] = $loanAmount[$counterBalance] - ($totalPaymentBLP[$counterBalance] - $totalPaymentBLPT[$counterBalance]) - $totalPaymentBLPT[$counterBalance];
                    $counterBalance++;
                }
            }
        }

        //EML
        if($emlCheck == "EML" or $alCheck == "AL"){
            $sqlP = "SELECT * FROM  eml_loan_table WHERE (loan_status = 'Released' and date_released <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$startDate' and date_paid <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$endDate') ";
            $resultP = $conn->query($sqlP);
            $numRow = $numRow + mysqli_num_rows($resultP);

            if($resultP->num_rows > 0){
                while ($row = mysqli_fetch_array($resultP)) {
                    # code...
                    $idNumber[$counterBalance] = $row['id_number'];
                    $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];
                    $loanServiceId[$counterBalance] = $row['loan_service_id'];
                    $loanAmount[$counterBalance] = $row['loan_amount'];
                    $loanTerm[$counterBalance]= $row['loan_term'];
                    $loanInterest[$counterBalance] = $row['loan_interest'];
                    $paymentTerm[$counterBalance] = $row['payment_term'];

                    $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counterBalance]' order by last_name asc ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $idNumberS[$counterBalance] = $row['id_number'];
                            $firstName[$counterBalance] = $row['first_name'];
                            $middleName[$counterBalance] = $row['middle_name'];
                            $lastName[$counterBalance] = $row['last_name'];
                        }
                    }

                    $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLD = $conn->query($sqlLD);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLD->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLD)) {
                            # code...
                            $monthDate[$counterBalance] = $row['date_released'];
                            //$monthDate = new DateTime($monthDate);
                        }
                    }

                    //remooval
                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counterBalance]' ";
                    $resultLS = $conn->query($sqlLS);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterest = $row['type_interest'];
                        }
                    }

                    //Principal
                    $sqlLP = "SELECT * FROM  eml_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;
                    $amountPrincipalTemp = 0;
                    $amountPrincipalTempC = 0;
                    
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            $releaseDate = $row['date_payment'];
                            //Current Principal
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountPrincipalTempC =  $amountPrincipalTempC + $row['amount'];
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }else{
                                $totalPaymentBLPT[$counterBalance] = 0;
                            }
                            $amountPrincipalTemp = $amountPrincipalTemp + $row['amount'];
                            //$datePaymentP[$counterPayment] = $row['date_payment'];
                            //$amountPrincipalTemp = $amountPrincipalTemp + $amountPaymentP[$counterPayment];
                            
                            $counterPayment++;
                        }
                        
                        $totalPaymentBLP[$counterBalance] = $amountPrincipalTemp;               
                    }else{
                        $totalPaymentBLP[$counterBalance] = 0;
                        $totalPaymentBLPT[$counterBalance] = 0;
                    }

                    $sqlLIP = "SELECT * FROM  eml_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' and reference_number != '' ";
                    $resultLIP = $conn->query($sqlLIP);
                    $counterInterest = 0;
                    $amountInterestTemp = 0;
                    $amountInterestTempC = 0;
                    
                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $releaseDate = $row['date_transaction'];
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountInterestTempC =  $amountInterestTempC + $row['interest_revenue'];
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }else{
                                $totalPaymentBLIT[$counterBalance] = 0;
                            }
                            //$amountPaymentP[$counterPayment] = $row['amount'];
                            //$datePaymentP[$counterPayment] = $row['date_payment'];
                            $amountInterestTemp = $amountInterestTemp + $row['interest_revenue'];
                            
                            $counterPayment++;
                        }
                        $totalPaymentBLI[$counterBalance] = $amountInterestTemp;
                    }else{
                        $totalPaymentBLI[$counterBalance] = 0;
                        $totalPaymentBLIT[$counterBalance] = 0;
                    }

                    $totalBalance[$counterBalance] = $loanAmount[$counterBalance] - ($totalPaymentBLP[$counterBalance] - $totalPaymentBLPT[$counterBalance]) - $totalPaymentBLPT[$counterBalance];
                    $counterBalance++;
                }
            }
        }

        //SL
        if($slCheck == "SL" or $alCheck == "AL"){
            $sqlP = "SELECT * FROM  sl_loan_table WHERE (loan_status = 'Released' and date_released <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$startDate' and date_paid <= '$endDate') or (loan_status = 'Paid' and date_paid >= '$endDate') ";
            $resultP = $conn->query($sqlP);
            $numRow = $numRow + mysqli_num_rows($resultP);

            if($resultP->num_rows > 0){
                while ($row = mysqli_fetch_array($resultP)) {
                    # code...
                    $idNumber[$counterBalance] = $row['id_number'];
                    $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];
                    $loanServiceId[$counterBalance] = $row['loan_service_id'];
                    $loanAmount[$counterBalance] = $row['loan_amount'];
                    $loanTerm[$counterBalance]= $row['loan_term'];
                    $loanInterest[$counterBalance] = $row['loan_interest'];
                    $paymentTerm[$counterBalance] = $row['payment_term'];

                    $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counterBalance]' order by last_name asc ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $idNumberS[$counterBalance] = $row['id_number'];
                            $firstName[$counterBalance] = $row['first_name'];
                            $middleName[$counterBalance] = $row['middle_name'];
                            $lastName[$counterBalance] = $row['last_name'];
                        }
                    }

                    $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLD = $conn->query($sqlLD);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLD->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLD)) {
                            # code...
                            $monthDate[$counterBalance] = $row['date_released'];
                            //$monthDate = new DateTime($monthDate);
                        }
                    }

                    //remooval
                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counterBalance]' ";
                    $resultLS = $conn->query($sqlLS);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterest = $row['type_interest'];
                        }
                    }

                    //Principal
                    $sqlLP = "SELECT * FROM  sl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' ";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;
                    $amountPrincipalTemp = 0;
                    $amountPrincipalTempC = 0;
                    
                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            $releaseDate = $row['date_payment'];
                            //Current Principal
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountPrincipalTempC =  $amountPrincipalTempC + $row['amount'];
                                $totalPaymentBLPT[$counterBalance] = $amountPrincipalTempC;
                            }else{
                                $totalPaymentBLPT[$counterBalance] = 0;
                            }
                            $amountPrincipalTemp = $amountPrincipalTemp + $row['amount'];
                            //$datePaymentP[$counterPayment] = $row['date_payment'];
                            //$amountPrincipalTemp = $amountPrincipalTemp + $amountPaymentP[$counterPayment];
                            
                            $counterPayment++;
                        }
                        
                        $totalPaymentBLP[$counterBalance] = $amountPrincipalTemp;               
                    }else{
                        $totalPaymentBLP[$counterBalance] = 0;
                        $totalPaymentBLPT[$counterBalance] = 0;
                    }

                    $sqlLIP = "SELECT * FROM  sl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber[$counterBalance]' and reference_number != '' ";
                    $resultLIP = $conn->query($sqlLIP);
                    $counterInterest = 0;
                    $amountInterestTemp = 0;
                    $amountInterestTempC = 0;
                    
                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $releaseDate = $row['date_transaction'];
                            if($startDate <= $releaseDate and $endDate >= $releaseDate){
                                $amountInterestTempC =  $amountInterestTempC + $row['interest_revenue'];
                                $totalPaymentBLIT[$counterBalance] = $amountInterestTempC;
                            }else{
                                $totalPaymentBLIT[$counterBalance] = 0;
                            }
                            //$amountPaymentP[$counterPayment] = $row['amount'];
                            //$datePaymentP[$counterPayment] = $row['date_payment'];
                            $amountInterestTemp = $amountInterestTemp + $row['interest_revenue'];
                            
                            $counterPayment++;
                        }
                        $totalPaymentBLI[$counterBalance] = $amountInterestTemp;
                    }else{
                        $totalPaymentBLI[$counterBalance] = 0;
                        $totalPaymentBLIT[$counterBalance] = 0;
                    }

                    $totalBalance[$counterBalance] = $loanAmount[$counterBalance] - ($totalPaymentBLP[$counterBalance] - $totalPaymentBLPT[$counterBalance]) - $totalPaymentBLPT[$counterBalance];
                    $counterBalance++;
                }
            }
        }

        //RCL
        if($rclCheck == "RCL" or $alCheck == "AL"){

            $rclFlag = 1;
            //get name
            $sqlLS = "SELECT * FROM  name_table order by last_name asc ";
            $resultLS = $conn->query($sqlLS);
            $numRow = $numRow + mysqli_num_rows($resultLS);

            $totalRCLPP = 0;
            $totalRCLPI = 0;

            $totalRCLCP = 0;
            $totalRCLCI = 0;

            $totalRCLCLPP = 0;
            $totalRCLCLIP = 0;

            $totalRCLCLP = 0;
            $totalRCLCLI = 0;

            if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {

                    $idNumberS = $row['id_number'];
                    
                    $sqlP = "SELECT * FROM rice_loan_table WHERE id_number = '$idNumberS' and date_released <= '$endDate' and loan_status != 'Void' ";
                    $resultP = $conn->query($sqlP);

                    if($resultP->num_rows > 0){
                        $idNumberRCL[$counterBalance] = $row['id_number'];
                        $firstName[$counterBalance] = $row['first_name'];
                        $middleName[$counterBalance] = $row['middle_name'];
                        $lastName[$counterBalance] = $row['last_name'];

                        while ($rowRCL = mysqli_fetch_array($resultP)) {
                            $loanApplicationNumber = $rowRCL['loan_application_number'];
                            $monthDate = $rowRCL['date_released'];
                            $monthDateP = $rowRCL['date_paid'];
                            $loanStatus = $rowRCL['loan_status'];
                                    
                            if($monthDate <= $startDate){
                                $loanAmountPrev = $rowRCL['loan_amount'];;
                                $loanInterestPrev = $rowRCL['loan_interest'];

                                $totalRCLPP = $totalRCLPP + $loanAmountPrev;
                                $totalRCLPI = $totalRCLPI + $loanInterestPrev;
                            }
                            
                            if($monthDate >= $startDate and $monthDate <= $endDate){
                                $loanAmountCur = $rowRCL['loan_amount'];;
                                $loanInterestCur = $rowRCL['loan_interest'];

                                $totalRCLCP = $totalRCLCP + $loanAmountCur;
                                $totalRCLCI = $totalRCLCI + $loanInterestCur;
                            }

                            //Principal Payment
                            $sqlColP = "SELECT * FROM  rice_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber' ";
                            $resultColP = $conn->query($sqlColP);
                            
                            if($resultColP->num_rows > 0){
                                while ($rowColP = mysqli_fetch_array($resultColP)) {
                                    $monthDateRP = $rowColP['date_payment'];

                                    if($monthDateRP <= $startDate){
                                        $loanPaymentPPrev = $rowColP['amount'];
                                        $totalRCLCLPP = $totalRCLCLPP + $loanPaymentPPrev;

                                        if($idNumberS == "2016-586"){
                                            echo "$totalRCLCLPP ";
                                        }
                                        
                                    }

                                    if($monthDateRP >= $startDate and $monthDateRP <= $endDate){

                                        $loanPaymentPPCur = $rowColP['amount'];
                                        $totalRCLCLP = $totalRCLCLP + $loanPaymentPPCur;
                                        
                                    }
                                }            
                            }

                            //Interest Payment
                            $sqlColI = "SELECT * FROM  rice_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber' " ;
                            $resultColI = $conn->query($sqlColI);
                            
                            if($resultColI->num_rows > 0){
                                while ($rowColI = mysqli_fetch_array($resultColI)) {
                                    $monthDateRI = $rowColI['date_transaction'];
                                    
                                    if($monthDateRI <= $startDate){
                                        $loanPaymentIPrev = $rowColI['interest_revenue'];
                                        $totalRCLCLIP = $totalRCLCLIP + $loanPaymentIPrev;

                                        if($idNumberS == "2016-586"){
                                            echo "$totalRCLCLIP ";
                                        }
                                    }

                                    if($monthDateRI >= $startDate and $monthDateRI <= $endDate){
                                        $loanPaymentICur = $rowColI['interest_revenue'];
                                        $totalRCLCLI = $totalRCLCLI + $loanPaymentICur;
                                    }
                                }            
                            }

                            //$rclPaymentPP[$counterBalance] = $totalRCLCLPP;
                            //$rclPaymentIC[$counterBalance] = $totalRCLCLIP;

                            $rclPrevP[$counterBalance] = $totalRCLPP - $totalRCLCLPP;
                            $rclPrevI[$counterBalance] = $totalRCLPI - $totalRCLCLIP;

                            $rclCurP[$counterBalance] = $totalRCLCP;
                            $rclCurI[$counterBalance] = $totalRCLCI;

                            $rclPaymentPC[$counterBalance] = $totalRCLCLP;
                            $rclPaymentIC[$counterBalance] = $totalRCLCLI;
                        }

                        $totalRCLPP = 0;
                        $totalRCLPI = 0;

                        $totalRCLCP = 0;
                        $totalRCLCI = 0;

                        $totalRCLCLPP = 0;
                        $totalRCLCLIP = 0;

                        $totalRCLCLP = 0;
                        $totalRCLCLI = 0;

                        $counterBalance++;
                    }else{
                        $numRow--;
                    }
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
<!DOCTYPE html>
<html>
<head>
    <title>Loan Service</title>
    <?php include "css.html" ?>
</head>
<body>
<div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php //include 'topbar.php';?>
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-9" style="margin-top:70px;margin-left: 16.7%;">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-10">
                            <input type="date" class="form-control" value = "<?php echo $startDate;?>" name = "startDate">
                        </div>
                        <label class="col-md-6 control-label">Start Date</label>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10">
                            <input type="date" class="form-control" value = "<?php echo $endDate;?>" name = "endDate">
                        </div>
                        <label class="col-md-6 control-label">End Date</label>
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
                    <br>
                </div>
                <div>
                    <p>Select Type of Loan</p>
                    <label> Business Loan </label>
                    <input type="checkbox" value = "BL" name = "blCheck">

                    <label> Calamity Loan </label>
                    <input type="checkbox" value = "CLL" name = "cllCheck">

                    <label> Chattel Mortgage Loan </label>
                    <input type="checkbox" value = "CML" name = "cmlCheck">

                    <label> Educational Loan </label>
                    <input type="checkbox" value = "EDL" name = "edlCheck">

                    <label> Regular Loan </label>
                    <input type="checkbox" value = "RL" name = "rlCheck">

                    <br>
                    <br>
                    <label> Cash Loan </label>
                    <input type="checkbox" value = "CL" name = "clCheck">

                    <label> Check Loan </label>
                    <input type="checkbox" value = "CKL" name = "cklCheck">

                    <label> Emergency Loan </label>
                    <input type="checkbox" value = "EML" name = "emlCheck">

                    <label> Special Loan </label>
                    <input type="checkbox" value = "SL" name = "slCheck">
                    <br>

                    <label> Rice Loan </label>
                    <input type="checkbox" value = "RCL" name = "rclCheck">
                    <br>

                    <label> Select all </label>
                    <input type="checkbox" value = "AT" name = "alCheck">
                </div>
                <br>
                <p>Loan Balance</p>
                <br>
                <div class="table table-striped table-hover table-bordered">
                    <?php

                    if($rclFlag != 1){
                        echo "<table>
                        <tr>
                            <th>LAN</th>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Date Released</th>
                            <th>Term</th>
                            <th>Previous Balance</th>
                            <th>Collection</th>
                            <th>Principal</th>

                            <th>Releases</th>
                            <th>Capital</th>

                            <th>Interest</th>
                            <th>Balance</th>
                        </tr>";

                        $counterh = 0;
                        $totalBalanceLR = 0;
                        $totalCollectionLR = 0;
                        $totalCollectionLRP = 0;
                        $totalCollectionLRI = 0;
                        $totalPreviousBalance = 0;

                        array_multisort($lastName, $firstName, $middleName, $loanApplicationNumber, $idNumber, $monthDate, $loanTerm, $loanAmount, $totalPaymentBLIT, $totalPaymentBLPT, $totalBalance, $loanStatus);

                        while($counterh < $numRow) {
                            
                            echo "<tr>";
                                echo "<td>" . $loanApplicationNumber[$counterh] . "</td>";
                                echo "<td>" . $idNumber[$counterh] . "</td>";
                                echo "<td>" . $lastName[$counterh] . ", " . $firstName[$counterh] . " " . $middleName[$counterh] . "</td>";
                                echo "<td>" . $monthDate[$counterh] . "</td>";
                                echo "<td>" . $loanTerm[$counterh] . "</td>";
                                $PreviousBalance = $loanAmount[$counterh] - ($loanAmount[$counterh] - $totalBalance[$counterh]) + $totalPaymentBLPT[$counterh];
                                $totalPreviousBalance = $totalPreviousBalance + $PreviousBalance;
                                echo "<td>" . number_format($PreviousBalance,'2','.',',') . "</td>";
                                $totalCollection[$counterh] = $totalPaymentBLIT[$counterh] + $totalPaymentBLPT[$counterh];
                                $totalCollectionLR =  $totalCollectionLR + $totalCollection[$counterh];
                                echo "<td>" . number_format($totalCollection[$counterh],'2','.',',') . "</td>";
                                $totalCollectionLRP = $totalCollectionLRP + $totalPaymentBLPT[$counterh];
                                echo "<td>" . number_format($totalPaymentBLPT[$counterh],'2','.',',') . "</td>";
                                $totalCollectionLRI = $totalCollectionLRI + $totalPaymentBLIT[$counterh];

                                echo "<td>" . $loanRelease[$counterh] . "</td>";
                                echo "<td>" . $loanReleaseP[$counterh] . "</td>";

                                echo "<td>" . number_format($totalPaymentBLIT[$counterh],'2','.',',') . "</td>";
                                $totalBalanceLR = $totalBalanceLR + $totalBalance[$counterh];
                                echo "<td>" . number_format($totalBalance[$counterh],'2','.',',') . "</td>";
                                echo "<td>" . $loanStatus[$counterh] . "</td>";
                            echo "</tr>";
                            

                            $counterh++;
                        }

                         echo "<tr>";
                            echo "<td>" . "Total" . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" ."" . "</td>";
                            echo "<td>" . number_format($totalPreviousBalance,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalCollectionLR,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalCollectionLRP,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalCollectionLRI,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalBalanceLR,'2','.',',') . "</td>";
                        echo "</tr>";
                    }else{
                        echo "<table>
                        <tr>
                            <th>LAN</th>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Previous C</th>
                            <th>Previous I</th>
                            <th>Total</th>
                            <th>Current C.</th>
                            <th>Current I</th>
                            <th>Total</th>
                            <th>Collection C. </th>
                            <th>Collection I. </th>
                            <th>Total</th>
                            <th>Balance C </th>
                            <th>Balance I. </th>
                            <th>Total</th>
                        </tr>";

                        $counterh = 0;
                        $counterMember = 1;

                        $totalPreviousBalance = 0;
                        $totalCurrentBalance = 0;
                        $totalCollection = 0;

                        //$total
                        $totalBalanceP = 0;
                        $totalBalanceI = 0;
                        $totalBalance = 0;

                        //array_multisort($lastName, $firstName, $middleName, $loanApplicationNumber, $idNumber, $monthDate, $loanTerm, $loanAmount, $totalPaymentBLIT, $totalPaymentBLPT, $totalBalance);
                        $totalPPrincipal = 0;
                        $totalPInterest = 0;

                        while($counterh < $numRow) {
                            echo "<tr>";
                                echo "<td>" . $counterMember . "</td>";
                                echo "<td>" . $idNumberRCL[$counterh] . "</td>";
                                echo "<td>" . $lastName[$counterh] . ", " . $firstName[$counterh] . " " . $middleName[$counterh] . "</td>";

                                //$totalPPrincipal = $rclPrevP[$counterh] + $rclPaymentPC[$counterh];
                                if($rclPrevP[$counterh] > 0){
                                    echo "<td>" . number_format($rclPrevP[$counterh],'2','.',',') . "</td>";
                                }else{
                                    echo "<td>" . "" . "</td>";
                                }

                                //$totalPInterest = $rclPrevI[$counterh] + $rclPaymentIC[$counterh];
                                if($rclPrevI[$counterh] > 0){
                                    echo "<td>" . number_format($rclPrevI[$counterh],'2','.',',') . "</td>";
                                }else{
                                    echo "<td>" . "" . "</td>";
                                }
                                $totalPreviousBalance = $rclPrevP[$counterh] + $rclPrevI[$counterh];
                                if($totalPreviousBalance > 0){
                                    echo "<td>" . number_format($totalPreviousBalance,'2','.',',') . "</td>";
                                }else{
                                    echo "<td>" . "" . "</td>";
                                }

                                if($rclCurP[$counterh] > 0){
                                    echo "<td>" . number_format($rclCurP[$counterh],'2','.',',') . "</td>";
                                }else{
                                    echo "<td>" . "" . "</td>";
                                }
                                if($rclCurI[$counterh] > 0){
                                    echo "<td>" . number_format($rclCurI[$counterh],'2','.',',') . "</td>";
                                }else{
                                    echo "<td>" . "" . "</td>";
                                }
                                
                                $totalCurrentBalance = $rclCurP[$counterh] + $rclCurI[$counterh];
                                if($totalCurrentBalance > 0){
                                    echo "<td>" . number_format($totalCurrentBalance,'2','.',',') . "</td>";
                                }else{
                                    echo "<td>" . "" . "</td>";
                                }

                                if($rclPaymentPC[$counterh] > 0){
                                    echo "<td>" . number_format($rclPaymentPC[$counterh],'2','.',',') . "</td>";
                                }else{
                                    echo "<td>" . "" . "</td>";
                                }
                                if($rclPaymentIC[$counterh] > 0){
                                    echo "<td>" . number_format($rclPaymentIC[$counterh],'2','.',',') . "</td>";
                                }else{
                                    echo "<td>" . "" . "</td>";
                                }
                                $totalCollection = $rclPaymentPC[$counterh] + $rclPaymentIC[$counterh];
                                if($totalCollection > 0){
                                    echo "<td>" . number_format($totalCollection,'2','.',',') . "</td>";
                                }else{
                                    echo "<td>" . "" . "</td>";
                                }

                                $totalBalanceP = $rclPrevP[$counterh] + $rclCurP[$counterh] - $rclPaymentPC[$counterh];
                                if($totalBalanceP > 0){
                                    echo "<td>" . number_format($totalBalanceP,'2','.',',') . "</td>";
                                }else{
                                    echo "<td>" . "" . "</td>";
                                }
                                $totalBalanceI = $rclPrevI[$counterh] + $rclCurI[$counterh] - $rclPaymentIC[$counterh];
                                if($totalBalanceI > 0){
                                    echo "<td>" . number_format($totalBalanceI,'2','.',',') . "</td>";
                                }else{
                                    echo "<td>" . "" . "</td>";
                                }
                                $totalBalance = $totalBalanceP + $totalBalanceI;
                                if($totalBalance > 0){
                                    echo "<td>" . number_format($totalBalance,'2','.',',') . "</td>";
                                }else{
                                    echo "<td>" . "" . "</td>";
                                }
                            echo "</tr>";

                            $counterMember++;
                            $counterh++;
                        }

                         echo "<tr>";
                            echo "<td>" . "Total" . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" . "" . "</td>";
                            echo "<td>" ."" . "</td>";
                            echo "<td>" . number_format($totalPreviousBalance,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalCollectionLR,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalCollectionLRP,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalCollectionLRI,'2','.',',') . "</td>";
                            echo "<td>" . number_format($totalBalanceLR,'2','.',',') . "</td>";
                        echo "</tr>";
                    }

                    ?>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
<?php include "css1.html" ?>
</html>