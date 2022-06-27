<?php
$conn = mysqli_connect('localhost', 'root', '', 'social_network');

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
$error_array = ""; // Holds error messages

if (isset($_POST['reg_button'])) {

  // Registration form values

  // First name
  $fname = strip_tags($_POST['reg_fname']); // Remove HTML tags
  $fname = str_replace(' ', '', $fname); // Remove spaces
  $fname = ucfirst(strtolower($fname)); // Uppercase first letter

  // Last name
  $lname = strip_tags($_POST['reg_lname']); // Remove HTML tags
  $lname = str_replace(' ', '', $lname); // Remove spaces
  $lname = ucfirst(strtolower($lname)); // Uppercase first letter

  // Email
  $em = strip_tags($_POST['reg_email']); // Remove HTML tags
  $em = str_replace(' ', '', $em); // Remove spaces
  $em = ucfirst(strtolower($em)); // Uppercase first letter

  // Email 2
  $em2 = strip_tags($_POST['reg_email2']); // Remove HTML tags
  $em2 = str_replace(' ', '', $em2); // Remove spaces
  $em2 = ucfirst(strtolower($em2)); // Uppercase first letter

  // Password
  $password = strip_tags($_POST['reg_password']); // Remove HTML tags
  $password2 = strip_tags($_POST['ref_password2']); // Remove HTML tags

  // Date
  $date = date("Y-m-d"); // Current date

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
    <input type="text" name="reg_fname" placeholder="First Name" required>
    <br>
    <input type="text" name="reg_lname" placeholder="Last Name" required>
    <br>
    <input type="email" name="reg_email" placeholder="Email" required>
    <br>
    <input type="email" name="reg_email2" placeholder="Confirm Email" required>
    <br>
    <input type="password" name="reg_password" placeholder="Password" required>
    <br>
    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
    <br>
    <input type="submit" name="reg_button" value="Register">
  </form>

</body>

</html>