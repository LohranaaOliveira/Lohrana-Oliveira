<?php
@include 'config.php';

session_start(); 

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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="Personalização do site/TopLevelLogo.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="assents/css/Global.css">
  <link rel="stylesheet" href="assents/css/Contato.css">
  <link rel="stylesheet" href="assents/css/user.css">
  <title>Contato</title>
</head>
<style>
.message {
  padding: 15px;
  border-radius: 5px;
  color: #fff; 
  font-size: 16px;
  display: none; 
}

.success {
  background-color: #4CAF50; 
}

.error {
  background-color: #f44336; 
}
</style>

<body>
  <div class="textos5">
    <h1>QUER AJUDA?</h1>
  </div>

  <div class="container">
    <aside>
      <h1>Fale conosco</h1> 
      <br>
      <p>toplevelbrasil@gmail.com</p>
      <p>(42) 0000-0000</p>
      <p>Rua xxx, 000 - xxxxxxxxxx<br>
        Guarapuava- PR, 0000-000</p>
    </aside>

    <div class="container3">
  <form id="contatoForm">
    <label>Avaliação:</label>
    <div class="rating">
      <input type="radio" id="star5" name="rating" value="5" required />
      <label for="star5" class="fas fa-star"></label>
      
      <input type="radio" id="star4" name="rating" value="4" required />
      <label for="star4" class="fas fa-star"></label>
      
      <input type="radio" id="star3" name="rating" value="3" required />
      <label for="star3" class="fas fa-star"></label>
      
      <input type="radio" id="star2" name="rating" value="2" required />
      <label for="star2" class="fas fa-star"></label>
      
      <input type="radio" id="star1" name="rating" value="1" required />
      <label for="star1" class="fas fa-star"></label>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col">
          <label for="nome">Nome:</label>
          <input type="text" id="nome" name="nome" required>
        </div>
        <div class="col">
          <label for="sobrenome">Sobrenome:</label>
          <input type="text" id="sobrenome" name="sobrenome" required>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col">
          <label for="email">E-mail:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="col">
        <label for="telefone">Telefone</label>
        <input type="tel" id="telefone" name="telefone" required value="<?php echo isset($telefone) ? htmlspecialchars($telefone) : ''; ?>" maxlength="15">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="mensagem">Mensagem:</label>
      <textarea id="mensagem" name="mensagem" required></textarea>
    </div>

    <input type="submit" value="Enviar">
  </form>

  <!-- Elemento para exibir a mensagem de sucesso ou erro -->
  <div id="message" style="display:none; margin-top: 10px;" class="message"></div>
</div>



  </div>
  <?php include 'rodape.php'; ?> 

  </style>

<script>
document.getElementById('contatoForm').addEventListener('submit', function(event) {
  event.preventDefault(); 

  const formData = new FormData(this);

  fetch('enviar.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(result => {
    const messageElement = document.getElementById('message');
    messageElement.innerHTML = result;

    if (result.includes("sucesso")) {
      messageElement.className = "message success";
    } else {
      messageElement.className = "message error"; 
    }

    messageElement.style.display = 'block';

    setTimeout(() => {
      messageElement.style.display = 'none';
    }, 5000);
  })
  .catch(error => {
    console.error('Erro ao enviar o formulário:', error);
  });
});


document.addEventListener("DOMContentLoaded", function() {
    const telefoneInput = document.getElementById('telefone');

    telefoneInput.placeholder = "( )"; 

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
