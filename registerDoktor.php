<?php
include("header.php"); 

$connect = mysqli_connect('localhost', 'root', '', 'klinik_ajwa');
if (!$connect) {
    die('Could not connect: ' . mysqli_error($connect));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array();

    if (empty($_POST['FirstName'])) {
        $error[] = 'You forgot to enter your first name.';
    } else {
        $n = mysqli_real_escape_string($connect, trim($_POST['FirstName']));
    }

    if (empty($_POST['LastName'])) {
        $error[] = 'You forgot to enter your last name.';
    } else {
        $l = mysqli_real_escape_string($connect, trim($_POST['LastName']));
    }

    if (empty($_POST['Specialization'])) {
        $error[] = 'You forgot to enter your specialization.';
    } else {
        $s = mysqli_real_escape_string($connect, trim($_POST['Specialization']));
    }

    if (empty($_POST['Password'])) {
        $error[] = 'You forgot to enter your password.';
    } else {
        $p = mysqli_real_escape_string($connect, trim($_POST['Password']));
    }

    if (empty($error)) {
        $q = "INSERT INTO doktor (FirstName, LastName, Specialization, Password) 
              VALUES ('$n', '$l', '$s', '$p')";

        $result = mysqli_query($connect, $q);

        if ($result) {
            echo '<h1>Thank you! Record has been inserted.</h1>';
            exit();
        } else {
            echo '<h1>System error. Please try again later.</h1>';
        }

        mysqli_close($connect);
        exit();
    } else {
        echo '<h1>Error! Please check your input and try again.</h1>';
    }
}
?>

<h2>Register Doktor</h2>
<p>* required field</p>
<form action="registerDoktor.php" method="post">

    <p><label for="FirstName"> First Name : *</label>
        <input id="FirstName" type="text" name="FirstName" size="30" maxlength="150" value="<?php if (isset($_POST['FirstName'])) echo $_POST['FirstName']; ?>" />
    </p>

    <p><label for="LastName"> Last Name : *</label>
        <input id="LastName" type="text" name="LastName" size="30" maxlength="60" value="<?php if (isset($_POST['LastName'])) echo $_POST['LastName']; ?>" />
    </p>

    <p><label for="Specialization"> Specialization : *</label>
        <input id="Specialization" type="text" name="Specialization" size="12" maxlength="12" value="<?php if (isset($_POST['Specialization'])) echo $_POST['Specialization']; ?>" />
    </p>

    <p><label for="Password"> Password : *</label>
        <input id="Password" type="password" name="Password" size="12" maxlength="12" value="<?php if (isset($_POST['Password'])) echo $_POST['Password']; ?>" />
    </p>

    <p><input id="submit" type="submit" name="submit" value="Register" /> &nbsp;&nbsp;
        <input id="reset" type="reset" name="reset" value="Clear All" />
    </p>

</form>

<p>
    <br />
    <br />
    <br />
</p>
