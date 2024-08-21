import { theme } from "./theme.js";

const logos = document.querySelectorAll(".logo");
const toggleIcons = document.querySelectorAll(".theme-icons");

// for auth pages
const themeToggleIcon_auth = document.querySelector(".theme-toggle-icon"); 

// for settings page
const themeToggleIcon_settings = document.querySelectorAll(".appearence-option-wrapper");

const toggleIcon = (icons, theme) =>{

  icons.forEach(icon =>{
    if(icon.getAttribute('data-icon') === theme) 
      icon.classList.add('active-icon')
    
    else
      icon.classList.remove('active-icon')
  })
}

const toggleLogo = (theme) => {
  const currentLocation = location.pathname;
  let logoSrc;

  if(currentLocation === '/Voxworld/index.php' || 
  currentLocation === '/Voxworld/post.php' || 
  currentLocation === '/Voxworld/category.php' || 
  currentLocation === '/Voxworld/search.php' ||
  currentLocation === '/Voxworld/') {
    logoSrc = theme === "dark" ? "./assets/images/logo-dark.svg" : "./assets/images/logo-light.svg";
  } 

  else {
    logoSrc = theme === "dark" ? "../assets/images/logo-dark.svg" : "../assets/images/logo-light.svg";
  }

  return logoSrc;
}

const toggleTheme = (e, mode = null) => {
  const currentTheme = document.documentElement.getAttribute("data-theme");
  const newTheme = mode ?? (currentTheme === 'light' ? 'dark' : 'light');
  document.documentElement.setAttribute("data-theme", newTheme);
  
  logos.forEach(logo => {
    logo.src = toggleLogo(newTheme);
  })
  toggleIcon(toggleIcons, newTheme);
  toggleIcon(themeToggleIcon_settings, newTheme);
  localStorage.setItem('theme', newTheme);
}


if(themeToggleIcon_auth) {
  themeToggleIcon_auth.addEventListener("click", (e) => {toggleTheme(e)});
}

if(themeToggleIcon_settings[0]){
  themeToggleIcon_settings[0].addEventListener("click", (e) => {toggleTheme(e, "light")});
  themeToggleIcon_settings[1].addEventListener("click", (e) => {toggleTheme(e, "dark")});
}

//set init theme
document.addEventListener("DOMContentLoaded", theme);