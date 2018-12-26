<?php  

$idNumber [] = "";
$accountNumber [] = "";

$firstName  [] = "";
$middleName [] = "";
$lastName [] = "";

$transactionnumber[] = "";
$loanApplicationNumber[] = "";
$orNumber[] = "";
$amountPrincipal[] = "";
$datePrincipal[] = "";

$startDate = "";
$endDate = "";
$releaseDate = "";

$searchReport = "";
$numRow = "";

include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["searchReport"])) {
        $searchReport = test_input($_POST["searchReport"]);
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

    if($searchReport == "searchReport"){

        $sqlName = "SELECT * FROM  bl_loan_payment_table order by date_payment asc";
        $resultName = $conn->query($sqlName);
        $numRow = mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_payment'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $orNumber[$counter] = $row['reference_number'];
                    $amountPrincipal[$counter] = $row['amount'];
                    $datePrincipal[$counter] = $row['date_payment'];

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  ckl_loan_payment_table order by date_payment asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_payment'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $orNumber[$counter] = $row['reference_number'];
                    $amountPrincipal[$counter] = $row['amount'];
                    $datePrincipal[$counter] = $row['date_payment'];

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  cll_loan_payment_table order by date_payment asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_payment'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $orNumber[$counter] = $row['reference_number'];
                    $amountPrincipal[$counter] = $row['amount'];
                    $datePrincipal[$counter] = $row['date_payment'];

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  cl_loan_payment_table order by date_payment asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_payment'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $orNumber[$counter] = $row['reference_number'];
                    $amountPrincipal[$counter] = $row['amount'];
                    $datePrincipal[$counter] = $row['date_payment'];

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  cml_loan_payment_table order by date_payment asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_payment'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $orNumber[$counter] = $row['reference_number'];
                    $amountPrincipal[$counter] = $row['amount'];
                    $datePrincipal[$counter] = $row['date_payment'];

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  edl_loan_payment_table order by date_payment asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_payment'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $orNumber[$counter] = $row['reference_number'];
                    $amountPrincipal[$counter] = $row['amount'];
                    $datePrincipal[$counter] = $row['date_payment'];

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  eml_loan_payment_table order by date_payment asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_payment'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $orNumber[$counter] = $row['reference_number'];
                    $amountPrincipal[$counter] = $row['amount'];
                    $datePrincipal[$counter] = $row['date_payment'];

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  pl_loan_payment_table order by date_payment asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_payment'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $orNumber[$counter] = $row['reference_number'];
                    $amountPrincipal[$counter] = $row['amount'];
                    $datePrincipal[$counter] = $row['date_payment'];

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  rl_loan_payment_table order by date_payment asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_payment'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $orNumber[$counter] = $row['reference_number'];
                    $amountPrincipal[$counter] = $row['amount'];
                    $datePrincipal[$counter] = $row['date_payment'];

                    $counter++;
                }else{
                    $numRow--;
                }
            }
        }

        $sqlName = "SELECT * FROM  sl_loan_payment_table order by date_payment asc";
        $resultName = $conn->query($sqlName);
        $numRow = $numRow + mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $releaseDate = $row['date_payment'];

                if($startDate <= $releaseDate and $endDate >= $releaseDate){
                    $transactionnumber[$counter] = $row['transaction_number'];
                    $idNumber[$counter] = $row['id_number'];
                    $loanApplicationNumber[$counter] = $row['loan_application_number'];
                    $orNumber[$counter] = $row['reference_number'];
                    $amountPrincipal[$counter] = $row['amount'];
                    $datePrincipal[$counter] = $row['date_payment'];

                    $counter++;
                }else{
                    $numRow--;
                }
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
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div>
    <?php //include 'topbar.php';?>
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-9 table table-dark" style="margin-top:70px;margin-left: 16.7%;">
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-6 control-label">Start Date</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" value = "<?php echo $startDate;?>" name = "startDate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 control-label">End Date</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" value = "<?php echo $endDate;?>" name = "endDate">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 form">
                            <label class="col-md-6 control-label">Search</label>
                            <button class="btn btn-outline-success my-2 my-sm-0" name = "searchReport" value = "searchReport" type="submit" style="align-self: center;">SEARCH</button>
                        </div>
                    </div>
                </div>
                <p>Loan Release</p>
                <?php
                echo "<table>
                <tr>
                    <th>Transaction Number</th>
                    <th>ID Number</th>
                    <th>Loan ID</th>
                    <th>OR Number</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>";

                $counterh = 0;
                while($counterh < $numRow) {
                    echo "<tr>";
                        echo "<td>" . $loanApplicationNumber[$counterh] . "-" .$transactionnumber[$counterh] . "</td>";
                        echo "<td>" . $idNumber[$counterh] . "</td>";
                        echo "<td>" . $loanApplicationNumber[$counterh] . "</td>";
                        echo "<td>" . $orNumber[$counterh] . "</td>";
                        echo "<td>" . $amountPrincipal[$counterh] . "</td>";
                        echo "<td>" . $datePrincipal[$counterh] . "</td>";
                    echo "</tr>";

                    $counterh++;
                }
                ?>
            </div>
        </div>
    </div>
</form>
</body>
<?php include "css1.html" ?>
</html>