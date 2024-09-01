<?php
session_start();
$loginErro = '';

if(isset($_SESSION['login_erro'])) {
    $loginErro = $_SESSION['login_erro'];
    unset($_SESSION['login_erro']); 
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="mage/x-icon" href="Personalização do site\TopLevelLogo.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assents/css/forms.css">
    <title>Logar</title>
</head>

<body>
    <div class="container">
        <a href="index.html" class="close-button"><i class="fas fa-times"></i></a>
        <div class="textos">
            <h1>Login</h1>
            <p style="font-size: 18px; text-align: center;">Novo neste site? <a href="formulario Clientes.php"
                    class="linkb1">Registre-se</a></p>
        </div>
        <form id="loginForm" action="testelogin.php" method="POST">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Senha:</label>
                <div class="password-container">
                <input type="password" id="senha" name="senha" class="inputUser" required>
                <span class="toggle-password" onclick="togglePassword('senha')"><i class="fas fa-eye"></i></span>
            </div>
            </div>
            <p style="font-size: 10 px;"><a href="redefinir-senha.html" class="linkb2">Esqueceu a senha?</a></p>

            <div class="error" id="error"></div>

            <input type="submit" name="submit" id="submit">
        </form>
    </div>

    <script>
        function togglePassword(id) {
            var input = document.getElementById(id);
            var icon = input.nextElementSibling.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        const loginErro = "<?php echo $loginErro; ?>";
        if (loginErro) {
            alert(loginErro);
        }
    
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            if (loginErro) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
