const app = () => {
  const button = document.querySelector('.cta button');
  const fname = document.querySelector('.fname-input input');
  const lname = document.querySelector('.lname-input input');
  const email = document.querySelector('.email-input input');

  document.addEventListener('change', ()=> {
    if(fname.value === "" || lname.value === "" || email.value === "") {
      button.disabled = true;
    } else {
      button.disabled = false;
    }
  })


}




document.addEventListener("DOMContentLoaded", app);