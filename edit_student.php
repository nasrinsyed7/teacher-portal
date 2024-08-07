<?php
include('db.php');

$id = $_POST['id'];
$name = $_POST['name'];
$subject = $_POST['subject'];
$marks = $_POST['marks'];

$stmt = $con->prepare("UPDATE students SET name = ?, subject = ?, marks = ? WHERE id = ?");
$stmt->bind_param("ssii", $name, $subject, $marks, $id);

if ($stmt->execute()) {
    header('Location: home.php');
} else {
    echo "Error: " . $stmt->error;
}
?>
