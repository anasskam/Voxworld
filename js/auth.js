const app = () => {

  //show & hide password toggle
  const toogleIcon = document.querySelector(".password-toggle");
  const passwordInput = document.querySelector(".password");
  toogleIcon.addEventListener("click", () => {tooglePassword(passwordInput, toogleIcon)});


  //set input focus
  const allInputs = document.querySelectorAll(".inputs input");
  allInputs[0].parentElement.classList.add("focus");
  allInputs[0].focus();

  allInputs.forEach((input) => {
    input.addEventListener("focus", (e) => {focusOnCurrentInput(e, allInputs)})
    input.addEventListener("blur", () => {removeAllfocuses(allInputs)})
  })

}

const tooglePassword = (input, toogleBtn) => {
  const type = input.getAttribute("type");
  input.setAttribute("type", (type === "password" ? "text" : "password"));
  toogleBtn.src = (type === "password" ? "../assets/icons/hide-pass.svg" : "../assets/icons/show-pass.svg")
}

const focusOnCurrentInput = (e, inputs) => {
  removeAllfocuses(inputs);
  e.target.parentElement.classList.add("focus");
}

const removeAllfocuses = (inputs) => {
  inputs.forEach((input) => {
    input.parentElement.classList.remove("focus");
  })  
}


document.addEventListener("DOMContentLoaded", app);


