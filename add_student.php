<?php
include('db.php');

$name = $_POST['name'];
$subject = $_POST['subject'];
$marks = $_POST['marks'];

$stmt = $con->prepare("INSERT INTO students (name, subject, marks) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $name, $subject, $marks);

if ($stmt->execute()) {
    header('Location: home.php');
} else {
    echo "Error: " . $stmt->error;
}
?>
