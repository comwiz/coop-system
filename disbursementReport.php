<?php  

require_once 'session.php';

$idNumber [] = "";
$accountNumber [] = "";

$firstName  [] = "";
$middleName [] = "";
$lastName [] = "";

$transactionNumber[] = "";
$ExpensesTransactionCode[] = "";
$voucherNumber[] = "";
$remarks[] = "";
//$invoiceNumber[] = "";
//$quantity[] = "";
//$principalAmount[] = "";
//$interestAmount[] = "";
$dateTransaction[] = "";
$totalValue[] = "";
$totalTimeDeposit = 0;

$expensesCategoryCode = "";


//FC
$totalIB = 0;
$totalBF = 0;
$totalOF = 0;

$totalAF = 0;
$totalBC = 0;
$totalCE = 0;
$totalCM = 0;
$totalEB = 0;
$totalGL = 0;
$totalGE = 0;
$totalGS = 0;
$totalIS = 0;
$totalLI = 0;
$totalLI = 0;
$totalMC = 0;
$totalMB = 0;
$totalME = 0;
$totalOS = 0;
$totalPM = 0;
$totalLW = 0;
$totalPF = 0;
$totalFB = 0;
$totalPL = 0;
$totalRT = 0;
$totalRP = 0;
$totalRN = 0;
$totalRB = 0;
$totalSW = 0;
$totalSP = 0;
$totalSC = 0;
$totalGB = 0;
$totalTF = 0;
$totalTS = 0;
$totalTT = 0;

$countErr = "";

$startDate = "";
$endDate = "";
$releaseDate = "";

$searchReport = "";
$printReport = "";
$numRow = "";
$exitB = "";

