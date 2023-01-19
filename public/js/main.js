document.addEventListener("DOMContentLoaded", function (event) {
    document.querySelectorAll("span.show").forEach(function (el) {
        el.addEventListener("click", function (e) {
            if (el.innerHTML == "+") {
                el.nextElementSibling.style.display = "block";
                el.innerHTML = "-";
            } else if (el.innerHTML == "-") {
                el.nextElementSibling.style.display = "none";
                el.innerHTML = "+";
            }
        })
    })

    document.querySelectorAll(".node-section h2").forEach(function (el) {
        el.addEventListener("click", function (e) {
            el.parentElement.querySelector(".description").classList.toggle('show');
        })
    })
});