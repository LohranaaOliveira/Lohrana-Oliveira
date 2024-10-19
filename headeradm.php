<link rel="icon" href="Personalização do site/TopLevelLogo.ico" type="image/x-icon">
<script src="https://kit.fontawesome.com/87a451ecf9.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>

<div class="header-config"> 
    <a href="Index.php" class="logo">
        <img src="Personalização do site/TopLevelLogo.webp" alt="logo" height="80" width="80" align="center">TopLevel
    </a>
    <nav>
        <ul>
            <li><a href="products.php" class="linkb1">Produtos</a></li>
            <li><a href="promoções.php" class="linkb1">Promoções</a></li>
            <li><a href="contato.php" class="linkb1">Contato</a></li>

            <?php
            $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
            $row_count = mysqli_num_rows($select_rows);
            ?>

            <li class="menu-item">
                <button class="dropdown-btn">
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="sair.php">Sair</a>
                    <a href="sistema.php">Administar contas</a>
                    <a href="admin_page.php">Administrar produtos</a>
                    <a href="admin_avaliacoes.php">Avaliações</a>
                </div>
            </li>
            
            <li>
                <div class="cart-container1">
                    <a class="fas fa-truck" href="entregas.php"></a>
                </div>
            </li>
        </ul>
    </nav>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtn = document.querySelector('.dropdown-btn');
            const dropdownContent = document.querySelector('.dropdown-content');

            dropdownBtn.addEventListener('click', function() {
                dropdownContent.classList.toggle('show');
            });

            document.addEventListener('click', function(event) {
                if (!dropdownBtn.contains(event.target)) {
                    dropdownContent.classList.remove('show');
                }
            });
        });
</script>