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
<b>Users List</b>

<?php



$sql = "SELECT * FROM users";
$result = mysqli_query($con, $sql);
while($row=mysqli_fetch_assoc($result)){
?>
<ul>
<li><?php echo $row['name'];  ?></li>
</ul>
<?php } ?>
</section>



</body>
</html>
<?php
/*
CREATE TABLE users (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
username VARCHAR(50) NOT NULL,
email VARCHAR(50),
password VARCHAR(50) NOT NULL
);

insert into users(name, username, email, password) values('johan', 'johan barma', 'johan44@gmail.com', '23456');

CREATE TABLE posts(
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
post_title VARCHAR(255) NOT NULL,
image VARCHAR(255) NOT NULL,
post MEDIUMTEXT

);

insert into posts(post_title, post) values('Ratnakumar is working at home', 'People are working like a fast range of dump onion on the hot list of serilam johan. Now a days people are highly affected with corona virus recently detected 
in china. Which is found to be more deadly dangerous for people.

');


*/
?>
