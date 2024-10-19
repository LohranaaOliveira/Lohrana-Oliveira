<?php

@include 'config.php';

session_start();

$logado = $_SESSION['email'];

$telefone = ""; 

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT telefone FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        $telefone = $user['telefone']; 
    }
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

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $query = "SELECT nome FROM usuarios WHERE email = '$email' LIMIT 1"; 
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nomeUsuario = $row['nome'];
    } 
} else {
    $nomeUsuario = 'Visitante';
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
            <li class="desative"><a href="Meus_endereços.php">Meus endereços</a></li>
            <li class="active"><a href="user.php">Minha conta</a></li>
        </ul>
    </nav>

    <section class="account-info">
        <h2>Conta</h2>
        <p>Veja e edite suas informações pessoais.</p>
<hr>
        <form id="personal-info-form" method="POST" action="alterar_dados.php">
    <h3>Informações pessoais</h3>
    <label for="first-name">Nome</label>
    <input type="text" id="first-name" name="name" value="<?php echo isset($nomeUsuario) ? htmlspecialchars($nomeUsuario) : ''; ?>" required>
    
    <label for="telefone">Telefone</label>
    <input type="tel" id="telefone" name="telefone" required value="<?php echo isset($telefone) ? htmlspecialchars($telefone) : ''; ?>" maxlength="15">



    <div class="buttons">
        <button type="submit" id="update">Atualizar</button>
    </div>
</form>

<hr>
        <form id="login-info-form">
            <h3>Informações de login</h3>
            <p>Email: <span id="email-display"><?php echo htmlspecialchars($logado); ?></span></p>
            <button class="alterar" type="button" id="change-email">Alterar email</button>
            <button class="alterar" type="button" id="change-password">Alterar senha</button>
        </form>
    </section>
</div>

<?php include 'cartsidebar.php'; ?>

<script>

    
    document.addEventListener("DOMContentLoaded", function() {
    const telefoneInput = document.getElementById('telefone');

    telefoneInput.placeholder = "(xx) xxxxx-xxxx"; 

    document.querySelector('label[for="telefone"]').addEventListener('click', function() {
        telefoneInput.focus(); 
    });

    telefoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); 

        if (value.length > 10) {
            value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3'); 
        } else if (value.length > 6) {
            value = value.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3'); 
        } else if (value.length > 2) {
            value = value.replace(/^(\d{2})(\d+)$/, '($1) $2'); 
        }

        e.target.value = value; 
    });
});

telefoneInput.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, ''); 

    if (value.length > 10) {
        value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3'); 
    } else if (value.length > 6) {
        value = value.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3'); 
    } else if (value.length > 2) {
        value = value.replace(/^(\d{2})(\d+)$/, '($1) $2'); 
    }

    e.target.value = value; 
});


</script>
</body>
</html>
