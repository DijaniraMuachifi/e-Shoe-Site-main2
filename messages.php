
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

// Retrieve messages from the database in chronological order
$sql = "SELECT * FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);

// Check if there are any messages
if ($result->num_rows > 0) {
    // Display messages in a table
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Messages</title>
        <!-- Include Tailwind CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100">
        <div class="container mx-auto py-8">
            <h1 class="text-3xl font-bold mb-4">View Messages</h1>
            <div class="bg-white p-6 rounded shadow">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Time Sent</th>
                            <th class="px-4 py-2">Sender</th>
                            <th class="px-4 py-2">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop through each message and display in table rows
                        while($row = $result->fetch_assoc()) {
                            $timeSent = $row['created_at'];
                            $sender = $row['username']; // Assuming 'username' is the sender's name
                            $message = $row['message'];

                            // Display message details in table row
                            echo "<tr>";
                            echo "<td class='border px-4 py-2'>$timeSent</td>";
                            echo "<td class='border px-4 py-2'>$sender</td>";
                            echo "<td class='border px-4 py-2'>$message</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    // If no messages found, display a message
    echo "No messages to display.";
}

// Close connection
$conn->close();
?>
