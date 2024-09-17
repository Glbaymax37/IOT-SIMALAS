<?php

class Login
{
    private $error = "";

    public function evaluate($data)
    {
        // Ambil data NIM dan Password
        $NIM = addslashes($data['NIM']); 
        $Password = addslashes($data['Password']);

        // Query SQL
        $query = "SELECT * FROM user WHERE NIM = '$NIM' LIMIT 1";

        // Inisiasi database dan baca hasil query
        $DB = new Database();
        $result = $DB->read($query);
       
        
        if ($result) {
            $row = $result[0];

            if (password_verify($Password, $row['Password'])) {
                $_SESSION['userid'] = $row['userid'];
            } else {
                $this->error = "Wrong password<br>";
            }
           
        } else {
           
            $this->error = "No such NIM was found<br>";
        }

        return $this->error;
    }
}
