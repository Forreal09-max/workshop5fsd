<?php
include "header.php";

echo "<h2>Students List</h2>";

// Check if file exists
if (!file_exists("students.txt")) {
    echo "<p>No students found.</p>";
    include "footer.php";
    exit;
}
$lines = file("students.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    list($name, $email, $skills) = explode("|", $line);
    $name = trim($name);
    $email = trim($email);
    $skills = trim($skills);
    if (is_array($skills)) {
        $skills = implode(", ", $skills);
    }
    echo "<p>";
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    echo "Skills: $skills";
    echo "</p>";
}
include "footer.php";
?>
