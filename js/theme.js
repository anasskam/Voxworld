const logo = document.querySelector(".logo");

// for auth pages
const toggleIcons = document.querySelectorAll(".theme-icons");

// for settings page
const themeToggleIcon_settings = document.querySelectorAll(".appearence-option-wrapper");

export const theme = () =>{
  const storedTheme = localStorage.getItem("theme");
  const is_BrowserThemeDark = window.matchMedia('(prefers-color-scheme:dark)').matches;
  const initTheme = storedTheme ?? (is_BrowserThemeDark ? "dark" : "light")
  document.documentElement.setAttribute("data-theme", initTheme);
  logo.src = initTheme === "dark" ? "../assets/images/logo-dark.svg" : "../assets/images/logo-light.svg";
  toggleIcon(toggleIcons, initTheme);
  toggleIcon(themeToggleIcon_settings, initTheme);
}

const toggleIcon = (icons, theme) =>{

  icons.forEach(icon =>{
    if(icon.getAttribute('data-icon') === theme) 
      icon.classList.add('active-icon')
    
    else
      icon.classList.remove('active-icon')
  })
}

//set init theme
document.addEventListener("DOMContentLoaded", theme);