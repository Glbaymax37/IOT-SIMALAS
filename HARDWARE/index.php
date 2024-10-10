<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengiriman Data Sensor</title>
</head>
<body>
    <h1>Pengiriman Data Sensor</h1>
    <form action="process.php" method="POST">
        <label for="tegangan">Tegangan:</label>
        <input type="text" id="tegangan" name="tegangan" required><br>

        <label for="arus">Arus:</label>
        <input type="text" id="arus" name="arus" required><br>

        <label for="daya">Daya:</label>
        <input type="text" id="daya" name="daya" required><br>

        <label for="energi">Energi:</label>
        <input type="text" id="energi" name="energi" required><br>

        <label for="suhu">Suhu:</label>
        <input type="text" id="suhu" name="suhu" required><br>

        <label for="kelembapan">Kelembapan:</label>
        <input type="text" id="kelembapan" name="kelembapan" required><br>

        <label for="used">Used:</label>
        <input type="text" id="used" name="used" required><br>

        <button type="submit">Aktifkan Mesin</button>
    </form>
</body>
</html>
