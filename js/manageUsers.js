//set the empty state illustration depends on the current theme
const pathOfDarkImg = "../assets/images/empty-state-dark.svg";
const pathOfLightImg = "../assets/images/empty-state-light.svg";

export function setEmptyImageTheme(darkImagePath, lightImagePath) {
  const emptyStateImgs = document.querySelectorAll(".empty-state-wrapper img");
  const currentTheme = document.documentElement.getAttribute("data-theme");

  emptyStateImgs.forEach(img => {
    img.src = currentTheme === "dark" ? darkImagePath : lightImagePath;
  })
}
document.addEventListener("DOMContentLoaded", () => {setEmptyImageTheme(pathOfDarkImg, pathOfLightImg)});