
<!DOCTYPE HTML>  
<html>
<head>
<style>
  .error {color: #FF0000;}
  h2 {
    background-color: #00ace6;
    margin: 0px;
    height: 100px;
    color: white;
    text-align: center; 
    font-size:30px;
    font-family: Monospace, fantasy;  
  }
  body {
    background-color: #99ccff;
    margin: 0px;
    }
  span {
    display: block;
    padding: 5px;
    font-family: "Tangerine", serif;
  }
  #form {
    text-align: center;
    display: block;
    margin: 0px;
  }
  .button {
    height: 30px;
    width: 100px;
  }
  .input {
    width:250px;
    height:20px;
  }
</style>
</head>
<body>  
<?php
$usernameErr = $emailErr = $firstnameErr = $lastnameErr = $passwordErr = $passwordrepeatErr ="";
$username = $email = $firstname = $lastname = $password = $passwordrepeat = "";
$erru=0; $err = 0; $nice =0;
require "database.php";
if (isset($_POST["submit"])) {
  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
  } else {
    $username = $_POST["username"];
    $lowcase = strtolower($username);
    if ($username != $lowcase){
      $usernameErr = $usernameErr . " Small letters only. ";
      $erru++;
    }
    if (strlen($username)<5 || strlen($username)>10) {
      $usernameErr = $usernameErr . " Min 5 and Max 10 Characters";
      $erru++;
    } 
    if ($erru == 0) $nice++; 
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = $_POST["email"];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
      $nice++;
    }
    else $emailErr ="$email is not valid email";
  }
    
  if (empty($_POST["firstname"])) {
    $firstnameErr = "First name is required";
  } else {
    $firstname = $_POST["firstname"];
    $nice++;
  }

  if (empty($_POST["lastname"])) {
    $lastnameErr = "Last name is required";
  } else {
    $lastname = $_POST["lastname"];
    $nice++;;
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = $_POST["password"];
    if (strlen($password)<8 || strlen($password)>16){
      $passwordErr = $passwordErr . " Min 8 and Max 16 Characters.";
      $err++;
    }
    if (!preg_match("#[a-z]+#", $password)) {
      $passwordErr = $passwordErr . " You need alphabet and number symbols";
      $err++;
    }
      elseif( !preg_match("#[0-9]+#", $password)){
        $passwordErr = $passwordErr . " You need alphabet and number symbols";
        $err++;
      }
    if ($err == 0) $nice++;
  }

  if (empty($_POST["passwordrepeat"])) {
    $passwordrepeatErr = "Password repeat is required";
  } else {
    $passwordrepeat = $_POST["passwordrepeat"];
    if ($passwordrepeat != $password) {
      $passwordrepeatErr = "Password repeat is wrong";
    }
      else $nice++;
  }
  if ($nice==6){
      $user=R::dispense('users');
      $user->username=$_POST['username'];
      $user->firstname=$_POST['firstname'];
      $user->lastname=$_POST['lastname'];
      $user->email=$_POST['email'];
      $user->password=password_hash($_POST['password'],PASSWORD_DEFAULT);
      R::store($user);
      echo "Successfully registered";
      header('Location:login.php');
  }

}
?>
<h2><br>Registration</h2>
<div id="form">
  <form method="post" action="registracion.php">  
    <span><b>Username:</b></span> <input class="input" type="text" name="username">
    <span class="error"><b><?php echo $usernameErr;?></b></span>
    <span><b>E-mail:</b></span> <input class="input" type="text" name="email">
    <span class="error"><b><?php echo $emailErr;?></b></span>
    <span><b>First name:</b></span> <input class="input" type="text" name="firstname">
    <span class="error"><b><?php echo $firstnameErr;?></b></span>
    <span><b>Last name:</b></span> <input class="input" type="text" name="lastname">
    <span class="error"><b><?php echo $lastnameErr;?></b></span>
    <span><b>Password:</b></span> <input class="input" type="password" name="password">
    <span class="error"><b><?php echo $passwordErr;?></b></span>
    <span><b>Password repeat:</b></span> <input class="input" type="password" name="passwordrepeat">
    <span class="error"><b><?php echo $passwordrepeatErr;?></b></span>
    <input type="submit" name="submit" value="Registration" class="button">  
    <input type="button" value="Sign in" class="button" onClick="document.location.href='login.php'"> 
  </form>
</div>

</body>
</html>