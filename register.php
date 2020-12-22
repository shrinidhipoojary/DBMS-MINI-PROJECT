<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "artgallery");
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_POST['Submit'])){
$username= mysqli_real_escape_string($conn, $_REQUEST['username']);
$phone_no= mysqli_real_escape_string($conn, $_REQUEST['phone_no']);
$email_id=mysqli_real_escape_string($conn, $_REQUEST['email_id']);
$password = mysqli_real_escape_string($conn, $_REQUEST['password']);

$query = "INSERT INTO user(username,phone_no,email_id,password) VALUES('$username','$phone_no','$email_id','$password')";

if(mysqli_query($conn, $query)){
  $_SESSION['username']=$username;
  $_SESSION['phone_no']=$phone_no;
  $_SESSION['email_id']=$email_id;
    header('location:register.html');
} 

else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}
mysqli_close($conn);
}
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="register.css">
  <title>ART GALLERY</title>
  <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
   <style>
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

a{
  color: green;
  font-size: 25px;
}
</style>
</head>
<body>
<form class="login-form" method="POST" action="register.php">
      <legend class="header">
        <h3>R E G I S T E R<hr/></h3>
      </legend>
      <input type="text" placeholder="Username*" name="username" required/>
      <input type="phno" placeholder="Mobile no.*" name="phone_no" required/>
      <input type="email" placeholder="Email-id*" name="email_id" required/>
      <input type="password" placeholder="Password*" name="password" required/>
      <button class="button" type="submit" name="Submit">REGISTER</button>
      <p>Already have an account!?</p><a href="login.php">Sign in</a>
    </form>
</body>
</html>