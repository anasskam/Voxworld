
const theme = ()=>{
  const storedTheme = localStorage.getItem("theme");
  const is_BrowserThemeDark = window.matchMedia('(prefers-color-scheme:dark)').matches;
  const initTheme = storedTheme ?? (is_BrowserThemeDark? "dark" : "light")
  document.documentElement.setAttribute("data-theme", initTheme);
  const logo = document.querySelector(".logo");
  logo.src = initTheme == "dark" ? "../assets/images/logo-dark.svg" : "../assets/images/logo-light.svg";

}

document.addEventListener("DOMContentLoaded", theme);