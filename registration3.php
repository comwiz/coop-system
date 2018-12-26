<div class="row">
    <!--other info-->
    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px;">
        <h5>Other Information</h5>
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Birth Place" value = "<?php echo $birthPlace;?>" name = "birthPlace">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="date" class="form-control" placeholder="Birth Date" value = "<?php echo $birthDate;?>" name = "birthDate">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="number" class="form-control" placeholder="Tin No." value = "<?php echo $tinNumber;?>" name = "tinNumber">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="number" class="form-control" placeholder="SSS No." value = "<?php echo $sssNumber;?>" name = "sssNumber">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Religion" value = "<?php echo $religion;?>" name = "religion">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <select class="form-control" value = "<?php echo $educationalAttainment;?>" name = "educationalAttainment">
                        <option>Educational attainment</option>
                        <option>College</option>
                        <option>Undergraduate</option>
                        <option>Secondary</option>
                        <option>Primary</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Occupation" value = "<?php echo $occupation;?>" name = "occupation">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="number" class="form-control" placeholder="BR Number" value = "<?php echo $brNumber;?>" name = "brNumber">
                </div>
            </div>
            <p class="text-muted font-13 m-b-15 m-t-20">Gender</p>
            <div class="radio" style="display: inline-block;">
                <input type="radio" id="male" value="$gender" name="radioInline" checked="">
                <label for="inlineRadio1"> Male </label>
            </div>
            <div class="radio" style="display: inline-block;">
                <input type="radio" id="female" value="$gender" name="radioInline" checked="">
                <label for="inlineRadio2"> Female </label>
            </div>
             <p class="text-muted font-13 m-b-15 m-t-20">Civil Status</p>
            <div class="radio" style="display: inline-block;">
                <input type="radio" id="male" value="civilStatus" name="radioInline" checked="">
                <label for="inlineRadio1"> Single </label>
            </div>
            <div class="radio" style="display: inline-block;">
                <input type="radio" id="female" value="civilStatus" name="radioInline" checked="">
                <label for="inlineRadio2"> Married </label>
            </div>
        </form>
    </div>
    <div class="col-lg-5" style="background-color:#fff; padding: 10px; margin: 10px">
        <!--member contact info-->
        <h5>Contact Information</h5>
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <div class="col-md-10">
                    <input type="number" class="form-control" placeholder="Mobile Number" value = "<?php echo $mobileNumber;?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Email Address" value = "<?php echo $emailAddress;?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Emergency Contact Name" value = "<?php echo $emergencyContactName;?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="number" class="form-control" placeholder="Emergency Contact Number" value = "<?php echo $emergencyContactNumber;?>">
                </div>
            </div>
        </form>
        <!--member status info-->
        <h5>Member Status</h5>
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <div class="col-md-10">
                    <select class="form-control">
                        <option>Membership Origin</option>
                        <option>Refferal</option>
                        <option>Walk-in</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <form class="form-inline">

                </form>
            </div>
            <div class="col-sm-10">
                  <form class="form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input class="form-control mr-sm-2" type="search" name="identifier" value = "<?php echo $referalIdNumber;?>">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                  </form>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="First Name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Middle Name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <select class="form-control" value = "<?php echo $membershipStatus;?>">
                        <option>Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>

<div>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="align-self: center;">Submit</button>
</div>