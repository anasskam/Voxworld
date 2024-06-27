import { hoverIn, hoverOut, setRoute } from './routingHandler.js'

const allListItems = document.querySelectorAll(".side-bar li");

allListItems.forEach(item => {
  item.addEventListener("mouseenter", () => {hoverIn(allListItems, item, 'active')});
  item.addEventListener("mouseleave", () => {hoverOut(allListItems, 'active')});
})

const route = window.location.pathname.slice(20, -4);

document.addEventListener("load", setRoute(route, allListItems, 'active'));
