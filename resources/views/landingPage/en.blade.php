<!DOCTYPE html>
<html>
    <head>
        <title>Cybersecurity academy</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/landingpage.css')}}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="{{asset('js/landingpage.js')}}"></script>
    </head>
    <body>
        <header>
            <nav class="navbar">
                <div class="logo">
                    <img src="{{asset('img/logo.png')}}" alt="Logo"></img>
                </div>
                <div class="language-menu">
                    <div class="current-language">EN</div>
                    <ul class="language-list">
                        <li><a href="/">CAT</a></li>
                        <li><a href="/es">ES</a></li>
                    </ul>
                </div>
                <div class="login-button">
                    <a href="#">Login</a>
                </div>
            </nav>
        </header>        

        <section class="hero-section">
            <div class="hero-image">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1>Online cybersecurity academy</h1>
                        <div class="typing-animation">
                            <span id="typed-text"></span>
                        </div>
                    </div>
                    <div class="hero-button-container">
                        <a href="#" class="hero-button">Start</a>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="why-section">
            <div class="container">
            <h2>Why is cybersecurity important?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet libero et mauris mattis consectetur. Nam eget sem ut nunc venenatis fermentum. In eleifend consectetur sapien, vitae volutpat enim pulvinar id.</p>
            <p>Morbi rutrum odio vitae elit euismod malesuada. Mauris lacinia rutrum eros, a condimentum erat tincidunt nec. Nullam tristique risus eu leo facilisis, a ultricies turpis consectetur.</p>
            </div>
        </section>

        <section class="how-section">
            <div class="container">
            <h2>How does this method works?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet libero et mauris mattis consectetur. Nam eget sem ut nunc venenatis fermentum. In eleifend consectetur sapien, vitae volutpat enim pulvinar id.</p>
            <p>Morbi rutrum odio vitae elit euismod malesuada. Mauris lacinia rutrum eros, a condimentum erat tincidunt nec. Nullam tristique risus eu leo facilisis, a ultricies turpis consectetur.</p>
            </div>
        </section>

        <section class="about-section">
            <div class="container">
            <h2>About this iniciative</h2>
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
                    <a href="">Home</a>
                    <a href="">About us</a>
                    <a href="">Contact</a>
                </div>
            </div>
            <p>&copy; 2023 Online Academy. All rights reserved.</p>
        </footer>
    </body>
</html>
