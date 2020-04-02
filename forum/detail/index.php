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


?>

<html>
<head>
<title>My app</title>
<link rel="stylesheet" href="/css/style.css"/>
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
echo "<h1> Forum</h1>";

?>
<!-- Posts title -->


<?php
if(isset($_GET['id'])){
$id = $_GET['id'];

$post = "SELECT * FROM posts WHERE id='$id'";

$post_result = mysqli_query($con, $post);

while($row = mysqli_fetch_assoc($post_result)){



?>

<h5><?php  echo $row['post_title'];  ?></h5>
<img src= "../forum/pics/<?php echo $row['image']; ?>" height="200px"  width="200px"/>
<p><?php echo $row['post']; ?></p>
<?php }} ?>

</section>
<section>
<h3>Related Posts</h3>
</section>
</body>
</html>

