
<?php
// Start session
session_start();

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

// If form data is provided
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["loginUsername"];
    $password = $_POST["loginPassword"];

    // Verify credentials
    $sql = "SELECT id FROM userdata WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Authentication successful
        $_SESSION['username'] = $username;
        echo "Login successful!";
        header("Location: index.php");
        exit();
    } else {
        // Authentication failed
        echo "Invalid username or password.";
    }
}
?>

