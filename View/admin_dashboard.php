<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("location: ../View/admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
<style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: white;
}
header {
  background-color: #066f22;
 
  color: white;
  padding: 40px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;
}
header h1 {
  font-family: "Times New Roman", Times, serif;
  font-size: xx-large;
  margin: 0;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
}
#brtalogo {
  position: absolute; /* Allows precise positioning */
  top: 9px; /* Distance from the top edge of the page */
  left: 90px; /* Distance from the left edge of the page */
}
#brtalogo img {
  width: 60px; /* Set the desired logo width */
  height: auto; /* Maintain aspect ratio */
}
 
.navbar {
  background-color: coral;
  height: 45px;
}
#logout {
  position: absolute;
  top: 80px;
  right: 50px;
}
 
#logout img {
  height: 40px;
 
  width: 40px;
}
#logout img:hover {
  height: 42px;
 
  width: 42px;
}
.navbar {
  background-color: coral;
  height: 45px;
}
  #home {
  position: absolute;
  top: 85px;
  right: 180px;
}
#home img:hover {
  height: 40px;
 
  width: 40px;
}
#home img {
  height: 35px;
 
  width: 35px;
}
#profile {
  position: absolute;
  top: 85px;
  right: 120px;
}
#profile img:hover {
  height: 40px;
 
  width: 40px;
}
#profile img {
  height: 35px;
 
  width: 35;
}
#welcome{
    position:absolute;
    top:170px;
    right:700px;
    
}
.buttons {
  position: absolute;
  background-color: mistyrose;
  height: 610px;
  width: 300px;
  display: flex;
  flex-direction: column; /* Stack buttons vertically */
  gap: 40px; /* Space between buttons */
  align-items: center; /* Center-align the buttons horizontally */
 
  top: 125px;
  border-radius: 5px;
  border: 4px solid;
  border-color: rgb(234, 180, 174);
}
 
.buttons button {
  position: relative;
  top: 80px;
  background-color: #4caf50; /* Green background */
  color: white; /* White text */
  border: none; /* No border */
  padding: 10px 20px; /* Spacing inside button */
  text-align: center; /* Center the text */
  text-decoration: none; /* Remove underline if it's a link */
  display: block; /* Ensure buttons take up full width */
  font-size: 16px; /* Text size */
  cursor: pointer; /* Pointer cursor on hover */
  border-radius: 5px; /* Rounded corners */
  border: 3px solid;
  border-color: #066f22;
  transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth hover effect */
  width: 200px; /* Set a fixed width for buttons */
}
 
.buttons button:hover {
  background-color: #45a049; /* Darker green on hover */
  transform: scale(1.05); /* Slight zoom effect */
}
 
.buttons button:active {
  background-color: #3e8e41; /* Even darker green on click */
  transform: scale(1); /* Reset zoom */
}
 
.buttons a {
  text-decoration: none;
}
 
</style>
</head>
<body>
    <header>
      <h1>BRTA Managemnet Portal</h1>
    </header>
    <div id="brtalogo"><img src="../uploads/BRTA_Logo.png" /></div>
    <div class="navbar">
    <div id="welcome"><h2>Welcome to BRTA Management Portal!</h2></div>
      <div id="profile">
        <img src="../uploads/profile.png" />
      </div>
      <div id="home">
      <a href="../View/admin_dashboard.php"><img src="../uploads/home.png" /></div>
      <div id="logout">
        <a href="../View/admin_logout.php"><img src="../uploads/logout.png" ></a>
      </div>
    </div>
    <div class="buttons">
    <a href="../Model/view_license_appliers.php"><button>License Appliers</button></a></button>
    <a href="../Model/view_permit.php"><button>Road Permit Appliers</button></a></button>
    <a href="../Model/approve_appointment.php"><button>Appointment Requests</button></a></button>
    </div>

</body> 
</html>
