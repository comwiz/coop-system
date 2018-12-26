<?php  

$idNumber [] = "";
$accountNumber [] = "";

$firstName  [] = "";
$middleName [] = "";
$lastName [] = "";

$transactionnumber[] = "";
$loanApplicationNumber[] = "";
$orNumber[] = "";
$principalAmount[] = "";
$interestRevenue[] = "";
$dateTransaction[] = "";

include 'dbconnection.php';

$sqlName = "SELECT * FROM  bl_credit_revenue_table WHERE reference_number != '' order by date_transaction asc";
$resultName = $conn->query($sqlName);
$numRow = mysqli_num_rows($resultName);
$counter = 0;

//$counterShareCapital = 0;
//$totalShareCapitalTemp = 0;
//$totalShareCapitalContainer[] = 0;

if($resultName->num_rows > 0){
    while ($row = mysqli_fetch_array($resultName)) {
        # code...
        $transactionnumber[$counter] = $row['transaction_number'];
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $orNumber[$counter] = $row['reference_number'];
        $interestRevenue[$counter] = $row['interest_revenue'];
        $dateTransaction[$counter] = $row['date_transaction'];

        $sqlName = "SELECT * FROM  bl_loan_payment_table WHERE (reference_number = '$orNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]') ";
        $resultName = $conn->query($sqlName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $principalAmount[$counter] = $row['amount'];
            }
        }else{
            $principalAmount[$counter] = 0;
        }


        $counter++;
    }
}

$sqlName = "SELECT * FROM  ckl_credit_revenue_table WHERE reference_number != '' order by date_transaction asc";
$resultName = $conn->query($sqlName);
$numRow = $numRow + mysqli_num_rows($resultName);

if($resultName->num_rows > 0){
    while ($row = mysqli_fetch_array($resultName)) {
        # code...
        $transactionnumber[$counter] = $row['transaction_number'];
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $orNumber[$counter] = $row['reference_number'];
        $interestRevenue[$counter] = $row['interest_revenue'];
        $dateTransaction[$counter] = $row['date_transaction'];

        $sqlName = "SELECT * FROM  ckl_loan_payment_table WHERE (reference_number = '$orNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]') ";
        $resultName = $conn->query($sqlName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $principalAmount[$counter] = $row['amount'];
            }
        }else{
            $principalAmount[$counter] = 0;
        }

        $counter++;
    }
}

$sqlName = "SELECT * FROM  cll_credit_revenue_table WHERE reference_number != '' order by date_transaction asc";
$resultName = $conn->query($sqlName);
$numRow = $numRow + mysqli_num_rows($resultName);

if($resultName->num_rows > 0){
    while ($row = mysqli_fetch_array($resultName)) {
        # code...
        $transactionnumber[$counter] = $row['transaction_number'];
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $orNumber[$counter] = $row['reference_number'];
        $interestRevenue[$counter] = $row['interest_revenue'];
        $dateTransaction[$counter] = $row['date_transaction'];

        $sqlName = "SELECT * FROM  cll_loan_payment_table WHERE (reference_number = '$orNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]') ";
        $resultName = $conn->query($sqlName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $principalAmount[$counter] = $row['amount'];
            }
        }else{
            $principalAmount[$counter] = 0;
        }


        $counter++;
    }
}


$sqlName = "SELECT * FROM  cl_credit_revenue_table WHERE reference_number != '' order by date_transaction asc";
$resultName = $conn->query($sqlName);
$numRow = $numRow + mysqli_num_rows($resultName);

if($resultName->num_rows > 0){
    while ($row = mysqli_fetch_array($resultName)) {
        # code...
        $transactionnumber[$counter] = $row['transaction_number'];
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $orNumber[$counter] = $row['reference_number'];
        $interestRevenue[$counter] = $row['interest_revenue'];
        $dateTransaction[$counter] = $row['date_transaction'];

        $sqlName = "SELECT * FROM  cl_loan_payment_table WHERE (reference_number = '$orNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]') ";
        $resultName = $conn->query($sqlName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $principalAmount[$counter] = $row['amount'];
            }
        }else{
            $principalAmount[$counter] = 0;
        }
        $counter++;
    }
}

$sqlName = "SELECT * FROM  cml_credit_revenue_table WHERE reference_number != '' order by date_transaction asc";
$resultName = $conn->query($sqlName);
$numRow = $numRow + mysqli_num_rows($resultName);

if($resultName->num_rows > 0){
    while ($row = mysqli_fetch_array($resultName)) {
        # code...
        $transactionnumber[$counter] = $row['transaction_number'];
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $orNumber[$counter] = $row['reference_number'];
        $interestRevenue[$counter] = $row['interest_revenue'];
        $dateTransaction[$counter] = $row['date_transaction'];

        $sqlName = "SELECT * FROM  cml_loan_payment_table WHERE (reference_number = '$orNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]') ";
        $resultName = $conn->query($sqlName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $principalAmount[$counter] = $row['amount'];
            }
        }else{
            $principalAmount[$counter] = 0;
        }


        $counter++;
    }
}

$sqlName = "SELECT * FROM  edl_credit_revenue_table WHERE reference_number != '' order by date_transaction asc";
$resultName = $conn->query($sqlName);
$numRow = $numRow + mysqli_num_rows($resultName);

