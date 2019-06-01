window.onload = function() {
    const range = document.querySelector('#cells');
    const count = document.querySelector('#count');

    count.innerText = range.value;

    range.onchange = function (event) {
        count.innerText = event.target.value;
    }
};