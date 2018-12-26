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