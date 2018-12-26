
<?php  
require_once 'session.php';
require('public/fpdf181/fpdf.php');

$infomessage = "";
$startDate = "";
$endDate = "";
$generateReport = "";

$riceTotalSaleP = 0;
$riceTotalSaleI = 0;
$riceTotalSaleC = 0;
$riceTotalSale = 0;
$totalRicePurchase = 0;

$totalInterestIncome = 0;
$totalInterestBL = 0;
$totalInterestCKL = 0;
$totalInterestCLL = 0;
$totalInterestCL = 0;
$totalInterestCML = 0;
$totalInterestEDL = 0;
$totalInterestEML = 0;
$totalInterestPL = 0;
$totalInterestRL = 0;
$totalInterestSL = 0;

$totalServiceFeeIncome = 0;
$totalServiceFeeBL = 0;
$totalServiceFeeCKL = 0;
$totalServiceFeeCLL = 0;
$totalServiceFeeCL = 0;
$totalServiceFeeCML = 0;
$totalServiceFeeEDL = 0;
$totalServiceFeeEML = 0;
$totalServiceFeePL = 0;
$totalServiceFeeRL = 0;
$totalServiceFeeSL = 0;

$totalFillingFeeIncome = 0;
$totalFillingFeeBL = 0;
$totalFillingFeeCKL = 0;
$totalFillingFeeCLL = 0;
$totalFillingFeeCL = 0;
$totalFillingFeeCML = 0;
$totalFillingFeeEDL = 0;
$totalFillingFeeEML = 0;
$totalFillingFeePL = 0;
$totalFillingFeeRL = 0;
$totalFillingFeeSL = 0;

$totalTradingPenalty = 0;
$totalLendingPenalty = 0;

//other income
$totalPhtocopyIncome = 0;
$totalMiscellaneousIncome = 0;
$totalMembership = 0;
$totalRent = 0;
$totalTransferFee = 0;

$totalInsuranceFeeIncome = 0;
$totalInsuranceFeeBL = 0;
$totalInsuranceFeeCKL = 0;
$totalInsuranceFeeCLL = 0;
$totalInsuranceFeeCL = 0;
$totalInsuranceFeeCML = 0;
$totalInsuranceFeeEDL = 0;
$totalInsuranceFeeEML = 0;
$totalInsuranceFeePL = 0;
$totalInsuranceFeeRL = 0;
$totalInsuranceFeeSL = 0;
$totalInsuranceFeeCR = 0;

//Expense
$totalTDHA = 0;
$totalLDHA = 0;

$totalTDSW = 0;
$totalLDSW = 0;

$totalTDGB = 0;
$totalLDGB = 0;

$totalTDMB = 0;
$totalLDMB = 0;

$totalTDOB = 0;
$totalLDOB = 0;

$totalTDEB = 0;
$totalLDEB = 0;

$totalTDOS = 0;
$totalLDOS = 0;

$totalTDIS = 0;
$totalLDIS = 0;

$totalTDTT = 0;
$totalLDTT = 0;

$totalTDRN = 0;
$totalLDRN = 0;

$totalTDLW = 0;
$totalLDLW = 0;

$totalTDRT = 0;
$totalLDRT = 0;

$totalTDCM = 0;
$totalLDCM = 0;

$totalTDMC = 0;
$totalLDMC = 0;

$totalTDDE = 0;
$totalLDDE = 0;

$totalTDME = 0;
$totalLDME = 0;

$totalTDPE = 0;
$totalLDPE = 0;

$totalTDTF = 0;
$totalLDTF = 0;

$totalTDAL = 0;
$totalLDAL = 0;

$totalTDRB = 0;
$totalLDRB = 0;

$totalTDGE = 0;
$totalLDGE = 0;

$totalTDRP = 0;
$totalLDRP = 0;

//FINANCING EXPENSE
$totalTDIB = 0;
$totalLDIB = 0;

$totalTDIE = 0;
$totalLDIE = 0;

$totalTDBF = 0;
$totalLDBF = 0;

$totalTDOF = 0;
$totalLDOF = 0;

//$totalTDDE = 0;
//$totalLDDE = 0;

