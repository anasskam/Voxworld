const commentsWrapper = document.querySelector('.comments-wrapper');

const colors = ['--clr-error-400', '--clr-primary', '--clr-success', '--clr-warning'];

//TEST: delete latter
// const commentTemplate = `
// <div class="comment-wrapper">
                  
// <div class="comment-img">
//   <img src="./assets/icons/user2.svg" alt="comment user image">
// </div>

// <div class="comment-content-wrapper">
  
//   <div class="comment-header">
//     <p class="text-body2">Anas karmoua</p>
//     <span class="bullet"></span>
//     <p class="text-caption1 opacity-half">Mar 20, 2024 23:14</p>
//   </div>

//   <div class="comment-content text-button">
//     For athletes, high altitude produces two contradictory effects on performance. For explosive events,Physiological respiration involves the mechanisms that ensure that the composition of the functional,Physical space is often conceived in three linear dimensions, although modern physicists usually con
//   </div>
// </div>

// </div>
// `

// const commentNumber = 7;

// for(let i = 0 ; i< commentNumber; i++) {
//   commentsWrapper.innerHTML += commentTemplate;
// }

document.addEventListener("DOMContentLoaded", ()=> {
  const imageWrapper = document.querySelectorAll('.comment-wrapper .comment-img');

  imageWrapper.forEach(image => {
    const randIndex = Math.floor(Math.random() * colors.length);
    image.style.backgroundColor = `var(${colors[randIndex]})`;
  })
})