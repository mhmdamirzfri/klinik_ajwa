<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Klinik Ajwa</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

<?php
// Include your database connection
include("header.php"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array(); // Initialize an error array

    // Check for a First Name
    if (empty($_POST['FirstName_P'])) {
        $error[] = 'You forgot to enter your first name.';
    } else {
        $n = mysqli_real_escape_string($connect, trim($_POST['FirstName_P']));
    }

    // Check for a Last Name
    if (empty($_POST['LastName_P'])) {
        $error[] = 'You forgot to enter your last name.';
    } else {
        $l = mysqli_real_escape_string($connect, trim($_POST['LastName_P']));
    }

    // Check for an Insurance Number
    if (empty($_POST['InsuranceNumber'])) {
        $error[] = 'You forgot to enter your Insurance Number.';
    } else {
        $i = mysqli_real_escape_string($connect, trim($_POST['InsuranceNumber']));
    }

    // Check for a Diagnose
    if (empty($_POST['Diagnose'])) {
        $error[] = 'You forgot to enter your diagnose.';
    } else {
        $d = mysqli_real_escape_string($connect, trim($_POST['Diagnose']));
    }

    // If no errors, proceed with database insertion
    if (empty($error)) {
        // Prepare the SQL query
        $q = "INSERT INTO pesakit (FirstName_P, LastName_P, InsuranceNumber, Diagnose) 
              VALUES ('$n', '$l', '$i', '$d')";

        $result = mysqli_query($connect, $q); // Run the query

        if ($result) { // If the query runs successfully
            echo '<h1>Thank you! Record has been inserted.</h1>';
            exit();
        } else { // If the query fails, display a generic error message
            echo '<h1>System error. Please try again later.</h1>';
        }

        mysqli_close($connect); // Close the database connection.
        exit();
    } else {
        // Display a generic error message if there are any input errors
        echo '<h1>Error! Please check your input and try again.</h1>';
    }
}
?>




<h2>Register</h2>
<h4>* required field </h4>
<form action="register.php" method="post">

    <p><label class="label" for="FirstName_P"> First Name: *</label>
        <input id="FirstName_P" type="text" name="FirstName_P" size="30" maxlength="150"
            value="<?php if (isset($_POST['FirstName_P'])) echo $_POST['FirstName_P']; ?>" />
    </p>

    <p><label class="label" for="LastName_P"> Last Name: *</label>
        <input id="LastName_P" type="text" name="LastName_P" size="30" maxlength="60"
            value="<?php if (isset($_POST['LastName_P'])) echo $_POST['LastName_P']; ?>" />
    </p>

    <p><label class="label" for="InsuranceNumber"> Insurance Number: *</label>
        <input id="InsuranceNumber" type="text" name="InsuranceNumber" size="12" maxlength="12"
            value="<?php if (isset($_POST['InsuranceNumber'])) echo $_POST['InsuranceNumber']; ?>" />
    </p>

    <p><label class="label" for="Diagnose"> Diagnose: </label></p>
    <textarea name="Diagnose" rows="5" cols="40"><?php if (isset($_POST['Diagnose'])) echo $_POST['Diagnose']; ?></textarea>

    <p><input id="submit" type="submit" name="submit" value="Register" />&nbsp;&nbsp;
        <input id="reset" type="reset" name="reset" value="Clear All" />
    </p>
</form>

<p>
    <br />
    <br />
    <br />
</p>

</body>

</html>
