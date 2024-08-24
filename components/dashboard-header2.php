<header class="dashboard-header">
  <h3>Dashboard</h3>
  <div class="cta margin-0">
      <button class="primary-btn full flex flex-align-center full-rounded header-btn publish-header-btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M7.4 6.32L15.89 3.49C19.7 2.22 21.77 4.3 20.51 8.11L17.68 16.6C15.78 22.31 12.66 22.31 10.76 16.6L9.92 14.08L7.4 13.24C1.69 11.34 1.69 8.23 7.4 6.32Z" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M10.11 13.65L13.69 10.06" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Publish
      </button>

  </div>

  <script>
    document.addEventListener("DOMContentLoaded", ()=>{
      setTimeout(() => {
        document.querySelector(".dashboard-header").style.height = 
      `${document.querySelector(".side-bar-header").getBoundingClientRect().height +1}px`
      },);

    })
  </script>

</header>