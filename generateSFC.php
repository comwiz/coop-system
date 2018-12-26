<?php  

require_once 'session.php';
require('public/fpdf181/fpdf.php');

$infomessage = "";
$startDate = "";
$endDate = "";
$generateReport = "";

$totalSavingsT = 0;
$totalSavingsW = 0;
$totalSavings = 0;

$totalTimeDT = 0;
$totalTimeDW = 0;
$totalTimeDeposit = 0;

$totalFixedDT = 0;
$totalFixedDW = 0;
$totalFixedDeposit = 0;

$totalCSD = 0;
$totalCSW = 0;
$totalCS = 0;

$totalPSD = 0;
$totalPSW = 0;
$totalPS = 0;

$totalFS = 0;

$totalGF = 0;
$totalEF = 0;
$totalOP = 0;
$totalCF = 0;

$totalAL = 0;

//LR
$totalLoanReceivables = 0;
$loanReceivablesBL = 0;

//Rice
$loanReceivablesRCL = 0;

//Property and Equipment
$totalDB = 0;
$totalDO = 0;
$totalDE = 0;

$totalBI = 0;
$totalFF = 0;
$totalOE = 0;

//NON CURRENT ASSET
$totalBB = 0;
$totalSK = 0;
$totalBS = 0;
$totalLP = 0;

$countErr = 0;

$printReport = "";


