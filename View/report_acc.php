

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Page</title>
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
#apply {
    position: absolute;
    top: 135px;
    right: 525px;
  }

  #apply fieldset {
    width: 90%; /* Increase width of the fieldset */
    background-color:rgb(247, 224, 182); /* Light background color */
    border: 2px solidrgb(117, 52, 171); /* Border color */
    padding: 20px; /* Padding inside the fieldset */
    border-radius: 8px; /* Rounded corners */
  }

  #apply table {
    width: 100%; /* Make table take full width */
    margin: auto; 
    text-align: left;
    border-collapse: collapse;
  }

  #apply th {
    text-align: left;
    padding: 8px;
  }

  #apply td {
    padding: 5px;
  }

  #apply h3 {
    text-align: center;
    color:rgb(122, 38, 217);/* Header color */
  }

  #apply button {
    background-color:rgb(122, 38, 217); /* Button color */
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 5px;
  }

  #apply button:hover {
    background-color:rgb(168, 73, 232); /* Darker button color on hover */
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
</style>

<body>
<header>
    <h1>BRTA Service Portal</h1>
</header>
<div id="brtalogo"><img src="../uploads/BRTA_Logo.png" alt="BRTA Logo" /></div>
<div class="navbar">
 <div id="apply">
    <fieldset>
        <h3>Accident Report Form</h3>
        <form action="../Controller/accident_process.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <th>Date and Time of Accident:</th>
                    <td>
                    <input type="datetime-local" id="accident_date_time" name="accident_date_time">
                    </td>
                </tr>
                <tr>
                    <th>Location:</th>
                    <td>
                    <input type="text" id="location" name="location" placeholder="Enter accident location" required>
                    </td>
                </tr>
                 <tr>
                     <th>Vehicle Number:</th>
                    <td>
                    <input type="text" id="vehicle_number" name="vehicle_number" placeholder="Enter vehicle number" required>
                    </td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td>
                    <textarea id="description" name="description" rows="4" placeholder="Describe the accident" required></textarea>
                    </td>
                </tr>
                <tr>
                     <th>Upload Photos:</th>
                     <td>
                    <input type="file" id="photos" name="photos[]" accept="image/*" multiple>
                    </td>
                </tr>
                <tr>
                     <th>Contact Number:</th>
                    <td>
                  <input type="tel" id="contact" name="contact" pattern="[0-9]{10}" 
                  title="Enter a valid 10-digit phone number" placeholder="Enter your phone number" required>
                   </td>
                </tr>
                <tr>
                    <td>
                    <button type="reset">Clear</button>
                    </td>
                    <td>
                    <button type="submit">Submit Report</button>
                    </td>
                </tr>
                    </table>
                </form>
            </fieldset>
        </div>
    </div>
    <div id="profile">
        <img src="../uploads/profile.png" />
      </div>
      <div id="home"> <a href="../View/user_dashboard.php"><img src="../uploads/home.png" /></div>
      <div id="logout">
        <a href="../View/logout.php"><img src="../uploads/logout.png"></a>
      </div>
    </div>
</body>

</body>
</html>