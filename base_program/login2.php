<html>

<head>
   <title>LOGIN IOT Simalas</title>
    <style>
        #bar {
            height: 70px;
            background-color: black;
            color: yellow;
            font-size: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        #bar-buttons {
            font-size: 20px;
        }

        .button {
            background-color: yellow;
            color: black;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-left: 10px;
            border-radius: 5px;
        }

        .button:hover {
            background-color: orange;
        }

        #content {
            background-color: #333333;
            height: 100vh;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #signup-form {
            background-color: #444444;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 300px;
        }

        #signup-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-field {
            margin-bottom: 15px;
        }

        .form-field label {
            display: block;
            margin-bottom: 5px;
        }

        .form-field input,
        .form-field select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .form-field input[type="submit"] {
            background-color: yellow;
            color: black;
            border: none;
            cursor: pointer;
            font-weight: bold;
            margin-top: 20px;
        }

        .form-field input[type="submit"]:hover {
            background-color: orange;
        }
    </style>
</head>

<body>

<div id="bar">
    <div id="title">IOT Simalas</div>
    <div id="bar-buttons">
        <!-- <button class="button">Login</button>-->
        <button class="button" id="signup-button">Signup</button>
        <!-- <li><a href="dashboard.php"></a></li> -->
    </div>
</div>

<script>
    // JavaScript to make the button redirect to the dashboard.php page
    document.getElementById("signup-button").addEventListener("click", function() {
        window.location.href = "Signup.php";
    });
</script>

    <div id="content">
        <form id="signup-form">
            <h2>Login </h2>
            <div class="form-field">
                <label for="NIM">NIM:</label>
                <input type="text" id="NIM" name="NIM" required>
            </div>
            <div class="form-field">
                <label for="Password">Password:</label>
                <input type="text" id="Password" name="Password" required>
            </div>

            
            <div class="form-field">
                <input type="submit" id="login_button" value="LOGIN">


            </div>
            

                    
        <script>
            // JavaScript to make the button redirect to the dashboard.php page
            document.getElementById("login_button").addEventListener("click", function() {
                window.location.href = "dashboard.php";
            });
        </script>



        </form>
    </div>

</body>

</html>
