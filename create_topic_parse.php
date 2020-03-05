<?php
session_start();
if($_SESSION['uid'] == ""){
header("Location: index1.php");
exit();
}
if(isset($_POST['topic_submit'])){
if(($_POST['topic_title']=="") && ($_POST['topic_content']=="")){
echo "You did not fll in both fields.Please return to the previous page.";
exit();
} else{
include_once("connect.php");
$cid=$_POST['cid'];
$title=$_POST['topic_title'];
$content=$_POST['topic_content'];
$creator=$_SESSION['uid'];
$sqli="insert into topics (category_id,topic_title,topic_creator,topic_date,topic_reply_date) values('".$cid."','".$title."','".$creator."',now(),now())";
$res=mysqli_query($con,$sqli) or die(mysqli_error($con));
$new_topic_id=mysqli_insert_id();
$sqli2="insert into posts(category_id,topic_id,post_creator,post_content,post_date) values('".$cid."','".$new_topic_id."','".$creator."','".$content."',now())";
$res2=mysqli_query($con,$sqli2) or die(mysqli_error($con));
$sqli3="update categories set last_post_date=now(),last_user_posted='".$creator."' where id='".$cid."' limit 1";
$res3=mysqli_query($con,$sqli3) or die(mysqli_error($con));
if(($res) && ($res2) && ($res3)){
header("Location:view_topic.php?cid=".$cid."&tid=".$new_topic_id);
} else{
echo "There was a problem creating your topic . Please try again.";
}
}
}
?>