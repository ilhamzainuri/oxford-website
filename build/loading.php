  <div id="loadingSpinner" class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white" style="z-index: 2000; opacity: 0; transition: opacity 0.5s;">
    <img src="../build/img/logo.png" alt="Loading..." id="loadingLogo" style="width: auto; height: 100px;">
  </div>
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      const spinner = document.getElementById('loadingSpinner');
      if (spinner) {
        spinner.style.opacity = 1;
      }
    });
    window.addEventListener('load', function() {
      const spinner = document.getElementById('loadingSpinner');
      if (spinner) {
        spinner.style.opacity = 0;
        setTimeout(() => spinner.remove(), 500);
      }
    });
  </script>