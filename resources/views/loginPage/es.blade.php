<!DOCTYPE html>
<html>

<head>
    <title>Registrate o inicia sesión - Academia de ciberseguridad</title>
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
                <div class="current-language">ES</div>
                <ul class="language-list">
                    <li><a href="/login">CAT</a></li>
                    <li><a href="/en/login">EN</a></li>
                </ul>
            </div>
            <div class="login-button">
                <a href="/">Inicio</a>
            </div>
        </nav>
    </header>
    <div class="container-wrapper">
        <div class="register-container">
            <h2>Registrate</h2>
            <form>
                <label for="register-user">Nombre de usuario:</label>
                <input type="text" id="register-user" placeholder="Introduce tu nombre de usuario" required>
                <label for="register-email">Email:</label>
                <input type="email" id="register-email" placeholder="Introduce tu email" required>
                <label for="register-password">Contraseña:</label>
                <input type="password" id="register-password" placeholder="Introduce tu contraseña" required>
                <button type="submit">Registrate</button>
            </form>
        </div>
        <div class="login-container">
            <h2>Inicia sesión</h2>
            <form>
                <label for="login-email">Email:</label>
                <input type="email" id="login-email" placeholder="Introduce tu email" required>
                <label for="login-password">Contraseña:</label>
                <input type="password" id="login-password" placeholder="Introduce tu contraseña" required>
                <button type="submit">Inicia sesión</button>
            </form>
        </div>
    </div>
</body>

</html>
