<?php
session_start();

if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
} 



$con = new mysqli("localhost", "root", "", "test");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}



if(isset($_POST['submit'])) {
$name = $_POST['fname'];
$uname = $_POST['uname'];
$email = $_POST['email'];
$pass = $_POST['password'];
	
$sql = "INSERT INTO users(name, username, email, password) VALUES('$name', '$uname', '$email', '$pass')";

$result = mysqli_query($con, $sql);

if ($result == true){
header("Location: /account");
$_SESSION['user'] = 'user';
$_SESSION['profile'] = $uname;
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
<?php  else: ?>
<a href="/login">Login</a>
<a href="/signup">Signup</a>
<?php endif; ?>
</nav>
</header>


<section>


<article>

<form method="POST" action="#">
<?php

echo "<h1>Signup</h1>";

?>
<input type="text" placeholder="Full Name" name="fname" required/><br>
<input type="text" placeholder="username" name="uname" required/><br>
<input type="email" placeholder="Email" name="email"/ required><br>
<input type="password" placeholder="Password" name="password" required/><br>
<input type="submit" value="Sign Up" name="submit"/>
<p>Already have a account? </p>
<a href="/login">Login</a>


</form>


</article>





</section>





</body>
</html>
