
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Data</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<?php
// Database connection configuration
$servername = "localhost"; // Change this if your database server is different
$username = "root"; // Your MySQL root username
$password = ""; // Your MySQL root password, if you have set one
$dbname = "UserDB"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["registerUsername"];
    $password = $_POST["registerPassword"];
    $firstname = $_POST["registerFirstname"];
    $lastname = $_POST["registerLastname"];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO userdata (username, firstname, lastname, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $firstname, $lastname, $password);

    // Execute the statement
    if ($stmt->execute()) {
        
        // Display JavaScript alert
        echo '<script>alert("Registration successful!");</script>';

        // Redirect to login page after successful registration
        
        
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
