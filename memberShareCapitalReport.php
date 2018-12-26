<?php  

require_once 'session.php';

$idNumber [] = "";
$accountNumber [] = "";

$firstName  [] = "";
$middleName [] = "";
$lastName [] = "";

$startDate = "";
$endDate = "";
$dateTransaction = "";
$printReport = "";

$searchReport = ""; 
$numRow = "";
$searchMember = "";

$exitB = "";

$countErr = 0;

$searchType = "";
$numRowD = 0;

require('public/fpdf181/fpdf.php');

if(($_SERVER["REQUEST_METHOD"])== "POST"){

    if (!empty($_POST["dateTransaction"])) {
        $dateTransaction = test_input($_POST["dateTransaction"]);
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

    if (empty($_POST["searchMember"])) {
        $countErr++;
    }else {
        $searchMember = test_input($_POST["searchMember"]);
    }

    if (empty($_POST["searchType"])) {
        $countErr++;
    }else {
        $searchType = test_input($_POST["searchType"]);
    }

    if($exitB == "exitB"){
        session_destroy();
    }

    if($searchType == "Summary" and ($dateTransaction == "dateTransaction" or $printReport == "printReport")){

        if($searchMember == "Regular"){
            $sqlName = "SELECT * FROM  name_table  WHERE type_membership = 'Regular' order by last_name asc, first_name asc ";
            $resultName = $conn->query($sqlName);
            $numRow = mysqli_num_rows($resultName);
            $counter = 0;

            //$counterShareCapital = 0;
            $scfTemp = 0;
            $scfContainer[] = 0;
            $cbuTemp = 0;
            $cbuContainer[] = 0;
            $recruitTemp = 0;
            $recruitContainer[] = 0;
            $retentionTemp = 0;
            $retentionContainer[] = 0;

            //$totalPartialShareCapitalTemp = 0;
            $totalPartialShareCapitalContainer[] = "";  

            $totalShareCapitalTemp = 0;
            $totalShareCapitalContainer[] = "";

            $totalActualShareCapitalContainer[] = "";

            $typeTransaction = "";

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    # code...
                    $idNumber[$counter] = $row['id_number'];
                    $accountNumber[$counter] = $row['account_number'];
                    $firstName[$counter] = $row['first_name'];
                    $middleName[$counter] = $row['middle_name'];
                    $lastName[$counter] = $row['last_name'];

                    $sqlShareCapital = "SELECT * FROM  share_capital_table WHERE id_number = '$idNumber[$counter]' and (type_transaction = 'BSC' or type_transaction = 'Retention' or type_transaction = 'CBU' or type_transaction = 'SCF' or type_transaction = 'Recruit') and date_transaction <= '$endDate' ";
                    $resultShareCapital = $conn->query($sqlShareCapital);
                    
                    if($resultShareCapital->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultShareCapital)) {
                            # code...
                             $dateTransaction = $row['date_transaction'];
                             $typeTransaction = $row['type_transaction'];

                             if($endDate >= $dateTransaction){
                                $totalShareCapitalTemp = $totalShareCapitalTemp  + $row['amount'];
                                $totalShareCapitalContainer[$counter] = $totalShareCapitalTemp;

                                if($startDate <= $dateTransaction and $endDate >= $dateTransaction){

                                    if($typeTransaction == "SCF"){
                                        $scfTemp = $scfTemp + $row['amount'];
                                        $scfContainer[$counter] = $scfTemp;
                                    }else{
                                        if(empty($scfContainer[$counter])){
                                            $scfTemp = 0;
                                            $scfContainer[$counter] = 0;
                                        }
                                    }

                                    if($typeTransaction == "CBU"){
                                        $cbuTemp =  $cbuTemp + $row['amount'];
                                        $cbuContainer[$counter] = $cbuTemp;
                                    }else{
                                        if(empty($cbuContainer[$counter])){
                                            $cbuTemp= 0;
                                            $cbuContainer[$counter] = 0;
                                        }
                                    }

                                    if($typeTransaction == "Retention"){
                                        $retentionTemp =  $retentionTemp + $row['amount'];
                                        $retentionContainer[$counter] = $retentionTemp;
                                    }else{
                                        if(empty($retentionContainer[$counter])){
                                            $retentionTemp= 0;
                                            $retentionContainer[$counter] = 0;
                                        }
                                    }

                                    if($typeTransaction == "Recruit"){
                                        $recruitTemp =  $recruitTemp + $row['amount'];
                                        $recruitContainer[$counter] = $recruitTemp;
                                    }else{
                                        if(empty($recruitContainer[$counter])){
                                            $recruitTemp= 0;
                                            $recruitContainer[$counter] = 0;
                                        }
                                    }
                                }else{
                                    if(empty($scfContainer[$counter])){
                                        $scfTemp = 0;
                                        $scfContainer[$counter] = 0;
                                    }

                                    if(empty($cbuContainer[$counter])){
                                        $cbuTemp= 0;
                                        $cbuContainer[$counter] = 0;
                                    }

                                    if(empty($retentionContainer[$counter])){
                                        $retentionTemp= 0;
                                        $retentionContainer[$counter] = 0;
                                    }

                                    if(empty($recruitContainer[$counter])){
                                        $recruitTemp= 0;
                                        $recruitContainer[$counter] = 0;
                                    }
                                }
                             }else{
                                if(empty($totalShareCapitalContainer[$counter])){
                                    $totalShareCapitalTemp = 0;
                                    $totalShareCapitalContainer[$counter] = 0;
                                }

                                if(empty($scfContainer[$counter])){
                                    $scfTemp = 0;
                                    $scfContainer[$counter] = 0;
                                }

                                if(empty($cbuContainer[$counter])){
                                    $cbuTemp= 0;
                                    $cbuContainer[$counter] = 0;
                                }

                                if(empty($retentionContainer[$counter])){
                                    $retentionTemp= 0;
                                    $retentionContainer[$counter] = 0;
                                }

                                if(empty($recruitContainer[$counter])){
                                    $recruitTemp= 0;
                                    $recruitContainer[$counter] = 0;
                                }
                             }
                        }
                        $scfTemp = 0;
                        $cbuTemp = 0;
                        $retentionTemp = 0;
                        $recruitTemp = 0;
                        $totalShareCapitalTemp = 0;
                    }else{
                         $totalShareCapitalContainer[$counter] = 0;
                         $scfContainer[$counter] = 0;
                         $cbuContainer[$counter] = 0;
                         $retentionContainer[$counter] = 0;
                         $recruitContainer[$counter] = 0;
                    }

                    $sqlWithdraw = "SELECT * FROM  share_capital_table WHERE id_number = '$idNumber[$counter]' and type_transaction = 'Withdraw' and date_transaction <= '$endDate' ";
                    $resultWithdraw = $conn->query($sqlWithdraw);
                    
                    $totalWithdrawTemp = 0;
                    if($resultWithdraw->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultWithdraw)) {
                            # code...
                             $dateTransaction = $row['date_transaction'];

                            if($endDate >= $dateTransaction){
                                $totalWithdrawTemp = $totalWithdrawTemp  + $row['amount'];
                                $totalWithdrawContainer[$counter] = $totalWithdrawTemp;
                            }else{
                                if(empty($totalWithdrawContainer[$counter])){
                                    $totalWithdrawTemp = 0;
                                    $totalWithdrawContainer[$counter] = 0;
                                }
                            }
                        }
                        $totalWithdrawTemp = 0;
                    }else{
                        $totalWithdrawContainer[$counter] = 0;
                    }

                    $totalPartialShareCapitalContainer[$counter] = $totalShareCapitalContainer[$counter] - ($scfContainer[$counter] + $cbuContainer[$counter] + $recruitContainer[$counter] + $retentionContainer[$counter]);
                    $totalActualShareCapitalContainer[$counter] = $totalShareCapitalContainer[$counter] - $totalWithdrawContainer[$counter];
                    $counter++;
                }

                if($printReport == "printReport"){

                    $totalSCBTemp = 0;
                    $totalscfTemp = 0;
                    $totalcbuTemp = 0;
                    $totalrecruitTemp = 0;
                    $totalretentionTemp = 0;
                    $totalSCTemp = 0;
                    $totalASCTemp = 0;
                    $totalFC = 0;

                    $pdf = new FPDF();

                    $rowCounter = 0;

                    $pdf->SetFont('Arial','B',9);
                    $pdf->AddPage('L','Legal', 0);

                    //Title
                    $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
                    $pdf->Cell(100,7,"Schedule of Share Capital");$pdf->Ln();
                    
                    if($searchMember == "Regular"){
                        $typeShare = "Common Shares";
                    }elseif($searchMember == "Associate"){
                        $typeShare = "Preffered Shares";
                    }else{
                        $typeShare = "Common and Preffred Shares";
                    }
                    $pdf->Cell(30,7,"$typeShare");$pdf->Ln();
                    $pdf->Cell(30,7,"From");
                    $pdf->Cell(30,7,"$startDate");$pdf->Ln();
                    $pdf->Cell(30,7,"To");
                    $pdf->Cell(30,7,"$endDate");$pdf->Ln();
                    //Header
                    $pdf->Cell(30,7,"ID #",1);
                    $pdf->Cell(65,7,"Name",1);
                    $pdf->Cell(30,7,"Paid Up Capital",1);
                    $pdf->Cell(25,7,"SSC",1);
                    $pdf->Cell(25,7,"CBU",1);
                    $pdf->Cell(25,7,"Recruit",1);
                    $pdf->Cell(25,7,"Loan Retention",1);
                    $pdf->Cell(30,7,"Total Share Capital",1);
                    $pdf->Cell(35,7,"Future Subscription",1);
                    $pdf->Cell(30,7,"Paid up Share Capital",1);
                    $pdf->Ln();

                    $fullName[] = "";
                    while($rowCounter < $numRow) {
                        if($totalActualShareCapitalContainer[$rowCounter] != 0){
                            $pdf->Cell(30,7,"$idNumber[$rowCounter]",1);
                            $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                            $pdf->Cell(65,7,"$fullName[$rowCounter]",1);
                            $totalSCBTemp = $totalSCBTemp + $totalPartialShareCapitalContainer[$rowCounter];
                            $pdf->Cell(30,7,number_format($totalPartialShareCapitalContainer[$rowCounter],'2','.',','),1);
                            $totalscfTemp = $totalscfTemp + $scfContainer[$rowCounter];
                            if($scfContainer[$rowCounter] > 0){
                                $pdf->Cell(25,7,number_format($scfContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(25,7,"",1);
                            }
                            $totalcbuTemp = $totalcbuTemp + $cbuContainer[$rowCounter];
                            if($cbuContainer[$rowCounter] > 0){
                                $pdf->Cell(25,7,number_format($cbuContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(25,7,"",1);
                            }
                            $totalrecruitTemp = $totalrecruitTemp + $recruitContainer[$rowCounter];
                            if($recruitContainer[$rowCounter] > 0){
                                $pdf->Cell(25,7,number_format($recruitContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(25,7,"",1);
                            }
                            $totalretentionTemp = $totalretentionTemp + $retentionContainer[$rowCounter];
                            if($retentionContainer[$rowCounter] > 0){
                                $pdf->Cell(25,7,number_format($retentionContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(25,7,"",1);
                            }

                            $totalASCTemp = $totalASCTemp + $totalActualShareCapitalContainer[$rowCounter];
                            if($totalActualShareCapitalContainer[$rowCounter] > 0){
                                $pdf->Cell(30,7,number_format($totalActualShareCapitalContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(30,7,"",1);
                            }

                            $FSContainerFlag = fmod($totalActualShareCapitalContainer[$rowCounter],100);
                            $totalFC = $totalFC + $FSContainerFlag;
                            if($FSContainerFlag > 0){
                                $pdf->Cell(35,7,number_format($FSContainerFlag,'2','.',','),1);
                            }else{
                                $pdf->Cell(35,7,"",1);
                            }

                            $totalActualShareCapitalContainer[$rowCounter] =  $totalActualShareCapitalContainer[$rowCounter] - $FSContainerFlag;
                            $totalSCTemp = $totalSCTemp + $totalActualShareCapitalContainer[$rowCounter];
                            if($totalActualShareCapitalContainer[$rowCounter] > 0){
                                $pdf->Cell(30,7,number_format($totalActualShareCapitalContainer[$rowCounter],'2','.',','),1);
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
                    $pdf->Cell(30,7,number_format($totalSCBTemp,'2','.',','),1);
                    $pdf->Cell(25,7,number_format($totalscfTemp,'2','.',','),1);
                    $pdf->Cell(25,7,number_format($totalcbuTemp,'2','.',','),1);
                    $pdf->Cell(25,7,number_format($totalrecruitTemp,'2','.',','),1);
                    $pdf->Cell(25,7,number_format($totalretentionTemp,'2','.',','),1);
                    $pdf->Cell(30,7,number_format($totalASCTemp,'2','.',','),1);
                    $pdf->Cell(35,7,number_format($totalFC,'2','.',','),1);
                    $pdf->Cell(30,7,number_format($totalSCTemp,'2','.',','),1);


                    $pdf->Output();
                }
            }
        }elseif($searchMember == "Associate"){
            $sqlName = "SELECT * FROM  name_table  WHERE type_membership = 'Associate' order by last_name asc, first_name asc ";
            $resultName = $conn->query($sqlName);
            $numRow = mysqli_num_rows($resultName);
            $counter = 0;

            //$counterShareCapital = 0;
            $scfTemp = 0;
            $scfContainer[] = 0;
            $cbuTemp = 0;
            $cbuContainer[] = 0;
            $recruitTemp = 0;
            $recruitContainer[] = 0;
            $retentionTemp = 0;
            $retentionContainer[] = 0;

            //$totalPartialShareCapitalTemp = 0;
            $totalPartialShareCapitalContainer[] = "";  

            $totalShareCapitalTemp = 0;
            $totalShareCapitalContainer[] = "";

            $totalActualShareCapitalContainer[] = "";

            $typeTransaction = "";

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    # code...
                    $idNumber[$counter] = $row['id_number'];
                    $accountNumber[$counter] = $row['account_number'];
                    $firstName[$counter] = $row['first_name'];
                    $middleName[$counter] = $row['middle_name'];
                    $lastName[$counter] = $row['last_name'];

                    $sqlShareCapital = "SELECT * FROM  share_capital_table WHERE id_number = '$idNumber[$counter]' and (type_transaction = 'BSC' or type_transaction = 'Retention' or type_transaction = 'CBU' or type_transaction = 'SCF' or type_transaction = 'Recruit') and date_transaction <= '$endDate' ";
                    $resultShareCapital = $conn->query($sqlShareCapital);
                    
                    if($resultShareCapital->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultShareCapital)) {
                            # code...
                             $dateTransaction = $row['date_transaction'];
                             $typeTransaction = $row['type_transaction'];

                             if($endDate >= $dateTransaction){
                                $totalShareCapitalTemp = $totalShareCapitalTemp  + $row['amount'];
                                $totalShareCapitalContainer[$counter] = $totalShareCapitalTemp;

                                if($startDate <= $dateTransaction and $endDate >= $dateTransaction){

                                    if($typeTransaction == "SCF"){
                                        $scfTemp = $scfTemp + $row['amount'];
                                        $scfContainer[$counter] = $scfTemp;
                                    }else{
                                        if(empty($scfContainer[$counter])){
                                            $scfTemp = 0;
                                            $scfContainer[$counter] = 0;
                                        }
                                    }

                                    if($typeTransaction == "CBU"){
                                        $cbuTemp =  $cbuTemp + $row['amount'];
                                        $cbuContainer[$counter] = $cbuTemp;
                                    }else{
                                        if(empty($cbuContainer[$counter])){
                                            $cbuTemp= 0;
                                            $cbuContainer[$counter] = 0;
                                        }
                                    }

                                    if($typeTransaction == "Retention"){
                                        $retentionTemp =  $retentionTemp + $row['amount'];
                                        $retentionContainer[$counter] = $retentionTemp;
                                    }else{
                                        if(empty($retentionContainer[$counter])){
                                            $retentionTemp= 0;
                                            $retentionContainer[$counter] = 0;
                                        }
                                    }

                                    if($typeTransaction == "Recruit"){
                                        $recruitTemp =  $recruitTemp + $row['amount'];
                                        $recruitContainer[$counter] = $recruitTemp;
                                    }else{
                                        if(empty($recruitContainer[$counter])){
                                            $recruitTemp= 0;
                                            $recruitContainer[$counter] = 0;
                                        }
                                    }
                                }else{
                                    if(empty($scfContainer[$counter])){
                                        $scfTemp = 0;
                                        $scfContainer[$counter] = 0;
                                    }

                                    if(empty($cbuContainer[$counter])){
                                        $cbuTemp= 0;
                                        $cbuContainer[$counter] = 0;
                                    }

                                    if(empty($retentionContainer[$counter])){
                                        $retentionTemp= 0;
                                        $retentionContainer[$counter] = 0;
                                    }

                                    if(empty($recruitContainer[$counter])){
                                        $recruitTemp= 0;
                                        $recruitContainer[$counter] = 0;
                                    }
                                }
                             }else{
                                if(empty($totalShareCapitalContainer[$counter])){
                                    $totalShareCapitalTemp = 0;
                                    $totalShareCapitalContainer[$counter] = 0;
                                }

                                if(empty($scfContainer[$counter])){
                                    $scfTemp = 0;
                                    $scfContainer[$counter] = 0;
                                }

                                if(empty($cbuContainer[$counter])){
                                    $cbuTemp= 0;
                                    $cbuContainer[$counter] = 0;
                                }

                                if(empty($retentionContainer[$counter])){
                                    $retentionTemp= 0;
                                    $retentionContainer[$counter] = 0;
                                }

                                if(empty($recruitContainer[$counter])){
                                    $recruitTemp= 0;
                                    $recruitContainer[$counter] = 0;
                                }
                             }
                        }
                        $scfTemp = 0;
                        $cbuTemp = 0;
                        $retentionTemp = 0;
                        $recruitTemp = 0;
                        $totalShareCapitalTemp = 0;
                    }else{
                         $totalShareCapitalContainer[$counter] = 0;
                         $scfContainer[$counter] = 0;
                         $cbuContainer[$counter] = 0;
                         $retentionContainer[$counter] = 0;
                         $recruitContainer[$counter] = 0;
                    }

                    $sqlWithdraw = "SELECT * FROM  share_capital_table WHERE id_number = '$idNumber[$counter]' and type_transaction = 'Withdraw' and date_transaction <= '$endDate'";
                    $resultWithdraw = $conn->query($sqlWithdraw);
                    
                    $totalWithdrawTemp = 0;
                    if($resultWithdraw->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultWithdraw)) {
                            # code...
                             $dateTransaction = $row['date_transaction'];

                            if($endDate >= $dateTransaction){
                                $totalWithdrawTemp = $totalWithdrawTemp  + $row['amount'];
                                $totalWithdrawContainer[$counter] = $totalWithdrawTemp;
                            }else{
                                if(empty($totalWithdrawContainer[$counter])){
                                    $totalWithdrawTemp = 0;
                                    $totalWithdrawContainer[$counter] = 0;
                                }
                            }
                        }
                        $totalWithdrawTemp = 0;
                    }else{
                        $totalWithdrawContainer[$counter] = 0;
                    }

                    $totalPartialShareCapitalContainer[$counter] = $totalShareCapitalContainer[$counter] - ($scfContainer[$counter] + $cbuContainer[$counter] + $recruitContainer[$counter] + $retentionContainer[$counter]);
                    $totalActualShareCapitalContainer[$counter] = $totalShareCapitalContainer[$counter] - $totalWithdrawContainer[$counter];
                    $counter++;
                }

                if($printReport == "printReport"){

                    $totalSCBTemp = 0;
                    $totalscfTemp = 0;
                    $totalcbuTemp = 0;
                    $totalrecruitTemp = 0;
                    $totalretentionTemp = 0;
                    $totalSCTemp = 0;
                    $totalASCTemp = 0;
                    $totalFC = 0;

                    $pdf = new FPDF();

                    $rowCounter = 0;

                    $pdf->SetFont('Arial','B',9);
                    $pdf->AddPage('L','Legal', 0);

                    //Title
                    $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
                    $pdf->Cell(100,7,"Schedule of Share Capital");$pdf->Ln();
                    
                    if($searchMember == "Regular"){
                        $typeShare = "Common Shares";
                    }elseif($searchMember == "Associate"){
                        $typeShare = "Preffered Shares";
                    }else{
                        $typeShare = "Common and Preffred Shares";
                    }
                    $pdf->Cell(30,7,"$typeShare");$pdf->Ln();
                    $pdf->Cell(30,7,"From");
                    $pdf->Cell(30,7,"$startDate");$pdf->Ln();
                    $pdf->Cell(30,7,"To");
                    $pdf->Cell(30,7,"$endDate");$pdf->Ln();
                    //Header
                    $pdf->Cell(30,7,"ID #",1);
                    $pdf->Cell(65,7,"Name",1);
                    $pdf->Cell(30,7,"Paid Up Capital",1);
                    $pdf->Cell(25,7,"SSC",1);
                    $pdf->Cell(25,7,"CBU",1);
                    $pdf->Cell(25,7,"Recruit",1);
                    $pdf->Cell(25,7,"Loan Retention",1);
                    $pdf->Cell(30,7,"Total Share Capital",1);
                    $pdf->Cell(35,7,"Future Subscription",1);
                    $pdf->Cell(30,7,"Paid up Share Capital",1);
                    $pdf->Ln();

                    $fullName[] = "";
                    while($rowCounter < $numRow) {
                        if($totalActualShareCapitalContainer[$rowCounter] != 0){
                            $pdf->Cell(30,7,"$idNumber[$rowCounter]",1);
                            $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                            $pdf->Cell(65,7,"$fullName[$rowCounter]",1);
                            $totalSCBTemp = $totalSCBTemp + $totalPartialShareCapitalContainer[$rowCounter];
                            $pdf->Cell(30,7,number_format($totalPartialShareCapitalContainer[$rowCounter],'2','.',','),1);
                            $totalscfTemp = $totalscfTemp + $scfContainer[$rowCounter];
                            if($scfContainer[$rowCounter] > 0){
                                $pdf->Cell(25,7,number_format($scfContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(25,7,"",1);
                            }
                            $totalcbuTemp = $totalcbuTemp + $cbuContainer[$rowCounter];
                            if($cbuContainer[$rowCounter] > 0){
                                $pdf->Cell(25,7,number_format($cbuContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(25,7,"",1);
                            }
                            $totalrecruitTemp = $totalrecruitTemp + $recruitContainer[$rowCounter];
                            if($recruitContainer[$rowCounter] > 0){
                                $pdf->Cell(25,7,number_format($recruitContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(25,7,"",1);
                            }
                            $totalretentionTemp = $totalretentionTemp + $retentionContainer[$rowCounter];
                            if($retentionContainer[$rowCounter] > 0){
                                $pdf->Cell(25,7,number_format($retentionContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(25,7,"",1);
                            }

                            $totalASCTemp = $totalASCTemp + $totalActualShareCapitalContainer[$rowCounter];
                            if($totalActualShareCapitalContainer[$rowCounter] > 0){
                                $pdf->Cell(30,7,number_format($totalActualShareCapitalContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(30,7,"",1);
                            }

                            $FSContainerFlag = fmod($totalActualShareCapitalContainer[$rowCounter],100);
                            $totalFC = $totalFC + $FSContainerFlag;
                            if($FSContainerFlag > 0){
                                $pdf->Cell(35,7,number_format($FSContainerFlag,'2','.',','),1);
                            }else{
                                $pdf->Cell(35,7,"",1);
                            }

                            $totalActualShareCapitalContainer[$rowCounter] =  $totalActualShareCapitalContainer[$rowCounter] - $FSContainerFlag;
                            $totalSCTemp = $totalSCTemp + $totalActualShareCapitalContainer[$rowCounter];
                            if($totalActualShareCapitalContainer[$rowCounter] > 0){
                                $pdf->Cell(30,7,number_format($totalActualShareCapitalContainer[$rowCounter],'2','.',','),1);
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
                    $pdf->Cell(30,7,number_format($totalSCBTemp,'2','.',','),1);
                    $pdf->Cell(25,7,number_format($totalscfTemp,'2','.',','),1);
                    $pdf->Cell(25,7,number_format($totalcbuTemp,'2','.',','),1);
                    $pdf->Cell(25,7,number_format($totalrecruitTemp,'2','.',','),1);
                    $pdf->Cell(25,7,number_format($totalretentionTemp,'2','.',','),1);
                    $pdf->Cell(30,7,number_format($totalASCTemp,'2','.',','),1);
                    $pdf->Cell(35,7,number_format($totalFC,'2','.',','),1);
                    $pdf->Cell(30,7,number_format($totalSCTemp,'2','.',','),1);


                    $pdf->Output();
                }
            }
        }else{
            $sqlName = "SELECT * FROM  name_table order by last_name asc, first_name asc ";
            $resultName = $conn->query($sqlName);
            $numRow = mysqli_num_rows($resultName);
            $counter = 0;

            //$counterShareCapital = 0;
            $scfTemp = 0;
            $scfContainer[] = 0;
            $cbuTemp = 0;
            $cbuContainer[] = 0;
            $recruitTemp = 0;
            $recruitContainer[] = 0;
            $retentionTemp = 0;
            $retentionContainer[] = 0;
            $FSContainer[] = 0;

            //$totalPartialShareCapitalTemp = 0;
            $totalPartialShareCapitalContainer[] = "";  

            $totalShareCapitalTemp = 0;
            $totalShareCapitalContainer[] = "";

            $totalActualShareCapitalContainer[] = "";

            $typeTransaction = "";

            if($resultName->num_rows > 0){
                while ($row = mysqli_fetch_array($resultName)) {
                    # code...
                    $idNumber[$counter] = $row['id_number'];
                    $accountNumber[$counter] = $row['account_number'];
                    $firstName[$counter] = $row['first_name'];
                    $middleName[$counter] = $row['middle_name'];
                    $lastName[$counter] = $row['last_name'];

                    $sqlShareCapital = "SELECT * FROM  share_capital_table WHERE id_number = '$idNumber[$counter]' and (type_transaction = 'BSC' or type_transaction = 'Retention' or type_transaction = 'CBU' or type_transaction = 'SCF' or type_transaction = 'Recruit') and date_transaction <= '$endDate' ";
                    $resultShareCapital = $conn->query($sqlShareCapital);
                    
                    if($resultShareCapital->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultShareCapital)) {
                            # code...
                             $dateTransaction = $row['date_transaction'];
                             $typeTransaction = $row['type_transaction'];

                             if($endDate >= $dateTransaction){
                                $totalShareCapitalTemp = $totalShareCapitalTemp  + $row['amount'];
                                $totalShareCapitalContainer[$counter] = $totalShareCapitalTemp;

                                if($startDate <= $dateTransaction and $endDate >= $dateTransaction){

                                    if($typeTransaction == "SCF"){
                                        $scfTemp = $scfTemp + $row['amount'];
                                        $scfContainer[$counter] = $scfTemp;
                                    }else{
                                        if(empty($scfContainer[$counter])){
                                            $scfTemp = 0;
                                            $scfContainer[$counter] = 0;
                                        }
                                    }

                                    if($typeTransaction == "CBU"){
                                        $cbuTemp =  $cbuTemp + $row['amount'];
                                        $cbuContainer[$counter] = $cbuTemp;
                                    }else{
                                        if(empty($cbuContainer[$counter])){
                                            $cbuTemp= 0;
                                            $cbuContainer[$counter] = 0;
                                        }
                                    }

                                    if($typeTransaction == "Retention"){
                                        $retentionTemp =  $retentionTemp + $row['amount'];
                                        $retentionContainer[$counter] = $retentionTemp;
                                    }else{
                                        if(empty($retentionContainer[$counter])){
                                            $retentionTemp= 0;
                                            $retentionContainer[$counter] = 0;
                                        }
                                    }

                                    if($typeTransaction == "Recruit"){
                                        $recruitTemp =  $recruitTemp + $row['amount'];
                                        $recruitContainer[$counter] = $recruitTemp;
                                    }else{
                                        if(empty($recruitContainer[$counter])){
                                            $recruitTemp= 0;
                                            $recruitContainer[$counter] = 0;
                                        }
                                    }
                                }else{
                                    if(empty($scfContainer[$counter])){
                                        $scfTemp = 0;
                                        $scfContainer[$counter] = 0;
                                    }

                                    if(empty($cbuContainer[$counter])){
                                        $cbuTemp= 0;
                                        $cbuContainer[$counter] = 0;
                                    }

                                    if(empty($retentionContainer[$counter])){
                                        $retentionTemp= 0;
                                        $retentionContainer[$counter] = 0;
                                    }

                                    if(empty($recruitContainer[$counter])){
                                        $recruitTemp= 0;
                                        $recruitContainer[$counter] = 0;
                                    }
                                }
                             }else{
                                if(empty($totalShareCapitalContainer[$counter])){
                                    $totalShareCapitalTemp = 0;
                                    $totalShareCapitalContainer[$counter] = 0;
                                }

                                if(empty($scfContainer[$counter])){
                                    $scfTemp = 0;
                                    $scfContainer[$counter] = 0;
                                }

                                if(empty($cbuContainer[$counter])){
                                    $cbuTemp= 0;
                                    $cbuContainer[$counter] = 0;
                                }

                                if(empty($retentionContainer[$counter])){
                                    $retentionTemp= 0;
                                    $retentionContainer[$counter] = 0;
                                }

                                if(empty($recruitContainer[$counter])){
                                    $recruitTemp= 0;
                                    $recruitContainer[$counter] = 0;
                                }
                             }
                        }
                        $scfTemp = 0;
                        $cbuTemp = 0;
                        $retentionTemp = 0;
                        $recruitTemp = 0;
                        $totalShareCapitalTemp = 0;
                    }else{
                         $totalShareCapitalContainer[$counter] = 0;
                         $scfContainer[$counter] = 0;
                         $cbuContainer[$counter] = 0;
                         $retentionContainer[$counter] = 0;
                         $recruitContainer[$counter] = 0;
                    }

                    $sqlWithdraw = "SELECT * FROM  share_capital_table WHERE id_number = '$idNumber[$counter]' and type_transaction = 'Withdraw' and date_transaction <= '$endDate' ";
                    $resultWithdraw = $conn->query($sqlWithdraw);
                    
                    $totalWithdrawTemp = 0;
                    if($resultWithdraw->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultWithdraw)) {
                            # code...
                             $dateTransaction = $row['date_transaction'];

                            if($endDate >= $dateTransaction){
                                $totalWithdrawTemp = $totalWithdrawTemp  + $row['amount'];
                                $totalWithdrawContainer[$counter] = $totalWithdrawTemp;
                            }else{
                                if(empty($totalWithdrawContainer[$counter])){
                                    $totalWithdrawTemp = 0;
                                    $totalWithdrawContainer[$counter] = 0;
                                }
                            }
                        }
                        $totalWithdrawTemp = 0;
                    }else{
                        $totalWithdrawContainer[$counter] = 0;
                    }

                    $totalPartialShareCapitalContainer[$counter] = $totalShareCapitalContainer[$counter] - ($scfContainer[$counter] + $cbuContainer[$counter] + $recruitContainer[$counter] + $retentionContainer[$counter]);
                    $totalActualShareCapitalContainer[$counter] = $totalShareCapitalContainer[$counter] - $totalWithdrawContainer[$counter];
                    $counter++;
                }

                if($printReport == "printReport"){

                    $totalSCBTemp = 0;
                    $totalscfTemp = 0;
                    $totalcbuTemp = 0;
                    $totalrecruitTemp = 0;
                    $totalretentionTemp = 0;
                    $totalSCTemp = 0;
                    $totalASCTemp = 0;
                    $totalFC = 0;

                    $pdf = new FPDF();

                    $rowCounter = 0;

                    $pdf->SetFont('Arial','B',9);
                    $pdf->AddPage('L','Legal', 0);

                    //Title
                    $pdf->Cell(100,7,"Maligaya Wet Market Multi-Purpose Cooperative");$pdf->Ln();
                    $pdf->Cell(100,7,"Schedule of Share Capital");$pdf->Ln();
                    
                    if($searchMember == "Regular"){
                        $typeShare = "Common Shares";
                    }elseif($searchMember == "Associate"){
                        $typeShare = "Preffered Shares";
                    }else{
                        $typeShare = "Common and Preffred Shares";
                    }
                    $pdf->Cell(30,7,"$typeShare");$pdf->Ln();
                    $pdf->Cell(30,7,"From");
                    $pdf->Cell(30,7,"$startDate");$pdf->Ln();
                    $pdf->Cell(30,7,"To");
                    $pdf->Cell(30,7,"$endDate");$pdf->Ln();
                    //Header
                    $pdf->Cell(30,7,"ID #",1);
                    $pdf->Cell(65,7,"Name",1);
                    $pdf->Cell(30,7,"Paid Up Capital",1);
                    $pdf->Cell(25,7,"SSC",1);
                    $pdf->Cell(25,7,"CBU",1);
                    $pdf->Cell(25,7,"Recruit",1);
                    $pdf->Cell(25,7,"Loan Retention",1);
                    $pdf->Cell(30,7,"Total Share Capital",1);
                    $pdf->Cell(35,7,"Future Subscription",1);
                    $pdf->Cell(30,7,"Paid up Share Capital",1);
                    $pdf->Ln();

                    $fullName[] = "";
                    while($rowCounter < $numRow) {
                        if($totalActualShareCapitalContainer[$rowCounter] != 0){
                            $pdf->Cell(30,7,"$idNumber[$rowCounter]",1);
                            $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                            $pdf->Cell(65,7,"$fullName[$rowCounter]",1);
                            $totalSCBTemp = $totalSCBTemp + $totalPartialShareCapitalContainer[$rowCounter];
                            $pdf->Cell(30,7,number_format($totalPartialShareCapitalContainer[$rowCounter],'2','.',','),1);
                            $totalscfTemp = $totalscfTemp + $scfContainer[$rowCounter];
                            if($scfContainer[$rowCounter] > 0){
                                $pdf->Cell(25,7,number_format($scfContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(25,7,"",1);
                            }
                            $totalcbuTemp = $totalcbuTemp + $cbuContainer[$rowCounter];
                            if($cbuContainer[$rowCounter] > 0){
                                $pdf->Cell(25,7,number_format($cbuContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(25,7,"",1);
                            }
                            $totalrecruitTemp = $totalrecruitTemp + $recruitContainer[$rowCounter];
                            if($recruitContainer[$rowCounter] > 0){
                                $pdf->Cell(25,7,number_format($recruitContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(25,7,"",1);
                            }
                            $totalretentionTemp = $totalretentionTemp + $retentionContainer[$rowCounter];
                            if($retentionContainer[$rowCounter] > 0){
                                $pdf->Cell(25,7,number_format($retentionContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(25,7,"",1);
                            }

                            $totalASCTemp = $totalASCTemp + $totalActualShareCapitalContainer[$rowCounter];
                            if($totalActualShareCapitalContainer[$rowCounter] > 0){
                                $pdf->Cell(30,7,number_format($totalActualShareCapitalContainer[$rowCounter],'2','.',','),1);
                            }else{
                                $pdf->Cell(30,7,"",1);
                            }

                            $FSContainerFlag = fmod($totalActualShareCapitalContainer[$rowCounter],100);
                            $totalFC = $totalFC + $FSContainerFlag;
                            if($FSContainerFlag > 0){
                                $pdf->Cell(35,7,number_format($FSContainerFlag,'2','.',','),1);
                            }else{
                                $pdf->Cell(35,7,"",1);
                            }

                            $totalActualShareCapitalContainer[$rowCounter] =  $totalActualShareCapitalContainer[$rowCounter] - $FSContainerFlag;
                            $totalSCTemp = $totalSCTemp + $totalActualShareCapitalContainer[$rowCounter];
                            if($totalActualShareCapitalContainer[$rowCounter] > 0){
                                $pdf->Cell(30,7,number_format($totalActualShareCapitalContainer[$rowCounter],'2','.',','),1);
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
                    $pdf->Cell(30,7,number_format($totalSCBTemp,'2','.',','),1);
                    $pdf->Cell(25,7,number_format($totalscfTemp,'2','.',','),1);
                    $pdf->Cell(25,7,number_format($totalcbuTemp,'2','.',','),1);
                    $pdf->Cell(25,7,number_format($totalrecruitTemp,'2','.',','),1);
                    $pdf->Cell(25,7,number_format($totalretentionTemp,'2','.',','),1);
                    $pdf->Cell(30,7,number_format($totalASCTemp,'2','.',','),1);
                    $pdf->Cell(35,7,number_format($totalFC,'2','.',','),1);
                    $pdf->Cell(30,7,number_format($totalSCTemp,'2','.',','),1);


                    $pdf->Output();
                }
            }
        }
    }elseif($searchType != "Summary" and ($dateTransaction == "dateTransaction" or $printReport == "printReport")){

        $sqlSavings = "SELECT * FROM  share_capital_table WHERE type_transaction = '$searchType' and date_transaction >= '$startDate' and  date_transaction <= '$endDate' order by  reference_number, voucher_number";
        $resultSavings = $conn->query($sqlSavings);
        $numRowD = mysqli_num_rows($resultSavings);
        $counterD = 0;
        
        
        if($resultSavings->num_rows > 0){
            while ($row = mysqli_fetch_array($resultSavings)) {
            
                $idNumberD[$counterD] = $row['id_number'];
                $orNumber[$counterD] = $row['reference_number'];
                $voucherNumber[$counterD] = $row['voucher_number'];

                if($orNumber[$counterD] != ""){
                    $referenceNumber[$counterD] = $orNumber[$counterD];
                }else{
                    $referenceNumber[$counterD] =  $voucherNumber[$counterD];
                }

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
                        <select class="form-control" id="tpres" name="searchMember" value="<?php echo $searchMember;?>">
                          <option value="" <?php if($searchMember == "") echo "selected"; ?>>Select</option>
                          <option value="Regular" <?php if($searchMember == "Regular") echo "selected"; ?>>Regular</option>
                          <option value="Associate" <?php if($searchMember == "Associate") echo "selected"; ?>>Associate</option>
                          <option value="All" <?php if($searchMember == "All") echo "selected"; ?>>All</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="tpres" name="searchType" value="<?php echo $searchType;?>">
                          <option value="" <?php if($searchType == "") echo "selected"; ?>>Select</option>
                          <option value="CBU" <?php if($searchType == "CBU") echo "selected"; ?>>CBU</option>
                          <option value="Recruit" <?php if($searchType == "Recruit") echo "selected"; ?>>Recruit</option>
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
                <p>Member Share Capital</p>
                <br>
                <div class="table table-striped table-hover table-bordered">
                    <?php
                        if($searchType == "Summary"){
                            echo "<table>
                            <tr>
                                <th></th>
                                <th>ID Number</th>
                                <th>Name</th>
                                <th>Paid Up Capital</th>
                                <th>Subscribed Capital</th>
                                <th>CBU</th>
                                <th>Recruit</th>
                                <th>Loan Retention</th>
                                <th>Total Share Capital</th>
                                <th>Deposit for Future Subscription</th>
                                <th>Paid Share Capital</th>
                            </tr>";
                            
                            $counterh = 0;
                            $totalPartialTemp = 0;
                            $totalscfTemp = 0;
                            $totalcbuTemp = 0;
                            $totalrecruitTemp = 0;
                            $totalretentionTemp = 0;
                            $totalSCTemp = 0;
                            $totalFC = 0;
                            $totalASCTemp = 0;
                            $counterMembers = 1;
                            while($counterh < $numRow) {
                                if($totalActualShareCapitalContainer[$counterh] != 0){
                                    echo "<tr>";
                                        echo "<td>" . $counterMembers . "</td>";
                                        echo "<td>" . $idNumber[$counterh] . "</td>";
                                        echo "<td>" . $lastName[$counterh] . ", " . $firstName[$counterh] . " " . $middleName[$counterh] . "</td>";
                                        $totalPartialTemp = $totalPartialTemp + $totalPartialShareCapitalContainer[$counterh];
                                        echo "<td>" . number_format($totalPartialShareCapitalContainer[$counterh],'2','.',',') . "</td>";
                                        $totalscfTemp = $totalscfTemp + $scfContainer[$counterh];
                                        if($scfContainer[$counterh] != 0){
                                            echo "<td " . "style=" . "color:blue" . ">" . number_format($scfContainer[$counterh],'2','.',',') . "</td>";
                                        }else{
                                            echo "<td>" . "" . "</td>";
                                        }
                                        $totalcbuTemp = $totalcbuTemp + $cbuContainer[$counterh];
                                        if($cbuContainer[$counterh] != 0){
                                            echo "<td " . "style=" . "color:blue" . ">" . number_format($cbuContainer[$counterh],'2','.',',') . "</td>";
                                        }else{
                                            echo "<td>" . "" . "</td>";
                                        }
                                        $totalrecruitTemp = $totalrecruitTemp + $recruitContainer[$counterh];
                                        if($recruitContainer[$counterh] != 0){
                                            echo "<td " . "style=" . "color:blue" . ">" . number_format($recruitContainer[$counterh],'2','.',',') . "</td>";
                                        }else{
                                            echo "<td>" . "" . "</td>";
                                        }
                                        $totalretentionTemp = $totalretentionTemp + $retentionContainer[$counterh];
                                        $totalrecruitTemp = $totalrecruitTemp + $recruitContainer[$counterh];
                                        if($retentionContainer[$counterh] != 0){
                                            echo "<td " . "style=" . "color:blue" . ">" . number_format($retentionContainer[$counterh],'2','.',',') . "</td>";
                                        }else{
                                            echo "<td>" . "" . "</td>";
                                        }

                                        $totalASCTemp = $totalASCTemp + $totalActualShareCapitalContainer[$counterh];
                                        echo "<td " . "style=" . "color:green" . ">" . number_format($totalActualShareCapitalContainer[$counterh],'2','.',',') . "</td>";

                                        $FSContainerFlag = fmod($totalActualShareCapitalContainer[$counterh],100);
                                        $totalFC = $totalFC + $FSContainerFlag;
                                        if($FSContainerFlag > 0){
                                            echo "<td " . "style=" . "color:red" . ">" . number_format($FSContainerFlag,'2','.',',') . "</td>";
                                        }else{
                                            echo "<td>" . "" . "</td>";
                                        }

                                        /*
                                        if($FSContainerFlag > 0){
                                            $totalActualShareCapitalContainer[$counterh] = $totalActualShareCapitalContainer[$counterh] - $FSContainerFlag;
                                        }*/

                                        //$totalActualShareCapitalContainer[$counterh] = $totalActualShareCapitalContainer[$counterh] - $FSContainerFlag;
                                        

                                        $totalActualShareCapitalContainer[$counterh] = $totalActualShareCapitalContainer[$counterh] - $FSContainerFlag;
                                        $totalSCTemp = $totalSCTemp + $totalActualShareCapitalContainer[$counterh];
                                        echo "<td " . "style=" . "color:#088A85" . ">" . number_format($totalActualShareCapitalContainer[$counterh],'2','.',',') . "</td>";

                                        $counterMembers++;
                                    echo "</tr>";
                                }
                                $counterh ++;
                            }

                            echo "<tr>";
                                echo "<td>" . "". "</td>";
                                echo "<td>" . "Total". "</td>";
                                echo "<td>" . "" . "</td>";
                                echo "<td>" . number_format($totalPartialTemp,'2','.',',') . "</td>";
                                echo "<td " . "style=" . "color:blue" . ">" . number_format($totalscfTemp,'2','.',',') . "</td>";
                                echo "<td " . "style=" . "color:blue" . ">" . number_format($totalcbuTemp,'2','.',',') . "</td>";
                                echo "<td " . "style=" . "color:blue" . ">" . number_format($totalrecruitTemp,'2','.',',') . "</td>";
                                echo "<td " . "style=" . "color:blue" . ">" . number_format($totalretentionTemp,'2','.',',') . "</td>";
                                echo "<td " . "style=" . "color:green" . ">" . number_format($totalASCTemp,'2','.',',') . "</td>";
                                echo "<td " . "style=" . "color:red" . ">" . number_format($totalFC,'2','.',',') . "</td>";
                                echo "<td " . "style=" . "color:#088A85" . ">" . number_format($totalSCTemp,'2','.',',') . "</td>";
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