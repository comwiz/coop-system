<?php  

require_once 'session.php';

$idNumber [] = "";
$accountNumber [] = "";

$firstName  [] = "";
$middleName [] = "";
$lastName [] = "";

$transactionnumber[] = "";
$loanApplicationNumber[] = "";
$voucherNumber[] = "";
$checqueNumber[] = "";
$loanAmount[] = "";
$amountRelease[] = "";
$dateRelease[] = "";

$startDate = "";
$endDate = "";
$releaseDate = "";

$searchReport = "";
$printReport = "";

$countErr = "";
$numRow = "";
$exitB = "";

require('public/fpdf181/fpdf.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        header("Location: http://localhost/projectkikz/samplemwmmpc/application/views/home/login.php");
    }

    if($searchReport == "searchReport" or $printReport == "printReport"){
        
        $sqlName = "SELECT * FROM  bl_credit_revenue_table WHERE checque_number != '' and reference_number = '' order by date_transaction asc";
        $resultName = $conn->query($sqlName);
        $numRow = mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $voucherNumber[$counter] = $row['voucher_number'];
                    $checqueNumber[$counter] = $row['checque_number'];
                    $amountRelease[$counter] = $row['amount_release'];
                    $dateRelease[$counter] = $row['date_transaction'];

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

                    $sqlLA = "SELECT * FROM bl_loan_table WHERE id_number = '$idNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]' ";
                    $resultLA = $conn->query($sqlLA);

                    if($resultLA->num_rows > 0){
                        while($row = mysqli_fetch_array($resultLA)){
                          $loanAmount[$counter] = $row['loan_amount'];
                        }
                    }

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  ckl_credit_revenue_table WHERE checque_number != '' and reference_number = '' order by date_transaction asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $voucherNumber[$counter] = $row['voucher_number'];
                    $checqueNumber[$counter] = $row['checque_number'];
                    $amountRelease[$counter] = $row['amount_release'];
                    $dateRelease[$counter] = $row['date_transaction'];

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

                    $sqlLA = "SELECT * FROM ckl_loan_table WHERE id_number = '$idNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]' ";
                    $resultLA = $conn->query($sqlLA);

                    if($resultLA->num_rows > 0){
                        while($row = mysqli_fetch_array($resultLA)){
                          $loanAmount[$counter] = $row['loan_amount'];
                        }
                    }

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  cll_credit_revenue_table WHERE checque_number != '' and reference_number = '' order by date_transaction asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $voucherNumber[$counter] = $row['voucher_number'];
                    $checqueNumber[$counter] = $row['checque_number'];
                    $amountRelease[$counter] = $row['amount_release'];
                    $dateRelease[$counter] = $row['date_transaction'];

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

                    $sqlLA = "SELECT * FROM cll_loan_table WHERE id_number = '$idNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]' ";
                    $resultLA = $conn->query($sqlLA);

                    if($resultLA->num_rows > 0){
                        while($row = mysqli_fetch_array($resultLA)){
                          $loanAmount[$counter] = $row['loan_amount'];
                        }
                    }

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  cl_credit_revenue_table WHERE checque_number != '' and reference_number = '' order by date_transaction asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $voucherNumber[$counter] = $row['voucher_number'];
                    $checqueNumber[$counter] = $row['checque_number'];
                    $amountRelease[$counter] = $row['amount_release'];
                    $dateRelease[$counter] = $row['date_transaction'];

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

                    $sqlLA = "SELECT * FROM cl_loan_table WHERE id_number = '$idNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]' ";
                    $resultLA = $conn->query($sqlLA);

                    if($resultLA->num_rows > 0){
                        while($row = mysqli_fetch_array($resultLA)){
                          $loanAmount[$counter] = $row['loan_amount'];
                        }
                    }

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  cml_credit_revenue_table WHERE checque_number != '' and reference_number = '' order by date_transaction asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $voucherNumber[$counter] = $row['voucher_number'];
                    $checqueNumber[$counter] = $row['checque_number'];
                    $amountRelease[$counter] = $row['amount_release'];
                    $dateRelease[$counter] = $row['date_transaction'];

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

                    $sqlLA = "SELECT * FROM cml_loan_table WHERE id_number = '$idNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]' ";
                    $resultLA = $conn->query($sqlLA);

                    if($resultLA->num_rows > 0){
                        while($row = mysqli_fetch_array($resultLA)){
                          $loanAmount[$counter] = $row['loan_amount'];
                        }
                    }

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  edl_credit_revenue_table WHERE checque_number != '' and reference_number = '' order by date_transaction asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $voucherNumber[$counter] = $row['voucher_number'];
                    $checqueNumber[$counter] = $row['checque_number'];
                    $amountRelease[$counter] = $row['amount_release'];
                    $dateRelease[$counter] = $row['date_transaction'];

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

                    $sqlLA = "SELECT * FROM edl_loan_table WHERE id_number = '$idNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]' ";
                    $resultLA = $conn->query($sqlLA);

                    if($resultLA->num_rows > 0){
                        while($row = mysqli_fetch_array($resultLA)){
                          $loanAmount[$counter] = $row['loan_amount'];
                        }
                    }

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  eml_credit_revenue_table WHERE checque_number != '' and reference_number = '' order by date_transaction asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $voucherNumber[$counter] = $row['voucher_number'];
                    $checqueNumber[$counter] = $row['checque_number'];
                    $amountRelease[$counter] = $row['amount_release'];
                    $dateRelease[$counter] = $row['date_transaction'];

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

                    $sqlLA = "SELECT * FROM eml_loan_table WHERE id_number = '$idNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]' ";
                    $resultLA = $conn->query($sqlLA);

                    if($resultLA->num_rows > 0){
                        while($row = mysqli_fetch_array($resultLA)){
                          $loanAmount[$counter] = $row['loan_amount'];
                        }
                    }

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  rl_credit_revenue_table WHERE checque_number != '' and reference_number = '' order by date_transaction asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $voucherNumber[$counter] = $row['voucher_number'];
                    $checqueNumber[$counter] = $row['checque_number'];
                    $amountRelease[$counter] = $row['amount_release'];
                    $dateRelease[$counter] = $row['date_transaction'];

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

                    $sqlLA = "SELECT * FROM rl_loan_table WHERE id_number = '$idNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]' ";
                    $resultLA = $conn->query($sqlLA);

                    if($resultLA->num_rows > 0){
                        while($row = mysqli_fetch_array($resultLA)){
                          $loanAmount[$counter] = $row['loan_amount'];
                        }
                    }

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  sl_credit_revenue_table WHERE checque_number != '' and reference_number = '' order by date_transaction asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_transaction'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $voucherNumber[$counter] = $row['voucher_number'];
                    $checqueNumber[$counter] = $row['checque_number'];
                    $amountRelease[$counter] = $row['amount_release'];
                    $dateRelease[$counter] = $row['date_transaction'];

                    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber[$counter]' ";
                    $resultSearchName = $conn->query($sqlSearchName);

                    if($resultSearchName->num_rows > 0){
                        while($row = mysqli_fetch_array($resultSearchName)){
                          $firstName[$counter] = $row['first_name'];
                          $middleName[$counter] = $row['middle_name'];
                          $lastName[$counter] = $row['last_name'];
                        }
                    }

                    echo "$loanApplicationNumber[$counter]";

                    $sqlLA = "SELECT * FROM sl_loan_table WHERE id_number = '$idNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]' ";
                    $resultLA = $conn->query($sqlLA);

                    if($resultLA->num_rows > 0){
                        while($row = mysqli_fetch_array($resultLA)){
                          $loanAmount[$counter] = $row['loan_amount'];
                        }
                    }

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        if($printReport == "printReport"){
            $pdf = new FPDF('L','mm','Letter');

            $rowCounter = 0;
            $totalLoanAmount = 0;
            $totalLoanRelease = 0;

            $pdf->SetFont('Arial','B',9);
            $pdf->AddPage();
            
            //Title
            $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
            $pdf->Cell(100,7,"Loan Release");$pdf->Ln();
            $pdf->Cell(30,7,"From");
            $pdf->Cell(30,7,"$startDate");$pdf->Ln();
            $pdf->Cell(30,7,"To");
            $pdf->Cell(30,7,"$endDate");$pdf->Ln();
            //Header
            $pdf->Cell(25,7,"ID #",1);
            $pdf->Cell(65,7,"Name",1);
            $pdf->Cell(30,7,"Loan ID",1);
            $pdf->Cell(30,7,"Voucher #",1);
            $pdf->Cell(30,7,"Checque #",1);
            $pdf->Cell(30,7,"Loan Amount",1);
            $pdf->Cell(30,7,"Release",1);
            $pdf->Ln();

            $fullName[] = "";
            while($rowCounter < $numRow) {
                $pdf->Cell(25,7,"$idNumber[$rowCounter]",1);
                $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                $pdf->Cell(65,7,"$fullName[$rowCounter]",1);
                $pdf->Cell(30,7,"$loanApplicationNumber[$rowCounter]",1);
                $pdf->Cell(30,7,"$voucherNumber[$rowCounter]",1);
                $pdf->Cell(30,7,"$checqueNumber[$rowCounter]",1);
                $totalLoanAmount = $totalLoanAmount + $loanAmount[$rowCounter];
                $pdf->Cell(30,7,number_format($loanAmount[$rowCounter],'2','.',','),1);
                $totalLoanRelease = $totalLoanRelease + $amountRelease[$rowCounter];
                $pdf->Cell(30,7,number_format($amountRelease[$rowCounter],'2','.',','),1);
                $pdf->Ln();
                $rowCounter ++;
            }

            //Total
            $pdf->Cell(25,7,"TOTAL",1);
            $pdf->Cell(65,7,"",1);
            $pdf->Cell(30,7,"",1);
            $pdf->Cell(30,7,"",1);
            $pdf->Cell(30,7,"",1);
            $pdf->Cell(30,7,"$totalLoanAmount",1);
            $pdf->Cell(30,7,"$totalLoanRelease",1);

            $pdf->Ln();
            $pdf->Ln();
            

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
	<title>Release Loan</title>
    <?php include "css.html" ?>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php include 'topbar.php';?>
    <div>
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
                <p>Loan Release</p>
                <br>
                <div class="table table-striped table-hover">
                    <?php
                    echo "<table>
                    <tr>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>Loan ID</th>
                        <th>Voucher #</th>
                        <th>Checque #</th>
                        <th>Loan Amount</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>";

                    $totalLoanAmount = 0;
                    $totalLoanRelease = 0;

                    $counterh = 0;
                    while($counterh < $numRow) {
                        echo "<tr>";
                            echo "<td>" . $idNumber[$counterh] . "</td>";
                            echo "<td>" . $lastName[$counterh] . ", " . $firstName[$counterh] . " " . $middleName[$counterh] . "</td>";
                            echo "<td>" . $loanApplicationNumber[$counterh] . "</td>";
                            echo "<td>" . $voucherNumber[$counterh] . "</td>";
                            echo "<td>" . $checqueNumber[$counterh] . "</td>";
                            $totalLoanAmount = $totalLoanAmount + $loanAmount[$counterh];
                            echo "<td>" . number_format($loanAmount[$counterh],'2','.','.') . "</td>";
                            $totalLoanRelease = $totalLoanRelease + $amountRelease[$counterh];
                            echo "<td>" . number_format($amountRelease[$counterh],'2','.','.') . "</td>";
                            echo "<td>" . $dateRelease[$counterh] . "</td>";
                        echo "</tr>";

                        $counterh++;
                    }

                     echo "<tr>";
                        echo "<td>" . "TOTAL" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "<td>" . number_format($totalLoanAmount,'2','.','.') . "</td>";
                        echo "<td>" . number_format($totalLoanRelease,'2','.','.') . "</td>";
                        echo "<td>" . "". "</td>";
                    echo "</tr>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
<?php include "css1.html" ?>
</html>