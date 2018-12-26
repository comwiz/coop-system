<?php  

require_once 'session.php';

$idNumber [] = "";
$accountNumber [] = "";

$firstName  [] = "";
$middleName [] = "";
$lastName [] = "";

$birthPlace [] = "";
$birthDate  [] = "";
$tinNumber [] = "";
$sssNumber [] = "";

$mobileNumber [] = "";

$membershipStatus [] = "";

$countErr = 0;

include 'dbconnection.php';
require('public/fpdf181/fpdf.php');

//$counterSavings = 0;
$totalSavingsTemp = 0;
//$totalSavings = 0;
$totalSavingsContainer[] = 0;

$withdrawTemp = 0;
$withdrawContainer[] = 0;

$totalActualSavingsContainer[] = 0;

$startDate = "";
$endDate = "";
$dateTransaction = "";
$printReport = "";

$searchReport = "";
$numRow = "";
$exitB = "";

$typeDeposit = "";

//Time Deposit
$sqlTD = "SELECT * FROM  fixed_deposit_table WHERE withdraw_td != '1' ";
$resultTD = $conn->query($sqlTD);
$numRow = mysqli_num_rows($resultTD);

$TDAmount[] = "";
$TDTerm[] = "";
$TDInterest[] = "";
$TDDate[] = "";
$counter = 0;

