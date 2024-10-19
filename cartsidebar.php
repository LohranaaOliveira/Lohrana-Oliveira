<div id="mySidebar" class="sidebar">
      <div class="sidebar-header">
          <button class="closebtn" onclick="closeNav()">
              <i class="fas fa-chevron-right"></i> 
          </button>
          <h2>Carrinho</h2>
      </div>

      <div class="sidebar-content">
          <?php 
          $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
          $grand_total = 0;
          if (mysqli_num_rows($select_cart) > 0) {
              while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                  $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                  $grand_total += $sub_total;
          ?>
          <div class="product">
              <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="Produto" height="100">
              <div class="product-details">
                  <h3><?php echo $fetch_cart['name']; ?></h3>
                  <p class="price">R$ <?php echo number_format($fetch_cart['price'], 2, ',', '.'); ?></p>
                  <div class="quantity-input">
                      <form action="" method="post">
                          <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                          <button type="submit" name="decrement" class="decrement">-</button>
                          <input type="number" name="update_quantity" class="quantityblock" min="1" max="10" value="<?php echo $fetch_cart['quantity']; ?>">
                          <button type="submit" name="increment" class="increment">+</button>
                      </form>
                  </div>
              </div>
              <a href="#" class="delete-btn" data-id="<?php echo $fetch_cart['id']; ?>">
                  <i class="fas fa-trash"></i>
              </a>
          </div>
          <?php 
              }
          } else {
              echo "<p>Carrinho vazio</p>";
          }
          ?>
      </div>

      <div class="subtotal-container">
          <div class="subtotal">
              <p>Subtotal: <br><span>R$ <?php echo number_format($grand_total, 2, ',', '.'); ?></span></p>
          </div>
          <hr>
          <a href="cart.php" class="checkout">Ver Carrinho</a>
      </div>
  </div>

  <tr class="table-bottom">
          
      </td>
  </tr>
        </div>
        </div>

       
