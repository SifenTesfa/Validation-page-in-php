<?php

// Define variables and set to empty values
$nameErr = $emailErr = $genderErr = $messageErr = "";
$name = $email = $gender = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate name
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // Check if name length is between 10 and 30 characters
    if (strlen($name) < 10 || strlen($name) > 30) {
      $nameErr = "Name must be between 10 and 30 characters";
    }
  }

  // Validate email
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // Check if email is valid
    if (!strpos($email, '@')) {
        $emailErr = "Please add the '@' sign in the email field";
    
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
  }

  // Validate gender
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  // Validate message
  if (empty($_POST["message"])) {
    $messageErr = "Message is required";
  } else {
    $message = test_input($_POST["message"]);
    // Check if message length is less than 100 characters
    if (strlen($message) > 100) {
      $messageErr = "Message must be less than 100 characters";
    }
  }
}

// Function to sanitize input data
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<link rel="stylesheet" href="styles.css">
<!-- HTML form -->
<div class="container">
    <h1>Email Message</h1>
<form id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div class="form-group">
  Name: <input  type="text" name="name" value="<?php echo $name; ?>">
  <span class="error"><?php echo $nameErr; ?></span><br><br> </div>
  <div class="form-group">
  Email: <input type="text" name="email" value="<?php echo $email; ?>">
  <span class="error"><?php echo $emailErr; ?></span><br><br></div>
  <div class="form-group">
  Gender:
  <input type="radio" name="gender" value="male" <?php if ($gender == "male") echo "checked"; ?>> Male
  <input type="radio" name="gender" value="female" <?php if ($gender == "female") echo "checked"; ?>> Female
  <span class="error"><?php echo $genderErr; ?></span><br><br> </div>
  <div class="form-group">
  Message: <textarea name="message"><?php echo $message; ?></textarea>
  <span class="error"><?php echo $messageErr; ?></span><br><br> </div>
  <input type="submit" name="submit" value="Submit"> </div>
</form>