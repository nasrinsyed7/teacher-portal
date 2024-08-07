<?php
include('db.php');

$id = $_GET['id'];

$stmt = $con->prepare("DELETE FROM students WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header('Location: home.php');
} else {
    echo "Error: " . $stmt->error;
}
?>
