document.addEventListener("DOMContentLoaded", function() {
    window.flipCard = function(card){
        const inner = card.querySelector(".flip-inner");
        inner.classList.toggle("active");
    }
});