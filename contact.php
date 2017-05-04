<!DOCTYPE html>
<html>

	<head>

		<title>Contact Information</title>
	<link rel="stylesheet" type= "text/css" href="mystyle01.css">
	
<script type="text/javascript">
/*
		function validate(){
			if ((contactUs.userName.value=="")||(contactUs.userEmail.value=="")||(contactUs.query.value=="")){
					window.alert("Please fill in all fields");
			}else if(contactUs.userName.value.length<10){
				window.alert("Username must contain 10 or more charaters");}
			else if(contactUs.query.value.length<25){
			window.alert("You query must contain 25 or more charaters");
			}
			else if((contactUs.userEmail.value.length<10)||(contactUs.userEmail.value.indexOf("@")<=0)||(contactUs.userEmail.value.indexOf(".")<=0)){
			window.alert("Your email must have 10 or more charaters and conatin a @ and a .");
			} 
			else{
				window.alert("Thank you. Your query will be delt with as soon as possible. We will contact you through the email you provided.");
			}	
		}*/
		
		
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clock').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);//refresh ever half a second, if you wanted it to change every second change to 1000
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
		

</script>
<?php
include("conn.php");
// define variables and set to empty values
$nameErr=$emailErr=$commentErr= $topicErr = "";
$name = $email = $comment = $topic = $f="";
$emailResult="";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//check name 
		if (empty($_POST["userName"])) {
			$nameErr = "Name is required";
		} else {
				$name = test_input($_POST["userName"]);
				// check if name only contains letters and whitespace
				if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
					$nameErr = "Only letters and white space allowed"; 
				}	else if(strlen($name)<10){
					$nameErr ="Name must be atleast 10 char long";
				}
			}	
		//check email
		if (empty($_POST["userEmail"])) {
			$emailErr = "Email is required";
		} else{
			$email = test_input($_POST["userEmail"]);
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format"; 
			}else if(strlen($name)<10){
				$emailErr = "Email must be atleast 10 characters long"; 
			}
		}
			//check comment
		 if (empty($_POST["comment"])) {
			$commentErr =  "Comment is required";
		}
		else{
					$comment = test_input($_POST["comment"]);
					if(strlen($comment)<25){
					$commentErr="Comment must be atleast 25 characters long";
					}
		}
		//check topic
		if (empty($_POST["IssueOptions"])) {
			$topicErr = "You must choose a topic";
		}else{
			$topic = test_input($_POST["IssueOptions"]);
		}
	
			if($nameErr=="" && $emailErr=="" && $commentErr=="" && $topicErr== ""){
			$f = "WEBSITE COMMENT\n========================\n\n";
			$f .= "Topic: " . $_POST['IssueOptions'];
			$f .= "\nName: " . $_POST['userName'];
			$f .= "\nEmail: " . $_POST['userEmail'];
			$f .= "\nComments: " . $_POST['comment'];
			if (sendMyMail("t.hume1@nuigalway.ie", "t.hume1@nuigalway.ie", "Tori Hume", "Website comment", $f)){
			$emailResult ="Thank you! you message has been recieved. ";
			
			$name=$conn->escape_string($_POST['userName']);
			$email=$conn->escape_string($_POST['userEmail']);
			$topic=$conn->escape_string($_POST['IssueOptions']);
			$comment=$conn->escape_string($_POST['comment']);
			if ($stmt = $conn->prepare("INSERT INTO comments (question, name, email, category) VALUES (?, ?, ?, ?) ;"))
				{
				$stmt->bind_param("ssss", $comment , $name, $email, $topic);
				$stmt->execute();
				$stmt->close();
				}
			
			}
			else{
			$emailResult ="Error";
			}
	}
	}
	

