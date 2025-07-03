<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Humanities Division - University of Oxford</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../build/css/style.css">
  <style>
    .humanities-bg {
      background-image: url('../build/img/bg1.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      padding: 80px 0;
      color: white;
      backdrop-filter: brightness(0.8);
    }

    .humanities-content {
      background-color: rgba(14, 74, 196, 0.65);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.4);
    }

    .humanities-content h2 {
      font-weight: bold;
      margin-bottom: 20px;
    }

    .humanities-content ul {
      list-style-type: disc;
      padding-left: 20px;
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

  <?php include 'navbar.html'; ?>

  <main class="flex-fill">
    <section class="humanities-bg">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10 humanities-content">
            <h2>Humanities Division at the University of Oxford</h2>
            <p class="lead">
              The Humanities Division is one of the four academic divisions at the University of Oxford, recognized worldwide for its outstanding scholarship, research, and teaching in the humanities.
            </p>
            <p>
              With a strong commitment to critical thinking, interdisciplinary research, and intellectual exploration, the Humanities Division covers a broad range of subjects that explore human history, culture, thought, and expression.
            </p>
            <h4>Departments & Faculties:</h4>
            <ul>
              <li>Faculty of Classics</li>
              <li>Faculty of English Language and Literature</li>
              <li>Faculty of History</li>
              <li>Faculty of Linguistics, Philology and Phonetics</li>
              <li>Faculty of Medieval and Modern Languages</li>
              <li>Faculty of Music</li>
              <li>Faculty of Oriental Studies</li>
              <li>Faculty of Philosophy</li>
              <li>Ruskin School of Art</li>
              <li>Theology and Religion Faculty</li>
            </ul>
            <p>
              The division is also home to several world-class research centres and libraries, such as the Bodleian Libraries, which provide resources that support a thriving academic community.
            </p>
            <p>
              For more details, please visit the official website: 
              <a href="https://humanities.ox.ac.uk" class="text-warning" target="_blank">humanities.ox.ac.uk</a>
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php include 'loading.php'; ?>
  <?php include 'footer.html'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
