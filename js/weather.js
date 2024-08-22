const url = 'https://api.weatherapi.com/v1/current.json?key=924c0c66bb46476a8b403157242208&q=Rabat';

let weatherStatus = document.querySelector('.weather-status .status');
let weatherTemp = document.querySelector('.weather-status .temp');
let weatherDate = document.querySelector('.weather-location .weather-date');
let weatherLoc = document.querySelector('.weather-location .location span');

async function app() {
  const req = await fetch(url);
  const data = await req.json();

  weatherStatus.textContent = data.current.condition.text;
  weatherTemp.textContent = `${data.current.temp_c} °C`;
  weatherLoc.textContent = data.location.name;

  let date = new Date(0);
  date.setUTCSeconds(data.location.localtime_epoch);
  const options = { year: 'numeric', month: 'short', day: 'numeric' };
  weatherDate.textContent = date.toLocaleDateString('en-US', options);
}

document.addEventListener("DOMContentLoaded", app)