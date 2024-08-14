const templatePost = `
<a class="post-wrapper" href="#">
  <div class="image-content-wrapper">
  <!-- post image -->
      <img src="../assets/images/test.jpg" alt="post image">

      <div class="post-content">
          <p class="text-body1 text-md">The unseen of spending three years at Pixelgrade...</p>

          <div class="post-category-date">
              <span class="chip1 category text-caption1">Politics</span>
              <span class="divider"></span>
              <p class="text-button post-date">
              Feb 2, 2024 19:28 <span> (Updated: Feb 4, 2024 20:51)  </span>
              </p>
          </div>

          <div class="post-intractions-wrapper">
              <div class="post-views-wrapper post-intraction-wrapper">
                  <img src="../assets/icons/show-pass.svg" alt="views">
                  <span class="post-views text-button" name="post-views">2,423</span>views
              </div>

              <div class="post-likes-wrapper post-intraction-wrapper">
                  <img src="../assets/icons/like.svg" alt="likes">
                  <span class="post-likes text-button" name="post-likes">215</span>likes
              </div>

              <div class="post-comments-wrapper post-intraction-wrapper">
                  <img src="../assets/icons/comment.svg" alt="views">
                  <span class="post-comments text-button" name="post-comments">6</span>comments
              </div>
          </div>
      </div>
  </div>
</a>
`

const templateComment = `
<div class="comment-wrapper overview-comment">
<a class="comment-body" href="#">
    <div class="comment-img">
    <img src="../assets/icons/user2.svg" alt="comment user image">
    </div>
    
    <div class="comment-content-wrapper">
    
    <div class="comment-header">
        <p class="text-body2">Abdessamad Bih</p>
        <span class="bullet"></span>
        <p class="text-caption1 opacity-half">Mar 20, 2024 23:14</p>
    </div>

    <div class="comment-content text-button">Physiological respiration involves the mechanisms that ensure that the composition of the functional...</div>
    </div>
</a>
</div>
`

const wrapperPosts = document.querySelector(".overview-posts-wrapper");
const wrapperComments = document.querySelector(".overview-comments-wrapper");


for(let i = 0 ; i < 4; i++) {
  wrapperPosts.innerHTML += templatePost;
  wrapperComments.innerHTML += templateComment;
}