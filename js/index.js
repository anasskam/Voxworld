const template = `
<div class="card">

  <a href="#">
      <img src="./assets/images/test.jpg" alt="">
      <div class="card-content">
          <div class="post-category-date">
              <span class="chip1 category text-caption1">Politics</span>
              <span class="divider"></span>
              <p class="text-caption1 post-date">Feb 2, 2024 19:28</p>
          </div>

          <h3 class="text-md home-post-title">Stormy Daniels Parries Trump Lawyer’s Attacks in Hush-Money Trial Testimony there is nothing to add here here err test.</h3>

          <div class="divider horizontal"></div>

          <div class="post-intractions-wrapper">
              <div class="post-views-wrapper post-intraction-wrapper text-caption1">
                  <img src="./assets/icons/show-pass.svg" alt="views">
                  <span class="post-views" name="post-views">2,423 </span>views
              </div>

              <div class="post-likes-wrapper post-intraction-wrapper text-caption1">
                  <img src="./assets/icons/like.svg" alt="likes">
                  <span class="post-likes" name="post-likes">215 </span>likes
              </div>

              <div class="post-comments-wrapper post-intraction-wrapper text-caption1">
                  <img src="./assets/icons/comment.svg" alt="views">
                  <span class="post-comments" name="post-comments">6 </span>comments
              </div>
          </div>
      </div>
  </a>
                    
</div>
`
const cardsWrapper = document.querySelector(".latest-news .cards-wrapper");

const cardNum = 12;

for(let i = 0 ; i < cardNum; i++) {
  cardsWrapper.innerHTML += template;
}