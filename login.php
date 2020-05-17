
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
$signinError="";
require "database.php";
if (isset($_POST["login"])) {
      $user=R::findOne('users','username=?',array($_POST['signinusername']));
      if($user){
        if(password_verify($_POST['signinpassword'],$user->password)){
            $_SESSION['User_info']=$user;
            header("Location:sessionstart.php ");
        }
      }
      else {
        $signinError="Make sure all fields are filled in correctly";
      }
}


?>


<h2><br>SIGN IN</h2>
<div id="form">
  <form method="post" action="login.php">  
  <span><b>Username:</b></span> <input class="input" type="text" name="signinusername">
  <span><b>Password:</b></span> <input class="input" type="password" name="signinpassword">
  <span class="error"><b><?php echo $signinError; ?></b> </span>
  <input type="submit" name="login" value="Login" class="button">  
  <br>
  <input type="button" value="Registration" class="button" onClick="document.location.href='registracion.php'">
  </form>
</div>

</body>
</html>