const app = () => {
  //show & hide password toggle
  const toogleIcons = document.querySelectorAll(".password-toggle");

  toogleIcons.forEach(icon =>{
    icon.addEventListener("click", (e) => {
      e.preventDefault();
      tooglePassword(e);
    });
  })

  //set input focus
  const allInputs = document.querySelectorAll(".inputs input");
  allInputs[0].parentElement.classList.add("focus");
  allInputs[0].focus();

  allInputs.forEach((input) => {
    input.addEventListener("focus", (e) => {focusOnCurrentInput(e, allInputs)})
    input.addEventListener("blur", () => {removeAllfocuses(allInputs)})
  });

}

const tooglePassword = (e) => {

  const showIcon = `
    <path d="M15.58 12C15.58 13.98 13.98 15.58 12 15.58C10.02 15.58 8.41998 13.98 8.41998 12C8.41998 10.02 10.02 8.42001 12 8.42001C13.98 8.42001 15.58 10.02 15.58 12Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M12 20.27C15.53 20.27 18.82 18.19 21.11 14.59C22.01 13.18 22.01 10.81 21.11 9.4C18.82 5.8 15.53 3.72 12 3.72C8.47003 3.72 5.18003 5.8 2.89003 9.4C1.99003 10.81 1.99003 13.18 2.89003 14.59C5.18003 18.19 8.47003 20.27 12 20.27Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
  `;
    
  const hideIcon = `
    <path d="M9.46998 15.28C9.27998 15.28 9.08998 15.21 8.93998 15.06C8.11998 14.24 7.66998 13.15 7.66998 12C7.66998 9.61001 9.60998 7.67001 12 7.67001C13.15 7.67001 14.24 8.12001 15.06 8.94001C15.2 9.08001 15.28 9.27001 15.28 9.47001C15.28 9.67001 15.2 9.86001 15.06 10L9.99998 15.06C9.84998 15.21 9.65998 15.28 9.46998 15.28ZM12 9.17001C10.44 9.17001 9.16998 10.44 9.16998 12C9.16998 12.5 9.29998 12.98 9.53998 13.4L13.4 9.54001C12.98 9.30001 12.5 9.17001 12 9.17001Z" fill="currentcolor"/>
    <path d="M5.60003 18.51C5.43003 18.51 5.25003 18.45 5.11003 18.33C4.04003 17.42 3.08003 16.3 2.26003 15C1.20003 13.35 1.20003 10.66 2.26003 9.00001C4.70003 5.18001 8.25003 2.98001 12 2.98001C14.2 2.98001 16.37 3.74001 18.27 5.17001C18.6 5.42001 18.67 5.89001 18.42 6.22001C18.17 6.55001 17.7 6.62001 17.37 6.37001C15.73 5.13001 13.87 4.48001 12 4.48001C8.77003 4.48001 5.68003 6.42001 3.52003 9.81001C2.77003 10.98 2.77003 13.02 3.52003 14.19C4.27003 15.36 5.13003 16.37 6.08003 17.19C6.39003 17.46 6.43003 17.93 6.16003 18.25C6.02003 18.42 5.81003 18.51 5.60003 18.51Z" fill="currentcolor"/>
    <path d="M12 21.02C10.67 21.02 9.37 20.75 8.12 20.22C7.74 20.06 7.56 19.62 7.72 19.24C7.88 18.86 8.32 18.68 8.7 18.84C9.76 19.29 10.87 19.52 11.99 19.52C15.22 19.52 18.31 17.58 20.47 14.19C21.22 13.02 21.22 10.98 20.47 9.81C20.16 9.32 19.82 8.85 19.46 8.41C19.2 8.09 19.25 7.62 19.57 7.35C19.89 7.09 20.36 7.13 20.63 7.46C21.02 7.94 21.4 8.46 21.74 9C22.8 10.65 22.8 13.34 21.74 15C19.3 18.82 15.75 21.02 12 21.02Z" fill="currentcolor"/>
    <path d="M12.69 16.27C12.34 16.27 12.02 16.02 11.95 15.66C11.87 15.25 12.14 14.86 12.55 14.79C13.65 14.59 14.57 13.67 14.77 12.57C14.85 12.16 15.24 11.9 15.65 11.97C16.06 12.05 16.33 12.44 16.25 12.85C15.93 14.58 14.55 15.95 12.83 16.27C12.78 16.26 12.74 16.27 12.69 16.27Z" fill="currentcolor"/>
    <path d="M2 22.75C1.81 22.75 1.62 22.68 1.47 22.53C1.18 22.24 1.18 21.76 1.47 21.47L8.94 14C9.23 13.71 9.71 13.71 10 14C10.29 14.29 10.29 14.77 10 15.06L2.53 22.53C2.38 22.68 2.19 22.75 2 22.75Z" fill="currentcolor"/> 
    <path d="M14.53 10.22C14.34 10.22 14.15 10.15 14 10C13.71 9.71 13.71 9.23 14 8.94L21.47 1.47C21.76 1.18 22.24 1.18 22.53 1.47C22.82 1.76 22.82 2.24 22.53 2.53L15.06 10C14.91 10.15 14.72 10.22 14.53 10.22Z" fill="currentcolor"/>
  `;

  const previousElement = e.currentTarget.previousElementSibling;
  const type = previousElement.getAttribute("type");
  previousElement.setAttribute("type", (type === "password") ? "text" : "password");
  e.currentTarget.children[0].innerHTML = (type === "password") ? hideIcon : showIcon;

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
