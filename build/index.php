<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../build/css/style.css">
    <title>Bootstrap demo</title>
  </head>
  <body>

    <?php include 'navbar.html'; ?>
    <?php include 'header.html'; ?>

<?php include 'aboutus.html'; ?>

<section id="news" class="news-section">
  <div class="container mt-5 news-section-bg position-relative">
    <h2 class="mb-4 text-center">News</h2>
    <div class="row align-items-center">
      <!-- Carousel -->
      <div class="col px-0">
        <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
          <!-- Carousel indicators -->
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          </div>
          <div class="carousel-inner">

    
            <div class="carousel-item active">
              <div class="row">
                <div class="col-md-4">
                  <div class="card">
                    <img src="../build/img/news1.jpg" class="card-img-top" alt="ERC Grants">
                    <div class="card-body">
                      <h5 class="card-title">Oxford Researchers Awarded ERC Advanced Grants</h5>
                      <p class="card-text">Top researchers at Oxford receive prestigious funding from the European Research Council.</p>
                      <a href="https://www.ox.ac.uk/news/2025-06-17-oxford-academics-awarded-european-research-council-advanced-grants-cutting-edge" target="_blank" class="btn btn-primary">Read More</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <img src="../build/img/news-rahul.jpg" class="card-img-top" alt="Computer Science Grant">
                    <div class="card-body">
                      <h5 class="card-title">Prof. Rahul Santhanam Receives ERC Grant</h5>
                      <p class="card-text">Awarded for groundbreaking work in computational complexity theory at Oxford CS.</p>
                      <a href="https://www.cs.ox.ac.uk/news/2452-full.html" target="_blank" class="btn btn-primary">Read More</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <img src="../build/img/news3.webp" class="card-img-top" alt="Big Data Grant">
                    <div class="card-body">
                      <h5 class="card-title">Oxford Big Data Institute Secures Two ERC Grants</h5>
                      <p class="card-text">Researchers at BDI receive funding for pioneering studies in genomics and health data.</p>
                      <a href="https://www.bdi.ox.ac.uk/news/professor-peter-visscher-is-awarded-a-european-research-council-advanced-grant" target="_blank" class="btn btn-primary">Read More</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
              <div class="row">
                <div class="col-md-4">
                  <div class="card">
                    <img src="../build/img/news4.webp" class="card-img-top" alt="Neuroscience Obesity Research">
                    <div class="card-body">
                      <h5 class="card-title">Prof. Ana Domingos Receives ERC Funding</h5>
                      <p class="card-text">Awarded for research on neural control of fat metabolism with no heart risk.</p>
                      <a href="https://www.dpag.ox.ac.uk/news/professor-ana-domingos-one-of-seven-oxford-academics-awarded-european-research-council-advanced-grants" target="_blank" class="btn btn-primary">Read More</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <img src="../build/img/news5.jpg" class="card-img-top" alt="Biology Grant">
                    <div class="card-body">
                      <h5 class="card-title">Prof. Stu West Among ERC Grant Winners</h5>
                      <p class="card-text">Recognized for his outstanding research in evolutionary biology.</p>
                      <a href="https://www.biology.ox.ac.uk/article/congratulations-to-professor-stu-west-awarded-an-erc-advanced-grant" target="_blank" class="btn btn-primary">Read More</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <img src="../build/img/news6.png" class="card-img-top" alt="Pathology Grant">
                    <div class="card-body">
                      <h5 class="card-title">Sir Herman Waldmann Receives ERC Grant</h5>
                      <p class="card-text">Funding supports pioneering work in immunology and tolerance mechanisms.</p>
                      <a href="https://www.path.ox.ac.uk/news-article/herman-waldmann-receives-european-research-council-erc-advanced-grant" target="_blank" class="btn btn-primary">Read More</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
            <!-- Carousel controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  <?php include 'footer.html'; ?>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script src="../bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Initialize Bootstrap dropdowns (if not already initialized)
    document.addEventListener('DOMContentLoaded', function () {
      var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
      dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl)
      })
    });
  </script>
  </body>
</html>