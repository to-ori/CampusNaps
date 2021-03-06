
<?php
// connect to the database
include("conn.php");

// creates edit record form

function renderForm($id = '', $question ='', $name="", $email="", $category="", $notes="", $error = '')
{
	?>
<!DOCTYPE html>
<html>

<head>

<title>Useful Links</title>
<link rel="stylesheet" type= "text/css" href="mystyle01.css"/>
<script>
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
<title>
<?php if ($id != '') { echo "Edit Record"; }  ?>
</title>


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
				<li><a href="contact.php">Contact Information</a></li>
				<br>
				<br>
				<li><a href="offers.html">Special Offers</a></li>
				<br>
				<br>
				<li><a href="links.html">Useful Links</a></li>
				<br>
				<br>
				<li><a  class="active" href="adminAccessContact.php">Admin: Contact</a></li>
				<br>
				<br>
				<li><a  href="adminAccessProduct.php">Admin: Products</a></li>
				<br>
				<br>
				</ul>
				</div>
				<!-----------Content-------------->
				<div class="content">
			<h1><center>Comments</center></h1>


<h1><?php if ($id != '') { echo "Edit Record"; }  ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>

<form action="" method="post">
<div>
<?php if ($id != '') { ?>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<p>ID: <?php echo $id; ?></p>
<?php } ?>
<p>Question: <?php echo $question; ?></p>
<p>Name: <?php echo $name; ?></p>
<p>Email: <?php echo $email; ?></p>
<p>Category: <?php echo $category; ?></p>
<strong>Notes: *</strong> <input type="text" name="notes"
value="<?php echo $notes; ?>"/><br/>

<input type="submit" name="submit" value="Submit" />
</div>
</form>
</body>
</html>

<?php }



/*

EDIT RECORD

*/
// if the 'id' variable is set in the URL, we know that we need to edit a record
if (isset($_GET['id']))
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// make sure the 'id' in the URL is valid
if (is_numeric($_POST['id']))
{
// get variables from the URL/form
$id = $_POST['id'];
$notes = htmlentities($_POST['notes'], ENT_QUOTES);


// check that firstname and lastname are both not empty
if ($id == '' || $notes == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($id, $question, $name, $email, $category, $notes, $error);
}
else
{
// if everything is fine, update the record in the database
if ($stmt = $conn->prepare("UPDATE comments SET notes = ? WHERE id=?"))
{
$stmt->bind_param("si", $notes, $id);
$stmt->execute();
$stmt->close();
}
// show an error message if the query has an error
else
{
echo "ERROR: could not prepare SQL statement.";
}

// redirect the user once the form is updated
header("Location: showContactUs.php");
}
}
// if the 'id' variable is not valid, show an error message
else
{
echo "Error!";
}
}
// if the form hasn't been submitted yet, get the info from the database and show the form
else
{
// make sure the 'id' value is valid
if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
// get 'id' from URL
$id = $_GET['id'];

// get the recod from the database
if($stmt = $conn->prepare("SELECT * FROM comments WHERE id=?"))
{
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->bind_result($id, $question, $name, $email, $category, $notes);
$stmt->fetch();

// show the form
renderForm($id, $question, $name, $email, $category, $notes, null);

$stmt->close();
}
// show an error if the query has an error
else
{
echo "Error: could not prepare SQL statement";
}
}
// if the 'id' value is not valid, redirect the user back to the showContactUs.php page
else
{
header("Location: showContactUs.php");
}
}
}



// close the conn connection
$conn->close();
?>
</div>
			<!----------Footer----------------->
			<div class="footer">
				<br><br>CampusNaps&copy; Is a fictional company created as a learning aid for CT870.
				All rights reserved. The content and opinions found on this site do not relfect those of NUIG. 
			
		</div>
		</div>
</table>

</body>

</html>