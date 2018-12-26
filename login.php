<?php

session_start();

$userName = "";
$userPassword = "";

$submitLogin = "";
$countErr = "";

include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  if (empty($_POST["userName"])) {
    $countErr++;
  }else {
    $userName = test_input($_POST["userName"]);
  }

  if (empty($_POST["userPassword"])) {
    $countErr++;
  }else {
    $userPassword = test_input($_POST["userPassword"]);
  }

  if (empty($_POST["submitLogin"])) {
    $countErr++;
  }else {
    $submitLogin = test_input($_POST["submitLogin"]);
  }

  if($submitLogin == "submitLogin"){
    $sqlSearchName = "SELECT * FROM user_account_table WHERE user_name = '$userName' and user_password ='$userPassword' ";
    $resultSearchName = $conn->query($sqlSearchName);

    if($resultSearchName->num_rows > 0){
      while ($row = mysqli_fetch_array($resultSearchName)) {
          # code...
          $_SESSION["userName"] = $row['user_name'];
          $_SESSION["userPassword"] = $row['user_password'];
          $_SESSION["idSession"] = "";
      }
      header('Location: http://system.local/MWMMPC/home/plain_view.php');
    }
    else
      echo "Invalid Credentials";
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
  <title>Login</title>
</head>

<body>
  <div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

      <div class="row">

        <div class="col-lg-4" style="background-color:#fff; padding: 10px; margin: 10px">
        </div>

        <div class="col-lg-4" style="background-color:#fff; padding: 10px; margin: 10px">
                <div class="form-group" align="center">
                    <div class="col-md-12">
                      <img src="public/icons/user.png" alt="USER" height="42" width="42" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="User Name" value = "<?php echo $userName;?>" name = "userName">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10">
                        <input type="Password" class="form-control" placeholder="User Password" value = "<?php echo $userPassword;?>" name = "userPassword">
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-sm-10">
                      <button class="btn btn-outline-success my-2 my-sm-0" id = "search" name = "submitLogin" value = "submitLogin" type="submit">Login</button>
                    </div>
                  </div>
        </div>

        <div class="col-lg-4" style="background-color:#fff; padding: 10px; margin: 10px">
        </div>

      </div>

    </form>
  </div>
</body>
<?php include "css1.html" ?>

<?php include 'footer.php';?>