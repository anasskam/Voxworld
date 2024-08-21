const cardTemplate = `
<div class="card">
  <a href="#">
    <img src="../assets/images/test.jpg" alt="" class="post-img">
    <div class="card-content">
      <div class="post-category-date">
        <span class="chip1 category text-caption1">Health</span>
        <span class="divider"></span>
        <p class="text-caption1 post-date">May 8, 2024 19:28</p>
      </div>

      <h3 class="text-md home-post-title">Japan bread recalled after 'rat remains' found inside loaves</h3>
      <div class="divider horizontal"></div>
      <div class="post-intractions-wrapper">
        <div class="post-likes-wrapper post-intraction-wrapper text-caption1">

          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13 11L21.2 2.79999" stroke="#FEA843" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M22 6.8V2H17.2" stroke="#FEA843" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M11 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V13" stroke="#FEA843" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>

          <span class="post-likes" name="post-likes">Preview</span>
        </div>

        <div class="post-likes-wrapper post-intraction-wrapper text-caption1">
          <img src="../assets/icons/bookmark_filled.svg" alt="bookmark icon">
          <span class="post-likes" name="post-likes">Read later</span>
        </div>

      </div>

    </div>

  </a>

</div>
`

const cardsWrapper = document.querySelector(".cards-wrapper");

for(let i = 0 ; i < 8; i++) {
  cardsWrapper.innerHTML += cardTemplate;
}