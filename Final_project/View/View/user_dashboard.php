<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BrtaHome</title>
    <style>
       
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  height: 100vh;
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
  position: absolute; 
  top: 9px; 
  left: 90px; 
}
#brtalogo img {
  width: 60px; 
  height: auto; 
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
 
.buttons {
  position: absolute;
  background-color: mistyrose;
  height: 610px;
  width: 300px;
  display: flex;
  flex-direction: column; 
  gap: 40px; 
  align-items: center;
  top: 125px;
  border-radius: 5px;
  border: 4px solid;
  border-color: rgb(234, 180, 174);
}
 
.buttons button {
  position: relative;
  top: 80px;
  background-color: #4caf50; 
  color: white; 
  border: none; 
  padding: 10px 20px; 
  text-align: center; 
  text-decoration: none; 
  display: block; 
  font-size: 16px; 
  cursor: pointer; 
  border-radius: 5px; 
  border: 3px solid;
  border-color: #066f22;
  transition: background-color 0.3s ease, transform 0.2s ease; 
  width: 200px; 
}
 
.buttons button:hover {
  background-color: #45a049;
  transform: scale(1.05); 
}
 
.buttons button:active {
  background-color: #3e8e41; 
  transform: scale(1); 
}
 
.buttons a {
  text-decoration: none;
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
    right:800px;
    
}

 </style>

  </head>
  <body>
    <header>
      <h1>BRTA Service Portal</h1>
    </header>
    <div id="brtalogo"><img src="../uploads/BRTA_Logo.png" /></div>
    <div id="welcome"><h2>Welcome to BRTA Service Portal!</h2></div>
 
    <div class="navbar">
      <div id="profile">
        <img src="../uploads/profile.png" />
      </div>
      <div id="home"><img src="../uploads/home.png" /></div>
      <div id="logout">
        <a href="../View/logout.php"><img src="../uploads/logout.png" height='50' width='50'/></a>
      </div>
    </div>
    <div class="buttons">
    <a href="../View/Apply_license.php"><button>Apply for License</button></a></button>
    <a href="../View/road_permit.php"><button>Apply for Road Permit</button></a></button>
    <a href="../View/app_book.php"><button>Book Appointment</button></a></button>
    <a href="../View/report_acc.php"><button>Report Accident</button></a></button>
    </div>
  </body>
</html>
 