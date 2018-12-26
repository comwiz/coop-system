<?php

require_once 'session.php';

$idNumber[] = "";
$firstName  [] = "";
$middleName [] = "";
$lastName [] = "";

$idNumberA = "";
$accountNumberA  = "";
$firstNameA   = "";
$middleNameA  = "";
$lastNameA  = "";

$loanApplicationNumberId = "";
$loanApplicationNumber[] = "";
$loanServiceId[] = "";
$loanAmount[] = "";
$loanTerm[] = "";

$loanApplicationNumberA = "";
$loanServiceIdA = "";
$loanAmountA = "";
$loanInterestA = "";
$loanTermA = "";
$paymentTermA = "";
$typeInterestA = "";

$monthlyAmortization = "";
$principalPayment = "";
$interestPayment = "";
$OSBalance = "";

$myButton = "";
$identifier = "";

$approvedApplication = "";
$deniedApplication = "";
$displayProperty = "none";
$countErr = "";
$numRow = 0;
$date = ""; 

$infomessage = "";

$exitB = "";

$sqlbi = "SELECT * FROM  bl_loan_table WHERE loan_status = 'Review' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);
$counter = 0;

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  ckl_loan_table WHERE loan_status = 'Review' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  cml_loan_table WHERE loan_status = 'Review' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  cl_loan_table WHERE loan_status = 'Review' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  cll_loan_table WHERE loan_status = 'Review' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  edl_loan_table WHERE loan_status = 'Review' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  eml_loan_table WHERE loan_status = 'Review' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  rl_loan_table WHERE loan_status = 'Review' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  sl_loan_table WHERE loan_status = 'Review' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

$sqlbi = "SELECT * FROM  rice_loan_table WHERE loan_status = 'Review' ";
$resultbi = $conn->query($sqlbi);
$numRow = $numRow + mysqli_num_rows($resultbi);

