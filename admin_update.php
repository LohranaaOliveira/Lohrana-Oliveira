<?php

@include 'config.php';

$id = $_GET['edit'];

if (isset($_POST['update_product'])) {
    $product_name = $_POST['product_name'];

    // Substitui vírgulas por pontos para conversão correta para float
    $product_price = str_replace(',', '.', $_POST['product_price']);
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/' . $product_image;

    $promotion = isset($_POST['promotion']) ? 1 : 0;
    $previous_price = isset($_POST['previous_price']) ? str_replace(',', '.', $_POST['previous_price']) : null;
    $product_category = $_POST['product_category'];

    // Valida se os preços são numéricos após a substituição
    if (empty($product_name) || empty($product_price) || !is_numeric($product_price) || empty($product_image) || empty($product_category)) {
        $message[] = 'Por favor, preencha todos os campos corretamente';
    } else {
        // Verifica se previous_price é válido
        if ($previous_price !== null && !is_numeric($previous_price)) {
            $message[] = 'Preço anterior deve ser um número válido';
        } else {
            $update_data = "UPDATE products SET name='$product_name', price='$product_price', image='$product_image', promotion='$promotion', previous_price='$previous_price', category='$product_category' WHERE id = '$id'";
            
            $upload = mysqli_query($conn, $update_data);

            if ($upload) {
                move_uploaded_file($product_image_tmp_name, $product_image_folder);
                header('location:admin_page.php');
            } else {
                $message[] = 'Não foi possível atualizar o produto';
            }
        }
    }
}

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
    <title>Atualizar Produto</title>
</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '<span class="message">' . $message . '</span>';
    }
}
?>

<div class="container">

    <div class="admin-product-form-container centered">

        <?php
        $select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
        while ($row = mysqli_fetch_assoc($select)) {
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <h3 class="title">Atualizar Produto</h3>
            <input type="text" class="box" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>" placeholder="Insira o nome do produto" required>
            <input type="text" class="box" name="product_price" value="<?php echo number_format($row['price'], 2, ',', '.'); ?>" placeholder="Insira o preço do produto" required>
            <input type="file" class="box" name="product_image" accept="image/png, image/jpeg, image/jpg" required>
            
            <div>
                <input type="checkbox" id="promotion" name="promotion" <?php echo $row['promotion'] ? 'checked' : ''; ?> onclick="togglePreviousPrice()">
                <label for="promotion">Produto em promoção</label>
            </div>

            <div id="previous_price_field" style="display: <?php echo $row['promotion'] ? 'block' : 'none'; ?>;">
                <input type="text" placeholder="Insira o preço anterior" name="previous_price" class="box" value="<?php echo $row['previous_price'] ? number_format($row['previous_price'], 2, ',', '.') : ''; ?>">
            </div>

            <select name="product_category" class="box" required>
                <option value="">Selecione a categoria</option>
                <option value="Games" <?php echo $row['category'] == 'Games' ? 'selected' : ''; ?>>Games</option>
                <option value="Consoles" <?php echo $row['category'] == 'Consoles' ? 'selected' : ''; ?>>Consoles</option>
                <option value="Controles" <?php echo $row['category'] == 'Controles' ? 'selected' : ''; ?>>Controles</option>
                <option value="Acessórios" <?php echo $row['category'] == 'Acessórios' ? 'selected' : ''; ?>>Acessórios</option>
            </select>

            <input type="submit" value="Atualizar produto" name="update_product" class="btn">
            <a href="admin_page.php" class="btn">Voltar</a>
        </form>

        <?php }; ?>

    </div>

</div>

<script>
    function togglePreviousPrice() {
        var promotionCheckbox = document.getElementById('promotion');
        var previousPriceField = document.getElementById('previous_price_field');
        previousPriceField.style.display = promotionCheckbox.checked ? 'block' : 'none';
    }
</script>

</body>
</html>
