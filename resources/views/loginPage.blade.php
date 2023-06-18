<!DOCTYPE html>
<html>

<head>
    <title>Registra't o inicia sessió - Acadèmia de ciberseguretat</title>
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
                <div class="current-language">CAT</div>
                <ul class="language-list">
                    <li><a href="/es/login">ES</a></li>
                    <li><a href="/en/login">EN</a></li>
                </ul>
            </div>
            <div class="login-button">
                <a href="/">Inici</a>
            </div>
        </nav>
    </header>
    <div class="container-wrapper">
        <div class="register-container">
            <h2>Registra't</h2>
            <form>
                <label for="register-user">Nom d'usuari:</label>
                <input type="text" id="register-user" placeholder="Insereix el teu nom d'usuari" required>
                <label for="register-email">Email:</label>
                <input type="email" id="register-email" placeholder="Insereix el teu email" required>
                <label for="register-password">Contrasenya:</label>
                <input type="password" id="register-password" placeholder="Insereix la teva contrasenya" required>
                <button type="submit">Registra't</button>
            </form>
        </div>
        <div class="login-container">
            <h2>Inicia sessió</h2>
            <form>
                <label for="login-email">Email:</label>
                <input type="email" id="login-email" placeholder="Insereix el teu email" required>
                <label for="login-password">Contrasenya:</label>
                <input type="password" id="login-password" placeholder="Insereix la teva contrasenya" required>
                <button type="submit">Inicia sessió</button>
            </form>
        </div>
    </div>
</body>

</html>
