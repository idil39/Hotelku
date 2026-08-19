// ============================
// HOTEL ADIMULIA
// ============================

// Loader
const loader = document.getElementById("loader");

function hideLoader() {

    if (!loader) return;

    loader.style.opacity = "0";
    loader.style.visibility = "hidden";

    setTimeout(() => {

        loader.remove();

    }, 500);

}

window.onload = hideLoader;

// Backup jika window.onload gagal
setTimeout(hideLoader, 1500);

// Navbar
const navbar = document.querySelector(".navbar");

window.addEventListener("scroll", () => {

    if (!navbar) return;

    if (window.scrollY > 50) {

        navbar.classList.add("navbar-scrolled");

    } else {

        navbar.classList.remove("navbar-scrolled");

    }

});

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach(link => {

    link.addEventListener("click", function(e){

        const target = document.querySelector(this.getAttribute("href"));

        if(target){

            e.preventDefault();

            target.scrollIntoView({

                behavior:"smooth"

            });

        }

    });

});

// Back To Top
const backTop = document.getElementById("backToTop");

window.addEventListener("scroll",()=>{

    if(!backTop) return;

    if(window.scrollY>300){

        backTop.classList.add("show");

    }else{

        backTop.classList.remove("show");

    }

});

if(backTop){

    backTop.addEventListener("click",()=>{

        window.scrollTo({

            top:0,

            behavior:"smooth"

        });

    });

}