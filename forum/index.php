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


if(isset($_POST['post'])) {
$target = "pics/". basename($_FILES['image']['name']);	
$title = $_POST['post_title'];
$file = $_FILES['image']['name'];
$post = $_POST['write_post'];	

$post_writer = "INSERT INTO posts(post_title, image, post) VALUES('$title', '$file', '$post')";	

$post_rs = mysqli_query($con, $post_writer);

if($post_rs==true) {
header("Location: /forum");
move_uploaded_file($_FILES['image']['tmp_name'], $target);
}
}


?>

<html>
<head>
<title>My app</title>
</head>
<body>
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


<?php
echo "<h1> Forum</h1>";

?>

<?php if(isset($_SESSION['user'])): ?>
<form method="POST" action="#" enctype="multipart/form-data">
<input type="text" name="post_title" placeholder="Post Title"/><br>
<input type="file" name="image"/><br>
<textarea rows="5" cols="28" placeholder="Write your problems.." name="write_post"></textarea><br>
<input type="submit" value="Post" name="post"/>
</form>
<?php endif;  ?>

<!-- Posts title -->
<h3>Top Posts</h3>

<?php

$post = "SELECT * FROM posts ORDER BY id DESC";

$post_result = mysqli_query($con, $post);

while($row = mysqli_fetch_assoc($post_result)){



?>

<a href="forum/detail?id=<?php echo $row['id']; ?>"><h5><?php  echo $row['post_title'];  ?></h5></a>
<img src= "forum/pics/<?php echo $row['image']; ?>" height="100px"  width="100px"/>

<?php } ?>

</body>
</html>
