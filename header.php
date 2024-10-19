<link rel="icon" href="Personalização do site/TopLevelLogo.ico" type="image/x-icon">
<script src="https://kit.fontawesome.com/87a451ecf9.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
<link rel="stylesheet" href="assents/css/responsive.css">

<div class="header-config">
    <a href="Index.php" class="logo">
        <img src="Personalização do site/TopLevelLogo.webp" alt="logo" height="80" width="80" align="center">TopLevel
    </a>
    
    <div class="menu-toggle" id="mobile-menu">
        <i class="fas fa-bars"></i> <!-- Ícone de 3 barrinhas -->
    </div>

    <nav>
        <ul>
            <li><a href="products.php" class="linkb1">Produtos</a></li>
            <li><a href="promoções.php" class="linkb1">Promoções</a></li>
            <li><a href="contato.php" class="linkb1">Contato</a></li>
            <li><a href="login.php" class="linkb1">
                <i class="fa-solid fa-user fa-bounce fa-xs icon" style="color: #ffffffbe;"></i>
                <div class="login">Login</div>
            </a></li>
        </ul>
    </nav>
</div>

<script>
    const mobileMenu = document.getElementById('mobile-menu');
    const nav = document.querySelector('nav');

    mobileMenu.addEventListener('click', () => {
        nav.classList.toggle('active');
    });
</script>
