<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'social');

if (mysqli_connect_errno()) {
  echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}

// Declaring variable names to prevent errors
$fname = ""; // First name
$lname = ""; // Last name
$em = ""; // Email
$em2 = ""; // Email 2
$password = ""; // Password
$password2 = ""; // Password 2
$date = ""; // Sign up date
$error_array = []; // Holds error messages

if (isset($_POST['reg_button'])) {

  // Registration form values 

  // First name
  $fname = strip_tags($_POST['reg_fname']); // Remove HTML tags
  $fname = str_replace(' ', '', $fname); // Remove spaces
  $fname = ucfirst(strtolower($fname)); // Uppercase first letter
  $_SESSION['reg_fname'] = $fname; // Storing first name into session variable

  // Last name
  $lname = strip_tags($_POST['reg_lname']); // Remove HTML tags
  $lname = str_replace(' ', '', $lname); // Remove spaces
  $lname = ucfirst(strtolower($lname)); // Uppercase first letter
  $_SESSION['reg_lname'] = $lname; // Storing last name into session variable

  // Email
  $em = strip_tags($_POST['reg_email']); // Remove HTML tags
  $em = str_replace(' ', '', $em); // Remove spaces
  $em = ucfirst(strtolower($em)); // Uppercase first letter
  $_SESSION['reg_email'] = $em; // Storing email into session variable

  // Email 2
  $em2 = strip_tags($_POST['reg_email2']); // Remove HTML tags
  $em2 = str_replace(' ', '', $em2); // Remove spaces
  $em2 = ucfirst(strtolower($em2)); // Uppercase first letter
  $_SESSION['reg_email2'] = $em2; // Storing email 2 into session variable

  // Password
  $password = strip_tags($_POST['reg_password']); // Remove HTML tags
  $password2 = strip_tags($_POST['reg_password2']); // Remove HTML tags

  // Date
  $date = date("Y-m-d"); // Current date

  if ($em === $em2) {
    // Check if email is in valid format
    if (filter_var($em, FILTER_VALIDATE_EMAIL)) {

      $em = filter_var($em, FILTER_VALIDATE_EMAIL);

      // Check if email already exists
      $e_check = mysqli_query($conn, "SELECT email FROM users WHERE email='$em'");

      // Count the number of rows returned
      $num_rows = mysqli_num_rows($e_check);

      if ($num_rows > 0) {
        array_push($error_array, "Email already in use<br>");
      }
    }
  } else {
    array_push($error_array, "Invalid email format<br>");
  }
} else {
  array_push($error_array, "Emails do not match<br>");
}

if (strlen($fname) > 25 || strlen($fname) < 2) {
  array_push($error_array, "First name must be between 2 and 25 characters<br>");
}

if (strlen($lname) > 25 || strlen($lname) < 2) {
  array_push($error_array, "Last name must be between 2 and 25 characters<br>");
}

if ($password != $password2) {
  array_push($error_array, "Your passwords do not match<br>");
} else {
  if (preg_match('/[^A-Za-z0-9]/', $password)) {
    array_push($error_array, "Password must only contain letters and numbers<br>");
  }
}

if (strlen($password) > 30 || strlen($password) < 5) {
  array_push($error_array, "Password must be between 5 and 30 characters<br>");
}


?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Swirlfeed!</title>
</head>

<body>

  <form action="register.php" method="POST">
    <input type="text" name="reg_fname" placeholder="First Name" value=" <?php if (isset($_session['reg_fname'])) {
                                                                            echo $_session['reg_fname'];
                                                                          } ?>" required>
    <br>
    <?php if (in_array("First name must be between 2 and 25 characters<br>?", $error_array)) echo "First name must be between 2 and 25 characters<br>?"; ?>

    <input type="text" name="reg_lname" placeholder="Last Name" value=" <?php if (isset($_session['reg_lname'])) {
                                                                          echo $_session['reg_lname'];
                                                                        } ?>" required>
    <br>
    <?php if (in_array("Last name must be between 2 and 25 characters<br>?", $error_array)) echo "Last name must be between 2 and 25 characters<br>?"; ?>

    <input type="email" name="reg_email" placeholder="Email" value=" <?php if (isset($_session['reg_email'])) {
                                                                        echo $_session['reg_email'];
                                                                      } ?>" required>
    <br>

    <input type="email" name="reg_email2" placeholder="Confirm Email" value=" <?php if (isset($_session['reg_email2'])) {
                                                                                echo $_session['reg_email2'];
                                                                              } ?>" required>
    <br>
    <?php if (in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
    else if (in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
    else if (in_array("Emails do not match<br>", $error_array)) echo "Emails do not match<br>"; ?>

    <input type="password" name="reg_password" placeholder="Password" required>
    <br>
    <?php if (in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>";
    else if (in_array("Password must only contain letters and numbers<br>", $error_array)) echo "Password must only contain letters and numbers<br>";
    else if (in_array("Password must be between 5 and 30 characters<br>", $error_array)) echo "Password must be between 5 and 30 characters<br>"; ?>

    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
    <br>
    <input type="submit" name="reg_button" value="Register">
  </form>

</body>

</html>