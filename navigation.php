<div class="col-sm-2 fixed-top" style="margin-top: 70px;position: fixed ;">
	<!-- Left Pane (Navigation) -->

		<!-- User Account Info 
		<div>
			<div class="text-center" >
				<img src="../../../public/icons/user.png " style="width: 60px; height: 60px">
				<h6>User Name</h6>
				<a href=""><i class="fa fa-lock-open"></i></a>
				<a href=""><i class="fa fa-suitcase"></i></a>
				<div>
					<span> &nbsp </span>
					<span> &nbsp </span>
				</div>
			</div>
		</div>-->
		<!-- Navigation -->
		<div>
			<li class="list-unstyled text-muted menu-title">NAVIGATION</li>
			</a></li>

			<!--<div id = "dashboard" class="collapse">
	            <ol class="list-unstyled">
	              <li class="active"><a href="">Dashboard 1</a></li>
	              <li class="active"><a href="">Dashboard 2</a></li>
	            </ol>
            </div>-->
            <div>
				<li class="list-unstyled text-muted menu-title">MEMBER REGISTRATION</li>
	            <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/plain_view.php">New Member</a></li>
	            <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/update_member_info.php">Update Member Info</a></li>
	            <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/listMembers.php">List of Members</a></li>
            </div>

            <?php 
            if ($userAccess == "Manager" or $userAccess == "Developer" or $userAccess == "Bookkeeper" or $userAccess == "Posting officer"){ $displayPropertyUA = "inline"; }else{$displayPropertyUA = "none"; }
            ?>

            <div>
				<li class="list-unstyled text-muted menu-title">LEDGER</li>
	            <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/view_member_info_temp.php">Member Ledger</a></li>
	            <li style="display: <?php echo $displayPropertyUA;?>" class="list-unstyled active"><a href="http://system.local/MWMMPC/home/view_member_info_temp.php">Account Ledger</a></li>
            </div>

            <li class="list-unstyled text-muted menu-title">TRANSACTION</li>
            <div>
	            <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/loanPayment.php">Cash Registry</a></li>

	            <li style="display: <?php echo $displayPropertyUA;?>" class="list-unstyled active"><a href="http://system.local/MWMMPC/home/offsetTransaction.php">Offset</a></li><br>

	            <li style="display: <?php echo $displayPropertyUA;?>" class="list-unstyled active"><a href="http://system.local/MWMMPC/home/expensesTransaction.php">Account Transaction</a></li>
            </div>

            <li class="list-unstyled text-muted menu-title">LOAN SERVICE</li>
            <div>
	            <!--<li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/loanService.php">Loan Services</a></li>
	          	<li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/loanServiceEntry.php">New Service</a></li>
	          	<li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/updateLoanServiceEntry.php">Update Service</a></li>-->
	            <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/loanServiceApplication.php">Loan Application</a></li>
	            <!--<li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/loanServiceApplicationTemp.php">Previous Loan (Flat)</a></li>
	            <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/loanServiceApplication_temp.php">Previous Loan (Diminishing)</a></li>
	            <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/loanServiceListTransaction.php">Approve Loan</a></li>-->
	            <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/listLoanRelease.php">Release Loan</a></li>
            </div>

			<li class="list-unstyled text-muted menu-title">REPORTS</li>
			<div id = "loanservice">
				<li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/memberShareCapitalReport.php">Share Capital</a></li>
				<li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/memberSavingsReport.php">Deposit</a></li>
				<li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/loanBalance.php">Loan Balance</a></li>
				<li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/loanAging.php">Loan Aging</a></li>
                <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/loanRelease.php">Loan Release</a></li>
                <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/riceLoanRevenueReport.php">Rice Trading</a></li>
                <!--
                <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/otherIncomeCR.php">Other Income Cash Register</a></li>
                <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/riceCashRevenueReport.php">Trading Cash Register</a></li>-->
                <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/cashierDailyReport.php">Cash Register</a></li>
                <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/creditOperationReport.php">Disbursement</a></li>
                <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/creditOperationReport.php">Journal Entry</a></li>
                <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/creditOperationReport.php">Trial Balance</a></li>
            </div>

            <li style="display: <?php echo $displayPropertyUA;?>" class="list-unstyled text-muted menu-title">MANAGEMENT</li>
			<div style="display: <?php echo $displayPropertyUA;?>" id = "loanservice">
				<li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/view_member_info.php">Account Management</li>
                <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/generateSOP.php">Statement of Operation</a></li>
                <li class="list-unstyled active"><a href="http://system.local/MWMMPC/home/generateSFC.php">Statement of Financial Condition</a></li>
            </div>


		</div>
</div>