<html>

<head>
    <title>SignUP IOT Simalas</title>
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
            <button class="button">Login</button>
        </div>
    </div>

    <div id="content">
        <form id="signup-form">
            <h2>Register </h2>
            <div class="form-field">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-field">
                <label for="nim">NIM:</label>
                <input type="text" id="nim" name="nim" required>
            </div>

            <div class="form-field">
                <label for="PBL">PBL:</label>
                <input type="PBL" id="PBL" name="PBL" required>
            </div>


            <div class="form-field">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-field">
                <label for="Create Password">Create Password:</label>
                <input type="Create Password" id="Create Password" name="Create Password" required>
            </div>


            
            <div class="form-field">
                <label for="gender">Jenis Kelamin:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Laki-laki</option>
                    <option value="female">Perempuan</option>
                    
                </select>
            </div>
            <div class="form-field">
                <input type="submit" value="Sign Up">
            </div>
        </form>
    </div>

</body>

</html>
