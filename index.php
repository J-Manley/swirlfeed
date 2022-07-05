<?php
$conn = mysqli_connect('localhost', 'root', '', 'social');

if (mysqli_connect_errno()) {
  echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}

$query = mysqli_query($conn, "INSERT INTO test_1 VALUES (NULL,'Joel')");

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Swirlfeed</title>
</head>

<body>
  TEST2
</body>

</html>