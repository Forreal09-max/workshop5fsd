<?php
include "functions.php";
include "header.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name = formatName($_POST["name"]);
        $email = $_POST["email"];
        $skillsInput = $_POST["skills"];

        if (empty($name) || empty($email) || empty($skillsInput)) {
            throw new Exception("All fields are required");
        }

        if (!validateEmail($email)) {
            throw new Exception("Invalid email format");
        }

        $skillsArray = cleanSkills($skillsInput);
        saveStudent($name, $email, $skillsArray);

        $success = "Student saved successfully!";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<h2>Add Student</h2>

<?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
<?php if ($success) echo "<p style='color:green'>$success</p>"; ?>

<form method="post">
    Name: <br><input type="text" name="name"><br><br>
    Email: <br><input type="text" name="email"><br><br>
    Skills (comma separated): <br>
    <input type="text" name="skills"><br><br>
    <button type="submit">Save</button>
</form>

<?php include "footer.php"; ?>
