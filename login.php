   <?php
  session_start();
  if($_SESSION['sessionuid'])/* if you already  in another page (afterlogin) then this session will give you back less feel becuase you already loggedin */
  {
    header('location:admin/admindash.php');
  }
  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
  <h1 align="center"> admin login</h1>
    <form method="post" action="login.php">
	   <table align="center">
	       <tr>
		      <td>username</td>
			  <th><input type="text" name="username" ></th>
		   </tr>
		    <tr>
		      <td>password</td>
			  <th><input type="password" name="userpassword"></th>
		   </tr>
		     <tr>
			   <td>
			     <input type="submit" name="submit" value="login">
			    </td>
			 </tr>
	   </table>
	</form>
</body>
</html>
  <?php
    include('dbcon.php');
	if(isset($_POST['submit']))
	   {
	     $username=$_POST['username'];
		 $password=$_POST['userpassword'];
		   $query="SELECT * FROM `admin` WHERE  username ='$username' AND userpassword='$password'";
		    $queryy="SELECT `adminid` FROM `admin` WHERE `username`='' AND `userpassword`=''";
			  //$result=mysqli_query($con,$queryy);
			  //$roe=mysqli_fetch_array($result);
			 //  $id=$row['adminid'];
			  // print_r($id);
		   $run = mysqli_query($con,$query);
		   $row= mysqli_num_rows($run);
		   if( $row <1)
		   {
		     ?>
			   <script>
			     alert('username or password are not mathed!');
				 window.open('login.php','_self');
			   </script>
			 <?php
		   }
		     else
			 {
			   $data= mysqli_fetch_assoc($run);
			   $adminid= $data['userid'];
			   
			   echo "userid.$adminid";
			   session_start();
			   $_SESSION['sessionuid']=$adminid;/* intialization of the session using cunique column name of the table('adminid')*/   
			   header('location:admin/admindash.php');
			   
			    
			 }
	   }
  ?>
