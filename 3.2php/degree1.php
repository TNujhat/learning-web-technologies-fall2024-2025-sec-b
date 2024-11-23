<?php
if(isset($_POST['submit']))
{
    if(isset($_POST['Degree']))
    {
        $degree=$_POST['Degree'];
        if(count($degree)<2)
        {
            echo "Invalid Degree: At least two selections are required.";
        }
        else
        {
            echo "Valid Degree" ;
        }
    }
    else
    {
        echo "Invalid Degree: No selection made.";
    }
}
?>