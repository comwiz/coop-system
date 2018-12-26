<?php

require_once 'session.php';
require('public/fpdf181/fpdf.php');

$idNumber[] = "";
$firstName  [] = "";
$middleName [] = "";
$lastName [] = "";

$idNumberA = "";
$accountNumberA  = "";
$firstNameA   = "";
$middleNameA  = "";
$lastNameA  = "";
$addressinfo = "";
$contactinfo = "";

$laSelection = "";

$loanApplicationNumberId = "";
$loanApplicationNumber[] = "";
$loanApplicationNumberList[] = "";
$loanServiceId[] = "";
$loanAmount[] = "";
$loanTerm[] = "";

$loanApplicationNumberA = "";
$loanServiceIdA = 0;
$loanAmountA = 0;
$loanInterestA = 0;
$loanTermA = 0;
$typeInterestA = 0;

$serviceFeeA = 0;
$fillingFeeA = 0;
$savingRetentionA = 0;
$cbuRetentionA = 0;
$insuranceFeeA = 0;
$notarialFeeA = 0;
$paymentTermA = 0;

$loanBalanceAN = "";
$loanBalance = 0;
$loanBalanceI = 0;
$orNumber = "";

$serviceFeeValue = 0;
$savingRetentionValue = 0;
$cbuRetentionValue = 0;
$insuranceFeeValue = 0;
$notarialFeeValue = 0;
$interestRevenueValue = 0;
$loanReleaseValue = 0;
$otherChargesValue = 0;
$monthDate = "";
$voucherNumber = "";
$checqueNumber = "";
$totalCharges = 0;
//$loanReleaseValue = "";

$monthlyAmortization = 0;
$principalPayment = 0;
$interestPayment = 0;
$OSBalance = 0;

$myButton = "";
$identifier = "";

$releaseLoanApplication = "";
$print = "";
$deniedApplication = "";
$displayProperty = "none";
$countErr = 0;
$numRow = 0;

$infomessage = "";
$monthDateR = date('Y-m-d');

$exitB = "";

//Reloan
$blLA = "Business Loan:";
$blPayment = 0;
$blPaymentI = 0;
$chklLA = "Check Loan:";
$chklPayment = 0;
$cllLA = "Calamity Loan:";
$cllPayment = 0;
$clLA = "Cash Loan:";
$clPayment = 0;
$cmlLA = "Chattel Loan:";
$cmlPayment = 0;
$cmlPaymentI = 0;
$edlLA = "Education Loan:";
$edlPayment = 0;
$edlPaymentI = 0;
$emlLA = "Emergency Loan:";
$emlPayment = 0;
$rlLA = "Regular Loan:";
$rlPayment = 0;
$rlPaymentI = 0;
$slLA = "Special Loan:";
$slPayment = 0;
$plLA = "Previous Loan";
$plPayment = 0;
$pliPayment = 0;
$rclLA = "Rice Loan (P)";

$typePayment = "";
$displayPropertyReloan = "none";
$totalChargesTemp = 0;

$otherReloan = "";
$plfPayment = 0;
$pnfPayment = 0;
$riceLoanPayment = 0;
$displayPropertyOthers = "none";
$displayPropertyLoan = "none";

$sqlbi = "SELECT * FROM  bl_loan_table WHERE loan_status = 'Approved' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);
$counter = 0;

$effectiveir = 0;
$loanInterestP = 0;
$paymentTermP = 0;
$totalInterest = 0;
$totalPrincipal = 0;

