<?php 
if (isset($_GET['submit'])) 
{
    if (isset($_GET['gender'])) 
    {  
        $gender = $_GET['gender'];
        if (strlen($gender) === 0) 
        {
            echo "Invalid Gender: Empty Field";
        } else {
            echo "Valid Gender: " . $gender;
        }
    }
    else
    {
        echo "Invalid Gender: Empty field";
    }
}
?>
