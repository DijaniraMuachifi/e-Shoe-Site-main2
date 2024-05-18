<?php
// Conexão ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Função para validar o email
function is_valid_email($email) {
    return preg_match("/^([A-Za-z0-9_\-\.])+@([A-Za-z0-9_\-\.])+\.[A-Za-z]{2,4}$/", $email);
}

// Inicialização de variáveis
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$pieces = $_POST['pieces'] ?? '';
$day = $_POST['day'] ?? '';

$valid = true;

// Validação
if (empty($name) || strlen($name) < 8 || strlen($name) > 30) {
    echo "Name: $name<br>Incorrect!<br>";
    $valid = false;
} else {
    echo "Name: $name<br>Correct<br>";
}

if (empty($email) || !is_valid_email($email)) {
    echo "E-mail: $email<br>Incorrect!<br>";
    $valid = false;
} else {
    echo "E-mail: $email<br>Correct<br>";
}

if (empty($pieces) || !is_numeric($pieces) || $pieces < 1 || $pieces > 10) {
    echo "Pieces: $pieces<br>Incorrect!<br>";
    $valid = false;
} else {
    echo "Pieces: $pieces<br>Correct<br>";
}

$validDays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
if (empty($day) || !in_array($day, $validDays)) {
    echo "Day: $day<br>Incorrect!<br>";
    $valid = false;
} else {
    echo "Day: $day<br>Correct<br>";
}

// Se todos os dados forem válidos, insira no banco de dados
if ($valid) {
    $stmt = $conn->prepare("INSERT INTO orders (name, email, pieces, day) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $email, $pieces, $day);

    if ($stmt->execute()) {
        echo "Data successfully inserted into the database.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Some data is incorrect. Please correct the highlighted fields and try again.";
}

$conn->close();
?>
