<!DOCTYPE html>
<html>

<?php  

$idNumber = "";
$firstName = "";
$middleName = "";
$lastName = "";
$accountNumber = "";

$loanApplicationNumberId = "";
$referencenumber = "";
$amountPayment = "";
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
$savingsDeposit = 0;
$cbuDeposit = 0;
$ricePayment = 0;
//$RiceLoanAP = "";

$loanApplicationNumber[] = "";
$loanServiceId[] = "";
$loanAmount[] = "";
$loanTerm[] = "";

$countErr = "";
$submitApplication = "";
$searchMember = "";
$identifier = "";
$displayProperty = "none";
$paidLoan = "";
$withdrawSavings = "";
$withdrawShareCapital = "";

$numRow = 0;
$infomessage = "";

include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["searchMember"])) {
        $searchMember = test_input($_POST["searchMember"]);
    }

    if (!empty($_POST["myButton"])) {
        $loanApplicationNumberId = test_input($_POST["myButton"]);
    }

    if (!empty($_POST["paidLoan"])) {
        $paidLoan = test_input($_POST["paidLoan"]);
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

    if (empty($_POST["amountPayment"]) && !is_numeric($_POST["amountPayment"])) {
        $countErr++;
    }else {
        $amountPayment = test_input($_POST["amountPayment"]);
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

    if (empty($_POST["cbuDeposit"]) && !is_numeric($_POST["cbuDeposit"])) {
        $countErr++;
    }else {
        $cbuDeposit = test_input($_POST["cbuDeposit"]);
    }

    if (empty($_POST["ricePayment"]) && !is_numeric($_POST["ricePayment"])) {
        $countErr++;
    }else {
        $ricePayment = test_input($_POST["ricePayment"]);
    }

    if (empty($_POST["quantity"]) && !is_numeric($_POST["quantity"])) {
        $countErr++;
    }else {
        $quantity = test_input($_POST["quantity"]);
    }

    if (!empty($_POST["withdrawSavings"]) ) {
        $withdrawSavings = test_input($_POST["withdrawSavings"]);
    }

    if (!empty($_POST["withdrawShareCapital"]) ) {
        $withdrawShareCapital = test_input($_POST["withdrawShareCapital"]);
    }

    if ($searchMember == "searchMember" or $loanApplicationNumberId != "") {
        # search member...
        $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber' or last_name= '$idNumber' ";
        $resultSearchName = $conn->query($sqlSearchName);

        if($resultSearchName->num_rows > 0){
            while($row = mysqli_fetch_array($resultSearchName)){
              $accountNumber = $row['account_number'];
              $firstName = $row['first_name'];
              $middleName = $row['middle_name'];
              $lastName = $row['last_name'];
            }
        }

        $sqlbi = "SELECT * FROM  bl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' ";
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

        $sqlbi = "SELECT * FROM  ckl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' ";
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

        $sqlbi = "SELECT * FROM  cml_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' ";
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

        $sqlbi = "SELECT * FROM  cl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' ";
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

        $sqlbi = "SELECT * FROM  cll_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' ";
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

        $sqlbi = "SELECT * FROM  edl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' ";
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

        $sqlbi = "SELECT * FROM  eml_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' ";
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

        $sqlbi = "SELECT * FROM  rl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' ";
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

        $sqlbi = "SELECT * FROM  sl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' ";
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

        $sqlbi = "SELECT * FROM  pl_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' ";
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

        $sqlbi = "SELECT * FROM  rice_loan_table WHERE id_number = '$idNumber' and loan_status = 'Released' ";
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

        if($counter > 0){
            $displayProperty = "inline";
        }else{
            $displayProperty = "none";
        }

        if($loanApplicationNumberId != ""){

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
                        $loanServiceIdP = $row['loan_service_id'];
                        $loanAmountP = $row['loan_amount'];
                        $loanTermP= $row['loan_term'];
                        $loanInterestP = $row['loan_interest'];
                        $paymentTermP = $row['payment_term'];
                        $quantity = $row['quantity'];

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
            $amountPayment = 0;
            $savingsDeposit = 0;
            $cbuDeposit = 0;
            $ricePayment = 0;
        }

        if($searchMember == "searchMember"){
            $typeInterestP = "";
            $loanAmountP = "";
            $loanInterestP = "";
            $referencenumber = "";
            $loanApplicationNumberP = "";
            $quantity = 0;
        }
    }

    if($paidLoan == "paidLoan"){
        if($countErr<=0){
            if($typeInterestP == "Diminishing"){
                $currentBalance  = 0;
                if(substr("$loanApplicationNumberP",0,2) == "BL"){
                    $sqlLP = "SELECT * FROM  bl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  bl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP1 = $conn->query($sqlLP1);

                }elseif(substr("$loanApplicationNumberP",0,3) == "CKL"){
                    $sqlLP = "SELECT * FROM  ckl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  ckl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP1 = $conn->query($sqlLP1);

                }elseif(substr("$loanApplicationNumberP",0,3) == "CLL"){
                    $sqlLP = "SELECT * FROM  cll_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  cll_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP1 = $conn->query($sqlLP1);

                }elseif(substr("$loanApplicationNumberP",0,2) == "CL"){
                    $sqlLP = "SELECT * FROM  cll_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  cl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP1 = $conn->query($sqlLP1);

                }elseif(substr("$loanApplicationNumberP",0,3) == "CML"){
                    $sqlLP = "SELECT * FROM  cml_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  cml_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP1 = $conn->query($sqlLP1);

                }elseif(substr("$loanApplicationNumberP",0,3) == "EDL"){
                    $sqlLP = "SELECT * FROM  edl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  edl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP1 = $conn->query($sqlLP1);

                }elseif(substr("$loanApplicationNumberP",0,3) == "EML"){
                    $sqlLP = "SELECT * FROM  eml_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  eml_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP1 = $conn->query($sqlLP1);

                }elseif(substr("$loanApplicationNumberP",0,2) == "RL"){
                    $sqlLP = "SELECT * FROM  rl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  rl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP1 = $conn->query($sqlLP1);

                }elseif(substr("$loanApplicationNumberP",0,2) == "SL"){
                    $sqlLP = "SELECT * FROM  sl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  sl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP1 = $conn->query($sqlLP1);

                }elseif(substr("$loanApplicationNumberP",0,2) == "PL"){
                    $sqlLP = "SELECT * FROM  pl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP = $conn->query($sqlLP);

                    $sqlLP1 = "SELECT * FROM  pl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' ";
                    $resultLP1 = $conn->query($sqlLP1);

                }

                
                if($resultLP->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLP)) {
                        # code...
                        $totalPrincipalPayment = $row['amount'];
                        $currentBalance = $currentBalance + $totalPrincipalPayment;

                    }
                }

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

                $loanInterestP = $loanInterestP/100;
                $currentPrincipal = 0;
                $currentInterest = 0;

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
                if( ($checkInterestP == 0 and $paymentTerm == 2) or ($checkInterestPI > 0 and $paymentTerm == 30) ){
                    $currentInterest = $lastInterest[$counterI-1];
                }else{
                    $currentInterest = ($currentBalance * $loanInterestP)/$paymentTerm;
                }

                //$evenNumber = ($counterh + 1)%2;
                //$monthNumber = ($counterh + 1)%30;
                //if( ($evenNumber == 1 and $paymentTerm == 2) or ($monthNumber > 0 and $paymentTerm == 30) ){
                    //$amountPI[$counterh + 1] = $amountPI[$counterh];
                //}else{
                    //$amountPI[$counterh + 1] = ($amountBalance[$counterh] * $loanInterestP)/$paymentTerm;
                    //$amountPI[$counterh + 1] = round($amountPI[$counterh + 1],2,PHP_ROUND_HALF_ODD);
                //}

                $currentInterest = round($currentInterest,2,PHP_ROUND_HALF_ODD);

                $currentPrincipal = $amountPayment - $currentInterest;
                $currentPrincipal = round($currentPrincipal,2,PHP_ROUND_HALF_ODD);

                $currentBalanceTemp = $currentBalance + $currentInterest;

                if($currentBalanceTemp == $amountPayment){
                    echo "Paid";
                }


                if(substr("$loanApplicationNumberP",0,2) == "BL"){
                    $sql = "INSERT INTO bl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$currentPrincipal','$datePayment', '1')";

                    $sql1 = "INSERT INTO bl_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                        VALUES ('$idNumber','$loanApplicationNumberP','$referencenumber','$currentInterest','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,3) == "CKL"){

                    $sql = "INSERT INTO ckl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$currentPrincipal','$datePayment', '1')";

                    $sql1 = "INSERT INTO ckl_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                        VALUES ('$idNumber','$loanApplicationNumberP','$referencenumber','$currentInterest','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,3) == "CLL"){

                    $sql = "INSERT INTO cll_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$currentPrincipal','$datePayment', '1')";

                    $sql1 = "INSERT INTO cll_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                        VALUES ('$idNumber','$loanApplicationNumberP','$referencenumber','$currentInterest','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,2) == "CL"){

                    $sql = "INSERT INTO cl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$currentPrincipal','$datePayment', '1')";

                    $sql1 = "INSERT INTO cl_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                        VALUES ('$idNumber','$loanApplicationNumberP','$referencenumber','$currentInterest','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,3) == "CML"){

                    $sql = "INSERT INTO cml_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$currentPrincipal','$datePayment', '1')";

                    $sql1 = "INSERT INTO cml_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                        VALUES ('$idNumber','$loanApplicationNumberP','$referencenumber','$currentInterest','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,3) == "EDL"){

                    $sql = "INSERT INTO edl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$currentPrincipal','$datePayment', '1')";

                    $sql1 = "INSERT INTO edl_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                        VALUES ('$idNumber','$loanApplicationNumberP','$referencenumber','$currentInterest','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,3) == "EML"){

                    $sql = "INSERT INTO eml_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$currentPrincipal','$datePayment', '1')";

                    $sql1 = "INSERT INTO eml_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                        VALUES ('$idNumber','$loanApplicationNumberP','$referencenumber','$currentInterest','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,2) == "RL"){

                    $sql = "INSERT INTO rl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$currentPrincipal','$datePayment', '1')";

                    $sql1 = "INSERT INTO rl_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                        VALUES ('$idNumber','$loanApplicationNumberP','$referencenumber','$currentInterest','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,2) == "SL"){

                    $sql = "INSERT INTO sl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$currentPrincipal','$datePayment', '1')";

                    $sql1 = "INSERT INTO sl_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                        VALUES ('$idNumber','$loanApplicationNumberP','$referencenumber','$currentInterest','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,2) == "PL"){

                    $sql = "INSERT INTO pl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$currentPrincipal','$datePayment', '1')";

                    $sql1 = "INSERT INTO pl_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                        VALUES ('$idNumber','$loanApplicationNumberP','$referencenumber','$currentInterest','$datePayment', '1')";
                }

                if ($conn->query($sql) === TRUE and $conn->query($sql1) === TRUE){
                    $informessage = "New record created successfully";
                    $loanApplicationNumberP = "";
                    $typeInterestP = "";
                    $loanInterestP = "";
                    $loanAmountP = "";
                    $amountPayment = "";

                    $currentPrincipal = "";
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    echo "Error: " . $sql1 . "<br>" . $conn->error;
                }
            }else{
                if(substr("$loanApplicationNumberP",0,2) == "BL"){
                    $sql = "INSERT INTO bl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$amountPayment','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,3) == "CKL"){
                     $sql = "INSERT INTO ckl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$amountPayment','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,3) == "CLL"){
                     $sql = "INSERT INTO cll_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$amountPayment','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,2) == "CL"){
                     $sql = "INSERT INTO cl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$amountPayment','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,3) == "CML"){
                     $sql = "INSERT INTO cml_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$amountPayment','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,3) == "EDL"){
                     $sql = "INSERT INTO edl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$amountPayment','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,3) == "EML"){
                     $sql = "INSERT INTO eml_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$amountPayment','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,2) == "RL"){
                     $sql = "INSERT INTO rl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$amountPayment','$datePayment', '1')";
                }elseif(substr("$loanApplicationNumberP",0,2) == "SL"){
                     $sql = "INSERT INTO sl_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$amountPayment','$datePayment', '1')";
                }

                if(substr("$loanApplicationNumberP",0,3) != "RCL" and $loanApplicationNumberP != ""){
                    if ($conn->query($sql)){
                    $informessage = "New record created successfully";
                    //$loanApplicationNumberP = "";
                    $typeInterestP = "";
                    $loanInterestP = "";
                    $loanAmountP = "";
                    $amountPayment = "";

                    $referencenumber = "";
                    $currentPrincipal = "";

                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "Error: " . $sql1 . "<br>" . $conn->error;
                    }
                }
                
                if(substr("$loanApplicationNumberP",0,3) == "RCL"){

                    //IF one and other is zero
                    if($loanInterestP != 0){
                        $sqlRL = "INSERT INTO rice_credit_revenue_table(id_number,loan_application_number, reference_number,interest_revenue, date_transaction,encoded_by) 
                        VALUES ('$idNumber','$loanApplicationNumberP','$referencenumber','$loanInterestP','$datePayment', '1')";

                        if ($conn->query($sqlRL) === TRUE){
                            $informessage = "New record created successfully";
                            //$loanApplicationNumberP = "";
                            //$typeInterestP = "";
                            $loanInterestP = "";
                            //$loanAmountP = "";
                            //$amountPayment = "";

                            //$referencenumber = "";
                            //$currentPrincipal = "";

                        }else{
                            echo "Error: " . $sqlRL . "<br>" . $conn->error;
                        }
                    }
                    if($amountPayment != 0){
                        $sqlRL1 = "INSERT INTO rice_loan_payment_table(id_number, reference_number,loan_application_number, amount,date_payment, encoded_by) 
                        VALUES ('$idNumber','$referencenumber','$loanApplicationNumberP','$amountPayment','$datePayment', '1')";

                            if ($conn->query($sqlRL1) === TRUE){
                            $informessage = "New record created successfully";
                            //$loanApplicationNumberP = "";
                            $typeInterestP = "";
                            $loanInterestP = "";
                            $loanAmountP = "";
                            $amountPayment = "";

                            $referencenumber = "";
                            $currentPrincipal = "";

                        }else{
                            echo "Error: " . $sqlRL1 . "<br>" . $conn->error;
                        }
                    }
                }
            }

            if($savingsDeposit != 0){

                if($withdrawSavings == ""){
                    $withdrawSavings = "Deposit";
                }

                $sql5 = "INSERT INTO savings_table(id_number, type_transaction, type_savings,reference_number,amount, date_transaction, encoded_by) 
                    VALUES ('$idNumber','$withdrawSavings','S1','$referencenumber','$savingsDeposit','$datePayment','1')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $savingsDeposit = "";
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }else{
                $savingsDeposit = "";
            }

            if($cbuDeposit != 0){

                if($withdrawShareCapital == ""){
                    $withdrawShareCapital = "CBU";
                }

                $sql4 = "INSERT INTO share_capital_table(id_number, type_transaction,reference_number,amount, date_transaction, encoded_by) 
                    VALUES ('$idNumber','$withdrawShareCapital','$referencenumber','$cbuDeposit','$datePayment','1')";

                if ($conn->query($sql4) === TRUE) {
                   $infomessage = "Record updated successfully";
                   
                   $cbuDeposit = "";
                   $idNumber = "";
                   $referencenumber = "";
                   $datePayment = ""; 

                   $accountNumber = "";
                   $firstName = "";
                   $middleName = "";
                   $lastName = "";
                } 
                else { 
                      echo "Error: " . $sql4 . "<br>" . $conn->error;
                }
            }else{
                $cbuDeposit = "";
            }

            if($loanApplicationNumberP == "" and  $ricePayment != 0){

                 $sql = "INSERT INTO rice_cash_revenue_table(id_number, or_number,quantity, principal_amount,interest_amount, date_transaction,encoded_by) 
                    VALUES ('$idNumber','$referencenumber','$quantity','$ricePayment', $loanInterestP,'$datePayment', '1')";

                if ($conn->query($sql) === TRUE) {
                   $infomessage = "Record updated successfully";
                   
                   $cbuDeposit = "";
                   $idNumber = "";
                   $referencenumber = "";
                   $datePayment = ""; 

                   $accountNumber = "";
                   $firstName = "";
                   $middleName = "";
                   $lastName = "";

                   $ricePayment = "";
                } 
                else { 
                      echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }else{
                $ricePayment = 0;
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

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    	<div>
    	    <!--member account info-->
            <div class="row" >
                <?php include 'navigation.php';?>
                <div class="col-sm-12" style="margin-top:70px;margin-left: 16.7%;margin-bottom: 200px;">  
                    <p align="center"><span><?php echo $infomessage;?></span><br></p>
                    <div class="row">
                        <div class="col-lg-2.5" style="background-color:#fff; padding: 5px; margin: 5px">
                            <h6>Account Information</h6>
                            <div class="form-group">
                                <label class="col-md-6 control-label">ID Number</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $idNumber;?>" name = "idNumber">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <button class="btn btn-outline-success my-2 my-sm-0" name = "searchMember" value = "searchMember" type="submit" style="align-self: center;">SEARCH</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Account Number</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $accountNumber;?>" readonly>
                                </div>  
                            </div>
                            

                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="First Name" value = "<?php echo $firstName;?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Middle Name" value = "<?php echo $middleName;?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Last Name" value = "<?php echo $lastName;?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2.5" style="background-color:#fff; padding: 5px; margin: 5px">
                            <h6>Payment Transaction</h6>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Date of Payment</label>
                                <div class="col-md-10">
                                    <input type="date" class="form-control" value = "<?php echo $datePayment;?>" name = "datePayment">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">OR number</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" value = "<?php echo $referencenumber;?>" name = "referencenumber">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Loan AP</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanApplicationNumberP;?>" name = "loanApplicationNumberP" readonly>
                                </div>  
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Rice Quantity</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" value = "<?php echo $quantity;?>" name = "quantity">
                                </div>  
                            </div>
                        </div>

                        <div class="col-lg-2.5" style="background-color:#fff; padding: 5px; margin: 5px">
                            <h6>Amount</h6>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Rice/Credit Loan</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $amountPayment;?>" name="amountPayment">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Savings</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $savingsDeposit;?>" name = "savingsDeposit">
                                    <label> W </label>
                                    <input type="checkbox" value = "Withdraw" name = "withdrawSavings">
                                </div>  
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-2">CBU</label>
                                
                                    <input class="col-md-2" type="text" value = "<?php echo $cbuDeposit;?>" name = "cbuDeposit">
                                    <label> W </label>
                                    <input type="checkbox" value = "Withdraw" name = "withdrawShareCapital">
                                 
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Rice Cash</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $ricePayment;?>" name = "ricePayment">
                                </div>  
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <button class="btn btn-outline-success my-2 my-sm-0" name = "paidLoan" value = "paidLoan" type="submit" style="align-self: center;">PAID</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2.5" style="background-color:#fff; padding: 5px; margin: 5px">
                            <h6>OtherIncome</h6>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Type of Payment</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="tpres" name="otherIncome" value="<?php echo $otherIncome;?>">
                                      <option value="" <?php if($otherIncome == "") echo "selected"; ?>>Select</option>
                                      <option value="ptpi" <?php if($otherIncome == "ptpi") echo "selected"; ?>>Photocopy</option>
                                      <option value="msli" <?php if($otherIncome == "msli") echo "selected"; ?>>Miscellaneous</option>
                                      <option value="mbsi" <?php if($otherIncome == "mbsi") echo "selected"; ?>>Membership</option>
                                      <option value="rnti" <?php if($otherIncome == "rnti") echo "selected"; ?>>Rental</option>
                                      <option value="bcpd" <?php if($otherIncome == "bcpd") echo "selected"; ?>>BCP Dividend</option>
                                      <option value="lbpi" <?php if($otherIncome == "lbpi") echo "selected"; ?>>LBP Interest</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Savings</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $otherAmountPayment;?>" name = "otherAmountPayment">
                                </div>  
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <button class="btn btn-outline-success my-2 my-sm-0" name = "paidLoan" value = "paidLoan" type="submit" style="align-self: center;">PAID</button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-group" >
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanAmountP;?>" name="loanAmountP" readonly>
                                </div>
                            </div>
                            <div class="form-group" >
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanInterestP;?>" name="loanInterestP">
                                </div>
                            </div>
                            <div class="form-group" >
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $typeInterestP;?>" name="typeInterestP" readonly>
                                </div>
                            </div>
                            <div class="form-group" >
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $paymentTermP;?>" name="paymentTermP" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="<?php echo $displayProperty;?>">
                            <div class="col-lg-11" style="background-color:#fff; padding: 10px; margin: 10px">
                                <div class="table table-dark">
                                <?php
                                    if($idNumber != "" or $loanApplicationNumberId != ""){
                                        echo "<table>
                                        <tr>
                                            <th>Loan Application Number</th>
                                            <th>Loan Service ID</th>
                                            <th>Loan Amount</th>
                                            <th>Loan Term</th>  
                                            <th></th>
                                        </tr>";
                                        
                                        $counterh = 0;
                                        while($counterh < $numRow) {
                                                echo "<tr>";
                                                    echo "<td> <button type =" . "submit" . " " ."value=". $loanApplicationNumber[$counterh] . " " . "name=" . "myButton". ">"  . $loanApplicationNumber[$counterh] . " </button> </td>";
                                                    echo "<td>" . $loanServiceId[$counterh] . "</td>";
                                                    echo "<td>" . $loanAmount[$counterh] . "</td>";
                                                    echo "<td>" . $loanTerm[$counterh] . "</td>";
                                                echo "</tr>";
                                            $counterh ++;
                                        }
                                        
                                        if($typeInterestP == "Flat"){
                                            $monthDate->add(new DateInterval('P'.($loanTermP*30).'D'));
                                            if(substr("$loanApplicationNumberP", 0,3) == "RCL"){
                                                echo "<table>
                                                <tr>
                                                    <th>Rice Loan Summary</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th>Principal Loan</th>
                                                    <th>Interest Loan Loan</th>
                                                    <th>Due Date</th>
                                                    <th>OR #</th>
                                                    <th>Date Payment</th>
                                                    <th>Principal Payment</th>
                                                    <th>Interest Payment</th>
                                                    <th>Total Balance</th>
                                                    <th></th>
                                                </tr>";

                                                if($counterPayment == 0){
                                                    $amountPaymentP[$counterPayment] = 0;
                                                    $amountPI[$counterPayment] = 0;
                                                    $counterPayment = 1;
                                                }

                                                $counterf = 0;
                                                $sumPrincipal = $loanAmountP + $loanInterestP;
                                                while($counterf < $counterPayment){
                                                    $sumPrincipal = $sumPrincipal - ($amountPaymentP[$counterf] + $amountPI[$counterf]);
                                                    echo "<tr>";
                                                        echo "<td>" . $loanAmountP . "</td>";
                                                        echo "<td>" . $loanInterestP . "</td>";
                                                        echo "<td>"; echo $monthDate->format('Y-m-d');  echo "</td>";
                                                        echo "<td>" . $orNumber[$counterf] . "</td>";
                                                        echo "<td>" . $datePaymentP[$counterf] . "</td>";
                                                        echo "<td>" . $amountPaymentP[$counterf] . "</td>";
                                                        echo "<td>" . $amountPI[$counterf] . "</td>";
                                                        echo "<td>" . $sumPrincipal . "</td>";
                                                        echo "<td></td>";
                                                    echo "</tr>";
                                                    $counterf ++;
                                                }
                                            }else{
                                                echo "<table>
                                                <tr>
                                                    <th>Loan Summary</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th>Loan Amount</th>
                                                    <th>Due Date</th>
                                                    <th>Date of Payment</th>
                                                    <th>Payment Amount</th>
                                                    <th>Balance</th>
                                                    <th></th>
                                                </tr>";

                                                if($counterPayment == 0){
                                                    $amountPaymentP[$counterPayment] = 0;
                                                    $counterPayment = 1;
                                                }

                                                $counterf = 0;
                                                $sumPrincipal = $loanAmountP;
                                                while($counterf < $counterPayment) {
                                                    $sumPrincipal = $sumPrincipal - $amountPaymentP[$counterf];
                                                    echo "<tr>";
                                                        echo "<td>" . $loanAmountP . "</td>";
                                                        echo "<td>"; echo $monthDate->format('Y-m-d');  echo "</td>";
                                                        echo "<td>" . $datePaymentP[$counterf] . "</td>";
                                                        echo "<td>" . $amountPaymentP[$counterf] . "</td>";
                                                        echo "<td>" . $sumPrincipal . "</td>";
                                                        echo "<td></td>";
                                                    echo "</tr>";
                                                    $counterf ++;
                                                }
                                            }
                                        }elseif($typeInterestP == "Diminishing"){
                                            $loanInterestP = $loanInterestP/100;

                                            $numberator = $loanAmountP*$loanInterestP;
                                            $denominator = 1-pow((1+$loanInterestP),-$loanTermP);
                                            $monthlyAmortization = $numberator / $denominator;

                                            $OSBalance = $loanAmountP;
                                            $totalPrincipal = 0;
                                            $totalInterest = 0;
                                            $actualInterest = 0;

                                            $actualPrincipal = 0;
                                            $actualInterest = 0;
                                            $actualBalanceTemp = 0;
                                            $actualBalance = $loanAmountP;

                                            $monthlyAmortization = round($monthlyAmortization,2,PHP_ROUND_HALF_DOWN);
                                            $interestPayment = $loanAmountP * $loanInterestP;

                                            //actual
                                            $actualInterest = $loanAmountP * $loanInterestP;

                                            if ($paymentTermP == "Daily") {
                                                echo "Daily";
                                                $loanTermP = $loanTermP * 30;
                                                $paymentTerm = 30;
                                                echo "$paymentTerm";
                                            }elseif ($paymentTermP == "Semi Monthly") {
                                                echo "Semi Monthly";
                                                $loanTermP = $loanTermP * 2;
                                                $paymentTerm = 2;
                                                echo "$paymentTerm";
                                            }
                                            elseif ($paymentTermP == "Monthly") {
                                                $loanTermP = $loanTermP * 1;  
                                                $paymentTerm = 1;
                                            }

                                            $monthlyAmortization = $monthlyAmortization / $paymentTerm;
                                            $monthlyAmortization = round($monthlyAmortization,2,PHP_ROUND_HALF_ODD);

                                            $interestPayment = $interestPayment / $paymentTerm;
                                            $interestPayment =  round($interestPayment,2,PHP_ROUND_HALF_ODD);

                                            //actual
                                            $actualInterest = $interestPayment / $paymentTerm;
                                            $actualInterest =  round($actualInterest,2,PHP_ROUND_HALF_ODD);

                                            echo "<table>
                                            <tr>
                                                <th>Loan Summary</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            <tr><th>Due Date</th>  
                                                <th>Date of Payment</th>
                                                <th>OR #</th>
                                                <th>Amortization</th>
                                                <th>Principal</th>
                                                <th>Actual</th>
                                                <th>OS Balance</th>
                                            </tr>";
                                            //<th>O/S Balance</th>
                                            //<th>Due Date</th>
                                            //<th>Monthly Amortization</th>
                                            //<th>Principal Payment</th>
                                            //<th>Interest Payment</th>
                                            
                                            $counterh = 0;
                                            $counterComparison = $counterPayment;
                                            $sumPrincipal = 0;

                                            while($counterh < $loanTermP) {
                                                $totalInterest = $totalInterest + $interestPayment;

                                                $principalPayment = round($monthlyAmortization - $interestPayment,2,PHP_ROUND_HALF_ODD);
                                                $OSBalance = $OSBalance - $principalPayment;
                                                $OSBalanceTemp = round($OSBalance,2,PHP_ROUND_HALF_ODD);
                                                $monthDate->add(new DateInterval('P'.(30).'D'));

                                                //Actual
                                                //$actualPrincipal = $amountPaymentP[$counterh] - $actualInterest;
                                                //$actualPrincipal = round($actualPrincipal,2,PHP_ROUND_HALF_ODD);
                                                //$actualBalance = $actualBalance - $actualPrincipal;
                                                //$actualBalanceTemp = round($actualBalance,2,PHP_ROUND_HALF_ODD);

                                                if($counterh >= $counterComparison){
                                                    //$actualPrincipal = 0;
                                                    //$actualInterest = 0;
                                                }else{
                                                    //Sum of Principal Payment
                                                    $sumPrincipal = $sumPrincipal + $amountPaymentP[$counterh];

                                                    //Total Payment
                                                    $amountPaymentPP[$counterh] = $amountPaymentP[$counterh] + $amountPI[$counterh];
                                                    //Balance
                                                    $amountBalance[$counterh] = $loanAmountP - $sumPrincipal;
                                                    $amountBalance[$counterh] = round($amountBalance[$counterh],2,PHP_ROUND_HALF_ODD);

                                                    
                                                    //Next Balance
                                                    $amountBalance[$counterh + 1] = $amountBalance[$counterh] + (($amountBalance[$counterh] * $loanInterestP)/$paymentTerm);
                                                    $amountBalance[$counterh + 1] = round($amountBalance[$counterh + 1],2,PHP_ROUND_HALF_ODD);

                                                    //Next Principal
                                                    if( ($counterh + 1) == $counterComparison){
                                                        $evenNumber = ($counterh + 1)%2;
                                                        $monthNumber = ($counterh + 1)%30;
                                                        if( ($evenNumber == 1 and $paymentTerm == 2) or ($monthNumber > 0 and $paymentTerm == 30) ){
                                                            echo "$paymentTerm";
                                                            $amountPI[$counterh + 1] = $amountPI[$counterh];
                                                        }else{
                                                            $amountPI[$counterh + 1] = ($amountBalance[$counterh] * $loanInterestP)/$paymentTerm;
                                                            $amountPI[$counterh + 1] = round($amountPI[$counterh + 1],2,PHP_ROUND_HALF_ODD);
                                                        }
                                                    }


                                                    if($amountBalance[$counterh + 1] <= 0){
                                                        echo "paid";
                                                    }

                                                }

                                                while($counterPayment < $loanTermP){
                                                    $datePaymentP[$counterPayment] = "";
                                                    $orNumber[$counterPayment] = "";
                                                    $amountPaymentPP[$counterPayment] = 0;
                                                    $amountPaymentP[$counterPayment] = 0;
                                                    $amountPI[$counterPayment+1] = 0;
                                                    
                                                    $amountBalance[$counterPayment+1] = 0;
                                                    $counterPayment++;
                                                }

                                                echo "<tr>"; 
                                                    echo "<td>"; echo $monthDate->format('Y-m-d');  echo "</td>";
                                                    //echo "<td>" . $monthlyAmortization . "</td>";
                                                    //echo "<td>" . $principalPayment . "</td>";
                                                    //echo "<td>" . $interestPayment . "</td>";
                                                    //echo "<td>" . $OSBalanceTemp . "</td>";
                                                    echo "<td>" . $datePaymentP[$counterh] . "</td>";
                                                    echo "<td>" . $orNumber[$counterh] . "</td>";
                                                    echo "<td>" . $amountPaymentPP[$counterh] . "</td>";
                                                    echo "<td>" . $amountPaymentP[$counterh] . "</td>";
                                                    echo "<td>" . $amountPI[$counterh] . "</td>";
                                                    echo "<td>" . $amountBalance[$counterh] . "</td>";
                                                echo "</tr>";

                                                $counterh ++;
                                                $interestPayment = round($OSBalanceTemp * $loanInterestP,2,PHP_ROUND_HALF_ODD);
                                                $interestPayment = $interestPayment / $paymentTerm;
                                                $interestPayment = round($interestPayment,2,PHP_ROUND_HALF_ODD);
                                                $OSBalance = round($OSBalanceTemp,2,PHP_ROUND_HALF_ODD);

                                                $totalPrincipal = $totalPrincipal + $principalPayment;

                                                //actual
                                                //$actualInterest = round($actualBalanceTemp * $loanInterestP,2,PHP_ROUND_HALF_ODD);
                                                //$actualInterest = $actualInterest / $paymentTerm;
                                                //$actualInterest = round($actualInterest,2,PHP_ROUND_HALF_ODD);
                                                //$actualBalance = round($actualBalanceTemp,2,PHP_ROUND_HALF_ODD);

                                            }

                                            if($totalInterest != 0 or $totalPrincipal !=0){
                                                $actualInterest = round(($totalInterest/$totalPrincipal) * 100);
                                            }

                                             $monthlyAmortization = $monthlyAmortization * $loanTermP;
                                             echo "<tr>";
                                                echo "<td>" . "" . " </button> </td>";
                                                echo "<td>" . $monthlyAmortization . "</td>";
                                                echo "<td>" . $totalPrincipal . "</td>";
                                                echo "<td>" . $totalInterest . "</td>";
                                                echo "<td>" . "" . " </button> </td>";
                                                echo "<td>" . "" . " </button> </td>";
                                            echo "</tr>";
                                        }
                                    }
                                ?>
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