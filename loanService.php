<?php  

require_once 'session.php';

$loanServiceId[] = "";
$loanServiceType[] = "";
$loanServiceName[] = "";
$loanServiceEntitlement[] = "";
$loanReferenceNumber[] = "";
$loanableAmountMin[] = "";
$loanableAmountMax[] = "";
$loanTermsCount[] = "";
$loanTermsSuffix[] = "";
$loanInterest[] = "";
$typeInterest[] = "";
$serviceFee[] = "";
$filingFee[] = "";
$cbuLoanRetention[] = "";
$savingsLoanRetention[] = "";
$notarialFee[] = "";
$insuranceFee[] = "";
$remarks[] = "";

$identifier = "";
$exitB = "";

$sqlbi = "SELECT * FROM  loan_services_table";
$resultbi = $conn->query($sqlbi);
$numRow = mysqli_num_rows($resultbi);
$counter = 0;

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) { 
        # code...
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanServiceType[$counter] = $row['loan_service_type'];
        $loanServiceName[$counter] = $row['loan_service_name'];
        $loanServiceEntitlement[$counter] = $row['loan_service_entitlement'];
        $loanReferenceNumber[$counter] = $row['loan_reference_number'];
        $loanableAmountMin[$counter] = $row['loanable_amount_min'];
        $loanableAmountMax[$counter] = $row['loanable_amount_max'];
        $loanTermsCount[$counter] = $row['loan_terms_count'];
        $loanTermsSuffix[$counter] = $row['loan_terms_suffix'];
        $loanInterest[$counter] = $row['loan_interest'];
        $typeInterest[$counter] = $row['type_interest'];
        $serviceFee[$counter] = $row['service_fee'];
        $filingFee[$counter] = $row['filing_fee'];
        $cbuLoanRetention[$counter] = $row['cbu_loan_retention'];
        $savingsLoanRetention[$counter] = $row['savings_loan_retention'];
        $notarialFee[$counter] = $row['notarial_fee'];
        $insuranceFee[$counter] = $row['insurance_fee'];
        $remarks[$counter] = $row['remarks'];

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
    <?php include 'topbar.php';?>
    <form>
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-9 table table-dark" style="margin-top:70px;margin-left: 16.7%;">
                <p align="center">Loan Services</p>
                <?php
                echo "<table>
                <tr>
                    <th>Loan Service ID</th>
                    <th>Loan Type</th>
                    <th>Loan Name</th>
                    <th>Entitlement</th>
                    <th>Reference</th>
                    <th>Minimum Loan</th>
                    <th>Maximum Loan</th>
                    <th>Term</th>
                    <th>Interest</th>
                    <th>Service Fee</th>
                    <th>Filing Fee</th>
                    <th>Loan Retention</th>
                    <th>LPP</th>
                    <th>Remarks</th>

                </tr>";
                
                $counterh = 0;
                while($counterh < $numRow) {
                        echo "<tr>";
                            echo "<td>" . $loanServiceId[$counterh] . "</td>";
                            echo "<td>" . $loanServiceType[$counterh] . "</td>";
                            echo "<td>" . $loanServiceName[$counterh] . "</td>";
                            echo "<td>" . $loanServiceEntitlement[$counterh] . "</td>";
                            echo "<td>" . $loanReferenceNumber[$counterh] . "</td>";
                            echo "<td>" . "P" . $loanableAmountMin[$counterh] . "</td>";
                            echo "<td>" . "P" . $loanableAmountMax[$counterh] . "</td>";
                            echo "<td>" . $loanTermsCount[$counterh] . " " . $loanTermsSuffix[$counterh] . "</td>";
                            echo "<td>" . $loanInterest[$counterh] . "%" . " " . $typeInterest[$counterh] . "</td>";
                            echo "<td>" . $serviceFee[$counterh] . "%" . "</td>";
                            echo "<td>" . "P" . $filingFee[$counterh] . "</td>";
                            echo "<td>" . $cbuLoanRetention[$counterh] .  "%" . " " . $savingsLoanRetention[$counterh] . "%" . "</td>";
                            echo "<td>" . $notarialFee[$counterh] . " " . $insuranceFee[$counterh] . "</td>";
                            echo "<td>" . $remarks[$counterh] . "</td>";
                        echo "</tr>";
                    $counterh ++;
                }
                ?>
            </div>
        </div>
    </form>
</div>
</body>
<?php include "css1.html" ?>
</html>