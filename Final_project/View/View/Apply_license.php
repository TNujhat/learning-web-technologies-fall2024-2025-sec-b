


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="random.css" />
    <title>Apply Page</title>
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
    <div id="brtalogo"><img src="../uploads/BRTA_Logo.png" /></div>
    <div class="navbar">
    <div id="apply">
  <fieldset>
    <h3>Driving License Application Form</h3>
    <form action="../View/Apply_license2.php" method="POST">
      <table>
            <tr>
                <th>Full Name:</th>
                <td><input type="text" id="name" name="name" required></td>
            </tr>
            <tr>
                <th>Father's Name:</th>
                <td><input type="text" id="fname" name="fname" required></td>
            </tr>
            <tr>
                <th>Date of Birth:</th>
                <td><input type="date" id="dob" name="dob" required></td>
            </tr>
            <tr>
                <th><label for="phone">Phone:</label></th>
                <td>
                  <input type="tel" id="phone" name="phone" required pattern="[0-9]{10}" 
                    title="Enter a valid 10-digit phone number" required
                  >
                </td>
              </tr>
              
            <tr>
                <th>Email:</th>
                <td><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <th>
                   Blood Group:
                </th>
                <td>
                  <select name="bloodgroup">
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                  </select>
                </td>
              </tr>
            <tr>
                <th>Address:</th>
                <td><input type="text" id="address" name="address" required>
            </tr>
            <tr>
                <th>Gender:</th>
                <td>
                    <label for="gender_male"><input type="radio" id="gender_male" name="gender" value="male" required> Male</label>
                    <label for="gender_female"><input type="radio" id="gender_female" name="gender" value="female"> Female</label>
                    <label for="gender_other"><input type="radio" id="gender_other" name="gender" value="other"> Other</label>
                </td>
            </tr>
            <tr>
                <th> License Type:</th>
                <td>
                  <select name="licensetype">
                    <option value="professional">Professional</option>
                    <option value="nonprofessional">Nonprofessional</option>
                  </select>
                </td>
              </tr>
            <tr>
                <th>NID:</th>
                <td><input type="text" id="nid" name="nid" required>
            </tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr>
                    <td>
                        <button type="reset">Clear</button>
                    </td>
                    <td></td>
                    <td>
                        <a href="../View/Apply_license2.php">
                            <button type="submit">Next</button>
                        </a>
                    </td>
                </tr>
                
        </table>
    </form>
</fieldset>
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
</html>
