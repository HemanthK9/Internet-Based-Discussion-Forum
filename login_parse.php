<?php
session_start();
include_once("connect.php");
if(isset($_POST['username'])){
$username=$_POST['username'];
$password=$_POST['password'];
$sqli="SELECT * FROM users WHERE username='$username' AND password='$password' ";
$res=mysqli_query($con,$sqli) or die(mysqli_error($con));
if(mysqli_num_rows($res)==1){
$row=mysqli_fetch_assoc($res);
$_SESSION['uid']=$row['id'];
$_SESSION['username']=$row['username'];
header("Location: index1.php");
exit();
} else{
echo "Invalid login info.Please return to previous page";
exit();
}
}

?>