<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #a8c0ff, #a8e0e6); /* Pastel gradient */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff; /* White background for the form */
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 380px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            color: #6c5ce7; /* Pastel purple */
            font-size: 26px;
            font-weight: bold;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            color: #8e44ad; /* Pastel purple text */
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 14px;
            border: 1px solid #dfe6e9; /* Pastel gray border */
            border-radius: 8px;
            margin-bottom: 20px;
            box-sizing: border-box;
            transition: border-color 0.3s ease-in-out;
            font-size: 14px;
            color: #2d3436; /* Dark gray text */
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #55efc4; /* Pastel green focus border */
            outline: none;
        }

        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            cursor: pointer;
            color: #6c5ce7; /* Pastel green */
            font-size: 18px;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #ff6b81; /* Pastel pink */
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #ff3d5c; /* Slightly darker pastel pink */
        }

        .error-message {
            color: #e74c3c;
            margin-top: 15px;
        }

        .footer {
            margin-top: 25px;
            font-size: 12px;
            color: #888;
        }

        .footer a {
            color: #6c5ce7; /* Pastel purple link */
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" required>
                <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('password')" style="padding-bottom: 16px"></i>
            </div>

            <button type="submit">Login</button>
        </form>

        @if ($errors->any())
        <div class="error-message">
            <strong>{{ $errors->first() }}</strong>
        </div>
        @endif

        <div class="footer">
            <p>&copy; 2024 <a href="#">Aplikasi Restoran</a></p>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(id) {
            const passwordInput = document.getElementById(id);
            const toggleIcon = passwordInput.nextElementSibling;

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