if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST["generateReport"])) {
        $generateReport = test_input($_POST["generateReport"]);
    }

    if(!empty($_POST["printReport"])) {
        $printReport = test_input($_POST["printReport"]);
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

    //Time Deposits
    $sqlName = "SELECT * FROM  time_deposit_table WHERE type_transaction = 'Deposit' and (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTimeDTemp = $row['amount'];
            $totalTimeDT = $totalTimeDT + $totalTimeDTemp;
        }
    }

    $sqlName = "SELECT * FROM  time_deposit_table WHERE type_transaction = 'Withdraw' and (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTimeDWTemp = $row['amount'];
            $totalTimeDW = $totalTimeDW + $totalTimeDWTemp;
        }
    }

    $totalTimeDeposit = $totalTimeDT - $totalTimeDW;

    //Savings
    $sqlName = "SELECT * FROM  savings_table WHERE (type_transaction = 'Interest' or type_transaction = 'Deposit' or type_transaction = 'Retentaion') and (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalSavingsTTemp = $row['amount'];
            $totalSavingsT = $totalSavingsT + $totalSavingsTTemp;
        }
    }

    $sqlName = "SELECT * FROM  savings_table WHERE type_transaction = 'Withdraw' and (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalSavingsWTemp = $row['amount'];
            $totalSavingsW = $totalSavingsW + $totalSavingsWTemp;
        }
    }

    $totalSavings = $totalSavingsT - $totalSavingsW;

    //Fixed Deposits
    $sqlName = "SELECT * FROM  fixed_deposit_table WHERE type_transaction = 'Deposit' and (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalFixedDTTemp = $row['amount'];
            $totalFixedDT = $totalFixedDT + $totalFixedDTTemp;
        }
    }

    $sqlName = "SELECT * FROM  fixed_deposit_table WHERE type_transaction = 'Withdraw' and (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalFixedDWTemp = $row['amount'];
            $totalFixedDW = $totalFixedDW + $totalFixedDWTemp;
        }
    }

    $totalFixedDeposit = $totalFixedDT - $totalFixedDW;

    //Share Capital
    $sqlName = "SELECT * FROM  share_capital_table WHERE (type_transaction = 'SCF'  or type_transaction = 'CBU' or type_transaction='Retention') and (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $idNumber = $row['id_number'];
            $sqlNameSC = "SELECT * FROM  name_table WHERE id_number = '$idNumber'  ";
            $resultNameSC = $conn->query($sqlNameSC);
            if($resultNameSC->num_rows > 0){
                while ($rowSC = mysqli_fetch_array($resultNameSC)){
                    $typeMember = $rowSC['type_membership'];
                }
            }

            if($typeMember == "Regular"){
                $totalCSDTemp = $row['amount'];
                $totalCSD = $totalCSD + $totalCSDTemp;
            }elseif($typeMember == "Associate"){
                $totalPSDTemp = $row['amount'];
                $totalPSD = $totalPSD + $totalPSDTemp;
            }
            
        }
    }

    $sqlName = "SELECT * FROM  share_capital_table WHERE (type_transaction = 'Withdraw') and (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $idNumber = $row['id_number'];

            $sqlNameSC = "SELECT * FROM  name_table WHERE id_number = '$idNumber'  ";
            $resultNameSC = $conn->query($sqlNameSC);
            if($resultNameSC->num_rows > 0){
                while ($rowSC = mysqli_fetch_array($resultNameSC)){
                    $typeMember = $rowSC['type_membership'];
                }
            }

            if($typeMember == "Regular"){
                $totalCSWTemp = $row['amount'];
                //$totalCSW = $totalCSW + $totalCSWTemp;
            }elseif($typeMember == "Associate"){
                $totalPSWTemp = $row['amount'];
                //$totalPSW = $totalPSW + $totalPSWTemp;
            }
            
        }
    }

    $totalCS = $totalCSD - $totalCSW;
    $totalPS = $totalPSD - $totalPSW;

    //Future Subscription
    $sqlName = "SELECT * FROM  share_capital_table WHERE (type_transaction = 'SFC'  or type_transaction = 'CBU' or 'Retention') and (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalFSTemp = $row['amount'];
            
            $FSFlag = fmod($totalFSTemp,100);
            if($FSFlag != 0){
                if($totalFSTemp > 100){
                    $totalFS = $totalFS + $FSFlag;
                }else{
                    $totalFS = $totalFS + $totalFSTemp;
                }
            }
        }
    }

    //Statury Fund
    //General Reserved
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'GF')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempGF = $row['amount'];
            $totalGF = $totalGF + $totalTempGF;
        }
    }

    //Educational and Training Fund
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'EF')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempEF = $row['amount'];
            $totalEF = $totalEF + $totalTempEF;
        }
    }

    //Optional Fund
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'OP')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempOF = $row['amount'];
            $totalOP = $totalOP + $totalTempOF;
        }
    }

    //Community and DEV fund
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'CF')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempCF = $row['amount'];
            $totalCF = $totalCF + $totalTempCF;
        }
    }

    //Allowance for probable loss
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'AL')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempAL = $row['amount'];
            $totalAL = $totalAL + $totalTempAL;
        }
    }

    //Buiding
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'BI')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempBI = $row['amount'];
            $totalBI = $totalBI + $totalTempBI;
        }
    }

    //Depreciation Buiding
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'DB')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempDB = $row['amount'];
            $totalDB = $totalDB + $totalTempDB;
        }
    }

    //Office Furniture & Fixture
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'FF')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempFF = $row['amount'];
            $totalFF = $totalFF + $totalTempFF;
        }
    }

    //Depreciation Office Furniture & Fixture
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'DO')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempDO = $row['amount'];
            $totalDO = $totalDO + $totalTempDO;
        }
    }

    //Office Equipment
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'OE')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempOE = $row['amount'];
            $totalOE = $totalOE + $totalTempOE;
        }
    }

    //Depreciation Office Equipment
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'DE')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempDE = $row['amount'];
            $totalDE = $totalDE + $totalTempDE;
        }
    }

    //Allowance for probable loss
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'AL')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempAL = $row['amount'];
            $totalAL = $totalAL + $totalTempAL;
        }
    }

    //
    //Allowance for probable loss
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'BB')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempBB = $row['amount'];
            $totalBB = $totalBB + $totalTempBB;
        }
    }

    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'SK')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempSK = $row['amount'];
            $totalSK = $totalSK + $totalTempSK;
        }
    }

    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'BS')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempBS = $row['amount'];
            $totalBS = $totalBS + $totalTempBS;
        }
    }

    //Other Funds and Deposits
    $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'LP')";
    $resultName = $conn->query($sqlName);

    if($resultName->num_rows > 0){
        while ($row = mysqli_fetch_array($resultName)) {
            $totalTempLP = $row['amount'];
            $totalLP = $totalLP + $totalTempLP;
        }
    }

    //Loan Receivables
    //BL
    $sqlbi = "SELECT * FROM  bl_loan_table WHERE loan_status = 'Released' ";
    $resultbi = $conn->query($sqlbi);

    $loanReceivablesBL = 0;
    $loanReceivablesBLT = 0;
    $loanPaymentBLT = 0;

    if($resultbi->num_rows > 0){
        while ($row = mysqli_fetch_array($resultbi)) {
            # code...
            $loanReceivablesTempBL = $row['loan_amount'];
            $loanApplicationNumberBL = $row['loan_application_number'];

            $loanReceivablesBLT = $loanReceivablesBLT + $loanReceivablesTempBL;

            $sqlLP = "SELECT * FROM  bl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberBL' and date_payment <= '$endDate'";
            $resultLP = $conn->query($sqlLP);

            if($resultLP->num_rows > 0){
                while ($rowLP = mysqli_fetch_array($resultLP)) {
                    $loanPaymentTempBL = $rowLP['amount'];
                    $loanPaymentBLT = $loanPaymentBLT + $loanPaymentTempBL;
                }
            }
        }
        
        $loanReceivablesBL = $loanReceivablesBLT - $loanPaymentBLT;
    }

    /*
    //CKL
    $sqlbi = "SELECT * FROM  ckl_loan_table WHERE loan_status = 'Released' ";
    $resultbi = $conn->query($sqlbi);

    $loanReceivablesCKL = 0;
    $loanReceivablesCKLT = 0;
    $loanPaymentCKLT = 0;

    if($resultbi->num_rows > 0){
        while ($row = mysqli_fetch_array($resultbi)) {
            # code...
            $loanReceivablesTempCKL = $row['loan_amount'];
            $loanApplicationNumberCKL = $row['loan_application_number'];

            $loanReceivablesCKLT = $loanReceivablesCKLT + $loanReceivablesTempCKL;

            $sqlLP = "SELECT * FROM  ckl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberCKL' and date_payment <= '$endDate'";
            $resultLP = $conn->query($sqlLP);

            if($resultLP->num_rows > 0){
                while ($rowLP = mysqli_fetch_array($resultLP)) {
                    $loanPaymentTempCKL = $rowLP['amount'];
                    $loanPaymentCKLT = $loanPaymentCKLT + $loanPaymentTempCKL;
                }
            }
        }
        
        $loanReceivablesCKL = $loanReceivablesCKLT - $loanPaymentCKLT;
    }

    //CLL
    $sqlbi = "SELECT * FROM  cll_loan_table WHERE loan_status = 'Released' ";
    $resultbi = $conn->query($sqlbi);

    $loanReceivablesCLLT = 0;
    $loanPaymentCLLT = 0;
    $loanReceivablesCLL = 0;

    if($resultbi->num_rows > 0){
        while ($row = mysqli_fetch_array($resultbi)) {
            # code...
            $loanReceivablesTempCLL = $row['loan_amount'];
            $loanApplicationNumberCLL = $row['loan_application_number'];

            $loanReceivablesCLLT = $loanReceivablesCLLT + $loanReceivablesTempCKL;

            $sqlLP = "SELECT * FROM  cll_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberCLL' and date_payment <= '$endDate'";
            $resultLP = $conn->query($sqlLP);

            if($resultLP->num_rows > 0){
                while ($rowLP = mysqli_fetch_array($resultLP)) {
                    $loanPaymentTempCLL = $rowLP['amount'];
                    $loanPaymentCLLT = $loanPaymentCLLT + $loanPaymentTempCLL;
                }
            }
        }
        
        $loanReceivablesCLL = $loanReceivablesCLLT - $loanPaymentCLLT;
    }

    //CL
    $sqlbi = "SELECT * FROM  cl_loan_table WHERE loan_status = 'Released' ";
    $resultbi = $conn->query($sqlbi);

    $loanReceivablesCLT = 0;
    $loanPaymentCLT = 0;
    $loanReceivablesCL = 0;

    if($resultbi->num_rows > 0){
        while ($row = mysqli_fetch_array($resultbi)) {
            # code...
            $loanReceivablesTempCL = $row['loan_amount'];
            $loanApplicationNumberCL = $row['loan_application_number'];

            $loanReceivablesCLT = $loanReceivablesCLT + $loanReceivablesTempCL;

            $sqlLP = "SELECT * FROM  cl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberCL' and date_payment <= '$endDate'";
            $resultLP = $conn->query($sqlLP);

            if($resultLP->num_rows > 0){
                while ($rowLP = mysqli_fetch_array($resultLP)) {
                    $loanPaymentTempCL = $rowLP['amount'];
                    $loanPaymentCLT = $loanPaymentCLT + $loanPaymentTempCL;
                }
            }
        }
        
        $loanReceivablesCL = $loanReceivablesCLT - $loanPaymentCLT;
    }

    //CML
    $sqlbi = "SELECT * FROM  cml_loan_table WHERE loan_status = 'Released' ";
    $resultbi = $conn->query($sqlbi);

    $loanReceivablesCMLT = 0;
    $loanPaymentCMLT = 0;
    $loanReceivablesCML = 0;

    if($resultbi->num_rows > 0){
        while ($row = mysqli_fetch_array($resultbi)) {
            # code...
            $loanReceivablesTempCML = $row['loan_amount'];
            $loanApplicationNumberCML = $row['loan_application_number'];

            $loanReceivablesCMLT = $loanReceivablesCMLT + $loanReceivablesTempCML;

            $sqlLP = "SELECT * FROM  cml_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberCML' and date_payment <= '$endDate'";
            $resultLP = $conn->query($sqlLP);

            if($resultLP->num_rows > 0){
                while ($rowLP = mysqli_fetch_array($resultLP)) {
                    $loanPaymentTempCML = $rowLP['amount'];
                    $loanPaymentCMLT = $loanPaymentCMLT + $loanPaymentTempCML;
                }
            }
        }
        
        $loanReceivablesCML = $loanReceivablesCMLT - $loanPaymentCMLT;
    }

    //EDL
    $sqlbi = "SELECT * FROM  edl_loan_table WHERE loan_status = 'Released' ";
    $resultbi = $conn->query($sqlbi);

    $loanReceivablesEDLT = 0;
    $loanPaymentEDLT = 0;
    $loanReceivablesEDL = 0;

    if($resultbi->num_rows > 0){
        while ($row = mysqli_fetch_array($resultbi)) {
            # code...
            $loanReceivablesTempEDL = $row['loan_amount'];
            $loanApplicationNumberEDL = $row['loan_application_number'];

            $loanReceivablesEDLT = $loanReceivablesEDLT + $loanReceivablesTempEDL;

            $sqlLP = "SELECT * FROM  edl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberEDL' and date_payment <= '$endDate'";
            $resultLP = $conn->query($sqlLP);

            if($resultLP->num_rows > 0){
                while ($rowLP = mysqli_fetch_array($resultLP)) {
                    $loanPaymentTempEDL = $rowLP['amount'];
                    $loanPaymentEDLT = $loanPaymentEDLT + $loanPaymentTempEDL;
                }
            }
        }
        
        $loanReceivablesEDL = $loanReceivablesEDLT - $loanPaymentEDLT;
    }

    //EML
    $sqlbi = "SELECT * FROM  eml_loan_table WHERE loan_status = 'Released' ";
    $resultbi = $conn->query($sqlbi);

    $loanReceivablesEMLT = 0;
    $loanPaymentEMLT = 0;
    $loanReceivablesEML = 0;

    if($resultbi->num_rows > 0){
        while ($row = mysqli_fetch_array($resultbi)) {
            # code...
            $loanReceivablesTempEML = $row['loan_amount'];
            $loanApplicationNumberEML = $row['loan_application_number'];

            $loanReceivablesEMLT = $loanReceivablesEMLT + $loanReceivablesTempEML;

            $sqlLP = "SELECT * FROM  eml_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberEML' and date_payment <= '$endDate'";
            $resultLP = $conn->query($sqlLP);

            if($resultLP->num_rows > 0){
                while ($rowLP = mysqli_fetch_array($resultLP)) {
                    $loanPaymentTempEML = $rowLP['amount'];
                    $loanPaymentEMLT = $loanPaymentEMLT + $loanPaymentTempEML;
                }
            }
        }
        
        $loanReceivablesEML = $loanReceivablesEMLT - $loanPaymentEMLT;
    }

    //RL
    $sqlbi = "SELECT * FROM  rl_loan_table WHERE loan_status = 'Released' ";
    $resultbi = $conn->query($sqlbi);

    $loanReceivablesRLT = 0;
    $loanPaymentRLT = 0;
    $loanReceivablesRL = 0;

    if($resultbi->num_rows > 0){
        while ($row = mysqli_fetch_array($resultbi)) {
            # code...
            $loanReceivablesTempRL = $row['loan_amount'];
            $loanApplicationNumberRL = $row['loan_application_number'];

            $loanReceivablesRLT = $loanReceivablesRLT + $loanReceivablesTempRL;

            $sqlLP = "SELECT * FROM  rl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberRL' and date_payment <= '$endDate' ";
            $resultLP = $conn->query($sqlLP);

            if($resultLP->num_rows > 0){
                while ($rowLP = mysqli_fetch_array($resultLP)) {
                    $loanPaymentTempRL = $rowLP['amount'];
                    $loanPaymentRLT = $loanPaymentRLT + $loanPaymentTempRL;
                }
            }
        }
        
        $loanReceivablesRL = $loanReceivablesRLT - $loanPaymentRLT;
    }

    //SL
    $sqlbi = "SELECT * FROM  sl_loan_table WHERE loan_status = 'Released' ";
    $resultbi = $conn->query($sqlbi);

    $loanReceivablesSLT = 0;
    $loanPaymentSLT = 0;
    $loanReceivablesSL = 0;

    if($resultbi->num_rows > 0){
        while ($row = mysqli_fetch_array($resultbi)) {
            # code...
            $loanReceivablesTempSL = $row['loan_amount'];
            $loanApplicationNumberSL = $row['loan_application_number'];

            $loanReceivablesSLT = $loanReceivablesSLT + $loanReceivablesTempSL;

            $sqlLP = "SELECT * FROM  sl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberSL' and date_payment <= '$endDate' ";
            $resultLP = $conn->query($sqlLP);

            if($resultLP->num_rows > 0){
                while ($rowLP = mysqli_fetch_array($resultLP)) {
                    $loanPaymentTempSL = $rowLP['amount'];
                    $loanPaymentSLT = $loanPaymentSLT + $loanPaymentTempSL;
                }
            }
        }
        
        $loanReceivablesSL = $loanReceivablesSLT - $loanPaymentSLT;
    }

    //PL
    $sqlbi = "SELECT * FROM  pl_loan_table WHERE loan_status = 'Released' ";
    $resultbi = $conn->query($sqlbi);

    $loanReceivablesPLT = 0;
    $loanPaymentPLT = 0;
    $loanReceivablesPL = 0;

    if($resultbi->num_rows > 0){
        while ($row = mysqli_fetch_array($resultbi)) {
            # code...
            $loanReceivablesTempPL = $row['loan_amount'];
            $loanApplicationNumberPL = $row['loan_application_number'];

            $loanReceivablesPLT = $loanReceivablesPLT + $loanReceivablesTempPL;

            $sqlLP = "SELECT * FROM  pl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberPL' and date_payment <= '$endDate' ";
            $resultLP = $conn->query($sqlLP);

            if($resultLP->num_rows > 0){
                while ($rowLP = mysqli_fetch_array($resultLP)) {
                    $loanPaymentTempPL = $rowLP['amount'];
                    $loanPaymentPLT = $loanPaymentPLT + $loanPaymentTempPL;
                }
            }
        }
        
        $loanReceivablesPL = $loanReceivablesPLT - $loanPaymentPLT;
    }*/
    //TOTAL LOAN RECIEVABLES
    $totalLoanReceivables = $loanReceivablesBL + $loanReceivablesCKL + $loanReceivablesCLL + $loanReceivablesCL + $loanReceivablesEDL + $loanReceivablesEML + $loanReceivablesRL + $loanReceivablesSL + $loanReceivablesPL;
    

    //Rice Loan
    $sqlbi = "SELECT * FROM  rice_loan_table WHERE loan_status = 'Released' ";
    $resultbi = $conn->query($sqlbi);

    $loanReceivablesRCLT = 0;
    $loanPaymentRCLT = 0;
    $loanReceivablesRCL = 0;
    $loanInterestRCLT = 0;

    if($resultbi->num_rows > 0){
        while ($row = mysqli_fetch_array($resultbi)) {
            # code...
            $loanReceivablesTempRCL = $row['loan_amount'];
            $loanApplicationNumberRCL = $row['loan_application_number'];

            $loanReceivablesRCLT = $loanReceivablesRCLT + $loanReceivablesTempRCL;

            $sqlLP = "SELECT * FROM  rice_loan_payment_table WHERE loan_application_number = '$loanApplicationNumberRCL' and date_payment <= '$endDate' ";
            $resultLP = $conn->query($sqlLP);

            if($resultLP->num_rows > 0){
                while ($rowLP = mysqli_fetch_array($resultLP)) {
                    $loanPaymentTempRCL = $rowLP['amount'];
                    $loanPaymentRCLT = $loanPaymentRCLT + $loanPaymentTempRCL;
                }
            }

            $sqlLP = "SELECT * FROM  rice_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumberRCL' and date_transaction <= '$endDate' ";
            $resultLP = $conn->query($sqlLP);

            if($resultLP->num_rows > 0){
                while ($rowLP = mysqli_fetch_array($resultLP)) {
                    $loanInterestTempRCL = $rowLP['interest_revenue'];
                    $loanInterestRCLT = $loanInterestRCLT + $loanInterestTempRCL;
                }
            }
        }
        
        $loanReceivablesRCL = $loanReceivablesRCLT - ($loanPaymentRCLT + $loanInterestRCLT);

        if($printReport == "printReport"){
            $pdf = new FPDF();
            $pdf->SetFont('Arial','B',8);
            $pdf->AddPage('P','Legal', 0);

            //Title
            $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
            $pdf->Cell(100,7,"Statement of Financial Condition");$pdf->Ln();
            $pdf->Cell(30,7,"From");
            $pdf->Cell(30,7,"$startDate");$pdf->Ln();
            $pdf->Cell(30,7,"To");
            $pdf->Cell(30,7,"$endDate");$pdf->Ln();

            $pdf->Cell(85,7,"");
            $pdf->Cell(40,7,"ASSETS");
            $pdf->Ln();

            $pdf->Cell(95,7,"CURRENT ASSET");
            $pdf->Ln();

            $pdf->Cell(95,7,"Petty Cash Fund-Lending");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Petty Cash Fund-Trading");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Revolving Fund GC");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Cash on hand");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Cash in Bank RBPI-CA 60257-9");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Cash in Bank RBPI-CA 60257-3");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Savings SAKOMI");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Loan Receivable (lending)");
            $pdf->Cell(40,7,number_format($totalLoanReceivables,'2','.',','),1);
            $pdf->Cell(40,7,"");
            $pdf->Ln();

            $pdf->Cell(95,7,"Loan Receivable (lending)");
            $pdf->Cell(40,7,number_format($totalAL,'2','.',','),1);
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Accounts Receivables (Trade)");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,number_format($loanReceivablesRCL,'2','.',','),1);
            $pdf->Ln();

            $pdf->Cell(95,7,"Accounts Receivables (Others)");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Accounts Receivables (Others)");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Advances for Liquidation");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Prepaid Insurance");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Unused Office Supply");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Merchandise Inventory");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"TOTAL CURRENT ASSET");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"NON CURRENT ASSET");
            $pdf->Ln();

            $pdf->Cell(95,7,"Other Funds and Deposits");
            $pdf->Ln();

            $pdf->Cell(95,7,"Landbank of the Phils.-SA");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Investment in Non Marketable Equity Securities");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Bataan Coop Bank");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"SAKOMI Federation of Cooperatives");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Bataan Credit Surety Fund");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"TOTAL NON-CURRENT ASSET");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"PROPERTY AND EQUIPMENT");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Building and Improvements");
            $pdf->Cell(40,7,"TBD");
            $pdf->Cell(40,7,"");
            $pdf->Ln();

            $pdf->Cell(95,7,"Less Accumulated Depreciation");
            $pdf->Cell(40,7,"TBD");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Office Furniture and Fixtures");
            $pdf->Cell(40,7,"TBD");
            $pdf->Cell(40,7,"");
            $pdf->Ln();

            $pdf->Cell(95,7,"Less Accumulated Depreciation");
            $pdf->Cell(40,7,"TBD");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Office Equipment");
            $pdf->Cell(40,7,"TBD");
            $pdf->Cell(40,7,"");
            $pdf->Ln();

            $pdf->Cell(95,7,"Less Accumulated Depreciation");
            $pdf->Cell(40,7,"TBD");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"TOTAL PROPERTY AND EQUIPMENT");
            $pdf->Cell(40,7,"TBD");
            $pdf->Cell(40,7,"");
            $pdf->Ln();

            $pdf->Cell(95,7,"TOTAL ASSETS");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();
                
            $pdf->AddPage('P','Legal', 0);

            $pdf->Cell(85,7,"");
            $pdf->Cell(40,7,"LIABILITIES AND MEMBERS EQUITY");
            $pdf->Ln();

            $pdf->Cell(95,7,"CURRENT LIABILITIES");
            $pdf->Ln();

            $pdf->Cell(95,7,"Accrued Expenses");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Accounts Payable");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Loans Payable SAKOMI");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Loans Payable MWF");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Insurance Premium Payable");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Time Deposit");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Interest Payable Time Deposit");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Fixed Deposits");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Savings Deposits");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Interest on Share Capital Payable");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Patronage Refund Payable");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"SSS Philhealth and Pag-ibig Refund Payable");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Expanded Withholding Tax Payable");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Due to Federation/Union");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"TOTAL CURRENT LIABILITIES");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"NON-CURRENT LIABILITIES");
            $pdf->Ln();

            $pdf->Cell(95,7,"Retirement Benefit Fund");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Members Benefit Fund");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"CGF");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"TOTAL NON-CURRENT LIABILITIES");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"TOTAL CURRENT AND NON-CURRENT LIABILITIES");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"MEMBERS EQUITY");
            $pdf->Ln();

            $pdf->Cell(95,7,"Common Share");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Preffered Share");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"Deposit for Future Subscription");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"UNDIVIDED NET SURPLUS 2017");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"STATUTORY FUNDS");
            $pdf->Ln();

            $pdf->Cell(95,7,"General Reserved Fund");
            $pdf->Cell(40,7,"TBD");
            $pdf->Cell(40,7,"");
            $pdf->Ln();

            $pdf->Cell(95,7,"Education and Training Fund");
            $pdf->Cell(40,7,"TBD");
            $pdf->Cell(40,7,"");
            $pdf->Ln();

            $pdf->Cell(95,7,"Optional Fund");
            $pdf->Cell(40,7,"TBD");
            $pdf->Cell(40,7,"");
            $pdf->Ln();

            $pdf->Cell(95,7,"Community Development Fund");
            $pdf->Cell(40,7,"TBD");
            $pdf->Cell(40,7,"");
            $pdf->Ln();

            $pdf->Cell(95,7,"TOTAL STATURORY FUND");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"TOTAL MEMBERS EQUITY");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Cell(95,7,"TOTAL LIABILITIES AND MEMBERS EQUITY");
            $pdf->Cell(40,7,"");
            $pdf->Cell(40,7,"TBD");
            $pdf->Ln();

            $pdf->Output();
        }
    }

    //echo "$loanReceivablesRLT ";

    //echo "$loanPaymentPLT ";

    //echo "$loanReceivablesRCL ";

    echo "$loanReceivablesRCL";
}
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<html lang="en">
<head>
    <?php include "css.html" ?>
    <title>Statement of Financial Condition</title>

