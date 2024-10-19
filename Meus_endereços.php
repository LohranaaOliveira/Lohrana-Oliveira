<?php
@include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cep'])) {
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $numero = (int)$_POST['numero']; 
    $bairro = $_POST['bairro'];
    $cidade = $_POST['city'];
    $estado = $_POST['state'];
    $usuario_email = $_SESSION['email'];

    if ($cep && $endereco && $numero && $bairro && $cidade && $estado) {
        $query = "UPDATE usuarios SET cep = ?, endereco = ?, numero = ?, bairro = ?, cidade = ?, estado = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        
        $stmt->bind_param("ssssiss", $cep, $endereco, $numero, $bairro, $cidade, $estado, $usuario_email);$stmt->bind_param("sssssss", $cep, $endereco, $numero, $bairro, $cidade, $estado, $usuario_email);


        if ($stmt->execute()) {
            echo "Endereço adicionado com sucesso!";
        } else {
            echo "Erro ao adicionar endereço: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}



$logado = $_SESSION['email'] ?? '';

$telefone = ""; 

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT telefone FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $user = $result->fetch_assoc();
        $telefone = $user['telefone']; 
    }
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $query = "SELECT nome FROM usuarios WHERE email = ? LIMIT 1"; 
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
        $nomeUsuario = $row['nome'];
    } 
} else {
    $nomeUsuario = 'Visitante';
}


if (isset($_SESSION['email'])) {
    if ($_SESSION['email'] === 'toplevelbrasil@gmail.com') {
        include 'headeradm.php';
    } else {
        include 'headeruser.php';
    }
} else {
    include 'header.php';
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Minha Conta</title>
</head>
<body>

<div class="containeruser">
    <div class="header">
        <div class="profile-picture">
            <img src="Personalização do site/user.jpg" alt="User Avatar">
        </div>
        <div class="username">
            <h2><?php echo htmlspecialchars($nomeUsuario); ?></h2>
        </div>
    </div>

    <nav class="menu">
        <ul>
            <li class="desative"><a href="Meus_pedidos.php">Meus pedidos</a></li>
            <li class="active"><a href="Meus_endereços.php">Meus endereços</a></li>
            <li class="desative"><a href="user.php">Minha conta</a></li>
        </ul>
    </nav>

<?php

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT endereco, numero, bairro, cidade, estado FROM usuarios WHERE email = ?"; 
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<section class="account-info">';
        echo '<h2>Meus Endereços</h2>';
        echo '<p>Adicione e gerencie os endereços que você usa com frequência.</p>';
        echo '<hr>';

        while ($endereco = mysqli_fetch_assoc($result)) {
            echo '<div class="endereco-item">';
            echo '<p>' . htmlspecialchars($endereco['endereco']) . ', ' . htmlspecialchars($endereco['numero']) . ', ' . htmlspecialchars($endereco['bairro']) . ', ' . htmlspecialchars($endereco['cidade']) . ' - ' . htmlspecialchars($endereco['estado']) . '</p>';
            echo '<button class="endereco"> Alterar endereço </button>'; 
        }

        echo '</section>';
    } else {
        echo '<section class="account-info">';
        echo '<h2>Meus Endereços</h2>';
        echo '<p>Adicione e gerencie os endereços que você usa com frequência.</p>';
        echo '<hr>';
        echo '<div class="pedidos">';
        echo '<p>Você ainda não salvou nenhum endereço.</p>';
        echo '<button class="endereco">Adicionar novo endereço</button>';
        echo '</div>';
        echo '</section>';
    }
} else {
    echo '<p>Você precisa estar logado para ver seus endereços.</p>'; 
} ?>

    <div class="modal" id="modalEndereco" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <h2>Adicionar Novo Endereço</h2>
            <hr>
            <form id="formEndereco" action="" method="POST">
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" maxlength="8" pattern="\d{8}" placeholder="00000000" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">

                <label for="endereco">Rua:</label>
                <input type="text" id="endereco" name="endereco" required>
                
                <label for="numero">Número:</label>
                <input type="text" id="numero" name="numero" placeholder="Número da casa" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                
                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" required>
                
                <div class="inputBox">
                    <span>Estado</span>
                    <select id="state" name="state" required>
                        <option value="" disabled selected>Selecione o estado</option>
                        <option value="SP">São Paulo</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="PR">Paraná</option>
                    </select> 
                </div>

                <div class="inputBox">
                <span>Cidade</span>
            <select id="city" name="city" required disabled>
            <option value="" disabled selected>Selecione a cidade</option>
        </select>
         </div>

                <button class="endereco" type="submit">Adicionar Endereço</button>
            </form>
        </div>
    </div>

    <script>
        function abrirModal() {
            document.getElementById("modalEndereco").style.display = "block";
        }
        function fecharModal() {
            document.getElementById("modalEndereco").style.display = "none";
        }

         document.querySelector('.endereco').onclick = function() {
                document.getElementById('modalEndereco').style.display = 'flex'; 
            };

            function fecharModal() {
                document.getElementById('modalEndereco').style.display = 'none'; 
            }

            window.onclick = function(event) {
                const modal = document.getElementById('modalEndereco');
                if (event.target === modal) {
                    fecharModal(); 
                }
            }

            document.getElementById('formEndereco').onsubmit = function(event) {
                event.preventDefault();
                
                const formData = new FormData(this);
                
                fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data); 
                    fecharModal(); 
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro ao salvar endereço. Tente novamente.');
                });
            };

            const citiesByState = {
                'SP': ['São Paulo', 'Campinas', 'Santos', 'Sorocaba'],
                'RJ': ['Rio de Janeiro', 'Niterói', 'Campos dos Goytacazes'],
                'MG': ['Belo Horizonte', 'Uberlândia', 'Juiz de Fora'],
                'ES': ['Vitória', 'Serra', 'Vila Velha'],
                'RS': ['Porto Alegre', 'Caxias do Sul', 'Pelotas'],
                'PR': ['Curitiba', 'Guarapuava', 'Londrina', 'Ponta Grossa']
            };

            document.getElementById('state').addEventListener('change', function() {
                const state = this.value;
                const citySelect = document.getElementById('city');
                
                citySelect.innerHTML = '<option value="" disabled selected>Selecione a cidade</option>';
                
                if (state && citiesByState[state]) {
                    citiesByState[state].forEach(function(city) {
                        const option = document.createElement('option');
                        option.value = city;
                        option.textContent = city;
                        citySelect.appendChild(option);
                    });
                    citySelect.disabled = false; 
                } else {
                    citySelect.disabled = true; 
                }
            });
    </script>
</body>
</html>
