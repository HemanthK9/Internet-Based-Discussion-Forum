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
$sqli="select * from categories order by category_title asc";
$res=mysqli_query($con,$sqli) or die(mysqli_error($con));
$categories="";
if(mysqli_num_rows($res)>0){
while($row=mysqli_fetch_assoc($res)){
$id=$row['id'];
$title=$row['category_title'];
$description=$row['category_description'];
$categories .= "<a href='view_category.php?cid=".$id."' class= 'cat_links' >" .$title." - <font size='-1'>".$description."</font></a>";
}
echo $categories;
} else{
echo "<p>There are no categories available yet.</p>";
}
?>
</div>
</div>
</body>
</html>