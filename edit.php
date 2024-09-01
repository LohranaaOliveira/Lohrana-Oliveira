<?php

    if(!empty($_GET['id']))
    {
    
        include_once('config.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $nome = $user_data['nome'];
                $senha = $user_data['senha'];
                $email = $user_data['email'];
                $telefone = $user_data['telefone'];
                $sexo = $user_data['sexo'];
                $data_nasc = $user_data['data_nasc'];
                $cidade = $user_data['cidade'];
                $estado = $user_data['estado'];
                $endereco = $user_data['endereco'];
            } 
        }
        else
        {
            header('Location sistema.php');
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="mage/x-icon" href="Personalização do site\TopLevelLogo.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assents/css/forms.css">
    <!--<link rel="stylesheet" href="assents/css/formulario.css">-->
    <title>Cadastro</title>
    
</head>
<body>
<div class="container">
        <form action="saveEdit.php" method="POST">
            <fieldset>
            <a href="sistema.html" class="close-button"><i class="fas fa-times"></i></a>
            <h1>Registre-se</h1>
            <p style="font-size: 18px; text-align: center;">Já é um membro? <a href="login.php" class="linkb1">Login</a> </p>
                <div class="inputBox">
                <label for="nome" class="labelInput">Nome completo</label>
                    <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo $nome ?>" required>
                </div>
                <div class="inputBox">
                
                <div class="inputBox">
                <label for="email" class="labelInput">Email</label>
                    <input type="text" name="email" id="email" class="inputUser" value="<?php echo $email ?>" required>
                   
                </div>
                <label for="genero">Gênero</label>
                <select id="genero" name="genero" required>
                    <option value="">Selecione</option>
                    <option value="masculino" <?php echo ($sexo == 'masculino') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="feminino" <?php echo ($sexo == 'feminino') ? 'selected' : ''; ?>>Feminino</option>
                    <option value="outro" <?php echo ($sexo == 'outro') ? 'selected' : ''; ?>>Gamer</option>
                </select>

                
                <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" value="<?php echo $data_nasc ?>" required>

                <label for="senha" class="labelInput">senha</label>
                <div class="password-container">
                    <input type="password" name="senha" id="senha" class="inputUser" required oncopy="return false;" onpaste="return false;" value="<?php echo $senha ?>">
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
                <label for="politica_privacidade">Eu concordo com a <a href="Política de Privacidade.html">política de privacidade</a></label>
            </div>
            <br>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="submit" name="update" id="update">
            </fieldset>
        </form>
    </div>]

    <script src="assents/js/cadastro.js"></script>
</body>
</html>