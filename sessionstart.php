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
  .form {
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
        require "database.php";
    ?>
    

    <h2><br>Welcome to your account</h2>
    <div class="form">
        <span>Your Username is:<?php echo $_SESSION['User_info']->username; ?></span>
        <span>Your First name is:<?php echo $_SESSION['User_info']->firstname; ?></span>
        <span>Your Last name is:<?php echo $_SESSION['User_info']->lastname; ?></span>
        <span>Your Email is:<?php echo $_SESSION['User_info']->email; ?></span>
    </div>
    <div class="form">
        <form action="UploadHelper.php" method="post" enctype="multipart/form-data">
          <span>You can upload Your profile photo<br></span>  
          <input type = "file" name = "image" >
          <input type = "submit" value = "Upload" name="submit">   
        </form>
          <?php if (!empty($_SESSION['img'])): ?>
          <img src = "<?php print $_SESSION['img']; ?>" alt = "IMG">
           <?php endif; ?>
    </div>
    <form method="POST" action="logout.php">
        <input type="submit" value="LOGOUT" name="logout">
    </form>
    
    
</body>
</html>