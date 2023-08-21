
let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}

const carousel2 = document.querySelector(".carousel2");
firstImg=carousel2.querySelectorAll("img")[0];
const arrowIcons = document.querySelectorAll(".wrapper i");


let isDragStart = false, prevPageX, prevScrollLeft ;
let firstImgWidth =firstImg.clientWidth + 10; 

arrowIcons.forEach(icon => {
    icon.addEventListener("click", () =>{
        carousel2.scrollLeft +=icon.id=="left" ? -firstImgWidth : firstImgWidth ; 
    } );
});

const dragStart = (e) => {
    isDragStart = true ;
    prevPageX = e.pageX || e.touches[0].pageX;
    prevScrollLeft = carousel2.scrollLeft; // Changed 'carousel' to 'carousel2'
}

const dragging = (e) => {
    if (!isDragStart) return;
    e.preventDefault();
    let positionDiff = (e.pageX || e.touches[0].pageX) - prevPageX; // Removed unnecessary semicolon
    carousel2.scrollLeft = prevScrollLeft - positionDiff; // Changed 'carousel' to 'carousel2'
}

const dragStop = () => {
  isDragStart = false;
}
carousel2.addEventListener("mousedown", dragStart);
carousel2.addEventListener("touchstart", dragStart);



carousel2.addEventListener("mousemove", dragging);
carousel2.addEventListener("touchmove", dragging);



carousel2.addEventListener("mouseup", dragStop);
carousel2.addEventListener("mouseleave", dragStop);
carousel2.addEventListener("touchend", dragStop);



    