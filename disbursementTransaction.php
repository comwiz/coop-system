<!DOCTYPE html>
<html>

<?php  

require_once 'session.php';

$dateTransaction = date('Y-m-d');
$voucherNumber = "";
$orNumber = "";
$typeExpensesC = "";
$categoryExpensesAC = "";
$categoryExpensesFC = "";
$amount = "";
$remarks = "";
$exitB = "";
$countErr = "";
$infomessage = "";

$idNumber = "";
$idNumberSearch = "";
$firstName = "";
$middleName = "";
$lastName = "";

$insertExpenses = "";
$searchIDMember = "";
$cbur = 0;
$exp = 0;

$expC = "";

$sqlbi = "SELECT * FROM  chart_accounts_main";
$resultbi = $conn->query($sqlbi);
//$numRow = $numRow + mysqli_num_rows($resultbi);
$ChartAccountsCounter = 0;
$charAccountMain = "";
$charAccountCodeLC[] = "";
$charAccountCode[] = "";
$charAccountTitle[] = "";
$charAccountCategory[] = "";

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $charAccountMain = $row['account_category'];

        $sqlCA = "SELECT * FROM  chart_accounts_main WHERE account_category != '$charAccountMain' ";
        $resultCA = $conn->query($sqlCA);
        //$numRow = $numRow + mysqli_num_rows($resultbi);
        $ChartAccountsCounter = 0;
        $charAccountMain = "";

        if($resultCA->num_rows > 0){
            while ($rowCA = mysqli_fetch_array($resultCA)) {
                # code...
                $charAccountCodeLC[$ChartAccountsCounter] = $rowCA['account_code_lc'];
                $charAccountCode[$ChartAccountsCounter] = $rowCA['account_code'];
                $charAccountTitle[$ChartAccountsCounter] = $rowCA['account_category'];
                $charAccountCategory[$ChartAccountsCounter] = $rowCA['account_category'];
                $ChartAccountsCounter++;
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["insertExpenses"])) {
        $insertExpenses = test_input($_POST["insertExpenses"]);
    }

    if (!empty($_POST["idNumberSearch"])) {
        $idNumberSearch = test_input($_POST["idNumberSearch"]);
    }

    if (!empty($_POST["searchIDMember"])) {
        $searchIDMember = test_input($_POST["searchIDMember"]);
    }

    if (!empty($_POST["exitB"])) {
        $exitB = test_input($_POST["exitB"]);
    }

    if (empty($_POST["dateTransaction"])) {
        $countErr++;
    }else {
        $dateTransaction = test_input($_POST["dateTransaction"]);
    }

    if (empty($_POST["voucherNumber"])) {
        $countErr++;
    }else {
        $voucherNumber = test_input($_POST["voucherNumber"]);
    }

    /*if (empty($_POST["orNumber"])) {
        $countErr++;
    }else {
        $orNumber = test_input($_POST["orNumber"]);
    }*/

    if (empty($_POST["typeExpensesC"])) {
        $countErr++;
    }else {
        $typeExpensesC = test_input($_POST["typeExpensesC"]);

        if(substr($typeExpensesC, 0,2) == "AC"){
          if (empty($_POST["categoryExpensesAC"])) {
              $countErr++;
          }else {
              $categoryExpensesAC = test_input($_POST["categoryExpensesAC"]);
              if (empty($_POST["expC"])) {
                  $countErr++;
              }else {
                  $expC = test_input($_POST["expC"]);
              }
          }
        }elseif(substr($typeExpensesC, 0,2) == "FC"){
          if (empty($_POST["categoryExpensesFC"])) {
              $countErr++;
          }else {
              $categoryExpensesFC = test_input($_POST["categoryExpensesFC"]);
              if (empty($_POST["expC"])) {
                  $countErr++;
              }else {
                  $expC = test_input($_POST["expC"]);
              }
          }
        }elseif(substr($typeExpensesC, 0,2) == "AT"){
          if (empty($_POST["categoryExpensesAT"])) {
              $countErr++;
          }else {
              $categoryExpensesAT = test_input($_POST["categoryExpensesAT"]);
          }
        }elseif(substr($typeExpensesC, 0,2) == "LB"){
          if (empty($_POST["categoryExpensesLB"])) {
              $countErr++;
          }else {
              $categoryExpensesLB = test_input($_POST["categoryExpensesLB"]);
              if (empty($_POST["idNumber"])) {
                  $countErr++;
              }else {
                  $idNumber = test_input($_POST["idNumber"]);
                  
              }
          }
        }elseif(substr($typeExpensesC, 0,2) == "SF"){
          if (empty($_POST["categoryExpensesSF"])) {
              $countErr++;
          }else {
              $categoryExpensesSF = test_input($_POST["categoryExpensesSF"]);
              if (empty($_POST["expC"])) {
                  $countErr++;
              }else {
                  $expC = test_input($_POST["expC"]);
              }
          }
        }elseif(substr($typeExpensesC, 0,2) == "OX"){
          if (empty($_POST["categoryExpensesOX"])) {
              $countErr++;
          }else {
              $categoryExpensesOX = test_input($_POST["categoryExpensesOX"]);
          }
        }
    }

    if (empty($_POST["amount"])) {
        $countErr++;
    }else {
        $amount = test_input($_POST["amount"]);
    }

    if (!empty($_POST["remarks"])) {
        $remarks = test_input($_POST["remarks"]);
    }

    if($exitB == "exitB"){
      session_destroy();
      header("Location: http://localhost/projectkikz/samplemwmmpc/application/views/home/login.php");
    }


    if($searchIDMember == "searchIDMember"){
      $sqlSearchName = "SELECT * FROM name_table WHERE CONCAT(first_name, ' ', last_name) LIKE '%$idNumberSearch%' OR last_name LIKE '%$idNumberSearch%' or  id_number = '$idNumberSearch' ";
        $resultSearchName = $conn->query($sqlSearchName);

        if($resultSearchName->num_rows > 0){
            while($row = mysqli_fetch_array($resultSearchName)){
              $idNumber = $row['id_number'];
              $accountNumber = $row['account_number'];
              $firstName = $row['first_name'];
              $middleName = $row['middle_name'];
              $lastName = $row['last_name'];
              //$totalPayment = 0;
            }
        }else{
            $idNumber = "";
            $firstName = "";
            $middleName = "";
            $lastName = "";
            $totalPayment = 0;

        }
    }

    if($insertExpenses == "insertExpenses"){

      if($countErr<=0){
        $typeExpensesC = substr($typeExpensesC, 0,2);
        //echo "$typeExpensesC";
        if($typeExpensesC == "AC"){
          $categoryExpenses = substr($categoryExpensesAC, 0,2);
        }elseif($typeExpensesC == "FC"){
          $categoryExpenses = substr($categoryExpensesFC, 0,2);
        }elseif($typeExpensesC == "SF"){
          $categoryExpenses = substr($categoryExpensesSF, 0,2);
        }elseif($typeExpensesC == "OX"){
          $categoryExpenses = substr($categoryExpensesOX, 0,2);
        }elseif($typeExpensesC == "AT"){
          $categoryExpenses = substr($categoryExpensesAT, 0,2);
        }
        
        if($typeExpensesC == "AC" or $typeExpensesC =="FC" or $typeExpensesC =="SF" or $typeExpensesC =="OX" or $typeExpensesC =="AT"){
            $exp = 1;
            $sql5 = "INSERT INTO expenses_table(expenses_type, expenses_category, account_expense,amount, voucher_number, Remarks , date_transaction, encoded_by) 
                VALUES ('$typeExpensesC','$categoryExpenses', '$expC' ,'$amount','$voucherNumber', '$remarks' ,'$dateTransaction','encodedBy')";

            if ($conn->query($sql5) === TRUE) {
               $infomessage = "Record updated successfully";
               $typeExpensesC = "";
               $categoryExpensesAC = "";
               $categoryExpensesFC = "";
               $categoryExpensesSF = "";
               $categoryExpensesOX = "";
               //$voucherNumber = "";
               $amount = "";
            } 

            else { 
              echo "Error: " . $sql5 . "<br>" . $conn->error;
            }
        }elseif ($typeExpensesC == "LB") {
          $categoryExpenses = substr($categoryExpensesLB, 0,2);

          if($categoryExpenses == "TD" or $categoryExpenses == "FD" or $categoryExpenses == "SD" or $categoryExpenses == "SC"){
            if($categoryExpenses == "TD"){
                $cbur = 1;
                $sql5 = "INSERT INTO time_deposit_table(id_number, type_transaction, type_savings,voucher_number,amount, date_transaction, encoded_by) 
                    VALUES ('$idNumber','Withdraw','TD','$voucherNumber','$amount','$dateTransaction','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $categoryExpenses = $idNumber;
                   $amount = 0;
                   $categoryExpensesLB = "";
                   $typeExpensesC = "";
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }elseif ($categoryExpenses == "FD") {
                $cbur = 1;
                $sql5 = "INSERT INTO fixed_deposit_table(id_number, type_transaction, type_savings,voucher_number,amount, date_transaction, encoded_by) 
                    VALUES ('$idNumber','Withdraw','FD','$voucherNumber','$amount','$dateTransaction','$encodedBy')";

                if ($conn->query($sql5) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $categoryExpenses = $idNumber;
                   $amount = 0;
                   $categoryExpensesLB = "";
                   $typeExpensesC = "";
                } 
                else { 
                      echo "Error: " . $sql5 . "<br>" . $conn->error;
                }
            }elseif ($categoryExpenses == "SC") {
                $cbur = 1;
                $sql4 = "INSERT INTO share_capital_table(id_number, type_transaction,voucher_number,amount, date_transaction, encoded_by) 
                    VALUES ('$idNumber','Withdraw','$voucherNumber','$amount','$dateTransaction','$encodedBy')";

                if ($conn->query($sql4) === TRUE) {
                   $infomessage = "Record updated successfully";
                   $categoryExpenses = $idNumber;
                   $amount = 0;
                   $categoryExpensesLB = "";
                   $typeExpensesC = "";
                }else { 
                      echo "Error: " . $sql4 . "<br>" . $conn->error;
                      }
            }else{

            }
          }else{
            $exp = 1;
            $sql5 = "INSERT INTO expenses_table(expenses_type, expenses_category, account_expense,amount, voucher_number, Remarks , date_transaction, encoded_by) 
                VALUES ('$typeExpensesC','$categoryExpenses', '$expC' ,'$amount','$voucherNumber', '$remarks' ,'$dateTransaction','encodedBy')";

            if ($conn->query($sql5) === TRUE) {
               $infomessage = "Record updated successfully";
               $typeExpensesC = "";
               //$categoryExpenses = "";
               $categoryExpensesLB = "";
               //$voucherNumber = "";
               $amount = "";
            }else{ 
              echo "Error: " . $sql5 . "<br>" . $conn->error;
            }
          }
        }

        $sql5 = "INSERT INTO disbursement_table(id_number, voucher_number,cl ,lb,pnl,pnr, rcln, exp, cbur,sdr, date_transaction, encoded_by) 
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

<head>
    <?php include "css.html" ?>
    <title>Disbursement</title>
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
                        <div id = "sm" class="col-lg-2.5" style="background-color:#fff; padding: 5px; margin: 5px;">
                            <h6>Search Member</h6>
                            <div class="form-group">
                                <label class="col-md-5 control-label">ID Number</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $idNumberSearch;?>" name = "idNumberSearch">
                                </div>
                                <br>
                                <div class="col-sm-10">
                                      <button onclick="onInput()" class="btn btn-outline-success my-2 my-sm-0" id = "search" name = "searchIDMember" value = "searchIDMember" type="submit">Search</button>
                                </div>
                            </div>

                            <h5>Personal Information</h5>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $idNumber;?>" name = "idNumber" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="First Name" value = "<?php echo $firstName;?>" name = "firstName" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Middle Name" value = "<?php echo $middleName;?>" name = "middleName" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Last Name" value = "<?php echo $lastName;?>" name = "lastName" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2.5" style="background-color:#fff; padding: 5px; margin: 5px">
                            <h6>Disbursement</h6>

                            <label style="width: 120px">Date</label>
                            <input style="width: 200px" type="date" value = "<?php echo $dateTransaction;?>" name = "dateTransaction"><br>

                            <label style="width: 120px">Voucher #</label>
                            <input style="width: 200px" type="text" value = "<?php echo $voucherNumber;?>" name = "voucherNumber" autocomplete="off"><br>

                            <label style="width: 120px">Account Expense</label>
                            <select style="width: 200px" name="expC" value="<?php echo $expC;?>">
                              <option value="" <?php if($expC == "") echo "selected"; ?>>Select</option>
                              <option value="td" <?php if($expC == "td") echo "selected"; ?>>Trading</option>
                              <option value="ld" <?php if($expC == "ld") echo "selected"; ?>>Lending</option>
                              <option value="sf" <?php if($expC == "sf") echo "selected"; ?>>Statury Fund</option>
                            </select>
                            <br>

                            <label style="width: 120px">Amount</label>
                            <input style="width: 200px" type="text" value = "<?php echo $amount;?>" name = "amount" autocomplete="off"><br>


                            <label style="width: 120px">Disbursement Category</label>
                            <input style="width: 200px" type="text" oninput="onInput()" list = "typeExpenses" value = "<?php echo $typeExpensesC;?>" id = "input" name="typeExpensesC" autocomplete="off"><br>

                            <datalist id = "typeExpenses">
                               <option value="AC Administrative Cost">
                               <option value="FC Financing Cost">
                               <option value="AT Asset">
                               <option value="LB Liabilities">
                               <option value="SF Statutory Funds">
                               <option value="OX Operating Expenses">
                            </datalist><br>

                            <!--Administrative Cost-->
                            <div id = "ACF" style="display: none;">
                              <label style="width: 120px">Category</label>
                              <input style="width: 250px" list = "categoryExpensesAC" name="categoryExpensesAC">
                              <datalist id = "categoryExpensesAC">
                                <option value="AF Affiliation Fee">
                                <option value="AL Allowance for Probable Loss">
                                <option value="BC Bank Charges">
                                <option value="CE Collection Expense">
                                <option value="CM Communication">
                                <option value="EB Employees Benefits">
                                <option value="DB Depreciation Expense (Buiding Improvement)">
                                <option value="DO Depreciation Expense (Office Furniture & Fixtures)">
                                <option value="DE Depreciation Expense (Office Equipment)">
                                <option value="GL Gas Oil and Lubricants">
                                <option value="GE General Assembly Expenses">
                                <option value="GS General Support Services">
                                <option value="OB Officers Benefits">
                                <option value="HA Officers Honorarium and Allowances">
                                <option value="IS Insurance Expense">
                                <option value="LI Litigation Expenses">
                                <option value="MC Meeting and Conferences">
                                <option value="MB Members Benefit Expense">
                                <option value="ME Miscellaneous Expense">
                                <option value="OS Office Supplies">
                                <option value="PM Periodicals Magazines and Subscription">
                                <option value="LW Power Light and Water">
                                <option value="PF Professional Fees">
                                <option value="PE Promotional Expense">
                                <option value="FB Provision for Members Future Benefits">
                                <option value="PL Provision for Probable Losses on Accounts/Loans/Installment Receivables">
                                <option value="RT Rentals">
                                <option value="RP Repairs and Maintenance">
                                <option value="RN Representation and Entertainment">
                                <option value="RB Retirement Benefit Expense">
                                <option value="SW Salaries and Wages">
                                <option value="SP School Program Support">
                                <option value="SC Social and Community Service Expense">
                                <option value="GB SSS Philhealth ECC Pag-ibig Premium">
                                <option value="TF Taxes Fees, Charges and Liscences">
                                <option value="TS Trainings/Seminars">
                                <option value="TT Travel and Transportation">
                              </datalist><br>
                            </div>

                            <!--Financing Cost-->
                            <div id = "FCF" style="display: none;">
                              <label style="width: 120px">Category</label>
                              <input style="width: 250px" list = "categoryExpensesFC" name="categoryExpensesFC">
                              <datalist id = "categoryExpensesFC">
                                <option value="IB Interest Expense on Borrowings">
                                <option value="IE Interest Expense on Deposits and Liabilities"><!--71200-->
                                <option value="BF Bank Charges">
                                <option value="OF Other Financing Charges">
                              </datalist><br>
                            </div>

                            <!-- Asset  -->
                            <div id = "AT" style="display: none;">
                              <label style="width: 120px">Category</label>
                              <input style="width: 250px" list = "categoryExpensesAT" name="categoryExpensesAT">
                              <datalist id = "categoryExpensesAT">
                                <option value="BI Buiding Improvements">
                                <option value="FF Office Furniture and Fixtures">
                                <option value="OE Office Equiment">
                                <option value="LP Other Funds and Deposits (LBP - SA)">
                                <option value="BB Investment in Non Marketable Equity Securities (BCB)">
                                <option value="SK Investment in Non Marketable Equity Securities (SFC)">
                                <option value="BS Investment in Non Marketable Equity Securities (BCSF)">
                              </datalist><br>
                            </div>
                            
                            <!-- Liabilities  -->
                            <div id = "LB" style="display: none;">
                              <label style="width: 120px">Category</label>
                              <input style="width: 250px" list = "categoryExpensesLB" name="categoryExpensesLB">
                              <datalist id = "categoryExpensesLB">
                                <option value="FD Fixed Deposit">
                                <option value="TD Time Deposit">
                                <option value="SD Special Deposit">
                                <option value="SC Share Capital">

                                <!--TBD-->
                                <option value="AP Accounts Payable">
                                <option value="LS Loans Payable SAKOMI">
                                <option value="LM Loans Payable MWF">
                                <option value="IM Insurance Premium Payable">
                                <option value="IL Interest on Share Capital">
                                <option value="PR Patronage Refund Payable">
                                <option value="SR SSS/Pag-ibig/Philhealth Contribution Payable">
                                <option value="SR Expanded Witholding Tax Payable">
                                <option value="DF Due to Federation/Union">
                                <option value="RF Retirement Benefit Fund">
                                <option value="MF Member Benefit Fund">
                                <option value="CG CGF">
                              </datalist><br>
                            </div>

                            <!-- Statutory Funds  -->
                            <div id = "SF" style="display: none;">
                              <label style="width: 120px">Category</label>
                              <input style="width: 250px" list = "categoryExpensesSF" name="categoryExpensesSF">
                              <datalist id = "categoryExpensesSF">
                                <option value="GF General Reserve Fund">
                                <option value="EF Educational and Training Fund">
                                <option value="OP Optional Fund">
                                <option value="CF Community and Development Fund">
                              </datalist><br>
                            </div>

                            <!-- Operating Expense  -->
                            <div id = "OX" style="display: none;">
                              <label style="width: 120px">Category</label>
                              <input style="width: 250px" list = "categoryExpensesOX" name="categoryExpensesOX">
                              <datalist id = "categoryExpensesOX">
                                <option value="RA Rice Purchase">
                              </datalist><br>
                            </div>

                            <label style="width: 120px">Remarks</label>
                            <textarea style="width: 250px;height: 150px;" value = "<?php echo $remarks;?>" name = "remarks"></textarea><br><br>

                            <button class="btn btn-outline-success my-2 my-sm-0" name = "insertExpenses" value = "insertExpenses" type="submit" style="align-self: center;">POST EXPENSES</button>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
  function onInput() {
    
    var val = document.getElementById("input").value;
    var opts = document.getElementById('typeExpenses').childNodes;
    for (var i = 0; i < opts.length; i++) {
      if (opts[i].value === val) {
        // An item was selected from the list!
        // yourCallbackHere()
        if(opts[i].value == val){
          if(opts[i].value == "AC Administrative Cost"){
            document.getElementById("ACF").style.display = 'block';
            document.getElementById("FCF").style.display = 'none';
            document.getElementById("AT").style.display = 'none';
            document.getElementById("LB").style.display = 'none';
            document.getElementById("OX").style.display = 'none';
            document.getElementById("SF").style.display = 'none';
            document.getElementById("sm").style.display = 'none';
          }else if(opts[i].value == "FC Financing Cost"){
            document.getElementById("ACF").style.display = 'none';
            document.getElementById("FCF").style.display = 'block';
            document.getElementById("AT").style.display = 'none';
            document.getElementById("LB").style.display = 'none';
            document.getElementById("sm").style.display = 'none';
            document.getElementById("SF").style.display = 'none';
            document.getElementById("OX").style.display = 'none';
          }else if(opts[i].value == "AT Asset"){
            document.getElementById("ACF").style.display = 'none';
            document.getElementById("FCF").style.display = 'none';
            document.getElementById("AT").style.display = 'block';
            document.getElementById("LB").style.display = 'none';
            document.getElementById("OX").style.display = 'none';
            document.getElementById("SF").style.display = 'none';
          }else if(opts[i].value == "LB Liabilities"){
            document.getElementById("ACF").style.display = 'none';
            document.getElementById("FCF").style.display = 'none';
            document.getElementById("AT").style.display = 'none';
            document.getElementById("LB").style.display = 'block';
            document.getElementById("OX").style.display = 'none';
            document.getElementById("SF").style.display = 'none';
          }else if(opts[i].value == "SF Statutory Funds"){
            document.getElementById("ACF").style.display = 'none';
            document.getElementById("FCF").style.display = 'none';
            document.getElementById("AT").style.display = 'none';
            document.getElementById("LB").style.display = 'none';
            document.getElementById("OX").style.display = 'none';
            document.getElementById("SF").style.display = 'block';
          }else{
            document.getElementById("ACF").style.display = 'none';
            document.getElementById("FCF").style.display = 'none';
            document.getElementById("AT").style.display = 'none';
            document.getElementById("LB").style.display = 'none';
            document.getElementById("OX").style.display = 'block';
            document.getElementById("SF").style.display = 'none';
          }
        }
        //alert(opts[i].value);
        break;
      }
    }
  }
</script>

</body>
    <?php include "css1.html" ?>
</html>