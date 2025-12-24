<?php
include "functions.php";
include "header.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $fileName = uploadPortfolioFile($_FILES["portfolio"]);
        $success = "File uploaded successfully: $fileName";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<h2>Upload Portfolio File</h2>

<?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
<?php if ($success) echo "<p style='color:green'>$success</p>"; ?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="portfolio" required><br><br>
    <button type="submit">Upload</button>
</form>

<?php include "footer.php"; ?>
