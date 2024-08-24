const app = () => {
  // for dashborad
  const dashboradContent = document.querySelector('.dashboard-container main');
  const dashboradSideBar = document.querySelector('.dashboard-container .side-bar');
  const sideBarUl = dashboradSideBar.querySelector('ul');

  const sideBarlinks = sideBarUl.querySelectorAll('li a p');

  if(window.innerWidth <= 768) {

    sideBarUl.children[0].append(sideBarUl.children[1])

    sideBarlinks.forEach(p => {
      p.style.display = 'none';
    })
  }
}

document.addEventListener('DOMContentLoaded', app);