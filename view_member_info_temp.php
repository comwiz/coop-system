<html lang="en">

<?php  

require_once 'session.php';

$idNumber = "";
$accountNumber = "";

$firstName = "";
$middleName = "";
$lastName = "";

$firstNameT = "";
$middleNameT = "";
$lastNameT = "";

$infomessage = "";

$identifier = "";
$countErr = "";

$searchMember = "";
$submitApplication = "";
$searchIDMember = "";

$totalSC = 0;
$totalSD = 0;
$totalSW = 0;
$totalSCW = 0;
$totalAS = 0;

$totalSCC = 0;
$totalSDC = 0;
$totalSWC = 0;
$totalASC = 0;


$loanApplicationNumberId = "";
$referencenumber = "";
$amountPayment = 0;
$datePayment = "";

$amountPaymentPD = 0;
$datePaymentPD = "";
$amountPaymentP[] = "";
$amountPI[] = 0;
$amountPaymentPP[] = 0;
$amountBalance[] = 0;
$datePaymentP[] = "";
$orNumber[] = "";
$invoiceNumber[] = "";

$loanApplicationNumberP = "";
$loanServiceIdP = 0;
$loanAmountP = 0;
$interestAmountP = 0;
$loanInterestP = 0;
$loanTermP = 0;
$typeInterestP = "";
$monthDate = "";
$monthDateA = "";
$paymentTermP = 0;
$loanStatusP = 0;
$loanServiceName = "";

$savingsDeposit = 0;
$cbuDeposit = 0;
$ricePayment = 0;
$RiceLoanAP = 0;

$loanApplicationNumber[] = "";
$loanServiceId[] = "";
$loanAmount[] = 0;
$interestAmount[] = 0;
$loanTerm[] = "";
$loanStatus[] = "";
$riceInvoice[] = "";
$loanName[] = "";
//$invoiceNumberP[] = "";

//Previous Payment
$loanApplicationNumberPL = "";
$datePaymentPL = "";
$orNumberPL = "";
$principalPaymentPL = 0;
$interestPaymentPL = 0;
$placePayment = "";

//Savings Ledger
$transactionNumberS[] = "";
$typeTransactionS[] = "";
$referemceNumberS[] = "";
$amountS[] = 0;
$dateTransactionS[] = "";

//ShareCapital
$transactionNumberSC[] = "";
$typeTransactionSC[] = "";
$referemceNumberSC[] = "";
$actualSCBalance[] = 0;
$amountSC[] = 0;
$dateTransactionSC[] = "";

$countErr = "";
$countErrPL = "";
$submitApplication = "";
$searchMember = "";
$identifier = "";
$showsl = "";
$showscl = "";
$showls = "";
$showpls = "";
$showrll = "";
$showprll = "";
$showrllt = "";
$counterPaymentPL = "";

$typeLoan = "";

$paidLoan = "";

$ledgerIdentifier = "";
$numRow = 0;
$numRowS = 0;
$numRowSC = 0;
$infomessage = "";
$idNumberSearch = "";
$updateLI = "";
$exitB = "";
$printLedger = "";
$proceedPayment = "";
$searchOR = "";
$reloan = "";

$countErr = 0;

$displayPropertySavings = "none";
$displayPropertyLoan = "none";
$displayPropertySC = "none";
$displayPropertyRiceLoan = "none";

