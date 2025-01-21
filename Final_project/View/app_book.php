

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
    <h3>Book Appointment Form</h3>
    <form method="post" action="../controller/appointment_book.php" enctype="multipart/form-data" id="appointmentForm">
      <table>
            <tr>
                <th>Full Name:</th>
                <td><input type="text" id="name" name="name" required></td>
            </tr>
            <tr>
                <th>Date of Birth:</th>
                <td><input type="date" id="dob" name="dob" required></td>
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
                <th>Address:</th>
                <td><input type="text" id="address" name="address" required>
            </tr>
            <tr>
                <th>
                Appointment Time:
                </th>
                <td>
                <select id="appointment_time" name="appointment_time">
                    <option value="Monday_9_00_11_00">Monday (9:00-11:00)</option>
                    <option value="Monday_11_00_1_00">Monday (11:00-1:00)</option>
                    <option value="Tuesday_9_00_11_00">Tuesday (9:00-11:00)</option>
                    <option value="Tuesday_11_00_1_00">Tuesday (11:00-1:00)</option>
                </select>
                </td>
            </tr>
            <tr>
            <th>
                 Available Instructors:
            </th>
            <td>
            <select id="instructor" name="instructor">
                <option value="Rifat">Rifat Khan</option>
                <option value="Mahim">Mahim Mazumder</option>
            </select>
            </td>
            </tr>
            <tr>
                <th> Course Type:</th>
                <td>
                <select id="coursetype" name="coursetype">
                    <option value="basic">Basic Driving</option>
                    <option value="advance">Advance Driving</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th> Location:</th>
                <td>
            <select id="location" name="location">
                    <option value="Dhaka">Dhaka</option>
                    <option value="Chattogram">Chattogram</option>
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
                    <button type="submit">Submit</button>
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
        <script>
 
  document.getElementById('appointmentForm').addEventListener('submit', function (e) {
    e.preventDefault(); 

    if (!validateForm()) return;

    let name = document.getElementById('name').value.trim();
    let dob = document.getElementById('dob').value;
    let gender = document.querySelector('input[name="gender"]:checked');
    let phone = document.getElementById('phone').value.trim();
    let email = document.getElementById('email').value.trim();
    let address = document.getElementById('address').value.trim();
    let appointment_time = document.getElementById('appointment_time').value;
    let instructor = document.getElementById('instructor').value;
    let coursetype = document.getElementById('coursetype').value;
    let location = document.getElementById('location').value;
    let nid = document.getElementById('nid').value.trim();

    const data = {
        name,
        dob,
        gender: gender ? gender.value : '',
        phone,
        email,
        address,
        appointment_time,
        instructor,
        coursetype,
        location,
        nid
    };

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/appointment_book.php', true);
    xhttp.setRequestHeader('Content-Type', 'application/json');
    xhttp.send(JSON.stringify(data));

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            if (response.success) {
                alert("Appointment booked successfully!");
                document.getElementById('appointmentForm').reset();
            } else {
                alert("Failed to book appointment: " + response.error);
            }
        }
    };
  });

  function validateForm() {
    let name = document.getElementById('name').value.trim();
    let dob = document.getElementById('dob').value;
    let gender = document.querySelector('input[name="gender"]:checked');
    let phone = document.getElementById('phone').value.trim();
    let email = document.getElementById('email').value.trim();
    let address = document.getElementById('address').value.trim();
    let appointment_time = document.getElementById('appointment_time').value;
    let instructor = document.getElementById('instructor').value;
    let coursetype = document.getElementById('coursetype').value;
    let location = document.getElementById('location').value;
    let nid = document.getElementById('nid').value.trim();

    if (name === '' || dob === '' || !gender || phone === '' || email === '' || address === '' || 
        appointment_time === '' || instructor === '' || coursetype === '' || location === '' || nid === '') {
        alert("All fields are required!");
        return false;
    }

    if (!/^[0-9]{10}$/.test(phone)) {
        alert("Please enter a valid 10-digit phone number.");
        return false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    return true;
  }
</script>
</body>
</html>