<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
</head>
<body>

<h1>Student Management</h1>

<?php
// Example functionality for managing students
$students = ["Alice", "Bob", "Charlie", "Diana"];
echo "<h2>Student List</h2>";
echo "<ul>";
foreach ($students as $student) {
    echo "<li>$student</li>";
}
echo "</ul>";
?>

<a href="student_course.php">Back to Course Management</a>

</body>
</html>
