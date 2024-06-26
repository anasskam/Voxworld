import { hoverIn, hoverOut, setRoute } from './routingHandler.js'

const allNavs = document.querySelectorAll(".main-header ul li");

allNavs.forEach(item => {
  item.addEventListener("mouseenter", () => {hoverIn(allNavs, item, 'active-nav')});
  item.addEventListener("mouseleave", () => {hoverOut(allNavs, 'active-nav')});
})

document.addEventListener("load", setRoute(allNavs, 'active-nav', 10));