if($resultName->num_rows > 0){
    while ($row = mysqli_fetch_array($resultName)) {
        # code...
        $transactionnumber[$counter] = $row['transaction_number'];
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $orNumber[$counter] = $row['reference_number'];
        $interestRevenue[$counter] = $row['interest_revenue'];
        $dateTransaction[$counter] = $row['date_transaction'];

        $sqlName = "SELECT * FROM  edl_loan_payment_table WHERE (reference_number = '$orNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]') ";
        $resultName = $conn->query($sqlName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $principalAmount[$counter] = $row['amount'];
            }
        }else{
            $principalAmount[$counter] = 0;
        }


        $counter++;
    }
}

$sqlName = "SELECT * FROM  eml_credit_revenue_table WHERE reference_number != '' order by date_transaction asc";
$resultName = $conn->query($sqlName);
$numRow = $numRow + mysqli_num_rows($resultName);

if($resultName->num_rows > 0){
    while ($row = mysqli_fetch_array($resultName)) {
        # code...
        $transactionnumber[$counter] = $row['transaction_number'];
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $orNumber[$counter] = $row['reference_number'];
        $interestRevenue[$counter] = $row['interest_revenue'];
        $dateTransaction[$counter] = $row['date_transaction'];

        $sqlName = "SELECT * FROM  eml_loan_payment_table WHERE (reference_number = '$orNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]') ";
        $resultName = $conn->query($sqlName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $principalAmount[$counter] = $row['amount'];
            }
        }else{
            $principalAmount[$counter] = 0;
        }


        $counter++;
    }
}

$sqlName = "SELECT * FROM  rl_credit_revenue_table WHERE reference_number != '' order by date_transaction asc";
$resultName = $conn->query($sqlName);
$numRow = $numRow + mysqli_num_rows($resultName);

if($resultName->num_rows > 0){
    while ($row = mysqli_fetch_array($resultName)) {
        # code...
        $transactionnumber[$counter] = $row['transaction_number'];
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $orNumber[$counter] = $row['reference_number'];
        $interestRevenue[$counter] = $row['interest_revenue'];
        $dateTransaction[$counter] = $row['date_transaction'];

        $sqlName = "SELECT * FROM  rl_loan_payment_table WHERE (reference_number = '$orNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]') ";
        $resultName = $conn->query($sqlName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $principalAmount[$counter] = $row['amount'];
            }
        }else{
            $principalAmount[$counter] = 0;
        }


        $counter++;
    }
}

$sqlName = "SELECT * FROM  sl_credit_revenue_table WHERE reference_number != '' order by date_transaction asc";
$resultName = $conn->query($sqlName);
$numRow = $numRow + mysqli_num_rows($resultName);

if($resultName->num_rows > 0){
    while ($row = mysqli_fetch_array($resultName)) {
        # code...
        $transactionnumber[$counter] = $row['transaction_number'];
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $orNumber[$counter] = $row['reference_number'];
        $interestRevenue[$counter] = $row['interest_revenue'];
        $dateTransaction[$counter] = $row['date_transaction'];

        $sqlName = "SELECT * FROM  sl_loan_payment_table WHERE (reference_number = '$orNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]') ";
        $resultName = $conn->query($sqlName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $principalAmount[$counter] = $row['amount'];
            }
        }else{
            $principalAmount[$counter] = 0;
        }


        $counter++;
    }
}

$sqlName = "SELECT * FROM  pl_credit_revenue_table WHERE reference_number != '' order by date_transaction asc";
$resultName = $conn->query($sqlName);
$numRow = $numRow + mysqli_num_rows($resultName);

if($resultName->num_rows > 0){
    while ($row = mysqli_fetch_array($resultName)) {
        # code...
        $transactionnumber[$counter] = $row['transaction_number'];
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $orNumber[$counter] = $row['reference_number'];
        $interestRevenue[$counter] = $row['interest_revenue'];
        $dateTransaction[$counter] = $row['date_transaction'];

        $sqlName = "SELECT * FROM  pl_loan_payment_table WHERE (reference_number = '$orNumber[$counter]' and loan_application_number = '$loanApplicationNumber[$counter]') ";
        $resultName = $conn->query($sqlName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $principalAmount[$counter] = $row['amount'];
            }
        }else{
            $principalAmount[$counter] = 0;
        }


        $counter++;
    }
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
    <?php //include 'topbar.php';?>
    <form>
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-9 table table-dark" style="margin-top:70px;margin-left: 16.7%;">
                <p>Loan Release</p>
                <?php
                echo "<table>
                <tr>
                    <th>Transaction Number</th>
                    <th>ID Number</th>
                    <th>Loan ID</th>
                    <th>OR #</th>
                    <th>Principal</th>
                    <th>Interest</th>
                    <th>Date</th>
                </tr>";

                $counterh = 0;
                while($counterh < $numRow) {
                    echo "<tr>";
                        echo "<td>" . $loanApplicationNumber[$counterh] . "-" .$transactionnumber[$counterh] . "</td>";
                        echo "<td>" . $idNumber[$counterh] . "</td>";
                        echo "<td>" . $loanApplicationNumber[$counterh] . "</td>";
                        echo "<td>" . $orNumber[$counterh] . "</td>";
                        echo "<td>" . $principalAmount[$counterh] . "</td>";
                        echo "<td>" . $interestRevenue[$counterh] . "</td>";
                        echo "<td>" . $dateTransaction[$counterh] . "</td>";
                    echo "</tr>";

                    $counterh++;
                }
                ?>
            </div>
        </div>
    </form>
</div>
</body>
<?php include "css1.html" ?>
</html>