<div class="row">

    <!--member account info-->
    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
        <h5>Account Information</h5>
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-md-6 control-label">ID Number</label>
                <div class="col-md-10">
                    <input type="number" class="form-control" value = "<?php echo $idNumber;?>" readonly="" name = "idNumber">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-6 control-label">Account Number</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value = "<?php echo $accountNumber;?>" readonly="" name = "idNumber">
                </div>  
            </div>
        </form>
    </div>

    <!--member address info-->
    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
        <h5>Account Information</h5>
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="presentAddress" placeholder="Present Address" value = "<?php echo $presentAddress;?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="permanentAddress" placeholder="Permanent Address" value = "<?php echo $permanentAddress;?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" value="provincialAddress" placeholder="Provincial Address" value = "<?php echo $provincialAddress;?>">
                </div>
            </div>
        </form>
    </div>
    
</div>
<div class="row">
    <!--member personal info-->
    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
        <h5>Personal Information</h5>
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="First Name" value = "<?php echo $firstName;?>" name = "firstName">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Middle Name" value = "<?php echo $middleName;?>" name = "middleName">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Last Name" value = "<?php echo $lastName;?>" name = "lastName">
                </div>
            </div>
        </form>
    </div>
