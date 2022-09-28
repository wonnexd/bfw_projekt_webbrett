<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../static_files/bootstrap.css">
        <link rel="stylesheet" href="../static_files/mystyle.css">
        <script src="../static_files/ckeditor/ckeditor.js"></script>
        <title>Document</title>
    </head>

    <body>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // collect value of input field
            $name = $_POST['fname'];
            if (empty($name)) {
                echo "Name is empty";
            } else {
                echo $name;
            }
        }
        ?>

        <script src="../static_files/bootstrap.js"></script>
    </body>

</html>