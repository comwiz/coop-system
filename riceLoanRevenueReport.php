<?php  

require_once 'session.php';

$idNumber [] = "";
$accountNumber [] = "";

$firstName  [] = "";
$middleName [] = "";
$lastName [] = "";

$loanApplicationNumber[] = "";
$orNumber[] = "";
$invoiceNumber[] = "";
$quantity[] = "";
$principalAmount[] = "";
$interestAmount[] = "";
$dateTransaction[] = "";

$totalQuantity = 0;
$totalRLQuantity = 0;
$totalRCQuantity = 0;
$totalAR = 0;
$totalIR = 0;
$totalSCR = 0;
$totalCSDR = 0;
$totalIIDR = 0;

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

        //Loan Sales
        $sqlName = "SELECT * FROM  rice_loan_table WHERE loan_status != 'Void' order by invoice_number asc";
        $resultName = $conn->query($sqlName);
        $numRow = mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanStatus = $row['loan_status'];

                $sqlDT = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
                $resultDT = $conn->query($sqlDT);
                
                if($resultDT->num_rows > 0){
                    while ($rowDT = mysqli_fetch_array($resultDT)) {
                        $releaseDate = $rowDT['date_released'];

                        //RL Sales
                        if($startDate <= $releaseDate and $endDate >= $releaseDate){
                            if($loanStatus == "Paid"){
                                $sqlLP = "SELECT * FROM  rice_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber[$counter]' ";
                                $resultLP = $conn->query($sqlLP);
                                if($resultLP->num_rows > 0){
                                    while ($rowOR = mysqli_fetch_array($resultLP)) {
                                        $orNumber[$counter] = $rowOR['reference_number'];
                                    }
                                }
                            }else{
                                $orNumber[$counter] = "NA";
                            }

                            $loanApplicationNumberA[$counter] = $row['loan_application_number'];
                            $idNumber[$counter] = $row['id_number'];
                            
                            //$orNumber[$counter] = "NA";
                            $invoiceNumber[$counter] = $row['invoice_number'];
                            $quantity[$counter] = $row['quantity'];
                            $totalRLQuantity = $totalRLQuantity + $quantity[$counter];
                            $principalAmount[$counter] = $row['loan_amount'];
                            $interestAmount[$counter] = $row['loan_interest'];
                            $dateTransaction[$counter] = $releaseDate;

                            $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                            $resultSearchName = $conn->query($sqlSearchName);

                            if($resultSearchName->num_rows > 0){
                                while($row = mysqli_fetch_array($resultSearchName)){
                                  $firstName[$counter] = $row['first_name'];
                                  $middleName[$counter] = $row['middle_name'];
                                  $lastName[$counter] = $row['last_name'];
                                }
                            }

                            //$totalQuantity = $totalQuantity + $quantity[$counter];
                            $totalAR = $totalAR + $principalAmount[$counter];
                            $totalIR = $totalIR + $interestAmount[$counter];

                            $counter++;
                        }else{
                            $numRow--;
                        } 
                    }
                }

            }
        }

        //Cash Sales
        $sqlName = "SELECT * FROM  rice_cash_revenue_table";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);
        //$counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $loanApplicationNumber[$counter] = "RCC" . $row['transaction_number'];

                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    //echo "$releaseDate";
                    $loanApplicationNumberA[$counter] = "RCC" . $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $orNumber[$counter] = $row['or_number'];
                    $invoiceNumber[$counter] = $row['invoice_number'];
                    $quantity[$counter] = $row['quantity'];
                    $totalRCQuantity = $totalRCQuantity + $quantity[$counter];
                    $principalAmount[$counter] = $row['principal_amount'];
                    $interestAmount[$counter] = $row['interest_amount'];
                    $dateTransaction[$counter] = $releaseDate;


                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

                    //$totalQuantity = $totalQuantity + $quantity[$counter];
                    $totalCSDR = $totalCSDR + $principalAmount[$counter];
                    $totalIIDR = $totalIIDR + $interestAmount[$counter];

                    $counter++;
                }else{
                    $numRow--;
                } 
            }
        }

        array_multisort($invoiceNumber, $idNumber, $lastName, $firstName, $middleName, $orNumber, $quantity, $principalAmount, $interestAmount, $dateTransaction, $loanApplicationNumberA);

        //array_multisort($invoiceNumber, $loanApplicationNumber, $idNumber, $lastName, $firstName, $middleName, $orNumber, $quantity, $principalAmount, $interestAmount, $dateTransaction);

        //Print Report
        if($printReport == "printReport"){

            $totalSDBTemp = 0;
            $totaldepTemp = 0;
            $totalretTemp = 0;
            $totalwithTemp = 0;
            $totalintTemp = 0;
            $totalSDTemp = 0;

            $pdf = new FPDF();

            $rowCounter = 0;

            $pdf->SetFont('Arial','B',9);
            $pdf->AddPage('L','Legal', 0);

            //Title
            $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
            $pdf->Cell(100,7,"Rice Trading Sale");$pdf->Ln();
            $pdf->Cell(30,7,"From");
            $pdf->Cell(30,7,"$startDate");$pdf->Ln();
            $pdf->Cell(30,7,"To");
            $pdf->Cell(30,7,"$endDate");$pdf->Ln();
            //Header
            $pdf->Cell(30,7,"LOAN ID #",1);
            $pdf->Cell(30,7,"ID #",1);
            $pdf->Cell(65,7,"NAME",1);
            $pdf->Cell(30,7,"OR #",1);
            $pdf->Cell(30,7,"INVOICE #",1);
            $pdf->Cell(30,7,"QUANTITY",1);
            $pdf->Cell(30,7,"PRINCIPAL",1);
            $pdf->Cell(30,7,"INTEREST",1);
            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Ln();

            $fullName[] = "";
            $totalValue = 0;
            $totalSale = 0;

            while($rowCounter < $numRow) {
                $pdf->Cell(30,7,"$loanApplicationNumber[$rowCounter]",1);
                $pdf->Cell(30,7,"$idNumber[$rowCounter]",1);
                $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                $pdf->Cell(65,7,"$fullName[$rowCounter]",1);
                $pdf->Cell(30,7,"$orNumber[$rowCounter]",1);
                $pdf->Cell(30,7,"$invoiceNumber[$rowCounter]",1);
                $totalQuantity = $totalQuantity + $quantity[$rowCounter];
                $pdf->Cell(30,7,"$quantity[$rowCounter]",1);
                $pdf->Cell(30,7,"$principalAmount[$rowCounter]",1);
                $pdf->Cell(30,7,"$interestAmount[$rowCounter]",1);
                $totalValue = $interestAmount[$rowCounter] + $principalAmount[$rowCounter];
                $totalSale = $totalSale + $totalValue;
                $pdf->Cell(30,7,"$totalSale",1);
                $pdf->Ln();
                
                $rowCounter ++;
            }

            $totalRLSale = 0;
            $totalRLSale = $totalAR + $totalIR;

            $totalRCSale = 0;
            $totalRCSale = $totalCSDR + $totalIIDR;

            //Total 
            $pdf->AddPage('L','Legal', 0);
            $pdf->Cell(100,7,"Rice Trading Sale Summary");$pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Rice Loan Summary");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(155,7,"",1);
            $pdf->Cell(25,7,"QUANTITY",1);
            $pdf->Cell(45,7,"ACCOUNT RECEIVABLES",1);
            $pdf->Cell(45,7,"INTEREST RECEIVABLES",1);
            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(155,7,"",1);
            $pdf->Cell(25,7,"$totalRLQuantity",1);
            $pdf->Cell(45,7,"$totalAR",1);
            $pdf->Cell(45,7,"$totalIR",1);
            $pdf->Cell(30,7,"$totalRLSale",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Rice Cash Summary");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(155,7,"",1);
            $pdf->Cell(25,7,"QUANTITY",1);
            $pdf->Cell(45,7,"CASH SALES DR",1);
            $pdf->Cell(45,7,"INTEREST INCOME DR",1);
            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(155,7,"",1);
            $pdf->Cell(25,7,"$totalRCQuantity",1);
            $pdf->Cell(45,7,"$totalCSDR",1);
            $pdf->Cell(45,7,"$totalIIDR",1);
            $pdf->Cell(30,7,"$totalRCSale",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"TOTAL RICE TRADING SALE");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(155,7,"",1);
            $pdf->Cell(25,7,"QUANTITY",1);
            $pdf->Cell(45,7,"PRINCIPAL",1);
            $pdf->Cell(45,7,"INTEREST",1);
            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Ln();

            $totalPrincipal = 0;
            $totalPrincipal = $totalAR + $totalCSDR;

            $totalInterest = 0;
            $totalInterest = $totalIR + $totalIIDR;

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(155,7,"",1);
            $pdf->Cell(25,7,"$totalQuantity",1);
            $pdf->Cell(45,7,"$totalPrincipal",1);
            $pdf->Cell(45,7,"$totalInterest",1);
            $pdf->Cell(30,7,"$totalSale",1);

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
    <title>Rice Revenue</title>
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
                <p>Rice Loan/Cash Sales Trading</p>
                <br>
                <div class="table table-striped table-hover">
                    <?php
                    echo "<table>
                    <tr>
                        <th>LAN</th>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>OR #</th>
                        <th>Invoice #</th>
                        <th>Quantity</th>
                        <th>Account Receivable</th>
                        <th>Interest Receivable</th>
                        <th>Sales CR</th>
                        <th>Date</th>
                    </tr>";

                    $counterh = 0;
                    $totalSale = 0;

                    while($counterh < $numRow) {
                        echo "<tr>";
                            echo "<td>" . $loanApplicationNumberA[$counterh] . "</td>";
                            echo "<td>" . $idNumber[$counterh] . "</td>";
                            echo "<td>" . $lastName[$counterh] . ", " . $firstName[$counterh] . " " . $middleName[$counterh] . "</td>";
                            if($orNumber[$counterh] != "NA"){
                                echo "<td " . "style=" . "color:green" . ">" . $orNumber[$counterh] . "</td>";
                            }else{
                                echo "<td " . "style=" . "color:red" . ">" . $orNumber[$counterh] . "</td>";
                            }
                            
                            echo "<td>" . $invoiceNumber[$counterh] . "</td>";
                            $totalQuantity = $totalQuantity + $quantity[$counterh];
                            echo "<td>" . $quantity[$counterh] . "</td>";
                            echo "<td>" . number_format($principalAmount[$counterh], 2, '.', ',') . "</td>";
                            echo "<td>" . number_format($interestAmount[$counterh], 2, '.', ',') . "</td>";
                            $totalValue = $interestAmount[$counterh] + $principalAmount[$counterh];
                            $totalSale = $totalSale + $totalValue;
                            echo "<td>" . number_format($totalValue, 2, '.', ',') . "</td>";
                            echo "<td>" . $dateTransaction[$counterh] . "</td>";
                        echo "</tr>";

                        $counterh++;
                    }

                    $totalRLSale = 0;
                    $totalRLSale = $totalAR + $totalIR;

                    $totalRCSale = 0;
                    $totalRCSale = $totalCSDR + $totalIIDR;

                    echo "<tr>";
                        echo "<th>" . "SUMMARY" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "". "</th>";
                    echo "</tr>";

                     echo "<tr>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" ."" . "</th>";
                        echo "<th>" . "Quantity" . "</th>";
                        echo "<th>" . "Account Receivable" . "</th>";
                        echo "<th>" . "Interest Receivable" . "</th>";
                        echo "<th>" . "Sale CR". "</th>";
                    echo "</tr>";

                     echo "<tr>";
                        echo "<th>" . "Rice Loan Sale" . "</th>";
                        echo "<th>" . "Total" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" ."" . "</th>";
                        echo "<th " . "style=" . "color:green" . ">" . $totalRLQuantity . "</th>";
                        echo "<th " . "style=" . "color:green" . ">" . number_format($totalAR, 2, '.', ',') . "</th>";
                        echo "<th " . "style=" . "color:green" . ">" . number_format($totalIR, 2, '.', ',') . "</th>";
                        echo "<th " . "style=" . "color:green" . ">" . number_format($totalRLSale, 2, '.', ','). "</th>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" ."" . "</th>";
                        echo "<th>" . "Quantity" . "</th>";
                        echo "<th>" . "Cash Sale DR" . "</th>";
                        echo "<th>" . "Interest Income DR" . "</th>";
                        echo "<th>" . "Sale CR". "</th>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<th>" . "Rice Cash Sale" . "</th>";
                        echo "<th>" . "Total" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" ."" . "</th>";
                        echo "<th " . "style=" . "color:blue" . ">" . $totalRCQuantity . "</th>";
                        echo "<th " . "style=" . "color:blue" . ">" . number_format($totalCSDR, 2, '.', ',') . "</th>";
                        echo "<th " . "style=" . "color:blue" . ">" . number_format($totalIIDR, 2, '.', ',') . "</th>";
                        echo "<th " . "style=" . "color:blue" . ">" . number_format($totalRCSale, 2, '.', ','). "</th>";
                    echo "</tr>";

                     echo "<tr>";
                        echo "<th>" . "TOTAL SALE" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" ."" . "</th>";
                        echo "<th>" . "Quantity" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "Sale CR". "</th>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th>" ."" . "</th>";
                        echo "<th " . "style=" . "color:orange" . ">" . $totalQuantity . "</th>";
                        echo "<th>" . "". "</th>";
                        echo "<th>" . "" . "</th>";
                        echo "<th " . "style=" . "color:orange" . ">" .  number_format($totalSale, 2, '.', ','). "</th>";
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
