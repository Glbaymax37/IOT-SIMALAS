<?php
class Booking {
    private $error = "";

    public function evaluate($data) {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $this->error .= $key . " is empty!<br>";
            }
        }
        return $this->error;
    }

    public function create_booking(&$userid, $username, $userNIM, $userPBL, $data) {
        // Evaluasi data
        $this->error = $this->evaluate($data);

        if ($this->error == "") {
            // Semua field terisi
            $tanggal = addslashes($data['tanggal_pinjam']);
            $jamBooking = addslashes($data['waktu_mulai']);
            $jamSelesai = addslashes($data['waktu_selesai']);

            // Query untuk menyimpan ke tabel Booking
            $query = "INSERT INTO Booking (userid, NAMA, NIM, PBL, Tanggal, JamBooking, JamSelesai, date) 
                      VALUES ('$userid', '$username', '$userNIM', '$userPBL', '$tanggal', '$jamBooking', '$jamSelesai', NOW())";

            // Simpan data ke database
            $DB = new Database();
            $DB->save($query);
        } else {
            return $this->error; // Kembalikan pesan kesalahan
        }
    }

    public function getAllBookings() {
        $query = "SELECT NAMA, NIM, PBL, Tanggal, JamBooking, JamSelesai FROM Booking";
        $DB = new Database();
        return $DB->read($query); // Menggunakan method read dari class Database
    }

    public function getError() {
        return $this->error;
    }
}
?>