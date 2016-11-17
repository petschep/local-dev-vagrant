
slides = document.querySelectorAll('#slides .slide');
currentSlide = 0;
ms = 3000;
slideInterval = setInterval(nextSlide,ms);

function nextSlide() {
    slides[currentSlide].className = 'slide';
    currentSlide = (currentSlide+1)%slides.length;
    slides[currentSlide].className = 'slide showing';
}

function prevSlide() {
    slides[currentSlide].className = 'slide';
    currentSlide = (currentSlide-1)%slides.length;
    slides[currentSlide].className = 'slide showing';
}

function triggerNext(){
	clearInterval(slideInterval);
	nextSlide();
}
function triggerPrev(){
	clearInterval(slideInterval);
	prevSlide();
}
function pauseSlide(){
	alert('pause');
	clearInterval(slideInterval);
}
function playSlide(){
	alert('play');
	slideInterval = setInterval(nextSlide,ms);
}
