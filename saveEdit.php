<?php

    include_once('config.php');

    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $email = $_POST['email'];
        $sexo = $_POST['genero'];
        $data_nasc = $_POST['data_nascimento'];

        $sqlUpdate = "UPDATE usuarios SET nome='$nome',senha='$senha',email='$email',sexo='$sexo',data_nasc='$data_nasc'
        WHERE id='$id'";

        $result = $conexao->query($sqlUpdate);

    }
    header('Location: sistema.php');

?>