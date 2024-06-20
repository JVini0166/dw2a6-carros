<?php
$servername = "br424.hostgator.com.br";
$username = "alsoac40_dw2a6";
$password = "MaçãComPaçoca2024";
$dbname = "alsoac40_vrum";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
