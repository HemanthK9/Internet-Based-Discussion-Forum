<?php session_start(); ?>
<html>
<head>
<title>Untitled document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="wrapper">
<h1>Internet Based Discussion Forum | IBDF</h1>
<p>Login Page</p>
<?php
if(!isset($_SESSION['uid'])){
echo "<form action='login_parse.php' method='post'>
Username: <input type='text' name='username'></input>&nbsp;
Password: <input type='text' name='password'></input>&nbsp;
<input type='submit' name='submit' value='Log In'></input>
";
} else{
echo "<p>You are logged in as ".$_SESSION['username']." &bull; <a href='logout_parse.php'>Logout</a>";
}
?>
<hr />
<div id="content">
<?php
include_once("connect.php");
$cid=$_GET['cid'];
if(isset($_SESSION['uid'])){
$logged=" | <a href='create_topic.php?cid=".$cid."'>Click here to create a topic</a>";
} else{
$logged=" | Please log in to create topics in this forum.";
}
$sqli="select id from categories where id='".$cid."' limit 1";
$res=mysqli_query($con,$sqli) or die(mysqli_error($con));
if(mysqli_num_rows($res)==1){
$sqli2="select * from topics where category_id='".$cid."' order by topic_reply_date desc";
$res2=mysqli_query($con,$sqli2) or die(mysqli_error($con));
if(mysqli_num_rows($res2)>0){
$topics = "<table width='100%' style='border-collapse: collapse;'>";
$topics .="<tr><td colspan='3'><a href='index1.php'>Return To Forum Index </a>".$logged."<hr /></td></tr>";
$topics .="<tr style='background-color: #dddddd;'><td>Topic Title</td><td width='65' align='center'>Replies</td><td width=65 align='center'>Views</td></tr>";
$topics .="<tr><td colspan='3'><hr /></td></tr>";
while($row=mysqli_fetch_assoc($res2)){
$tid =$row['id'];
$title =$row['topic_title'];
$views =$row['topic_views'];
$date =$row['topic_date'];
$creator =$row['topic_creator'];
$topics .="<tr><td><a href='view_topic.php?cid= ".$cid." &tid= ".$tid." '>".$title."</a><br /><span class='post_info'>Posted by: ".$creator." on ".$date."</span></td><td align='center'>0</td><td align='center'>".$views."</td></tr>";
$topics .="<tr><td colspan='3'><hr /></td></tr>";
}
$topics .="</table>";
echo $topics;
}else{
echo "<a href='index1.php'>Return To Forum Index</a><hr />";
echo "<p>There are no topics in this category yet.".$logged."</p>";
}
} else{
echo "<a href='index1.php'>Return To Forum Index</a><hr />";
echo "<p>You are trying to view a category that does not exist yet.</p>";
}
?>
</div>
</div>
</body>
</html>