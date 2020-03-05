<?php session_start(); ?>
<?php
if((!isset($_SESSION['uid']))||($_GET['cid'] == "")){
header("Location: index1.php");
exit();
}
$cid=$_GET['cid'];

?>
<html>
<head>
<title>Create forum topic</title>
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
<form action="create_topic_parse.php" method="post">
<p>Topic Title</p>
<input type="text" name="topic_title" size="75" maxlength="150" />
<p>Topic Content</p>
<textarea name="topic_content" rows="5" cols="75"></textarea>
<br /><br />
<input type="hidden" name="cid" value="<?php echo $cid; ?>"/>
<input type="submit" name="topic_submit" value="Create Your Topic" />
</form>
</div>
</div>
</body>
</html>