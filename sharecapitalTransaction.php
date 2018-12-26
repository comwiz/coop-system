<?php  

$idNumber = "";

$accountNumber = "";
$firstName = "";
$middleName = "";
$lastName = "";

$typeTransaction = "";
$referenceNumber = "";
$amount = "";
$dateTransaction = "";
$encodedBy = "";

$countErr = "";
$identifier = "";

include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["idNumber"])) {
        $countErr++;
    }else {
        $idNumber = test_input($_POST["idNumber"]);
    }

    if (empty($_POST["typeTransaction"])) {
        $countErr++;
    }else {
        $typeTransaction = test_input($_POST["typeTransaction"]);
    }

    if (empty($_POST["referenceNumber"])) {
        $countErr++;
    }else {
        $referenceNumber = test_input($_POST["referenceNumber"]);
    }

    if (empty($_POST["amount"])) {
        $countErr++;
    }else {
        $amount = test_input($_POST["amount"]);
    }

    if (empty($_POST["dateTransaction"])) {
        $countErr++;
    }else {
        $dateTransaction = test_input($_POST["dateTransaction"]);
    }

    $sqlSearchName = "SELECT * FROM name_table WHERE id_number = '$idNumber'";
    $resultSearchName = $conn->query($sqlSearchName);

    if($resultSearchName->num_rows > 0){
        while($row = mysqli_fetch_array($resultSearchName)){
          $accountNumber = $row['account_number'];
          $firstName = $row['first_name'];
          $middleName = $row['middle_name'];
          $lastName = $row['last_name'];
        }
    }

    $sql = "INSERT INTO share_capital_table(id_number, type_transaction, reference_number,amount, date_transaction, encoded_by) 
            VALUES ('$idNumber','$typeTransaction','$referenceNumber','$amount','$dateTransaction', '1')";

    if ($conn->query($sql) === TRUE){
        $informessage = "New record created successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Share Capital</title>
    <?php include "css.html" ?>
</head>
<body>

<div>
    <?php include 'topbar.php';?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-10" style="margin-top:70px;margin-left: 16.7%;">
                <div class="row">
                    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                        <h5>Account Information</h5>
                        <div class="form-group">
                            <label class="col-md-6 control-label">ID Number</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $idNumber;?>" name = "idNumber">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="align-self: center;">SUBMIT</button>
                          </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-6 control-label">Account Number</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $accountNumber;?>" readonly>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="First Name" value = "<?php echo $firstName;?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Middle Name" value = "<?php echo $middleName;?>" reaadonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Last Name" value = "<?php echo $lastName;?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                        <h5>Share Capital Transaction</h5>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "Voluntary" name = "typeTransaction" placeholder="Type of Transaction" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $referenceNumber;?>" name = "referenceNumber" placeholder="Reference Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "<?php echo $amount;?>" name = "amount" placeholder="Amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="date" class="form-control" value = "<?php echo $dateTransaction;?>" name = "dateTransaction" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="align-self: center;">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
    <?php include "css1.html" ?>
</body>
</html>