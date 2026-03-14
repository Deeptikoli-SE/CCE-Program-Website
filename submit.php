<?php
// Database configuration
$host = "localhost";       // usually localhost
$user = "root";            // your MySQL username
$pass = "";                // your MySQL password
$db   = "recruitment_db";  // database name

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// File upload handling
$profilePhoto = "";
$resume = "";

// Profile Photo
if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['error'] == 0) {
    $profilePhoto = "uploads/" . basename($_FILES["profilePhoto"]["name"]);
    move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $profilePhoto);
}

// Resume
if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
    $resume = "uploads/" . basename($_FILES["resume"]["name"]);
    move_uploaded_file($_FILES["resume"]["tmp_name"], $resume);
}

// Prepare and sanitize form inputs
$fullName = $conn->real_escape_string($_POST['fullName']);
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$email = $conn->real_escape_string($_POST['email']);
$phone = $_POST['phone'];
$address = $conn->real_escape_string($_POST['address']);
$qualification = $conn->real_escape_string($_POST['qualification']);
$experience = $_POST['experience'];
$skills = $conn->real_escape_string($_POST['skills']);
$jobType = $_POST['jobType'];
$joiningDate = $_POST['joiningDate'];

// Insert into database
$sql = "INSERT INTO applicants 
(full_name, profile_photo, dob, gender, email, phone, address, qualification, experience, skills, job_type, joining_date, resume)
VALUES
('$fullName', '$profilePhoto', '$dob', '$gender', '$email', '$phone', '$address', '$qualification', $experience, '$skills', '$jobType', '$joiningDate', '$resume')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>Application Submitted Successfully!</h2>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>