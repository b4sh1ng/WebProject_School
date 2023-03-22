<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <title>2FA Check</title>
</head>

<body style="background: #242424" ;>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="~dotto/">DB-Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="container-fluid shadow p-3 mb-5 rounded" style="background-color: #2d2d2d; height: 15em; width: 30em;">
            <h1 class="display-6">2FA Check</h1>
            <form action="login_2fa.php" method="post">
                <div class="col-auto">
                    <label form="2fa" class="form-label">Code</label>
                    <input type="text" class="form-control" id="2fa" name="code">
                </div>
                <?php
                session_start();
                $failed = $_SESSION['fail'];
                if ($failed == "no") {
                    echo "Falscher Code!";
                }
                ?>
                <br>
                <button type="submit" class="btn btn-primary">Bestätigen</button>
            </form>
        </div>
    </div>
</body>

</html>