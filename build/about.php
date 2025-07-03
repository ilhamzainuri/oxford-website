<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - University of Oxford</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../build/css/style.css">
</head>

<body class="d-flex flex-column min-vh-100 about-page">

<?php include 'navbar.html'; ?>

<main class="about flex-fill">
    <section class="about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-5 mb-md-0">
                    <img src="../build/img/bg1.jpg" class="img-fluid rounded shadow mb-3" alt="University of Oxford Main Building">
                    <img src="../build/img/bg3.jpg" class="img-fluid rounded shadow mb-3" alt="University of Oxford Main Building">
                </div>
                <div class="col-md-6 about-box">

                    <h2 class="mb-3">About University of Oxford</h2>

                    <p class="lead">
                        The University of Oxford, located in Oxford, England, is the oldest university in the English-speaking world, with teaching evidence dating back to 1096. It is renowned for its historic architecture, academic excellence, and influential alumni. Oxford is a collegiate university, consisting of 39 autonomous colleges and six permanent private halls, each with its own unique traditions and communities.
                    </p>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">Founded: 12th century (teaching since 1096)</li>
                        <li class="list-group-item">Colleges: 39 colleges and 6 permanent private halls</li>
                        <li class="list-group-item">Students: Over 24,000 from more than 140 countries</li>
                        <li class="list-group-item">Academic Staff: Over 6,000</li>
                        <li class="list-group-item">Nobel Laureates: 72 affiliated with Oxford</li>
                        <li class="list-group-item">Notable Alumni: 30 British Prime Ministers, world leaders, scientists, writers, and artists</li>
                        <li class="list-group-item">World-class research in sciences, humanities, social sciences, and medicine</li>
                        <li class="list-group-item">Extensive libraries and museums, including the Bodleian Library and Ashmolean Museum</li>
                    </ul>
                    <p>
                        Oxfords tutorial-based teaching system provides personalized education, fostering critical thinking and independent learning. The university is also known for its vibrant student life, with numerous clubs, societies, and sporting opportunities.
                    </p>
                    <p>
                        For more information, visit the official website: <a href="https://www.ox.ac.uk/" target="_blank">www.ox.ac.uk</a>
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