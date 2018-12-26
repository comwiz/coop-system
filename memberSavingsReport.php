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

$searchType = "";

$depositContaingerS[] = "";

$numRowD = 0;


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

    if (empty($_POST["searchType"])) {
        $countErr++;
    }else {
        $searchType = test_input($_POST["searchType"]);
    }


    if (!empty($_POST["exitB"])) {
        $exitB = test_input($_POST["exitB"]);
    }

    if($exitB == "exitB"){
        session_destroy();
    }

    if($searchType == "Summary" and ($dateTransaction == "dateTransaction" or $printReport == "printReport")){
        $sqlName = "SELECT * FROM  name_table order by last_name asc, first_name asc";
        $resultName = $conn->query($sqlName);
        $numRow = mysqli_num_rows($resultName);
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

                $sqlSavings = "SELECT * FROM  savings_table WHERE id_number = '$idNumber[$counter]' and (type_transaction = 'Deposit' or type_transaction = 'Retention' or type_transaction = 'Interest') and date_transaction <= '$endDate'";
                $resultSavings = $conn->query($sqlSavings);
                //$numRow = mysqli_num_rows($resultSavings);
                
                //$totalWithdraw = 0;
                if($resultSavings->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultSavings)) {
                        # code...
                        $dateTransaction = $row['date_transaction'];
                        $typeTransaction = $row['type_transaction'];
                        #

                        if($endDate >= $dateTransaction){
                            $totalSavingsTemp = $totalSavingsTemp  + $row['amount'];
                            $totalSavingsContainer[$counter] = $totalSavingsTemp;

                            if($startDate <= $dateTransaction and $endDate >= $dateTransaction){
                                //Deposit
                                if($typeTransaction == "Deposit"){
                                    $depositTemp = $depositTemp + $row['amount'];
                                    $depositContainer[$counter] = $depositTemp;
                                }else{
                                    if(empty($depositContainer[$counter])){
                                        $depositTemp = 0;
                                        $depositContainer[$counter] = 0;
                                    }
                                }
                                //Retention
                                if($typeTransaction == "Retention"){
                                    $retentionTemp = $retentionTemp + $row['amount'];
                                    $retentionContainer[$counter] = $retentionTemp;
                                }else{
                                    if(empty($retentionContainer[$counter])){
                                        $retentionTemp = 0;
                                        $retentionContainer[$counter] = 0;
                                    }
                                }
                                //Interest
                                if($typeTransaction == "Interest"){
                                    $interestTempt = $interestTempt + $row['amount'];
                                    $interestContainer[$counter] = $interestTempt;
                                }else{
                                    if(empty($interestContainer[$counter])){
                                        $interestTempt = 0;
                                        $interestContainer[$counter] = 0;
                                    }
                                }
                            }else{
                                if(empty($depositContainer[$counter])){
                                    $depositTemp = 0;
                                    $depositContainer[$counter] = 0;
                                }
                                if(empty($retentionContainer[$counter])){
                                    $retentionTemp = 0;
                                    $retentionContainer[$counter] = 0;
                                }
                                if(empty($interestContainer[$counter])){
                                    $interestTempt = 0;
                                    $interestContainer[$counter] = 0;
                                }
                            }
                        }else{
                            if(empty($totalSavingsContainer[$counter])){
                                $totalSavingsTemp = 0;
                                $totalSavingsContainer[$counter] = 0;
                            }

                            if(empty($depositContainer[$counter])){
                                $depositTemp = 0;
                                $depositContainer[$counter] = 0;
                            }
                            if(empty($retentionContainer[$counter])){
                                $retentionTemp = 0;
                                $retentionContainer[$counter] = 0;
                            }
                            if(empty($interestContainer[$counter])){
                                $interestTempt = 0;
                                $interestContainer[$counter] = 0;
                            }
                        }
                    }
                    $totalSavingsTemp = 0;
                    $depositTemp = 0;
                    $retentionTemp = 0;
                    $interestTemp = 0;
                }else{
                     $totalSavingsContainer[$counter] = 0;
                     $depositContainer[] = 0;
                     $retentionContainer[] = 0;
                     $interestContainer[] = 0;
                }

                $sqlWithdraw = "SELECT * FROM  savings_table WHERE id_number = '$idNumber[$counter]' and type_transaction = 'Withdraw' and date_transaction <= '$endDate' ";
                $resultWithdraw = $conn->query($sqlWithdraw);
                //$numRow = mysqli_num_rows($resultSavings);
                
                //$totalWithdraw = 0;
                $totalWithdrawTemp = 0;
                if($resultWithdraw->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultWithdraw)) {
                        $dateTransaction = $row['date_transaction'];
                        if($dateTransaction <= $endDate ){
                            $totalWithdrawTemp = $totalWithdrawTemp  + $row['amount'];
                            $totalWithdrawContainer[$counter] = $totalWithdrawTemp;

                            if($dateTransaction >= $startDate  and $dateTransaction <= $endDate ){
                                //Withdraw
                                $withdrawTemp = $withdrawTemp + $row['amount'];
                                $withdrawContainer[$counter] = $withdrawTemp;
                            }else{
                                if(empty($withdrawContainer[$counter])){
                                    $withdrawTemp = 0;
                                    $withdrawContainer[$counter] = 0;
                                }
                            }
                        }else{
                            if(empty($totalWithdrawContainer[$counter])){
                                $totalWithdrawContainer[$counter] = 0;
                                $withdrawTemp = 0;
                            }
                        }
                    }
                    $withdrawTemp = 0;
                    $totalWithdrawTemp = 0;
                }else{
                    $totalWithdrawContainer[$counter] = 0;
                    $withdrawContainer[$counter] = 0;
                }

                //Beginning Balance
                $begContainer[$counter] =  $totalSavingsContainer[$counter] - ($depositContainer[$counter] +  $retentionContainer[$counter] +  $interestContainer[$counter]) - ($totalWithdrawContainer[$counter] - $withdrawContainer[$counter]);

                //Actual Balance 
                $totalActualSavingsContainer[$counter] = $totalSavingsContainer[$counter] - $totalWithdrawContainer[$counter];
                $counter++;


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

                $pdf->SetFont('Arial','B',8);
                $pdf->AddPage('P','Legal', 0);

                //Title
                $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
                $pdf->Cell(100,7,"Savings Deposit");$pdf->Ln();
                $pdf->Cell(30,7,"From");
                $pdf->Cell(30,7,"$startDate");$pdf->Ln();
                $pdf->Cell(30,7,"To");
                $pdf->Cell(30,7,"$endDate");$pdf->Ln();
                //Header
                $pdf->Cell(20,7,"ID #",1);
                $pdf->Cell(55,7,"Name",1);
                $pdf->Cell(20,7,"Beginning",1);
                $pdf->Cell(20,7,"Deposit",1);
                $pdf->Cell(20,7,"Retention",1);
                $pdf->Cell(20,7,"Withdraw",1);
                $pdf->Cell(20,7,"Interet",1);
                $pdf->Cell(20,7,"End Balance",1);
                $pdf->Ln();

                $fullName[] = "";
                while($rowCounter < $numRow) {
                    if($totalActualSavingsContainer[$rowCounter] != 0 or $totalSavingsContainer[$rowCounter] > 0 or $withdrawContainer[$rowCounter] > 0 ){
                        $pdf->Cell(20,7,"$idNumber[$rowCounter]",1);
                        $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                        $pdf->Cell(55,7,"$fullName[$rowCounter]",1);
                        $totalSDBTemp = $totalSDBTemp + $begContainer[$rowCounter];
                        $pdf->Cell(20,7,number_format($begContainer[$rowCounter],'2','.',','),1);
                        $totaldepTemp = $totaldepTemp + $depositContainer[$rowCounter];
                        if($depositContainer[$rowCounter] > 0){
                            $pdf->Cell(20,7,number_format($depositContainer[$rowCounter],'2','.',','),1);
                        }else{
                            $pdf->Cell(20,7,"",1);
                        }
                        $totalretTemp = $totalretTemp + $retentionContainer[$rowCounter];
                        if($retentionContainer[$rowCounter] > 0){
                            $pdf->Cell(20,7,number_format($retentionContainer[$rowCounter],'2','.',','),1);
                        }else{
                            $pdf->Cell(20,7,"",1);
                        }
                        $totalwithTemp = $totalwithTemp + $withdrawContainer[$rowCounter];
                        if($withdrawContainer[$rowCounter] > 0){
                            $pdf->Cell(20,7,number_format($withdrawContainer[$rowCounter],'2','.',','),1);
                        }else{
                            $pdf->Cell(20,7,"",1);
                        }
                        $totalintTemp = $totalintTemp + $interestContainer[$rowCounter];
                        if($interestContainer[$rowCounter] > 0){
                            $pdf->Cell(20,7,number_format($interestContainer[$rowCounter],'2','.',','),1);
                        }else{
                            $pdf->Cell(20,7,"",1);
                        }
                        $totalSDTemp = $totalSDTemp + $totalActualSavingsContainer[$rowCounter];
                        if($totalActualSavingsContainer[$rowCounter] > 0){
                            $pdf->Cell(20,7,number_format($totalActualSavingsContainer[$rowCounter],'2','.',','),1);
                        }else{
                            $pdf->Cell(20,7,"",1);
                        }
                        $pdf->Ln();
                    }
                    $rowCounter ++;
                }

                //Total
                $pdf->Cell(20,7,"TOTAL",1);
                $pdf->Cell(55,7,"",1);
                $pdf->Cell(20,7,number_format($totalSDBTemp,'2','.',','),1);
                $pdf->Cell(20,7,number_format($totaldepTemp,'2','.',','),1);
                $pdf->Cell(20,7,number_format($totalretTemp,'2','.',','),1);
                $pdf->Cell(20,7,number_format($totalwithTemp,'2','.',','),1);
                $pdf->Cell(20,7,number_format($totalintTemp,'2','.',','),1);
                $pdf->Cell(20,7,number_format($totalSDTemp,'2','.',','),1);

                $pdf->Output();
            }
        }
    }elseif($searchType != "Summary" and ($dateTransaction == "dateTransaction" or $printReport == "printReport")){

        $sqlSavings = "SELECT * FROM  savings_table WHERE type_transaction = '$searchType' and date_transaction >= '$startDate' and  date_transaction <= '$endDate' order by  reference_number";
        $resultSavings = $conn->query($sqlSavings);
        $numRowD = mysqli_num_rows($resultSavings);
        $counterD = 0;
        
        
        if($resultSavings->num_rows > 0){
            while ($row = mysqli_fetch_array($resultSavings)) {
            
                $idNumberD[$counterD] = $row['id_number'];
                $referenceNumber[$counterD] = $row['reference_number'];
                $depositContaingerS[$counterD] = $row['amount'];
                $dateDeposit[$counterD] = $row['date_transaction'];

                $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumberD[$counterD]' ";
                $resultName = $conn->query($sqlName);
                $numRow = mysqli_num_rows($resultName);
                $counter = 0;

                if($resultName->num_rows > 0){

                    while ($row = mysqli_fetch_array($resultName)) {
                        # code...
                        $idNumber[$counterD] = $row['id_number'];
                        $firstName[$counterD] = $row['first_name'];
                        $middleName[$counterD] = $row['middle_name'];
                        $lastName[$counterD] = $row['last_name'];
                    }

                    
                }

                $counterD++;
            }    
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

            $pdf->SetFont('Arial','B',8);
            $pdf->AddPage('P','Legal', 0);

            //Title
            $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
            $pdf->Cell(30,7,"Member $searchType");$pdf->Ln();
            $pdf->Cell(30,7,"From");
            $pdf->Cell(30,7,"$startDate");$pdf->Ln();
            $pdf->Cell(30,7,"To");
            $pdf->Cell(30,7,"$endDate");$pdf->Ln();
            //Header
            $pdf->Ln();
            

            $pdf->Cell(20,7,"",1);
            $pdf->Cell(20,7,"ID #",1);
            $pdf->Cell(55,7,"Name",1);
            $pdf->Cell(20,7,"Reference",1);
            $pdf->Cell(20,7,"Amount",1);
            $pdf->Cell(20,7,"Date",1);

            $pdf->Ln();

            $fullName[] = "";
            $rowCounterT = 1;
            $totalamountT = 0;
            while($rowCounter < $numRowD) {
                $pdf->Cell(20,7,"$rowCounterT",1);
                $pdf->Cell(20,7,"$idNumber[$rowCounter]",1);
                $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                $pdf->Cell(55,7,"$fullName[$rowCounter]",1);
                $pdf->Cell(20,7,"$referenceNumber[$rowCounter]",1);

                $totalamountT = $totalamountT + $depositContaingerS[$rowCounter];

                $pdf->Cell(20,7,number_format($depositContaingerS[$rowCounter],'2','.',','),1);
                $pdf->Cell(20,7,"$dateDeposit[$rowCounter]",1);

                $pdf->Ln();

                $rowCounter ++;
                $rowCounterT ++;
            }

            //Total
            $pdf->Cell(20,7,"TOTAL",1);
            $pdf->Cell(20,7,"",1);
            $pdf->Cell(55,7,"",1);
            $pdf->Cell(20,7,"",1);
            $pdf->Cell(20,7,number_format($totalamountT,'2','.',','),1);
            $pdf->Cell(20,7,"",1);

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
        <?php //include 'topbar.php';?>
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-9" style="margin-top:70px;margin-left: 16.7%;">
                <div class="row">
                    <div class="form-group">
                        <select class="form-control" id="tpres" name="searchType" value="<?php echo $searchType;?>">
                          <option value="" <?php if($searchType == "") echo "selected"; ?>>Select</option>
                          <option value="Deposit" <?php if($searchType == "Deposit") echo "selected"; ?>>Deposit</option>
                          <option value="Interest" <?php if($searchType == "Interest") echo "selected"; ?>>Interest</option>
                          <option value="Retention" <?php if($searchType == "Retention") echo "selected"; ?>>Retention</option>
                          <option value="Withdraw" <?php if($searchType == "Withdraw") echo "selected"; ?>>Withdraw</option>
                          <option value="Summary" <?php if($searchType == "Summary") echo "selected"; ?>>Summary</option>
                        </select>
                    </div>

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
                            <button class="btn btn-outline-success my-2 my-sm-0" name = "dateTransaction" value = "dateTransaction" type="submit" style="align-self: center;">SEARCH</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 form">
                            <button class="btn btn-outline-success my-2 my-sm-0" name = "printReport" value = "printReport" type="submit" style="align-self: center;">PRINT</button>
                        </div>
                    </div>
                </div>

                <p>Member Savings</p>
                <br>
                <div class="table table-striped table-hover table-bordered">
                    <?php
                        if($searchType == "Summary"){
                            echo "<table>
                            <tr>
                                <th></th>
                                <th>ID #</th>
                                <th>Name</th>
                                <th>Beginning</th>
                                <th>Deposit</th>
                                <th>Retention</th>
                                <th>Withdraw</th>
                                <th>Interest</th>
                                <th>End Balance</th>
                            </tr>";
                            
                            $totalSDBTemp = 0;
                            $totaldepTemp = 0;
                            $totalretTemp = 0;
                            $totalwithTemp = 0;
                            $totalintTemp = 0;
                            $totalSDTemp = 0;

                            $counterh = 0;
                            $counterT = 1;
                            
                            while($counterh < $numRow) {
                                    if($totalActualSavingsContainer[$counterh] != 0 or $totalSavingsContainer[$counterh] > 0 or $withdrawContainer[$counterh] > 0 ){
                                        echo "<tr>";
                                            echo "<td>" . $counterT . "</td>";
                                            echo "<td>" . $idNumber[$counterh] . "</td>";
                                            echo "<td>" . $lastName[$counterh] . ", " . $firstName[$counterh] . " " . $middleName[$counterh] . "</td>";
                                            $totalSDBTemp = $totalSDBTemp + $begContainer[$counterh];
                                            echo "<td>" . number_format($begContainer[$counterh],'2','.','.') . "</td>";
                                            $totaldepTemp = $totaldepTemp + $depositContainer[$counterh];
                                            if($depositContainer[$counterh] != 0){
                                                echo "<td " . "style=" . "color:blue" . ">" . number_format($depositContainer[$counterh],'2','.','.') . "</td>";
                                            }else{
                                                echo "<td " . "style=" . "color:blue" . ">" . "" . "</td>";
                                            }
                                            $totalretTemp = $totalretTemp + $retentionContainer[$counterh];
                                            if($retentionContainer[$counterh] != 0){
                                                echo "<td " . "style=" . "color:blue" . ">" . number_format($retentionContainer[$counterh],'2','.','.') . "</td>";
                                            }else{
                                                echo "<td " . "style=" . "color:blue" . ">" . "" . "</td>";
                                            }
                                            $totalwithTemp = $totalwithTemp + $withdrawContainer[$counterh];
                                            if($withdrawContainer[$counterh] != 0){
                                                echo "<td " . "style=" . "color:red" . ">" . number_format($withdrawContainer[$counterh],'2','.','.') . "</td>";
                                            }else{
                                                echo "<td " . "style=" . "color:red" . ">" . "" . "</td>";
                                            }
                                            $totalintTemp = $totalintTemp + $interestContainer[$counterh];
                                            if($interestContainer[$counterh] != 0){
                                                echo "<td " . "style=" . "color:blue" . ">" . number_format($interestContainer[$counterh],'2','.','.') . "</td>";
                                            }else{
                                                echo "<td " . "style=" . "color:blue" . ">" . "" . "</td>";
                                            }
                                            $totalSDTemp = $totalSDTemp + $totalActualSavingsContainer[$counterh];
                                            if($totalActualSavingsContainer[$counterh] != 0){
                                                echo "<td " . "style=" . "color:green" . ">" . number_format($totalActualSavingsContainer[$counterh],'2','.','.') . "</td>";
                                            }else{
                                                echo "<td " . "style=" . "color:green" . ">" . "" . "</td>";
                                            }
                                        echo "</tr>";
                                    }
                                    $counterh ++;
                                    $counterT ++;
                            }
                            
                            echo "<tr>";
                                echo "<td>" . "TOTAL" . "</td>";
                                echo "<td>" . "". "</td>";
                                echo "<td>" . "". "</td>";
                                echo "<td>" . number_format($totalSDBTemp,'2','.','.') . "</td>";
                                echo "<td " . "style=" . "color:blue" . ">" . number_format($totaldepTemp,'2','.','.') . "</td>";
                                echo "<td " . "style=" . "color:blue" . ">" . number_format($totalretTemp,'2','.','.') . "</td>";
                                echo "<td " . "style=" . "color:red" . ">" . number_format($totalwithTemp,'2','.','.') . "</td>";
                                echo "<td " . "style=" . "color:blue" . ">" . number_format($totalintTemp,'2','.','.') . "</td>";
                                echo "<td " . "style=" . "color:green" . ">" . number_format($totalSDTemp,'2','.','.') . "</td>";
                            echo "</tr>";
                        }else{
                            echo "<table>
                            <tr>
                                <th></th>
                                <th>ID #</th>
                                <th>Name</th>
                                <th>Reference Number</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>";
                            
                            $counterh = 0;
                            $counterT = 1;

                            $totalamountT = 0;
                            
                            while($counterh < $numRowD) {
                                echo "<tr>";
                                    echo "<td>" . $counterT . "</td>";
                                    echo "<td>" . $idNumber[$counterh] . "</td>";
                                    echo "<td>" . $lastName[$counterh] . ", " . $firstName[$counterh] . " " . $middleName[$counterh] . "</td>";
                                    echo "<td>" . $referenceNumber[$counterh] . "</td>";
                                    $totalamountT = $totalamountT + $depositContaingerS[$counterh];
                                    echo "<td " . "style=" . "color:blue" . ">" . number_format($depositContaingerS[$counterh],'2','.','.') . "</td>";
                                    echo "<td>" . $dateDeposit[$counterh] . "</td>";
                                echo "</tr>";
                                
                                $counterh ++;
                                $counterT ++;
                            }
                            
                            echo "<tr>";
                                echo "<td>" . "TOTAL" . "</td>";
                                echo "<td>" . "". "</td>";
                                echo "<td>" . "". "</td>";
                                echo "<td>" . "". "</td>";
                                echo "<td " . "style=" . "color:blue" . ">" . number_format($totalamountT,'2','.','.') . "</td>";
                                echo "<td>" . "". "</td>";
                            echo "</tr>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
<?php include "css1.html" ?>
</html>