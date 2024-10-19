let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');
};

window.onscroll = () =>{
   menu.classList.remove('fa-times');
   navbar.classList.remove('active');
};


document.querySelector('#close-edit').onclick = () =>{
   document.querySelector('.edit-form-container').style.display = 'none';
   window.location.href = 'admin.php';
};







window.sr = ScrollReveal({ reset: true});

sr.reveal('.textos', { duration: 2000 });

sr.reveal('.image-container-wrapper', { duration: 2000 });

sr.reveal('.newsletter-box', { duration: 2000 });

sr.reveal('.t5', { duration: 2000 });

let slideIndex = 0;
let slideInterval;


// Seleciona os botões e o campo de input
const decrementButton = document.querySelector('.decrement');
const incrementButton = document.querySelector('.increment');
const quantityInput = document.getElementById('quantity');

// Função para incrementar o valor
incrementButton.addEventListener('click', function () {
    let currentValue = parseInt(quantityInput.value);
    let maxValue = parseInt(quantityInput.max);
    if (currentValue < maxValue) {
        quantityInput.value = currentValue + 1;
    }
});

// Função para decrementar o valor
decrementButton.addEventListener('click', function () {
    let currentValue = parseInt(quantityInput.value);
    let minValue = parseInt(quantityInput.min);
    if (currentValue > minValue) {
        quantityInput.value = currentValue - 1;
    }
});






function showSlides(n) {
    let slides = document.getElementsByClassName("slide");
    let dots = document.getElementsByClassName("dot");
    let totalSlides = slides.length;

    if (n >= totalSlides) {
        slideIndex = 0;
    }
    if (n < 0) {
        slideIndex = totalSlides - 1;
    }

    let slideWidth = slides[0].offsetWidth;
    document.querySelector(".slides").style.transform = `translateX(${-slideIndex * slideWidth}px)`;

    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    if (dots[slideIndex]) {
        dots[slideIndex].className += " active";
    }
}

function plusSlides(n) {
    slideIndex += n;
    let slides = document.getElementsByClassName("slide");
    if (slideIndex >= slides.length) slideIndex = 0;
    if (slideIndex < 0) slideIndex = slides.length - 1;
    showSlides(slideIndex);
    resetSlideInterval(); 
}

function currentSlide(n) {
    slideIndex = n;
    showSlides(slideIndex);
    resetSlideInterval(); 
}

function startSlideInterval() {
    slideInterval = setInterval(() => {
        plusSlides(1);
    }, 3000); 
}

function resetSlideInterval() {
    clearInterval(slideInterval);
    startSlideInterval(); 
}

function setupDots() {
    let slides = document.getElementsByClassName("slide");
    let dotsContainer = document.querySelector(".dots");

    for (let i = 0; i < slides.length; i++) {
        let dot = document.createElement("span");
        dot.className = "dot";
        dot.onclick = () => currentSlide(i);
        dotsContainer.appendChild(dot);
    }
}

showSlides(slideIndex);
setupDots();
startSlideInterval();

function exibirBalaoMensagem() {
    const balaoMensagem = document.getElementById('balao-mensagem');
    balaoMensagem.style.display = 'block';

    setTimeout(function () {
        balaoMensagem.style.display = 'none';
    }, 3000);
}






function addItemToCart() {
            itemCount++;
            document.querySelectorAll('.cart-count').forEach(element => {
                element.textContent = itemCount;
            });
        }

        function openNav() {
    const sidebar = document.getElementById("mySidebar");
    sidebar.style.width = "350px"; // A largura que você deseja
    sidebar.style.height = "100%"; // Isso ajusta para a altura desejada
    sidebar.style.opacity = "1"; // Mostra a barra lateral
    sidebar.style.transition = "width 0.5s ease, opacity 0.5s ease"; // Transição suave para abrir
}

function closeNav() {
    const sidebar = document.getElementById("mySidebar");
    sidebar.style.width = "0"; // Fecha a barra lateral
    sidebar.style.opacity = "0"; // Faz o fade out
}

        //nav do sair
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
