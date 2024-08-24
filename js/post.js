function getTwoChars(name) {
  return name.textContent.split(" ").map((word, index) => {
    if(index < 2) {
      return word.charAt(0);
    }
  }).join("");
}

document.addEventListener("DOMContentLoaded", () => {
  const names = document.querySelectorAll('.commentator');
  const targets = document.querySelectorAll('.comment-img p');

  targets.forEach((target, index) => {
    target.textContent = getTwoChars(names[index]);
  })
})