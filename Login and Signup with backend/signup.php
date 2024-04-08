<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "arjun";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the username to create a valid table name
    $hashedUsername = md5($username);

    // Create the student table if it doesn't exist
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS $hashedUsername (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";

    if ($conn->query($sqlCreateTable) === TRUE) {
        // Insert user data into the created table
        $sqlInsert = "INSERT INTO $hashedUsername (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sqlInsert) === TRUE) {
            echo "Signup successful";
        } else {
            echo "Error inserting data: " . $conn->error;
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();
}
?>
