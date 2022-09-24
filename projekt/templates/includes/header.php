<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../static_files/bootstrap.css">
        <link rel="stylesheet" href="../static_files/mystyle.css">
        <script src="../static_files/ckeditor/ckeditor.js"></script>
        <title>Bfw Anzeigen</title>
    </head>

    <body class="bg-grey">

        <div class="row bg-light zero-margin">
            <div class="container col-9">
                <div class="row">
                    <div class="col ms-5 p-4">
                        <img src="../static_files/images/logo.svg" alt="Logo">
                    </div>
                </div>
            </div>
        </div>

        <div class="container col-9 bg-light zero-padding">
            <nav class="navbar navbar-expand-lg bg-orange">
                <div class="container-fluid">
                    <a class="navbar-brand text-light" href="#">Webbrett</a>
                    <button class="navbar-toggler border border-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-light me-3 " aria-current="page" href="index.php">Alle Rubriken</a>
                            </li>

                            <?php
                            if (!$rubrik) {

                            }
                            if ($rubrik) {
                                ?>
                                <li class = "nav-item">
                                    <a class = "nav-link text-light me-3" href = "">
                                        <?php
                                        echo $rubrik;
                                        ?>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>

                            <li class="nav-item">
                                <a class="nav-link text-light me-3 " href="backend.php">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="text-center p-5 min-height-middle">