$loanOfficer = "JAYCEL RAMOS";
$bookKeeper = "AILEN AGAS";
$managerP = "EMERITA C. KIUNISALA";

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  ckl_loan_table WHERE loan_status = 'Approved' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  cml_loan_table WHERE loan_status = 'Approved' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  cl_loan_table WHERE loan_status = 'Approved' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  cll_loan_table WHERE loan_status = 'Approved' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  edl_loan_table WHERE loan_status = 'Approved' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  eml_loan_table WHERE loan_status = 'Approved' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  rl_loan_table WHERE loan_status = 'Approved' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  sl_loan_table WHERE loan_status = 'Approved' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  rice_loan_table WHERE loan_status = 'Approved' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Reloan

    if(!empty($_POST["typePayment"])) {
        $typePayment = test_input($_POST["typePayment"]);
    }

    if(!empty($_POST["loanBalanceAN"])) {

        $loanBalanceAN = test_input($_POST["loanBalanceAN"]);

        if(empty($_POST["loanBalance"]) && !is_numeric($_POST["loanBalance"])) {
            $countErr++;
        }else {
            $loanBalance = test_input($_POST["loanBalance"]);
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

        //INterest
        if (empty($_POST["pliPayment"]) && !is_numeric($_POST["pliPayment"])) {
            $countErr++;
        }else {
            $pliPayment = test_input($_POST["pliPayment"]);
        }

        if (empty($_POST["blPaymentI"]) && !is_numeric($_POST["blPaymentI"])) {
            $countErr++;
        }else {
            $blPaymentI = test_input($_POST["blPaymentI"]);
        }

        if (empty($_POST["cmlPaymentI"]) && !is_numeric($_POST["cmlPaymentI"])) {
            $countErr++;
        }else {
            $cmlPaymentI = test_input($_POST["cmlPaymentI"]);
        }

        if (empty($_POST["edlPaymentI"]) && !is_numeric($_POST["edlPaymentI"])) {
            $countErr++;
        }else {
            $edlPaymentI = test_input($_POST["edlPaymentI"]);
        }

        if (empty($_POST["rlPaymentI"]) && !is_numeric($_POST["rlPaymentI"])) {
            $countErr++;
        }else {
            $rlPaymentI = test_input($_POST["rlPaymentI"]);
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

        if (empty($_POST["riceLoanPayment"]) && !is_numeric($_POST["riceLoanPayment"])) {
            $countErr++;
        }else {
            $riceLoanPayment = test_input($_POST["riceLoanPayment"]);
        }
    }

    ////////////////////////////////////////

   if (!empty($_POST["myButton"])) {
        $loanApplicationNumberId = test_input($_POST["myButton"]);
        $displayProperty = "inline";
   }

   if (!empty($_POST["cancelB"])) {
        $loanApplicationNumberId = test_input($_POST["cancelB"]);

        if(substr($loanApplicationNumberId, 0,2) == "BL"){
            $sql = "UPDATE bl_loan_table SET
            loan_status = 'Void'
            WHERE loan_application_number =  '$loanApplicationNumberId' ";

            if ($conn->query($sql) === TRUE) {
               $infomessage = "Cancel Application";
               $loanApplicationNumberId = "";
            } 
            else { 
                  echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }elseif(substr($loanApplicationNumberId, 0,2) == "RL"){
            $sql = "UPDATE rl_loan_table SET
            loan_status = 'Void'
            WHERE loan_application_number =  '$loanApplicationNumberId' ";

            if ($conn->query($sql) === TRUE) {
               $infomessage = "Cancel Application";
               $loanApplicationNumberId = "";
            } 
            else { 
                  echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }elseif(substr($loanApplicationNumberId, 0,2) == "CL"){
            $sql = "UPDATE cl_loan_table SET
            loan_status = 'Void'
            WHERE loan_application_number =  '$loanApplicationNumberId' ";

            if ($conn->query($sql) === TRUE) {
               $infomessage = "Cancel Application";
               $loanApplicationNumberId = "";
            } 
            else { 
                  echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }elseif(substr($loanApplicationNumberId, 0,3) == "EDL"){
            $sql = "UPDATE edl_loan_table SET
            loan_status = 'Void'
            WHERE loan_application_number =  '$loanApplicationNumberId' ";

            if ($conn->query($sql) === TRUE) {
               $infomessage = "Cancel Application";
               $loanApplicationNumberId = "";
            } 
            else { 
                  echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }elseif(substr($loanApplicationNumberId, 0,3) == "EML"){
            $sql = "UPDATE eml_loan_table SET
            loan_status = 'Void'
            WHERE loan_application_number =  '$loanApplicationNumberId' ";

            if ($conn->query($sql) === TRUE) {
               $infomessage = "Cancel Application";
               $loanApplicationNumberId = "";
            } 
            else { 
                  echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }elseif(substr($loanApplicationNumberId, 0,2) == "SL"){
            $sql = "UPDATE sl_loan_table SET
            loan_status = 'Void'
            WHERE loan_application_number =  '$loanApplicationNumberId' ";

            if ($conn->query($sql) === TRUE) {
               $infomessage = "Cancel Application";
               $loanApplicationNumberId = "";
            } 
            else { 
                  echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }


        header("Location:http://system.local/listLoanRelease.php");
        //$displayProperty = "inline";
   }

   if (!empty($_POST["releaseLoanApplication"])) {
        $releaseLoanApplication = test_input($_POST["releaseLoanApplication"]);
        $displayProperty = "inline";
   }

   if (!empty($_POST["print"])) {
        $print = test_input($_POST["print"]);
        $displayProperty = "inline";
   }

   if (!empty($_POST["postPayment"])) {
        $postPayment = test_input($_POST["postPayment"]);
        $displayProperty = "inline";
   }

   if (!empty($_POST["exitB"])){
        $exitB = test_input($_POST["exitB"]);
   }

   if (empty($_POST["loanApplicationNumberA"])){
        $countErr++;
   }else {
        $loanApplicationNumberA = test_input($_POST["loanApplicationNumberA"]);
   }

   if (empty($_POST["idNumberA"])) {
        $countErr++;
   }else {
        $idNumberA = test_input($_POST["idNumberA"]);
   }

   if (empty($_POST["voucherNumber"])) {
        $countErr++;
   }else {
        $voucherNumber = test_input($_POST["voucherNumber"]);
   }

   if (empty($_POST["checqueNumber"])) {
        $countErr++;
   }else {
        $checqueNumber = test_input($_POST["checqueNumber"]);
   }

   if (empty($_POST["serviceFeeValue"]) && !is_numeric($_POST["serviceFeeValue"])) {
        $countErr++;
   }else {
        $serviceFeeValue = test_input($_POST["serviceFeeValue"]);
   }

   if (empty($_POST["fillingFeeA"]) && !is_numeric($_POST["fillingFeeA"])) {
        $countErr++;
   }else {
        $fillingFeeA = test_input($_POST["fillingFeeA"]);
   }

   if (empty($_POST["savingRetentionValue"]) && !is_numeric($_POST["savingRetentionValue"])) {
        $countErr++;
   }else {
        $savingRetentionValue = test_input($_POST["savingRetentionValue"]);
   }

   if (empty($_POST["cbuRetentionValue"]) && !is_numeric($_POST["cbuRetentionValue"])) {
        $countErr++;
   }else {
        $cbuRetentionValue = test_input($_POST["cbuRetentionValue"]);
   }

   if (empty($_POST["insuranceFeeValue"]) && !is_numeric($_POST["insuranceFeeValue"])) {
        $countErr++;
   }else {
        $insuranceFeeValue = test_input($_POST["insuranceFeeValue"]);
   }

   if (empty($_POST["notarialFeeValue"]) && !is_numeric($_POST["notarialFeeValue"])) {
        $countErr++;
   }else {
        $notarialFeeValue = test_input($_POST["notarialFeeValue"]);
   }

   if (empty($_POST["interestRevenueValue"]) && !is_numeric($_POST["interestRevenueValue"])) {
        $countErr++;
   }else {
        $interestRevenueValue = test_input($_POST["interestRevenueValue"]);
   }

   if (empty($_POST["totalChargesTemp"]) && !is_numeric($_POST["totalChargesTemp"])) {
        $countErr++;
   }else {
        $totalChargesTemp = test_input($_POST["totalChargesTemp"]);
   }

   if (empty($_POST["firstNameA"])) {
        $countErr++;
   }else {
        $firstNameA = test_input($_POST["firstNameA"]);
   }

   if (!empty($_POST["middleNameA"])) {
       $middleNameA = test_input($_POST["middleNameA"]);
   }

   if (empty($_POST["lastNameA"])) {
        $countErr++;
   }else {
        $lastNameA = test_input($_POST["lastNameA"]);
   }

   if (empty($_POST["accountNumberA"])) {
        $countErr++;
   }else {
        $accountNumberA = test_input($_POST["accountNumberA"]);
   }

   if (empty($_POST["addressinfo"])) {
        $countErr++;
   }else {
        $addressinfo = test_input($_POST["addressinfo"]);
   }

   if (empty($_POST["contactinfo"])) {
        $countErr++;
   }else {
        $contactinfo = test_input($_POST["contactinfo"]);
   }


   //if (empty($_POST["loanBalanceI"]) && !is_numeric($_POST["loanBalanceI"])) {
        //$countErr++;
   //}else {
        //$loanBalanceI = test_input($_POST["loanBalanceI"]);
        //if($loanBalanceI > 0){
            //if (empty($_POST["loanBalanceAN"])) {
                //$countErr++;
            //}else {
                //$loanBalanceAN = test_input($_POST["loanBalanceAN"]);
            //}
        //}
   //}

   /*if (!empty($_POST["orNumber"]) && !is_numeric($_POST["orNumber"])) {
        $countErr++;
   }*/

   if(empty($_POST["monthDateR"])) {
        $countErr++;
   }else {
        $monthDateR = test_input($_POST["monthDateR"]);
   }

   if (empty($_POST["loanReleaseValue"]) && !is_numeric($_POST["loanBalanceI"])) {
        $countErr++;
   }else {
        $loanReleaseValue = test_input($_POST["loanReleaseValue"]);
   }

   if (!empty($_POST["loanAmountA"])) {
        $loanAmountA = test_input($_POST["loanAmountA"]);
   }

   if (!empty($_POST["paymentTermA"])) {
        $paymentTermA = test_input($_POST["paymentTermA"]);
   }

   if (!empty($_POST["loanTermA"])) {
        $loanTermA = test_input($_POST["loanTermA"]);
   }

   if (empty($_POST["effectiveir"])) {
        $countErr++;
   }else {
        $effectiveir = test_input($_POST["effectiveir"]);
   }

   if (empty($_POST["loanInterestA"]) && !is_numeric($_POST["loanInterestA"])) {
        $countErr++;
   }else {
        $loanInterestA = test_input($_POST["loanInterestA"]);
   }

   if (empty($_POST["loanTermA"]) && !is_numeric($_POST["loanTermA"])) {
        $countErr++;
   }else {
        $loanTermA = test_input($_POST["loanTermA"]);
   }

   if (empty($_POST["typeInterestA"]) && !is_numeric($_POST["typeInterestA"])) {
        $countErr++;
   }else {
        $typeInterestA = test_input($_POST["typeInterestA"]);
   }

   if (empty($_POST["loanOfficer"]) && !is_numeric($_POST["loanOfficer"])) {
        $countErr++;
   }else {
        $loanOfficer = test_input($_POST["loanOfficer"]);
   }

   if (empty($_POST["bookKeeper"]) && !is_numeric($_POST["bookKeeper"])) {
        $countErr++;
   }else {
        $bookKeeper = test_input($_POST["bookKeeper"]);
   }

   if (empty($_POST["managerP"]) && !is_numeric($_POST["managerP"])) {
        $countErr++;
   }else {
        $managerP = test_input($_POST["managerP"]);
   }

   if($exitB == "exitB"){
        session_destroy();
        header("Location: http://localhost/projectkikz/samplemwmmpc/application/views/home/login.php");
   }


   if(!empty($loanApplicationNumberId)){
        if(substr("$loanApplicationNumberId",0,2) == "BL"){
            $sqlA = "SELECT * FROM  bl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Approved'";
        }elseif(substr("$loanApplicationNumberId",0,3) == "CKL"){
            $sqlA = "SELECT * FROM  ckl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Approved'";
        }elseif(substr("$loanApplicationNumberId",0,3) == "CLL"){
            $sqlA = "SELECT * FROM  cll_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Approved'";
        }elseif(substr("$loanApplicationNumberId",0,2) == "CL"){
            $sqlA = "SELECT * FROM  cl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Approved'";
        }elseif(substr("$loanApplicationNumberId",0,3) == "CML"){
            $sqlA = "SELECT * FROM  cml_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Approved'";
        }elseif(substr("$loanApplicationNumberId",0,3) == "EDL"){
            $sqlA = "SELECT * FROM  edl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Approved'";
        }elseif(substr("$loanApplicationNumberId",0,3) == "EML"){
            $sqlA = "SELECT * FROM  eml_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Approved'";
        }elseif(substr("$loanApplicationNumberId",0,2) == "RL"){
            $sqlA = "SELECT * FROM  rl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Approved'";
        }elseif(substr("$loanApplicationNumberId",0,3) == "RCL"){
            $sqlA = "SELECT * FROM  rice_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Approved'";
        }elseif(substr("$loanApplicationNumberId",0,2) == "SL"){
            $sqlA = "SELECT * FROM  sl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Approved'";
        }

        $resultA = $conn->query($sqlA);

        if($resultA->num_rows > 0){
            while ($row = mysqli_fetch_array($resultA)) {
                # code...
                $idNumberA = $row['id_number'];
                $loanApplicationNumberA = $row['loan_application_number'];
                $loanServiceIdA = $row['loan_service_id'];
                $loanAmountA = $row['loan_amount'];
                $loanTermA= $row['loan_term'];
                $loanInterestA = $row['loan_interest'];
                $paymentTermA = $row['payment_term'];

                $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdA' ";
                $resultLS = $conn->query($sqlLS);
                //$numRow = mysqli_num_rows($resultName);

                if($resultLS->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLS)) {
                        # code...
                        $typeInterestA = $row['type_interest'];
                        $serviceFeeA = $row['service_fee'];
                        $fillingFeeA = $row['filing_fee'];
                        $cbuRetentionA = $row['cbu_loan_retention'];
                        $savingRetentionA = $row['savings_loan_retention'];
                        $notarialFeeA = $row['notarial_fee'];
                        $insuranceFeeA = $row['insurance_fee'];

                    }
                }

                $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumberA' ";
                $resultLS = $conn->query($sqlLS);
                //$numRow = mysqli_num_rows($resultName);

                if($resultLS->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLS)) {
                        # code...
                        $accountNumberA = $row['account_number'];
                        $firstNameA = $row['first_name'];
                        $middleNameA = $row['middle_name'];
                        $lastNameA = $row['last_name'];
                    }
                }

                $sqlLS = "SELECT * FROM  address_table WHERE id_number = '$idNumberA' ";
                $resultLS = $conn->query($sqlLS);

                if($resultLS->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLS)) {
                        $addressinfo = $row['present_address'];
                    }
                }

                $sqlLS = "SELECT * FROM  contact_table WHERE id_number = '$idNumberA' ";
                $resultLS = $conn->query($sqlLS);

                if($resultLS->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLS)) {
                        $contactinfo = $row['mobile_number'];
                    }
                }

                $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumberA' ";
                $resultLD = $conn->query($sqlLD);

                if($resultLD->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLD)) {
                        # code...
                        $monthDateR = $row['date_application'];
                        $monthDate = new DateTime($monthDateR);
                    }
                }
 
                //Insurance
                if(substr("$loanApplicationNumberId",0,3) != "RCL"){
                  $totalSC = 0;
                  $sqlSC = "SELECT amount FROM share_capital_table WHERE id_number = '$idNumberA' ";
                  $resultSC = $conn->query($sqlSC);
                  
                   if($resultSC->num_rows > 0){
                      while ($row = mysqli_fetch_array($resultSC)) {
                          $totalSC = $totalSC + $row['amount'];
                      }
                   }else{
                          $totalSC = 0;
                   }


                  $serviceFeeA = $serviceFeeA/100;
                  $cbuRetentionA = $cbuRetentionA/100;
                  $savingRetentionA = $savingRetentionA/100;
                  $notarialFeeA = $notarialFeeA/100;

                  //Compute Insurance
                  if($loanAmountA > $totalSC){
                      $insuranceFeeValue = (($loanAmountA - $totalSC) * $loanTermA)/1000;
                  }

                  if(substr("$loanApplicationNumberA",0,3) == "CKL") {
                    $serviceFeeValue =  ($serviceFeeA * 100) ;
                  }else{
                    $serviceFeeValue =  number_format($loanAmountA * $serviceFeeA, 2, '.', '');
                  }


                  $cbuRetentionValue =  number_format($loanAmountA * $cbuRetentionA, 2, '.', '');
                  $savingRetentionValue = number_format($loanAmountA * $savingRetentionA, 2, '.', '');
                  $notarialFeeValue = number_format($loanAmountA * $notarialFeeA, 2, '.', '');

                  if($typeInterestA == 'Flat'){
                    //$displayProperty = "none";
                      $interestRevenueValue = number_format((($loanAmountA*($loanInterestA/100))*$loanTermA), 2, '.', '');
                      //echo "$interestRevenueValue";
                      $totalCharges = $serviceFeeValue + $savingRetentionValue + $cbuRetentionValue + $insuranceFeeValue + $notarialFeeValue + $fillingFeeA;
                      $loanReleaseValue = $loanAmountA - ($totalCharges + $interestRevenueValue);
                      $totalChargesTemp = ($totalCharges + $interestRevenueValue);
                  }else{
                      $interestRevenueValue = number_format(0, 2,'.' , '');
                      $totalCharges = $serviceFeeValue + $fillingFeeA +  $cbuRetentionValue + $savingRetentionValue + $notarialFeeValue + $interestRevenueValue + $insuranceFeeValue;
                      $loanReleaseValue = $loanAmountA - $totalCharges;
                      $totalChargesTemp = $totalCharges;
                  }
                }

                $sqlbi = "SELECT * FROM  bl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
                $resultbi = $conn->query($sqlbi);
                $numRowList = mysqli_num_rows($resultbi);
                $counterList = 0;

                if($resultbi->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultbi)) {
                        # code...
                        $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                        $counterList++;
                    }
                }

                $sqlbi = "SELECT * FROM  cml_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
                $resultbi = $conn->query($sqlbi);
                $numRowList = $numRowList + mysqli_num_rows($resultbi);

                if($resultbi->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultbi)) {
                        # code...
                        $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                        $counterList++;
                    }
                }

                $sqlbi = "SELECT * FROM  cll_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
                $resultbi = $conn->query($sqlbi);
                $numRowList = $numRowList + mysqli_num_rows($resultbi);

                if($resultbi->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultbi)) {
                        # code...
                        $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                        $counterList++;
                    }
                }

                $sqlbi = "SELECT * FROM  edl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
                $resultbi = $conn->query($sqlbi);
                $numRowList = $numRowList + mysqli_num_rows($resultbi);

                if($resultbi->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultbi)) {
                        # code...
                        $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                        $counterList++;
                    }
                }

                $sqlbi = "SELECT * FROM  rl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
                $resultbi = $conn->query($sqlbi);
                $numRowList = $numRowList + mysqli_num_rows($resultbi);

                if($resultbi->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultbi)) {
                        # code...
                        $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                        $counterList++;
                    }
                }

                $sqlbi = "SELECT * FROM  pl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
                $resultbi = $conn->query($sqlbi);
                $numRowList = $numRowList + mysqli_num_rows($resultbi);

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
                        $loanApplicationNumberList[$counterList] = $row['loan_application_number'] . " " . "(" . $loanServiceTag . ")";
                        $counterList++;
                    }

                    $loanServiceTag = "";
                }

                $sqlbi = "SELECT * FROM  ckl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
                $resultbi = $conn->query($sqlbi);
                $numRowList = $numRowList + mysqli_num_rows($resultbi);

                if($resultbi->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultbi)) {
                        # code...
                        $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                        $counterList++;
                    }
                }

                $sqlbi = "SELECT * FROM  cl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
                $resultbi = $conn->query($sqlbi);
                $numRowList = $numRowList + mysqli_num_rows($resultbi);

                if($resultbi->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultbi)) {
                        # code...
                        $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                        $counterList++;
                    }
                }

                $sqlbi = "SELECT * FROM  eml_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
                $resultbi = $conn->query($sqlbi);
                $numRowList = $numRowList + mysqli_num_rows($resultbi);

                if($resultbi->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultbi)) {
                        # code...
                        $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                        $counterList++;
                    }
                }

                $sqlbi = "SELECT * FROM  sl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
                $resultbi = $conn->query($sqlbi);
                $numRowList = $numRowList + mysqli_num_rows($resultbi);

                if($resultbi->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultbi)) {
                        # code...
                        $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                        $counterList++;
                    }
                }
            }
        }
   }

   /*if($postPayment == "postPayment"){
        $loanReleaseValue = $loanReleaseValue - $loanBalance - $riceLoanPayment - $loanpena
   }*/

   if($typePayment != ""){
        $displayPropertyReloan = "inline";
        $displayPropertyLoan = "inline";

        if($typePayment == "plti" or $typePayment == "pnti" or $typePayment == "rcrl"){
            $displayPropertyOthers = "inline";
        }

        $loanBalance = $blPayment + $cmlPayment +$cllPayment + $edlPayment + $rlPayment + $plPayment + $pliPayment + $chklPayment + $clPayment + $emlPayment + $slPayment + $blPaymentI + $edlPaymentI + $rlPaymentI + $cmlPaymentI ;

        $loanReleaseValue = $loanAmountA - $totalChargesTemp - $loanBalance -$pnfPayment - $plfPayment  -$riceLoanPayment;

        $sqlbi = "SELECT * FROM  bl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRowList = mysqli_num_rows($resultbi);
        $counterList = 0;

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                $counterList++;
            }
        }

        $sqlbi = "SELECT * FROM  cml_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRowList = $numRowList + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                $counterList++;
            }
        }

        $sqlbi = "SELECT * FROM  cll_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRowList = $numRowList + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                $counterList++;
            }
        }

        $sqlbi = "SELECT * FROM  edl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRowList = $numRowList + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                $counterList++;
            }
        }

        $sqlbi = "SELECT * FROM  rl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRowList = $numRowList + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                $counterList++;
            }
        }

        $sqlbi = "SELECT * FROM  pl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRowList = $numRowList + mysqli_num_rows($resultbi);

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
                $loanApplicationNumberList[$counterList] = $row['loan_application_number'] . " " . "(" . $loanServiceTag . ")";
                $counterList++;
            }

            $loanServiceTag = "";
        }

        $sqlbi = "SELECT * FROM  ckl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRowList = $numRowList + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                $counterList++;
            }
        }

        $sqlbi = "SELECT * FROM  cl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRowList = $numRowList + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                $counterList++;
            }
        }

        $sqlbi = "SELECT * FROM  eml_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRowList = $numRowList + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                $counterList++;
            }
        }

        $sqlbi = "SELECT * FROM  sl_loan_table WHERE id_number = '$idNumberA' and loan_status = 'Released' and loan_status != 'Paid' ";
        $resultbi = $conn->query($sqlbi);
        $numRowList = $numRowList + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $loanApplicationNumberList[$counterList] = $row['loan_application_number'];
                $counterList++;
            }
        }
   }

   if($releaseLoanApplication == "releaseLoanApplication") {
       # code...
        if($countErr <= 0){
            $loanBalanStatus = 0;
            //$loanReleaseValue = $loanAmountA - ($fillingFeeA + $serviceFeeValue + $notarialFeeValue + $insuranceFeeValue + $interestRevenueValue +$cbuRetentionValue + $savingRetentionValue + $loanBalance + $loanBalanceI);
            $lb = 0;
            if($loanBalance > 0 and $loanBalanceAN == "Reloan/Restructure"){
                $lb = 1;
                //Reloan
                $loanBalanStatus = 1;
                if(substr("$blLA",0,2) == "BL" and $blPayment != 0){
                    $sqlUP = "UPDATE bl_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$monthDateR',
                    date_paid = '$monthDateR' WHERE loan_application_number = '$blLA'";

                    $sqlDP = "UPDATE loan_date_table SET
                    date_paid = '$monthDateR'
                    WHERE loan_application_number =  '$loanApplicationNumberA' ";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlDP) === TRUE) {
                       $infomessage = "Loan Paid";
                    } 
                    else { 
                      echo "Error: " . $sqlUP . "<br>" . $conn->error;
                      echo "Error: " . $sqlDP . "<br>" . $conn->error;
                    }


                    $sql = "INSERT INTO bl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumberA','$loanApplicationNumberA','$blLA','$blPayment','$monthDateR', '$encodedBy')";

                    $sql1 = "INSERT INTO bl_credit_revenue_table(id_number,loan_application_number, voucher_number, checque_number, reference_number,interest_revenue, date_transaction,encoded_by, voucher_i, loanb_i, loanb_v) 
                        VALUES ('$idNumberA','$blLA', '$voucherNumber' , '$checqueNumber' , '$loanApplicationNumberA','$blPaymentI','$monthDateR', '$encodedBy', '0' , '$loanBalanStatus' , $blPayment)";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                        $informessage = "New record created successfully";
                        $blPayment = 0;
                        $blPaymentI= 0;
                        $blLA = "Business Loan:";

                        $currentPrincipal = 0;
                        $currentInterest = 0;
                    }else{
                        echo "Error: " . $sqlUP . "<br>" . $conn->error;
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }
                }

                if(substr("$cllLA",0,3) == "CLL" and $cllPayment != 0){
                    $sqlUP = "UPDATE cll_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$monthDateR',
                    date_paid = '$monthDateR' WHERE loan_application_number = '$cllLA'";

                    $sqlDP = "UPDATE loan_date_table SET
                    date_paid = '$monthDateR'
                    WHERE loan_application_number =  '$loanApplicationNumberA' ";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlDP) === TRUE) {
                       $infomessage = "Loan Paid";
                    } 
                    else { 
                      echo "Error: " . $sqlUP . "<br>" . $conn->error;
                      echo "Error: " . $sqlDP . "<br>" . $conn->error;
                    }


                    $sql = "INSERT INTO cll_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumberA','$loanApplicationNumberA','$cllLA','$currentPrincipal','$monthDateR', '$encodedBy')";

                    $sql1 = "INSERT INTO cll_credit_revenue_table(id_number,loan_application_number, voucher_number, checque_number, reference_number,interest_revenue, date_transaction,encoded_by, voucher_i, loanb_i, loanb_v) 
                        VALUES ('$idNumberA','$cllLA', '$voucherNumber' , '$checqueNumber' , '$loanApplicationNumberA','$currentInterest','$monthDateR', '$encodedBy', '0' , '$loanBalanStatus' , $currentPrincipal)";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                        $informessage = "New record created successfully";
                        $cllPayment = 0;
                        $cllLA = "Calamity Loan:";

                        $currentPrincipal = 0;
                        $currentInterest = 0;
                    }else{
                        echo "Error: " . $sqlUP . "<br>" . $conn->error;
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }
                }

                if(substr("$cmlLA",0,3) == "CML" and $emlPayment != 0){
                    $sqlUP = "UPDATE cml_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$monthDateR',
                    date_paid = '$monthDateR' WHERE loan_application_number = '$cmlLA'";

                    $sqlDP = "UPDATE loan_date_table SET
                    date_paid = '$monthDateR'
                    WHERE loan_application_number =  '$loanApplicationNumberA' ";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlDP) === TRUE) {
                       $infomessage = "Loan Paid";
                    } 
                    else { 
                      echo "Error: " . $sqlUP . "<br>" . $conn->error;
                      echo "Error: " . $sqlDP . "<br>" . $conn->error;
                    }


                    $sql = "INSERT INTO cml_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumberA','$loanApplicationNumberA','$cmlLA','$cmlPayment','$monthDateR', '$encodedBy')";

                    $sql1 = "INSERT INTO cml_credit_revenue_table(id_number,loan_application_number, voucher_number, checque_number, reference_number,interest_revenue, date_transaction,encoded_by, voucher_i, loanb_i, loanb_v) 
                        VALUES ('$idNumberA','$cmlLA', '$voucherNumber' , '$checqueNumber' , '$loanApplicationNumberA','$cmlPaymentI','$monthDateR', '$encodedBy', '0' , '$loanBalanStatus' , $cmlPayment)";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                        $informessage = "New record created successfully";
                        $cmlPayment = 0;
                        $cmlPaymentI = 0;
                        $cmlLA = "Chattel Loan:";

                        $currentPrincipal = 0;
                        $currentInterest = 0;
                    }else{
                        echo "Error: " . $sqlUP . "<br>" . $conn->error;
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }
                }

                if(substr("$edlLA",0,3) == "EDL" and $edlPayment != 0){
                    $sqlUP = "UPDATE edl_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$monthDateR',
                    date_paid = '$monthDateR' WHERE loan_application_number = '$edlLA'";

                    $sqlDP = "UPDATE loan_date_table SET
                    date_paid = '$monthDateR'
                    WHERE loan_application_number =  '$loanApplicationNumberA' ";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlDP) === TRUE) {
                       $infomessage = "Loan Paid";
                    } 
                    else { 
                      echo "Error: " . $sqlUP . "<br>" . $conn->error;
                      echo "Error: " . $sqlDP . "<br>" . $conn->error;
                    }

                    $sql = "INSERT INTO edl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumberA','$loanApplicationNumberA','$edlLA','$edlPayment','$monthDateR', '$encodedBy')";

                    $sql1 = "INSERT INTO edl_credit_revenue_table(id_number,loan_application_number, voucher_number, checque_number, reference_number,interest_revenue, date_transaction,encoded_by, voucher_i, loanb_i, loanb_v) 
                        VALUES ('$idNumberA','$edlLA', '$voucherNumber' , '$checqueNumber' , '$loanApplicationNumberA','$edlPaymentI','$monthDateR', '$encodedBy', '0' , '$loanBalanStatus' , $edlPayment)";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                        $informessage = "New record created successfully";
                        $edlPayment = 0;
                        $edlPaymentI = 0;
                        $edlLA = "Education Loan:";

                        $currentPrincipal = 0;
                        $currentInterest = 0;
                    }else{
                        echo "Error: " . $sqlUP . "<br>" . $conn->error;
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }
                }

                if(substr("$rlLA",0,2) == "RL" and $rlPayment != 0){
                    $sqlUP = "UPDATE rl_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$monthDateR',
                    date_paid = '$monthDateR' WHERE loan_application_number = '$rlLA'";

                    $sqlDP = "UPDATE loan_date_table SET
                    date_paid = '$monthDateR'
                    WHERE loan_application_number =  '$loanApplicationNumberA' ";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlDP) === TRUE) {
                       $infomessage = "Loan Paid";
                    } 
                    else { 
                      echo "Error: " . $sqlUP . "<br>" . $conn->error;
                      echo "Error: " . $sqlDP . "<br>" . $conn->error;
                    }

                    $sql = "INSERT INTO rl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumberA','$loanApplicationNumberA','$rlLA','$rlPayment','$monthDateR', '$encodedBy')";

                    $sql1 = "INSERT INTO rl_credit_revenue_table(id_number,loan_application_number, voucher_number, checque_number, reference_number,interest_revenue, date_transaction,encoded_by, voucher_i, loanb_i, loanb_v) 
                        VALUES ('$idNumberA','$rlLA', '$voucherNumber' , '$checqueNumber' , '$loanApplicationNumberA','$rlPaymentI','$monthDateR', '$encodedBy', '0' , '$loanBalanStatus' , $rlPayment)";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                        $informessage = "New record created successfully";
                        $rlPayment = 0;
                        $rlPaymentI = 0;
                        $rlLA = "Regular Loan:";

                        $currentPrincipal = 0;
                        $currentInterest = 0;
                    }else{
                        echo "Error: " . $sqlUP . "<br>" . $conn->error;
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }
                }

                if(substr("$plLA",0,2) == "PL" and $plPayment != 0){
                    $sqlUP = "UPDATE pl_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$monthDateR',
                    date_paid = '$monthDateR' WHERE loan_application_number = '$plLA'";

                    $sqlDP = "UPDATE loan_date_table SET
                    date_paid = '$monthDateR'
                    WHERE loan_application_number =  '$loanApplicationNumberA' ";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlDP) === TRUE) {
                       $infomessage = "Loan Paid";
                    } 
                    else { 
                      echo "Error: " . $sqlUP . "<br>" . $conn->error;
                      echo "Error: " . $sqlDP . "<br>" . $conn->error;
                    }

                    $sql = "INSERT INTO pl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumberA','$loanApplicationNumberA','$plLA','$plPayment','$monthDateR', '$encodedBy')";

                    $sql1 = "INSERT INTO pl_credit_revenue_table(id_number,loan_application_number, voucher_number, checque_number, reference_number,interest_revenue, date_transaction,encoded_by, voucher_i, loanb_i, loanb_v) 
                        VALUES ('$idNumberA','$plLA', '$voucherNumber' , '$checqueNumber' , '$loanApplicationNumberA','$pliPayment','$monthDateR', '$encodedBy', '0' , '$loanBalanStatus' , $rlPayment)";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                        $informessage = "New record created successfully";
                        $plPayment = 0;
                        $pliPayment = 0;
                        $plLA = "Previous Loan:";

                        $currentPrincipal = 0;
                        $currentInterest = 0;
                    }else{
                        echo "Error: " . $sqlUP . "<br>" . $conn->error;
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }
                }

                if(substr("$chklLA",0,3) == "CKL" and $chklPayment != 0){
                    $sqlUP = "UPDATE ckl_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$monthDateR',
                    date_paid = '$monthDateR' WHERE loan_application_number = '$chklLA'";

                    $sqlDP = "UPDATE loan_date_table SET
                    date_paid = '$monthDateR'
                    WHERE loan_application_number =  '$loanApplicationNumberA' ";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlDP) === TRUE) {
                       $infomessage = "Loan Paid";
                    } 
                    else { 
                      echo "Error: " . $sqlUP . "<br>" . $conn->error;
                      echo "Error: " . $sqlDP . "<br>" . $conn->error;
                    }

                    $sqlPLP = "INSERT INTO ckl_loan_payment_table(id_number, reference_number,loan_application_number, amount, date_payment, encoded_by) VALUES ('$idNumberA','$loanApplicationNumberA','$chklLA','$chklPayment','$monthDateR', '$encodedBy')";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlPLP) === TRUE){
                        $informessage = "New record created successfully";
                        $chklPayment = 0;
                        $chklLA = "Checque Loan:";

                        $currentPrincipal = 0;
                        $currentInterest = 0;
                    }else{
                        echo "Error: " . $sqlUP . "<br>" . $conn->error;
                        echo "Error: " . $sqlPLP . "<br>" . $conn->error;
                    }
                }

                if(substr("$clLA",0,2) == "CL" and $clPayment != 0){
                    $sqlUP = "UPDATE cl_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$monthDateR', date_paid = '$monthDateR' 
                    WHERE loan_application_number = '$clLA'";

                    $sqlDP = "UPDATE loan_date_table SET
                    date_paid = '$monthDateR'
                    WHERE loan_application_number =  '$loanApplicationNumberA' ";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlDP) === TRUE) {
                       $infomessage = "Loan Paid";
                    } 
                    else { 
                      echo "Error: " . $sqlUP . "<br>" . $conn->error;
                      echo "Error: " . $sqlDP . "<br>" . $conn->error;
                    }

                    $sqlPLP = "INSERT INTO cl_loan_payment_table(id_number, reference_number,loan_application_number, amount, date_payment, encoded_by, voucher_number, voucher_i, loanb_i) VALUES ('$idNumberA','$loanApplicationNumberA','$clLA','$clPayment','$monthDateR', '$encodedBy', $voucherNumber, '0' , '$loanBalanStatus')";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlPLP) === TRUE){
                        $informessage = "New record created successfully";
                        $clPayment = 0;
                        $clLA = "Cash Loan:";

                        $currentPrincipal = 0;
                        $currentInterest = 0;
                    }else{
                        echo "Error: " . $sqlUP . "<br>" . $conn->error;
                        echo "Error: " . $sqlPLP . "<br>" . $conn->error;
                    }
                }

                if(substr("$emlLA",0,3) == "EML" and $emlPayment != 0){
                    $sqlUP = "UPDATE eml_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$monthDateR',
                    date_paid = '$monthDateR' WHERE loan_application_number = '$emlLA'";

                    $sqlDP = "UPDATE loan_date_table SET
                    date_paid = '$monthDateR';
                    WHERE id_number = '$idNumberA' and loan_application_number =  '$loanApplicationNumberA' ";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlDP) === TRUE) {
                       $infomessage = "Loan Paid";
                    } 
                    else { 
                      echo "Error: " . $sqlUP . "<br>" . $conn->error;
                      echo "Error: " . $sqlDP . "<br>" . $conn->error;
                    }

                    $sqlPLP = "INSERT INTO eml_loan_payment_table(id_number, reference_number,loan_application_number, amount, date_payment, encoded_by, voucher_number, voucher_i, loanb_i) VALUES ('$idNumberA','$loanApplicationNumberA','$emlLA','$emlPayment','$monthDateR', '$encodedBy', $voucherNumber, '0' , '$loanBalanStatus')";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlPLP) === TRUE){
                        $informessage = "New record created successfully";
                        $emlPayment = 0;
                        $emlLA = "Cash Loan:";

                        $currentPrincipal = 0;
                        $currentInterest = 0;
                    }else{
                        echo "Error: " . $sqlUP . "<br>" . $conn->error;
                        echo "Error: " . $sqlPLP . "<br>" . $conn->error;
                    }
                }

                if(substr("$slLA",0,2) == "SL" and $slPayment != 0){
                    $sqlUP = "UPDATE sl_loan_table SET
                    loan_status = 'Paid',
                    last_payment = '$monthDateR',
                    date_paid = '$monthDateR' WHERE loan_application_number = '$slLA'";

                    $sqlDP = "UPDATE loan_date_table SET
                    date_paid = '$monthDateR';
                    WHERE id_number = '$idNumberA' and loan_application_number =  '$loanApplicationNumberA' ";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlDP) === TRUE) {
                       $infomessage = "Loan Paid";
                    } 
                    else { 
                      echo "Error: " . $sqlUP . "<br>" . $conn->error;
                      echo "Error: " . $sqlDP . "<br>" . $conn->error;
                    }

                    $sqlPLP = "INSERT INTO sl_loan_payment_table(id_number, reference_number,loan_application_number, amount, date_payment, encoded_by, voucher_number, voucher_i, loanb_i) VALUES ('$idNumberA','$loanApplicationNumberA','$slLA','$slPayment','$monthDateR', '$encodedBy', $voucherNumber, '0' , '$loanBalanStatus')";

                    if ($conn->query($sqlUP) === TRUE and $conn->query($sqlPLP) === TRUE){
                        $informessage = "New record created successfully";
                        $slPayment = 0;
                        $slLA = "Special Loan:";

                        $currentPrincipal = 0;
                        $currentInterest = 0;
                    }else{
                        echo "Error: " . $sqlUP . "<br>" . $conn->error;
                        echo "Error: " . $sqlPLP . "<br>" . $conn->error;
                    }
                }
            }

            if(substr("$loanApplicationNumberA",0,2) == "BL"){
                $sql = "UPDATE bl_loan_table SET
                loan_status = 'Released',
                date_released = '$monthDateR',
                last_payment = '$monthDateR'
                WHERE loan_application_number = '$loanApplicationNumberA'";

                $sql3 = "INSERT INTO bl_credit_revenue_table(id_number, loan_application_number,voucher_number, checque_number, amount_release, service_fee, filling_fee, notarial_fee,insurance_fee,interest_revenue, date_transaction, encoded_by,voucher_i, loanb_i, loanb_v) 
                    VALUES ('$idNumberA','$loanApplicationNumberA','$voucherNumber','$checqueNumber' , '$loanReleaseValue' ,'$serviceFeeValue','$fillingFeeA','$notarialFeeValue','$insuranceFeeValue','$interestRevenueValue','$monthDateR','$encodedBy','1', '$loanBalanStatus', $loanBalance)";
            }elseif(substr("$loanApplicationNumberA",0,3) == "CKL"){
                $sql = "UPDATE ckl_loan_table SET
                loan_status = 'Released',
                date_released = '$monthDateR',
                last_payment = '$monthDateR'
                WHERE loan_application_number = '$loanApplicationNumberA'";

                $sql3 = "INSERT INTO ckl_credit_revenue_table(id_number, loan_application_number,voucher_number, checque_number, amount_release ,service_fee, filling_fee, notarial_fee,insurance_fee,interest_revenue, date_transaction, encoded_by,voucher_i, loanb_i, loanb_v) 
                    VALUES ('$idNumberA','$loanApplicationNumberA','$voucherNumber','$checqueNumber', '$loanReleaseValue' ,'$serviceFeeValue','$fillingFeeA','$notarialFeeValue','$insuranceFeeValue','$interestRevenueValue','$monthDateR','$encodedBy','1', '$loanBalanStatus', '$loanBalance')";
            }elseif(substr("$loanApplicationNumberA",0,3) == "CLL"){
                $sql = "UPDATE cll_loan_table SET
                loan_status = 'Released',
                date_released = '$monthDateR',
                last_payment = '$monthDateR'
                WHERE loan_application_number = '$loanApplicationNumberA'";

                $sql3 = "INSERT INTO cll_credit_revenue_table(id_number, loan_application_number,voucher_number, checque_number, amount_release ,service_fee, filling_fee, notarial_fee,insurance_fee,interest_revenue, date_transaction, encoded_by,voucher_i, loanb_i, loanb_v) 
                    VALUES ('$idNumberA','$loanApplicationNumberA','$voucherNumber','$checqueNumber',  '$loanReleaseValue' ,'$serviceFeeValue','$fillingFeeA','$notarialFeeValue','$insuranceFeeValue','$interestRevenueValue','$monthDateR','$encodedBy','1', '$loanBalanStatus', '$loanBalance')";
            }elseif(substr("$loanApplicationNumberA",0,2) == "CL"){
                $sql = "UPDATE cl_loan_table SET
                loan_status = 'Released',
                date_released = '$monthDateR',
                last_payment = '$monthDateR'
                WHERE loan_application_number = '$loanApplicationNumberA'";

                $sql3 = "INSERT INTO cl_credit_revenue_table(id_number, loan_application_number,voucher_number, checque_number, amount_release ,service_fee, filling_fee, notarial_fee,insurance_fee,interest_revenue, date_transaction, encoded_by,voucher_i, loanb_i, loanb_v) 
                    VALUES ('$idNumberA','$loanApplicationNumberA','$voucherNumber','$checqueNumber', '$loanReleaseValue','$serviceFeeValue','$fillingFeeA','$notarialFeeValue','$insuranceFeeValue','$interestRevenueValue','$monthDateR','$encodedBy','1', '$loanBalanStatus', '$loanBalance')";
            }elseif(substr("$loanApplicationNumberA",0,3) == "CML"){
                $sql = "UPDATE cml_loan_table SET
                loan_status = 'Released',
                date_released = '$monthDateR',
                last_payment = '$monthDateR'
                WHERE loan_application_number = '$loanApplicationNumberA'";

                $sql3 = "INSERT INTO cml_credit_revenue_table(id_number, loan_application_number,voucher_number, checque_number, amount_release,service_fee, filling_fee, notarial_fee,insurance_fee,interest_revenue, date_transaction, encoded_by,voucher_i, loanb_i, loanb_v) 
                    VALUES ('$idNumberA','$loanApplicationNumberA','$voucherNumber','$checqueNumber','$loanReleaseValue','$serviceFeeValue','$fillingFeeA','$notarialFeeValue','$insuranceFeeValue','$interestRevenueValue','$monthDateR','$encodedBy','1', '$loanBalanStatus', '$loanBalance')";
            }elseif(substr("$loanApplicationNumberA",0,3) == "EDL"){
                $sql = "UPDATE edl_loan_table SET
                loan_status = 'Released',
                date_released = '$monthDateR',
                last_payment = '$monthDateR'
                WHERE loan_application_number = '$loanApplicationNumberA'";

                $sql3 = "INSERT INTO edl_credit_revenue_table(id_number, loan_application_number,voucher_number, checque_number, amount_release, service_fee, filling_fee, notarial_fee,insurance_fee,interest_revenue, date_transaction, encoded_by,voucher_i, loanb_i, loanb_v) 
                    VALUES ('$idNumberA','$loanApplicationNumberA','$voucherNumber','$checqueNumber', '$loanReleaseValue' ,'$serviceFeeValue','$fillingFeeA','$notarialFeeValue','$insuranceFeeValue','$interestRevenueValue','$monthDateR','$encodedBy','1', '$loanBalanStatus', '$loanBalance')";
            }elseif(substr("$loanApplicationNumberA",0,3) == "EML"){
                $sql = "UPDATE eml_loan_table SET
                loan_status = 'Released',
                date_released = '$monthDateR',
                last_payment = '$monthDateR'
                WHERE loan_application_number = '$loanApplicationNumberA'";

                $sql3 = "INSERT INTO eml_credit_revenue_table(id_number, loan_application_number,voucher_number, checque_number, amount_release, service_fee, filling_fee, notarial_fee,insurance_fee,interest_revenue, date_transaction, encoded_by,voucher_i, loanb_i, loanb_v) 
                    VALUES ('$idNumberA','$loanApplicationNumberA','$voucherNumber','$checqueNumber', '$loanReleaseValue', '$serviceFeeValue','$fillingFeeA','$notarialFeeValue','$insuranceFeeValue','$interestRevenueValue','$monthDateR','$encodedBy','1', '$loanBalanStatus', '$loanBalance')";
            }elseif(substr("$loanApplicationNumberA",0,2) == "RL"){
                $sql = "UPDATE rl_loan_table SET
                loan_status = 'Released',
                date_released = '$monthDateR',
                last_payment = '$monthDateR'
                WHERE loan_application_number = '$loanApplicationNumberA'";

                $sql3 = "INSERT INTO rl_credit_revenue_table(id_number, loan_application_number,voucher_number, checque_number, amount_release ,service_fee, filling_fee, notarial_fee,insurance_fee,interest_revenue, date_transaction, encoded_by,voucher_i, loanb_i, loanb_v) 
                    VALUES ('$idNumberA','$loanApplicationNumberA','$voucherNumber','$checqueNumber', '$loanReleaseValue', '$serviceFeeValue','$fillingFeeA','$notarialFeeValue','$insuranceFeeValue','$interestRevenueValue','$monthDateR','$encodedBy','1', '$loanBalanStatus', '$loanBalance')";
            }elseif(substr("$loanApplicationNumberA",0,3) == "RCL"){
                $sql = "UPDATE rice_loan_table SET
                loan_status = 'Released'
                WHERE loan_application_number = '$loanApplicationNumberA'";

                //$sql3 = "INSERT INTO rice_credit_revenue_table(id_number, loan_application_number,voucher_number, checque_number,service_fee, filling_fee, notarial_fee,insurance_fee,interest_revenue, date_transaction, encoded_by) 
                    //VALUES ('$idNumberA','$loanApplicationNumberA','$voucherNumber','$checqueNumber','$serviceFeeValue','$fillingFeeA','$notarialFeeValue','$insuranceFeeValue','$interestRevenueValue','$monthDateR','1')";

                $sql3 = "UPDATE rice_loan_table SET
                invoice_number = '$voucherNumber'
                WHERE loan_application_number = '$loanApplicationNumberA'";
            }elseif(substr("$loanApplicationNumberA",0,2) == "SL"){
                $sql = "UPDATE sl_loan_table SET
                loan_status = 'Released',
                date_released = '$monthDateR',
                last_payment = '$monthDateR'
                WHERE loan_application_number = '$loanApplicationNumberA'";

                $sql3 = "INSERT INTO sl_credit_revenue_table(id_number, loan_application_number,voucher_number, checque_number, amount_release, service_fee, filling_fee, notarial_fee,insurance_fee,interest_revenue, date_transaction, encoded_by,voucher_i, loanb_i, loanb_v) 
                    VALUES ('$idNumberA','$loanApplicationNumberA','$voucherNumber','$checqueNumber', '$loanReleaseValue', '$serviceFeeValue','$fillingFeeA','$notarialFeeValue','$insuranceFeeValue','$interestRevenueValue','$monthDateR','$encodedBy','1', '$loanBalanStatus', '$loanBalance')";
            }

            $sql1 = "UPDATE loan_date_table SET
            date_released = '$monthDateR'
            WHERE loan_application_number = '$loanApplicationNumberA'";

            $sql2 = "UPDATE loan_encoder_table SET
            released_by = '$encodedBy'
            WHERE loan_application_number = '$loanApplicationNumberA'";

            if ($conn->query($sql) === TRUE and $conn->query($sql2) === TRUE and $conn->query($sql3) === TRUE) {
               //$infomessage = "Record updated successfully";
            } 
            else { 
                  echo "Error: " . $sql . "<br>" . $conn->error;
                  //echo "Error: " . $sql1 . "<br>" . $conn->error;
                  echo "Error: " . $sql2 . "<br>" . $conn->error;
                  echo "Error: " . $sql3 . "<br>" . $conn->error;
                  $displayProperty = "inline";
            }

            $cbu = 0;
            if($cbuRetentionValue > 0){
                $cbu = 1;
                $sql4 = "INSERT INTO share_capital_table(id_number, type_transaction,voucher_number,amount, date_transaction, encoded_by) 
                    VALUES ('$idNumberA','Retention','$voucherNumber','$cbuRetentionValue','$monthDateR','1')";

                if ($conn->query($sql4) === TRUE) {
                   //$infomessage = "Record updated successfully";
                   //echo "$infomessage";
                } 
                else { 
                      echo "Error: " . $sql4 . "<br>" . $conn->error;
                }
            }

            $sd = 0;
            if($savingRetentionValue > 0){
                $sd = 1;
                $sql5 = "INSERT INTO savings_table(id_number, type_transaction, type_savings,voucher_number,amount, date_transaction, encoded_by) 
                    VALUES ('$idNumberA','Retention','S1','$voucherNumber','$savingRetentionValue','$monthDateR','1')";

                if ($conn->query($sql5) === TRUE) {
                   //$infomessage = "Record updated successfully";
                   //echo "$infomessage";
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }

            $pnl = 0;
            if($pnfPayment > 0){
                $pnl = 1;
                $sql5 = "INSERT INTO other_income_table(id_number, or_number, income_code,amount,date_transaction, encoded_by) 
                    VALUES ('$idNumberA','$voucherNumber','pnti','$pnfPayment','$monthDateR','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   //$infomessage = "Record updated successfully";
                   //echo "$infomessage";
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }

            $pnr = 0;
            if($plfPayment > 0){
                $pnr = 1;
                $sql5 = "INSERT INTO other_income_table(id_number, or_number, income_code,amount,date_transaction, encoded_by) 
                    VALUES ('$idNumberA','$voucherNumber','plti','$plfPayment','$monthDateR','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   //$infomessage = "Record updated successfully";
                   //echo "$infomessage";
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }

            $rcl = 0;
            if($riceLoanPayment > 0){
                $rcl = 1;

                $rclLaR = "";
                $ricePTemp = $riceLoanPayment;
                $totalRP = 0;

                $sqlLPR = "SELECT * FROM  rice_loan_table WHERE loan_status = 'Released' and id_number = '$idNumberA' ";
                    $resultLPR = $conn->query($sqlLPR);

                if($resultLPR->num_rows > 0){
                    while ($rowR = mysqli_fetch_array($resultLPR)) {
                        $rclLaR = $rowR['loan_application_number'];
                    
                        //get initial credit
                        $sqlLP = "SELECT * FROM  rice_loan_table WHERE loan_application_number = '$rclLaR' ";
                            $resultLP = $conn->query($sqlLP);

                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                $principalAmount = $row['loan_amount'];
                                $interestAmount = $row['loan_interest'];
                            }
                        }

                        //Get total interest paid
                        $sqlLP = "SELECT * FROM  rice_credit_revenue_table WHERE loan_application_number = '$rclLaR' ";
                            $resultLP = $conn->query($sqlLP);

                        $totalRInterest = 0;
                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                $totalRInterest = $totalRInterest + $row['interest_revenue'];
                            }
                        }

                        //Get total principal paid
                        $sqlLP = "SELECT * FROM  rice_loan_payment_table WHERE loan_application_number = '$rclLaR' ";
                            $resultLP = $conn->query($sqlLP);

                        $totalRPrincipal = 0;
                        if($resultLP->num_rows > 0){
                            while ($row = mysqli_fetch_array($resultLP)) {
                                $totalRPrincipal = $totalRPrincipal + $row['amount'];
                            }
                        }

                        //$totalRPrincipal = $totalRPrincipal + $rclPayment;
                        //$totalRInterest = $totalRInterest + $rclPPayment;

                        $diffPrincipal = $principalAmount-$totalRPrincipal;
                        $diffInterest = $interestAmount-$totalRInterest;

                        $totalRP = $diffPrincipal + $diffInterest;

                        $ricePTemp = $ricePTemp - $totalRP;

                        //Paid Rice Loan
                        $sql = "UPDATE rice_loan_table SET
                        loan_status = 'Paid'
                        WHERE id_number = '$idNumberA' and loan_application_number = '$rclLaR' ";

                        $sqlDP = "UPDATE loan_date_table SET
                        date_paid = '$monthDateR';
                        WHERE id_number = '$idNumberA' and loan_application_number =  '$loanApplicationNumberA' ";

                        if ($conn->query($sqlDP) === TRUE) {
                           $infomessage = "Loan Paid";
                        } 
                        else { 
                          echo "Error: " . $sql . "<br>" . $conn->error;
                        }

                        if ($conn->query($sql) === TRUE) {
                           $infomessage = "Record updated successfully";
                        } 
                        else { 
                              echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                        

                        //Principal Interest
                        if($diffPrincipal != 0 or $diffInterest != 0){
                            $sqlRL1 = "INSERT INTO rice_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                            VALUES ('$idNumberA','$voucherNumber','$rclLaR','$diffPrincipal','$monthDateR', '$encodedBy')";

                            if ($conn->query($sqlRL1) === TRUE){
                                $informessage = "New record created successfully";
                                $diffPrincipal = 0;
                                
                                //$invoiceNumberP = "";
                                //$quantity = "";
                            }else{
                                echo "Error: " . $sqlRL1 . "<br>" . $conn->error;
                            }

                            $sqlRL = "INSERT INTO rice_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                            VALUES ('$idNumberA','$rclLaR','$voucherNumber','$diffInterest','$monthDateR', '$encodedBy')";

                            if ($conn->query($sqlRL) === TRUE){
                                $informessage = "New record created successfully";
                                $diffInterest = 0;
                                $rclLA = "Rice Loan (P)";
                                $totalRP = 0;

                            }else{
                                echo "Error: " . $sqlRL . "<br>" . $conn->error;
                            }
                        }
                    }
                }
            }

            $sql5 = "INSERT INTO disbursement_table(id_number, voucher_number, cl ,lb,pnl,pnr, rcln, rcln_value,exp, cbur,sdr, date_transaction, encoded_by) 
                    VALUES ('$idNumberA','$voucherNumber','1','$lb','$pnl','$pnr','$rcl', '$riceLoanPayment','0','$cbu','$sd','$monthDateR','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                    $infomessage = "Record updated successfully";
                    $releaseLoanApplication = "";
                    $print = "print";
                    
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
        }else{
            $infomessage =  "Fill Up Empty Field";
            $displayProperty = "inline";

            //echo "$releaseLoanApplication";
            //echo "$idNumberA";
            //echo "$loanApplicationNumberA";
            //echo "$checqueNumber";
            //echo "$voucherNumber";
            //echo "$serviceFeeValue";
            //echo "$fillingFeeA";
            //echo "$savingRetentionValue";
            //echo "$cbuRetentionValue";
            //echo "$insuranceFeeValue";
            //echo "$notarialFeeValue";
            //echo "$interestRevenueValue";
        }

        //$loanAmountA = "";
        //$voucherNumber = "";
        //$checqueNumber = "";
        //$monthDateR = "";
        //$totalCharges = 0;
        //$loanReleaseValue = 0;
   }

   if($typeInterestA == "Diminishing"){
        $displayPropertyLoan = "inline";
        $loanInterestP = $loanInterestA;
        $loanTermP = $loanTermA;

        $loanInterestP = $loanInterestP/100;

        $numberator = $loanAmountA*$loanInterestP;
        $denominator = 1-pow((1+$loanInterestP),-$loanTermP);
        $monthlyAmortization = $numberator / $denominator;

        $OSBalance = $loanAmountA;
        $totalPrincipal = 0;
        $totalInterest = 0;
        $actualInterest = 0;

        $actualPrincipal = 0;
        $actualInterest = 0;
        $actualBalanceTemp = 0;
        $actualBalance = $loanAmountA;

        $monthlyAmortization = round($monthlyAmortization,2,PHP_ROUND_HALF_DOWN);
        $interestPayment = $loanAmountA * $loanInterestP;

        //actual
        $actualInterest = $loanAmountA * $loanInterestP;

        if ($paymentTermA == "Daily") {
          $loanTermP = $loanTermP * 30;
          $paymentTermP = 30;
        }elseif ($paymentTermA == "Semi Monthly") {
          $loanTermP = $loanTermP * 2;
          $paymentTermP = 2;
        }
        elseif ($paymentTermA == "Monthly") {
          $loanTermP = $loanTermP * 1;  
          $paymentTermP = 1;
        }

        $monthlyAmortization = $monthlyAmortization / $paymentTermP;
        $monthlyAmortization = round($monthlyAmortization,2,PHP_ROUND_HALF_ODD);

        $interestPayment = $interestPayment / $paymentTermP;
        $interestPayment =  round($interestPayment,2,PHP_ROUND_HALF_ODD);

        //actual
        $actualInterest = $interestPayment / $paymentTermP;
        $actualInterest =  round($actualInterest,2,PHP_ROUND_HALF_ODD);
   }else{
     $effectiveir = "$loanInterestA";
   }

   if($print == "print"){
        //Print Report::
        if($typeInterestA == "Diminishing"){
            $displayPropertyLoan = "inline";
            $loanInterestP = $loanInterestA;
            $loanTermP = $loanTermA;

            $loanInterestP = $loanInterestP/100;

            $numberator = $loanAmountA*$loanInterestP;
            $denominator = 1-pow((1+$loanInterestP),-$loanTermP);
            $monthlyAmortization = $numberator / $denominator;

            $OSBalance = $loanAmountA;
            $totalPrincipal = 0;
            $totalInterest = 0;
            $actualInterest = 0;

            $actualPrincipal = 0;
            $actualInterest = 0;
            $actualBalanceTemp = 0;
            $actualBalance = $loanAmountA;

            $monthlyAmortization = round($monthlyAmortization,2,PHP_ROUND_HALF_DOWN);
            $interestPayment = $loanAmountA * $loanInterestP;

            //actual
            $actualInterest = $loanAmountA * $loanInterestP;

            if ($paymentTermA == "Daily") {
              $loanTermP = $loanTermA * 30;
              $paymentTermP = 30;
            }elseif ($paymentTermA == "Semi Monthly") {
              $loanTermP = $loanTermA * 2;
              $paymentTermP = 2;
            }
            elseif ($paymentTermA == "Monthly") {
              $loanTermP = $loanTermA * 1;  
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

        $pdf = new FPDF();

        $rowCounter = 0;

        $pdf->SetFont('Arial','B',9);
        $pdf->AddPage('P','Legal', 0);

        $pdf->Cell(50,7,"");
        $pdf->Ln();
        
        //foreach($header as $col)

        //Title
        $pdf->Cell(50,7,"");
        $pdf->Cell(100,7,"MALIGAYA WET MARKET MULTI-PURPOSE COOPERATIVE");
        $pdf->Ln();
        $pdf->Cell(55,7,"");
        $pdf->Cell(100,7,"AFAB Wet Market, Brgy. Maligaya, Mariveles, Bataan");
        $pdf->Ln();

        $pdf->Cell(50,7,"");
        $pdf->Cell(100,7,"DISCLOSURE STATEMENT OF LOAN/CREDIT TRANSACTION");
        $pdf->Ln();
        $pdf->Cell(55,7,"");
        $pdf->Cell(100,7,"(As Required under RA 3765, Truth of Lending Act)");
        $pdf->Ln();
        
        $pdf->Cell(40,7,"NAME OF BORROWER:");
        $pdf->Cell(30,7,"$lastNameA" . ",". "$firstNameA" . " " .  "$middleNameA");
        $pdf->Ln();
        $pdf->Cell(40,7,"ADDRESS:");
        $pdf->Cell(30,7,"$addressinfo");
        ;$pdf->Ln();
        $pdf->Cell(40,7,"Telephone/Mobile #:");
        $pdf->Cell(30,7,"$contactinfo");
        $pdf->Ln();
        $pdf->Cell(40,7,"Terms");
        $pdf->Cell(30,7,"$loanTermA");
        $pdf->Ln();
        
        $pdf->Cell(110,7,"1. LOAN AMOUNT:");
        $pdf->Cell(30,7, number_format($loanAmountA,'2','.',','));
        $pdf->Ln();

        $pdf->Cell(100,7,"2. OTHER CHARGES/DEDUCTIONS COLLECTED:");
        $pdf->Ln();

        if($serviceFeeValue == 0){
            $serviceFeeValue = "-";
        }
        $pdf->Cell(10,7,"");
        $pdf->Cell(50,7,"a. Service Fee:");
        $pdf->Cell(30,7,"$serviceFeeValue");
        $pdf->Ln();

        if($savingRetentionValue == 0){
            $savingRetentionValue = "-";
        }
        $pdf->Cell(10,7,"");
        $pdf->Cell(50,7,"b. Savings Deposit:");
        $pdf->Cell(30,7,"$savingRetentionValue");
        $pdf->Ln();

        if($cbuRetentionValue == 0){
            $cbuRetentionValue = "-";
        }
        $pdf->Cell(10,7,"");
        $pdf->Cell(50,7,"c. CBU:");
        $pdf->Cell(30,7,"$cbuRetentionValue");
        $pdf->Ln();

        if($fillingFeeA == 0){
            $fillingFeeA = "-";
        }
        $pdf->Cell(10,7,"");
        $pdf->Cell(50,7,"d. Filling Fee:");
        $pdf->Cell(30,7,"$fillingFeeA");
        $pdf->Ln();

        if($insuranceFeeValue == 0){
            $insuranceFeeValue = "-";
        }
        $pdf->Cell(10,7,"");
        $pdf->Cell(50,7,"e. Loan Insurance");
        $pdf->Cell(30,7,"$insuranceFeeValue");
        $pdf->Ln();

        if($interestRevenueValue == 0){
            $interestRevenueValue = "-";
        }

        $pdf->Cell(10,7,"");
        $pdf->Cell(50,7,"f. Interest Income");
        $pdf->Cell(30,7,"$interestRevenueValue");
        $pdf->Ln();

        if($notarialFeeValue == 0){
            $notarialFeeValue = "-";
        }
        $pdf->Cell(10,7,"");
        $pdf->Cell(50,7,"g. Notarial Fee");
        $pdf->Cell(30,7,"$notarialFeeValue");
        $pdf->Ln();

        if($loanBalance !=0 or $pnfPayment != 0 or $riceLoanPayment != 0 or $plfPayment != 0){

            $pdf->Cell(10,7,"");
            $pdf->Cell(50,7,"h. Oustanding Balance");
            $pdf->Ln();

            if($loanBalance == 0){
                $loanBalance = "-";
            }

            if($plfPayment == 0){
                $plfPayment = "-";
            }

            if($riceLoanPayment == 0){
                $riceLoanPayment = "-";
            }

            if($pnfPayment == 0){
                $pnfPayment = "-";
            }

            $pdf->Cell(15,7,"");
            $pdf->Cell(45,7,"Loan Balance");
            $pdf->Cell(25,7,$loanBalance);
            $pdf->Ln();

            $pdf->Cell(15,7,"");
            $pdf->Cell(45,7,"Loan Penalty");
            $pdf->Cell(30,7,$plfPayment);
            $pdf->Ln();

            $pdf->Cell(15,7,"");
            $pdf->Cell(45,7,"Rice Balance");
            $pdf->Cell(25,7,$riceLoanPayment);
            $pdf->Ln();

            $pdf->Cell(15,7,"");
            $pdf->Cell(45,7,"Rice Penalty");
            $pdf->Cell(25,7,$pnfPayment);
            $pdf->Ln();
        }else{
            if($loanBalance == 0){
                $loanBalance = "-";
            }

            $pdf->Cell(10,7,"");
            $pdf->Cell(50,7,"h. Oustanding Balance");
            $pdf->Cell(30,7,$loanBalance);
            $pdf->Ln();
        }

        $tcharges = $loanAmountA - $loanReleaseValue;

        $pdf->Cell(10,7,"");
        $pdf->Cell(100,7,"TOTAL CHARGES");
        $pdf->Cell(30,7,number_format($tcharges,'2','.',','));
        $pdf->Ln();

        $pdf->Cell(110,7,"3. NET PROCEEDS OF LOAN:");
        $pdf->Cell(30,7,number_format($loanReleaseValue,'2','.',','));
        $pdf->Ln();

        $pdf->Cell(100,7,"4. SCHEDULE OF PAYMENTS: ( at the back )");
        $pdf->Ln();

        $pdf->Cell(110,7,"5. EFFECTIVE INTEREST RATE:");
        if($typeInterestA == "Diminishing"){
            $pdf->Cell(30,7,"$effectiveir %");
        }else{
            $pdf->Cell(30,7,"$loanInterestA %");
        }
        $pdf->Ln();

        $pdf->Cell(100,7,"6. ADDITIONAL CHARGES IN CASE CERTAIN STIPULATION ARE NOT MET BY THE BORROWER:");
        $pdf->Ln();

        if(substr("$loanApplicationNumberA", 0,3) == "CML"){
            if($loanAmountA >= 100000){
                $ppenalty = "1%";
            }elseif($loanAmountA < 100000){
                $ppenalty = "1.5%";
            }
        }elseif (substr("$loanApplicationNumberA", 0,2) == "SL") {
            $ppenalty = "1.5%";
        }else{
            $ppenalty = "2%";
        }


        $pdf->Cell(10,7,"");
        $pdf->Cell(50,7,"a.  Penalty on past due account, ");
        $pdf->Cell(5,7,"$ppenalty");
        $pdf->Cell(100,7," per month");
        $pdf->Ln();

        $pdf->Cell(10,7,"");
        $pdf->Cell(100,7,"b. Attorney's fee in case of suit.");
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Cell(100,7,"");
        $pdf->Cell(100,7,"Certified Correct:");
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(100,7,"");
        $pdf->Cell(100,7,"___________________________");
        $pdf->Ln();
        $pdf->Cell(100,7,"");
        $pdf->Cell(5,7,"$managerP");
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Cell(200,7,"I/We acknowledge the receipt of a copy of this Statement prior to the consumation of credit transaction and that I understand");
        $pdf->Ln();
        $pdf->Cell(200,7,"and fully agree to terms and conditions thereof.");

        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(100,7,"");
        $pdf->Cell(100,7,"______________________________________________");
        $pdf->Ln();
        $pdf->Cell(100,7,"");
        $pdf->Cell(200,7,"Borrower's Print Name & Signature/Date Receive");

        $pdf->AddPage('P','Legal', 0);

        $pdf->Cell(100,7,"SCHEDULE OF LOAN PAYMENTS");
        $pdf->Ln();

        $pdf->Cell(40,7,"NAME OF BORROWER:");
        $pdf->Cell(30,7,"$lastNameA" . ",". "$firstNameA" . " " .  "$middleNameA");
        $pdf->Ln();

        $pdf->Cell(40,7,"Amount of Loan:");
        $pdf->Cell(30,7,number_format("$loanAmountA",'2','.',','));
        $pdf->Ln();

        $pdf->Cell(40,7,"Interest Rate/month:");
        $pdf->Cell(30,7,"$loanInterestA");
        $pdf->Ln();

        $pdf->Cell(40,7,"Term of payment:");
        $pdf->Cell(30,7,"$loanTermA");
        $pdf->Ln();

        $pdf->Cell(40,7,"Mode of payment:");
        $pdf->Cell(30,7,"$paymentTermA");
        $pdf->Ln();

        $pdf->Cell(40,7,"Date Release:");
        $pdf->Cell(30,7,"$monthDateR");
        $pdf->Ln();

        $pdf->Cell(40,7,"Effective Interest Rate:");
        if($typeInterestA == "Diminishing"){
            $pdf->Cell(30,7,"$effectiveir %");
        }else{
            $pdf->Cell(30,7,"$loanInterestA %");
        }
        $pdf->Ln();

        $pdf->Cell(30,7,"Due Date",1);
        $pdf->Cell(35,7,"Monthly Amortization",1);
        $pdf->Cell(30,7,"Principal",1);
        $pdf->Cell(30,7,"Interest",1);
        $pdf->Cell(30,7,"O/S Balance",1);
        $pdf->Ln();

        if($typeInterestA == "Diminishing"){

          $counterh = 0;
          
          $sumPrincipal = 0;
          $monthDateS = new DateTime($monthDateR);

          if($paymentTermA == "Semi Monthly"){
              $loanTermA = $loanTermA * 2;
          }elseif($paymentTermA == "Daily"){
              $loanTermA = $loanTermA * 30;
          }

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
              if($paymentTermA == "Monthly"){
                  $monthDateS->add(new DateInterval('P'.(30).'D'));
              }elseif($paymentTermA == "Semi Monthly"){
                  $monthDateS->add(new DateInterval('P'.(15).'D'));
              }else{
                  $monthDateS->add(new DateInterval('P'.(1).'D'));
              }

            $dateFormat = $monthDateS->format('Y-m-d');
            $pdf->Cell(30,7,"$dateFormat",1);
            $pdf->Cell(35,7,number_format($monthlyAmortization,'2','.',','),1);
            $pdf->Cell(30,7,number_format($principalPayment,'2','.',','),1);
            $pdf->Cell(30,7,number_format($interestPayment,'2','.',','),1);
            $pdf->Cell(30,7,number_format($OSBalanceTemp,'2','.',','),1);
            $pdf->Ln();

              $counterh ++;
              
              if($paymentTermA == "Semi Monthly"){
                  $identifier = $counterh % 2;
                  if($identifier == 1){
                      $interestPayment = $interestPayment;
                  }else{
                      $interestPayment = round($OSBalanceTemp * $loanInterestP,2,PHP_ROUND_HALF_ODD);
                      $interestPayment = $interestPayment / $paymentTermP;
                  }  
              }elseif($paymentTermA == "Daily"){
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

           if( $totalPrincipal != $loanAmountA ){
              $monthlyAmortization = $monthlyAmortization - ($totalPrincipal - $loanAmountA);
              $totalPrincipal = $totalPrincipal - ($totalPrincipal - $loanAmountA);
           }

           $effectiveir = ($totalInterest / $totalPrincipal) * 100;
           $effectiveir = round($effectiveir);
           
           $pdf->Cell(30,7,"",1);
           $pdf->Cell(35,7,number_format($monthlyAmortization,'2','.',','),1);
           $pdf->Cell(30,7,number_format($totalPrincipal,'2','.',','),1);
           $pdf->Cell(30,7,number_format($totalInterest,'2','.',','),1);
           $pdf->Cell(30,7,"",1);
           $pdf->Ln();
        }else{

            $monthDateR = new DateTime($monthDateR);
            $monthDateR->add(new DateInterval('P'.($loanTermA*30).'D'));
            $monthDateR = $monthDateR->format('Y-m-d');

            $pdf->Cell(30,7,"$monthDateR",1);
            $pdf->Cell(35,7,number_format($loanAmountA,'2','.',','),1);
            $pdf->Cell(30,7,number_format($loanAmountA,'2','.',','),1);
            $pdf->Cell(30,7,"",1);
            $pdf->Cell(30,7,number_format($loanAmountA,'2','.',','),1);
            $pdf->Ln();
        }

          $pdf->Ln();
          $pdf->Cell(70,7,"Prepared by:");
          $pdf->Cell(70,7,"Review & Checked by:");
          $pdf->Cell(70,7,"Noted by:");
          $pdf->Ln();

          $pdf->Cell(70,7,"$loanOfficer");
          $pdf->Cell(70,7,"$bookKeeper");
          $pdf->Cell(70,7,"$managerP");
          $pdf->Ln();

          $pdf->Cell(70,7,"____________________");
          $pdf->Cell(70,7,"____________________");
          $pdf->Cell(70,7,"____________________");
          $pdf->Ln();

          $pdf->Cell(70,7,"Loan Officer");
          $pdf->Cell(70,7,"Bookkeeper");
          $pdf->Cell(70,7,"Manager");
          $pdf->Ln();
          $pdf->Ln();

          $pdf->Cell(70,7,"Conforme:                    I acknowledge receipt of a copy of this schedule and hereby declare that I have read");
          $pdf->Ln();
          $pdf->Cell(10,7,"");
          $pdf->Cell(70,7,"this document and the contents thereof were fully explained to me.  And payment shall be in a");
          $pdf->Ln();
          $pdf->Cell(10,7,"");
          $pdf->Cell(70,7,"cash basis the monthly installment due until fully paid.");
          $pdf->Ln();

          $pdf->Cell(70,7,"");
          $pdf->Cell(70,7,"");
          $pdf->Cell(70,7,"______________________________");
          $pdf->Ln();

          $pdf->Cell(70,7,"");
          $pdf->Cell(70,7,"");
          $pdf->Cell(70,7,"Borrower's Print Name & Signature");

        $pdf->Output();

       //Data
       $plfPayment = 0;
       $pnfPayment = 0;
       $riceLoanPayment = 0;

       $savingRetentionValue = 0;
       $cbuRetentionValue = 0;
       $releaseLoanApplication = "";
       $loanApplicationNumberA = "";
       $serviceFeeValue = 0;
       $fillingFeeA = 0;
       $insuranceFeeValue = 0;
       $notarialFeeValue = 0;
       $interestRevenueValue = 0;
       $displayProperty = "inline";

       //echo "$infomessage";
       $lb = 0;
       $pnl = 0;
       $pnr = 0;
       $rcl = 0;
       $exp = 0;
       $cbur = 0;
       $sdr = 0;
       $voucherNumber = "";
       $idNumberA = "";
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
    <title>Release Loan</title>
    <?php include "css.html" ?>

    <script>
    i = 0;
    $(document).ready(function(){
        $(".famount").keyup(function(){

            var totalC = 0;
            $('.famount').each(function() {
                totalC += Number($(this).val());
            });

            var totalR = 0;
            totalR = Number($("#la").val()) - Number(totalC) - Number($("#lbp").val());

            $("#tacharges").val(totalC);
            $("#tarelease").val(totalR);
        });
    });
    </script>
</head>

<body>
<div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php //include 'topbar.php';?>
        <div id="postView" class="modal">
            <div class="modal-content modal-payment" >
                <div>
                <span onclick="document.getElementById('postView').style.display='none'" class="close">&times;</span>
                <p>Loan Charges</p>
                <label style="width: 150px">Voucher #</label>
                <input id = "vvf" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" readonly><br>
                <label style="width: 150px">Checque Number</label>
                <input id = "cvf" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" readonly><br><br>
                <label style="width: 150px">Service Fee</label>
                <input id = "sfvf" style="width: 130px" type="text" style="border: none;" readonly><br>
                <label style="width: 150px">Filing Fee</label>
                <input id = "ffvf" style="width: 130px" type="text" style="border: none;" readonly><br>
                <label style="width: 150px">CBU Retention</label>
                <input id = "crvf" style="width: 130px" type="text" style="border: none;" readonly><br>
                <label style="width: 150px">Savings Retention</label>
                <input id = "srvf" style="width: 130px" type="text" style="border: none;" readonly><br>
                <label style="width: 150px">Interest Rate</label>
                <input id = "irvf" style="width: 130px" type="text" style="border: none;" readonly><br>
                <label style="width: 150px">Insurance Fee</label>
                <input id = "ifvf" style="width: 130px" type="text" style="border: none;" readonly><br>
                <label style="width: 150px">Notarial Fee</label>
                <input id = "nfvf" style="width: 130px" type="text" style="border: none;" readonly><br>
                <label style="width: 150px">Total Charges</label>
                <input id = "tcff" style="width: 130px" type="text" style="border: none;" readonly><br><br>

                <label style="width: 150px">Loan Balance</label>
                <input id = "lvvf" style="width: 130px" type="text" style="border: none;" readonly><br>
                <label style="width: 150px">Loan Amount</label>
                <input id = "laf" style="width: 130px" type="text" style="border: none;" readonly><br>
                <label style="width: 150px">Loan Release</label>
                <input id = "lrf" style="width: 130px;border: none;border-bottom: 2px solid red;color: red;" readonly><br>
                </div>
                
                <button class="btn btn-outline-success my-2 my-sm-0"  value="releaseLoanApplication" name= "releaseLoanApplication" type="submit">POST RELEASE</button>
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
                        <label style="width: 150px">Loan Interest</label>
                        <input style="width: 335px;height: 50px;text-align: right;font-size: 40px;" type="text" id = "lii" autocomplete="off"><br><br>
                    </div>  
                </div>
                <button style="width:335px;" onclick="postAmount()" class="btn btn-outline-success my-2 my-sm-0" name = "postPayment" value = "postPayment">POST</button>
            </div>
        </div>

        <div id="printloandocs" class="modal"  onload="printsettings("<?php echo $displayProperty; ?>")">
            <div class="modal-content modal-payment" >
                <button class="btn btn-outline-success my-2 my-sm-0" type = "submit" name = "print" value = "print">PRINT DOCUMENTS</button>
            </div>
        </div>

        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-9" style="margin-top:1px;margin-left: 16.7%;">
                <p align="center"><span><?php echo $infomessage;?></span><br></p>
                <div class="table table-striped table-hover">
                    <?php
                    if($displayProperty == "none"){
                        echo "<p" . "align=" . "center;>" . "List of Loan Application for Release" . "</p>";
                        echo "<table>
                        <tr>
                            <th>ID Number</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Loan Application Number</th>
                            <th>Loan Service ID</th>
                            <th>Loan Amount</th>
                            <th>Loan Term</th>
                            <th>Cancel Application</th>
                        </tr>";
            
                        $counterh = 0;
                        while($counterh < $numRow) {
                                echo "<tr>";
                                    echo "<td>" . $idNumber[$counterh] . "</td>";
                                    echo "<td>" . $firstName[$counterh] . "</td>";
                                    echo "<td>" . $middleName[$counterh] . "</td>";
                                    echo "<td>" . $lastName[$counterh] . "</td>";
                                    echo "<td> <button type =" . "submit" . " " ."value=". $loanApplicationNumber[$counterh] . " " . "name=" . "myButton". ">"  . $loanApplicationNumber[$counterh] . " </button> </td>";
                                    echo "<td>" . $loanServiceId[$counterh] . "</td>";
                                    echo "<td>" . number_format($loanAmount[$counterh],2,'.',',') . "</td>";
                                    echo "<td>" . $loanTerm[$counterh] . "</td>";

                                    echo "<td> <button type =" . "submit" . " " . "class=" . "btn btn-info btn-xs view" . " "    ."value=". $loanApplicationNumber[$counterh] . " " . "name=" . "cancelB". ">"  . $loanApplicationNumber[$counterh] . " CANCEL" . " </button> </td>";
                                echo "</tr>";
                            $counterh ++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="<?php echo $displayProperty;?>">
            <div class="col-sm-9" style="margin-top:25px;margin-left: 16.7%;">  
                <div class="row">
                    <div class="col-lg-2.5" style="background-color:#fff; padding: 10px; margin: 10px">
                        <h6>Account Information</h6>
                        <div class="form-group">
                            <label style="width: 150px">ID Number</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $idNumberA;?>" name = "idNumberA" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="width: 150px">Account Number</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $accountNumberA;?>" name = "accountNumberA" readonly>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="First Name" value = "<?php echo $firstNameA;?>" name = "firstNameA" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Middle Name" value = "<?php echo $middleNameA;?>" name = "middleNameA" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Last Name" value = "<?php echo $lastNameA;?>" name = "lastNameA" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2.5" style="background-color:#fff; padding: 10px; margin: 10px">
                        <h6>Loan Application Info</h6>
                        <br>

                        <label style="width: 120px">Loan Code</label>
                        <input id = "lan" style="width: 140px" type="text" value = "<?php echo $loanApplicationNumberA;?>" name = "loanApplicationNumberA" placeholder="Loan Application Number" readonly><br>

                        <label style="width: 120px">Date Loan</label>
                        <input type="date" style="width: 140px" value = "<?php echo $monthDateR;?>" name = "monthDateR" placeholder="Loan Term" readonly><br>

                        <label style="width: 120px">Loan Amount</label>
                        <input id = "la" type="text" style="width: 140px" value = "<?php echo $loanAmountA;?>" name = "loanAmountA" placeholder="Loan Amount" readonly><br>

                        <label style="width: 120px">Loan Interest</label>
                        <input type="text" style="width: 140px" value = "<?php echo $loanInterestA;?>" name = "loanInterestA" placeholder="Loan Interest" readonly><br>

                        <label style="width: 120px">Loan Term</label>
                        <input type="text" style="width: 140px" value = "<?php echo $loanTermA;?>" name = "loanTermA" placeholder="Loan Term" readonly><br>

                        <label style="width: 120px">Payment Term</label>
                        <input type="text" style="width: 140px" value = "<?php echo $paymentTermA;?>" name = "paymentTermA" placeholder="Payment Term" readonly><br>

                        <label style="width: 120px">Type Loan</label>
                        <input type="text" style="width: 140px" value = "<?php echo $typeInterestA;?>" name = "typeInterestA" placeholder="Type Interest" readonly><br>

                    </div>

                    <div class="col-lg-2.5" style="background-color:#fff; padding: 10px; margin: 10px">
                        <h6>Other Charges and Deduction</h6>
                        <label style="width: 150px">Voucher/Invoice Number</label>
                        <input id = "vv" style="width: 130px" type="text" value = "<?php echo $voucherNumber;?>" name = "voucherNumber" placeholder="Voucher/Invoice #"><br>
                        <label style="width: 150px">Checque Number</label>
                        <input id = "cv" style="width: 130px" type="text" value = "<?php echo $checqueNumber;?>" name = "checqueNumber" placeholder="Checque Number"><br><br>
                        <label style="width: 150px">Service Fee</label>
                        <input class = 'famount' id = "sfv" style="width: 130px" type="text" value = "<?php echo $serviceFeeValue;?>" name = "serviceFeeValue"><br>
                        <label style="width: 150px">Filing Fee</label>
                        <input class = 'famount' id = "ffv" style="width: 130px" type="text" value = "<?php echo $fillingFeeA;?>" name = "fillingFeeA"><br>
                        <label style="width: 150px">CBU Retention</label>
                        <input class = 'famount' id = "crv" style="width: 130px" type="text" value = "<?php echo $cbuRetentionValue;?>" name = "cbuRetentionValue"><br>
                        <label style="width: 150px">Savings Retention</label>
                        <input class = 'famount' id = "srv" style="width: 130px" type="text" value = "<?php echo $savingRetentionValue;?>" name = "savingRetentionValue"><br>
                        <label style="width: 150px">Interest Rate</label>
                        <input class = 'famount' id = "irv" style="width: 130px" type="text" value = "<?php echo $interestRevenueValue;?>" name = "interestRevenueValue"><br>
                        <label style="width: 150px">Insurance Fee</label>
                        <input class = 'famount' id = "ifv" style="width: 130px" type="text" value = "<?php echo number_format($insuranceFeeValue,'2','.','');?>" name = "insuranceFeeValue"><br>
                        <label style="width: 150px">Notarial Fee</label>
                        <input class = 'famount' id = "nfv" style="width: 130px" type="text" value = "<?php echo $notarialFeeValue;?>" name = "notarialFeeValue"><br>
                        <label style="width: 150px">Total Charges Fee</label>
                        <input id = "tacharges" style="width: 130px" type="text" value = "<?php echo number_format($totalChargesTemp,'2','.','');?>" name = "totalChargesTemp" readonly><br>
                    

                    <div id = "reloan" class="<?php echo $displayPropertyReloan;?>">
                        <br>
                        <h6>Others</h6>
                        <label style="width: 120px">Penalty Loan:</label>  
                        <input style="width: 75px" id = "plf" type="text" value = "<?php echo number_format($plfPayment,'2','.','');?>" name="plfPayment" readonly><br>
                        <label style="width: 120px">Penalty Rice:</label>  
                        <input style="width: 75px" id = "pnf" type="text" value = "<?php echo number_format($pnfPayment,'2','.','');?>" name="pnfPayment" readonly><br>
                        <label style="width: 120px">Rice Loan:</label>  
                        <input style="width: 75px" id = "rcln" type="text" value = "<?php echo number_format($riceLoanPayment,'2','.','');?>" name="riceLoanPayment" readonly><br>  
                    </div>

                    </div>

                    <div class="col-lg-2.5" style="background-color:#fff; padding: 10px; margin: 10px">
                        <h6>Loan Balance</h6>
                        <br>
                        <select onchange ="viewAmount()" style="width: 195px" id="top" name = "typePayment">
                            <option value="" <?php if($loanBalanceAN == "") echo "selected"; ?>>Reloan</option>
                            <?php 
                                if($idNumberA != "" or $loanApplicationNumberId != ""){
                                    $counterh = 0;
                                    while($counterh < $numRowList) {
                                        echo "<option value=". $loanApplicationNumberList[$counterh] . ">"  . "$loanApplicationNumberList[$counterh]" . " </option> ";
                                        $counterh ++;
                                    }
                                }
                            ?>
                            <option value="plti" <?php if($typePayment == "plti") echo "selected"; ?>>Penalty (Loan)</option>
                            <option value="pnti" <?php if($typePayment == "pnti") echo "selected"; ?>>Penalty (Rice)</option>
                            <option value="rcrl" <?php if($typePayment == "rcrl") echo "selected"; ?>>Rice Loan</option>
                        </select><br>
                        
                        <div id = "reloan" class="<?php echo $displayPropertyReloan;?>">
                            <label style="width: 45px">For: </label>
                            <input id = "lban" style="width: 150px;border: none;" type="text" value="<?php echo $loanBalanceAN;?>" name = "loanBalanceAN" readonly><br>

                            <!-- Loan -->
                            <input style="width: 120px" id = "bll" type="text" value = "<?php echo $blLA;?>" name="blLA" readonly> 
                            <input style="width: 75px" id = "bl" type="text" value = "<?php echo number_format($blPayment,'2','.','');?>" name="blPayment" readonly>
                            <input style="width: 75px" id = "bli" type="text" value = "<?php echo number_format($blPaymentI,'2','.','');?>" name="blPaymentI" readonly>
                            <br>

                            <input style="width: 120px" id = "clll" type="text" value = "<?php echo $cllLA;?>" name="cllLA" readonly>
                            <input style="width: 75px" id = "cll" type="text" value = "<?php echo number_format($cllPayment,'2','.','');?>" name="cllPayment" readonly><br>

                            <input style="width: 120px" id = "cls" type="text" value = "<?php echo $clLA;?>" name="clLA" readonly>  
                            <input style="width: 75px" id = "cl" type="text" value = "<?php echo number_format($clPayment,'2','.','');?>" name="clPayment" readonly><br>

                            <input style="width: 120px" id = "cmll" type="text" value = "<?php echo $cmlLA;?>" name="cmlLA" readonly>
                            <input style="width: 75px" id = "cml" type="text" value = "<?php echo number_format($cmlPayment,'2','.','');?>" name="cmlPayment" readonly>
                            <input style="width: 75px" id = "cmli" type="text" value = "<?php echo number_format($cmlPaymentI,'2','.','');?>" name="cmlPaymentI" readonly><br>

                            <input style="width: 120px" id = "chkll" type="text" value = "<?php echo $chklLA;?>" name="chklLA" readonly> 
                            <input style="width: 75px" id = "chkl" type="text" value = "<?php echo number_format($chklPayment,'2','.','');?>" name="chklPayment" readonly><br>

                            <input style="width: 120px" id = "edll" type="text" value = "<?php echo $edlLA;?>" name="edlLA" readonly>  
                            <input style="width: 75px" id = "edl" type="text" value = "<?php echo number_format($edlPayment,'2','.','');?>" name="edlPayment" readonly>
                            <input style="width: 75px" id = "edli" type="text" value = "<?php echo number_format($edlPaymentI,'2','.','');?>" name="edlPaymentI" readonly><br>

                            <input style="width: 120px" id = "emll" type="text" value = "<?php echo $emlLA;?>" name="emlLA" readonly>  
                            <input style="width: 75px" id = "eml" type="text" value = "<?php echo number_format($emlPayment,'2','.','');?>" name="emlPayment" readonly><br>

                            <input style="width: 120px" id = "sll" type="text" value = "<?php echo $slLA;?>" name="slLA" readonly>
                            <input style="width: 75px" id = "sl" type="text" value = "<?php echo number_format($slPayment,'2','.','');?>" name="slPayment" readonly><br>

                            <input style="width: 120px" id = "rll" type="text" value = "<?php echo $rlLA?>" name="rlLA" readonly>   
                            <input style="width: 75px" id = "rl" type="text" value = "<?php echo number_format($rlPayment,'2','.','');?>" name="rlPayment" readonly>
                            <input style="width: 75px" id = "rli" type="text" value = "<?php echo number_format($rlPaymentI,'2','.','');?>" name="rlPaymentI" readonly>
                            <br>

                            <input style="width: 120px" id = "pll" type="text" value = "<?php echo $plLA;?>" name="plLA" readonly>   
                            <input style="width: 75px" id = "pl" type="text" value = "<?php echo number_format($plPayment,'2','.','');?>" name="plPayment" readonly>  
                            <input style="width: 75px" id = "plif" type="text" value = "<?php echo number_format($pliPayment,'2','.','');?>" name="pliPayment" readonly><br>

                            <label style="width: 120px">Loan Balance</label>
                            <input id = "lbp" style="width: 75px" type="text" value = "<?php echo number_format($loanBalance,'2','.','');?>" name = "loanBalance"><br>

                            <br>       
                        </div>
                        <br>
                        <label style="width: 150px">Total Release</label>
                        <input id = "tarelease" style="width: 130px" type="text" value = "<?php echo number_format($loanReleaseValue,'2','.','');?>" name = "loanReleaseValue" readonly><br> 
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6" style="margin-top:10px;margin-left: 16.7%;">
            <div>
            <!--<div class="table table-striped table-hover table-dark">-->
                <?php

                  if($displayPropertyLoan != "none"){

                      $counterh = 0;
                      
                      $sumPrincipal = 0;
                      $monthDateS = new DateTime($monthDateR);

                      while($counterh < $loanTermP) {
                          $check = $counterh + 1;

                          $totalInterest = $totalInterest + $interestPayment;
                          $principalPayment = round(($monthlyAmortization - $interestPayment),2,PHP_ROUND_HALF_ODD);

                          $OSBalance = $OSBalance - $principalPayment;
                          $OSBalanceTemp = round($OSBalance,2,PHP_ROUND_HALF_ODD);

                          if($loanTermP == $check){
                              if($OSBalanceTemp > 0){
                                  $OSBalanceTemp = 0;
                              }elseif($OSBalanceTemp < 0){
                                  $OSBalanceTemp = 0;
                              }
                          }

                          //new DateTime($monthDateA);
                          if($paymentTermA == "Monthly"){
                              $monthDateS->add(new DateInterval('P'.(30).'D'));
                          }elseif($paymentTermA == "Semi Monthly"){
                              $monthDateS->add(new DateInterval('P'.(15).'D'));
                          }else{
                              $monthDateS->add(new DateInterval('P'.(1).'D'));
                          }


                          /*
                          echo "<tr>"; 
                              echo "<td>"; echo $monthDateS->format('Y-m-d');  echo "</td>";
                              //echo "<td>"; echo $dateApplication->format('Y-m-d');  echo "</td>";
                              echo "<td>" . number_format($monthlyAmortization,'2','.',',') . "</td>";
                              echo "<td>" . number_format($principalPayment,'2','.',',') . "</td>";
                              echo "<td>" . number_format($interestPayment,'2','.',',') . "</td>";
                              echo "<td>" . number_format($OSBalanceTemp,'2','.',',') . "</td>";
                          echo "</tr>";
                          */

                          $counterh ++;
                          
                          if($paymentTermA == "Semi Monthly"){
                              $identifier = $counterh % 2;
                              if($identifier == 1){
                                  $interestPayment = $interestPayment;
                              }else{
                                  $interestPayment = round($OSBalanceTemp * $loanInterestP,2,PHP_ROUND_HALF_ODD);
                                  $interestPayment = $interestPayment / $paymentTermP;
                              }
                              
                          }elseif($paymentTermA == "Daily"){
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

                       $monthlyAmortization = $monthlyAmortization * $loanTermP;

                       if( $totalPrincipal != $loanAmountA ){
                          $monthlyAmortization = $monthlyAmortization - ($totalPrincipal - $loanAmountA);
                          $totalPrincipal = $totalPrincipal - ($totalPrincipal - $loanAmountA);
                       }

                       if($typeInterestA == "Diminishing"){
                           $effectiveir = ($totalInterest / $totalPrincipal) * 100;
                           $effectiveir = round($effectiveir);
                       }else{
                           $effectiveir = $loanInterestA;
                       }

                       /*echo "<tr>";
                          echo "<td>" . "" . " </button> </td>";
                          echo "<td>" . number_format($monthlyAmortization,'2','.',',') . "</td>";
                          echo "<td>" . number_format($totalPrincipal,'2','.',',') . "</td>";
                          echo "<td>" . number_format($totalInterest,'2','.',',') . "</td>";
                          echo "<td>" . "" . " </button> </td>";
                          echo "<td>" . "" . " </button> </td>";
                      echo "</tr>";*/
                  }
                ?>

                <div class="<?php echo $displayProperty ?>">

                    <label style="width: 200px">Present Address :</label>
                    <input type="text" style="width: 600px" placeholder="Address" value = "<?php echo $addressinfo;?>" name = "addressinfo"><br>

                    <label style="width: 200px">Mobile/Telephone # :</label>
                    <input type="text" style="width: 200px" placeholder="Telephone/Moblie #" value = "<?php echo $contactinfo;?>" name = "contactinfo"><br>

                    <label style="width: 200px">Effective Interest Rate (%) :</label>
                    <input style="width: 50px" type="text" value = "<?php echo $effectiveir;?>" name = "effectiveir" readonly><br>

                    <!--Signatories-->
                    <label style="width: 200px">Loan Officer:</label>
                    <input type="text" style="width: 600px" placeholder="Loan Officer" value = "<?php echo $loanOfficer;?>" name = "loanOfficer"><br>

                    <label style="width: 200px">Bookkeeper:</label>
                    <input type="text" style="width: 600px" placeholder="Bookkeeper" value = "<?php echo $bookKeeper;?>" name = "bookKeeper"><br>

                    <label style="width: 200px">Manager:</label>
                    <input style="width: 600px" type="text" placeholder="Manager" value = "<?php echo $managerP;?>" name = "managerP">

                </div>

                </div>
            </div>
        </div>

    </form>

    <!-- Right Top Bar -->
    <div class="col-sm-12">
        <nav class="navbar navbar-dark" style="background-color:#fff">
            <!-- <input class="form-control mr-sm-2" type="search" name="identifier" value="<?php echo $identifier;?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
            <br>
            <div class="<?php echo $displayProperty;?>">
                <button onclick="viewModal()" style="width:auto;" class="btn btn-outline-success my-2 my-sm-0">RELEASE</button>
            </div>
        </nav>
    </div>
</div>
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
        if(y[x].value == "plti"){
            document.getElementById("plf").value = document.getElementById("pap").value;
        }else if(y[x].value == "pnti"){
            document.getElementById("pnf").value = document.getElementById("pap").value;
        }else if(y[x].value == "rcrl"){
            document.getElementById("rcln").value = document.getElementById("pap").value;
        }

        var str = y[x].value;
        var LoanAID = str.substring(0, 2);
        if(LoanAID == "BL"){
            document.getElementById("bll").value = y[x].value; 
            //document.getElementById("bl").value = document.getElementById("pap").value;
            document.getElementById("bl").value = document.getElementById("lip").value;
            document.getElementById("bli").value = document.getElementById("lii").value;
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
            //document.getElementById("cml").value = document.getElementById("pap").value;
            document.getElementById("cml").value = document.getElementById("lip").value;
            document.getElementById("cmli").value = document.getElementById("lii").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "CKL"){
            document.getElementById("chkll").value = y[x].value; 
            document.getElementById("chkl").value = document.getElementById("pap").value;
        }
        var LoanAID = str.substring(0, 3);
        if(LoanAID == "EDL"){
            document.getElementById("edll").value = y[x].value; 
            //document.getElementById("edl").value = document.getElementById("pap").value;
            document.getElementById("edl").value = document.getElementById("lip").value;
            document.getElementById("edli").value = document.getElementById("lii").value;
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
            //document.getElementById("rl").value = document.getElementById("pap").value;
            document.getElementById("rl").value = document.getElementById("lip").value;
            document.getElementById("rli").value = document.getElementById("lii").value;
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

        //alert(LoanAID);
        //document.getElementById('printloandocs').style.display='block';
    }

    function viewModal(){
        document.getElementById('postView').style.display='block';

        var vv = document.getElementById("vvf").value = document.getElementById("vv").value;
        var cv = document.getElementById("cvf").value = document.getElementById("cv").value;

        var sf = document.getElementById("sfvf").value = document.getElementById("sfv").value;
        if(sf != 0.00){
            document.getElementById("sfvf").style.border = '2px solid red';
        }

        var ff = document.getElementById("ffvf").value = document.getElementById("ffv").value;
        if(ff != 0.00){
            document.getElementById("ffvf").style.border = '2px solid red';
        }

        var cr = document.getElementById("crvf").value = document.getElementById("crv").value;
        if(cr != 0.00){
            document.getElementById("crvf").style.border = '2px solid red';
        }

        var sr = document.getElementById("srvf").value = document.getElementById("srv").value;
        if(sr != 0.00){
            document.getElementById("srvf").style.border = '2px solid red';
        }

        var ir = document.getElementById("irvf").value = document.getElementById("irv").value;
        if(ir != 0.00){
            document.getElementById("irvf").style.border = '2px solid red';
        }

        var nf = document.getElementById("ifvf").value = document.getElementById("ifv").value;
        if(nf != 0.00){
            document.getElementById("ifvf").style.border = '2px solid red';
        }

        var nnf = document.getElementById("nfvf").value = document.getElementById("nfv").value;
        if(nnf != 0.00){
            document.getElementById("nfvf").style.border = '2px solid red';
        }

        //var lbpv = parseInt(document.getElementById("lbp").value);
        //var lbiv = parseInt(document.getElementById("lbi").value);
        //var lvf = lbpv + lbiv;
        //var lvvff = document.getElementById("lvvf").value = lvf;
        var lbpv = document.getElementById("lvvf").value = document.getElementById("lbp").value;
        if(lbpv != 0.00){
            document.getElementById("lvvf").style.border = '2px solid red';
        }

        var tcf = document.getElementById("tcff").value = document.getElementById("tacharges").value;
        if(tcf != 0.00){
            document.getElementById("tcff").style.border = '2px solid red';
        }

        var lav = document.getElementById("laf").value = document.getElementById("la").value;
        document.getElementById("laf").style.border = '2px solid red';

        var lrv = document.getElementById("lrf").value = document.getElementById("tarelease").value;
        document.getElementById("lrf").style.border = '2px solid red';
    }

    function postAN(){
        
    }

    function viewAmount(){

        var lbanv = document.getElementById("lban").value = "Reloan/Restructure"
        document.getElementById('postAmountM').style.display='block';

        //document.getElementById('reloan').style.display='block';

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
        }else if(str.substring(0, 2) == "PL" || str.substring(0, 2) == "BL" || str.substring(0, 3) == "CML" || str.substring(0, 3) == "EDL" || str.substring(0, 2) == "RL"){
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
<?php include "css1.html" ?>
</html>

