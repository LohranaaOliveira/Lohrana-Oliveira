<?php

@include 'config.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = str_replace(',', '.', $_POST['product_price']);
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   $promotion = isset($_POST['promotion']) ? 1 : 0;
   $previous_price = isset($_POST['previous_price']) ? str_replace(',', '.', $_POST['previous_price']) : null;

   $product_category = $_POST['product_category'];

   if(empty($product_name) || empty($product_price) || empty($product_image) || empty($product_category)){
      $message[] = 'Por favor, preencha todos os campos';
   } else {
      $insert = "INSERT INTO products (name, price, image, promotion, previous_price, category) VALUES ('$product_name', '$product_price', '$product_image', '$promotion', '$previous_price', '$product_category')";
      $upload = mysqli_query($conn, $insert);
      
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'Novo produto adicionado com sucesso';
      } else {
         $message[] = 'Não foi possível adicionar o produto';
      }
   }
}

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE id = $id");
   header('location:admin_page.php');
};

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="icon" type="image/x-icon" href="Personalização do site/TopLevelLogo.ico">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <link rel="stylesheet" href="assents/css/carrinho.css">
   <title>Pagina do administrador</title>
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}
?>

<div class="header-config">
    <a href="Index.php" class="logo"><img src="Personalização do site/TopLevelLogo2.webp" alt="logo" height="80" width="80" align="center">TopLevel</a>
</div>

<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Adicionar um novo produto</h3>
         <input type="text" placeholder="Insira o nome do produto" name="product_name" class="box" required>
         <input type="number" placeholder="Insira o preço do produto" name="product_price" class="box" step="0.01" required>
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box" required>

         <div>
            <input type="checkbox" id="promotion" name="promotion" onclick="togglePreviousPrice()">
            <label for="promotion">Produto em promoção</label>
         </div>

         <div id="previous_price_field" style="display: none;">
            <input type="text" placeholder="Insira o preço anterior" name="previous_price" class="box">
         </div>

         <select name="product_category" class="box" required>
            <option value="">Selecione a categoria</option>
            <option value="Games">Games</option>
            <option value="Consoles">Consoles</option>
            <option value="Controles">Controles</option>
            <option value="Acessórios">Acessórios</option>
         </select>

         <input type="submit" class="btn" name="add_product" value="Adicionar produto">
      </form>

   </div>

   <div class="product-display">
      <table class="product-display-table">
         <thead>
            <tr>
               <th>Imagem do produto</th>
               <th>Nome do produto</th>
               <th>Preço</th>
               <th>Categoria</th>
               <th>Ações</th>
            </tr>
         </thead>
         <?php
         $select = mysqli_query($conn, "SELECT * FROM products");
         while($row = mysqli_fetch_assoc($select)){ ?>
            <tr>
               <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
               <td><?php echo $row['name']; ?></td>
               <td>
                  <?php
                     if($row['promotion']){
                        echo '<span style="text-decoration: line-through; color: red;">R$ ' . number_format($row['previous_price'], 2, ',', '.') . '</span> ';
                        echo '<span>R$ ' . number_format($row['price'], 2, ',', '.') . '</span>';
                     } else {
                        echo 'R$ ' . number_format($row['price'], 2, ',', '.');
                     }
                  ?>
               </td>
               <td><?php echo $row['category']; ?></td>
               <td>
                  <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> Editar </a>
                  <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> Deletar </a>
               </td>
            </tr>
         <?php } ?>
      </table>
   </div>

</div>

<script>
   function togglePreviousPrice() {
      var promotionCheckbox = document.getElementById('promotion');
      var previousPriceField = document.getElementById('previous_price_field');
      if (promotionCheckbox.checked) {
         previousPriceField.style.display = 'block';
      } else {
         previousPriceField.style.display = 'none';
      }
   }
</script>

</body>
</html>
