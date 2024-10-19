<script>
    document.addEventListener('DOMContentLoaded', function() {
        const incrementButton = document.querySelector('.increment');
        const decrementButton = document.querySelector('.decrement');
        const quantityInput = document.getElementById('quantity');
        const cartIcon = document.querySelector('.cart-icon'); 



        const search = document.getElementById('pesquisar');
        if (search) {
            search.addEventListener("keydown", function(event) {
                if (event.key === "Enter") {
                    searchData();
                }
            });

            function searchData() {
                window.location = 'sistema.php?search=' + search.value;
            }
        }

        if (cartIcon) {
            cartIcon.addEventListener('click', function() {
                openNav(); 
            });
        }
    });

    function openNav() {
        const sidebar = document.getElementById("mySidebar");
        if (sidebar) {
            sidebar.style.width = "350px"; 
            sidebar.style.height = "100%"; 
            sidebar.style.opacity = "1"; 
            sidebar.style.transition = "width 0.5s ease, opacity 0.5s ease"; 
        }
    }

    function closeNav() {
        const sidebar = document.getElementById("mySidebar");
        if (sidebar) {
            sidebar.style.width = "0"; 
            sidebar.style.opacity = "0"; 
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); 

                const cartItemId = this.getAttribute('data-id'); 
                const itemElement = this.closest('.product'); 

                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'remove_item.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function() {
                    if (this.status === 200) {
                        itemElement.remove();
                    }
                };

                xhr.send('cart_item_id=' + cartItemId);
            });
        });
    });

document.addEventListener('DOMContentLoaded', function () {
    function updateSubtotal() {
        fetch('update_cart.php') 
            .then(response => response.text())
            .then(data => {
                document.querySelector('.subtotal span').innerHTML = data;
            });
    }

    document.querySelectorAll('.quantity-input button').forEach(button => {
        button.addEventListener('click', function () {
            setTimeout(updateSubtotal, 100); 
        });
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('data-id');
            fetch('update_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `delete_item=1&delete_item_id=${id}`
            }).then(() => updateSubtotal());
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const quantityForms = document.querySelectorAll('.quantity-input form');

    quantityForms.forEach(form => {
        const decrementButton = form.querySelector('.decrement');
        const incrementButton = form.querySelector('.increment');
        const quantityInput = form.querySelector('.quantityblock');
        const maxQuantity = 10;
        const minQuantity = 1;

        decrementButton.addEventListener('click', function(event) {
            event.preventDefault();
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > minQuantity) {
                quantityInput.value = currentQuantity - 1;
                updateQuantity(form);
            }
        });

        incrementButton.addEventListener('click', function(event) {
            event.preventDefault();
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity < maxQuantity) {
                quantityInput.value = currentQuantity + 1;
                updateQuantity(form);
            }
        });
    });

    function updateQuantity(form) {
        const productId = form.querySelector('input[name="update_quantity_id"]').value;
        const newQuantity = form.querySelector('.quantityblock').value;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (this.status === 200) {
                updateSubtotal(); 
            }
        };

        xhr.send(`update_quantity_id=${productId}&update_quantity=${newQuantity}`);
    }

    function updateSubtotal() {
        fetch('update_cart.php') 
            .then(response => response.text())
            .then(data => {
                document.querySelector('.subtotal span').innerHTML = data;
            });
    }
});

