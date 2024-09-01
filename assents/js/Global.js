let slideIndex = 0;
let slideInterval;

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


let itemCount = 0;

function addItemToCart() {
    itemCount++;
    document.querySelectorAll('.cart-count').forEach(element => {
        element.textContent = itemCount;
    });
}

function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
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

