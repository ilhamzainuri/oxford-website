<!-- Achievements Page -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Achievements - University of Oxford</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../build/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .achievements-bg {
      background-image: url('../build/img/bg2.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      padding: 80px 0;
      color: white;
      backdrop-filter: brightness(0.8);
    }

    .achievements-content {
      background-color: rgba(14, 74, 196, 0.65);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.4);
    }

    .achievements-content h2 {
      font-weight: bold;
      margin-bottom: 20px;
    }

    .icon-list i {
      margin-right: 10px;
      color: #ffc107;
    }

    .carousel-caption {
      background-color: rgba(0,0,0,0.6);
      padding: 1rem;
      border-radius: 10px;
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100 achievements-page">


  <?php include 'navbar.html'; ?>

  <main class="flex-fill">
    <section class="achievements-bg">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10 achievements-content">
            <h2>Achievements of the University of Oxford</h2>
            <p class="lead">
              Oxford is a global leader in education, innovation, and research, with numerous milestones that have made a lasting global impact.
            </p>
            <div id="achievementCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="../build/img/ach1.jpg" class="d-block w-100" alt="Oxford Vaccine">
                  <div class="carousel-caption">
                    <h5>Oxford–AstraZeneca COVID-19 Vaccine</h5>
                    <p>Developed in partnership with AstraZeneca, this vaccine has been distributed globally to combat the COVID-19 pandemic.</p>
                  </div>
                </div>
                <div class="carousel-item">
                  <img src="../build/img/ach2.jpg" class="d-block w-100" alt="Rhodes Scholarship">
                  <div class="carousel-caption">
                    <h5>Rhodes Scholarship</h5>
                    <p>Established in 1902, it is one of the world's most prestigious international scholarship programs.</p>
                  </div>
                </div>
                <div class="carousel-item">
                  <img src="../build/img/ach3.jpg" class="d-block w-100" alt="Nobel Prize Winners">
                  <div class="carousel-caption">
                    <h5>Over 70 Nobel Laureates</h5>
                    <p>Oxford alumni and faculty have received Nobel Prizes across disciplines including Medicine, Physics, and Economics.</p>
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#achievementCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#achievementCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <ul class="icon-list">
              <li><i class="fas fa-award"></i> Ranked #1 globally in the Times Higher Education World University Rankings for multiple years.</li>
              <li><i class="fas fa-brain"></i> Co-founded DeepMind, one of the leading AI research labs (acquired by Google).</li>
              <li><i class="fas fa-globe"></i> Hosts the Oxford Martin School, pioneering interdisciplinary research on global challenges.</li>
              <li><i class="fas fa-user-graduate"></i> Educated 30+ British Prime Ministers including Winston Churchill and Tony Blair.</li>
              <li><i class="fas fa-dna"></i> Leads in biomedical breakthroughs like gene therapy and cancer immunology research.</li>
              <li><i class="fas fa-seedling"></i> Oxford University Innovation has spun out over 300 technology companies.</li>
            </ul>
            <p class="mt-3">
              More info at: <a href="https://www.ox.ac.uk/about/oxford-people/oxford-awards" class="text-warning" target="_blank">ox.ac.uk/about/oxford-people/oxford-awards</a>
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include 'footer.html'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