document.addEventListener('DOMContentLoaded', () => {
  const minPriceInput = document.getElementById('minPrice');
  const maxPriceInput = document.getElementById('maxPrice');
  const minPriceLabel = document.getElementById('minPriceLabel');
  const maxPriceLabel = document.getElementById('maxPriceLabel');
  const filterButton = document.getElementById('filterButton');
  const productContainer = document.getElementById('productContainer');

  function updatePriceLabels() {
    const minPrice = parseFloat(minPriceInput.value).toFixed(2);
    const maxPrice = parseFloat(maxPriceInput.value).toFixed(2);
    minPriceLabel.textContent = `R$ ${minPrice.replace('.', ',')}`;
    maxPriceLabel.textContent = `R$ ${maxPrice.replace('.', ',')}`;
  }

  function filterProducts() {
    const minPrice = minPriceInput.value;
    const maxPrice = maxPriceInput.value;

    fetch(`filter_products.php?min_price=${minPrice}&max_price=${maxPrice}`)
      .then(response => response.json())
      .then(data => {
        productContainer.innerHTML = ''; 

        data.products.forEach(product => {
          const productElement = document.createElement('div');
          productElement.classList.add('image-container1');
          productElement.innerHTML = `
            <div class="image-wrapper">
              <img src="uploaded_img/${product.image}" alt="">
              ${product.promotion ? '<span class="promo-tag">Promoção</span>' : ''}
            </div>
            <h3 class="image-text">${product.name}</h3>
            <div class="image-text2">
              ${product.previous_price ? '<span style="text-decoration: line-through;">R$ ' + product.previous_price.toFixed(2).replace('.', ',') + '</span> ' : ''}
              <span>R$ ${product.price.toFixed(2).replace('.', ',')}</span>
            </div>
            <div class="cart-container">
              <a href="cart.php" class="buy-now-bubble">Comprar Agora</a>
              <input type="hidden" name="product_name" value="${product.name}">
              <input type="hidden" name="product_price" value="${product.price}">
              <input type="hidden" name="product_image" value="${product.image}">
              <button class="cart-icon" type="submit" name="add_to_cart">
                <i class="fas fa-cart-plus"></i>
              </button>
            </div>
          `;
          productContainer.appendChild(productElement);
        });
      });
  }

  minPriceInput.addEventListener('input', updatePriceLabels);
  maxPriceInput.addEventListener('input', updatePriceLabels);
  filterButton.addEventListener('click', filterProducts);

  updatePriceLabels();
});


function toggleCategories() {
      const categoriesDiv = document.getElementById('categories');
      categoriesDiv.classList.toggle('collapsed');

      const icon = document.querySelector('.categories-expand-btn i');
      if (categoriesDiv.classList.contains('collapsed')) {
        icon.classList.remove('fa-minus');
        icon.classList.add('fa-plus');
      } else {
        icon.classList.remove('fa-plus');
        icon.classList.add('fa-minus');
      }
    }


    document.addEventListener('DOMContentLoaded', function () {

    function togglePrice() {
      const priceDiv = document.getElementById('price');
      priceDiv.classList.toggle('collapsed');

      const icon = document.querySelector('.price-expand-btn i');
      if (priceDiv.classList.contains('collapsed')) {
        icon.classList.remove('fa-minus');
        icon.classList.add('fa-plus');
      } else {
        icon.classList.remove('fa-plus');
        icon.classList.add('fa-minus');
      }
    }

});


function addItemToCart() {
            itemCount++;
            document.querySelectorAll('.cart-count').forEach(element => {
                element.textContent = itemCount;
            });
        }
    

function openNav() {
    const sidebar = document.getElementById("mySidebar");
    sidebar.style.width = "350px"; 
    sidebar.style.height = "100%"; 
    sidebar.style.opacity = "1"; 
    sidebar.style.transition = "width 0.5s ease, opacity 0.5s ease"; 
}

function closeNav() {
    const sidebar = document.getElementById("mySidebar");
    sidebar.style.width = "0"; 
    sidebar.style.opacity = "0"; 
}

        document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtn = document.querySelector('.dropdown-btn');
            const dropdownContent = document.querySelector('.dropdown-content');

            dropdownBtn.addEventListener('click', function() {
                dropdownContent.classList.toggle('show');
            });

            document.addEventListener('click', function(event) {
                if (!dropdownBtn.contains(event.target)) {
                    dropdownContent.classList.remove('show');
                }
            });
        });


        var search = document.getElementById('pesquisar');

        search.addEventListener("keydown", function(event) {
            if (event.key === "Enter")  
            {
                searchData();
            }
        });

      function searchData() 
      {
          window.location = 'sistema.php?search='+search.value;
      }


</script>
