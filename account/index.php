<?php
session_start();

if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
} 



$con = new mysqli("localhost", "root", "", "test");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}




?>

<html>
<head>
<title>My app</title>
<link rel="stylesheet" href="css/style.css"/>
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
<?php

echo "<h1>Account</h1>";
$data = '';
if(isset($_SESSION['profile'])) {
	global $data; 
	//echo $_SESSION['profile'];
	
	$data = $_SESSION['profile'];
}

$getdata = "SELECT * FROM users WHERE username='$data'";

$result = mysqli_query($con, $getdata);

while($row = mysqli_fetch_assoc($result)) {

?>

<ul>
<li>Name : <?php  echo $row['name']; ?> <a href="#">Edit</a></li>
<li>Email : <?php  echo $row['email']; ?></li>
</ul>
<?php } ?>
</section>
</body>
</html>
