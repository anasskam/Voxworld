import { hoverIn, hoverOut, setRoute } from './routingHandler.js'

const allListItems = document.querySelectorAll(".side-bar li");

allListItems.forEach(item => {
  item.addEventListener("mouseenter", () => {hoverIn(allListItems, item, 'active')});
  item.addEventListener("mouseleave", () => {hoverOut(allListItems, 'active')});
})

document.addEventListener("load", setRoute(allListItems, 'active', 20));
