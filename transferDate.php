<?php
	require_once 'session.php';
	//Date Released
	/*$sqlP = "SELECT * FROM  bl_loan_table";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    # code...
                    $monthDate = $rowLD['date_released'];
                    
                    $sql = "UPDATE bl_loan_table SET
				    date_released = '$monthDate'
				    WHERE loan_application_number = '$loanApplicationNumber' ";

				    if ($conn->query($sql) === TRUE) {
				        $infomessage = "Record updated successfully";
				         //echo "$infomessage";
				     } 

				    else { 
				        echo "Error: " . $sql . "<br>" . $conn->error;
				    }
                }
            }
        }
    }

    $sqlP = "SELECT * FROM  ckl_loan_table";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    # code...
                    $monthDate = $rowLD['date_released'];
                    
                    $sql = "UPDATE ckl_loan_table SET
				    date_released = '$monthDate'
				    WHERE loan_application_number = '$loanApplicationNumber' ";

				    if ($conn->query($sql) === TRUE) {
				        $infomessage = "Record updated successfully";
				         //echo "$infomessage";
				     } 

				    else { 
				        echo "Error: " . $sql . "<br>" . $conn->error;
				    }
                }
            }
        }
    }


    $sqlP = "SELECT * FROM  cl_loan_table";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    # code...
                    $monthDate = $rowLD['date_released'];
                    
                    $sql = "UPDATE cl_loan_table SET
				    date_released = '$monthDate'
				    WHERE loan_application_number = '$loanApplicationNumber' ";

				    if ($conn->query($sql) === TRUE) {
				        $infomessage = "Record updated successfully";
				         //echo "$infomessage";
				     } 

				    else { 
				        echo "Error: " . $sql . "<br>" . $conn->error;
				    }
                }
            }
        }
    }

    
    $sqlP = "SELECT * FROM  edl_loan_table";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    # code...
                    $monthDate = $rowLD['date_released'];
                    
                    $sql = "UPDATE edl_loan_table SET
				    date_released = '$monthDate'
				    WHERE loan_application_number = '$loanApplicationNumber' ";

				    if ($conn->query($sql) === TRUE) {
				        $infomessage = "Record updated successfully";
				         //echo "$infomessage";
				     } 

				    else { 
				        echo "Error: " . $sql . "<br>" . $conn->error;
				    }
                }
            }
        }
    }

    
    $sqlP = "SELECT * FROM  cml_loan_table";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    # code...
                    $monthDate = $rowLD['date_released'];
                    
                    $sql = "UPDATE cml_loan_table SET
				    date_released = '$monthDate'
				    WHERE loan_application_number = '$loanApplicationNumber' ";

				    if ($conn->query($sql) === TRUE) {
				        $infomessage = "Record updated successfully";
				         //echo "$infomessage";
				     } 

				    else { 
				        echo "Error: " . $sql . "<br>" . $conn->error;
				    }
                }
            }
        }
    }

    $sqlP = "SELECT * FROM  eml_loan_table";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    # code...
                    $monthDate = $rowLD['date_released'];
                    
                    $sql = "UPDATE eml_loan_table SET
				    date_released = '$monthDate'
				    WHERE loan_application_number = '$loanApplicationNumber' ";

				    if ($conn->query($sql) === TRUE) {
				        $infomessage = "Record updated successfully";
				         //echo "$infomessage";
				     } 

				    else { 
				        echo "Error: " . $sql . "<br>" . $conn->error;
				    }
                }
            }
        }
    }

    
    $sqlP = "SELECT * FROM  pl_loan_table";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    # code...
                    $monthDate = $rowLD['date_released'];
                    
                    $sql = "UPDATE pl_loan_table SET
				    date_released = '$monthDate'
				    WHERE loan_application_number = '$loanApplicationNumber' ";

				    if ($conn->query($sql) === TRUE) {
				        $infomessage = "Record updated successfully";
				         //echo "$infomessage";
				     } 

				    else { 
				        echo "Error: " . $sql . "<br>" . $conn->error;
				    }
                }
            }
        }
    }


    $sqlP = "SELECT * FROM  rice_loan_table";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    # code...
                    $monthDate = $rowLD['date_released'];
                    
                    $sql = "UPDATE rice_loan_table SET
				    date_released = '$monthDate'
				    WHERE loan_application_number = '$loanApplicationNumber' ";

				    if ($conn->query($sql) === TRUE) {
				        $infomessage = "Record updated successfully";
				         //echo "$infomessage";
				     } 

				    else { 
				        echo "Error: " . $sql . "<br>" . $conn->error;
				    }
                }
            }
        }
    }	

    

    $sqlP = "SELECT * FROM  rl_loan_table";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    # code...
                    $monthDate = $rowLD['date_released'];
                    
                    $sql = "UPDATE rl_loan_table SET
				    date_released = '$monthDate'
				    WHERE loan_application_number = '$loanApplicationNumber' ";

				    if ($conn->query($sql) === TRUE) {
				        $infomessage = "Record updated successfully";
				         //echo "$infomessage";
				     } 

				    else { 
				        echo "Error: " . $sql . "<br>" . $conn->error;
				    }
                }
            }
        }
    }

    
    $sqlP = "SELECT * FROM  sl_loan_table";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  loan_date_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    # code...
                    $monthDate = $rowLD['date_released'];
                    
                    $sql = "UPDATE sl_loan_table SET
				    date_released = '$monthDate'
				    WHERE loan_application_number = '$loanApplicationNumber' ";

				    if ($conn->query($sql) === TRUE) {
				        $infomessage = "Record updated successfully";
				         //echo "$infomessage";
				     } 

				    else { 
				        echo "Error: " . $sql . "<br>" . $conn->error;
				    }
                }
            }
        }
    }*/


    //Date Paid
    /*$sqlP = "SELECT * FROM  bl_loan_table WHERE loan_status = 'Paid' ";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  bl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    # code...
                    $monthDate = $rowLD['date_payment'];
                    
                    $sql = "UPDATE bl_loan_table SET
				    date_paid = '$monthDate'
				    WHERE loan_application_number = '$loanApplicationNumber' ";

				    if ($conn->query($sql) === TRUE) {
				        $infomessage = "Record updated successfully";
				         //echo "$infomessage";
				     } 

				    else { 
				        echo "Error: " . $sql . "<br>" . $conn->error;
				    }
                }
            }
        }
    }*/

    /*$sql = "UPDATE rice_loan_table SET
    invoice_number = '1000'
    WHERE invoice_number = 'BBRCL' ";

    if ($conn->query($sql) === TRUE) {
        $infomessage = "Record updated successfully";
         //echo "$infomessage";
     } 

    else { 
        echo "Error: " . $sql . "<br>" . $conn->error;
    }*/

    /*
    $sql = "UPDATE bl_loan_table SET
    reloan_p = '',
    reloan_i = '' ";

    if ($conn->query($sql) === TRUE) {
        $infomessage = "Record updated successfully";
    } 

    else { 
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $paymentI = 0;
    $totalPaymentI = 0;
    $totalPaymentP = 0;
    $paymentP = 0;

    $reference = "";

    //Transfer Reloan
    //BL
    $sqlP = "SELECT * FROM  bl_loan_table WHERE loan_status = 'Paid' ";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  bl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    # code...
                    
                    $reference = $rowLD['reference_number'];

                    if(substr($reference, 0,2) == "RL" or substr($reference, 0,2) == "BL" or substr($reference, 0,3) == "EDL" or substr($reference, 0,3) == "CML"){

                        $paymentI = $rowLD['interest_revenue'];
                        $totalPaymentI = $totalPaymentI + $paymentI;

                        $sqlD = "SELECT * FROM  bl_loan_payment_table WHERE reference_number = '$reference' ";
                        $resultD = $conn->query($sqlD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultD->num_rows > 0){
                            while ($rowD = mysqli_fetch_array($resultD)) {
                                # code...
                                $paymentP = $rowD['amount'];
                                $totalPaymentP = $totalPaymentP + $paymentP;
                            }
                        }

                        echo "$loanApplicationNumber ";
                        echo "$totalPaymentP ";
                        echo "$totalPaymentI /n";

                    }
                }
            }


            $sql = "UPDATE bl_loan_table SET
            reloan_p = '$totalPaymentP',
            reloan_i = '$totalPaymentI'
            WHERE loan_application_number = '$loanApplicationNumber' ";

            if ($conn->query($sql) === TRUE) {
                $infomessage = "Record updated successfully";
                 echo "$infomessage";

                $paymentI = 0;
                $totalPaymentI = 0;
                $totalPaymentP = 0;
                $paymentP = 0;

                $reference = "";
            } 

            else { 
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $sql = "UPDATE edl_loan_table SET
    reloan_p = '',
    reloan_i = '' ";

    if ($conn->query($sql) === TRUE) {
        $infomessage = "Record updated successfully";
         //echo "$infomessage";
    } 

    else { 
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sqlP = "SELECT * FROM  edl_loan_table WHERE loan_status = 'Paid' ";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  bl_credit_revenue_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    # code...
                    
                    $reference = $rowLD['reference_number'];

                    if(substr($reference, 0,2) == "RL" or substr($reference, 0,2) == "BL" or substr($reference, 0,3) == "EDL" or substr($reference, 0,3) == "CML"){

                        $paymentI = $rowLD['interest_revenue'];
                        $totalPaymentI = $totalPaymentI + $paymentI;

                        $sqlD = "SELECT * FROM  bl_loan_payment_table WHERE reference_number = '$reference' ";
                        $resultD = $conn->query($sqlD);
                        //$numRow = mysqli_num_rows($resultName);

                        if($resultD->num_rows > 0){
                            while ($rowD = mysqli_fetch_array($resultD)) {
                                # code...
                                $paymentP = $rowD['amount'];
                                $totalPaymentP = $totalPaymentP + $paymentP;
                            }
                        }

                        echo "$loanApplicationNumber ";
                        echo "$totalPaymentP ";
                        echo "$totalPaymentI /n";

                    }
                }
            }


            $sql = "UPDATE bl_loan_table SET
            reloan_p = '$totalPaymentP',
            reloan_i = '$totalPaymentI'
            WHERE loan_application_number = '$loanApplicationNumber' ";

            if ($conn->query($sql) === TRUE) {
                $infomessage = "Record updated successfully";
                 echo "$infomessage";

                $paymentI = 0;
                $totalPaymentI = 0;
                $totalPaymentP = 0;
                $paymentP = 0;

                $reference = "";
            } 

            else { 
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }*/

     

    //Transfer last payment
    /*
    $sqlP = "SELECT * FROM  sl_loan_table WHERE loan_status = 'Paid' or  loan_status = 'Released'";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);
    $dateTransaction = "";

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  sl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    $dateTransaction = $rowLD['date_payment'];
                }
            }


            $sql = "UPDATE sl_loan_table SET
            last_payment = '$dateTransaction'
            WHERE loan_application_number = '$loanApplicationNumber' ";

            if ($conn->query($sql) === TRUE) {
                $infomessage = "Record updated successfully";
                $dateTransaction = "";
                echo "$infomessage";
            } 

            else { 
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }*/


    //Transfer ONE TIME PAYMENT
    /*
    $sqlP = "SELECT * FROM  sl_loan_table WHERE loan_status = 'Released' ";
    $resultP = $conn->query($sqlP);
    $numRow = mysqli_num_rows($resultP);
    $dateTransaction = "";

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];

            $sqlLD = "SELECT * FROM  sl_loan_payment_table WHERE loan_application_number = '$loanApplicationNumber' ";
            $resultLD = $conn->query($sqlLD);
            //$numRow = mysqli_num_rows($resultName);

            if($resultLD->num_rows > 0){
                while ($rowLD = mysqli_fetch_array($resultLD)) {
                    $dateTransaction = $rowLD['date_payment'];
                }
            }


            $sql = "UPDATE sl_loan_table SET
            last_payment = '$dateTransaction'
            WHERE loan_application_number = '$loanApplicationNumber' ";

            if ($conn->query($sql) === TRUE) {
                $infomessage = "Record updated successfully";
                $dateTransaction = "";
                echo "$infomessage";
            } 

            else { 
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }*/

    //DELETE RICE LOAN AND PAYMENT OF JUNE AND JULY

    //$dateLimit = '2018-07-31' ;

   
    $sqlP = "SELECT * FROM  rice_loan_table WHERE invoice_number = '16985' ";
    $resultP = $conn->query($sqlP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            $loanApplicationNumber = $row['loan_application_number'];
            $loanStatus = $row['loan_status'];
            $date = $row['date_released'];
            $id = $row['id_number'];
            echo "$loanApplicationNumber";
            echo "$loanStatus";
            echo "$id";
            echo "$date";

            echo " ";
        }
    }

    $sqlP = "SELECT * FROM  rice_cash_revenue_table WHERE invoice_number = '16985' ";
    $resultP = $conn->query($sqlP);

    if($resultP->num_rows > 0){
        while ($row = mysqli_fetch_array($resultP)) {
            //$loanApplicationNumber = $row['loan_application_number'];
            //$loanStatus = $row['loan_status'];
            //$date = $row['date_released'];
            //$id = $row['id_number'];
            //echo "$loanApplicationNumber";
            //echo "$loanStatus";
            //echo "$id";
            //echo "$date";

            echo "hi";
        }
    }


?>

