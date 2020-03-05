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
$tid=$_GET['tid'];
$sqli="select * from topics where category_id='".$cid."' and id='".$tid."' limit 1";
$res=mysqli_query($con,$sqli) or die(mysqli_error($con));
if(mysqli_num_rows($res)==1){
echo "<table width='100%'>";
if($_SESSION['uid']){
echo "<tr><td colspan='2'><input type='submit' value='Add Reply' onClick=\"window.location ='post_reply.php?cid=".$cid." &tid =".$tid."'\"/>";
} else{
echo "<tr><td colspan='2'><p>Please login to add your reply.</p><hr/></td></tr>";
}
while($row = mysqli_fetch_assoc($res)){
$sqli2="select * from posts where category_id='".$cid."' and topic_id='".$tid."'";
$res2=mysqli_query($con,$sqli2) or die(mysql_error($con));
while($row2=mysqli_fetch_assoc($res2)){
echo "<tr><td valign='top' style='border: 1px solid #000000;'><div style='min-height: 125px;'>".$row['topic_title']."<br /> by ".$row2['post_creator']." - ".$row2['post_date']."<hr />".$row2['post_content']."</div></td><td width='200' vailgn='top' align='center' style='border: 1px solid #000000;'>User Info Here</td></tr><tr><td colspan='2'><hr /></td></tr>";
}
}
} else{
echo "<p>This topic doesnor exist.</p>";
}
?>
</div>
</div>
</body>
</html>