<?php
    session_start();
    include_once('config.php');

    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
        exit; 
    }

    $logado = $_SESSION['email'];

    
    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM usuarios WHERE id LIKE '%$data%' OR nome LIKE '%$data%' OR email LIKE '%$data%' ORDER BY id DESC";
    }
    else
    {
        $sql = "SELECT * FROM usuarios ORDER BY id DESC";
    }

    $result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="mage/x-icon" href="Personalização do site/TopLevelLogo.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assents/css/Global.css">
  <link rel="stylesheet" href="assents/css/user.css">
  <title>Minha conta</title>
</head>

<body>
  <script src="https://kit.fontawesome.com/87a451ecf9.js" crossorigin="anonymous"></script>
  <div class="header-config">
    <a href="IndexUsuario.php" class="logo"><img src="Personalização do site/TopLevelLogo.webp" alt="logo" height="80" width="80" align="center">TopLevel</a>
    <nav>
      <ul>
        <li><a href="produtos.html" class="linkb1">Produtos</a></li>
        <li><a href="promoções.html" class="linkb1">Promoções</a></li>
        <li><a href="contato.html" class="linkb1">Contato</a></li>
        <li>
        <li class="menu-item">
            <button2 class="dropdown-btn">
                <i class="fas fa-chevron-down"></i>
            </button2>
            <div class="dropdown-content">
                <a href="sair.php">Sair</a>
                <a href="admin_page.php">Adicionar Produtos</a>
            </div>
        </li>
        <li>
                <div class="cart-container1" onclick="openNav()">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count1">0</span>
                </div>
            </li>
        </ul>
    </header>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="sidebar-content">
            <h2>Carrinho</h2>
            <p>Quantidade: <span class="cart-count">0</span></p>
        </div>
    </div>

      </ul>
    </nav>  
  </div>

  <div class="bemvindo">
        <?php    
        echo "<a>Bem vindo! $logado </a>";
        ?>
        </div>
        <br>
        <div class="box-search">
          <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
          <button oneclick="searchData()" class="btn" style="background-color: #bb00ff; border-color: #bb00ff; color: white;">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
          </svg>
          </button>
  </div>
  

<div class="m-5">
<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Senha</th>
      <th scope="col">Email</th>
      <th scope="col">telefone</th>
      <th scope="col">sexo</th>
      <th scope="col">Data de nascimento</th>
      <th scope="col">cidade</th>
      <th scope="col">estado</th>
      <th scope="col">endereço</th>
      <th scope="col">...</th>
    </tr>
  </thead>
  <tbody>
    <?php
        while($user_data = mysqli_fetch_assoc($result))
        {
            echo "<tr>";
            echo "<td>".$user_data['id']."</td>";
            echo "<td>".$user_data['nome']."</td>";
            echo "<td>".$user_data['senha']."</td>";
            echo "<td>".$user_data['email']."</td>";
            echo "<td>".$user_data['telefone']."</td>";
            echo "<td>".$user_data['sexo']."</td>";
            echo "<td>".$user_data['data_nasc']."</td>";
            echo "<td>".$user_data['cidade']."</td>";
            echo "<td>".$user_data['estado']."</td>";
            echo "<td>".$user_data['endereco']."</td>";
            echo "<td>
              <a class='btn btn-sm' style='background-color: #bb00ff; border-color: #bb00ff; color: white;' href='edit.php?id=$user_data[id]'>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                  <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/>
            </svg>
            </a>
            <a class='btn btn-sm btn-danger' href='delete.php?id=$user_data[id]'>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                  <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
            </svg>
            </a>
            </td>";
            echo "</td>";
        }
    ?>
  </tbody>
</table>
</div>


<footer class="rodape1">
  <div class="banner1"></div>
  <div class="container1">
    <div class="coluna1 rodape1-imagem">
      <a href="IndexUsuario.php" class="logo"><img src="Personalização do site/TopLevelLogo.webp" alt="toplevellogo" align="center"></a>
      <h1>TopLevel</h1>
    </div>
    <div class="coluna1">
      <h3>Produtos</h3>
      <ul>
        <a href="games.html" class="linkb1">Games</a><br></br>
        <a href="Consoles.html" class="linkb1">Consoles</a><br></br>
        <a href="controles.html" class="linkb1">Controles</a><br></br>
        <a href="Acessórios.html" class="linkb1">Acessórios</a><br></br>
      </ul>
    </div>
    <div class="coluna1">
      <h3>Loja</h3>
      <ul>
        <p>Rua xxx, 000 - xxxxxxxxxx<br> Guarapuava- PR, 0000-000</br></p>
        <p>Seg. a Sex.: 9:00 às 20:00<br></br></p>
        <p>toplevel@gmail.com<br></br></p>
        <p>(42) 0000-0000<br></br></p>
      </ul>
    </div>
    <div class="coluna1">
      <h3>Políticas</h3>
      <ul>
        <a href="Termos e Condições.html" class="linkb1">Termos e Condições</a><br></br>
        <a href="Política de Envio.html" class="linkb1">Política de Envio</a><br></br>
        <a href="Política de Reembolso.html" class="linkb1">Política de Reembolso</a><br></br>
        <a href="Política de Privacidade.html" class="linkb1">Política de Privacidade</a><br></br>
        <a href="Política de Cookies.html" class="linkb1">Política de Cookies</a><br></br>
        <a href="contato.html" class="linkb1">FAQ</a><br></br>
      </ul>
    </div>
  </div>
</footer>

<footer class="rodape2">
  <div class="banner"></div>
  <div class="container2">
    <div class="coluna2 rodape2-imagem">
      <h4>Participe da comunidade</h4>
      <a href="#" class="logo"><img src="Personalização do site/Facebooklink.webp" alt="fblogo"></a>
      <a href="#" class="logo"><img src="Personalização do site/instagram-logo.webp" alt="iglogo"></a>
      <a href="#" class="logo"><img src="Personalização do site/tiktok-logo.webp" alt="ttlogo"></a>
      <a href="#" class="logo"><img src="Personalização do site/youtube-logo.webp" alt="ytlogo"></a>
      <ul>
        <p>© 2023 por TopLevel.<br></p>
      </ul>
    </div>
    <div class="coluna2">
      <ul>
        <li>Estimativa de entrega 2 - 5 dias úteis</li>
      </ul>
    </div>
    <div class="coluna2">
      <h3>Métodos de pagamento</h3>
      <a class="logo"><img src="Personalização do site/fromadepagamento.webp" alt="pagamento"></a>
    </div>
  </div>
</footer>
<script>
        let itemCount = 0;

        function addItemToCart() {
            itemCount++;
            document.querySelectorAll('.cart-count').forEach(element => {
                element.textContent = itemCount;
            });
        }

        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
        }

        //nav do sair
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


        var search = document.getElementById('pesquisar');

        search.addEventListener("keydown", function(event) {
            if (event.key === "Enter")  
            {
                searchData();
            }
        });

      function searchData() 
      {
          window.location = 'sistema.php?search='+search.value;
      }


    </script>
<script src="assents/js/Global.js"></script>
</body>
</html>
