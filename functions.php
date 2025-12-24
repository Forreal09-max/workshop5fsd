<?php
function formatName($name) {
    return ucwords(trim($name));
}
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function cleanSkills($string) {
    $skills = explode(",", $string);
    return array_map("trim", $skills);
}
function saveStudent($name, $email, $skillsArray) {
    $data = $name . "|" . $email . "|" . implode(",", $skillsArray) . PHP_EOL;
    file_put_contents("students.txt", $data, FILE_APPEND);
}
function uploadPortfolioFile($file) {

    $allowedExtensions = ["pdf", "jpg", "jpeg", "png"];
    $maxSize = 2 * 1024 * 1024;

    $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedExtensions)) {
        throw new Exception("Invalid file type");
    }
    if ($file["size"] > $maxSize) {
        throw new Exception("File size exceeds 2MB");
    }
    if (!is_dir("uploads")) {
        throw new Exception("Uploads folder not found");
    }
    $newName = "portfolio_" . time() . "." . $ext;
    if (!move_uploaded_file($file["tmp_name"], "uploads/" . $newName)) {
        throw new Exception("File upload failed");
    }
    return $newName;
}

