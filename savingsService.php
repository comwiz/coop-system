<!DOCTYPE html>
<html>
<?php  

$savingsServiceID[] = "";
$savingsReferenceNumber[] = "";
$savingsServiceName[] = "";
$savingsTermCount[] = "";
$savingsTermSuffix[] = "";
$savingsInterest[] = "";

$identifier = "";

include 'dbconnection.php';

$sqlbi = "SELECT * FROM  savings_services_table";
$resultbi = $conn->query($sqlbi);
$numRow = mysqli_num_rows($resultbi);
$counter = 0;

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $savingsServiceID[$counter] = $row['savings_service_id'];
        $savingsServiceName[$counter] = $row['savings_service_name'];
        $savingsReferenceNumber[$counter] = $row['reference_number'];
        $savingsTermCount[$counter] = $row['savings_term_count'];
        $savingsTermSuffix[$counter] = $row['savings_term_suffix'];
        $savingsInterest[$counter] = $row['savings_interest_rate'];

        $counter++;
    }
}

?>
<head>
	<title>Loan Service</title>
    <?php include "css.html" ?>
</head>

<body>
    <div>
        <?php include 'topbar.php';?>
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-5 table table-dark" style="margin-top:70px;margin-left: 16.7%;">
                <p align="center">Savings Services</p>
                <?php
                echo "<table>
                <tr>
                    <th>Savings Service ID</th>
                    <th>Savings Service Name</th>
                    <th>Reference</th>
                    <th>Term</th>
                    <th>Interest</th>

                </tr>";
                
                $counterh = 0;
                while($counterh < $numRow) {
                        echo "<tr>";
                            echo "<td>" . $savingsServiceID[$counterh] . "</td>";
                            echo "<td>" . $savingsServiceName[$counterh] . "</td>";
                            echo "<td>" . $savingsReferenceNumber[$counterh] . "</td>";
                            echo "<td>" . $savingsTermCount[$counterh] . " " . $savingsTermSuffix[$counterh] . "</td>";
                            echo "<td>" . $savingsInterest[$counterh] . "</td>";
                        echo "</tr>";
                    $counterh ++;
                }
                
                ?>
            </div>
        </div>
    </div>
</body>
<?php include "css1.html" ?>
</html>