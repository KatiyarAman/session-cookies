  <?php
    session_start();
	if(isset($_SESSION['sessionid']))
	{
	 header('location:afterlogin.php');
	 die('parameter');
	}
  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>registration</title>
</head>

<body>
  <center>
    <form action="" method="post" id="Frmlogin">
	
     <tr><td>EMAIL</td><td>
	 <input type="text" name="useremail" placeholder="Enter Your Email" value="<?php if(isset($_COOKIE['member_login'])){echo $_COOKIE['member_login'];} ?>"></td></tr>
	 <tr><td>PASSWORD</td><td>
	 <input type="password" name="userpassword" placeholder="Enter Your Password" 
	 value="<?php if(isset($_COOKIE['member_password'])) {echo $_COOKIE['member_password'];}?>"></td></tr>
	 <tr><td></td><td><input type="submit" value="login" name="submit">
	                 <input type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
                            <label for="remember-me">Remember me</label>
                             
	    </td>
	 </tr>
    </form>
  </center>
</body>
</html>
 <?php
    include('dbcon.php');
	if(isset($_POST['submit']))
	 {
	    
	   $qry="SELECT `userid` FROM `registration` WHERE `username`='".$_POST['useremail']."' AND `userpassword`='".$_POST['userpassword']."'";
	   echo"".$qry;
	   $run=mysqli_query($con,$qry);
	   $row=mysqli_fetch_array($run);
	   $uid=$row['userid'];
	   $_SESSION['sessionid']=$uid;
	   if($_SESSION['sessionid'] != NULL)
	   {
	       if(!isset($_POST['remeber']))
		      {
			    setcookie("member_login",$_POST['useremail'],time()+ (10 * 365 * 24 * 60 * 60));
				setcookie("member_password",$_POST['userpassword'],time()+ (10 * 365 * 24 * 60 * 60));
			  }
			   else
			   {
			     if(isset($_COOKIE['member_login']))
				 {
				 
				   setcookie($_COOKIE['member_login']);
				 }
				 if(isset($_COOKIE['member_password']))
				 {
				   setcookie($_COOKIE['member_password']);
				 }
			   }
	      header('location:afterlogin.php');
	   }
	    else
		{
		 echo"Invalid Credential";
		}
	 }
 ?>