//Journal
$totalIELBP = 0;
$totalIEBCB = 0;
$totalDVBCB = 0;

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

    if (empty($_POST["riceTotalSale"]) && !is_numeric($_POST["riceTotalSale"])) {
        $countErr++;
    }else {
        $riceTotalSale = test_input($_POST["riceTotalSale"]);
    }

    if (empty($_POST["totalInterestIncome"]) && !is_numeric($_POST["totalInterestIncome"])) {
        $countErr++;
    }else {
        $totalInterestIncome = test_input($_POST["totalInterestIncome"]);
    }

    if (empty($_POST["totalFillingFeeIncome"]) && !is_numeric($_POST["totalFillingFeeIncome"])) {
        $countErr++;
    }else {
        $totalFillingFeeIncome = test_input($_POST["totalFillingFeeIncome"]);
    }

    if (empty($_POST["totalInsuranceFeeIncome"]) && !is_numeric($_POST["totalInsuranceFeeIncome"])) {
        $countErr++;
    }else {
        $totalInsuranceFeeIncome = test_input($_POST["totalInsuranceFeeIncome"]);
    }
    /*if (empty($_POST["totalPhtocopyIncome"]) && !is_numeric($_POST["totalPhtocopyIncome"])) {
        $countErr++;
    }else {
        $totalPhtocopyIncome = test_input($_POST["totalPhtocopyIncome"]);
    }

    if (empty($_POST["totalMiscellaneousIncome"]) && !is_numeric($_POST["totalMiscellaneousIncome"])) {
        $countErr++;
    }else {
        $totalMiscellaneousIncome = test_input($_POST["totalMiscellaneousIncome"]);
    }

    if (empty($_POST["totalMembership"]) && !is_numeric($_POST["totalMembership"])) {
        $countErr++;
    }else {
        $totalMembership = test_input($_POST["totalMembership"]);
    }*/

    if($generateReport = "generateReport"){
        if($countErr == 0){

            //Rice Sale P Total
            $sqlName = "SELECT * FROM  rice_loan_payment_table WHERE date_payment >= '$startDate' and date_payment <= '$endDate'  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $riceTotalSalePTempP = $row['amount'];
                    $riceTotalSaleP = $riceTotalSaleP + $riceTotalSalePTempP;
                }
            }

            //Rice Sale I Total
            $sqlName = "SELECT * FROM  rice_credit_revenue_table WHERE date_transaction >= '$startDate' and date_transaction <= '$endDate'  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    //$dateT = $row['date_transaction'];
                    $riceTotalSalePTempI = $row['interest_revenue'];
                    $riceTotalSaleI = $riceTotalSaleI + $riceTotalSalePTempI;

                    //echo "$dateT";
                }
            }



            //Cash Sale
            $sqlName = "SELECT * FROM  rice_cash_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $riceCP = $row['principal_amount'];
                    $riceCI = $row['interest_amount'];

                    $riceTotalSaleCTemp = $riceCP + $riceCI;
                    $riceTotalSaleC = $riceTotalSaleC + $riceTotalSaleCTemp;

                }
            }

            $riceTotalSale =  $riceTotalSaleP + $riceTotalSaleI + $riceTotalSaleC;

            //Rice purchse
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'RA')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalRicePurchaseTemp = $row['amount'];
                    $totalRicePurchase = $totalRicePurchase + $totalRicePurchaseTemp;
                }
            }


            //Interest Income
            $sqlName = "SELECT * FROM  bl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInterestBLTemp = $row['interest_revenue'];
                    $totalInterestBL = $totalInterestBL + $totalInterestBLTemp;

                }
            }

            $sqlName = "SELECT * FROM  ckl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInterestCKLTemp = $row['interest_revenue'];
                    $totalInterestCKL = $totalInterestCKL + $totalInterestCKLTemp;

                }
            }

            $sqlName = "SELECT * FROM  cll_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInterestCLLTemp = $row['interest_revenue'];
                    $totalInterestCLL = $totalInterestCLL + $totalInterestCLLTemp;

                }
            }

            $sqlName = "SELECT * FROM  cl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInterestCLTemp = $row['interest_revenue'];
                    $totalInterestCL = $totalInterestCL + $totalInterestCLTemp;

                }
            }

            $sqlName = "SELECT * FROM  cml_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInterestCMLTemp = $row['interest_revenue'];
                    $totalInterestCML = $totalInterestCML + $totalInterestCMLTemp;

                }
            }


            $sqlName = "SELECT * FROM  edl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInterestEDLTemp = $row['interest_revenue'];
                    $totalInterestEDL = $totalInterestEDL + $totalInterestEDLTemp;

                }
            }

            $sqlName = "SELECT * FROM  eml_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInterestEMLTemp = $row['interest_revenue'];
                    $totalInterestEML = $totalInterestEML + $totalInterestEMLTemp;

                }
            }

            $sqlName = "SELECT * FROM  pl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInterestPLTemp = $row['interest_revenue'];
                    $totalInterestPL = $totalInterestPL + $totalInterestPLTemp;

                }
            }

            $sqlName = "SELECT * FROM  rl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInterestRLTemp = $row['interest_revenue'];
                    $totalInterestRL = $totalInterestRL + $totalInterestRLTemp;

                }
            }

            $sqlName = "SELECT * FROM  sl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInterestSLTemp = $row['interest_revenue'];
                    $totalInterestSL = $totalInterestSL + $totalInterestSLTemp;

                }
            }

            $totalInterestIncome =  $totalInterestBL + $totalInterestCKL + $totalInterestCLL + $totalInterestCL + $totalInterestCML + $totalInterestEDL + $totalInterestEML + $totalInterestPL + $totalInterestRL + $totalInterestSL;

            //SERVICE FEE
            $sqlName = "SELECT * FROM  bl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalServiceFeeTempBL = $row['service_fee'];
                    $totalServiceFeeBL = $totalServiceFeeBL + $totalServiceFeeTempBL;

                }
            }

            $sqlName = "SELECT * FROM  ckl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalServiceFeeTempCKL = $row['service_fee'];
                    $totalServiceFeeCKL = $totalServiceFeeBL + $totalServiceFeeTempCKL;

                }
            }

            $sqlName = "SELECT * FROM  cll_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalServiceFeeTempCLL = $row['service_fee'];
                    $totalServiceFeeCLL = $totalServiceFeeCLL + $totalServiceFeeTempCLL;

                }
            }

            $sqlName = "SELECT * FROM  cl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalServiceFeeTempCL = $row['service_fee'];
                    $totalServiceFeeCL = $totalServiceFeeCL + $totalServiceFeeTempCL;
                }
            }

            $sqlName = "SELECT * FROM  cml_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalServiceFeeTempCML = $row['service_fee'];
                    $totalServiceFeeCML = $totalServiceFeeCML + $totalServiceFeeTempCML;
                }
            }

            $sqlName = "SELECT * FROM  edl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalServiceFeeTempEDL = $row['service_fee'];
                    $totalServiceFeeEDL = $totalServiceFeeEDL + $totalServiceFeeTempEDL;
                }
            }

            $sqlName = "SELECT * FROM  eml_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalServiceFeeTempEML = $row['service_fee'];
                    $totalServiceFeeEML = $totalServiceFeeEML + $totalServiceFeeTempEML;

                }
            }

            $sqlName = "SELECT * FROM  pl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalServiceFeeTempPL = $row['service_fee'];
                    $totalServiceFeePL = $totalServiceFeePL + $totalServiceFeeTempPL;
                }
            }

            $sqlName = "SELECT * FROM  rl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalServiceFeeTempRL = $row['service_fee'];
                    $totalServiceFeeRL = $totalServiceFeeRL + $totalServiceFeeTempRL;
                }
            }

            $sqlName = "SELECT * FROM  sl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalServiceFeeTempSL = $row['service_fee'];
                    $totalServiceFeeSL = $totalServiceFeeSL + $totalServiceFeeTempSL;

                }
            }

            $totalServiceFeeIncome =  $totalServiceFeeBL + $totalServiceFeeCKL + $totalServiceFeeCLL + $totalServiceFeeCL + $totalServiceFeeCML + $totalServiceFeeEDL + $totalServiceFeeEML + $totalServiceFeePL + $totalServiceFeeRL;

            //FILLING FEE
            $sqlName = "SELECT * FROM  bl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalFillingFeeTempBL = $row['filling_fee'];
                    $totalFillingFeeBL = $totalFillingFeeBL + $totalFillingFeeTempBL;

                }
            }

            $sqlName = "SELECT * FROM  ckl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalFillingFeeTempCKL = $row['filling_fee'];
                    $totalFillingFeeCKL = $totalFillingFeeCKL + $totalFillingFeeTempCKL;
                }
            }

            $sqlName = "SELECT * FROM  cll_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalFillingFeeTempCLL = $row['filling_fee'];
                    $totalFillingFeeCLL = $totalFillingFeeCLL + $totalFillingFeeTempCLL;
                }
            }

            $sqlName = "SELECT * FROM  cl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalFillingFeeTempCL = $row['filling_fee'];
                    $totalFillingFeeCL = $totalFillingFeeCL + $totalFillingFeeTempCL;
                }
            }

            $sqlName = "SELECT * FROM  cml_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalFillingFeeTempCML = $row['filling_fee'];
                    $totalFillingFeeCML = $totalFillingFeeCML + $totalFillingFeeTempCML;
                }
            }

            $sqlName = "SELECT * FROM  edl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalFillingFeeTempEDL = $row['filling_fee'];
                    $totalFillingFeeEDL = $totalFillingFeeEDL + $totalFillingFeeTempEDL;
                }
            }

            $sqlName = "SELECT * FROM  eml_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalFillingFeeTempEML = $row['filling_fee'];
                    $totalFillingFeeEML = $totalFillingFeeEML + $totalFillingFeeTempEML;

                }
            }

            $sqlName = "SELECT * FROM  pl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalFillingFeeTempPL = $row['filling_fee'];
                    $totalFillingFeePL = $totalFillingFeePL + $totalFillingFeeTempPL;
                }
            }

            $sqlName = "SELECT * FROM  rl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalFillingFeeTempRL = $row['filling_fee'];
                    $totalFillingFeeRL = $totalFillingFeeRL + $totalFillingFeeTempRL;
                }
            }

            $sqlName = "SELECT * FROM  sl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalFillingFeeTempSL = $row['filling_fee'];
                    $totalFillingFeeSL = $totalFillingFeeSL + $totalFillingFeeTempSL;

                }
            }

            $totalFillingFeeIncome =  $totalFillingFeeBL + $totalFillingFeeCKL + $totalFillingFeeCLL + $totalFillingFeeCL + $totalFillingFeeCML + $totalFillingFeeEDL + $totalFillingFeeEML + $totalFillingFeePL + $totalFillingFeeRL;

            //Trading Penalty
            $sqlName = "SELECT * FROM  other_income_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate') and income_code = 'pnti' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTradingPenaltyTemp = $row['amount'];
                    $totalTradingPenalty = $totalTradingPenalty + $totalTradingPenaltyTemp;

                }
            }

            //Lending Penalty
            $sqlName = "SELECT * FROM  other_income_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate') and income_code = 'plti' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalLendingPenaltyTemp = $row['amount'];
                    $totalLendingPenalty = $totalLendingPenalty + $totalLendingPenaltyTemp;

                }
            }

            //Photocopy
            $sqlName = "SELECT * FROM  other_income_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate') and income_code = 'ptci' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalPhtocopyIncomeTemp = $row['amount'];
                    $totalPhtocopyIncome = $totalPhtocopyIncome + $totalPhtocopyIncomeTemp;

                }
            }

            //Miscellaneous
            $sqlName = "SELECT * FROM  other_income_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate') and income_code = 'msli' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalMiscellaneousIncomeTemp = $row['amount'];
                    $totalMiscellaneousIncome = $totalMiscellaneousIncome + $totalMiscellaneousIncomeTemp;

                }
            }

            //Membership Fee
            $sqlName = "SELECT * FROM  other_income_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate') and income_code = 'mbsi' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalMembershipTemp = $row['amount'];
                    $totalMembership = $totalMembership + $totalMembershipTemp;

                }
            }

            //Transfer Fee
            $sqlName = "SELECT * FROM  other_income_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate') and income_code = 'tffi' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTransferFeeTemp = $row['amount'];
                    $totalTransferFee = $totalTransferFee + $totalTransferFeeTemp;

                }
            }

            //REntal
            $sqlName = "SELECT * FROM  other_income_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate') and income_code = 'rnti' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalRentTemp = $row['amount'];
                    $totalRent = $totalRent + $totalRentTemp;

                }
            }

            //INSURANCE CR
            $sqlName = "SELECT * FROM  other_income_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate') and income_code = 'insi' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInsuranceFeeTempCR = $row['amount'];
                    $totalInsuranceFeeCR = $totalInsuranceFeeCR + $totalInsuranceFeeTempCR;

                }
            }

            //INTERENSE EXPENSE LBP
            $sqlName = "SELECT * FROM  other_income_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate') and income_code = 'ilbp' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempIELBP = $row['amount'];
                    $totalIELBP = $totalIELBP + $totalTempIELBP;

                }
            }

            //INTERENSE EXPENSE BCB
            $sqlName = "SELECT * FROM  other_income_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate') and income_code = 'ibcb' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempIEBCB = $row['amount'];
                    $totalIEBCB = $totalIEBCB + $totalTempIEBCB;

                }
            }

            //DIVIDENDS BCB
            $sqlName = "SELECT * FROM  other_income_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate') and income_code = 'dbcb' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempDVBCB = $row['amount'];
                    $totalDVBCB = $totalDVBCB + $totalTempDVBCB;

                }
            }

            //Insurance Fee DISBURSEMENT
            $sqlName = "SELECT * FROM  bl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInsuranceFeeTempBL = $row['insurance_fee'];
                    $totalInsuranceFeeBL = $totalInsuranceFeeBL + $totalInsuranceFeeTempBL;

                }
            }

            $sqlName = "SELECT * FROM  ckl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInsuranceFeeTempCKL = $row['insurance_fee'];
                    $totalInsuranceFeeCKL = $totalInsuranceFeeCKL + $totalInsuranceFeeTempCKL;

                }
            }

            $sqlName = "SELECT * FROM  cll_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInsuranceFeeTempCKL = $row['insurance_fee'];
                    $totalInsuranceFeeCKL = $totalInsuranceFeeCKL + $totalInsuranceFeeTempCKL;

                }
            }

            $sqlName = "SELECT * FROM  cl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInsuranceFeeTempCL = $row['insurance_fee'];
                    $totalInsuranceFeeCL = $totalInsuranceFeeCL + $totalInsuranceFeeTempCL;

                }
            }

            $sqlName = "SELECT * FROM  cml_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInsuranceFeeTempCL = $row['insurance_fee'];
                    $totalInsuranceFeeCL = $totalInsuranceFeeCL + $totalInsuranceFeeTempCL;

                }
            }


            $sqlName = "SELECT * FROM  edl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInsuranceFeeTempEDL = $row['insurance_fee'];
                    $totalInsuranceFeeEDL = $totalInsuranceFeeEDL + $totalInsuranceFeeTempEDL;
                }
            }

            $sqlName = "SELECT * FROM  eml_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInsuranceFeeTempEML = $row['insurance_fee'];
                    $totalInsuranceFeeEML = $totalInsuranceFeeEML + $totalInsuranceFeeTempEML;
                }
            }

            $sqlName = "SELECT * FROM  pl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInsuranceFeeTempPL = $row['insurance_fee'];
                    $totalInsuranceFeePL = $totalInsuranceFeePL + $totalInsuranceFeeTempPL;
                }
            }

            $sqlName = "SELECT * FROM  rl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInsuranceFeeTempRL = $row['insurance_fee'];
                    $totalInsuranceFeeRL = $totalInsuranceFeeRL + $totalInsuranceFeeTempRL;

                }
            }

            $sqlName = "SELECT * FROM  sl_credit_revenue_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')  ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalInsuranceFeeTempSL = $row['insurance_fee'];
                    $totalInsuranceFeeSL = $totalInsuranceFeeSL + $totalInsuranceFeeTempSL;
                }
            }

            $totalInsuranceFeeIncome =  $totalInsuranceFeeBL + $totalInsuranceFeeCKL + $totalInsuranceFeeCLL + $totalInsuranceFeeCL + $totalInsuranceFeeCML + $totalInsuranceFeeEDL + $totalInsuranceFeeEML + $totalInsuranceFeePL + $totalInsuranceFeeRL + $totalInsuranceFeeSL + $totalInsuranceFeeCR;

            //ADMINISTRAT EXPENSES
            //Office honorarium
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'HA' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDHA = $row['amount'];
                    $totalTDHA = $totalTDHA + $totalTempTDHA;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'HA' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDHA = $row['amount'];
                    $totalLDHA = $totalLDHA + $totalTempLDHA;
                }
            }

            //Salaries and Wages
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'SW' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDSW = $row['amount'];
                    $totalTDSW = $totalTDSW + $totalTempTDSW;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'SW' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDSW = $row['amount'];
                    $totalLDSW = $totalLDSW + $totalTempLDSW;
                }
            }

            //SSS PAGIBIG PHILHEALTH
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'GB' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDGB = $row['amount'];
                    $totalTDGB = $totalTDGB + $totalTempTDGB;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'GB' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDGB = $row['amount'];
                    $totalLDGB = $totalLDGB + $totalTempLDGB;
                }
            }

            //MEMBERS BENEFIT
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'MB' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDMB = $row['amount'];
                    $totalTDMB = $totalTDMB + $totalTempTDMB;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'MB' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDMB = $row['amount'];
                    $totalLDMB = $totalLDMB + $totalTempLDMB;
                }
            }

            //OFFICERS BENEFIT
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'OB' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDOB = $row['amount'];
                    $totalTDOB = $totalTDOB + $totalTempTDOB;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'OB' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDOB = $row['amount'];
                    $totalLDOB = $totalLDOB + $totalTempLDOB;
                }
            }
            
            //EMPLOYESS BENEFIT
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'EB' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDEB = $row['amount'];
                    $totalTDEB = $totalTDEB + $totalTempTDEB;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'EB' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDEB = $row['amount'];
                    $totalLDEB = $totalLDEB + $totalTempLDEB;
                }
            }

            //OFFICE SUPPLIES
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'OS' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDOS = $row['amount'];
                    $totalTDOS = $totalTDOS + $totalTempTDOS;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'OS' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDOS = $row['amount'];
                    $totalLDOS = $totalLDOS + $totalTempLDOS;
                }
            }

            //OFFICE SUPPLIES
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'OS' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDOS = $row['amount'];
                    $totalTDOS = $totalTDOS + $totalTempTDOS;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'OS' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDOS = $row['amount'];
                    $totalLDOS = $totalLDOS + $totalTempLDOS;
                }
            }

            //INSURANCE
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'IS' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDIS = $row['amount'];
                    $totalTDIS = $totalTDIS + $totalTempTDIS;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'IS' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDIS = $row['amount'];
                    $totalLDIS = $totalLDIS + $totalTempLDIS;
                }
            }

            //TRAVEL
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'TT' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDTT = $row['amount'];
                    $totalTDTT = $totalTDTT + $totalTempTDTT;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'TT' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDTT = $row['amount'];
                    $totalLDTT = $totalLDTT + $totalTempLDTT;
                }
            }

            //REPRESENTATION ENTAERTAINMENT
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'RN' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDRN = $row['amount'];
                    $totalTDRN = $totalTDRN + $totalTempTDRN;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'RN' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDRN = $row['amount'];
                    $totalLDRN = $totalLDRN + $totalTempLDRN;
                }
            }

            //LIGHT POWER
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'LW' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDLW = $row['amount'];
                    $totalTDLW = $totalTDLW + $totalTempTDLW;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'LW' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDLW = $row['amount'];
                    $totalLDLW = $totalLDLW + $totalTempLDLW;
                }
            }

            //RENT
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'RT' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDRT = $row['amount'];
                    $totalTDRT = $totalTDRT + $totalTempTDRT;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'RT' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDRT = $row['amount'];
                    $totalLDRT = $totalLDRT + $totalTempLDRT;
                }
            }

            //TELECCOMUN
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'CM' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDCM = $row['amount'];
                    $totalTDCM = $totalTDCM + $totalTempTDCM;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'CM' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDCM = $row['amount'];
                    $totalLDCM = $totalLDCM + $totalTempLDCM;
                }
            }

            //MEETING CONF
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'MC' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDMC = $row['amount'];
                    $totalTDMC = $totalTDMC + $totalTempTDMC;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'MC' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDMC = $row['amount'];
                    $totalLDMC = $totalLDMC + $totalTempLDMC;
                }
            }

            //DEPRECIATION EXPENSE
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'DB' or expenses_category = 'DO' or expenses_category = 'DE') and account_expense = 'td' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDDE = $row['amount'];
                    $totalTDDE = $totalTDDE + $totalTempTDDE;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'DB' or expenses_category = 'DO' or expenses_category = 'DE') and account_expense = 'ld' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDDE = $row['amount'];
                    $totalLDDE = $totalLDDE + $totalTempLDDE;
                }
            }

            //MISCELLANEOUS EXPENSE
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'ME' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDME = $row['amount'];
                    $totalTDME = $totalTDME + $totalTempTDME;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'ME' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDME = $row['amount'];
                    $totalLDME = $totalLDME + $totalTempLDME;
                }
            }

            //REPAIRS 
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'RP' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDRP = $row['amount'];
                    $totalTDRP = $totalTDRP + $totalTempTDRP;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'RP' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDRP = $row['amount'];
                    $totalLDRP = $totalLDRP + $totalTempLDRP;
                }
            }

            //PROMOTIONAL EXPENSE
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'PE' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDPE = $row['amount'];
                    $totalTDPE = $totalTDPE + $totalTempTDPE;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'PE' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDPE = $row['amount'];
                    $totalLDPE = $totalLDPE + $totalTempLDPE;
                }
            }

            //TAXES AND LISNCES
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'TF' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDTF = $row['amount'];
                    $totalTDTF = $totalTDTF + $totalTempTDTF;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'TF' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDTF = $row['amount'];
                    $totalLDTF = $totalLDTF + $totalTempLDTF;
                }
            }

            //ALLOWANCE PROBABLE LOSS
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'AL' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDAL = $row['amount'];
                    $totalTDAL = $totalTDAL + $totalTempTDAL;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'AL' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDAL = $row['amount'];
                    $totalLDAL = $totalLDAL + $totalTempLDAL;
                }
            }

            //RETIREMENT BENEFIT
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'RB' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDRB = $row['amount'];
                    $totalTDRB = $totalTDRB + $totalTempTDRB;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'RB' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDRB = $row['amount'];
                    $totalLDRB = $totalLDRB + $totalTempLDRB;
                }
            }

            //GENERAL ASSEMBLY
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'GE' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDGE = $row['amount'];
                    $totalTDGE = $totalTDGE + $totalTempTDGE;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'GE' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDGE = $row['amount'];
                    $totalLDGE = $totalLDGE + $totalTempLDGE;
                }
            }

            //FINANCING EXP
            //INTEREST EXP DEP
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'IE' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDIE = $row['amount'];
                    $totalTDIE = $totalTDIE + $totalTempTDIE;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'IE' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDIE = $row['amount'];
                    $totalLDIE = $totalLDIE + $totalTempLDIE;
                }
            }

            //INTEREST EXP BORRW
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'IB' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDIB = $row['amount'];
                    $totalTDIB = $totalTDIB + $totalTempTDIB;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'IB' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDIB = $row['amount'];
                    $totalLDIB = $totalLDIB + $totalTempLDIB;
                }
            }

            //BANK CHARGES
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'BF' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDBF = $row['amount'];
                    $totalTDBF = $totalTDBF + $totalTempTDBF;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'BF' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDBF = $row['amount'];
                    $totalLDBF = $totalLDBF + $totalTempLDBF;
                }
            }

            //OTHER FINANCING EXP
            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'OF' and account_expense = 'td')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempTDOF = $row['amount'];
                    $totalTDOF = $totalTDOF + $totalTempTDOF;
                }
            }

            $sqlName = "SELECT * FROM  expenses_table WHERE (date_transaction >= '$startDate' and date_transaction <= '$endDate')   and (expenses_category = 'OF' and account_expense = 'ld')";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $totalTempLDOF = $row['amount'];
                    $totalLDOF = $totalLDOF + $totalTempLDOF;
                }
            }


            //Get Beginning Balance
            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40310' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $SLBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40110' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $MVBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '51110' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $RABeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40110' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $interestIncomeBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40120' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $serviceFeeBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40130' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $fillingFeeBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40140' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $penaltyBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73270' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $HABeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73210' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $SWBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73240' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $GBBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73620' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $MBBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73621' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $OBBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73622' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $EBBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73370' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $OSBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73430' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $ISBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73420' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $TTBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73480' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $RNBeg = $row['beginning_balance'];
                }
            }
    
            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73410' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $LWBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73450' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $RTBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73470' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $CMBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73380' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $MCBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73380' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $MCBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73530' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $DPBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73520' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $MEBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73440' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $RPBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '72180' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $PEBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73460' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $TFBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73560' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $ALBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73250' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $RBBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73610' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $GEBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '71200' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $IEBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '71100' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $IBBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73600' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $BFBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '71300' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $OFBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40401' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $ptciBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40401' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $ptciBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40450' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $msliBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '73620' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $mbsiBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40402' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $rntiBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40411' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $ibcbBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40410' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $ilbpBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40412' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $dbcbBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40403' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $insiBeg = $row['beginning_balance'];
                }
            }

            $sqlName = "SELECT * FROM  chart_accounts WHERE account_code = '40404' ";
            $resultName = $conn->query($sqlName);

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    $tffiBeg = $row['beginning_balance'];
                }
            }

            if($printReport == "printReport"){
                $rowCounter = 0;

                $pdf = new FPDF();
                $pdf->SetFont('Arial','B',8);
                $pdf->AddPage('P','Legal', 0);

                //Title
                $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
                $pdf->Cell(100,7,"Statement of Operation");$pdf->Ln();
                $pdf->Cell(30,7,"From");
                $pdf->Cell(30,7,"$startDate");$pdf->Ln();
                $pdf->Cell(30,7,"To");
                $pdf->Cell(30,7,"$endDate");$pdf->Ln();

                //<th>REVENUES</th>
                //<th></th>
                //<th>TRADING</th>
                //<th>LENDING</th>
                //<th>TOTAL</th>
                //<th>MONTH TO DATE</th>  
                //Header
                $pdf->Cell(55,7,"REVENUES:");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"TRADING");
                $pdf->Cell(30,7,"LENDING");
                $pdf->Cell(30,7,"TOTAL");
                $pdf->Cell(30,7,"MONTH TO DATE");
                $pdf->Ln();

                //TRADING
                $pdf->Cell(30,7,"TRADING:");
                $pdf->Ln();
                $pdf->Cell(55,7,"Sales:");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($riceTotalSale,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($riceTotalSale,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(30,7,"Less: Cost of Sales:");
                $pdf->Cell(45,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Merchandise Inv., Beg.");
                $pdf->Cell(30,7,"total");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Add: Purchases");
                $pdf->Cell(30,7,number_format($totalRicePurchase,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Total Good Available for Sale");
                $pdf->Cell(30,7,"total");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Less Merchandise Inventory, End");
                $pdf->Cell(30,7,"total");
                $pdf->Cell(30,7,"total");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"total");
                $pdf->Cell(30,7,"total");
                $pdf->Ln();

                $pdf->Cell(55,7,"Gross Income from Sales");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"total",1);
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"total",1);
                $pdf->Cell(30,7,"total",1);
                $pdf->Ln();

                $pdf->Cell(55,7,"CREDIT OPERATION");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Interest Income from Loans");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalInterestIncome,'2','.',','));
                $pdf->Cell(30,7,number_format($totalInterestIncome,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Service Fees");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalServiceFeeIncome,'2','.',','));
                $pdf->Cell(30,7,number_format($totalServiceFeeIncome,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Filling Fees");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalFillingFeeIncome,'2','.',','));
                $pdf->Cell(30,7,number_format($totalFillingFeeIncome,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Penalties, Fines and Surcharges");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTradingPenalty,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLendingPenalty,'2','.',','));
                $totalPenalty = $totalTradingPenalty + $totalLendingPenalty;
                $pdf->Cell(30,7,number_format($totalPenalty,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"TOTAL");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"GROSS REVENUE");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"",1);
                $pdf->Cell(30,7,"",1);
                $pdf->Cell(30,7,"",1);
                $pdf->Cell(30,7,"",1);
                $pdf->Ln();

                $pdf->Cell(55,7,"Less: Administrative Expenses:");
                $pdf->Ln();

                $pdf->Cell(55,7,"Officers honorarium and Allowances");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDHA,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDHA,'2','.',','));
                $totalHA = $totalTDHA + $totalLDHA;
                $pdf->Cell(30,7,number_format($totalHA,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Salaries and Wages");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDSW,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDSW,'2','.',','));
                $totalSW = $totalTDSW + $totalLDSW;
                $pdf->Cell(30,7,number_format($totalSW,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"SSS Philhealth ECC Pag-ibig Premium");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDGB,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDGB,'2','.',','));
                $totalGB = $totalTDGB + $totalLDGB;
                $pdf->Cell(30,7,number_format($totalGB,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Members Benefit");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDMB,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDMB,'2','.',','));
                $totalMB = $totalTDGB + $totalLDMB;
                $pdf->Cell(30,7,number_format($totalMB,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Officers Benefit");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDOB,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDOB,'2','.',','));
                $totalOB = $totalTDOB + $totalLDOB;
                $pdf->Cell(30,7,number_format($totalOB,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Employess Benefit");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDEB,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDEB,'2','.',','));
                $totalEB = $totalTDEB + $totalLDEB;
                $pdf->Cell(30,7,number_format($totalEB,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Office Supplies");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDOS,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDOS,'2','.',','));
                $totalOS = $totalTDOS + $totalLDOS;
                $pdf->Cell(30,7,number_format($totalOS,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Insurance Expense");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDIS,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDIS,'2','.',','));
                $totalIS = $totalTDIS + $totalLDIS;
                $pdf->Cell(30,7,number_format($totalIS,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Transportation and Travel");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDTT,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDTT,'2','.',','));
                $totalTT = $totalTDTT + $totalLDTT;
                $pdf->Cell(30,7,number_format($totalTT,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Representation and Entertainment");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDRN,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDRN,'2','.',','));
                $totalRN = $totalTDRN + $totalLDRN;
                $pdf->Cell(30,7,number_format($totalRN,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Power Light and Water");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDLW,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDLW,'2','.',','));
                $totalLW = $totalTDLW + $totalLDLW;
                $pdf->Cell(30,7,number_format($totalLW,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Power Light and Water");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDRT,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDRT,'2','.',','));
                $totalRT = $totalTDRT + $totalLDRT;
                $pdf->Cell(30,7,number_format($totalRT,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Telecommunications");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDCM,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDCM,'2','.',','));
                $totalCM = $totalTDCM + $totalLDCM;
                $pdf->Cell(30,7,number_format($totalCM,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Meeting and Conference");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDMC,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDMC,'2','.',','));
                $totalMC = $totalTDMC + $totalLDMC;
                $pdf->Cell(30,7,number_format($totalMC,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Depreciation Expense");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDDE,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDDE,'2','.',','));
                $totalDE = $totalTDDE + $totalLDDE;
                $pdf->Cell(30,7,number_format($totalDE,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Miscellaneous Expense");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDME,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDME,'2','.',','));
                $totalME = $totalTDME + $totalLDME;
                $pdf->Cell(30,7,number_format($totalME,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Miscellaneous Expense");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDME,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDME,'2','.',','));
                $totalME = $totalTDME + $totalLDME;
                $pdf->Cell(30,7,number_format($totalME,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Repairs and Maintenance");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDRP,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDRP,'2','.',','));
                $totalRP = $totalTDRP + $totalLDRP;
                $pdf->Cell(30,7,number_format($totalRP,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();


                $pdf->Cell(55,7,"Repairs and Maintenance");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDPE,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDPE,'2','.',','));
                $totalPE = $totalTDPE + $totalLDPE;
                $pdf->Cell(30,7,number_format($totalPE,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Taxes and Liscences");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDTF,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDTF,'2','.',','));
                $totalTF = $totalTDTF + $totalLDTF;
                $pdf->Cell(30,7,number_format($totalTF,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Allowance for Probable Loss");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDAL,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDAL,'2','.',','));
                $totalAL = $totalTDAL + $totalLDAL;
                $pdf->Cell(30,7,number_format($totalAL,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Retirement Benefit Fund");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDRB,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDRB,'2','.',','));
                $totalRB = $totalTDRB + $totalLDRB;
                $pdf->Cell(30,7,number_format($totalRB,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"General Assembly Meeting and Expenses");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDRB,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDRB,'2','.',','));
                $totalRB = $totalTDRB + $totalLDRB;
                $pdf->Cell(30,7,number_format($totalRB,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"General Assembly Meeting and Expenses");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDGE,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDGE,'2','.',','));
                $totalGE = $totalTDGE + $totalLDGE;
                $pdf->Cell(30,7,number_format($totalGE,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();


                //Expense

                $totalTradingExpensesAE = $totalTDHA + $totalTDSW + $totalTDGB + $totalTDMB + $totalTDOB + $totalTDEB + $totalTDOS + $totalTDIS + $totalTDTT + $totalTDRN + $totalTDLW + $totalTDRT + $totalTDCM + $totalTDMC + $totalTDDE + $totalTDME + $totalTDPE + $totalTDTF + $totalTDAL + $totalTDRB + $totalTDGE + $totalTDRP;

                $totalLendingExpensesAE = $totalLDHA + $totalLDSW + $totalLDGB + $totalLDMB + $totalLDOB + $totalLDEB + $totalLDOS + $totalLDIS + $totalLDTT + $totalLDRN + $totalLDLW + $totalLDRT + $totalLDCM + $totalLDMC + $totalLDDE + $totalLDME + $totalLDPE + $totalLDTF + $totalLDAL + $totalLDRB + $totalLDGE + $totalLDRP;

                $totalAE = $totalTradingExpensesAE + $totalLendingExpensesAE;

                $pdf->Cell(55,7,"TOTAL ADMINISTRATIVE EXPENSES");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTradingExpensesAE,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLendingExpensesAE,'2','.',','));
                $pdf->Cell(30,7,number_format($totalAE,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"FINANCING EXPENSE");
                $pdf->Ln();

                $pdf->Cell(55,7,"Interest Expense on Deposits Liabilities");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDIE,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDIE,'2','.',','));
                $totalIE = $totalTDIE + $totalLDIE;
                $pdf->Cell(30,7,number_format($totalIE,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Interest Expense on Borrowings");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDIB,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDIB,'2','.',','));
                $totalIB = $totalTDIB + $totalLDIB;
                $pdf->Cell(30,7,number_format($totalIB,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Bank Charges");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDBF,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDBF,'2','.',','));
                $totalBF = $totalTDBF + $totalLDBF;
                $pdf->Cell(30,7,number_format($totalBF,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Other Financing Charges");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDOF,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLDOF,'2','.',','));
                $totalOF = $totalTDOF + $totalLDOF;
                $pdf->Cell(30,7,number_format($totalOF,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();


                $totalTradingExpensesFC = $totalTDIE + $totalTDIB + $totalTDBF + $totalTDOF;
                $totalLendingExpensesFC = $totalLDIE + $totalLDIB + $totalLDBF + $totalTDOF;

                $totalFC = $totalLendingExpensesFC + $totalTradingExpensesFC;

                $pdf->Cell(55,7,"TOTAL FINANCIAL COST");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTradingExpensesFC,'2','.',','));
                $pdf->Cell(30,7,number_format($totalLendingExpensesFC,'2','.',','));
                $pdf->Cell(30,7,number_format($totalFC,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $totalTDAEFC = $totalTradingExpensesAE + $totalTradingExpensesFC;
                $totalTLAEFC = $totalLendingExpensesAE + $totalLendingExpensesFC;
                $totalAEFC = $totalTDAEFC + $totalTLAEFC;

                $pdf->Cell(55,7,"TOTAL ADMINISTRATIVE AND FINANCIAL COST");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTDAEFC,'2','.',','));
                $pdf->Cell(30,7,number_format($totalTLAEFC,'2','.',','));
                $pdf->Cell(30,7,number_format($totalAEFC,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"NET INCOME");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"OTHER INCOME");
                $pdf->Ln();

                $pdf->Cell(55,7,"Photocopy");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalPhtocopyIncome,'2','.',','));
                $pdf->Cell(30,7,number_format($totalPhtocopyIncome,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Miscellaneous Income");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalMiscellaneousIncome,'2','.',','));
                $pdf->Cell(30,7,number_format($totalMiscellaneousIncome,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Membership Fee");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalMembership,'2','.',','));
                $pdf->Cell(30,7,number_format($totalMembership,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Rent Income");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalRent,'2','.',','));
                $pdf->Cell(30,7,number_format($totalRent,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Interest Income BCB");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalIEBCB,'2','.',','));
                $pdf->Cell(30,7,number_format($totalIEBCB,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Interest Income BCB");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalIEBCB,'2','.',','));
                $pdf->Cell(30,7,number_format($totalIEBCB,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Interest Income LBP");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalIELBP,'2','.',','));
                $pdf->Cell(30,7,number_format($totalIELBP,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Dividends Bataan Coop");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalDVBCB,'2','.',','));
                $pdf->Cell(30,7,number_format($totalDVBCB,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Insurance Loans");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalInsuranceFeeIncome,'2','.',','));
                $pdf->Cell(30,7,number_format($totalInsuranceFeeIncome,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"Transfer Fee");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalTransferFee,'2','.',','));
                $pdf->Cell(30,7,number_format($totalTransferFee,'2','.',','));
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $totalOtherIncome = $totalPhtocopyIncome + $totalMiscellaneousIncome + $totalMembership + $totalRent + $totalIELBP + $totalIEBCB + $totalDVBCB + $totalInsuranceFeeIncome + $totalTransferFee;

                $pdf->Cell(55,7,"TOTAL OTHER INCOME");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,"");
                $pdf->Cell(30,7,number_format($totalOtherIncome,'2','.',','),1);
                $pdf->Cell(30,7,number_format($totalOtherIncome,'2','.',','),1);
                $pdf->Cell(30,7,"");
                $pdf->Ln();

                $pdf->Cell(55,7,"NET SURPLUES");
                $pdf->Ln();

                $pdf->Cell(55,7,"UNDIVIDED NET SURPLUS BEG.");
                $pdf->Ln();

                $pdf->Cell(55,7,"UNDIVIDED NET SURPLUS END.");
                $pdf->Ln();

                $pdf->Output();
            }


        }else{
            $infomessage = "Select Start/End Date";
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
<html lang="en">
<head>
    <?php include "css.html" ?>
    <title>Statement of Operation</title>

</head>

<body>
    <div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div>
        <?php //include 'topbar.php';?>
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-12" style="margin-top:25px;margin-left: 16.7%;margin-bottom: 100px; position: absolute;width: 80%">
              <h5 align="margin-left">GENERATE STATEMENT OF OPERATION</h5>
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
              
              <div class="table table-striped table-hover table-bordered">
                <?php

                echo "<table>
                <tr>
                    <th>REVENUES</th>
                    <th></th>
                    <th>TRADING</th>
                    <th>LENDING</th>
                    <th>TOTAL</th>
                    <th>MONTH TO DATE</th>      
                </tr>";
                

                //
                echo "
                <tr>
                    <td>TRADING</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>      
                </tr>";

                echo "<tr>";
                    echo "<td>" ."Sales:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $riceTotalSale . " " . "name=" . "riceTotalSale" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";

                    echo "<td> <input type =" . "text" . " " . "value=". $riceTotalSale . " " . "name=" . "riceTotalSale" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $SLBeg . " " . "name=" . "SLBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Less Cost of Sales:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Merchandise Inventory., Beg:" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $MVBeg . " " . "name=" . "MVBeg" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Add: Purchases" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalRicePurchase . " " . "name=" . "totalRicePurchase" . " " . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Total Goods Available for Sale" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Less Merchandise Inventory End" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>" ."Gross Income from Sales" . "</th>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                echo "</tr>";

                echo "
                <tr>
                    <td>CREDIT OPERATION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>      
                </tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Interest Income from Loans:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalInterestIncome . " " . "name=" . "totalInterestIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalInterestIncome . " " . "name=" . "totalInterestIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $interestIncomeBeg . " " . "name=" . "interestIncomeBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Service Fees" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalServiceFeeIncome . " " . "name=" . "totalServiceFeeIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalServiceFeeIncome . " " . "name=" . "totalServiceFeeIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $serviceFeeBeg . " " . "name=" . "serviceFeeBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //Filling Fees
                echo "<tr>";
                    echo "<td>" ."Filling Fees" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalFillingFeeIncome . " " . "name=" . "totalFillingFeeIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalFillingFeeIncome . " " . "name=" . "totalFillingFeeIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $fillingFeeBeg . " " . "name=" . "fillingFeeBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //Penalties Fees
                echo "<tr>";
                    echo "<td>" ."Penalties Fines and Surcharges" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTradingPenalty . " " . "name=" . "totalTradingPenalty" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLendingPenalty . " " . "name=" . "totalLendingPenalty" . " " . ">" . "</td>";
                    $totalPenalty = $totalTradingPenalty + $totalLendingPenalty;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalPenalty . " " . "name=" . "totalPenalty" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $penaltyBeg . " " . "name=" . "penaltyBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //Penalties Fees
                echo "<tr>";
                    echo "<th>" ."TOTAL" . "</th>";
                    echo "<th>" . "" . "</th>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTradingPenalty . " " . "name=" . "totalTradingPenalty" . " " . ">" . "</td>";
                    $totalCreditLendingIncome = $totalInterestIncome + $totalServiceFeeIncome + $totalFillingFeeIncome + $totalLendingPenalty;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalCreditLendingIncome . " " . "name=" . "totalCreditLendingIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalCreditLendingIncome . " " . "name=" . "totalCreditLendingIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                //Expenses
                echo "
                <tr>
                    <td>LESS ADMINISTRATIVE EXPENSE</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>      
                </tr>";

                //II totalTDHA
                echo "<tr>";
                    echo "<td>" ."Officers Honorarium and Allowances:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDHA . " " . "name=" . "totalTDHA" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDHA . " " . "name=" . "totalLDHA" . " " . ">" . "</td>";
                    $totalHA = $totalTDHA + $totalLDHA;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalHA . " " . "name=" . "totalHA" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $HABeg . " " . "name=" . "HABeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Salaries and Wages:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDSW . " " . "name=" . "totalTDSW" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDSW . " " . "name=" . "totalLDSW" . " " . ">" . "</td>";
                    $totalSW = $totalTDSW + $totalLDSW;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalSW . " " . "name=" . "totalSW" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $SWBeg . " " . "name=" . "SWBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."SSS Philhealth ECC Pag-ibig Premium:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDGB . " " . "name=" . "totalTDGB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDGB . " " . "name=" . "totalLDGB" . " " . ">" . "</td>";
                    $totalGB = $totalTDGB + $totalLDGB;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalGB . " " . "name=" . "totalGB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $GBBeg . " " . "name=" . "GBBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Members Benefit:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDMB . " " . "name=" . "totalTDGB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDMB . " " . "name=" . "totalLDMB" . " " . ">" . "</td>";
                    $totalMB = $totalTDGB + $totalLDMB;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalMB . " " . "name=" . "totalMB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $MBBeg . " " . "name=" . "MBBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Officers Benefit:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDOB . " " . "name=" . "totalTDOB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDOB . " " . "name=" . "totalLDOB" . " " . ">" . "</td>";
                    $totalOB = $totalTDOB + $totalLDOB;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalOB . " " . "name=" . "totalOB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $OBBeg . " " . "name=" . "OBBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Employess Benefit:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDEB . " " . "name=" . "totalTDEB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDEB . " " . "name=" . "totalLDEB" . " " . ">" . "</td>";
                    $totalEB = $totalTDEB + $totalLDEB;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalEB . " " . "name=" . "totalEB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $EBBeg . " " . "name=" . "EBBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Office Supplies:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDOS . " " . "name=" . "totalTDOS" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDOS . " " . "name=" . "totalLDOS" . " " . ">" . "</td>";
                    $totalOS = $totalTDOS + $totalLDOS;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalOS . " " . "name=" . "totalOS" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $OSBeg . " " . "name=" . "OSBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Insurance Expense:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDIS . " " . "name=" . "totalTDIS" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDIS . " " . "name=" . "totalLDIS" . " " . ">" . "</td>";
                    $totalIS = $totalTDIS + $totalLDIS;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalIS . " " . "name=" . "totalIS" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $ISBeg . " " . "name=" . "ISBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Transportation and Travel:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDTT . " " . "name=" . "totalTDTT" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDTT . " " . "name=" . "totalLDTT" . " " . ">" . "</td>";
                    $totalTT = $totalTDTT + $totalLDTT;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTT . " " . "name=" . "totalTT" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $TTBeg . " " . "name=" . "TTBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Representation and Entertainment:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDRN . " " . "name=" . "totalTDRN" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDRN . " " . "name=" . "totalLDRN" . " " . ">" . "</td>";
                    $totalRN = $totalTDRN + $totalLDRN;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalRN . " " . "name=" . "totalRN" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $RNBeg . " " . "name=" . "RNBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Power Light and Water:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDLW . " " . "name=" . "totalTDLW" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDLW . " " . "name=" . "totalLDLW" . " " . ">" . "</td>";
                    $totalLW = $totalTDLW + $totalLDLW;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLW . " " . "name=" . "totalLW" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $LWBeg . " " . "name=" . "LWBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Rent:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDRT . " " . "name=" . "totalTDRT" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDRT . " " . "name=" . "totalLDRT" . " " . ">" . "</td>";
                    $totalRT = $totalTDRT + $totalLDRT;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalRT . " " . "name=" . "totalRT" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $RTBeg . " " . "name=" . "RTBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Telecommunications:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDCM . " " . "name=" . "totalTDCM" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDCM . " " . "name=" . "totalLDCM" . " " . ">" . "</td>";
                    $totalCM = $totalTDCM + $totalLDCM;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalCM . " " . "name=" . "totalCM" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $CMBeg . " " . "name=" . "CMBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Meeting and Conference:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDMC . " " . "name=" . "totalTDMC" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDMC . " " . "name=" . "totalLDMC" . " " . ">" . "</td>";
                    $totalMC = $totalTDMC + $totalLDMC;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalMC . " " . "name=" . "totalMC" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $MCBeg . " " . "name=" . "MCBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Depreciation Expense:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDDE . " " . "name=" . "totalTDDE" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDDE . " " . "name=" . "totalLDDE" . " " . ">" . "</td>";
                    $totalDE = $totalTDDE + $totalLDDE;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalDE . " " . "name=" . "totalDE" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $DPBeg . " " . "name=" . "DPBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Miscellaneous Expense:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDME . " " . "name=" . "totalTDME" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDME . " " . "name=" . "totalLDME" . " " . ">" . "</td>";
                    $totalME = $totalTDME + $totalLDME;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalME . " " . "name=" . "totalME" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $MEBeg . " " . "name=" . "MEBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Repairs and Maintenance:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDRP . " " . "name=" . "totalTDRP" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDRP . " " . "name=" . "totalLDRP" . " " . ">" . "</td>";
                    $totalRP = $totalTDRP + $totalLDRP;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalRP . " " . "name=" . "totalRP" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $RPBeg . " " . "name=" . "RPBeg" . " " . ">" . "</td>";

                echo "<tr>";
                    echo "<td>" ."Promotional Expense:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDPE . " " . "name=" . "totalTDPE" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDPE . " " . "name=" . "totalLDPE" . " " . ">" . "</td>";
                    $totalPE = $totalTDPE + $totalLDPE;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalPE . " " . "name=" . "totalRP" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $ALBeg . " " . "name=" . "ALBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Taxes and Liscences:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDTF . " " . "name=" . "totalTDTF" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDTF . " " . "name=" . "totalLDTF" . " " . ">" . "</td>";
                    $totalTF = $totalTDTF + $totalLDTF;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTF . " " . "name=" . "totalTF" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $TFBeg . " " . "name=" . "TFBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Allowance for Probable Loss:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDAL . " " . "name=" . "totalTDAL" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDAL . " " . "name=" . "totalLDAL" . " " . ">" . "</td>";
                    $totalAL = $totalTDAL + $totalLDAL;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalAL . " " . "name=" . "totalAL" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $ALBeg . " " . "name=" . "ALBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Retirement Benefit Fund:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDRB . " " . "name=" . "totalTDRB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDRB . " " . "name=" . "totalLDRB" . " " . ">" . "</td>";
                    $totalRB = $totalTDRB + $totalLDRB;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalRB . " " . "name=" . "totalRB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $RBBeg . " " . "name=" . "RBBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."General Assembly Meeting and Expenses:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDGE . " " . "name=" . "totalTDGE" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDGE . " " . "name=" . "totalLDGE" . " " . ">" . "</td>";
                    $totalGE = $totalTDGE + $totalLDGE;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalGE . " " . "name=" . "totalGE" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $GEBeg . " " . "name=" . "GEBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //Expense

                $totalTradingExpensesAE = $totalTDHA + $totalTDSW + $totalTDGB + $totalTDMB + $totalTDOB + $totalTDEB + $totalTDOS + $totalTDIS + $totalTDTT + $totalTDRN + $totalTDLW + $totalTDRT + $totalTDCM + $totalTDMC + $totalTDDE + $totalTDME + $totalTDPE + $totalTDTF + $totalTDAL + $totalTDRB + $totalTDGE + $totalTDRP;

                $totalLendingExpensesAE = $totalLDHA + $totalLDSW + $totalLDGB + $totalLDMB + $totalLDOB + $totalLDEB + $totalLDOS + $totalLDIS + $totalLDTT + $totalLDRN + $totalLDLW + $totalLDRT + $totalLDCM + $totalLDMC + $totalLDDE + $totalLDME + $totalLDPE + $totalLDTF + $totalLDAL + $totalLDRB + $totalLDGE + $totalLDRP;

                $totalAE = $totalTradingExpensesAE + $totalLendingExpensesAE;

                echo "<tr>";
                    echo "<th>" ."TOTAL ADMINISTRATIVE EXPENSES" . "</th>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTradingExpensesAE . " " . "name=" . "totalTradingExpensesAE" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLendingExpensesAE . " " . "name=" . "totalLendingExpensesAE" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalAE . " " . "name=" . "totalAE" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "
                <tr>
                    <td>FINANCING EXPENSE</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> 
                    <td></td>     
                </tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Interest Expense on Deposits Liabilities:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDIE . " " . "name=" . "totalTDIE" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDIE . " " . "name=" . "totalLDIE" . " " . ">" . "</td>";
                    $totalIE = $totalTDIE + $totalLDIE;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalIE . " " . "name=" . "totalIE" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $IEBeg . " " . "name=" . "IEBeg" . " " . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td>" ."Interest Expense on Borrowings:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDIB . " " . "name=" . "totalTDIB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDIB . " " . "name=" . "totalLDIB" . " " . ">" . "</td>";
                    $totalIB = $totalTDIB + $totalLDIB;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalIB . " " . "name=" . "totalIB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $IBBeg . " " . "name=" . "IBBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Bank Charges:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDBF . " " . "name=" . "totalTDBF" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDBF . " " . "name=" . "totalLDBF" . " " . ">" . "</td>";
                    $totalBF = $totalTDBF + $totalLDBF;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalBF . " " . "name=" . "totalBF" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $BFBeg . " " . "name=" . "BFBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Other Financing Charges:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDOF . " " . "name=" . "totalTDOF" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLDOF . " " . "name=" . "totalLDOF" . " " . ">" . "</td>";
                    $totalOF = $totalTDOF + $totalLDOF;
                    echo "<td> <input type =" . "text" . " " . "value=". $totalOF . " " . "name=" . "totalOF" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $OFBeg . " " . "name=" . "OFBeg" . " " . ">" . "</td>";
                echo "</tr>";

                $totalTradingExpensesFC = $totalTDIE + $totalTDIB + $totalTDBF + $totalTDOF;
                $totalLendingExpensesFC = $totalLDIE + $totalLDIB + $totalLDBF + $totalTDOF;

                $totalFC = $totalLendingExpensesFC + $totalTradingExpensesFC;

                echo "<tr>";
                    echo "<th>" ."TOTAL FINANCIAL COST" . "</th>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTradingExpensesFC . " " . "name=" . "totalTradingExpensesFC" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalLendingExpensesFC . " " . "name=" . "totalLendingExpensesFC" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalFC . " " . "name=" . "totalFC" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<th>" ."TOTAL ADMINISTRATIVE AND FINANCIAL COST" . "</th>";
                    echo "<td>" . "" . "</td>";

                    $totalTDAEFC = $totalTradingExpensesAE + $totalTradingExpensesFC;
                    $totalTLAEFC = $totalLendingExpensesAE + $totalLendingExpensesFC;
                    $totalAEFC = $totalTDAEFC + $totalTLAEFC;

                    echo "<td> <input type =" . "text" . " " . "value=". $totalTDAEFC . " " . "name=" . "totalTDAEFC" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTLAEFC . " " . "name=" . "totalTLAEFC" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalAEFC . " " . "name=" . "totalAEFC" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "
                <tr>
                    <td>NET INCOME</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>      
                </tr>";

                echo "
                <tr>
                    <td>OTHER INCOME</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>      
                </tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Photocopy:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalPhtocopyIncome . " " . "name=" . "totalPhtocopyIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalPhtocopyIncome . " " . "name=" . "totalPhtocopyIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $ptciBeg . " " . "name=" . "ptciBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Miscellaneous Income:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalMiscellaneousIncome . " " . "name=" . "totalMiscellaneousIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalMiscellaneousIncome . " " . "name=" . "totalPhtocopyIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $msliBeg . " " . "name=" . "msliBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Membership Fee:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalMembership . " " . "name=" . "totalMembership" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalMembership . " " . "name=" . "totalMembership" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $mbsiBeg . " " . "name=" . "mbsiBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Rent Income:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalRent . " " . "name=" . "totalRent" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalRent . " " . "name=" . "totalRent" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $rntiBeg . " " . "name=" . "rntiBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Interest Income BCB:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalIEBCB . " " . "name=" . "totalIEBCB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalIEBCB . " " . "name=" . "totalIEBCB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $ibcbBeg . " " . "name=" . "ibcbBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Interest Income LBP:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalIELBP . " " . "name=" . "totalIELBP" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalIELBP . " " . "name=" . "totalIELBP" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $ilbpBeg . " " . "name=" . "ilbpBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Dividends Bataan Coop:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalDVBCB . " " . "name=" . "totalDVBCB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalDVBCB . " " . "name=" . "totalDVBCB" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $dbcbBeg . " " . "name=" . "dbcbBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Insurance Loans:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalInsuranceFeeIncome . " " . "name=" . "totalInsuranceFeeIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalInsuranceFeeIncome . " " . "name=" . "totalInsuranceFeeIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $insiBeg . " " . "name=" . "insiBeg" . " " . ">" . "</td>";
                echo "</tr>";

                //II
                echo "<tr>";
                    echo "<td>" ."Transfer Fee:" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTransferFee . " " . "name=" . "totalTransferFee" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalTransferFee . " " . "name=" . "totalTransferFee" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $tffiBeg . " " . "name=" . "tffiBeg" . " " . ">" . "</td>";
                echo "</tr>";

                $totalOtherIncome = $totalPhtocopyIncome + $totalMiscellaneousIncome + $totalMembership + $totalRent + $totalIELBP + $totalIEBCB + $totalDVBCB + $totalInsuranceFeeIncome + $totalTransferFee;

                echo "<tr>";
                    echo "<th>" ."TOTAL OTHER INCOME" . "</th>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalOtherIncome . " " . "name=" . "totalOtherIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "value=". $totalOtherIncome . " " . "name=" . "totalOtherIncome" . " " . ">" . "</td>";
                    echo "<td> <input type =" . "text" . " " . "name=" . "tbd" . "value=". "tbd" . ">" . "</td>";
                echo "</tr>";

                echo "
                <tr>
                    <td>NET SURPLUES</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>       
                </tr>";

                echo "
                <tr>
                    <td>UNDIVIDED NET SURPLUS BEG.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>       
                </tr>";

                echo "
                <tr>
                    <td>UNDIVIDED NET SURPLUS END.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>       
                </tr>";
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