</head>


<body>
    <div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div>
        <?php //include 'topbar.php';?>
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-12" style="margin-top:25px;margin-left: 16.7%;margin-bottom: 100px; position: absolute;width: 80%">
              <h5 align="margin-left">GENERATE STATEMENT OF FINANCIAL CONDITION</h5>
              <div class="col-lg-12">
                  <p align="center"><span style="color: red"><?php echo $infomessage;?></span></p>
              <br>

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
                            <button class="btn btn-outline-success my-2 my-sm-0" name = "generateReport" value = "generateReport" type="submit" style="align-self: center;">GENERATE</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 form">
                            <button class="btn btn-outline-success my-2 my-sm-0" name = "printReport" value = "printReport" type="submit" style="align-self: center;">PRINT</button>
                        </div>
                    </div>
              </div>
              
              <div class="table table-striped table-hover">
                <?php

                echo "<table>
                <tr>
                    <th>ASSETS</th>
                    <th></th>
                    <th></th>     
                </tr>";
                

                //
                echo "
                <tr>
                    <td>CURRENT ASSETS</td>
                    <td></td>
                    <td></td>  
                </tr>";

                echo "<tr>";
                    echo "<td>" ."Petty Cash Fund-Lending:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Petty Cash Fund-Lending:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Revolving Fund GC:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Cash on hand:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Cash in Bank RBPI-CA 60257-9:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Cash in Bank RBPI-CA 60257-3:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Savings SAKOMI:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Loan Receivable (lending):" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLoanReceivables . " " . "name=" . "totalLoanReceivables" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Less Allowance for Probable Loss:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalAL . " " . "name=" . "totalAL" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Accounts Receivables (Trade):" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $loanReceivablesRCL . " " . "name=" . "loanReceivablesRCL" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Accounts Receivables (Others):" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Advances for Liquidation:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Prepaid Insurance:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Unused Office Supply:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Merchandise Inventory:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>" ."TOTAL CURRENT ASSET:" . "</th>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."NON CURRENT ASSET:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Other Funds and Deposits:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Landbank of the Phils.-SA:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLP . " " . "name=" . "totalLP" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Investment in Non Marketable Equity Securities:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Bataan Coop Bank:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalBB . " " . "name=" . "totalBB" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."SAKOMI Federation of Cooperatives:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalSK . " " . "name=" . "totalSK" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Bataan Credit Surety Fund:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalBS . " " . "name=" . "totalBS" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>" ."TOTAL NON-CURRENT ASSET:" . "</th>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalDE . " " . "name=" . "totalOE" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."PROPERTY AND EQUIPMENT:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Building and Improvements:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalBI . " " . "name=" . "totalBI" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Less Accumulated Depreciation:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalDB . " " . "name=" . "totalDB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Office Furniture and Fixtures:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalFF . " " . "name=" . "totalFF" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Less Accumulated Depreciation:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalDO . " " . "name=" . "totalDO" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Office Equipment:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalOE . " " . "name=" . "totalOE" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Less Accumulated Depreciation:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalDE . " " . "name=" . "totalOE" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";
                
                echo "<tr>";
                    echo "<th>" ."TOTAL PROPERTY AND EQUIPMENT:" . "</th>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>" ."TOTAL ASSETS:" . "</th>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<br>";
                echo "<br>";

                echo "<tr>";
                    echo "<th>" ."LIABILITIES AND MEMBERS EQUITY:" . "</th>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."CURRENT LIABILITIES:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Accrued Expenses:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Accounts Payable:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Loans Payable SAKOMI:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Loans Payable MWF:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Insurance Premium Payable:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Time Deposit:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTimeDeposit . " " . "name=" . "totalTimeDeposit" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Interest Payable Time Deposit:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Fixed Deposits:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalFixedDeposit . " " . "name=" . "totalFixedDeposit" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Savings Deposits:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalSavings . " " . "name=" . "totalSavings" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Interest on Share Capital Payable:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Patronage Refund Payable:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."SSS Philhealth and Pag-ibig Refund Payable:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Expanded Withholding Tax Payable:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Due to Federation/Union:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>" ."TOTAL CURRENT LIABILITIES:" . "</th>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Retirement Benefit Fund:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Members Benefit Fund:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>" ."TOTAL NON CURRENT LIABILITIES:" . "</th>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."MEMBERS EQUITY:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Common Share:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalCS . " " . "name=" . "totalCS" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Preffered Share:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalPS . " " . "name=" . "totalPS" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Deposit for Future Subscription:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalFS . " " . "name=" . "totalFS" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."UNDIVIDED NET SURPLUS:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."STATUTORY FUNDS:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."General Reserved Fund:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalGF . " " . "name=" . "totalSavings" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Education and Training Fund:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalEF . " " . "name=" . "totalSavings" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Optional Fund:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalOP . " " . "name=" . "totalSavings" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Community Development Fund:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalCF . " " . "name=" . "totalSavings" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."TOTAL STATURORY FUND:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" . "TOTAL MEMBERS EQUITY" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<tH>" . "TOTAL LIABILITIES AND MEMBERS EQUITY" . "</tH>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";


                ?>
              </div>
              
        </div>
      </div>
    </form>
  </div>
<script>
  function generateInterest(){
    if(document.getElementById('savingsInterest').value == "generateI"){
      var sic = document.getElementById('savingsInterestC').style.display='block';
    }else{
      var sic = document.getElementById('savingsInterestC').style.display='none';
    }
  }
</script>
</body>
    <?php include "css1.html" ?>
</html>