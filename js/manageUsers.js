//set the empty state illustration depends on the current theme
const app = () =>{
  const emptyStateImg = document.querySelector(".empty-state-wrapper img");
  const currentTheme = document.documentElement.getAttribute("data-theme");

  emptyStateImg.src = currentTheme === "dark" ? "../assets/images/empty-state-dark.svg" :"../assets/images/empty-state-light.svg" ;
}

document.addEventListener("DOMContentLoaded", app);