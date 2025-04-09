<?php

$message = "";

if(isset($_POST['name'])) {
    // Information required for database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cars";

    // Retrieving data from a form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Create the database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the link
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Adding data to the database
    $sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $message = "<p style='color:orange; text-align:center;'>Mesajınız başarıyla gönderildi!</p>";
    } else {
        // An error message is sent when data insertion fails.
        $message = "<p style='color:red;'>Hata: " . $sql . "<br>" . $conn->error . "</p>";
    }

    // Connectiın Close
    $stmt->close();
    $conn->close();
}
?>