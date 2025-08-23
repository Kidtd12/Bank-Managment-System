<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'habesha_bank');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate and sanitize all POST inputs
  $name = htmlspecialchars($_POST['name']);
  $gender = htmlspecialchars($_POST['gender']);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $phoneNumber = htmlspecialchars($_POST['phonenumber']);
  $city = htmlspecialchars($_POST['city']);
  $address = htmlspecialchars($_POST['address']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
  $dob = htmlspecialchars($_POST['dob']);
  $accountNo = htmlspecialchars($_POST['accountno']);
  $accountType = htmlspecialchars($_POST['accounttype']);
  $deposit = htmlspecialchars($_POST['deposit']);

  // Handle file upload
  if (isset($_FILES['profile']) && $_FILES['profile']['error'] == UPLOAD_ERR_OK) {
    $uploadedFile = $_FILES['profile'];
    $fileName = basename($uploadedFile['name']); // Original file name
    $fileTmpPath = $uploadedFile['tmp_name']; // Temporary path
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // File extension

    // Define allowed file types
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    // Validate file type
    if (in_array($fileType, $allowedTypes)) {
      // Generate a unique file name to avoid overwriting
      $uniqueFileName = uniqid() . '.' . $fileType;

      // Define the upload directory
      $uploadDir = 'uploads/';
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
      }

      // Move the uploaded file to the specified directory
      $destination = $uploadDir . $uniqueFileName;
      if (move_uploaded_file($fileTmpPath, $destination)) {
        $filePath = $destination; // Store the relative path in the database

        // Insert data into the database using prepared statements
        $stmt = $conn->prepare("INSERT INTO useraccounts (name, gender, email, phoneNumber, city, address, password, profile, dob, accountNo, accountType, deposit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssss", $name, $gender, $email, $phoneNumber, $city, $address, $password, $filePath, $dob, $accountNo, $accountType, $deposit);

        if ($stmt->execute()) {
         
          echo "<div class='alert alert-info'>Account added successfully.</div>";
          header('location: admin_home.php');
        } else {
        
          echo "<div class='alert alert-info'>Failed to add account. Error. $stmt->error</div>";
           header('location:addNewAccount.php');
        }

        $stmt->close();
      } else {
        echo "<div class='alert alert-info'>Failed to upload file.</div>";
        header('location:addNewAccount.php');
      }
    } else {
      echo "<div class='alert alert-info'>Invalid file type. Allowed types . implode(', ', $allowedTypes)</div>";
      header('location:addNewAccount.php');
      
    }
  } else {
    echo "<div class='alert alert-info'>No file uploaded or an error occurred.</div>";
    header('location:addNewAccount.php');
  }
}

$conn->close();