//RCL update
$invoiceNumber = "";
$quantityU = 0;
$rclPU = 0;
$rclIU = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //if (empty($_POST["counterPaymentPL"])) {
    //$countErrPL++;
  //}else {
    //$counterPaymentPL = test_input($_POST["counterPaymentPL"]);
  //}

  /*if(!empty($_POST["idNumber"])){
    $counterPaymentPL = test_input($_POST["counterPaymentPL"]);
  }

  if(!empty($_POST["idNumber"])){
    $invoiceNumber = test_input($_POST["invoiceNumber"]);
  }

  if(!empty($_POST["idNumber"])){
    $quantityU = test_input($_POST["quantityU"]);
  }

  if(!empty($_POST["idNumber"])){
    $interestAmountP = test_input($_POST["interestAmountP"]);
  }

  if(!empty($_POST["idNumber"])){
    $loanTermP = test_input($_POST["loanTermP"]);
  }

  if(!empty($_POST["idNumber"])){
    $monthDateA = test_input($_POST["monthDateA"]);
  }

  if(!empty($_POST["typeLoan"])){
    $typeLoan = test_input($_POST["typeLoan"]);
  }*/

  if(!empty($_POST["idNumber"])){
	 $idNumber = test_input($_POST["idNumber"]);
  }

  if(!empty($_POST["searchIDMember"])){
    $searchIDMember = test_input($_POST["searchIDMember"]);
  }

  if (!empty($_POST["myButton"])) {
      $loanApplicationNumberId = test_input($_POST["myButton"]);
      $ledgerIdentifier = "LL";
  }

  if(!empty($_POST["exitB"])){
    $exitB = test_input($_POST["exitB"]);
  }

  if(!empty($_POST["updateLI"])){
    $updateLI = test_input($_POST["updateLI"]);
  }

  if(!empty($_POST["placePayment"])){
    $placePayment = test_input($_POST["placePayment"]);
  }

  if(!empty($_POST["printLedger"])){
    $printLedger = test_input($_POST["printLedger"]);
  }

  if(!empty($_POST["proceedPayment"])){
    $proceedPayment = test_input($_POST["proceedPayment"]);
  }

  if(!empty($_POST["searchOR"])){
    $searchOR = test_input($_POST["searchOR"]);
  }

  if(!empty($_POST["reloan"])){
    $reloan = test_input($_POST["reloan"]);
  }

  if(!empty($_POST["totalAS"])){
    $totalAS = test_input($_POST["totalAS"]);
  }

  if(!empty($_POST["totalSC"])){
    $totalSC = test_input($_POST["totalSC"]);
  }

  if(!empty($_POST["accountNumber"])){
    $accountNumber = test_input($_POST["accountNumber"]);
  }

  if(!empty($_POST["firstName"])){
    $firstName = test_input($_POST["firstName"]);
  }

  if(!empty($_POST["middleName"])){
    $middleName = test_input($_POST["middleName"]);
  }

  if(!empty($_POST["lastName"])){
    $lastName = test_input($_POST["lastName"]);
  }

  if(!empty($_POST["idNumberSearch"])){
    $idNumberSearch = test_input($_POST["idNumberSearch"]);
  }

  if($exitB == "exitB"){
    session_destroy();
    header("Location: http://localhost/projectkikz/samplemwmmpc/application/views/home/login.php");
    //require_once 'logout.php';
  }

  if($proceedPayment != ""){
    //session_destroy();
    $_SESSION["idSession"] = $idNumber;
    header("Location: http://localhost/projectkikz/samplemwmmpc/application/views/home/loanPayment.php");
    //header("Location: http://system.local/application/views/home/loanPayment.php");
  }

  if(!empty($_POST["showls"])){
    $showls = test_input($_POST["showls"]);
  }

  if(!empty($_POST["showscl"])){
    $showscl = test_input($_POST["showscl"]);
    $ledgerIdentifier = "SCL";
  }

  if(!empty($_POST["showsl"])){
    $showsl = test_input($_POST["showsl"]);
    $ledgerIdentifier = "SL";
  }

  if(!empty($_POST["showpls"])){
    $showpls = test_input($_POST["showpls"]);
    $ledgerIdentifier = "PLS";
  }

  if(!empty($_POST["showrll"])){
    $showrll = test_input($_POST["showrll"]);
    $ledgerIdentifier = "RLL";
  }

  if(!empty($_POST["showrllt"])){
    $showrllt = test_input($_POST["showrllt"]);
    $ledgerIdentifier = "RLLT";
  }

  if(!empty($_POST["showprll"])){
    $showprll = test_input($_POST["showprll"]);
    $ledgerIdentifier = "PRRL";
  }


  if (empty($_POST["loanApplicationNumberP"])) {
    $countErr++;
  }else {
    $loanApplicationNumberP = test_input($_POST["loanApplicationNumberP"]);
  }

  /*if (empty($_POST["loanAmountP"]) && !is_numeric($_POST["loanAmountP"])) {
    $countErr++;
  }else {
    $loanAmountP = test_input($_POST["loanAmountP"]);
  }*/

  if (empty($_POST["paymentTermP"])) {
    $countErr++;
  }else {
    $paymentTermP = test_input($_POST["paymentTermP"]);
  }

  if (empty($_POST["loanStatusP"])) {
    $countErr++;
  }else {
    $loanStatusP = test_input($_POST["loanStatusP"]);
  }

  if (empty($_POST["datePaymentPL"])) {
    $countErrPL++;
  }else {
    $datePaymentPL = test_input($_POST["datePaymentPL"]);
  }

  if (empty($_POST["loanApplicationNumberPL"])) {
    $countErrPL++;
  }else {
    $loanApplicationNumberPL = test_input($_POST["loanApplicationNumberPL"]);
  }

  if (empty($_POST["orNumberPL"])) {
    $countErrPL++;
  }else {
    $orNumberPL = test_input($_POST["orNumberPL"]);
  }

  /*if (empty($_POST["principalPaymentPL"]) && !is_numeric($_POST["principalPaymentPL"])) {
    $countErrPL++;
  }else {
    $principalPaymentPL = test_input($_POST["principalPaymentPL"]);
  }*/

  /*if (empty($_POST["interestPaymentPL"]) && !is_numeric($_POST["interestPaymentPL"])) {
    $countErrPL++;
  }else {
    $interestPaymentPL = test_input($_POST["interestPaymentPL"]);
  }*/

  if($showsl == "showsl"){
    $displayPropertySavings = "inline";
  }else{
    $displayPropertySavings = "none";
  }

  if($showscl == "showscl"){
    $displayPropertySC = "inline";
  }else{
    $displayPropertySC = "none";
  }

  if($showrllt == "showrllt"){
    $displayPropertyRiceLoan = "inline";
  }else{
    $displayPropertyRiceLoan = "none";
  }

  if($showls == "showls" or $showpls == "showpls" or $showrll == "showrll" or $showprll == "showprll"){
    $displayPropertyLoan = "inline";
  }else{
    $displayPropertyLoan = "none";
  }

  if($searchIDMember == "searchIDMember" or $loanApplicationNumberId != "" or $idNumber!="" or $showls == "showls" or $showsl == "showsl" or $showscl == "showscl"){
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

    if($searchIDMember == "searchIDMember"){
        $loanApplicationNumberP = "";
        $datePaymentPL = "";
        $orNumberPL = "";
        $principalPaymentPL = 0;
        $interestPaymentPL = 0;
        $loanAmountP = 0;
        $paymentTermP = "";
        $loanStatusP = "";
    }

    
    //SC Ledger
    if($showscl == "showscl"){

      $totalSC = 0;
      $totalASC = 0;

      //Share Capital Total
      $sqlSC = "SELECT amount FROM share_capital_table WHERE id_number = '$idNumber' and (type_transaction = 'BSC' or type_transaction = 'Retention' or type_transaction = 'CBU' or type_transaction = 'SCF' or type_transaction = 'Recruit')";
      $resultSC = $conn->query($sqlSC);
      
      if($resultSC->num_rows > 0){
          while ($row = mysqli_fetch_array($resultSC)) {
              $totalSC = $totalSC + $row['amount'];
          }
      }else{
              $totalSC = 0;
      }

      $sqlSCW = "SELECT amount FROM share_capital_table WHERE id_number = '$idNumber' and type_transaction = 'Withdraw' ";
      $resultSCW = $conn->query($sqlSCW);
      
      if($resultSCW->num_rows > 0){
          while ($row = mysqli_fetch_array($resultSCW)) {
              $totalSCW = $totalSCW + $row['amount'];
          }
      }else{
              $totalSCW = 0;
      }

      $totalASC = $totalSC - $totalSCW;
      
      $sqlSDL = "SELECT * FROM share_capital_table WHERE id_number = '$idNumber' order by date_transaction asc";
      $resultSDL = $conn->query($sqlSDL);
      $numRowSC = mysqli_num_rows($resultSDL);
      $counterSC = 0;
      $checkVReferenceSC = "";
      $checkOReferenceSC = "";
      $actualSCBalanceTemp = 0;
      
      if($resultSDL->num_rows > 0){
          while ($row = mysqli_fetch_array($resultSDL)) {
              $transactionNumberSC[$counterSC] = $row['transaction_number'];
              $typeTransactionSC[$counterSC] = $row['type_transaction'];
              $transactionNumberSC[$counterSC] = $row['transaction_number'];
              $checkVReferenceSC = $row['voucher_number'];
              $checkOReferenceSC = $row['reference_number'];
              if($checkVReferenceSC != ""){
                  $referemceNumberSC[$counterSC] = $checkVReferenceSC;
              }
              if($checkOReferenceSC != ""){
                  $referemceNumberSC[$counterSC] = $checkOReferenceSC;
              }

              if($checkOReferenceSC == "" and $checkVReferenceSC == ""){
                  $referemceNumberSC[$counterSC] = "NONE";
              }

              $amountSC[$counterSC] = $row['amount'];

              if($typeTransactionSC[$counterSC] != "Withdraw"){
                $actualSCBalanceTemp = $actualSCBalanceTemp + $amountSC[$counterSC];
                $actualSCBalance[$counterSC] = $actualSCBalanceTemp;
              }else{
                 $actualSCBalanceTemp = $actualSCBalanceTemp - $amountSC[$counterSC];
                $actualSCBalance[$counterSC] = $actualSCBalanceTemp;
              }

              $dateTransactionSC[$counterSC] = $row['date_transaction'];

              $counterSC++;
          }
      }
    }

    //Savings Ledger
    if($showsl == "showsl"){
      //Total Balance
      //Savings Total
      $totalAS = 0;
      $sqlSD = "SELECT amount FROM savings_table WHERE id_number = '$idNumber' and (type_transaction = 'Deposit' or type_transaction = 'Retention' or type_transaction = 'Interest')";
      $resultSD = $conn->query($sqlSD);
      
      if($resultSD->num_rows > 0){
        while ($row = mysqli_fetch_array($resultSD)) {
          $totalSD = $totalSD + $row['amount'];
        }
      }else{
        $totalSD = 0;
      }

      $sqlSW = "SELECT amount FROM savings_table WHERE id_number = '$idNumber' and type_transaction = 'Withdraw' ";
      $resultSW = $conn->query($sqlSW);
      
      if($resultSW->num_rows > 0){
        while ($row = mysqli_fetch_array($resultSW)) {
          $totalSW = $totalSW + $row['amount'];
        }
      }else{
        $totalSW = 0;
      }

      $totalAS = $totalSD - $totalSW;

      //Actual
      $sqlSDL = "SELECT * FROM savings_table WHERE id_number = '$idNumber' order by date_transaction asc";
      $resultSDL = $conn->query($sqlSDL);
      $numRowS = mysqli_num_rows($resultSDL);
      $counterS = 0;
      $checkVReference = "";
      $checkOReference = "";
      
      if($resultSDL->num_rows > 0){
          while ($row = mysqli_fetch_array($resultSDL)) {
              $transactionNumberS[$counterS] = $row['transaction_number'];
              $typeTransactionS[$counterS] = $row['type_transaction'];
              $transactionNumberS[$counterS] = $row['transaction_number'];
              $checkVReference = $row['voucher_number'];
              $checkOReference = $row['reference_number'];
              if($checkVReference != ""){
                  $referemceNumberS[$counterS] = $checkVReference;
              }
              if($checkOReference != ""){
                  $referemceNumberS[$counterS] = $checkOReference;
              }
              $amountS[$counterS] = $row['amount'];
              $dateTransactionS[$counterS] = $row['date_transaction'];

              $counterS++;

          }
      }
    }

    # search member...

    //Show Loans
    if($showls == "showls"){
      $sqlbi = "SELECT * FROM  bl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Released') ";
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
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;

              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  ckl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Released') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  cml_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Released') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  cl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Released') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  cll_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Released') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
            
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  edl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Released') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  eml_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Released') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  rl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Released') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_type'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  sl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Released') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  pl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Released') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  if($loanServiceId[$counter] == "LS1" or $loanServiceId[$counter] == "LS2"){
                    $loanName[$counter] = $row['loan_service_type'];
                  }else{
                    $loanName[$counter] = $row['loan_service_name'];
                  }
                  
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }
    }

    if($showpls == "showpls"){
      $sqlbi = "SELECT * FROM  bl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Paid') ";
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
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;

              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  ckl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Paid') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  cml_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Paid') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  cl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Paid') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  cll_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Paid') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
            
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  edl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Paid') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  eml_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Paid') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  rl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Paid') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_type'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  sl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Paid') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  $loanName[$counter] = $row['loan_service_name'];
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $sqlbi = "SELECT * FROM  pl_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Paid') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = $numRow + mysqli_num_rows($resultbi);

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $loanTerm[$counter] = $row['loan_term'];
              $loanStatus[$counter] = $row['loan_status'];
              $interestAmount[$counter] = 0;
              
              $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceId[$counter]' ";
              $resultLS = $conn->query($sqlLS);

              if($resultLS->num_rows > 0){
                while ($row = mysqli_fetch_array($resultLS)) {
                  if($loanServiceId[$counter] == "LS1" or $loanServiceId[$counter] == "LS2"){
                    $loanName[$counter] = $row['loan_service_type'];
                  }else{
                    $loanName[$counter] = $row['loan_service_name'];
                  }
                  
                }
              }

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }
    }

    if($showrllt == "showrllt"){
      //Rice Loan
      $sqlbi = "SELECT * FROM  rice_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Released' or loan_status = 'Paid') order by invoice_number";
      $resultbi = $conn->query($sqlbi);
      $numRow = mysqli_num_rows($resultbi);
      $counter = 0;
      $paymentScanner = 0;

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $interestAmount[$counter] = $row['loan_interest'];
              $loanTerm[$counter] = $row['loan_term'];
              $riceInvoice[$counter] = $row['invoice_number'];
              $loanStatus[$counter] = $row['loan_status'];
              $rlinvoice[$counter] = $row['invoice_number'];

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      $monthDateRL[$counter] = new DateTime($dateApplication[$counter]);
                  }
              }

              //Get Payment
              $sqlLP = "SELECT * FROM  rice_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLP = $conn->query($sqlLP);
              //$numRow = mysqli_num_rows($resultName);
              $counterPayment = 0;

              if($resultLP->num_rows > 0){
                  $paymentScanner = 1;
                  while ($row = mysqli_fetch_array($resultLP)) {
                      # code...
                      if($counterPayment != 0){
                        $loanApplicationNumber[$counter] = "";
                        $rlinvoice[$counter] = "";
                        $loanAmount[$counter] = 0;
                        $interestAmount[$counter] = 0;
                        $monthDateRL[$counter] = "";
                      }

                      $amountPaymentP[$counter] = $row['amount'];
                      $datePaymentP[$counter] = $row['date_payment'];
                      $orNumber[$counter] = $row['reference_number'];

                      $counter++;
                      $counterPayment++;
                  }
              }else{
                $paymentScanner = 0;
                $amountPaymentP[$counter] = 0;
                $datePaymentP[$counter] = "";
                $orNumber[$counter] = "";
              }

              $counter = $counter - $counterPayment;
              if($counterPayment > 1){
                $numRow = $numRow + $counterPayment;
              }
              
              $sqlLIP = "SELECT * FROM  rice_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber[$counter]'";
              $resultLIP = $conn->query($sqlLIP);
              //$numRow = mysqli_num_rows($resultName);
              $counterInterest = 0;

              if($resultLIP->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLIP)) {
                      $amountPI[$counter] = $row['interest_revenue'];
                      $counter++;
                      
                  }
              }else{
                $amountPI[$counter] = 0;
              }

              if($paymentScanner != 1){
                $counter++;
              }else{
                //$counter--;
              }

              //echo "$counter";
          }
      }

      $numRow = $counter;
    }

    if($showrll == "showrll"){
      //Rice Loan
      $sqlbi = "SELECT * FROM  rice_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Released') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = mysqli_num_rows($resultbi);
      $counter = 0;

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $interestAmount[$counter] = $row['loan_interest'];
              $loanTerm[$counter] = $row['loan_term'];
              $riceInvoice[$counter] = $row['invoice_number'];
              $loanStatus[$counter] = $row['loan_status'];

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $counter++;
    }

    if($showprll == "showprll"){
      //Rice Loan
      $sqlbi = "SELECT * FROM  rice_loan_table WHERE id_number = '$idNumber' and (loan_status = 'Paid') ";
      $resultbi = $conn->query($sqlbi);
      $numRow = mysqli_num_rows($resultbi);
      $counter = 0;

      if($resultbi->num_rows > 0){
          while ($row = mysqli_fetch_array($resultbi)) {
              # code...
              $loanApplicationNumber[$counter] = $row['loan_application_number'];
              $loanServiceId[$counter] = $row['loan_service_id'];
              $loanAmount[$counter] = $row['loan_amount'];
              $interestAmount[$counter] = $row['loan_interest'];
              $loanTerm[$counter] = $row['loan_term'];
              $riceInvoice[$counter] = $row['invoice_number'];
              $loanStatus[$counter] = $row['loan_status'];

              $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
              $resultLD = $conn->query($sqlLD);
              //$numRow = mysqli_num_rows($resultName);

              if($resultLD->num_rows > 0){
                  while ($row = mysqli_fetch_array($resultLD)) {
                      # code...
                      $dateApplication[$counter] = $row['date_application'];
                      //$dateApplication[$counter] = new DateTime($monthDate);
                  }
              }

              $counter++;
          }
      }

      $counter++;
    }
    
    //Show Loan Ledger
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
                  $loanStatusP = $row['loan_status'];

                  $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                  $resultLS = $conn->query($sqlLS);
                  //$numRow = mysqli_num_rows($resultName);

                  if($resultLS->num_rows > 0){
                      while ($row = mysqli_fetch_array($resultLS)) {
                          # code...
                          $typeInterestP = $row['type_interest'];
                      }
                  }

                  $sqlLP = "SELECT * FROM  bl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc, CAST(payment_count AS unsigned) asc";
                  $resultLP = $conn->query($sqlLP);
                  //$numRow = mysqli_num_rows($resultName);
                  $counterPayment = 0;

                  if($resultLP->num_rows > 0){
                      while ($row = mysqli_fetch_array($resultLP)) {
                          # code...
                          $orNumber[$counterPayment] = $row['reference_number'];
                          $amountPaymentP[$counterPayment] = $row['amount'];
                          $datePaymentP[$counterPayment] = $row['date_payment'];
                          $paymentCount[$counterPayment] = $row['payment_count'];
                          $counterPayment++;
                          
                      }
                  }

                  $sqlLIP = "SELECT * FROM  bl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc,  CAST(payment_count AS unsigned) asc";
                  $resultLIP = $conn->query($sqlLIP);
                  //$numRow = mysqli_num_rows($resultName);
                  $counterInterest = -1;

                  if($resultLIP->num_rows > 0){
                      while ($row = mysqli_fetch_array($resultLIP)) {
                          $orNumber[$counterInterest] = $row['reference_number'];
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
                          $monthDateA = $row['date_application'];
                          $monthDate = new DateTime($monthDateA);
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
                    $loanStatusP = $row['loan_status'];

                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterestP = $row['type_interest'];
                        }
                    }

                    $sqlLP = "SELECT * FROM  ckl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;

                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $orNumber[$counterPayment] = $row['reference_number'];
                            $amountPaymentP[$counterPayment] = $row['amount'];
                            $datePaymentP[$counterPayment] = $row['date_payment'];
                            $counterPayment++;
                            
                        }
                    }

                    $sqlLIP = "SELECT * FROM  ckl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc";
                    $resultLIP = $conn->query($sqlLIP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterInterest = -1;

                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            //$orNumber[$counterInterest] = $row['reference_number'];
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
                            $monthDateA = $row['date_application'];
                            $monthDate = new DateTime($monthDateA);
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
                    $loanStatusP = $row['loan_status'];

                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterestP = $row['type_interest'];
                        }
                    }

                    $sqlLP = "SELECT * FROM  cml_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc, CAST(payment_count AS unsigned) asc";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;

                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $orNumber[$counterPayment] = $row['reference_number'];
                            $amountPaymentP[$counterPayment] = $row['amount'];
                            $datePaymentP[$counterPayment] = $row['date_payment'];
                            $paymentCount[$counterPayment] = $row['payment_count'];
                            $counterPayment++;
                            
                        }
                    }

                    $sqlLIP = "SELECT * FROM  cml_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc, CAST(payment_count AS unsigned) asc";
                    $resultLIP = $conn->query($sqlLIP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterInterest = -1;

                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $orNumber[$counterInterest] = $row['reference_number'];
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
                            $monthDateA = $row['date_application'];
                            $monthDate = new DateTime($monthDateA);
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
                    $loanStatusP = $row['loan_status'];

                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterestP = $row['type_interest'];
                        }
                    }

                    $sqlLP = "SELECT * FROM  cll_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc, CAST(payment_count AS unsigned) asc";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;

                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $orNumber[$counterPayment] = $row['reference_number'];
                            $amountPaymentP[$counterPayment] = $row['amount'];
                            $datePaymentP[$counterPayment] = $row['date_payment'];
                            $paymentCount[$counterPayment] = $row['payment_count'];
                            $counterPayment++;
                            
                        }
                    }

                    $sqlLIP = "SELECT * FROM  cll_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc, CAST(payment_count AS unsigned) asc";
                    $resultLIP = $conn->query($sqlLIP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterInterest = -1;

                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $orNumber[$counterInterest] = $row['reference_number'];
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
                            $monthDateA = $row['date_application'];
                            $monthDate = new DateTime($monthDateA);
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
                    $loanStatusP = $row['loan_status'];

                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterestP = $row['type_interest'];
                        }
                    }

                    $sqlLP = "SELECT * FROM  cl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;

                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $orNumber[$counterPayment] = $row['reference_number'];
                            $amountPaymentP[$counterPayment] = $row['amount'];
                            $datePaymentP[$counterPayment] = $row['date_payment'];
                            $counterPayment++;
                            
                        }
                    }

                    $sqlLIP = "SELECT * FROM  cl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc" ;
                    $resultLIP = $conn->query($sqlLIP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterInterest = -1;

                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            //$orNumber[$counterInterest] = $row['reference_number'];
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
                            $monthDateA = $row['date_application'];
                            $monthDate = new DateTime($monthDateA);
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
                    $loanStatusP = $row['loan_status'];

                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterestP = $row['type_interest'];
                        }
                    }

                    $sqlLP = "SELECT * FROM  edl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc, CAST(payment_count AS unsigned) asc";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;

                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $orNumber[$counterPayment] = $row['reference_number'];
                            $amountPaymentP[$counterPayment] = $row['amount'];
                            $datePaymentP[$counterPayment] = $row['date_payment'];
                            $paymentCount[$counterPayment] = $row['payment_count'];
                            $counterPayment++;
                            
                        }
                    }

                    $sqlLIP = "SELECT * FROM  edl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc, CAST(payment_count AS unsigned) asc";
                    $resultLIP = $conn->query($sqlLIP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterInterest = -1;

                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $orNumber[$counterInterest] = $row['reference_number'];
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
                            $monthDateA = $row['date_application'];
                            $monthDate = new DateTime($monthDateA);
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
                    $loanStatusP = $row['loan_status'];

                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterestP = $row['type_interest'];
                        }
                    }

                    $sqlLP = "SELECT * FROM  eml_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;

                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $orNumber[$counterPayment] = $row['reference_number'];
                            $amountPaymentP[$counterPayment] = $row['amount'];
                            $datePaymentP[$counterPayment] = $row['date_payment'];
                            $counterPayment++;
                            
                        }
                    }

                    $sqlLIP = "SELECT * FROM  eml_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc";
                    $resultLIP = $conn->query($sqlLIP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterInterest = -1;

                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            //$orNumber[$counterInterest] = $row['reference_number'];
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
                            $monthDateA = $row['date_application'];
                            $monthDate = new DateTime($monthDateA);
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
                    $loanStatusP = $row['loan_status'];

                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterestP = $row['type_interest'];
                        }
                    }

                    $sqlLP = "SELECT * FROM  rl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc, CAST(payment_count AS unsigned) asc";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;

                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $orNumber[$counterPayment] = $row['reference_number'];
                            $amountPaymentP[$counterPayment] = $row['amount'];
                            $datePaymentP[$counterPayment] = $row['date_payment'];
                            $paymentCount[$counterPayment] = $row['payment_count'];
                            $counterPayment++;
                            
                        }
                    }

                    $sqlLIP = "SELECT * FROM  rl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc, CAST(payment_count AS unsigned) asc";
                    $resultLIP = $conn->query($sqlLIP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterInterest = -1;

                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $orNumber[$counterPayment] = $row['reference_number'];
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
                            $monthDateA = $row['date_application'];
                            $monthDate = new DateTime($monthDateA);
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
                    $loanStatusP = $row['loan_status'];

                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterestP = $row['type_interest'];
                        }
                    }

                    $sqlLP = "SELECT * FROM  sl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;

                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $orNumber[$counterPayment] = $row['reference_number'];
                            $amountPaymentP[$counterPayment] = $row['amount'];
                            $datePaymentP[$counterPayment] = $row['date_payment'];
                            $counterPayment++;
                            
                        }
                    }

                    $sqlLIP = "SELECT * FROM  sl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc";
                    $resultLIP = $conn->query($sqlLIP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterInterest = -1;

                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            //$orNumber[$counterPayment] = $row['reference_number'];
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
                            $monthDateA = $row['date_application'];
                            $monthDate = new DateTime($monthDateA);
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
                    $typeLoan = $row['loan_service_id'];
                    $loanAmountP = $row['loan_amount'];
                    $loanTermP= $row['loan_term'];
                    $loanInterestP = $row['loan_interest'];
                    $paymentTermP = $row['payment_term'];
                    $loanStatusP = $row['loan_status'];
                    $counterPaymentPL = $row['counter_payment'];

                    $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdP' ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                    if($resultLS->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLS)) {
                            # code...
                            $typeInterestP = $row['type_interest'];
                        }
                    }

                    $sqlLP = "SELECT * FROM  pl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc, CAST(payment_count AS unsigned) asc";
                    $resultLP = $conn->query($sqlLP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterPayment = 0;

                    if($resultLP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLP)) {
                            # code...
                            $orNumber[$counterPayment] = $row['reference_number'];
                            $amountPaymentP[$counterPayment] = $row['amount'];
                            $datePaymentP[$counterPayment] = $row['date_payment'];
                            $paymentCount[$counterPayment] = $row['payment_count'];
                            $counterPayment++;
                            
                        }
                    }

                    $sqlLIP = "SELECT * FROM  pl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP' order by reference_number asc, CAST(payment_count AS unsigned) asc" ;
                    $resultLIP = $conn->query($sqlLIP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterInterest = 0;

                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $orNumber[$counterInterest] = $row['reference_number'];
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
                            $monthDateA = $row['date_application'];
                            $monthDate = new DateTime($monthDateA);
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
                    $interestAmountP = $row['loan_interest'];
                    $loanTermP= $row['loan_term'];
                    $loanInterestP = $row['loan_interest'];
                    $paymentTermP = $row['payment_term'];
                    $loanStatusP = $row['loan_status'];
                    $invoiceNumber = $row['invoice_number'];
                    $quantityU = $row['quantity'];

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

                    $sqlLIP = "SELECT * FROM  rice_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberP'";
                    $resultLIP = $conn->query($sqlLIP);
                    //$numRow = mysqli_num_rows($resultName);
                    $counterInterest = 0;

                    if($resultLIP->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultLIP)) {
                            $orNumber[$counterPayment] = $row['reference_number'];
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
                            $monthDateA = $row['date_application'];
                            $monthDate = new DateTime($monthDateA);
                        }
                    }
                }
            }
        }

        if($loanServiceIdP == "LS1" or $loanServiceIdP == "LS2") {
          $loanServiceName = "Regual Loan";
        }elseif($loanServiceIdP == "LS3"){
          $loanServiceName = "SL 6Cs 1";
        }elseif($loanServiceIdP == "LS4"){
          $loanServiceName = "SL 6Cs 2";
        }elseif($loanServiceIdP == "LS5"){
          $loanServiceName = "SL 6Cs 3";
        }elseif($loanServiceIdP == "LS6"){
          $loanServiceName = "Business Loan";
        }elseif($loanServiceIdP == "LS7"){
          $loanServiceName = "Cash Loan";
        }elseif($loanServiceIdP == "LS8"){
          $loanServiceName = "Check Loan";
        }elseif($loanServiceIdP == "LS9"){
          $loanServiceName = "Special Loan";
        }elseif($loanServiceIdP == "LS10"){
          $loanServiceName = "Educational Loan";
        }elseif($loanServiceIdP == "LS11"){
          $loanServiceName = "Emergency Loan";
        }elseif($loanServiceIdP == "LS12"){
          $loanServiceName = "Calamity Loan";
        }elseif($loanServiceIdP == "LS13"){
          $loanServiceName = "Chattel Mortgage Loan 1";
        }elseif($loanServiceIdP == "LS14"){
          $loanServiceName = "Chattel Mortgage Loan 2";
        }elseif($loanServiceIdP == "LS15"){
          $loanServiceName = "Rice Loan";
        }
    }

    //Print Ledger
    if($printLedger == "printLedger"){
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
    <title>Member Fund Info</title>

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
	<div>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div>
        <?php //include 'topbar.php';?>
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-12" style="margin-top:25px;margin-left: 16.7%;margin-bottom: 100px; position: absolute;width: 80%">
              <h5 align="margin-left">VIEW FUND MEMBER INFORMATION</h5>
            	<div class="row">
                <div class="col-lg-12" style="background-color:#fff; padding: 5px; margin: 5px; border: solid gray 1px">
                    <h6>Search Member</h6>

                    <label style="width: 75px">Search</label>
                    <input type="text" value = "<?php echo $idNumberSearch;?>" name = "idNumberSearch" style="border:none;border-bottom: 2px solid red;">
                    
                    <label style="width: 75px"></label>
                    <input type="text" value = "<?php echo $idNumber;?>" name = "idNumber" readonly style = "border:none;" placeholder = "ID Number">
                    <input type="text" placeholder="First Name" value = "<?php echo $firstName;?>" name = "firstName" readonly style = "border:none;">
                    <input type="text" placeholder="Middle Name" value = "<?php echo $middleName;?>" name = "middleName" readonly style = "border:none;">
                    <input type="text" placeholder="Last Name" value = "<?php echo $lastName;?>" name = "lastName" readonly style = "border:none;">

                    <br>
                    <label style="width: 75px"></label>
                    <button style="width: 190px" class="btn btn-outline-success my-2 my-sm-0" id = "search" name = "searchIDMember" value = "searchIDMember" type="submit">Search</button>
                </div>
              </div>

              <button  class="btn btn-outline-success my-2 my-sm-0" name = "showsl" value = "showsl">Savings Ledger</button>

              <button class="btn btn-outline-success my-2 my-sm-0" name = "showscl" value = "showscl">Share Capital Ledger</button>

              <button class="btn btn-outline-success my-2 my-sm-0" name = "showls" value = "showls">Current Loan</button>

              <button class="btn btn-outline-success my-2 my-sm-0" name = "showpls" value = "showpls">Loan History</button>

              <button class="btn btn-outline-success my-2 my-sm-0" name = "showrllt" value = "showrllt">Rice Loan Ledger</button>

              <button class="btn btn-outline-success my-2 my-sm-0" name = "showrll" value = "showrll">Current Rice Loan</button>

              <button class="btn btn-outline-success my-2 my-sm-0" name = "showprll" value = "showprll">Rice Loan History</button>

              <br>

              <!--<button class="btn btn-outline-success my-2 my-sm-0" name = "printLedger" value = "printLedger">PRINT LEDGER</button>

              <input style="width: 150px;border: none;" type="text" value = "<?php  
              if($ledgerIdentifier == "SL"){
                  echo "Savings Ledger";
              }
              elseif($ledgerIdentifier == "SCL"){
                  echo "Share Capital Ledger";
              } 
              elseif($ledgerIdentifier == "LL"){
                  echo "Loan Ledger";
              }
              ?>" name="ledgerCaption"><br><br>

              -->

              <!--<button class="btn btn-outline-success my-2 my-sm-0" name = "proceedPayment" value = "proceedPayment">PROCEED PAYMENT</button>-->

              <!--Savings Ledger-->
              <div class="table table-striped table-hover table-bordered">
                <?php
                if($displayPropertySavings != "none"){
                    echo "<table>
                    <tr>";
                        echo "<th>" . "Savings Ledger:" ."</th>";
                        echo "<th>" . "Current Balance" ."</th>";
                        echo "<th " . "style=" . "color:red" . ">" . "&#8369;" . number_format($totalAS,'2','.',',') ."</th>";
                        echo "<th>" . "" ."</th>";
                        echo "<th>" . "" ."</th>";
                        echo "<th>" . "" ."</th>";
                        echo "<th>" . "" ."</th>";
                        echo "<th>" . "" ."</th>";

                    echo "
                    </tr>
                    <tr>
                        <th>Transaction #</th>
                        <th>Refernce Number</th>
                        <th>Date Transaction</th>
                        <th>Deposit</th>
                        <th>Withdraw</th>
                        <th>Retention</th>
                        <th>Interest</th>
                        <th>Balance</th>
                        
                    </tr>";
                    
                    $counterhs = 0;
                    $depositAmount[] = 0;
                    $retentionAmount[] = 0;
                    $withdrawAmount[] = 0;
                    $interestAmount[] = 0;
                    $balanceAmount[] = 0;
                    $actualBalance = 0;
                    while($counterhs < $numRowS) {
                        echo "<tr>";
                            echo "<td>" . $transactionNumberS[$counterhs] . "</td>";
                            echo "<td>" . $referemceNumberS[$counterhs] . "</td>";
                            echo "<td>" . $dateTransactionS[$counterhs] . "</td>";

                            if($typeTransactionS[$counterhs] == "Deposit"){
                              $depositAmount[$counterhs] = $amountS[$counterhs];
                              $withdrawAmount[$counterhs] = 0;
                              $interestAmount[$counterhs] = 0;
                              $retentionAmount[$counterhs] = 0;
                            }elseif($typeTransactionS[$counterhs] == "Withdraw"){
                              $depositAmount[$counterhs] = 0;
                              $interestAmount[$counterhs] = 0;
                              $withdrawAmount[$counterhs] = $amountS[$counterhs];
                              $retentionAmount[$counterhs] = 0;
                            }elseif($typeTransactionS[$counterhs] == "Interest"){
                              $interestAmount[$counterhs] = $amountS[$counterhs];
                              $depositAmount[$counterhs] = 0;
                              $withdrawAmount[$counterhs] = 0;
                              $retentionAmount[$counterhs] = 0;
                            }elseif($typeTransactionS[$counterhs] == "Retention"){
                              $interestAmount[$counterhs] = 0;
                              $depositAmount[$counterhs] = 0;
                              $withdrawAmount[$counterhs] = 0;
                              $retentionAmount[$counterhs] = $amountS[$counterhs];;
                            }

                            $balanceAmount[$counterhs] = ($depositAmount[$counterhs] + $interestAmount[$counterhs] +  $retentionAmount[$counterhs]) - $withdrawAmount[$counterhs];

                            $actualBalance = $actualBalance + $balanceAmount[$counterhs];

                            if($depositAmount[$counterhs] == 0){
                              $depositAmount[$counterhs] = "";
                            }else{
                              $depositAmount[$counterhs] = number_format($depositAmount[$counterhs],'2','.',',');
                            }

                            if($withdrawAmount[$counterhs] == 0){
                              $withdrawAmount[$counterhs] = "";
                            }else{
                              $withdrawAmount[$counterhs] = number_format($withdrawAmount[$counterhs],'2','.',',');
                            }

                            if($retentionAmount[$counterhs] == 0){
                              $retentionAmount[$counterhs] = "";
                            }else{
                              $retentionAmount[$counterhs] = number_format($retentionAmount[$counterhs],'2','.',',');
                            }

                            if($interestAmount[$counterhs] == 0){
                              $interestAmount[$counterhs] = "";
                            }else{
                              $interestAmount[$counterhs] = number_format($interestAmount[$counterhs],'2','.',',');
                            }

                            echo "<td " . "style=" . "color:blue" . ">" . $depositAmount[$counterhs] . "</td>";
                            echo "<td " . "style=" . "color:red" . ">" . $withdrawAmount[$counterhs] . "</td>";
                            echo "<td " . "style=" . "color:blue" . ">" . $retentionAmount[$counterhs] . "</td>";
                            echo "<td " . "style=" . "color:blue" . ">" . $interestAmount[$counterhs] . "</td>";
                            echo "<td " . "style=" . "color:green" . ">" . number_format($actualBalance,'2','.',',') . "</td>";
                        echo "</tr>";
                        $counterhs ++;
                    }
                }
                ?>
              </div>

              <!--Share Capital Ledger-->
              <div class="table table-striped table-hover table-bordered">
                <?php
                if($displayPropertySC != "none"){
                    echo "<table>
                    <tr>";
                        echo "<th>" . "Share Capital Ledger:" ."</th>";
                        echo "<th>" . "Current Balance" ."</th>";
                        echo "<th " . "style=" . "color:red" . ">" . "&#8369;" . number_format($totalASC,'2','.',',') ."</th>";

                    echo "
                    </tr>
                    <tr>
                        <th>Transaction #</th>
                        <th>Type Transaction</th>
                        <th>Refernce Number</th>
                        <th>Amount</th>
                        <th>Balance</th>
                        <th>Date Transaction</th>
                    </tr>";
                    
                    $counterhsc = 0;
                    //$actualSCBalance = 0;
                    while($counterhsc < $numRowSC) {
                        echo "<tr>";
                            echo "<td>" . $transactionNumberSC[$counterhsc] . "</td>";
                            echo "<td>" . $typeTransactionSC[$counterhsc] . "</td>";
                            echo "<td>" . $referemceNumberSC[$counterhsc] . "</td>";
                            echo "<td " . "style=" . "color:blue" . ">" . number_format($amountSC[$counterhsc],'2',',','.') . "</td>";
                            //$actualSCBalance = $actualSCBalance + $amountSC[$counterhsc];
                            echo "<td " . "style=" . "color:green" . ">" . number_format($actualSCBalance[$counterhsc],'2',',','.') . "</td>";
                            echo "<td>" . $dateTransactionSC[$counterhsc] . "</td>";
                        echo "</tr>";
                        $counterhsc ++;
                    }
                } 
                ?>
              </div>

              <!--Rice Ledger-->
              <div class="table table-striped table-hover table-bordered">
                <?php
                  if($displayPropertyRiceLoan != "none"){
                    
                    echo "<table>
                    <tr>
                        <th>Rice Loan ID</th>
                        <th>Invoice Number</th>
                        <th>Principal</th>
                        <th>Interest</th>
                        <th>Total</th>
                        <th>Due Date</th>
                        <th>OR #</th>
                        <th>Date Payment</th>
                        <th>Principal</th>
                        <th>Interest</th>
                        <th>Total</th>
                        <th>Total Balance</th>
                    </tr>";

                    $counterf = 0;
                    $riceBalanceP = 0;
                    $riceBalanceI = 0;
                    $ricePaidP = 0;
                    $ricePaidI = 0;
                    $totalBalanceTemp = 0;
                    $totalBalance = 0;
                    $totalRP = 0;
                    $totalRI = 0;
                    $totalRPP = 0;
                    $totalRPI = 0;
                    $totalRB = 0;
                    $totalRS = 0;

                    while($counterf < $numRow){
                        if($monthDateRL[$counterf] != ""){
                          $monthDateRL[$counterf]->add(new DateInterval('P'.($loanTermP*30).'D'));
                        }

                        echo "<tr>";
                            echo "<td>" . $loanApplicationNumber[$counterf] . "</td>";
                            echo "<td>" . $rlinvoice[$counterf] . "</td>";
                            $totalRP = $totalRP + $loanAmount[$counterf];
                            if($loanAmount[$counterf] != ""){
                              echo "<td>" . number_format($loanAmount[$counterf],'2','.',',') . "</td>";
                              $riceBalanceP = $loanAmount[$counterf];
                            }else{
                              $riceBalanceP = 0;
                              echo "<td>" . "" . "</td>";
                            }

                            $totalRI = $totalRI + $interestAmount[$counterf];
                            if($interestAmount[$counterf] != ""){
                              echo "<td>" . number_format($interestAmount[$counterf],'2','.',',') . "</td>";
                              $riceBalanceI = $interestAmount[$counterf];
                            }else{
                              $riceBalanceI = 0;
                               echo "<td>" . "" . "</td>";
                            }

                            $totalRLA = $riceBalanceP + $riceBalanceI;
                            $totalRB = $totalRB + $totalRLA;
                            if($totalRLA > 0){
                              echo "<td>" . number_format($totalRLA,'2','.',',') . "</td>";
                            }else{
                              echo "<td>" . "" . "</td>";
                            }
                            
                            if($monthDateRL[$counterf] != ""){
                              echo "<td>"; echo $monthDateRL[$counterf]->format('Y-m-d');  echo "</td>";
                            }else{
                               echo "<td>" . $monthDateRL[$counterf] . "</td>";
                            }
                            echo "<td " . "style=" . "color:green" . ">" . $orNumber[$counterf] . "</td>";//$orNumber[$counterf]
                            echo "<td " . "style=" . "color:green" . ">" . $datePaymentP[$counterf] . "</td>";//$datePaymentP[$counterf]

                            $totalRPP = $totalRPP + $amountPaymentP[$counterf];
                            if($amountPaymentP[$counterf] != ""){
                              echo "<td " . "style=" . "color:green" . ">" . number_format($amountPaymentP[$counterf],'2','.',',') . "</td>";
                              $ricePaidP = $amountPaymentP[$counterf];
                            }else{
                              $ricePaidP = 0;
                              echo "<td " . "style=" . "color:green" . ">" . "" . "</td>";
                            }

                            $totalRPI = $totalRPI + $amountPI[$counterf];
                            if($amountPI[$counterf] != ""){
                              echo "<td " . "style=" . "color:green" . ">" . number_format($amountPI[$counterf],'2','.',',') . "</td>";
                              $ricePaidI = $amountPI[$counterf];
                            }else{
                              $ricePaidI = 0;
                              echo "<td " . "style=" . "color:green" . ">" . "" . "</td>";
                            }

                            $totalRLP = $ricePaidP + $ricePaidI;
                            $totalRS = $totalRS + $totalRLP;
                            if($totalRLP > 0){
                              echo "<td " . "style=" . "color:green" . ">" . number_format($totalRLP,'2','.',',') . "</td>";
                            }else{
                              echo "<td " . "style=" . "color:green" . ">" . "" . "</td>";
                            }
                            
                            //Total B
                            $totalBalanceTemp = $totalBalanceTemp + (($riceBalanceP + $riceBalanceI) - ($ricePaidP + $ricePaidI));
                            echo "<td " . "style=" . "color:red" . ">" . number_format($totalBalanceTemp,'2','.',',') . "</td>";//$sumPrincipal
                        echo "</tr>";
                        $counterf ++;
                    }

                    echo "<td>" . "TOTAL" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . number_format($totalRP,'2','.',',') . "</td>";
                    echo "<td>" . number_format($totalRI,'2','.',',') . "</td>";
                    echo "<td>" . number_format($totalRB,'2','.',',') . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td " . "style=" . "color:green" . ">" . number_format($totalRPP,'2','.',',') . "</td>";
                    echo "<td " . "style=" . "color:green" . ">" . number_format($totalRPI,'2','.',',') . "</td>";
                    echo "<td " . "style=" . "color:green" . ">" . number_format($totalRS,'2','.',',') . "</td>";
                    //$totalBalanceTemp = ($riceBalanceP + $riceBalanceI) - ($ricePaidP - $ricePaidI);
                    echo "<td " . "style=" . "color:red" . ">" . number_format($totalBalanceTemp,'2','.',',') . "</td>";
                  }
                ?>
              </div>

              <!--List of Loan-->
              <div class="table table-striped table-hover table-bordered">
                  <?php
                    if($displayPropertyLoan != "none"){
                      if($idNumber != ""){
                        echo "<table>
                        <tr>
                            <th>List of Loan</th>
                        </tr>
                        <tr>
                            <th>Loan Application Number</th>
                            <th>Loan Service Name</th>
                            <th>Loan Service ID</th>
                            <th>Loan Date Application</th>
                            <th>Loan Amount</th>
                            <th>Loan Term</th>
                            <th>Loan Status</th>
                            <th></th>
                        </tr>";
                        
                        $counterh = 0;
                        $sumPrincipalRCL[] = 0;
                        while($counterh < $numRow) {
                                echo "<tr>";
                                    echo "<td> <button type =" . "submit" . " " . "style=" . "width:70px;" . " " . "value=". $loanApplicationNumber[$counterh] . " " . "name=" . "myButton". ">"  . $loanApplicationNumber[$counterh] . " </button> </td>";
                                    if(substr($loanApplicationNumber[$counterh],0,3) == "RCL"){
                                        echo "<td>" . $riceInvoice[$counterh] . "</td>";
                                    }else{
                                        echo "<td>" . $loanName[$counterh] . "</td>";
                                    }
                                    
                                    $sumPrincipalRCL[$counterh] = $loanAmount[$counterh] + $interestAmount[$counterh];
                                    echo "<td>" . $loanServiceId[$counterh] . "</td>";
                                    echo "<td>" . $dateApplication[$counterh] . "</td>";
                                    echo "<td>" . number_format($sumPrincipalRCL[$counterh],'2','.',',') . "</td>";
                                    echo "<td>" . $loanTerm[$counterh] . "</td>";
                                    echo "<td>" . $loanStatus[$counterh] . "</td>";
                                echo "</tr>";
                            $counterh ++;
                        }
                      }
                    }
                  ?>
              </div>

              <!--Loan Ledger-->
              <div class="table table-striped table-hover table-bordered">
                  <?php
                    if($loanApplicationNumberId != ""){
                      if($typeInterestP == "Flat"){
                        $monthDate->add(new DateInterval('P'.($loanTermP*30).'D'));
                        if(substr("$loanApplicationNumberP", 0,3) == "RCL"){
                            echo "<table>
                            <tr>";
                                echo "<th>" . "Loan Ledger:" ."</th>";
                                echo "<th>" . "Loan ID:" .$loanApplicationNumberId ."</th>";
                                echo "<th>" . $loanServiceName ."</th>";
                                echo "<th>" . "Loan Amount:" ."</th>";

                                echo "<th>" . "&#8369;" .number_format($loanAmountP + $loanInterestP,'2',',','.') ."</th>";
                                echo "<th>" . "Loan Term:" ."</th>";
                                echo "<th>" . $loanTermP . " " . "Months" ."</th>";
                                echo "<th>" . "Mode of Payment:" ."</th>";
                                echo "<th>" . $paymentTermP ."</th>";
                                echo "<th> <button type =" . "submit" . " " ."value=". $loanApplicationNumberId . " " . "name=" . "proceedPayment". ">"  . "PROCEED PAYMENT" . " </button> </th>";

                            echo"
                            </tr>";

                            echo"
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
                                //echo "$sumPrincipal"; echo " ";
                                
                                /*if($sumPrincipal <= 0){
                                  //echo "$loanApplicationNumberP";
                                  //echo "$loanApplicationNumberP";
                                  //echo "$idNumber";
                                  $status = "Paid";
                                  //echo "$loanApplicationNumberP";
                                  $sql = "UPDATE rice_loan_table SET
                                  loan_status = '$status'
                                  WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberP' ";

                                  if ($conn->query($sql) === TRUE) {
                                     $infomessage = "Loan Paid";
                                     echo "$infomessage";
                                  } 
                                  else { 
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                  }
                                }*/
                                echo "<tr>";
                                    echo "<td>" . number_format($loanAmountP,'2','.',',') . "</td>";
                                    echo "<td>" . number_format($loanInterestP,'2','.',',') . "</td>";
                                    echo "<td>"; echo $monthDate->format('Y-m-d');  echo "</td>";
                                    echo "<td " . "style=" . "color:green" . ">" . $orNumber[$counterf] . "</td>";
                                    echo "<td " . "style=" . "color:green" . ">" . $datePaymentP[$counterf] . "</td>";
                                    echo "<td " . "style=" . "color:green" . ">" . number_format($amountPaymentP[$counterf],'2','.',',') . "</td>";
                                    echo "<td " . "style=" . "color:green" . ">" . number_format($amountPI[$counterf],'2','.',',') . "</td>";
                                    echo "<td " . "style=" . "color:red" . ">" . $sumPrincipal . "</td>";
                                    echo "<td></td>";
                                echo "</tr>";
                                $counterf ++;
                            }
                        }else{
                            echo "<table>
                            <tr>";
                                echo "<th>" . "Loan Ledger:" ."</th>";
                                echo "<th>" . "Loan ID:" .$loanApplicationNumberId ."</th>";
                                echo "<th>" . $loanServiceName ."</th>";
                                echo "<th>" . "Loan Amount:" ."</th>";
                                echo "<th>" . "&#8369;" .number_format($loanAmountP,'2',',','.') ."</th>";
                                echo "<th>" . "Loan Term:" ."</th>";
                                echo "<th>" . $loanTermP . " " . "Months" ."</th>";
                                echo "<th>" . "Mode of Payment:" ."</th>";
                                echo "<th>" . $paymentTermP ."</th>";
                                echo "<th> <button type =" . "submit" . " " ."value=". $loanApplicationNumberId . " " . "name=" . "proceedPayment". ">"  . "PROCEED PAYMENT" . " </button> </th>";

                            echo"
                                <th></th>
                            </tr>";

                            echo"
                            <tr>
                                <th>Loan Amount</th>
                                <th>Due Date</th>
                                <th>Date of Payment</th>
                                <th>OR Number</th>
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
                                /*if($sumPrincipal<=0){


                                  if(substr($loanApplicationNumberP, 0,2) == "CL"){
                                      $sql = "UPDATE cl_loan_table SET
                                      loan_status = 'Paid'
                                      WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberP' ";

                                      if ($conn->query($sql) === TRUE) {
                                         $infomessage = "Loan Paid";
                                      } 
                                      else { 
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                      }
                                  }elseif(substr($loanApplicationNumberP, 0,3) == "EML"){
                                      $sql = "UPDATE eml_loan_table SET
                                      loan_status = 'Paid'
                                      WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberP' ";

                                      if ($conn->query($sql) === TRUE) {
                                         $infomessage = "Loan Paid";
                                      } 
                                      else { 
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                      }
                                  }elseif(substr($loanApplicationNumberP, 0,2) == "SL"){
                                      $sql = "UPDATE sl_loan_table SET
                                      loan_status = 'Paid'
                                      WHERE id_number = '$idNumber' and loan_application_number =  '$loanApplicationNumberP' ";

                                      if ($conn->query($sql) === TRUE) {
                                         $infomessage = "Loan Paid";
                                      } 
                                      else { 
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                      }
                                  }
                                }*/
                                echo "<tr>";
                                    echo "<td>" . number_format($loanAmountP,'2','.',',') . "</td>";
                                    echo "<td>"; echo $monthDate->format('Y-m-d');  echo "</td>";
                                    echo "<td " . "style=" . "color:green" . ">" . $datePaymentP[$counterf] . "</td>";
                                    echo "<td " . "style=" . "color:green" . ">" . $orNumber[$counterf] . "</td>";
                                    echo "<td " . "style=" . "color:green" . ">" . number_format($amountPaymentP[$counterf],'2','.',',') . "</td>";
                                    echo "<td " . "style=" . "color:red" . ">" . number_format($sumPrincipal,'2','.',',') . "</td>";
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

                          $monthlyAmortization = $monthlyAmortization / $paymentTerm;
                          $monthlyAmortization = round($monthlyAmortization,2,PHP_ROUND_HALF_ODD);

                          $interestPayment = $interestPayment / $paymentTerm;
                          $interestPayment =  round($interestPayment,2,PHP_ROUND_HALF_ODD);

                          //actual
                          $actualInterest = $interestPayment / $paymentTerm;
                          $actualInterest =  round($actualInterest,2,PHP_ROUND_HALF_ODD);

                          echo "<br>";

                          echo "<table>
                          <tr>";

                            echo "<th>" . "Loan Ledger:" ."</th>";
                            echo "<th " . "style=" . "color:blue" . ">" .$loanApplicationNumberId ."</th>";
                            echo "<th " . "style=" . "color:blue" . ">" . $loanServiceName ."</th>";
                            echo "<th>" . "Amount:" ."</th>";
                            echo "<th " . "style=" . "color:blue" . ">" . "&#8369;" .number_format($loanAmountP,'2',',','.') ."</th>";
                            echo "<th>" . "Term:" ."</th>";
                            echo "<th " . "style=" . "color:blue" . ">" . $loanTermP ."</th>";
                            echo "<th " . "style=" . "color:blue" . ">" . $paymentTermP ."</th>";
                            echo "<th> <button type =" . "submit" . " " ."value=". $loanApplicationNumberId . " " . "name=" . "proceedPayment". ">"  . "PROCEED PAYMENT" . " </button> </th>";
                            echo "<th> <button type =" . "submit" . " " ."value=". $loanApplicationNumberId . " " . "name=" . "printLedger". ">"  . "PRINT LEDGER" . " </button> </th>";
                                
                          echo"

                          </tr>";

                          echo "
                          <tr>  
                              <th>Due Date</th>
                              <th>Monthly Amortization</th>
                              <th>Principal Payment</th>
                              <th>Interest Payment</th>
                              <th>O/S Balance</th>
                              <th>Date of Payment</th>
                              <th>OR #</th>
                              <th>Amount</th>
                              <th>Actual Principal</th>
                              <th>Actual Interest</th>
                              <th>Actual Balance</th>
                              <th>Payment Counter</th>
                              <th># payment</th>
                              <th># days delay</th>
                          </tr>";
                          
                          $counterh = 0;
                          //if(substr($loanApplicationNumberId, 0,2) == "PL"){
                            //$counterPayment = $counterPayment + $counterPaymentPL;
                            //$counterComparison = $counterPaymentPL;
                          //}else{
                            $counterComparison = $counterPayment;
                          //}
                          
                          $sumPrincipal = 0;
                          $totalAmortizationActual = 0;
                          $totalPrincipalActual = 0;
                          $totalInterestActual = 0;

                          //check if greater than
                          $ledgerFlag = 0;

                          if($loanTermP >= $counterPayment){
                            $ledgerFlag = $loanTermP;
                          }elseif($counterPayment > $loanTermP){
                            $ledgerFlag = $counterPayment;
                          }

                          $counterF = 0;
                          if($counterPaymentPL != ""){
                            $counterF = $counterPaymentPL;
                          }
                          
                          $nbdelays = 0;

                          while($counterh < $ledgerFlag) {
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

                              if($paymentTermP == "Monthly"){
                                  $monthDate->add(new DateInterval('P'.(30).'D'));
                              }elseif($paymentTermP == "Semi Monthly"){
                                  $monthDate->add(new DateInterval('P'.(15).'D'));
                              }else{
                                  $monthDate->add(new DateInterval('P'.(1).'D'));
                              }

                              if($counterh >= $counterComparison){
                                  $actualPrincipal = 0;
                                  $actualInterest = 0;
                              }else{
                                  $totalInterestActual = $totalInterestActual + $amountPI[$counterh];

                                  //Sum of Principal Payment
                                  $sumPrincipal = $sumPrincipal + $amountPaymentP[$counterh];

                                  //Total Payment //CHECK ERROR
                                  $amountPaymentPP[$counterh] = $amountPaymentP[$counterh] + $amountPI[$counterh];

                                  //Balance
                                  $amountBalance[$counterh] = $loanAmountP - $sumPrincipal;
                                  $amountBalance[$counterh] = round($amountBalance[$counterh],2,PHP_ROUND_HALF_ODD);

                                  //Next Balance
                                  $amountBalance[$counterh + 1] = $amountBalance[$counterh] + ($amountBalance[$counterh] * $loanInterestP);
                                  $amountBalance[$counterh + 1] = round($amountBalance[$counterh + 1],2,PHP_ROUND_HALF_ODD);

                                  if( ($counterh + 1) == $counterComparison){

                                      //nice
                                      $PLTemp = 0;

                                      if(substr($loanApplicationNumberId, 0,2) == "PL"){
                                        $PLTemp = $counterPaymentPL;
                                        //echo "string";
                                      }

                                      $evenNumber = ($counterh + 1 + $PLTemp)%2;
                                      $monthNumber = ($counterh + 1 + $PLTemp)%30;

                                      if( ($evenNumber == 1 and $paymentTerm == 2) or ($monthNumber > 0 and $paymentTerm == 30) ){
                                        //echo "$evenNumber";
                                          $amountPI[$counterh + 1] = $amountPI[$counterh];
                                      }else{
                                          $amountPI[$counterh + 1] = ($amountBalance[$counterh] * $loanInterestP)/$paymentTerm;
                                          $amountPI[$counterh + 1] = round($amountPI[$counterh + 1],2,PHP_ROUND_HALF_ODD);
                                      }
                                  }
                              }

                              //if loan payment updated
                              while($counterPayment < $loanTermP){
                                  $datePaymentP[$counterPayment] = "";
                                  $orNumber[$counterPayment] = "";
                                  $amountPaymentPP[$counterPayment] = 0;
                                  $amountPaymentP[$counterPayment] = 0;
                                  $amountPI[$counterPayment+1] = 0;
                                  
                                  $amountBalance[$counterPayment+1] = 0;
                                  $paymentCount[$counterPayment] = "";
                                  $counterPayment++;

                                  $nbdelays = "";
                              }



                              echo "<tr>"; 
                                  echo "<td>"; echo $monthDate->format('Y-m-d');  echo "</td>";
                                  echo "<td>" . number_format($monthlyAmortization,'2','.',',') . "</td>";
                                  echo "<td>" . number_format($principalPayment,'2','.',',') . "</td>";
                                  echo "<td>" . number_format($interestPayment,'2','.',',') . "</td>";
                                  echo "<td>" . number_format($OSBalanceTemp,'2','.',',') . "</td>";
                                  echo "<td " . "style=" . "color:green" . ">" . $datePaymentP[$counterh] . "</td>";
                                  echo "<td " . "style=" . "color:green" . ">" . $orNumber[$counterh] . "</td>";

                                  $totalAmortizationActual = $totalAmortizationActual + $amountPaymentPP[$counterh];
                                  $totalPrincipalActual = $totalPrincipalActual + $amountPaymentP[$counterh];
                                  
                                  echo "<td " . "style=" . "color:green" . ">" . number_format($amountPaymentPP[$counterh],'2','.',',') . "</td>";
                                  echo "<td " . "style=" . "color:green" . ">" . number_format($amountPaymentP[$counterh],'2','.',',') . "</td>";
                                  echo "<td " . "style=" . "color:green" . ">" . number_format($amountPI[$counterh],'2','.',',') . "</td>";//CHECK ERROR
                                  echo "<td " . "style=" . "color:blue" . ">" . number_format($amountBalance[$counterh],'2','.',',') . "</td>";
                                  
                                  if($paymentCount[$counterh] == 0){
                                      echo "<td " . "style=" . "color:green" . ">" . "1" . "</td>";
                                  }else{
                                      echo "<td " . "style=" . "color:#DF7401" . ">" . $paymentCount[$counterh] . "</td>";
                                  }

                                  if($paymentTermP == "Monthly"){
                                    $counterF = $counterF + 1;
                                    echo "<td " . "style=" . "color:blue" . ">" . $counterF . "</td>";
                                  }elseif($paymentTermP == "Semi Monthly"){
                                    $counterF = $counterF + 1;
                                    if($counterF > 2){
                                      $counterF = 1;
                                    }
                                    echo "<td " . "style=" . "color:blue" . ">" . $counterF . "</td>";
                                  }else{
                                    
                                    if(substr($loanApplicationNumberId,0,2) == "PL"){
                                      $counterF = $counterF + 1;
                                    }else{
                                      $counterF = $counterF + 1;
                                    }
                                    
                                    if($counterF > 30){
                                      $counterF = 1;
                                    }
                                    echo "<td " . "style=" . "color:blue" . ">" . $counterF . "</td>";
                                  }

                                  //#days delay\
                                  if($datePaymentP[$counterh] != "" and $paymentTermP != "Daily"){
                                    $dueDate = $monthDate;
                                    $paymentDate = new DateTime($datePaymentP[$counterh]);
                                    $dateDelay = $dueDate->diff($paymentDate);
                                    //$nbdelays = $dateDelay->days;

                                    if($dateDelay->format("%r%a") > 0){
                                      echo "<td " . "style=" . "color:red" . ">"; echo $dateDelay->format("%r%a"); echo"</td>";
                                    }else{
                                      echo "<td " . "style=" . "color:blue" . ">" . "" . "</td>";
                                    }
                                    
                                  }else{
                                    echo "<td " . "style=" . "color:blue" . ">" . "" . "</td>";
                                  }
                                  

                              echo "</tr>";

                              $counterh ++;
                              
                              if($paymentTermP == "Semi Monthly"){
                                  $identifier = $counterh % 2;
                                  if($identifier == 1){
                                      $interestPayment = $interestPayment;
                                  }else{
                                      $interestPayment = round($OSBalanceTemp * $loanInterestP,2,PHP_ROUND_HALF_ODD);
                                      $interestPayment = $interestPayment / $paymentTerm;
                                  }
                                  
                              }elseif($paymentTermP == "Daily"){
                                  $identifier = (($counterh+1) % 30);
                                  if($identifier >= 1){
                                      $interestPayment = $interestPayment;
                                  }else{
                                      $interestPayment = round($OSBalanceTemp * $loanInterestP,2,PHP_ROUND_HALF_ODD);
                                      $interestPayment = $interestPayment / $paymentTerm;
                                  }
                              }
                              else{
                                  $interestPayment = round($OSBalanceTemp * $loanInterestP,2,PHP_ROUND_HALF_ODD);
                                  $interestPayment = $interestPayment / $paymentTerm;
                              }
                              
                              $interestPayment = round($interestPayment,2,PHP_ROUND_HALF_ODD);
                              $OSBalance = round($OSBalanceTemp,2,PHP_ROUND_HALF_ODD);

                              $totalPrincipal = $totalPrincipal + $principalPayment;
                          }

                          if($totalInterest != 0 or $totalPrincipal !=0){
                              $actualInterest = round(($totalInterest/$totalPrincipal) * 100);
                          }

                           $monthlyAmortization = $monthlyAmortization * $loanTermP;

                           if( $totalPrincipal != $loanAmountP ){
                            $monthlyAmortization = $monthlyAmortization - ($totalPrincipal - $loanAmountP);
                            $totalPrincipal = $totalPrincipal - ($totalPrincipal - $loanAmountP);
                         }
                           echo "<tr>";
                              echo "<td>" . "" . "</td>";
                              echo "<td>" . number_format($monthlyAmortization,'2','.',',') . "</td>";
                              echo "<td>" . number_format($totalPrincipal,'2','.',',') . "</td>";
                              echo "<td>" . number_format($totalInterest,'2','.',',') . "</td>";
                              echo "<td>" . "" . "</td>";
                              echo "<td>" . "" . "</td>";
                              echo "<td>" . "" . "</td>";
                              echo "<td>" . number_format($totalAmortizationActual,'2','.',',') . "</td>";
                              echo "<td>" . number_format($totalPrincipalActual,'2','.',',') . "</td>";
                              echo "<td>" . number_format($totalInterestActual,'2','.',',') . "</td>";
                              echo "<td>" . "" . "</td>";
                          echo "</tr>";
                      }
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