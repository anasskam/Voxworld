import { hoverIn, hoverOut, setRoute } from './routingHandler.js'

const allNavs = document.querySelectorAll(".main-header ul li");

allNavs.forEach(item => {
  item.addEventListener("mouseenter", () => {hoverIn(allNavs, item, 'active-nav')});
  item.addEventListener("mouseleave", () => {hoverOut(allNavs, 'active-nav')});
})

const route = window.location.search;
const from = route.indexOf('=');

document.addEventListener("load", setRoute(route.slice(from+1), allNavs, 'active-nav'));
