<?php  

$idNumber = "";
$loanApplicationNumber = "";
$loanType = "";
$loanAmount = "";
$loanInterest = "";
$loanTerm = "";
$loanStatus = "";

$dateApplication = "";
$dateApprovedDenied = "";
$dateReleased = "";
$datePaid = "";

$reviewedBy = "";
$approveddeniedBy = "";
$releasedBy = "";
?>

<head>
	
</head>

<body>
	<form>
		<div>
			<?php include "registration1.php";?>

			<div>
				<h5>Loan Transaction</h5>
		        <form class="form-horizontal" role="form">
		            <div class="form-group">
		                <div class="col-md-10">
		                    <input type="text" class="form-control" name = "$loanApplicationNumber" placeholder="Loan Application Number">
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-md-10">
		                    <input type="text" class="form-control" name = "$loanType" placeholder="Loan Type">
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-md-10">
		                    <input type="text" class="form-control" name = "$loanAmount" placeholder="Loan Amount">
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-md-10">
		                    <input type="text" class="form-control" name = "$loanTerm" placeholder="Loan Term">
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-md-10">
		                    <input type="date" class="form-control" name = "$dateApplication">
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-md-10">
		                    <input type="text" class="form-control" name = "$reviewedBy" placeholder="Review By">
		                </div>
		            </div>
        </form>
			</div>
		</div>
	</form>
</body>