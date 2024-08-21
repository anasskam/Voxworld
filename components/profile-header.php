<header class="dashboard-header">
  <h3>Hi, <?php echo htmlspecialchars($username);?></h3>
  <?php 
    include 'themeToggle.php'
  ?>

  <script>
    document.addEventListener("DOMContentLoaded", ()=>{
      document.querySelector(".dashboard-header").style.height = 
      `${document.querySelector(".side-bar-header").getBoundingClientRect().height +1}px`
    })
  </script>

</header>