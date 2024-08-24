const app = () => {
  const searchBar = document.querySelector('.upper-header form');
  const navActions = document.querySelector('.upper-header .upper-header-actions');
  const navs = document.querySelector('.main-header nav');
  const themeBtn = document.querySelector('.upper-header-actions .theme-toggle-icon');
  const menuBtn = document.querySelector('.upper-header .menu-btn');

  const upperHeaderWrapper = document.querySelector('.upper-header');
  const mainHeader = document.querySelector('.main-header');

  //create a wrapper for theme toggle menu & menu btn
  const menuBtnsWrapper = document.createElement('div');
  const menuWrapper = document.createElement('div');

  //check for menu icon display
  if(window.innerWidth <= 768) {

    menuBtn.classList.remove('hide');
  
    menuWrapper.classList.add('menu-respo-wrapper', 'hide');
    menuBtnsWrapper.classList.add('menu-btns-wrarpper');

    menuBtnsWrapper.append(themeBtn, menuBtn);
    upperHeaderWrapper.append(menuBtnsWrapper);
  
    menuWrapper.append(searchBar, navs, navActions);
    mainHeader.append(menuWrapper);

    menuBtn.addEventListener('click', () => {
      if(menuBtn.getAttribute('data-state') === 'close') {
  
        menuWrapper.classList.remove('hide');
        setTimeout(() => {
          menuWrapper.style.right = '0%';
        }, 1);

        menuBtn.setAttribute('data-state', 'open');
  
      } else {
        menuWrapper.style.right = '-100%';
        setTimeout(() => {
          menuWrapper.classList.add('hide');
        }, 401);
  
        menuBtn.setAttribute('data-state', 'close');
  
      }
    })

  }

}

document.addEventListener('DOMContentLoaded', app);


