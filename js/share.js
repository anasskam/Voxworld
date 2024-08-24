const app = () => {


  function copyToClip(input, button) {
    input.select();
    input.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(input.value);
    button.textContent = 'Copied';
    setTimeout(() => {
      button.textContent = 'Copy';
    }, 1000);
  }

  // const postUrl = encodeURIComponent(window.location.href); // URL encode
  const postUrl = window.location.href; // URL encode
  const postTitle = encodeURIComponent(document.querySelector('.home-post-title').textContent); // Encode title

  const popup = document.createElement('div');
  const popupWrapper = document.createElement('div');

  const shareBtn = document.getElementById('share-button')
  const closeBtn = document.createElement('button');

  closeBtn.innerHTML = `
  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9.16998 14.83L14.83 9.17004" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M14.83 14.83L9.16998 9.17004" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`

  popup.classList.add('share-popup');
  popupWrapper.classList.add('share-popup-wrapper', 'hide')

  const template = `
    <button class="ghost-btn share-icon">
      <img src="./assets/icons/facebook.svg" alt="Facebook" data-url="https://www.facebook.com/sharer/sharer.php?u=${postUrl}&quote=${postTitle}">
    </button>

    <button class="ghost-btn share-icon">
      <img src="./assets/icons/twitter.svg" alt="Twitter" data-url="https://twitter.com/intent/tweet?url=${postUrl}&text=${postTitle}">
    </button>

    <button class="ghost-btn share-icon">
      <img src="./assets/icons/linkedin.svg" alt="LinkedIn" data-url="https://www.linkedin.com/shareArticle?mini=true&url=${postUrl}&title=${postTitle}">
    </button>`

  popup.innerHTML = `
    <div class='popup-header'>
      <h3>Share post</h3>
    </div>
    <div class="popup-social-wrapper">
      <p>Share this link via</p>
      <div class="social-media-icons">
        ${template}
      </div>
    </div>

    <div class="popup-copy-wrapper">
      <p>Or copy link</p>
      <div class="popup-copy">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M13.0601 10.9399C15.3101 13.1899 15.3101 16.8299 13.0601 19.0699C10.8101 21.3099 7.17009 21.3199 4.93009 19.0699C2.69009 16.8199 2.68009 13.1799 4.93009 10.9399" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M10.59 13.4099C8.24996 11.0699 8.24996 7.26988 10.59 4.91988C12.93 2.56988 16.73 2.57988 19.08 4.91988C21.43 7.25988 21.42 11.0599 19.08 13.4099" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <input value="${postUrl}" readonly>
        <button class="copy-btn primary-btn">Copy</button>
      </div>
    </div>

  `
  popup.querySelector('.popup-header').appendChild(closeBtn);

  popupWrapper.append(popup);
  document.body.append(popupWrapper);

  shareBtn.addEventListener('click', (e)=> {
    e.preventDefault();

    popupWrapper.classList.remove('hide');
    document.body.style.overflow = 'hidden';

    setTimeout(() => {
      popupWrapper.style.opacity = 1;
    }, 1);

  })

  closeBtn.addEventListener('click', ()=> {
    document.body.style.overflow = 'visible';
    popupWrapper.style.opacity = 0;
    setTimeout(() => {
      popupWrapper.classList.add('hide');
    }, 501);
    
  })

  const icons = document.querySelectorAll('.share-icon')
  icons.forEach(icon => {
    icon.addEventListener('click', (e) => {
      window.open(e.target.getAttribute('data-url'));
    })
  })

  //copy to clipboard
  const copyBtn = popup.querySelector('.copy-btn');
  const input = popup.querySelector('input');

  copyBtn.addEventListener('click', ()=> {
    copyToClip(input, copyBtn);
  })

}


document.addEventListener('DOMContentLoaded', app)




