<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Medical Sciences Division - University of Oxford</title>
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
            <h2>Medical Sciences Division</h2>
            <p class="lead">
              The Medical Sciences Division at Oxford is internationally renowned for its research and education in medicine, biomedical sciences, and health care.
            </p>
            <p>
              The division brings together a wide range of departments, research centers, and hospitals, fostering innovation and discovery that directly impacts clinical practice and public health.
            </p>
            <h4>Departments & Institutes:</h4>
            <ul>
              <li>Department of Biochemistry</li>
              <li>Department of Experimental Psychology</li>
              <li>Department of Oncology</li>
              <li>Department of Paediatrics</li>
              <li>Department of Pharmacology</li>
              <li>Department of Physiology, Anatomy and Genetics</li>
              <li>Department of Psychiatry</li>
              <li>Nuffield Department of Clinical Medicine</li>
              <li>Nuffield Department of Orthopaedics, Rheumatology and Musculoskeletal Sciences</li>
              <li>Nuffield Department of Population Health</li>
              <li>Sir William Dunn School of Pathology</li>
              <li>Wellcome Centre for Human Genetics</li>
            </ul>
            <p>
              Learn more at: <a href="https://www.medsci.ox.ac.uk" class="text-warning" target="_blank">medsci.ox.ac.uk</a>
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