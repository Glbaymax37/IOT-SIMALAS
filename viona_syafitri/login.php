<?php
session_start();

include("classes/connect.php");
include("classes/login.php");

$NIM = "";
$Password = "";
$errorMessage = ""; // Variabel untuk menyimpan pesan error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = new Login();
    $result = $login->evaluate($_POST);

    if ($result != "") {
        $errorMessage = $result; // Simpan pesan error
    } else {
        header("Location: index.php");
        die;
    }

    $NIM = $_POST['NIM'];
    $Password = $_POST['Password'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        /* Styling untuk background dan container */
        body {
            background: url('https://i.pinimg.com/564x/27/5e/93/275e930c57d0596f7fecfe5adb50c6ea.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            flex-direction: column; /* Tambahkan untuk menumpuk error di atas konten */
        }

        .error-message {
            text-align: center;
            font-size: 14px;
            color: white;
            background-color: red; /* Ubah warna background */
            padding: 15px;
            width: 100%; /* Lebar penuh */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            border-radius: 0; /* Tidak ada border radius agar full-width */
            position: fixed; /* Tetap di bagian atas layar */
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .container {
            max-width: 1100px;
            width: 100%;
        }

        .card {
            background-color: rgba(228, 237, 237, 0.9);
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .bg-login-image {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 50px;
            height: 100%;
        }

        .bg-login-image img {
            max-width: 100%;
            height: auto;
        }

        .text-center h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #4e73df;
        }

        .form-control-user {
            font-size: 1.2rem;
            padding: 1.2rem 1.5rem;
        }

        .btn-user {
            font-size: 1.2rem;
            padding: 0.75rem 1.5rem;
        }
    </style>
</head>

<body>

<!-- Display error message if exists -->
<?php if ($errorMessage != ""): ?>
    <div class="error-message">
        <strong>The following errors occurred:</strong>
        <br><?php echo $errorMessage; ?>
    </div>
<?php endif; ?>

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-1">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            <img src="https://www.oneeducation.org.uk/wp-content/uploads/2020/02/Hero-Illustration.png" alt="Login Image">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>

                                <form class="user" method="POST" action="">
                                    <div class="form-group">
                                        <input type="text" name="NIM" class="form-control form-control-user" placeholder="Enter NIM" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="Password" class="form-control form-control-user" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    <hr>
                                </form>

                                <div class="text-center">
                                    <a class="small" href="register.php">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>
