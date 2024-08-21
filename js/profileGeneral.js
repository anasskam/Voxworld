const app = () => {
  
  const button = document.querySelector('.cta button');
  button.disabled = true;

  const fname = document.querySelector('.fname-input input');
  const lname = document.querySelector('.lname-input input');
  const email = document.querySelector('.email-input input');

  const fields = [fname, lname, email];
  const currentValues = [ fname.value, lname.value, email.value];

  fields.forEach((field, index) => {
    setDisable(field, button, currentValues[index])
  })

}

function setDisable(field, button, value) {
  field.addEventListener('input', () => {
    button.disabled = (field.value !== value) ? false : true;
  })
}

document.addEventListener("DOMContentLoaded", app);