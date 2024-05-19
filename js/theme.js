const storedTheme = localStorage.getItem("theme");
const is_BrowserThemeDark = window.matchMedia('(prefers-color-scheme:dark)').matches;
const initTheme = storedTheme ?? (is_BrowserThemeDark? "dark" : "light")
document.documentElement.setAttribute("data-theme", initTheme);