function sendMyMail($fromEmail, $toEmail, $fromName, $subject, $body) {


	$headers = 'From: ' . $fromName . "\r\n" .
			'Reply-To: ' . $fromEmail . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
	return mail($toEmail, $subject, $body, $headers);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
	</head>

	<body onload="startTime()">

	
<div class="main">
<!--------------HEADER--------->
		<div class="header">
				<!------ Start of animated banner---->
		<div class="slideshow-container">

<div class="mySlides fade">
    <img src="../images/nightSky1.jpg" style="width:100%">
  </div>

<div class="mySlides fade">
   <img src="../images/nightSky2.jpg" style="width:100%">
 </div>

<div class="mySlides fade">
   <img src="../images/nightSky3.jpg" style="width:100%">
 </div>
 
 <div class="mySlides fade">
   <img src="../images/nightSky4.jpg" style="width:100%">
 </div>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
  <span class="dot" onclick="currentSlide(4)"></span> 
  <span class="dot" onclick="currentSlide(5)"></span> 
  <span class="dot" onclick="currentSlide(6)"></span> 
</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex> slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 5000); // Change image every 5 seconds
}
</script>
<!------ end of animated banner---->

		<!--Inline styling used for company name-->
		<h1  style="background-color: grey;color:white;width: 100%;text-align:center;font-size:200%;">CampusNaps</h1>
		<!----show the clock------>
		<div id="clock" style="position:relative;left:600px;top:-20px"><br></div>
		</div>
			<!--------------Navagtion bar----------->
			<div class="nav">
				<ul class="menu">
				<li><a href="index.html">Home</a></li>
				<br>
				<br>
				<li><a href="about.html">About Us</a></li>
				<br>
				<br>
				<li><a class="active" href="contact.php">Contact Information</a></li>
				<br>
				<br>
				<li><a href="offers.html">Special Offers</a></li>
				<br>
				<br>
				<li><a href="links.html">Useful Links</a></li>
				<br>
				<br>
				<li><a href="adminAccessContact.php">Admin: Contact</a></li>
				<br>
				<br>
				</ul>
				</div>
				<!-----------Content-------------->
				<div class="content">
				<h1><center> Contact Form</center></h1>
				
				<div align="left">
				<div align="center"><form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>						
					<div><span class="error">* required field.<br></span>To help us direct your query the right peole please select a topic:
						<select name="IssueOptions">
						<option value="sales">Sales</option>
						<option value="shipping">Shipping</option>
						<option value="returns">Returns</option>
						<option value="bookings">Bookings</option>
						<option value="other">Other</option>
						</select></div>
						
						<div><br>Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
						<span class="error">*<?php echo $commentErr;?></span>
						<br><br>
						<div>Please enter your contact details so we can get back to you.</p>
						<p>Name:
						<input id= "userName" type="text" value="<?php echo isset($_POST['userName']) ? $_POST['userName'] :''?>" name= "userName">
						<span class="error">* <?php echo $nameErr;?></span>
						<p>Emial Address:<input type="email" name="userEmail" value="<?php echo $email;?>"><span class="error">* <?php echo $emailErr;?></span>
						<br><input type="submit" name="submit" value="Submit"><br>
						<span class="error"> <?php echo $emailResult;?></span>
						</div>
						</div>
					</form></div>
					<br><br>
				<dl>
				<h1><center> Our Team</center></h1>
					<dt><h2> Fulfilment Executive</h2> <h3>Sara Joyce</h3> </dt>
						<dd> <h4>Phone Number</h4>	091492030</dd>
						<dd><h4>Email</h4> <a href="mailto:s.joyce@campusnaps.nuigalway.ie">s.joyce@campusnaps.nuigalway.ie</a></dd>
					<br><br>
					<dt><h2> Marketing Officer</h2> <h3>Rachel Kelly</h3> </dt>
						<dd> <h4>Phone Number</h4>	091492033</dd>
						<dd><h4>Email</h4> <a href="mailto:r.kelly@campusnaps.nuigalway.ie">r.kelly@campusnaps.nuigalway.ie</a></dd>
					<br><br>
					<dt><h2> Secretary</h2> <h3>Mark Brown</h3> </dt>
						<dd> <h4>Phone Number</h4>	091492034</dd>
						<dd><h4>Email</h4> <a href="mailto:m.brown@campusnaps.nuigalway.ie">m.brown@campusnaps.nuigalway.ie</a></dd>
					</dl>
			</div>
			
					

			</div>
			<!----------Footer----------------->
			<div class="footer">
				<br><br>CampusNaps&copy; Is a fictional company created as a learning aid for CT870.
				All rights reserved. The content and opinions found on this site do not relfect those of NUIG. 
			
		</div>
		</div>
	</body>

</html>
