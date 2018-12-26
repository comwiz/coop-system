<!DOCTYPE html>
<html>

<?php  

require_once 'session.php';

$dateTransaction = date('Y-m-d');
$referencenumber = "JJ";
$orNumber = "";
$amount = "";
$countErr = "";
$infomessage = "";

$insertExpenses = "";

$expC = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["insertExpenses"])) {
        $insertExpenses = test_input($_POST["insertExpenses"]);
    }

    if (empty($_POST["dateTransaction"])) {
        $countErr++;
    }else {
        $dateTransaction = test_input($_POST["dateTransaction"]);
    }

    if (empty($_POST["expC"])) {
        $countErr++;
    }else {
        $expC = test_input($_POST["expC"]);
    }

    if (empty($_POST["referencenumber"])) {
        $countErr++;
    }else {
        $referencenumber = test_input($_POST["referencenumber"]);
    }


    if (empty($_POST["amount"])) {
        $countErr++;
    }else {
        $amount = test_input($_POST["amount"]);
    }

    if($insertExpenses == "insertExpenses"){

      if($countErr<=0){

        $sql5 = "INSERT INTO other_income_table(id_number, or_number, income_code,amount,date_transaction, encoded_by) 
            VALUES ('JE','$referencenumber','$expC','$amount','$dateTransaction','$encodedBy')";

        if ($conn->query($sql5) === TRUE) {
           $infomessage = "Record updated successfully";
           $mbfPayment = 0;
        } 
        else { 
              echo "Error: " . $sql5 . "<br>" . $conn->error;
        }

        /*$sql5 = "INSERT INTO disbursement_table(id_number, voucher_number,cl ,lb,pnl,pnr, rcln, exp, cbur,sdr, date_transaction, encoded_by) 
            VALUES ('$categoryExpenses','$voucherNumber','0','0','0','0','0','$exp','$cbur','0','$dateTransaction','$encodedBy')";

        if ($conn->query($sql5) === TRUE) {
           $infomessage = "Record updated successfully";
           //echo "$infomessage";
           $voucherNumber = "";
           $categoryExpenses = "";
           $cbur = 0;
           $cbur = 1 ;
        }else { 
              echo "Error: " . $sql5 . "<br>" . $conn->error;
        }*/
      }else{
        $infomessage = "FILL UP EMPTY FIELDS";
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

<head>
    <?php include "css.html" ?>
    <title>Journal Entry Others</title>
</head>

<style type="text/css">
.none{
    display: none;
}
.inline{
    display: inline;
}

<style type="text/css">
.none{
    display: none;
}
.inline{
    display: inline;
}

</style>

<body>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div>
            <?php //include 'topbar.php';?>
            <!--member account info-->
            <div class="row" >
                <?php include 'navigation.php';?>
                <div class="col-sm-12" style="margin-top:70px;margin-left: 16.7%;margin-bottom: 200px;">  
                    <p align="center"><span><?php echo $infomessage;?></span><br></p>
                    <div class="row">
                        <!-- -->

                        <div class="col-lg-2.5" style="background-color:#fff; padding: 5px; margin: 5px">
                            <h6>Journal Entry Others</h6>
                            <br>

                            <label style="width: 120px">Date</label>
                            <input style="width: 200px" type="date" value = "<?php echo $dateTransaction;?>" name = "dateTransaction"><br>

                            <label style="width: 120px">Reference #</label>
                            <input style="width: 200px" type="text" value = "<?php echo $referencenumber;?>" name = "referencenumber" autocomplete="off" readonly><br>

                            <label style="width: 120px">Account Expense</label>
                            <select style="width: 200px" name="expC" value="<?php echo $expC;?>">
                              <option value="" <?php if($expC == "") echo "selected"; ?>>Select</option>
                              <option value="ilbp" <?php if($expC == "ilbp") echo "selected"; ?>>Interest Income LBP</option>
                              <option value="ibcb" <?php if($expC == "ibcb") echo "selected"; ?>>Interest Income BCB</option>
                              <option value="dbcb" <?php if($expC == "dbcb") echo "selected"; ?>>Divedends- BCB </option>
                            </select>
                            <br>

                            <label style="width: 120px">Amount</label>
                            <input style="width: 200px" type="text" value = "<?php echo $amount;?>" name = "amount" autocomplete="off"><br>

                            <button class="btn btn-outline-success my-2 my-sm-0" name = "insertExpenses" value = "insertExpenses" type="submit" style="align-self: center;">JOURNAL ENTRY</button>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>

</script>

</body>
    <?php include "css1.html" ?>
</html>