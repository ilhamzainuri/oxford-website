
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MPLS Division - University of Oxford</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../build/css/style.css">
  <style>
    .mpls-bg {
      background-image: url('../build/img/bg1.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      padding: 80px 0;
      color: white;
      backdrop-filter: brightness(0.8);
    }

    .mpls-content {
      background-color: rgba(14, 74, 196, 0.65);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.4);
    }

    .mpls-content h2 {
      font-weight: bold;
      margin-bottom: 20px;
    }

    .mpls-content ul {
      list-style-type: disc;
      padding-left: 20px;
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

  <?php include 'navbar.html'; ?>

  <main class="flex-fill">
    <section class="mpls-bg">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10 mpls-content">
            <h2>Mathematical, Physical and Life Sciences (MPLS) Division</h2>
            <p class="lead">
              The MPLS Division at Oxford is a global leader in scientific research and education, advancing knowledge across the natural sciences and mathematics.
            </p>
            <p>
              The division fosters interdisciplinary collaboration and cutting-edge research to address some of the world's most pressing challenges in science and technology.
            </p>
            <h4>Departments & Faculties:</h4>
            <ul>
              <li>Department of Computer Science</li>
              <li>Department of Chemistry</li>
              <li>Department of Earth Sciences</li>
              <li>Department of Engineering Science</li>
              <li>Department of Materials</li>
              <li>Department of Mathematics</li>
              <li>Department of Physics</li>
              <li>Department of Statistics</li>
              <li>Department of Plant Sciences</li>
              <li>Department of Zoology</li>
            </ul>
            <p>
              Research in MPLS ranges from theoretical mathematics to applied engineering and life sciences, supported by world-class laboratories and facilities.
            </p>
            <p>
              Learn more at: 
              <a href="https://mpls.ox.ac.uk" class="text-warning" target="_blank">mpls.ox.ac.uk</a>
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include 'footer.html'; ?>
    <?php include 'loading.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
