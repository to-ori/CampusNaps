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
				<li><a   href="adminAccessProduct.php">Admin: Products</a></li>
				<br>
				<br>
				</ul>
				</div>
				<!-----------Content-------------->
				<div class="content">
			<h1><center>Comments</center></h1>

<?php
// connect to the database
include('conn.php');

// get the records from the database
if ($result = $conn->query("SELECT * FROM comments ORDER BY id"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10'>";

// set table headers
echo "<tr><th>ID</th><th>Comment</th><th>Name</th><th>Email</th><th>Category</th><th>Notes</th><th></th><th></th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->question . "</td>";
echo "<td>" . $row->name . "</td>";
echo "<td>" . $row->email . "</td>";
echo "<td>" . $row->category . "</td>";
echo "<td>" . $row->notes . "</td>";
echo "<td><a href='records.php?id=" . $row->id . "'>Edit</a></td>";
echo "<td><a href='delete.php?id=" . $row->id . "'>Delete</a></td>";
echo "</tr>";
}

echo "</table>";
}
// if there are no records in the database, display an alert message
else
{
echo "No results to display!";
}
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $conn->error;
}

// close database connection
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