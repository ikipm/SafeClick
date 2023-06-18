<!DOCTYPE html>
<html>

<head>
    <title>Register or login - Cybersecurity academy</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loginPage.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Logo"></img>
            </div>
            <div class="language-menu">
                <div class="current-language">EN</div>
                <ul class="language-list">
                    <li><a href="/login">CAT</a></li>
                    <li><a href="/es/login">ES</a></li>
                </ul>
            </div>
            <div class="login-button">
                <a href="/">Home</a>
            </div>
        </nav>
    </header>
    <div class="container-wrapper">
        <div class="register-container">
            <h2>Register</h2>
            <form>
                <label for="register-user">User name:</label>
                <input type="text" id="register-user" placeholder="Insert your user name" required>
                <label for="register-email">Email:</label>
                <input type="email" id="register-email" placeholder="Insert your email" required>
                <label for="register-password">Password:</label>
                <input type="password" id="register-password" placeholder="Insert your password" required>
                <button type="submit">Register</button>
            </form>
        </div>
        <div class="login-container">
            <h2>Login</h2>
            <form>
                <label for="login-email">Email:</label>
                <input type="email" id="login-email" placeholder="Insert your email" required>
                <label for="login-password">Password:</label>
                <input type="password" id="login-password" placeholder="Insert your password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
