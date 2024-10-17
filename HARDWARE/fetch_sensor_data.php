<?php
include 'connect.php';
class fetch_sensor_data{
// Mengambil data terbaru dari database
public function sensor_data() {
    $query = "SELECT tegangan, arus, daya, energi, suhu, kelembapan, used, remaining FROM sensor_data ORDER BY id DESC LIMIT 1";
    $DB = new Database();
    return $DB->read($query); 
}
}

// Memeriksa apakah data tersedia
if ($result->num_rows > 0) {
    echo "<table><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['tegangan'] . "</td>";
        echo "<td>" . $row['arus'] . "</td>";
        echo "<td>" . $row['daya'] . "</td>";
        echo "<td>" . $row['energi'] . "</td>";
        echo "<td>" . $row['suhu'] . "</td>";
        echo "<td>" . $row['kelembapan'] . "</td>";
        echo "<td>" . $row['used'] . "</td>";
        echo "<td>" . $row['remaining'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No data available";
}

$conn->close();
?>
