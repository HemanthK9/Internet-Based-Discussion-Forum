<?php
session_start();
if($_SESSION['uid']){
if(isset($_POST['reply_submit'])){
include_once("connect.php");
$creator=$_SESSION['uid'];
$cid=$_POST['cid'];
$tid=$_POST['tid'];
$reply_content=$_POST['reply_content'];
$sqli="insert into posts(category_id,topic_id,post_creator,post_content,post_date) values ('".$cid."','".$tid."','".$creator."','"$reply_content"',now())";
$res=mysqli_query($con,$sqli) or die(mysqli_error($con));
$sqli2="update categories set last_post_date=now(), last_user_posted='".$creator."' where id='".cid."' limit 1";
$res2=mysqli_query($con,$sqli2) or die(mysqli_error($con));

$sqli3="update topics set topic_reply_date=now(), topic_last_user='".$creator."' where id='".cid."' limit 1";
$res3=mysqli_query($con,$sqli3) or die(mysqli_error($con));

//Email Sending
if(($res) && ($res2) && ($res3)){
echo "<p>Your reply has been successfully posted.<a href='view_topic.php?cid=".$cid."&tid=".$tid."'>Click here to return to the topic.</a></p>";
} else{
echo "<p>There was a problem posting your reply. Try again later.</p>";
}
} else{
exit();
}
} else{
exit();
}
?>