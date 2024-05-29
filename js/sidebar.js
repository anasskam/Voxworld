const allListItems = document.querySelectorAll(".side-bar li");

allListItems.forEach(item => {
  item.addEventListener("mouseenter", () => {hoverIn(item)});
  item.addEventListener("mouseleave", hoverOut);
})


function hoverIn(i){
  allListItems.forEach(item => {
    item.classList.remove("active", "smooth");
  })
  i.classList.add("active", "smooth");

}

function hoverOut(){
  allListItems.forEach(item => {
    if(item.hasAttribute("data-active-item"))
      item.classList.add("active", "smooth");
    else
      item.classList.remove("active", "smooth");
  })

}


function setRouting(){
  const route = window.location.pathname.slice(20,-4);
  allListItems.forEach(item => {
    if(route === item.getAttribute("data-relation")) {
      item.setAttribute("data-active-item",'');
      item.classList.add("active");
    }
  })
}

document.addEventListener("load", setRouting());
