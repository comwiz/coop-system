<?php  

require_once 'session.php';

$orNumber [] = "";
$idNumber [] = "";
$accountNumber [] = "";

$firstName  [] = "";
$middleName [] = "";
$lastName [] = "";

$startDate = "";
$endDate = "";
$releaseDate = "";

$searchReport = "";
$printReport = "";
$numRow = "";

$totalPaymentBLIT[] = 0;
$totalPaymentBLPT[] = 0;
$totalPaymentBLI[] = 0;
$totalPaymentBLP[] = 0;
$totalBalance[] = 0;

$countErr = "";

$blCheck = "";
$cllCheck = "";
$cmlCheck = "";
$edlCheck = "";
$rlCheck = "";

$clCheck = "";
$cklCheck = "";
$emlCheck = "";
$slCheck = "";

$alCheck = "";

$exitB = "";
$numRow = 0;

$rllatemp = "";
$bllatemp = "";
$edllatemp = "";
$cmllatemp = "";

//
$clatemp = "";
$slatemp = "";
$rclatemp = "";

$loanServiceID[] = "";

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
        header("Location: http://localhost/projectkikz/samplemwmmpc/application/views/home/login.php");
    }

    if (!empty($_POST["blCheck"])) {
        $blCheck = test_input($_POST["blCheck"]);
    }

    if (!empty($_POST["cllCheck"])) {
        $cllCheck = test_input($_POST["cllCheck"]);
    }

    if (!empty($_POST["cmlCheck"])) {
        $cmlCheck = test_input($_POST["cmlCheck"]);
    }

    if (!empty($_POST["edlCheck"])) {
        $edlCheck = test_input($_POST["edlCheck"]);
    }

    if (!empty($_POST["rlCheck"])) {
        $rlCheck = test_input($_POST["rlCheck"]);
    }

    if (!empty($_POST["clCheck"])) {
        $clCheck = test_input($_POST["clCheck"]);
    }

    if (!empty($_POST["cklCheck"])) {
        $cklCheck = test_input($_POST["cklCheck"]);
    }

    if (!empty($_POST["emlCheck"])) {
        $emlCheck = test_input($_POST["emlCheck"]);
    }

    if (!empty($_POST["slCheck"])) {
        $slCheck = test_input($_POST["slCheck"]);
    }

    if (!empty($_POST["alCheck"])) {
        $alCheck = test_input($_POST["alCheck"]);
    }

    if($searchReport == "searchReport"){

        $counterBalance = 0;
        //BL WHERE loan_status != 'Paid' 
        $sqlCR = "SELECT * FROM  crtempF ";
        $resultCR = $conn->query($sqlCR);
        $numRow = mysqli_num_rows($resultCR);
        $counterBalance = 0;

        if($resultCR->num_rows > 0){
            while ($row = mysqli_fetch_array($resultCR)){
                //DIMINISHINE
                $idNumber[$counterBalance] = $row['id_number'];
                $orNumber[$counterBalance] = $row['temp'];
                //$invoiceNumber[$counterBalance] = $row['tempIN'];

                //FLAT
                $slStatus[$counterBalance] = $row['cl'];//PL
                $clStatus[$counterBalance] = $row['sl'];
                //$rclStatus[$counterBalance] = $row['rcl'];

                if($clStatus[$counterBalance] == 1){

                    $sqlMO = "SELECT * FROM  cl_loan_table WHERE id_number = '$idNumber[$counterBalance]' and loan_status != 'Paid' ";
                    $resultMO = $conn->query($sqlMO);
                    $counterMO = 0;
                    
                    if($resultMO->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultMO)) {
                            if($counterMO >= 1){
                                if($row['loan_status'] == "Void"){
                                    $loanApplicationNumber = "DOUBLE";
                                }else{
                                    $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];;
                                }
                            }else{
                                $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];;
                            }

                            $counterMO++;
                        }
                    }else{
                        //$loanApplicationNumber[$counterBalance] = $row['loan_application_number'];
                        //$loanApplicationNumber[$counterBalance] = "NONE";
                        $loanApplicationNumber[$counterBalance] = "NONE";
                    }

                }elseif($slStatus[$counterBalance] == 1){
                    $sqlMO = "SELECT * FROM  sl_loan_table WHERE id_number = '$idNumber[$counterBalance]' and loan_status != 'Paid' ";
                    $resultMO = $conn->query($sqlMO);
                    $counterMO = 0;
                    
                    if($resultMO->num_rows > 0){
                        while ($row = mysqli_fetch_array($resultMO)) {
                            if($counterMO >= 1){
                                if($row['loan_status'] == "Void"){
                                    $loanApplicationNumber = "DOUBLE";
                                }else{
                                    $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];;
                                }
                            }else{
                                $loanApplicationNumber[$counterBalance] = $row['loan_application_number'];;
                            }
                            $counterMO++;
                        }
                    }else{
                        //$loanApplicationNumber[$counterBalance] = $row['loan_application_number'];
                        $loanApplicationNumber[$counterBalance] = "NONE";
                    }
                }else{
                    $loanApplicationNumber[$counterBalance] = "NONE";
                }

                $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counterBalance]' order by last_name asc ";
                    $resultLS = $conn->query($sqlLS);
                    //$numRow = mysqli_num_rows($resultName);

                if($resultLS->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLS)) {
                        # code...
                        $idNumberS[$counterBalance] = $row['id_number'];
                        $firstName[$counterBalance] = $row['first_name'];
                        $middleName[$counterBalance] = $row['middle_name'];
                        $lastName[$counterBalance] = $row['last_name'];
                    }
                }

                $counterBalance++;
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
                    <br>
                </div>
                <div>
                    <p>Select Type of Loan</p>
                    <label> Business Loan </label>
                    <input type="checkbox" value = "BL" name = "blCheck">

                    <label> Calamity Loan </label>
                    <input type="checkbox" value = "CLL" name = "cllCheck">

                    <label> Chattel Mortgage Loan </label>
                    <input type="checkbox" value = "CML" name = "cmlCheck">

                    <label> Educational Loan </label>
                    <input type="checkbox" value = "EDL" name = "edlCheck">

                    <label> Regular Loan </label>
                    <input type="checkbox" value = "RL" name = "rlCheck">

                    <br>
                    <br>
                    <label> Cash Loan </label>
                    <input type="checkbox" value = "CL" name = "clCheck">

                    <label> Check Loan </label>
                    <input type="checkbox" value = "CKL" name = "cklCheck">

                    <label> Emergency Loan </label>
                    <input type="checkbox" value = "EML" name = "emlCheck">

                    <label> Special Loan </label>
                    <input type="checkbox" value = "SL" name = "slCheck">

                    <br>
                    <label> Select all </label>
                    <input type="checkbox" value = "AL" name = "alCheck">
                </div>
                <br>
                <p>Loan Balance</p>
                <br>
                <div class="table table-striped table-hover">
                    <?php
                    echo "<table>
                    <tr>
                        
                        <th>ID Number</th>
                        <th>OR NUMBER</th>
                        <th>LAN</th>
                        <th>NAME</th>
                    </tr>";

                    $counterh = 0;
                    while($counterh < $numRow) {
                        echo "<tr>";
                            echo "<td>" . $idNumber[$counterh] . "</td>";
                            echo "<td>" . $orNumber[$counterh] . "</td>";
                            echo "<td>" . $loanApplicationNumber[$counterh] . "</td>";
                            echo "<td>" . $lastName[$counterh] . ", " . $firstName[$counterh] . " " . $middleName[$counterh] . "</td>";
                        echo "</tr>";

                        $counterh++;
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