if($resultTD->num_rows > 0){
    while ($rowTD = mysqli_fetch_array($resultTD)) {
        $idNumber[$counter] = $rowTD['id_number'];
        $TDAmount[$counter] = $rowTD['amount'];
        $TDTerm[$counter] = $rowTD['term'];
        $TDInterest[$counter] = $rowTD['interest_rate'];
        $TDDate[$counter] = $rowTD['date_transaction'];



        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

if(($_SERVER["REQUEST_METHOD"])== "POST"){

    if (!empty($_POST["dateTransaction"])) {
        $dateTransaction = test_input($_POST["dateTransaction"]);
    }

    if (!empty($_POST["printReport"])) {
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

    if (empty($_POST["typeDeposit"])) {
        $countErr++;
    }else {
        $typeDeposit = test_input($_POST["typeDeposit"]);
    }

    if (!empty($_POST["exitB"])) {
        $exitB = test_input($_POST["exitB"]);
    }

    if($exitB == "exitB"){
        session_destroy();
    }

    if($printReport == "printReport"){

        $counter = 0;
        
        $begContainer[] = 0;

        $depositTemp = 0;
        $depositContainer[] = 0;
        $retentionTemp = 0;
        $retentionContainer[] = 0;
        $interestTemp = 0;
        $interestContainer[] = 0;

        $withdrawTemp = 0;
        $withdrawContainer[] = 0;

        $totalSavingsTemp = 0;
        $totalSavingsContainer[] = 0;

        $typeTransaction = "";

        if($resultName->num_rows > 0){

            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $idNumber[$counter] = $row['id_number'];
                $accountNumber[$counter] = $row['account_number'];
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];



            }

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
                $pdf->AddPage('L','A4', 0);

                //Title
                $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
                $pdf->Cell(100,7,"Savings Deposit");$pdf->Ln();
                $pdf->Cell(30,7,"From");
                $pdf->Cell(30,7,"$startDate");$pdf->Ln();
                $pdf->Cell(30,7,"To");
                $pdf->Cell(30,7,"$endDate");$pdf->Ln();


                //Header
                $pdf->Cell(30,7,"ID #",1);
                $pdf->Cell(65,7,"Name",1);
                $pdf->Cell(30,7,"Beginning",1);
                $pdf->Cell(30,7,"Deposit",1);
                $pdf->Cell(30,7,"Retention",1);
                $pdf->Cell(30,7,"Withdraw",1);
                $pdf->Cell(30,7,"Interet",1);
                $pdf->Cell(30,7,"End Balance",1);
                $pdf->Ln();

                $fullName[] = "";
                while($rowCounter < $numRow) {
                    if($totalActualSavingsContainer[$rowCounter] != 0){
                        $pdf->Cell(30,7,"$idNumber[$rowCounter]",1);
                        $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                        $pdf->Cell(65,7,"$fullName[$rowCounter]",1);
                        $totalSDBTemp = $totalSDBTemp + $begContainer[$rowCounter];
                        $pdf->Cell(30,7,number_format($begContainer[$rowCounter],'2','.',','),1);
                        $totaldepTemp = $totaldepTemp + $depositContainer[$rowCounter];
                        if($depositContainer[$rowCounter] > 0){
                            $pdf->Cell(30,7,number_format($depositContainer[$rowCounter],'2','.',','),1);
                        }else{
                            $pdf->Cell(30,7,"",1);
                        }
                        $totalretTemp = $totalretTemp + $retentionContainer[$rowCounter];
                        if($retentionContainer[$rowCounter] > 0){
                            $pdf->Cell(30,7,number_format($retentionContainer[$rowCounter],'2','.',','),1);
                        }else{
                            $pdf->Cell(30,7,"",1);
                        }
                        $totalwithTemp = $totalwithTemp + $withdrawContainer[$rowCounter];
                        if($withdrawContainer[$rowCounter] > 0){
                            $pdf->Cell(30,7,number_format($withdrawContainer[$rowCounter],'2','.',','),1);
                        }else{
                            $pdf->Cell(30,7,"",1);
                        }
                        $totalintTemp = $totalintTemp + $interestContainer[$rowCounter];
                        if($interestContainer[$rowCounter] > 0){
                            $pdf->Cell(30,7,number_format($interestContainer[$rowCounter],'2','.',','),1);
                        }else{
                            $pdf->Cell(30,7,"",1);
                        }
                        $totalSDTemp = $totalSDTemp + $totalActualSavingsContainer[$rowCounter];
                        if($totalActualSavingsContainer[$rowCounter] > 0){
                            $pdf->Cell(30,7,number_format($totalActualSavingsContainer[$rowCounter],'2','.',','),1);
                        }else{
                            $pdf->Cell(30,7,"",1);
                        }
                        $pdf->Ln();
                    }
                    $rowCounter ++;
                }

                //Total
                $pdf->Cell(30,7,"TOTAL",1);
                $pdf->Cell(65,7,"",1);
                $pdf->Cell(30,7,number_format($totalSDBTemp,'2','.',','),1);
                $pdf->Cell(30,7,number_format($totaldepTemp,'2','.',','),1);
                $pdf->Cell(30,7,number_format($totalretTemp,'2','.',','),1);
                $pdf->Cell(30,7,number_format($totalwithTemp,'2','.',','),1);
                $pdf->Cell(30,7,number_format($totalintTemp,'2','.',','),1);
                $pdf->Cell(30,7,number_format($totalSDTemp,'2','.',','),1);

                $pdf->Output();
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
                        <div class="col-md-10 form">
                            <button class="btn btn-outline-success my-2 my-sm-0" name = "printReport" value = "printReport" type="submit" style="align-self: center;">PRINT</button>
                        </div>
                    </div>
                </div>

                <p>Time Deposit</p>
                <br>

                <div class="table table-striped table-hover table-bordered">
                    <?php
                        echo "<table>
                            <tr>
                                <th></th>
                                <th>ID #</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Interest Rate</th>
                            </tr>";

                            $counterhTD = 0;
                            $totalTD = 0;
                            $totalIE = 0;
                            $countMember = 1;
                            $termDays = 0;
                            while($counterhTD < $numRow) {
                                
                                echo "<tr>";
                                    echo "<td>" . $countMember . "</td>";
                                    echo "<td>" . $idNumber[$counterhTD] . "</td>";
                                    echo "<td>" . $lastName[$counterhTD] . ", " . $firstName[$counterhTD] . " " . $middleName[$counterhTD] . "</td>";
                                    $totalTD = $totalTD + $TDAmount[$counterhTD];
                                    echo "<td>" . $TDDate[$counterhTD] . "</td>";
                                    echo "<td>" . number_format($TDAmount[$counterhTD],'2','.','.') . "</td>";
                                    //$termDays = $TDTerm[$counterhTD] * 30;
                                    //echo "<td>" . $termDays . "</td>";
                                    echo "<td>" . $TDInterest[$counterhTD] . '%' . "</td>";
                                    //$IEExpense = ($TDAmount[$counterhTD] * ($TDInterest[$counterhTD]/100))/12;
                                    //$totalIE = $totalIE + $IEExpense;
                                    //echo "<td>" . number_format($IEExpense,'2','.','.') . "</td>";

                                    //$monthDate = new DateTime($TDDate[$counterhTD]);
                                    //$monthDate->add(new DateInterval('P'.($termDays).'D'));
                                    //echo "<td>"; echo $monthDate->format('Y-m-d');  echo "</td>";


                                echo "</tr>";

                                $countMember++;
                                $counterhTD++;
                            }

                            echo "<tr>";
                                echo "<td>" . "" . "</td>";
                                echo "<td>" . "TOTAL". "</td>";
                                echo "<td>" . "" . "</td>";
                                echo "<td>" . "" . "</td>";
                                echo "<td>" . number_format($totalTD,'2','.','.') . "</td>";
                                echo "<td>" . "" . "</td>";
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