<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restaurant App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1a1c45, #bfc0c5); /* Gradient background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Title styles */
        .login-container h1 {
            font-size: 24px;
            color: #1a1c45;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .login-container h2 {
            margin-bottom: 30px;
            font-size: 18px;
            color: #1a1c45;
            font-weight: 600;
        }

        /* Input and label styles */
        label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            font-size: 14px;
            color: #1a1c45;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #1a1c45;
            outline: none;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 35%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888888;
            font-size: 18px;
        }

        /* Button styles */
        button {
            width: 100%;
            padding: 12px;
            background: #1a1c45;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background: #1a1c45;
        }

        /* Footer styles */
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777777;
        }

        .footer a {
            color: #1a1c45;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Error message styles */
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>RESTAURANT APP</h1>
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>

            <label for="password">Password:</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('password')"></i>
            </div>

            <button type="submit">Login</button>
        </form>

        @if ($errors->any())
        <div class="error-message">
            <strong>{{ $errors->first() }}</strong>
        </div>
        @endif

        <div class="footer">
            <p>&copy; 2024 <a href="#">Restaurant App</a></p>
        </div>
    </div>

    <script>
        // Toggle password visibility
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
