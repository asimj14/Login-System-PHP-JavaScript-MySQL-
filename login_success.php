
<!DOCTYPE html>
<html>
<head>
	<title>logged in</title>
	<div class="header">
            <h1>Dashboard</h1>
    </div> 
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
           <link rel="stylesheet" href="css/style.css" />  


</head>
<body>
		<div class="footer">
            <h1>Muhammad Asim Javed </h1>
            <p>m.asimjaved@hotmail.com</p>
        </div> 
</body>
</html>
<?php
//login success page 

session_start();
if(isset($_SESSION["username"]))
{
	echo '<h3 align="center">Login Success, Welcome - '.$_SESSION["username"].'</h3>';
	//logout option
	echo '<div class= "right"><br /><br /><a href="logout.php" align="right"><img border="0" alt="logout" src="images/btn2.png" width="75" height="75"></a></div>';

}else{

	header("location : index.php");

}



?>