require('public/fpdf181/fpdf.php');

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
    }

    if($searchReport == "searchReport" or $printReport == "printReport"){

        //Financial Cost
        $sqlName = "SELECT * FROM  expenses_table WHERE expenses_type = 'FC' ";
        $resultName = $conn->query($sqlName);
        $numRow =  mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $expensesCategoryCode = $row['expenses_category'];
                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    //$idNumber[$counter] = $row['id_number'];
                    $remarks[$counter] = $row['Remarks'];
                    $voucherNumber[$counter] = $row['voucher_number'];
                    $totalValue[$counter] = $row['amount'];

                    if($expensesCategoryCode == "IB"){
                        $ExpensesTransactionCode[$counter] = "IB" . $row['transaction_number'];
                        $totalIB = $totalAF + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "BF") {
                        $ExpensesTransactionCode[$counter] = "BF" . $row['transaction_number'];
                        $totalBF = $totalBF + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "OF") {
                        $ExpensesTransactionCode[$counter] = "OF" . $row['transaction_number'];
                        $totalOF = $totalOF + $totalValue[$counter];
                    }

                    /*$sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }*/

                    $counter++;
                }else{
                    $numRow--;
                } 
            }
        }

        //Administrative Cost
        $sqlName = "SELECT * FROM  expenses_table WHERE expenses_type = 'AC' ";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);
        //$counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $remarks[$counter] = $row['Remarks'];
                $expensesCategoryCode = $row['expenses_category'];
                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    //$idNumber[$counter] = $row['id_number'];
                    $voucherNumber[$counter] = $row['voucher_number'];
                    $totalValue[$counter] = $row['amount'];

                    if($expensesCategoryCode == "AF"){
                        $ExpensesTransactionCode[$counter] = "AF" . $row['transaction_number'];
                        $totalAF = $totalAF + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "BC") {
                        $ExpensesTransactionCode[$counter] = "BC" . $row['transaction_number'];
                        $totalBC = $totalBC + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "CE") {
                        $ExpensesTransactionCode[$counter] = "CE" . $row['transaction_number'];
                        $totalCE = $totalCE + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "CM") {
                        $ExpensesTransactionCode[$counter] = "CM" . $row['transaction_number'];
                        $totalCM = $totalCM + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "EB") {
                        $ExpensesTransactionCode[$counter] = "EB" . $row['transaction_number'];
                        $totalEB = $totalEB + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "GL") {
                        $ExpensesTransactionCode[$counter] = "GL" . $row['transaction_number'];
                        $totalGL = $totalGL + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "GE") {
                        $ExpensesTransactionCode[$counter] = "GE" . $row['transaction_number'];
                        $totalGE = $totalGE + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "GS") {
                        $ExpensesTransactionCode[$counter] = "GS" . $row['transaction_number'];
                        $totalGS = $totalGS + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "IS") {
                        $ExpensesTransactionCode[$counter] = "IS" . $row['transaction_number'];
                        $totalIS = $totalIS + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "IS") {
                        $ExpensesTransactionCode[$counter] = "IS" . $row['transaction_number'];
                        $totalIS = $totalIS + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "LI") {
                        $ExpensesTransactionCode[$counter] = "LI" . $row['transaction_number'];
                        $totalLI = $totalLI + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "MC") {
                        $ExpensesTransactionCode[$counter] = "MC" . $row['transaction_number'];
                        $totalMC = $totalMC + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "MB") {
                        $ExpensesTransactionCode[$counter] = "MB" . $row['transaction_number'];
                        $totalMB = $totalMB + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "ME") {
                        $ExpensesTransactionCode[$counter] = "ME" . $row['transaction_number'];
                        $totalME = $totalME + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "OS") {
                        $ExpensesTransactionCode[$counter] = "OS" . $row['transaction_number'];
                        $totalOS = $totalOS + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "PM") {
                        $ExpensesTransactionCode[$counter] = "PM" . $row['transaction_number'];
                        $totalPM = $totalPM + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "LW") {
                        $ExpensesTransactionCode[$counter] = "LW" . $row['transaction_number'];
                        $totalLW = $totalLW + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "PF") {
                        $ExpensesTransactionCode[$counter] = "PF" . $row['transaction_number'];
                        $totalPF = $totalPF + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "FB") {
                        $ExpensesTransactionCode[$counter] = "FB" . $row['transaction_number'];
                        $totalFB = $totalFB + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "PL") {
                        $ExpensesTransactionCode[$counter] = "PL" . $row['transaction_number'];
                        $totalPL = $totalPL + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "RT") {
                        $ExpensesTransactionCode[$counter] = "RT" . $row['transaction_number'];
                        $totalRT = $totalRT + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "RP") {
                        $ExpensesTransactionCode[$counter] = "RP" . $row['transaction_number'];
                        $totalRP = $totalRP + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "RN") {
                        $ExpensesTransactionCode[$counter] = "RN" . $row['transaction_number'];
                        $totalRN = $totalRN + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "RB") {
                        $ExpensesTransactionCode[$counter] = "RB" . $row['transaction_number'];
                        $totalRB = $totalRB + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "SW") {
                        $ExpensesTransactionCode[$counter] = "SW" . $row['transaction_number'];
                        $totalSW = $totalSW + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "SP") {
                        $ExpensesTransactionCode[$counter] = "SP" . $row['transaction_number'];
                        $totalSP = $totalSP + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "SC") {
                        $ExpensesTransactionCode[$counter] = "SC" . $row['transaction_number'];
                        $totalSC = $totalSC + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "GB") {
                        $ExpensesTransactionCode[$counter] = "GB" . $row['transaction_number'];
                        $totalGB = $totalGB + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "TF") {
                        $ExpensesTransactionCode[$counter] = "TF" . $row['transaction_number'];
                        $totalTF = $totalTF + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "TS") {
                        $ExpensesTransactionCode[$counter] = "TS" . $row['transaction_number'];
                        $totalTS = $totalTS + $totalValue[$counter];
                    }elseif ($expensesCategoryCode == "TT") {
                        $ExpensesTransactionCode[$counter] = "TT" . $row['transaction_number'];
                        $totalTT = $totalTT + $totalValue[$counter];
                    }


                    //$principalAmount[$counter] = 0;
                    //$interestAmount[$counter] = 0;

                    /*$sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }*/

                    $counter++;
                }else{
                    $numRow--;
                } 
            }
        }

        //PRINT
        if($printReport == "printReport"){

            $pdf = new FPDF();

            $rowCounter = 0;

            $pdf->SetFont('Arial','B',9);
            $pdf->AddPage('P','A4', 0);

            //Title
            $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
            $pdf->Cell(100,7,"Other Income");$pdf->Ln();
            $pdf->Cell(30,7,"From");
            $pdf->Cell(30,7,"$startDate");$pdf->Ln();
            $pdf->Cell(30,7,"To");
            $pdf->Cell(30,7,"$endDate");$pdf->Ln();
            //Header
            $pdf->Cell(30,7,"SERVICE ID #",1);
            $pdf->Cell(30,7,"ID #",1);
            $pdf->Cell(65,7,"NAME",1);
            $pdf->Cell(30,7,"OR #",1);
            $pdf->Cell(30,7,"AMOUNT #",1);

            $pdf->Ln();

            $fullName[] = "";
            $totalSale = 0;

            while($rowCounter < $numRow) {
                $pdf->Cell(30,7,"$ExpensesTransactionCode[$rowCounter]",1);
                $pdf->Cell(30,7,"$idNumber[$rowCounter]",1);
                $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                $pdf->Cell(65,7,"$fullName[$rowCounter]",1);
                $pdf->Cell(30,7,"$voucherNumber[$rowCounter]",1);
                $totalSale = $totalSale + $totalValue[$rowCounter];
                $pdf->Cell(30,7,"$totalValue[$rowCounter]",1);
                $pdf->Ln();
                
                $rowCounter ++;
            }

            //Total 
            $pdf->AddPage('P','A4', 0);
            $pdf->Cell(100,7,"Other Income Summary");$pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Membership Fee");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"$totalAF",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Miscelaneous Fee");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"$totalOF",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Photocopy Fee");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"$totalCM",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Rent Income");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"$totalEB",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Rent Recievables");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"$totalGL",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Transfer Fee");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"$totalGE",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"TOTAL OTHER INCOME");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"$totalSale",1);

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
    <title>Disbursement Report</title>
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
                </div>
                <p>Other Income Cash Receipt</p>
                <br>
                <div class="table table-striped table-hover">
                    <?php
                    echo "<table>
                    <tr>
                        <th>DTN</th>
                        <th>VOUCHER #</th>
                        <th>REMARKS</th>
                        <th>AMOUNT</th>

                    </tr>";

                    $counterh = 0;
                    $totalSale = 0;
                    while($counterh < $numRow) {
                        echo "<tr>";
                            echo "<td>" . $ExpensesTransactionCode[$counterh] . "</td>";
                            echo "<td>" . $voucherNumber[$counterh] . "</td>";
                            echo "<td>" . $remarks[$counterh] . "</td>";
                            //echo "<td>" . $idNumber[$counterh] . "</td>";
                            //echo "<td>" . $lastName[$counterh] . ", " . $firstName[$counterh] . " " . $middleName[$counterh] . "</td>";
                            $totalSale = $totalSale + $totalValue[$counterh];
                            echo "<td>" . $totalValue[$counterh] . "</td>";
                            
                        echo "</tr>";

                        $counterh++;
                    }

                    echo "<tr>";
                        echo "<td>" . "FINANCIAL COST" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "IB Interest Expense on Borrowings" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalIB . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "BF Bank Charges" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalBF . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "OF Other Financing Charges" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalOF . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "ADMINISTRATIVE COST" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "AF Affiliation Fee" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalAF . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "BC Bank Charges" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalBC . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "CE Collection Expense" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalCE . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "CM Communication" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalCM . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "EB Employees Benefits" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalEB  . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "GL Gas Oil and Lubricants" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalGL . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "GE General Assembly Expenses" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalGE . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "GS General Support Services" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalGS . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "IS Insurance" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalIS . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "LI Litigation Expenses" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalLI . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "MC Meeting and Conferences" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalMC . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "MB Members Benefit Expense" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalMB . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "ME Miscellaneous Expense" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalME . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "OS Office Supplies" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalOS . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "PM Periodicals Magazines and Subscription" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalPM . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "LW Power Light and Water" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalLW . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "PF Professional Fees" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalPF . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "FB Provision for Members Future Benefits" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalFB . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "PL Provision for Probable Losses on Accounts/Loans/Installment Receivables" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalPL . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "RT Rentals" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalRT . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "RP Repairs and Maintenance" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalRP . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "RN Representation" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalRN . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "RB Retirement Benefit Expense" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalRB . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "SW Salaries and Wages" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalSW . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "SP School Program Support" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalSP . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "SC Social and Community Service Expense" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalSC . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "GB SSS Philhealth ECC Pag-ibig Premium" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalGB . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "TF Taxes Fees and Charges" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalTF . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "TS Trainings/Seminars" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalTS . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "TT Travel and Transportation" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalTT . "</td>";
                    echo "</tr>";



                    ?>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
<?php include "css1.html" ?>
</html>