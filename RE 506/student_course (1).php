<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Course Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0 auto;
            padding: 20px;
            max-width: 600px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        .navigation {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h1>Student Course Management</h1>

<?php
// Declaring Variables
$courseName = "Introduction to PHP";
$studentNames = ["Alice", "Bob", "Charlie", "Diana"];

// Function to display student list
function displayStudents($students) {
    // echo "<h2>Enrolled Students</h2>";
    // echo "<table>";
    // echo "<tr><th>#</th><th>Student Name</th></tr>";
    // foreach ($students as $index => $student) {
    //     echo "<tr><td>" . ($index + 1) . "</td><td>" . $student . "</td></tr>";
    // }
    // echo "</table>";
}

// Simple if-else condition
if ($courseName == "Introduction to PHP") {
    echo "<h2>Course: $courseName</h2>";
} else {
    echo "<h2>Course: Unknown</h2>";
}

// Display student list
displayStudents($studentNames);

// Example of a PHP Array with keys
$grades = [
    "Alice" => "A",
    "Bob" => "B",
    "Charlie" => "A",
    "Diana" => "C"
];

// Function to display student grades
function displayGrades($grades) {
    // echo "<h2>Student Grades</h2>";
    // echo "<table>";
    // echo "<tr><th>Student</th><th>Grade</th></tr>";
    // foreach ($grades as $student => $grade) {
    //     echo "<tr><td>" . $student . "</td><td>" . $grade . "</td></tr>";
    // }
    // echo "</table>";
}

// Display the grades
displayGrades($grades);

// Demonstrating a loop
echo "<h2>Course Levels</h2>";
$levels = ["Beginner", "Intermediate", "Advanced"];
echo "<ul>";
for ($i = 0; $i < count($levels); $i++) {
    echo "<li>" . $levels[$i] . "</li>";
}
echo "</ul>";

// Form for adding new student
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['student_name'])) {
    $newStudent = $_POST['student_name'];
    array_push($studentNames, $newStudent);
    echo "<h2>New Student Added: $newStudent</h2>";
    displayStudents($studentNames);
}
?>

<h2>Add a New Student</h2>
<form method="post" action="">
    <label for="student_name">Student Name:</label>
    <input type="text" id="student_name" name="student_name" required>
    <input type="submit" value="Add Student">
</form>

<!-- Adding Navigation Links to Other Pages -->
<div class="navigation">
    <h3>Navigation</h3>
    <ul>
        <li><a href="course_details.php">Course Details</a></li>
        <li><a href="student_management.php">Student Management</a></li>
    </ul>
</div>

</body>
</html>
