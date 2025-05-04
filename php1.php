
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Form</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #ffe6f0, #fff0f5);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .card {
      background: white;
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(255, 105, 180, 0.2);
      width: 100%;
      max-width: 420px;
    }

    h2, h3 {
      color: #d63384;
      text-align: center;
    }

    label {
      display: block;
      margin: 0.5rem 0 0.2rem;
      font-weight: 600;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 0.6rem;
      margin-bottom: 1rem;
      border-radius: 8px;
      border: 1px solid #f5c6d6;
      background-color: #fff9fb;
    }

    .gender-group {
      margin-bottom: 1rem;
    }

    .gender-group label {
      display: inline-block;
      margin-right: 1rem;
    }

    input[type="submit"] {
      background-color: #ff69b4;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 0.7rem;
      width: 100%;
      font-size: 1rem;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #ff85c1;
    }

    .error-box {
      background-color: #ffe5ec;
      color: #b3003b;
      border: 1px solid #ff99bb;
      padding: 1rem;
      border-radius: 10px;
      margin-bottom: 1rem;
    }

    .success-box {
      background-color: #e6ffed;
      color: #1a7f37;
      border: 1px solid #b5e7b3;
      padding: 1rem;
      border-radius: 10px;
      margin-bottom: 1rem;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="card">
  <?php
    $name = $email = $password = $confirm_password = $gender = "";
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";

        // Validation
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $errors[] = "Name should contain only letters and spaces.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters long.";
        }

        if ($password !== $confirm_password) {
            $errors[] = "Passwords do not match.";
        }

        if (empty($gender)) {
            $errors[] = "Please select your gender.";
        }

        if (empty($errors)) {
            echo "<div class='success-box'><h3>Registration Successful!</h3>Welcome, <strong>" . htmlspecialchars($name) . "</strong>!</div>";
        } else {
            echo "<div class='error-box'><h3>Please fix the following:</h3><ul>";
            foreach ($errors as $error) {
                echo "<li>" . htmlspecialchars($error) . "</li>";
            }
            echo "</ul></div>";
        }
    }
  ?>

  <h2>Register</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Full Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required>

    <div class="gender-group">
      <label>Gender:</label>
      <label><input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked"; ?>> Male</label>
      <label><input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?>> Female</label>
    </div>

    <input type="submit" name="submit" value="Register">
  </form>
</div>

</body>
</html>
