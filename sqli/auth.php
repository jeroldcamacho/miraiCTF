<?php
include('conn.php');

$username = $_POST['user'];
$password = $_POST['pass'];

$sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if($count == 1){
    echo "<h1><center>miraiCTF{3aSy_l0gin_SqL_Inject10n}</center></h1>";
} else{
    echo "<h1> Login failed. Invalid username or password.</h1>";
}
?>