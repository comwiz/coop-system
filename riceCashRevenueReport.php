<?php  

require_once 'session.php';

$idNumber [] = "";
$accountNumber [] = "";

$firstName  [] = "";
$middleName [] = "";
$lastName [] = "";

$transactionNumber[] = "";
$loanApplicationNumber[] = "";
$orNumber[] = "";
$invoiceNumber[] = "";
$quantity[] = "";
$principalAmount[] = "";
$interestAmount[] = "";
$dateTransaction[] = "";
$totalValue[] = "";
$totalTimeDeposit = 0;

$totalQuantity = 0;
$totalAR = 0;
$totalIR = 0;
$totalSCR = 0;
$totalCSDR = 0;
$totalIIDR = 0;
$totalSavingsD = 0;
$totalPenalty = 0;

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

        //Rice Loan Payment
        $sqlName = "SELECT * FROM  rice_loan_payment_table";
        $resultName = $conn->query($sqlName);
        $numRow = mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $transactionNumber[$counter] = $row['transaction_number'];

                $releaseDate = $row['date_payment'];    

                if($startDate <= $releaseDate and $endDate >= $releaseDate){

                    $idNumber[$counter] = $row['id_number'];

                    //Get Invoice
                    $sqlSearchIN = "SELECT * FROM rice_loan_table WHERE id_number = '$idNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]' " ;
                    $resultSearchIN = $conn->query($sqlSearchIN);


                    if($resultSearchIN->num_rows > 0){
                        while($rowIN = mysqli_fetch_array($resultSearchIN)){
                          $invoiceNumber[$counter] = $rowIN['invoice_number'];

                        }
                    }else{
                        $invoiceNumber[$counter] = "NO DATA";
                    }

                    $orNumber[$counter] = $row['reference_number'];
                    $principalAmount[$counter] = $row['amount'];

                    //Get Intererst
                    $sqlSearchI = "SELECT * FROM rice_credit_revenue_table WHERE id_number = '$idNumber[$counter]' and reference_number = '$orNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]' " ;
                    $resultSearchI = $conn->query($sqlSearchI);

                    if($resultSearchI->num_rows > 0){
                        while($rowI = mysqli_fetch_array($resultSearchI)){
                          $interestAmount[$counter] = $rowI['interest_revenue'];
                        }
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

                    $totalAR = $totalAR + $principalAmount[$counter];
                    $totalIR = $totalIR + $interestAmount[$counter];
                    $totalValue[$counter] = $principalAmount[$counter] + $interestAmount[$counter];

                    $counter++;
                }else{
                    $numRow--;
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
                    $idNumber[$counter] = $row['id_number'];
                    $orNumber[$counter] = $row['or_number'];
                    $invoiceNumber[$counter] = $row['invoice_number'];
                    $quantity[$counter] = $row['quantity'];
                    $principalAmount[$counter] = $row['principal_amount'];
                    $interestAmount[$counter] = $row['interest_amount'];

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
                    $totalValue[$counter] = $principalAmount[$counter] + $interestAmount[$counter];

                    $counter++;
                }else{
                    $numRow--;
                } 
            }
        }

        //Savings 
        $sqlName = "SELECT * FROM  savings_table";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $loanApplicationNumber[$counter] = "SD" . $row['transaction_number'];

                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $idNumber[$counter] = $row['id_number'];
                    $orNumber[$counter] = $row['reference_number'];
                    $invoiceNumber[$counter] = "-";
                    $totalValue[$counter] = $row['amount'];
                    $totalSavingsD = $totalSavingsD +  $totalValue[$counter];
                    $principalAmount[$counter] = 0;
                    $interestAmount[$counter] = 0;

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

                    $counter++;
                }else{
                    $numRow--;
                } 
            }
        }

        //Time Deposit 
        $sqlName = "SELECT * FROM  time_deposit_table";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $loanApplicationNumber[$counter] = "TD" . $row['transaction_number'];

                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $idNumber[$counter] = $row['id_number'];
                    $orNumber[$counter] = $row['reference_number'];
                    $invoiceNumber[$counter] = "-";
                    $totalValue[$counter] = $row['amount'];
                    $totalTimeDeposit = $totalTimeDeposit + $totalValue[$counter];
                    $principalAmount[$counter] = 0;
                    $interestAmount[$counter] = 0;

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

                    $counter++;
                }else{
                    $numRow--;
                } 
            }
        }

        //Rice Penalty
        $sqlName = "SELECT * FROM  other_income_table WHERE income_code = 'pnti' ";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $loanApplicationNumber[$counter] = "RPF" . $row['transaction_number'];

                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $idNumber[$counter] = $row['id_number'];
                    $orNumber[$counter] = $row['or_number'];

                    //Get LAN
                    $loanAN = "";
                    $sqlSearchINP = "SELECT * FROM rice_loan_payment_table WHERE reference_number = '$orNumber[$counter]' " ;
                    $resultSearchINP = $conn->query($sqlSearchINP);

                    if($resultSearchINP->num_rows > 0){
                        while($rowINP = mysqli_fetch_array($resultSearchINP)){
                          $loanAN = $rowINP['loan_application_number'];
                        }
                    }

                    //Get Invoice
                    $sqlSearchPNI = "SELECT * FROM rice_loan_table WHERE id_number = '$idNumber[$counter]' and loan_application_number = '$loanAN' " ;
                    $resultSearchPIN = $conn->query($sqlSearchPNI);

                    if($resultSearchPIN->num_rows > 0){
                        while($rowPIN = mysqli_fetch_array($resultSearchPIN)){
                          $invoiceNumber[$counter] = $rowPIN['invoice_number'];

                        }
                    }else{
                        $invoiceNumber[$counter] = "NO DATA";
                    }


                    $totalValue[$counter] = $row['amount'];
                    $totalPenalty = $totalPenalty + $totalValue[$counter];
                    $principalAmount[$counter] = 0;
                    $interestAmount[$counter] = 0;

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

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
            $pdf->AddPage('L','A4', 0);

            //Title
            $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
            $pdf->Cell(100,7,"Rice Trading Sale");$pdf->Ln();
            $pdf->Cell(30,7,"From");
            $pdf->Cell(30,7,"$startDate");$pdf->Ln();
            $pdf->Cell(30,7,"To");
            $pdf->Cell(30,7,"$endDate");$pdf->Ln();
            //Header
            $pdf->Cell(30,7,"SERVICE ID #",1);
            $pdf->Cell(30,7,"ID #",1);
            $pdf->Cell(65,7,"NAME",1);
            $pdf->Cell(30,7,"OR #",1);
            $pdf->Cell(30,7,"INVOICE #",1);
            $pdf->Cell(30,7,"TRADING #",1);
            $pdf->Cell(30,7,"RICE TRADE",1);
            $pdf->Cell(30,7,"INTEREST INCOME",1);

            $pdf->Ln();

            $fullName[] = "";
            $totalSale = 0;

            while($rowCounter < $numRow) {
                $pdf->Cell(30,7,"$loanApplicationNumber[$rowCounter]",1);
                $pdf->Cell(30,7,"$idNumber[$rowCounter]",1);
                $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                $pdf->Cell(65,7,"$fullName[$rowCounter]",1);
                $pdf->Cell(30,7,"$orNumber[$rowCounter]",1);
                $pdf->Cell(30,7,"$invoiceNumber[$rowCounter]",1);
                $totalSale = $totalSale + $totalValue[$rowCounter];
                $pdf->Cell(30,7,"$totalValue[$rowCounter]",1);
                $pdf->Cell(30,7,"$principalAmount[$rowCounter]",1);
                $pdf->Cell(30,7,"$interestAmount[$rowCounter]",1);
                $pdf->Ln();
                
                $rowCounter ++;
            }

            $totalRCL = 0;
            $totalRCL = $totalAR + $totalIR;

            $totalRCC = 0;
            $totalRCC = $totalCSDR + $totalIIDR;

            //Total 
            $pdf->AddPage('L','A4', 0);
            $pdf->Cell(100,7,"Trading Sale Summary");$pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Rice Loan Sale");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"TRADING",1);
            $pdf->Cell(45,7,"PRINCIPAL",1);
            $pdf->Cell(30,7,"INTEREST",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"$totalAR",1);
            $pdf->Cell(45,7,"$totalIR",1);
            $pdf->Cell(30,7,"$totalRCL",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Rice Cash Sale");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"TRADING",1);
            $pdf->Cell(45,7,"PRINCIPAL",1);
            $pdf->Cell(30,7,"INTEREST",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"$totalRCC",1);
            $pdf->Cell(45,7,"$totalCSDR",1);
            $pdf->Cell(30,7,"$totalIIDR",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"SAVINGS");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"TRADING",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"$totalSavingsD",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"TIME DEPOSIT");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"TRADING",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"$totalTimeDeposit",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"PENALTY");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"TRADING",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"$totalPenalty",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"TOTAL TRADING");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"TRADING",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Cell(45,7,"$totalSale",1);
            $pdf->Cell(45,7,"",1);
            $pdf->Cell(30,7,"",1);

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
<div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php include 'topbar.php';?>
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
                <p>Trading Cash Receipt</p>
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
                        <th>Trading</th>
                        <th>Rice Trade</th>
                        <th>Interest Income</th>
                    </tr>";

                    $counterh = 0;
                    $totalSale = 0;
                    while($counterh < $numRow) {
                        echo "<tr>";
                            echo "<td>" . $loanApplicationNumber[$counterh] . "</td>";
                            echo "<td>" . $idNumber[$counterh] . "</td>";
                            echo "<td>" . $lastName[$counterh] . ", " . $firstName[$counterh] . " " . $middleName[$counterh] . "</td>";
                            echo "<td>" . $orNumber[$counterh] . "</td>";
                            echo "<td>" . $invoiceNumber[$counterh] . "</td>";
                            $totalSale = $totalSale + $totalValue[$counterh];
                            echo "<td>" . $totalValue[$counterh] . "</td>";
                            echo "<td>" . $principalAmount[$counterh] . "</td>";
                            echo "<td>" . $interestAmount[$counterh] . "</td>";
                            
                        echo "</tr>";

                        $counterh++;
                    }

                     echo "<tr>";
                        echo "<td>" . "TRADING SUMMARY" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "Interest" . "</td>";
                        echo "<td>" . "Sale CR". "</td>";
                    echo "</tr>";

                     echo "<tr>";
                        echo "<td>" . "Rice Loan Sale" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        $totalRCL = 0;
                        $totalRCL = $totalAR + $totalIR;
                        echo "<td>" . $totalRCL . "</td>";
                        echo "<td>" . $totalAR . "</td>";
                        echo "<td>" . $totalIR . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "Rice Cash Sale" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        $totalRCC = 0;
                        $totalRCC = $totalCSDR + $totalIIDR;
                        echo "<td>" . $totalRCC . "</td>";
                        echo "<td>" . $totalCSDR . "</td>";
                        echo "<td>" . $totalIIDR . "</td>";
                    echo "</tr>";

                     echo "<tr>";
                        echo "<td>" . "Total Savings" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalSavingsD . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "". "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "Total Time Deposit" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalTimeDeposit  . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "". "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "Total Penalty" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalPenalty . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "". "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "TOTAL TRADING" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" ."" . "</td>";
                        echo "<td>" . $totalSale . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "". "</td>";
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