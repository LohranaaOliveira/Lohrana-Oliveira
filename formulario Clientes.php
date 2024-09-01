<?php

    if(isset($_POST['submit']))
    {
        include_once('config.php');

        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $sexo = $_POST['genero'];
        $data_nasc = $_POST['data_nascimento'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $endereco = $_POST['endereco'];

        $result = mysqli_query($conexao, "INSERT INTO usuarios(nome,senha,email,telefone,sexo,data_nasc,cidade,estado,endereco)
        VALUES ('$nome','$senha','$email','$telefone','$sexo','$data_nasc','$cidade','$estado','$endereco')");

        header('Location: login.php');
        exit();

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Personalização do site\TopLevelLogo.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assents/css/forms.css">
    <title>Cadastro</title>
</head>


<body>
<div class="container">
        <form action="formulario Clientes.php" method="POST">
            <fieldset>
            <a href="index.html" class="close-button"><i class="fas fa-times"></i></a>
            <h1>Registre-se</h1>
            <p style="font-size: 18px; text-align: center;">Já é um membro? <a href="login.php" class="linkb1">Login</a> </p>
                <div class="inputBox">
                <label for="nome" class="labelInput">Nome completo</label>
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                </div>
                <div class="inputBox">
                
                <div class="inputBox">
                <label for="email" class="labelInput">Email</label>
                    <input type="text" name="email" id="email" class="inputUser" required>
                   
                </div>
                <label for="genero">Gênero</label>
            <select id="genero" name="genero" required>
                <option value="">Selecione</option>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
                <option value="outro">Gamer</option>
            </select>
                
                <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" required>

                <label for="senha" class="labelInput">senha</label>
                <div class="password-container">
                    <input type="password" name="senha" id="senha" class="inputUser" required oncopy="return false;" onpaste="return false;">
                    <span class="toggle-password" onclick="togglePassword('senha')"><i class="fas fa-eye"></i></span>
                </div>

                <label for="confirma_senha" class="labelInput">Confirme a Senha</label>
                <div class="password-container">
                    <input type="password" name="confirma_senha" id="confirma_senha" class="inputUser" required oncopy="return false;" onpaste="return false;">
                    <span class="toggle-password" onclick="togglePassword('confirma_senha')">
                        <i class="fas fa-eye"></i></span>
                </div>

            <div class="privacy-policy">
                <input type="checkbox" id="politica_privacidade" name="politica_privacidade" required>
                <label for="politica_privacidade" >Eu concordo com a <a style="padding-left: 5px; color:blueviolet" href="Política de Privacidade.html">política de privacidade</></label>
</div>
                <input type="submit" name="submit" id="submit">
            </fieldset>
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

    function validarFormulario(event) {
        const senha = document.getElementById('senha').value;
        const confirmaSenha = document.getElementById('confirma_senha').value;
        const dataNascimento = document.getElementById('data_nascimento').value;

        const regexSenha = /^(?=.*\d)[a-zA-Z\d]{8,}$/;
        if (!regexSenha.test(senha)) {
            alert('A senha deve ter no mínimo 8 caracteres e incluir pelo menos um número.');
            event.preventDefault(); 
            return;
        }

        if (senha !== confirmaSenha) {
            alert('As senhas não coincidem.');
            event.preventDefault(); 
            return;
        }

        const hoje = new Date();
        const dataNasc = new Date(dataNascimento);
        const idadeMinima = 18;
        
        let idade = hoje.getFullYear() - dataNasc.getFullYear();

        if (hoje.getMonth() < dataNasc.getMonth() || 
            (hoje.getMonth() === dataNasc.getMonth() && hoje.getDate() < dataNasc.getDate())) {
            idade--;
        }

        if (idade < idadeMinima) {
            alert('Você deve ser maior de idade para se cadastrar.');
            event.preventDefault();
            return;
        }

    }

    document.querySelector('form').addEventListener('submit', validarFormulario);
</script>

</script>
    
</body>
</html>