if($resultbi->num_rows > 0){
    while ($row = mysqli_fetch_array($resultbi)) {
        # code...
        $idNumber[$counter] = $row['id_number'];
        $loanApplicationNumber[$counter] = $row['loan_application_number'];
        $loanServiceId[$counter] = $row['loan_service_id'];
        $loanAmount[$counter] = $row['loan_amount'];
        $loanTerm[$counter] = $row['loan_term'];

        $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
        $resultName = $conn->query($sqlName);
        //$numRow = mysqli_num_rows($resultName);

        if($resultName->num_rows > 0){
            while ($row = mysqli_fetch_array($resultName)) {
                # code...
                $firstName[$counter] = $row['first_name'];
                $middleName[$counter] = $row['middle_name'];
                $lastName[$counter] = $row['last_name'];
            }
        }

        $counter++;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   if (!empty($_POST["myButton"])) {
        $loanApplicationNumberId = test_input($_POST["myButton"]);
        $displayProperty = "inline";
   }

   if (!empty($_POST["approvedApplication"])) {
        $approvedApplication = test_input($_POST["approvedApplication"]);
        $displayProperty = "none";
   }

   if (!empty($_POST["deniedApplication"])) {
        $deniedApplication = test_input($_POST["deniedApplication"]);
        $displayProperty = "none";
   }

   if (!empty($_POST["exitB"])) {
        $exitB = test_input($_POST["exitB"]);
   }

   if (empty($_POST["loanApplicationNumberA"])) {
        $countErr++;
   }else {
        $loanApplicationNumberA = test_input($_POST["loanApplicationNumberA"]);
   }

   if($exitB == "exitB"){
        session_destroy();
        header("Location: http://localhost/projectkikz/samplemwmmpc/application/views/home/login.php");
   }

   if(!empty($loanApplicationNumberId)){

        if(substr("$loanApplicationNumberId",0,2) == "BL"){
            $sqlA = "SELECT * FROM  bl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Review'";
        }elseif(substr("$loanApplicationNumberId",0,3) == "CKL"){
            $sqlA = "SELECT * FROM  ckl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Review'";
        }elseif(substr("$loanApplicationNumberId",0,3) == "CLL"){
            $sqlA = "SELECT * FROM  cll_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Review'";
        }elseif(substr("$loanApplicationNumberId",0,3) == "CKL"){
            $sqlA = "SELECT * FROM  ckl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Review'";
        }elseif(substr("$loanApplicationNumberId",0,2) == "CL"){
            $sqlA = "SELECT * FROM  cl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Review'";
        }elseif(substr("$loanApplicationNumberId",0,3) == "CML"){
            $sqlA = "SELECT * FROM  cml_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Review'";
        }elseif(substr("$loanApplicationNumberId",0,3) == "EDL"){
            $sqlA = "SELECT * FROM  edl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Review'";
        }elseif(substr("$loanApplicationNumberId",0,3) == "EML"){
            $sqlA = "SELECT * FROM  eml_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Review'";
        }elseif(substr("$loanApplicationNumberId",0,2) == "RL"){
            $sqlA = "SELECT * FROM  rl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Review'";
        }elseif(substr("$loanApplicationNumberId",0,3) == "RCL"){
            $sqlA = "SELECT * FROM  rice_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Review'";
        }elseif(substr("$loanApplicationNumberId",0,2) == "SL"){
            $sqlA = "SELECT * FROM  sl_loan_table WHERE loan_application_number = '$loanApplicationNumberId' and loan_status = 'Review'";
        }

        $resultA = $conn->query($sqlA);

        if($resultA->num_rows > 0){
            while ($row = mysqli_fetch_array($resultA)) {
                # code...
                $idNumberA = $row['id_number'];
                $loanApplicationNumberA = $row['loan_application_number'];
                $loanServiceIdA = $row['loan_service_id'];
                $loanAmountA = $row['loan_amount'];
                $loanTermA= $row['loan_term'];
                $loanInterestA = $row['loan_interest'];
                $paymentTermA = $row['payment_term'];

                $sqlLS = "SELECT * FROM  loan_services_table WHERE loan_service_id = '$loanServiceIdA' ";
                $resultLS = $conn->query($sqlLS);
                //$numRow = mysqli_num_rows($resultName);

                if($resultLS->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLS)) {
                        # code...
                        $typeInterestA = $row['type_interest'];
                    }
                }

                $sqlLS = "SELECT * FROM  name_table WHERE id_number = '$idNumberA' ";
                $resultLS = $conn->query($sqlLS);
                //$numRow = mysqli_num_rows($resultName);

                if($resultLS->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultLS)) {
                        # code...
                        $accountNumberA = $row['account_number'];
                        $firstNameA = $row['first_name'];
                        $middleNameA = $row['middle_name'];
                        $lastNameA = $row['last_name'];
                    }
                }
            }
        }

        //$loanApplicationNumberId = "";
   }

   if($approvedApplication == "approvedApplication") {
       # code...
        if(substr("$loanApplicationNumberA",0,2) == "BL"){
            $sql = "UPDATE bl_loan_table SET
            loan_status = 'Approved'
            WHERE loan_application_number = '$loanApplicationNumberA'";
        }elseif(substr("$loanApplicationNumberA",0,3) == "CKL"){
            $sql = "UPDATE ckl_loan_table SET
            loan_status = 'Approved'
            WHERE loan_application_number = '$loanApplicationNumberA'";
        }elseif(substr("$loanApplicationNumberA",0,3) == "CLL"){
            $sql = "UPDATE cll_loan_table SET
            loan_status = 'Approved'
            WHERE loan_application_number = '$loanApplicationNumberA'";
        }elseif(substr("$loanApplicationNumberA",0,2) == "CL"){
            $sql = "UPDATE cl_loan_table SET
            loan_status = 'Approved'
            WHERE loan_application_number = '$loanApplicationNumberA'";
        }elseif(substr("$loanApplicationNumberA",0,3) == "CML"){
            $sql = "UPDATE cml_loan_table SET
            loan_status = 'Approved'
            WHERE loan_application_number = '$loanApplicationNumberA'";
        }elseif(substr("$loanApplicationNumberA",0,3) == "EDL"){
            $sql = "UPDATE edl_loan_table SET
            loan_status = 'Approved'
            WHERE loan_application_number = '$loanApplicationNumberA'";
        }elseif(substr("$loanApplicationNumberA",0,3) == "EML"){
            $sql = "UPDATE eml_loan_table SET
            loan_status = 'Approved'
            WHERE loan_application_number = '$loanApplicationNumberA'";
        }elseif(substr("$loanApplicationNumberA",0,2) == "RL"){
            $sql = "UPDATE rl_loan_table SET
            loan_status = 'Approved'
            WHERE loan_application_number = '$loanApplicationNumberA'";
        }elseif(substr("$loanApplicationNumberA",0,3) == "RCL"){
            $sql = "UPDATE rice_loan_table SET
            loan_status = 'Approved'
            WHERE loan_application_number = '$loanApplicationNumberA'";
        }elseif(substr("$loanApplicationNumberA",0,2) == "SL"){
            $sql = "UPDATE sl_loan_table SET
            loan_status = 'Approved'
            WHERE loan_application_number = '$loanApplicationNumberA'";
        }

        $date = date("Y-m-d");
        $sql1 = "UPDATE loan_date_table SET
        date_approved_denied = '$date'
        WHERE loan_application_number = '$loanApplicationNumberA'";

        $sql2 = "UPDATE loan_encoder_table SET
        reviewed_by = '$encodedBy',
        approved_denied_by = '$encodedBy'
        WHERE loan_application_number = '$loanApplicationNumberA'";

         if ($conn->query($sql) === TRUE and $conn->query($sql2) === TRUE) {
           $infomessage = "Record updated successfully";
           //echo "$infomessage";
        } 
        else { 
              echo "Error: " . $sql . "<br>" . $conn->error;
              //echo "Error: " . $sql1 . "<br>" . $conn->error;
              echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
   }
   $numRow = 0;
   if($deniedApplication == "deniedApplication") {
       # code...
        $sql = "UPDATE loan_table SET
        loan_status = 'Denied'
        WHERE loan_application_number = '$loanApplicationNumberA'";

        $date = date("Y/m/d");
        $sql1 = "UPDATE loan_date_table SET
        date_approved_denied = '$date'
        WHERE loan_application_number = '$loanApplicationNumberA'";

        $sql2 = "UPDATE loan_encoder_table SET
        reviewed_by = '1',
        approved_denied_by = '1'
        WHERE loan_application_number = '$loanApplicationNumberA'";

         if ($conn->query($sql) === TRUE and $conn->query($sql1) === TRUE and $conn->query($sql2) === TRUE) {
           $infomessage = "Record updated successfully";
           //echo "$infomessage";
        } 
        else { 
              echo "Error: " . $sql . "<br>" . $conn->error;
              echo "Error: " . $sql1 . "<br>" . $conn->error;
              echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
   }else{
        $sqlbi = "SELECT * FROM  bl_loan_table WHERE loan_status = 'Review' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);
        $counter = 0;

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $idNumber[$counter] = $row['id_number'];
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
                $resultName = $conn->query($sqlName);
                //$numRow = mysqli_num_rows($resultName);

                if($resultName->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultName)) {
                        # code...
                        $firstName[$counter] = $row['first_name'];
                        $middleName[$counter] = $row['middle_name'];
                        $lastName[$counter] = $row['last_name'];
                    }
                }

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  ckl_loan_table WHERE loan_status = 'Review' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $idNumber[$counter] = $row['id_number'];
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
                $resultName = $conn->query($sqlName);
                //$numRow = mysqli_num_rows($resultName);

                if($resultName->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultName)) {
                        # code...
                        $firstName[$counter] = $row['first_name'];
                        $middleName[$counter] = $row['middle_name'];
                        $lastName[$counter] = $row['last_name'];
                    }
                }

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  cml_loan_table WHERE loan_status = 'Review' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $idNumber[$counter] = $row['id_number'];
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
                $resultName = $conn->query($sqlName);
                //$numRow = mysqli_num_rows($resultName);

                if($resultName->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultName)) {
                        # code...
                        $firstName[$counter] = $row['first_name'];
                        $middleName[$counter] = $row['middle_name'];
                        $lastName[$counter] = $row['last_name'];
                    }
                }

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  cl_loan_table WHERE loan_status = 'Review' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $idNumber[$counter] = $row['id_number'];
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
                $resultName = $conn->query($sqlName);
                //$numRow = mysqli_num_rows($resultName);

                if($resultName->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultName)) {
                        # code...
                        $firstName[$counter] = $row['first_name'];
                        $middleName[$counter] = $row['middle_name'];
                        $lastName[$counter] = $row['last_name'];
                    }
                }

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  cll_loan_table WHERE loan_status = 'Review' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $idNumber[$counter] = $row['id_number'];
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
                $resultName = $conn->query($sqlName);
                //$numRow = mysqli_num_rows($resultName);

                if($resultName->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultName)) {
                        # code...
                        $firstName[$counter] = $row['first_name'];
                        $middleName[$counter] = $row['middle_name'];
                        $lastName[$counter] = $row['last_name'];
                    }
                }

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  edl_loan_table WHERE loan_status = 'Review' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $idNumber[$counter] = $row['id_number'];
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
                $resultName = $conn->query($sqlName);
                //$numRow = mysqli_num_rows($resultName);

                if($resultName->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultName)) {
                        # code...
                        $firstName[$counter] = $row['first_name'];
                        $middleName[$counter] = $row['middle_name'];
                        $lastName[$counter] = $row['last_name'];
                    }
                }

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  eml_loan_table WHERE loan_status = 'Review' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $idNumber[$counter] = $row['id_number'];
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
                $resultName = $conn->query($sqlName);
                //$numRow = mysqli_num_rows($resultName);

                if($resultName->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultName)) {
                        # code...
                        $firstName[$counter] = $row['first_name'];
                        $middleName[$counter] = $row['middle_name'];
                        $lastName[$counter] = $row['last_name'];
                    }
                }

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  rl_loan_table WHERE loan_status = 'Review' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $idNumber[$counter] = $row['id_number'];
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
                $resultName = $conn->query($sqlName);
                //$numRow = mysqli_num_rows($resultName);

                if($resultName->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultName)) {
                        # code...
                        $firstName[$counter] = $row['first_name'];
                        $middleName[$counter] = $row['middle_name'];
                        $lastName[$counter] = $row['last_name'];
                    }
                }

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  sl_loan_table WHERE loan_status = 'Review' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $idNumber[$counter] = $row['id_number'];
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
                $resultName = $conn->query($sqlName);
                //$numRow = mysqli_num_rows($resultName);

                if($resultName->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultName)) {
                        # code...
                        $firstName[$counter] = $row['first_name'];
                        $middleName[$counter] = $row['middle_name'];
                        $lastName[$counter] = $row['last_name'];
                    }
                }

                $counter++;
            }
        }

        $sqlbi = "SELECT * FROM  rice_loan_table WHERE loan_status = 'Review' ";
        $resultbi = $conn->query($sqlbi);
        $numRow = $numRow + mysqli_num_rows($resultbi);

        if($resultbi->num_rows > 0){
            while ($row = mysqli_fetch_array($resultbi)) {
                # code...
                $idNumber[$counter] = $row['id_number'];
                $loanApplicationNumber[$counter] = $row['loan_application_number'];
                $loanServiceId[$counter] = $row['loan_service_id'];
                $loanAmount[$counter] = $row['loan_amount'];
                $loanTerm[$counter] = $row['loan_term'];

                $sqlName = "SELECT * FROM  name_table WHERE id_number = '$idNumber[$counter]' ";
                $resultName = $conn->query($sqlName);
                //$numRow = mysqli_num_rows($resultName);

                if($resultName->num_rows > 0){
                    while ($row = mysqli_fetch_array($resultName)) {
                        # code...
                        $firstName[$counter] = $row['first_name'];
                        $middleName[$counter] = $row['middle_name'];
                        $lastName[$counter] = $row['last_name'];
                    }
                }

                $counter++;
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
<style type="text/css">
.none{
    display: none;
}
.inline{
    display: inline;
}
</style>
<body>
<div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php include 'topbar.php';?>
        <div class="row">
            <?php include 'navigation.php';?>
            <div class="col-sm-9 table table-dark" style="margin-top:70px;margin-left: 16.7%;">
                <?php
                if($loanApplicationNumberId == "" and $approvedApplication == "$approvedApplication"){
                    echo "<p" . "align=" . "center;>" . "List of Loan Application" . "</p>";
                    echo "<table>
                    <tr>
                        <th>ID Number</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Loan Application Number</th>
                        <th>Loan Service ID</th>
                        <th>Loan Amount</th>
                        <th>Loan Term</th>
                    </tr>";
                    
                    $counterh = 0;
                    while($counterh < $numRow) {
                            echo "<tr>";
                                echo "<td>" . $idNumber[$counterh] . "</td>";
                                echo "<td>" . $firstName[$counterh] . "</td>";
                                echo "<td>" . $middleName[$counterh] . "</td>";
                                echo "<td>" . $lastName[$counterh] . "</td>";
                                echo "<td> <button type =" . "submit" . " " ."value=". $loanApplicationNumber[$counterh] . " " . "name=" . "myButton". ">"  . $loanApplicationNumber[$counterh] . " </button> </td>"; 
                                echo "<td>" . $loanServiceId[$counterh] . "</td>";
                                echo "<td>" . $loanAmount[$counterh] . "</td>";
                                echo "<td>" . $loanTerm[$counterh] . "</td>";
                            echo "</tr>";
                        $counterh ++;
                    }
                }
                ?>
            </div>
        </div>
        <div class="<?php echo $displayProperty;?>">
            <div class="col-sm-10" style="margin-top:70px;margin-left: 16.7%;">  
                    <div class="row">
                        <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                            <h5>Account Information</h5>
                            <div class="form-group">
                                <label class="col-md-6 control-label">ID Number</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $idNumberA;?>" name = "idNumberA" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-6 control-label">Account Number</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $accountNumberA;?>" readonly>
                                </div>  
                            </div>

                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="First Name" value = "<?php echo $firstNameA;?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Middle Name" value = "<?php echo $middleNameA;?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Last Name" value = "<?php echo $lastNameA;?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                            <h5>Loan Application</h5>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Loan Application Code</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanApplicationNumberA;?>" name = "loanApplicationNumberA" placeholder="Loan Application Number" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Loan Amount</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanAmountA;?>" name = "loanAmountA" placeholder="Loan Amount" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Loan Interest</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanInterestA;?>" name = "loanInterestA" placeholder="Loan Interest" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Loan Term</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanTermA;?>" name = "loanTermA" placeholder="Loan Term" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" align="center">
                        <button class="btn btn-outline-success my-2 my-sm-0" name = "approvedApplication" value = "approvedApplication" type="submit" style="align-self: center;">APPROVE</button>
                    </div>
                    <div class="form-group" align="center">
                        <button class="btn btn-outline-success my-2 my-sm-0" name = "deniedApplication" value = "deniedApplication" type="submit" style="align-self: center;"> &nbsp&nbspDENY&nbsp&nbsp&nbsp </button>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 table table-dark" style="margin-top:50px;margin-left: 35px">
                            <?php
                            if($typeInterestA == "Diminishing"){ 
                                $loanInterestA = $loanInterestA/100;
                                $numberator = $loanAmountA*$loanInterestA;
                                $denominator = 1-pow((1+$loanInterestA),-$loanTermA);
                                $monthlyAmortization = $numberator / $denominator;

                                $OSBalance = $loanAmountA;
                                $totalPrincipal = 0;
                                $totalInterest = 0;
                                $actualInterest = 0;

                                $monthlyAmortization = round($monthlyAmortization,2,PHP_ROUND_HALF_ODD);
                                $interestPayment = $loanAmountA * $loanInterestA;

                                $paymentTerm;
                                if ($paymentTermA == "Daily") {
                                    $loanTermA = $loanTermA * 30;
                                    $paymentTerm = 30;
                                }elseif ($paymentTermA == "Semi Monthly") {
                                    $loanTermA = $loanTermA * 2;
                                    $paymentTerm = 2;
                                }
                                elseif ($paymentTermA == "Monthly") {
                                    $loanTermA = $loanTermA * 1;  
                                    $paymentTerm = 1;
                                }

                                $monthlyAmortization = $monthlyAmortization / $paymentTerm;
                                $monthlyAmortization = round($monthlyAmortization,2,PHP_ROUND_HALF_ODD);

                                $interestPayment = $interestPayment / $paymentTerm;
                                $interestPayment =  round($interestPayment,2,PHP_ROUND_HALF_ODD);

                                echo "<table>
                                <tr>  
                                    <th>Monthly Amortization</th>
                                    <th>Principal Payment</th>
                                    <th>Interest Payment</th>
                                    <th>O/S Balance</th>
                                </tr>";

                                //echo "$paymentTerm";  
                                
                                $counterh = 0;
                                while($counterh < $loanTermA) {
                                    $totalInterest = $totalInterest + $interestPayment;

                                    $principalPayment = round($monthlyAmortization - $interestPayment,2,PHP_ROUND_HALF_ODD);
                                    $OSBalance = $OSBalance - $principalPayment;
                                    $OSBalanceTemp = round($OSBalance,2,PHP_ROUND_HALF_ODD);

                                    echo "<tr>";
                                        echo "<td>" . $monthlyAmortization . "</td>";
                                        echo "<td>" . $principalPayment . "</td>";
                                        echo "<td>" . $interestPayment . "</td>";
                                        echo "<td>" . $OSBalanceTemp. " </button> </td>";
                                    echo "</tr>";

                                    $counterh ++;
                                    $interestPayment = round($OSBalanceTemp * $loanInterestA,2,PHP_ROUND_HALF_ODD);
                                    $interestPayment = $interestPayment / $paymentTerm;
                                    $interestPayment = round($interestPayment,2,PHP_ROUND_HALF_ODD);
                                    $OSBalance = round($OSBalanceTemp,2,PHP_ROUND_HALF_ODD);

                                    $totalPrincipal = $totalPrincipal + $principalPayment;
                                }
                                if($totalInterest != 0 or $totalPrincipal !=0){
                                    $actualInterest = round(($totalInterest/$totalPrincipal) * 100);
                                }

                                $monthlyAmortization = $monthlyAmortization * $loanTermA;
                                 echo "<tr>";
                                    echo "<td>" . $monthlyAmortization . "</td>";
                                    echo "<td>" . $totalPrincipal . "</td>";
                                    echo "<td>" . $totalInterest . "</td>";
                                    echo "<td>" . ""  . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="<?php if($typeInterestA == "Diminishing"){echo "inline";}else{echo "none";}?>">
                        <h5>Loan Summary</h5>
                        <label class="col-md-6 control-label">Amortization</label>
                        <div class="form-group">
                            <div class="col-md-10">
                                <?php $monthlyAmortization = $monthlyAmortization / $loanTermA; ?>
                                <input type="text" class="form-control" value = "<?php echo $monthlyAmortization;?>" readonly>
                            </div>
                        </div>
                        <label class="col-md-6 control-label">Actual Interest</label>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" class="form-control"  value = "<?php echo $actualInterest;?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="<?php if($typeInterestA == "Flat"){echo "inline";}else{echo "none";}?>">
                        <h5>Loan Summary</h5>
                        <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
                            <label class="col-md-6 control-label">Loan Amount</label>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value = "<?php echo $loanAmountA;?>" readonly>
                                </div>
                            </div>
                            <label class="col-md-6 control-label">Interest</label>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control"  value = "<?php echo $loanInterestA;?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </form>
</div>
</body>
<?php include "css1.html" ?>
</html>