<?php session_start(); ?>
<?php
if((!isset($_SESSION['uid']))||($_GET['cid'] == "")){
header("Location: index1.php");
exit();
}
$cid=$_GET['cid'];
$tid=$_GET['tid'];
?>
<html>
<head>
<title>Post forum reply</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="wrapper">
<h1>Internet Based Discussion Forum | IBDF</h1>
<p>Login Page</p>
<?php
echo "<p>You are logged in as ".$_SESSION['username']." &bull; <a href='logout_parse.php'>Logout</a>";
?>
<hr />
<div id="content">
<form action="post_reply_parse.php" method="post">
<p>Reply Content</p>
<textarea name="reply_content" rows="5" cols="75"></textarea>
<br /><br />
<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
<input type="hidden" name="tid" value="<?php echo $tid; ?>" />
<input type="submit" name="reply_submit" value="Post Your Reply" />
</form>
</div>
</div>
</body>
</html>