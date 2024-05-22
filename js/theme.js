const logo = document.querySelector(".logo");
const toggleIcons = document.querySelectorAll(".theme-icons");
const themeToggleIcon = document.querySelector(".theme-toggle-icon");

const theme = () =>{
  const storedTheme = localStorage.getItem("theme");
  const is_BrowserThemeDark = window.matchMedia('(prefers-color-scheme:dark)').matches;
  const initTheme = storedTheme ?? (is_BrowserThemeDark? "dark" : "light")
  document.documentElement.setAttribute("data-theme", initTheme);
  logo.src = initTheme === "dark" ? "../assets/images/logo-dark.svg" : "../assets/images/logo-light.svg";
  toggleIcon(initTheme);

}

const toggleTheme = () =>{
  const currentTheme = document.documentElement.getAttribute("data-theme");
  const newTheme = currentTheme === 'light' ? 'dark' : 'light';
  document.documentElement.setAttribute("data-theme", newTheme);
  logo.src = newTheme === "dark" ? "../assets/images/logo-dark.svg" : "../assets/images/logo-light.svg";
  toggleIcon(newTheme);
  localStorage.setItem('theme', newTheme);

}

const toggleIcon = (theme) =>{

  toggleIcons.forEach(icon =>{
    if(icon.getAttribute('data-icon') === theme) 
      icon.classList.add('active-icon')
    
    else
      icon.classList.remove('active-icon')
  })
}

//set init theme
document.addEventListener("DOMContentLoaded", theme);

//toggle theme
themeToggleIcon.addEventListener("click", toggleTheme);

