<?php

class Login
{
    private $error = "";

    public function evaluate($data)
    {
        // Ambil data NIM dan Password
        $NIM = addslashes($data['NIM']); 
        $Password = addslashes($data['Password']);

        $query = "SELECT * FROM user WHERE NIM = '$NIM' LIMIT 1";

       
        $DB = new Database();
        $result = $DB->read($query);
       
        
        if ($result) {
            $row = $result[0];

            if (password_verify($Password, $row['Password'])) {
                $_SESSION['simalas_userid'] = $row['userid'];
                $_SESSION['simalas_nama'] = $row['Nama'];
                $_SESSION['simalas_NIM'] = $row['NIM'];
                $_SESSION['simalas_PBL'] = $row['PBL'];
            } else {
                $this->error = "Wrong password<br>";
            }
           
        } else {
           
            $this->error = "No such NIM was found<br>";
        }

        return $this->error;
    }
}