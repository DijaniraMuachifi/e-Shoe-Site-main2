<?php
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    try {
        // Connecting to the database
        $dbh = new PDO('mysql:host=localhost;dbname=UserDB', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_general_ci');
        
        // Prepare SQL statement to check if the email already exists
        $sqlSelect = "SELECT id FROM users WHERE email = :email";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(':email' => $_POST['email'])); // Check if email exists
        
        // Check if the email already exists
        if($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $message = "An account with this email already exists!";
            $success = false;
        } else {
            // Insert the data into the database if the email doesn't exist
            $sqlInsert = "INSERT INTO users (username, email, message, created_at) VALUES (:username, :email, :message, :created_at)";
            $stmt = $dbh->prepare($sqlInsert); 
            $stmt->execute(array(
                ':username' => $_POST['name'],
                ':email' => $_POST['email'],
                ':message' => $_POST['message'],
                ':created_at' => date('Y-m-d H:i:s') // Current timestamp
            )); 
            
            // Check if the insertion was successful
            if($stmt->rowCount()) {
                $newId = $dbh->lastInsertId();
                $message = "Your message has been successfully submitted.<br>Message ID: {$newId}";                     
                $success = true;
            } else {
                $message = "Failed to submit your message.";
                $success = false;
            }
        }
    } catch (PDOException $e) {
        // Error handling
        echo "Error: ".$e->getMessage();
        $success = false;
    } 
    header("Location: display_data.php?name=" . urlencode($_POST['name']) . "&email=" . urlencode($_POST['email']) . "&message=" . urlencode($_POST['message']));
    exit;     
} else {
    // Redirect if form data is not complete
    echo "Form data incomplete";
}
?>
