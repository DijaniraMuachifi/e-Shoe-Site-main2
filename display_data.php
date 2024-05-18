<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">Display Data</h1>
        <div class="bg-white p-6 rounded shadow">
            <?php
            // Retrieve and display the captured data
            if(isset($_GET['name']) && isset($_GET['email']) && isset($_GET['message'])) {
                $name = $_GET['name'];
                $email = $_GET['email'];
                $message = $_GET['message'];

                // Display the data
                ?>
                <div class="mb-4">
                    <p class="font-bold">Name:</p>
                    <p><?php echo $name; ?></p>
                </div>
                <div class="mb-4">
                    <p class="font-bold">Email:</p>
                    <p><?php echo $email; ?></p>
                </div>
                <div class="mb-4">
                    <p class="font-bold">Message:</p>
                    <p><?php echo $message; ?></p>
                </div>
                <?php
            } else {
                echo "<p>No data to display.</p>";
            }
            ?>
        </div>

        <div class="mt-4">
            <a href="messages.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                View More Messages
            </a>
        </div>
    </div>
</body>
</html>
