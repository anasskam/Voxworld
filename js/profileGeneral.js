const app = () => {
  const button = document.querySelector('.cta button');
  button.disabled = true;

  const fname = document.querySelector('.fname-input input');
  const lname = document.querySelector('.lname-input input');
  const email = document.querySelector('.email-input input');

  const fields = [fname, lname, email];
  const currentValues = [fname.value, lname.value, email.value];

  fields.forEach((field, index) => {
    field.addEventListener('input', () => {
      field.setAttribute('data-changed', (field.value !== currentValues[index]) ? true : false);
      button.disabled = checkForChange(fields) ? false : true;
    })

  })

  const checkForChange = (fields) => {

    for(let i = 0; i < fields.length; i++) {
      if(fields[i].getAttribute('data-changed') === 'true') {
        return true;
      }
    }
    return false;
  }
}


document.addEventListener("DOMContentLoaded", app);