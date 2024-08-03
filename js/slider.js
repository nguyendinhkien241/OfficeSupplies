const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const slider = function() {
    const sliderList = $('.slider-list');
    const btnPrev = $('#slider-prev');
    const btnNext = $('#slider-next');
    const sliderItems = $$('.slider-item');
    const sliderDots = $$('.slider-dots li');

    let currentIndex = 0;
    const lengthItems = sliderItems.length - 1;


    btnNext.onclick = function() {
        if(currentIndex + 1 > lengthItems) {
            currentIndex = 0;
        } else {
            currentIndex++;
        }
        reloadSlider();
    }

    btnPrev.onclick = function() {
        if(currentIndex - 1 < 0) {
            currentIndex = lengthItems;
        } else {
            currentIndex--;
        }
        reloadSlider();
    }

    let refreshSlider = setInterval(() => {btnNext.click()}, 5000);
    
    function reloadSlider() {
        let checkLeft = sliderItems[currentIndex].offsetLeft;
        sliderList.style.left = -checkLeft + 'px';
        let lastActiveDot = $('.slider-dots li.active-slider');
        lastActiveDot.classList.remove('active-slider');
        sliderDots[currentIndex].classList.add('active-slider');
        clearInterval(refreshSlider);
        refreshSlider = setInterval(() => {btnNext.click()}, 5000);
    }

    sliderDots.forEach((li, index) => {
        li.addEventListener('click', function() {
            currentIndex = index;
            reloadSlider();
        })
    }) 
}

slider();