<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "artgallery");
$error=" ";
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
    
      if($count == 1) {
          $_SESSION['username']=$username;
          $_SESSION['phone_no']=$phone_no;
          $_SESSION['email_id']=$email_id;
         header('location:register.html');
      }
      else {
         $error="<div style='color:white;font-size:20px'>Invalid credentials!</div>";
      }

      $query1="SELECT * from admin where username='$username' and password='$password'";
      $result1=mysqli_query($conn,$query1);
      
    if(mysqli_num_rows($result1)==1)
    {
        $_SESSION['auth']='true';
        header('location:login.html');
    }
   }
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="login.css"/>
<title>ART GALLERY</title>
  <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
  <style>
    a{
      color: blue;
      font-size: 25px;
    }

.button {
  padding: 7px 20px;
  border: 2px solid white;
  border-radius: 5px;
  background: rgba(0, 0, 0, 0.5);
  color: white;
  width: 150px;
  font-family: 'Kaushan Script';
  letter-spacing: 0.0625em;
}

.button:hover {
  border: 0px;
  color: green;
  box-shadow: 3px 3px 8px blue;
}
</style>
</head>
<body>
  <div></div>
<form class="login-form" method="POST" action="login.php" style="height: 400px">
    <?php echo $error; ?>
      <legend class="header">
        <h3>L O G I N<hr/></h3>
      </legend>
      <input type="text" placeholder="Username*" name="username" required/>
      <input type="Password" placeholder="Password*" name="password" required/>
      <button class="button" type="submit" name="Submit">LOGIN</button>
      <p>Not registered yet!?<a href="register.php"><br>Register</a></p>
</form>
</body>
</html>