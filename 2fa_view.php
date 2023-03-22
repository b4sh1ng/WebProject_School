<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <?php require_once('./session_backup.inc.php'); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <title>Einstellungen</title>
</head>

<body style="background: #242424" ;>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">DB-Management</a>
        </div>
    </nav>
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="container-fluid shadow p-3 mb-5 rounded" style="background-color: #2d2d2d; height: 20em; width: 30em;">
            <h1 class="display-6 d-flex justify-content-center">Dein 2FA Key</h1>
            <br>
            <div class="text-center">
                <img src="2fakey/2fa_key.png">
            </div>
            <div class="d-flex justify-content-center">
                <form method="post">
                    <br>
                    <input class="btn btn-success" type="submit" value="Go back!" name="btn_back">
                    <?php
                    if (isset($_POST['btn_back'])) {
                        unlink("2fakey/2fa_key.png");
                        echo "<script> location.replace(\"settings.php\"); </script>";
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>



</body>

</html>