<?php  

require_once 'session.php';
require('public/fpdf181/fpdf.php');

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

$rowMember[] = "";
$searchMember = "";
$searchReport = "";
$printReport = "";
$countErr = "";
$numRow = "";
$memberStatus = "";

$exitB = "";

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

    if (empty($_POST["searchMember"])) {
        $countErr++;
    }else {
        $searchMember = test_input($_POST["searchMember"]);
    }

    if (empty($_POST["memberStatus"])) {
        $countErr++;
    }else {
        $memberStatus = test_input($_POST["memberStatus"]);
    }

    if($exitB = $exitB){
        session_destroy();
        header("Location: http://system.local/login.php");
    }

    if(($searchReport == "searchReport" OR $printReport == "printReport") and $searchMember != ""){

        $sqlName = "SELECT * FROM  name_table";

        if($searchMember != "" and $memberStatus != "" and $searchMember != "All"){
            $sqlName.= " WHERE type_membership = '$searchMember' and  member_status = '$memberStatus'  ";
        }elseif($searchMember == "All" and $memberStatus != "All"){
            $sqlName.= " WHERE member_status = '$memberStatus'  ";
        }

        $sqlName.= " order by last_name asc, first_name asc";

        $resultName = $conn->query($sqlName);
        $numRow = mysqli_num_rows($resultName);
        $counter = 0;

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $idNumber[$counter] = $row['id_number'];
                $accountNumber[$counter] = $row['account_number'];
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
                $membershipStatus[$counter] = $row['member_status'];

                $counter++;
            }
        }

        $sqlOtherInfo = "SELECT * FROM  other_info_table";
        $resultOtherInfo = $conn->query($sqlOtherInfo);
        //$numRow = mysqli_num_rows($resultOtherInfo);
        $counter = 0;

        if($resultOtherInfo->num_rows > 0){
            while ($row = mysqli_fetch_array($resultOtherInfo)) {
                # code...
                $birthPlace[$counter] = $row['birth_place'];
                $birthDate[$counter] = $row['birth_date'];
                $tinNumber[$counter] = $row['tin_number'];
                $sssNumber[$counter] = $row['sss_number'];

                $counter++;
            }
        }

        $sqlContact = "SELECT * FROM  contact_table";
        $resultContact = $conn->query($sqlContact);
        //$numRow = mysqli_num_rows($resultContact);
        $counter = 0;

        if($resultContact->num_rows > 0){
            while ($row = mysqli_fetch_array($resultContact)) {
                # code...
                $mobileNumber[$counter] = $row['mobile_number'];

                $counter++;
            }
        }

        if($printReport == "printReport"){

            $pdf = new FPDF();

            $rowCounter = 0;

            $pdf->SetFont('Arial','B',9);
            $pdf->AddPage('L','Legal', 0);
            
            //foreach($header as $col)
            $pdf->Cell(10,7,"#",1);
            $pdf->Cell(30,7,"ID #",1);
            $pdf->Cell(65,7,"Name",1);
            $pdf->Cell(70,7,"Birth Place",1);
            $pdf->Cell(30,7,"Birth Date",1);
            $pdf->Cell(30,7,"TIN #",1);
            $pdf->Cell(30,7,"SSS #",1);
            $pdf->Cell(30,7,"Mobile #",1);
            $pdf->Cell(30,7,"Status",1);
            $pdf->Ln();

            $fullName[] = "";
            $countm = 0;
            while($rowCounter < $numRow) {
                    $countm++;
                    $pdf->Cell(10,7,"$countm",1);
                    $pdf->Cell(30,7,"$idNumber[$rowCounter]",1);
                    $fullName[$rowCounter] = $lastName[$rowCounter] . ", " . $firstName[$rowCounter] . " " . $middleName[$rowCounter];
                    $pdf->Cell(65,7,"$fullName[$rowCounter]",1);
                    $pdf->Cell(70,7,"$birthPlace[$rowCounter]",1);
                    $pdf->Cell(30,7,"$birthDate[$rowCounter]",1);
                    $pdf->Cell(30,7,"$tinNumber[$rowCounter]",1);
                    $pdf->Cell(30,7,"$sssNumber[$rowCounter]",1);
                    $pdf->Cell(30,7,"$mobileNumber[$rowCounter]",1);
                    $pdf->Cell(30,7,"$membershipStatus[$rowCounter]",1);
                    $pdf->Ln();
                $rowCounter ++;
            }

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
                        
                        <div class="col-md-10">
                            <select class="form-control" id="tpres" name="searchMember" value="<?php echo $searchMember;?>">
                              <option value="" <?php if($searchMember == "") echo "selected"; ?>>Select</option>
                              <option value="Regular" <?php if($searchMember == "Regular") echo "selected"; ?>>Regular</option>
                              <option value="Associate" <?php if($searchMember == "Associate") echo "selected"; ?>>Associate</option>
                              <option value="All" <?php if($searchMember == "All") echo "selected"; ?>>All</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10">
                            <select class="form-control" id="tpres" name="memberStatus" value="<?php echo $memberStatus;?>">
                              <option value="" <?php if($memberStatus == "") echo "selected"; ?>>Select</option>
                              <option value="Active" <?php if($memberStatus == "Active") echo "selected"; ?>>Active</option>
                              <option value="Inactive" <?php if($memberStatus == "Inactive") echo "selected"; ?>>Inactive</option>
                              <option value="Resigned" <?php if($memberStatus == "Resigned") echo "selected"; ?>>Resigned</option>
                              <option value="Diseased" <?php if($memberStatus == "Diseased") echo "selected"; ?>>Diseased</option>
                              <option value="All" <?php if($memberStatus == "All") echo "selected"; ?>>All</option>
                            </select>
                        </div>
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
                <p>List of <span><?php echo $searchMember;?></span> Members</p>
                <br>
                <div class="table table-striped table-hover">
                <?php
                echo "<table>
                <tr>
                    <th></th>
                    <th>ID #</th>
                    <th>Name</th>
                    <th>Birth Place</th>
                    <th>Birth Date</th>
                    <th>TIN #</th>
                    <th>SSS #</th>
                    <th>Mobile #</th>
                    <th>Status</th>

                </tr>";
                
                $counterh = 0;
                $number = 0;
                while($counterh < $numRow) {
                        echo "<tr>";
                            $number = $counterh + 1;
                            echo "<td>" . $number . "</td>";
                            echo "<td>" . $idNumber[$counterh] . "</td>";
                            echo "<td>" . $lastName[$counterh] . ", " . $firstName[$counterh] . " " . $middleName[$counterh] . "</td>";
                            echo "<td>" . $birthPlace[$counterh] . "</td>";
                            echo "<td>" . $birthDate[$counterh] . "</td>";
                            echo "<td>" . $tinNumber[$counterh] . "</td>";
                            echo "<td>" . $sssNumber[$counterh] . "</td>";
                            echo "<td>" . $mobileNumber[$counterh] . "</td>";
                            echo "<td>" . $membershipStatus[$counterh] . "</td>";
                        echo "</tr>";
                    $counterh ++;
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