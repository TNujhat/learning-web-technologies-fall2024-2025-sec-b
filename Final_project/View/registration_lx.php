

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="random.css" />
    <title>Registration</title>
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
  background-color:rgb(60, 26, 86);
 
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
.navbar {
  background-color: rgb(190, 164, 209);
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
    width: 90%;
    background-color:rgb(247, 224, 182); 
    border: 2px solidrgb(117, 52, 171); 
    padding: 20px; 
    border-radius: 8px; 
  }

  #apply table {
    width: 100%;
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


</style>

<body>
<header>
      <h1>Online Shop Management System</h1>
    </header>
    <div class="navbar">
    <div id="apply">
  <fieldset>
    <h3>Registration Form</h3>
    <form action="../Controller/regpro_lx.php" method="POST">
      <table>
            <tr>
                <th>Employee Name:</th>
                <td><input type="text" id="name" name="name" required></td>
            </tr>
            <tr>
                <th><label for="phone">Contact no:</label></th>
                <td>
                  <input type="tel" id="phone" name="phone" required pattern="[0-9]{10}" 
                    title="Enter a valid 10-digit phone number" required
                  >
                </td>
              </tr>
              <tr>
                <th>username:</th>
                <td><input type="text" name="username" placeholder="Enter your username" ></td>
            </tr>
            <tr>
                <th>Password:</th>
                <td><input type="password" name="password" placeholder="Enter your password" ></td>
            </tr>
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
      <div id="logout">
        <a href="../View/logout_lx.php"><img src="../uploads/logout.png"></a>
      </div>
    </div>
</body>
</html>