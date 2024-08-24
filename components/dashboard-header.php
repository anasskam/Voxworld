<header class="dashboard-header">
  <h3>Dashboard</h3>
  <div class="cta margin-0">
    <a href="../dashboard/createPost.php">
      <div class="primary-btn full flex flex-align-center full-rounded header-btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 12H20" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M12 20V4" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        New post
      </div>
    </a>
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