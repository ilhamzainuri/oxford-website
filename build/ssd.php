<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Social Sciences Division - University of Oxford</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../build/css/style.css">
  <style>
    .division-bg {
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      padding: 80px 0;
      color: white;
      backdrop-filter: brightness(0.8);
    }

    .division-content {
      background-color: rgba(14, 74, 196, 0.65);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.4);
    }

    .division-content h2 {
      font-weight: bold;
      margin-bottom: 20px;
    }

    .division-content ul {
      list-style-type: disc;
      padding-left: 20px;
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

  <?php include 'navbar.html'; ?>

  <main class="flex-fill">
    <section class="division-bg" style="background-image: url('../build/img/bg1.jpg');">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10 division-content">
            <h2>Social Sciences Division</h2>
            <p class="lead">
              Oxford's Social Sciences Division is one of the largest groups of social scientists in the UK and is globally recognized for excellence in teaching and research.
            </p>
            <p>
              The division's departments span a wide spectrum of disciplines that examine society, economy, law, education, politics, and international relations.
            </p>
            <h4>Departments & Schools:</h4>
            <ul>
              <li>School of Anthropology and Museum Ethnography</li>
              <li>School of Archaeology</li>
              <li>Department of Economics</li>
              <li>Department of Education</li>
              <li>Oxford School of Global and Area Studies</li>
              <li>Blavatnik School of Government</li>
              <li>Law Faculty</li>
              <li>Department of International Development</li>
              <li>Oxford Internet Institute</li>
              <li>Department of Politics and International Relations</li>
              <li>Saïd Business School</li>
              <li>Centre for Socio-Legal Studies</li>
            </ul>
            <p>
              Learn more at: <a href="https://www.socsci.ox.ac.uk" class="text-warning" target="_blank">socsci.ox.ac.uk</a>
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
