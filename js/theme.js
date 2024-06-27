const logos = document.querySelectorAll(".logo");

// for auth pages
const toggleIcons = document.querySelectorAll(".theme-icons");

// for settings page
const themeToggleIcon_settings = document.querySelectorAll(".appearence-option-wrapper");

const initLogo = (theme) => {
  const currentLocation = location.pathname;
  let logoSrc;

    if(currentLocation === '/Voxworld/index.php' || 
      currentLocation === '/Voxworld/post.php' || 
      currentLocation === '/Voxworld/category.php' || 
      currentLocation === '/Voxworld/') {
      logoSrc = theme === "dark" ? "./assets/images/logo-dark.svg" : "./assets/images/logo-light.svg";
    } 

    else {
      logoSrc = theme === "dark" ? "../assets/images/logo-dark.svg" : "../assets/images/logo-light.svg";
    }
  
  return logoSrc;

}


export const theme = () =>{
  const storedTheme = localStorage.getItem("theme");
  const is_BrowserThemeDark = window.matchMedia('(prefers-color-scheme:dark)').matches;
  const initTheme = storedTheme ?? (is_BrowserThemeDark ? "dark" : "light")
  document.documentElement.setAttribute("data-theme", initTheme);
  logos.forEach(logo => {
    logo.src =  initLogo(initTheme);
  })
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