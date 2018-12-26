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
//$invoiceNumber[] = "";
//$quantity[] = "";
//$principalAmount[] = "";
//$interestAmount[] = "";
$dateTransaction[] = "";
$totalValue[] = "";
$totalTimeDeposit = 0;

$incomeCode = "";

$totalMembership = 0;
$totalMiscelaneous = 0;
$totalPhotocopy = 0;
$totalRentIncome = 0;
$totalRentReceivables = 0;
$totalTransferFee = 0;

//
$totalPL = 0;
$totalInsuranceFee = 0;
$totalOIF = 0;

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

        //Rice Penalty
        $sqlName = "SELECT * FROM  other_income_table WHERE income_code != 'pnti' ";
        $resultName = $conn->query($sqlName);
        $numRow =  mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $incomeCode = $row['income_code'];
                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $idNumber[$counter] = $row['id_number'];
                    $orNumber[$counter] = $row['or_number'];
                    $totalValue[$counter] = $row['amount'];

                    if($incomeCode == "mbsi"){
                        $loanApplicationNumber[$counter] = "MBF" . $row['transaction_number'];
                        $totalMembership = $totalMembership + $totalValue[$counter];
                    }elseif ($incomeCode == "msli") {
                        $loanApplicationNumber[$counter] = "MSF" . $row['transaction_number'];
                        $totalMiscelaneous = $totalMiscelaneous + $totalValue[$counter];
                    }elseif ($incomeCode == "plti") {
                        $loanApplicationNumber[$counter] = "PLF" . $row['transaction_number'];
                        $totalPL = $totalPL + $totalValue[$counter];
                    }elseif ($incomeCode == "ptci") {
                        $loanApplicationNumber[$counter] = "PTF" . $row['transaction_number'];
                        $totalPhotocopy = $totalPhotocopy + $totalValue[$counter];
                    }elseif ($incomeCode == "rnti") {
                        $loanApplicationNumber[$counter] = "RIF" . $row['transaction_number'];
                        $totalRentIncome = $totalRentIncome + $totalValue[$counter];
                    }elseif ($incomeCode == "rntr") {
                        $loanApplicationNumber[$counter] = "RRF" . $row['transaction_number'];
                        $totalRentReceivables = $totalRentReceivables + $totalValue[$counter];
                    }elseif ($incomeCode == "tffi") {
                        $loanApplicationNumber[$counter] = "TFF" . $row['transaction_number'];
                        $totalTransferFee = $totalTransferFee + $totalValue[$counter];
                    }elseif ($incomeCode == "insi") {
                        $loanApplicationNumber[$counter] = "INF" . $row['transaction_number'];
                        $totalInsuranceFee = $totalInsuranceFee + $totalValue[$counter];
                    }elseif ($incomeCode == "oifi") {
                        $loanApplicationNumber[$counter] = "OI" . $row['transaction_number'];
                        $totalOIF = $totalOIF + $totalValue[$counter];
                    }

                    //$principalAmount[$counter] = 0;
                    //$interestAmount[$counter] = 0;

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
                $pdf->Cell(30,7,"$loanApplicationNumber[$rowCounter]",1);
                $pdf->Cell(30,7,"$idNumber[$rowCounter]",1);
                $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                $pdf->Cell(65,7,"$fullName[$rowCounter]",1);
                $pdf->Cell(30,7,"$orNumber[$rowCounter]",1);
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
            $pdf->Cell(25,7,"$totalMembership",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Miscelaneous Fee");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"$totalMiscelaneous",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Photocopy Fee");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"$totalPhotocopy",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Rent Income");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"$totalRentIncome",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Rent Recievables");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"$totalRentReceivables",1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(100,7,"Transfer Fee");$pdf->Ln();

            $pdf->Cell(30,7,"",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"",1);
            $pdf->Ln();

            $pdf->Cell(30,7,"TOTAL",1);
            $pdf->Cell(60,7,"",1);
            $pdf->Cell(25,7,"$totalTransferFee",1);

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
                <p>Other Income Cash Receipt</p>
                <br>
                <div class="table table-striped table-hover">
                    <?php
                    echo "<table>
                    <tr>
                        <th>LAN</th>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>OR #</th>
                        <th>Other Income</th>

                    </tr>";

                    $counterh = 0;
                    $totalSale = 0;
                    while($counterh < $numRow) {
                        echo "<tr>";
                            echo "<td>" . $loanApplicationNumber[$counterh] . "</td>";
                            echo "<td>" . $idNumber[$counterh] . "</td>";
                            echo "<td>" . $lastName[$counterh] . ", " . $firstName[$counterh] . " " . $middleName[$counterh] . "</td>";
                            echo "<td>" . $orNumber[$counterh] . "</td>";
                            $totalSale = $totalSale + $totalValue[$counterh];
                            echo "<td>" . $totalValue[$counterh] . "</td>";
                            
                        echo "</tr>";

                        $counterh++;
                    }

                     echo "<tr>";
                        echo "<td>" . "OTHER INCOME SUMMARY" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                    echo "</tr>";

                     echo "<tr>";
                        echo "<td>" . "Membership Fee" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalMembership . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "Miscelaneous Fee" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalMiscelaneous . "</td>";
                    echo "</tr>";

                     echo "<tr>";
                        echo "<td>" . "Photocopy Fee" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalPhotocopy . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "Rent Income" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalRentIncome  . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "Rent Recievables" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalRentReceivables . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "Transfer Fee" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalTransferFee . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>" . "Other Income Total" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . $totalSale . "</td>";
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