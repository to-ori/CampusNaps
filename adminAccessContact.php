
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      <?php
		require "conn.php";
	$message="";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//check name 
			
$user_name=$conn->escape_string($_POST["username"]);
$user_pass=$conn->escape_string($_POST["password"]);
$mysql_qry="SELECT * FROM CampusNapsUser WHERE name like '$user_name' and password like '$user_pass';";
$result = mysqli_query($conn ,$mysql_qry);

if(mysqli_num_rows($result)>0) {
	$row = mysqli_fetch_assoc($result);
	$name = $row["name"];

	$message= "login Successful! Welcome back " .$name;
	header('Location: http://danu6.it.nuigalway.ie/ToriHume11486248/assignment7/showContactUs.php');
	exit;
}else {
	$message="login not successful!";
}
$conn->close();

	}
?>
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
					<label>This area is restricted, you must log in to go further</label><br /><br />
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $message ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
   
</html>