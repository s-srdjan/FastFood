const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const welcomeDiv = document.querySelector(".welcome");
const navBranding = document.querySelector(".logo");
// const menuOverlay = document.querySelector(".menu-overlay");

hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navMenu.classList.toggle("active");
  welcomeDiv.classList.toggle("hide");
  navBranding.classList.toggle("front");
  // menuOverlay.classList.toggle("hide");
})

document.querySelectorAll(".nav-link").forEach( n => n.addEventListener("click", () => {
  hamburger.classList.remove("active");
  navMenu.classList.remove("active");
  // menuOverlay.classList.remove("hide");
}))