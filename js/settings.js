const dropContents = document.querySelectorAll(".dropContent");
const dropHeaders = document.querySelectorAll(".dropHeader");
const spacers = document.querySelectorAll(".spacer");



dropHeaders.forEach(header => {
  header.addEventListener("click", (e) =>{
    toggleDrop(e);
  })
})

function toggleDrop(e){
  dropContents.forEach(content =>{
    if(e.target.getAttribute("data-for") === content.getAttribute("data-for")){
      content.classList.toggle("expanded");
      if(content.classList.contains("expanded")){
        e.target.children[1].style.transform = 'rotate(90deg)';
        
        e.target.nextElementSibling.style.display = "block";
        
      }
      else{
        e.target.children[1].style.transform = 'rotate(0deg)';
        setTimeout(() => {
          e.target.nextElementSibling.style.display = "none";
          
        }, 245);
      }
    }
  })

}
// dropContent.classList.toggle("expanded");
// if(dropContent.classList.contains("expanded")){
//   dropArrow.style.transform = 'rotate(90deg)';
//   spacer.style.display= "block";
// }
// else{
//   dropArrow.style.transform = 'rotate(0deg)';
//   setTimeout(() => {
//     spacer.style.display= "none";
    
//   }, 245);

