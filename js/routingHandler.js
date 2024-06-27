export function hoverIn(items, it, className){
  items.forEach(item => {
    item.classList.remove(className, 'smooth' );
  })
  
  it.classList.add(className, 'smooth');
}

export function hoverOut(items, className){
  items.forEach(item => {
    if(item.hasAttribute("data-active-item")) 
      item.classList.add(className, "smooth");

    else item.classList.remove(className, "smooth");
 
  })

}

export function setRoute(items, className, from){
  const route = window.location.pathname.slice(from, -4) || 'index';

  items.forEach(item => {

    if(route === item.getAttribute("data-relation")) {
      item.setAttribute("data-active-item",'');
      item.classList.add(className);
    }
  })
}