const commentsWrapper = document.querySelector('.comments-wrapper');

const colors = ['--clr-error-400', '--clr-primary', '--clr-success', '--clr-warning'];

document.addEventListener("DOMContentLoaded", ()=> {
  const imageWrapper = document.querySelectorAll('.comment-wrapper .comment-img');

  imageWrapper.forEach(image => {
    const randIndex = Math.floor(Math.random() * colors.length);
    image.style.backgroundColor = `var(${colors[randIndex]})`;
  })
})