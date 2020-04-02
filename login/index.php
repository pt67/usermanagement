<?php
error_reporting();
ini_set('display_errors', E_ALL);

session_start();

if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
} 


$con = new mysqli("localhost", "root", "", "test");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$message = ""; // Message is when user is wrong or not.
if(isset($_POST['submit'])) {
$uname = mysqli_real_escape_string($con, $_POST['uname']);
$pass = mysqli_real_escape_string($con, $_POST['password']);
	
$sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass'";
$result = mysqli_query($con, $sql);
$row = mysqli_num_rows($result);

if ($row == 1){
header("Location: /account");
$_SESSION['user'] = 'user';
$_SESSION['profile'] = $uname;
}else{
$message = "Wrong Username or Password.";
}
}


?>

<html>
<head>
<title>My app</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
<div class="logo">

<?php echo "<h1>Colin</h1>"; ?>
</div>

<nav>
<a href="/">Home</a>
<a href="/forum">Forum</a>
<?php  if(isset($_SESSION['user'])): ?>
<a href="/account">My account</a>
<a href="/logout">Log out</a>
<?php  else: unset($_SESSION['user']) ?>
<a href="/login">Login</a>
<a href="/signup">Signup</a>
<?php endif; ?>
</nav>

</header>


<section>
<article>



<form method="POST" action="#">
<?php

echo "<h1>Login</h1>";

?>
<p style="color:red;"><?php  echo $message; ?></p>
<input type="text" placeholder="username" name="uname" required/><br>
<input type="password" placeholder="Password" name="password" required/><br>
<input type="submit" value="Sign In" name="submit"/>
<p>New user?</p>
<a href="/signup">SignUp</a>
</form>

</article>

</section>
</body>
</html>
