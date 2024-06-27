import {setEmptyImageTheme} from './manageUsers.js'

const pathOfDarkImg = "./assets/images/empty-state-dark.svg";
const pathOfLightImg = "./assets/images/empty-state-light.svg";

//event listners
document.addEventListener("DOMContentLoaded", () => {setEmptyImageTheme(pathOfDarkImg, pathOfLightImg)});