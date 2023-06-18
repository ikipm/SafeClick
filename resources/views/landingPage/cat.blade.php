<!DOCTYPE html>
<html>
    <head>
        <title>Acadèmia ciberseguretat</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/landingPage.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/shared.css')}}">
        <script src="{{asset('js/landingpage.js')}}"></script>
    </head>
    <body>
        <header>
            <nav class="navbar">
                <div class="logo">
                    <img src="{{asset('img/logo.png')}}" alt="Logo"></img>
                </div>
                <div class="language-menu">
                    <div class="current-language">CAT</div>
                    <ul class="language-list">
                        <li><a href="/es">ES</a></li>
                        <li><a href="/en">EN</a></li>
                    </ul>
                </div>
                <div class="login-button">
                    <a href="/login">Inicia sessió</a>
                </div>
            </nav>
        </header>        

        <section class="hero-section">
            <div class="hero-image">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1>Acadèmia online de ciberseguretat</h1>
                        <div class="typing-animation">
                            <span id="typed-text"></span>
                        </div>
                    </div>
                    <div class="hero-button-container">
                        <a href="#" class="hero-button">Començar</a>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="why-section">
            <div class="container">
            <h2>Per que cal aprendre ciberseguretat?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet libero et mauris mattis consectetur. Nam eget sem ut nunc venenatis fermentum. In eleifend consectetur sapien, vitae volutpat enim pulvinar id.</p>
            <p>Morbi rutrum odio vitae elit euismod malesuada. Mauris lacinia rutrum eros, a condimentum erat tincidunt nec. Nullam tristique risus eu leo facilisis, a ultricies turpis consectetur.</p>
            </div>
        </section>

        <section class="how-section">
            <div class="container">
            <h2>Com s'aprèn a aquesta plataforma?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet libero et mauris mattis consectetur. Nam eget sem ut nunc venenatis fermentum. In eleifend consectetur sapien, vitae volutpat enim pulvinar id.</p>
            <p>Morbi rutrum odio vitae elit euismod malesuada. Mauris lacinia rutrum eros, a condimentum erat tincidunt nec. Nullam tristique risus eu leo facilisis, a ultricies turpis consectetur.</p>
            </div>
        </section>

        <section class="about-section">
            <div class="container">
            <h2>Sobre aquesta iniciativa</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet libero et mauris mattis consectetur. Nam eget sem ut nunc venenatis fermentum. In eleifend consectetur sapien, vitae volutpat enim pulvinar id.</p>
            <p>Morbi rutrum odio vitae elit euismod malesuada. Mauris lacinia rutrum eros, a condimentum erat tincidunt nec. Nullam tristique risus eu leo facilisis, a ultricies turpis consectetur.</p>
            </div>
        </section>

        <footer>
            <div class="footer-container">
                <div class="footer-logo">
                    <img src="{{asset('img/logo.png')}}" alt="Logo">
                </div>
                <div class="footer-links">
                    <a href="">Inici</a>
                    <a href="">Sobre nosaltres</a>
                    <a href="">Contacte</a>
                </div>
            </div>
            <p>&copy; 2023 Online Academy. All rights reserved.</p>
        </footer>
    </body>
</html>
